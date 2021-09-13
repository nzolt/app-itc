<?php

namespace App\Services;

use App\Exceptions\InvalidDataException;
use App\Exceptions\RequestException;

/**
 * Class to get data from url with retry
 */
class RetrieveData implements RetrieveDataInterface
{
    /**
     * @var string
     */
    protected $listUrl = '';
    /**
     * @var string
     */
    protected $detailUrl = '';
    /**
     * @var int
     */
    protected $retries;
    /**
     * @var array
     */
    protected $rawData;
    /**
     * @var array
     */
    protected $sanData;
    /**
     * @var array
     */
    protected $data;
    /**
     * @var string
     */
    protected $url;
    /**
     * @var string
     */
    protected $type = 'list';
    /**
     * @var string
     */
    protected $id = '';

    /**
     *
     */
    public function __construct(string $type = 'list', string $id = '')
    {
        if($type == 'detail'){
            $this->type = $type;
            $this->id = $id;
        }
        // Set config from .env
        if($this->listUrl === ''){
            $this->setListUrl($_ENV['LIST_URL']);
        }
        if($this->detailUrl === ''){
            $this->setDetailUrl($_ENV['DETAIL_URL']);
        }

        $this->setRetries($_ENV['RETRY']);
    }

    /**
     * @return string
     */
    public function getListUrl(): string
    {
        return $this->listUrl;
    }

    /**
     * @param string $url
     */
    public function setListUrl(string $url): void
    {
        $this->listUrl = $url;
    }

    /**
     * @return string
     */
    public function getDetailUrl(): string
    {
        return $this->detailUrl;
    }

    /**
     * @param string $url
     */
    public function setDetailUrl(string $url): void
    {
        $this->detailUrl = $url;
    }

    /**
     * @return int
     */
    public function getRetries(): int
    {
        return $this->retries;
    }

    /**
     * @param int $retries
     */
    public function setRetries(int $retries): void
    {
        $this->retries = $retries;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return array
     * @throws RequestException
     */
    public function getData(): array
    {
        $this->url = $this->listUrl; // Set processing url to LIST by default

        if ($this->type === 'detail') {
            if($this->id != ''){
                $this->url = $this->detailUrl . '?id=' . $this->id; // If the type is detail set the processing url to DETAIL
            } else {
                throw new \InvalidArgumentException();
            }
        }

        // Make the request
        $data = $this->makeRequest($this->url);
        $data = $this->processResult($data);
        if ($this->type === 'detail') {
            return $this->sanitizeData($data[$this->id]);
        } else {
            return $this->sanitizeData($data['products']);
        }

    }

    /**
     * @param string $url
     * @param int $retries
     * @param null $handle
     * @param string $method
     * @return string
     * @throws RequestException
     */
    public function makeRequest(string $url, int $retries = 1, $handle = null, $method = 'GET'): string
    {
        $output_array = [];
        if(!$handle){
            $handle = curl_init();

            curl_setopt_array($handle,
                array(
                    CURLOPT_URL => $url,
                    CURLOPT_HEADER => false,
                    CURLOPT_RETURNTRANSFER => true
                )
            );
        }

        $output = curl_exec($handle);
        $responseCode   = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        $length = curl_getinfo($handle, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
        $errorNo = curl_errno($handle);
        if($errorNo) {
            throw new RequestException('', 500);
        } elseif($responseCode == 200 ){
            // We don't need to decode the response string to see if is error
            preg_match('/(error)/', $output, $output_array);
            if(count($output_array)) {
                // if string "error:" found, do recursive call
                if($this->retries >= $retries || $this->retries == 0){
                    $retries++; // echo $retries . PHP_EOL;
                    $this->makeRequest($url, $retries, $handle);
                } else {
                    throw new RequestException();
                }
            } else {
                $this->rawData = $output;
            }
        }
        /**
         * Close the resource if no more required to free memory
         * Not closing before as may need on recursion,
         * and we don't want to boot up again each time we need to use.
        */
        curl_close($handle);

        return $this->rawData;
    }

    /**
     * @param string $data
     * @return array
     */
    public function processResult(string $data): array
    {
        try {
            $result = json_decode($data, true);
            if ($result) {
                return $result;
            } else {
                throw new InvalidDataException();
            }
        } catch (RequestException $e) {
            //TODO: Handle RequestException
        } catch (InvalidDataException $e) {
            //TODO: Handle InvalidDataException
        } catch (Exception $e) {
            //TODO: Handle all unhandled exceptions
        }

        return [];
    }

    /**
     * @param array $data
     * @return array
     */
    public function sanitizeData(array $data): array
    {
        $ou = array();

        foreach($data as $key => $item){
            if(is_array($item)){
                $item = implode('|', $item);
            }
            list($sKey, $sValue) = $this->sanitize($key, $item);
            $ou[$sKey] = $sValue;
        }

        return $ou;
    }

    /**
     * @param $key
     * @param $value
     * @return array
     */
    public function sanitize($key, $value): array
    {
        return [filter_var($key, FILTER_SANITIZE_STRING),
            /** Add | to exclusion */
            preg_replace("/[^[:alnum:][:space:][|_-]]/u", '', filter_var($value, FILTER_SANITIZE_STRING))];
    }
}