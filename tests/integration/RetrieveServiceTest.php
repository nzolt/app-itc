<?php
    namespace Tests\Integratin;

    use http\Exception\InvalidArgumentException;
    use \PHPUnit\Framework\TestCase;
    use App\Services\RetrieveData;
    use App\Exceptions\RequestException;

	/**
	 * Class RetrieveServiceTest
	 * @package Tests
	 * @group integration
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
            $_ENV['DETAIL_URL']="http://localhost:8080/api/info";
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
            $this->assertSame("http://localhost:8080/api/info", $this->service->getDetailUrl());
            $this->assertSame(3, $this->service->getRetries());
        }

        /**
         * @dataProvider \Tests\integration\Provider\Service\DataProvider::provideListData
         */
        public function testProcessList($expected, $data)
        {
            $processed = $this->service->getData();
            $this->assertIsArray($processed);
            $this->assertEquals($expected, $processed);
        }

        public function testException()
        {
            $this->service->setListUrl("http://localhost:8080/api/list/error");
            $this->expectException(RequestException::class);
            $this->service->getData();
        }

        public function testMissindIdException()
        {
            $this->service->setType('detail');
            $this->expectException(\InvalidArgumentException::class);
            $this->service->getData();
        }

        /**
         * @dataProvider \Tests\integration\Provider\Service\DataProvider::provideDetailData
         */
        public function testData($data, $expected)
        {
            $this->service->setType('detail');
            $this->service->setId($data);
            $processed = $this->service->getData();
            $this->assertIsArray($processed);
            $this->assertEquals($expected, $processed);
        }
    }