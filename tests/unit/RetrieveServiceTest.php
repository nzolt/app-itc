<?php
    namespace Tests\Unit;

    use \PHPUnit\Framework\TestCase;
    use App\Services\RetrieveData;

	/**
	 * Class RetrieveServiceTest
	 * @package Tests
	 * @group unit
	 * @group ready
	 */
    class RetrieveServiceTest extends TestCase
    {
        /**
         * @var RetrieveData
         */
        protected $service;

        public static function setUpBeforeClass(): void
        {
            $_ENV['LIST_URL']="http://localhost:8080/api/list";
            $_ENV['DETAIL_URL']="http://localhost:8080/api/detail";
            $_ENV['RETRY']=3;
        }

        public function setUp(): void
        {
            $this->service = new RetrieveData();
        }

        public function testInstance()
		{
			$this->assertInstanceOf('App\Services\RetrieveData', $this->service, 'Returned class is NOT RetrieveService instance');
		}

        public function testSetup()
        {
            $this->assertSame("http://localhost:8080/api/list", $this->service->getListUrl());
            $this->assertSame("http://localhost:8080/api/detail", $this->service->getDetailUrl());
            $this->assertSame(3, $this->service->getRetries());
        }

        public function testModifySetup()
        {
            $listUrl = "https://www.itccompliance.co.uk/recruitment-webservice/api/list";
            $detailUrl = "https://www.itccompliance.co.uk/recruitment-webservice/api/info?id=annualtravel";
            $retries = 50;
            $this->service->setListUrl($listUrl);
            $this->service->setDetailUrl($detailUrl);
            $this->service->setRetries($retries);
            $this->assertSame($listUrl, $this->service->getListUrl());
            $this->assertSame($detailUrl, $this->service->getDetailUrl());
            $this->assertSame($retries, $this->service->getRetries());
        }

        /**
         * @dataProvider \Tests\unit\Provider\Service\DataProvider::provideListJsonData
         */
        public function testProcessResult($expected, $data)
        {
            $processed = $this->service->processResult($data);
            $this->assertIsArray($processed);
            $this->assertEquals($expected, $processed);
        }

        /**
         * @dataProvider \Tests\unit\Provider\Service\DataProvider::provideSanitizeDataData
         */
        public function testSanitizeData($data, $expected)
        {
            $this->service->setType('detail');
            $processed = $this->service->sanitizeData($data);
            $this->assertIsArray($processed);
            $this->assertEquals($expected, $processed);
        }

        /**
         * @dataProvider \Tests\unit\Provider\Service\DataProvider::provideSanitizeData
         */
        public function testSanitize($data, $expected)
        {
            $this->service->setType('detail');
            $processed = $this->service->sanitize($data[0], $data[1]);
            $this->assertIsArray($processed);
            $this->assertEquals($expected, $processed);
        }
    }