<?php

namespace App\Services;

interface RetrieveDataInterface
{
    public function setListUrl(string $url): void;
    public function setDetailUrl(string $url): void;
    public function makeRequest(string $url, int $retries = 1, $method = 'GET'): string;
    public function getData(): array;
}