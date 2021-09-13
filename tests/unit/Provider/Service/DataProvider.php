<?php


namespace Tests\unit\Provider\Service;


class DataProvider
{
	public static function provideListJsonData()
	{
		return [
            [
                [
                    "products"=>[
                        "combgap"=>"Combined GAP",
                        "smart"=>"SMART",
                        "annualtravel"=>"Annual Multi-Trip Travel Insurance",
                        "singletravel"=>"Single-Trip Travel Insurance",
                        "buildcont"=>"Buildings & Contents Insurance",
                        "income"=>"Income Protection",
                        "car"=>"Car Insurance",
                    ]
                ],
                '{"products":{"combgap":"Combined GAP","smart":"SMART","annualtravel":"Annual Multi-Trip Travel Insurance","singletravel":"Single-Trip Travel Insurance","buildcont":"Buildings & Contents Insurance","income":"Income Protection","car":"Car Insurance"}}',
            ]
        ];
	}

    public static function provideSanitizeDataData()
    {
        return [
            [
                array (
                    'name' => 'Combined GAP',
                    'description' => 'Combines the benefits of Total Loss and Finance GAP which pays the higher of the invoice value or the finance settlement figure when a vehicle is deemed a total loss',
                    'type' => 'motor',
                    'suppliers' => array ( 0 => 'Vehicle Protect UK', 1 => 'E&M GAP Insurance', ), ),
                array (
                    'name' => 'Combined GAP',
                    'description' => 'Combines the benefits of Total Loss and Finance GAP which pays the higher of the invoice value or the finance settlement figure when a vehicle is deemed a total loss',
                    'type' => 'motor',
                    'suppliers' => 'Vehicle Protect UK|E&M GAP Insurance', ),
            ],
            [
                array ( 'name' => 'Single-Trip Travel Insurance',
                    'description' => 'Worldwide travel insurance, single-trip',
                    'type' => 'travel',
                    'suppliers' => array ( 0 => 'Insuria Travel', 1 => 'Happy Camper UK Ltd', ), ),
                array (
                    'name' => 'Single-Trip Travel Insurance',
                    'description' => 'Worldwide travel insurance, single-trip',
                    'type' => 'travel',
                    'suppliers' => 'Insuria Travel|Happy Camper UK Ltd', ),
            ],
            [
                array (
                    'name' => 'Income Protection',
                    'description' => 'Protection against redundancy, long term sickness and disability',
                    'type' => 'income',
                    'suppliers' => 'SuperInsure<span style=\"display: none\">78a1bc9e567fa197bb3<\/div>', ),
                array (
                    'name' => 'Income Protection',
                    'description' => 'Protection against redundancy, long term sickness and disability',
                    'type' => 'income',
                    'suppliers' => 'SuperInsure78a1bc9e567fa197bb3', ),
            ],
        ];
    }

    public static function provideSanitizeData()
    {
        return [
            [
                ['suppliers', 'Insuria Travel|Happy Camper UK Ltd'],
                ['suppliers', 'Insuria Travel|Happy Camper UK Ltd'],
            ],
            [
                ['description', 'Protection against redundancy, long term sickness and disability'],
                ['description', 'Protection against redundancy, long term sickness and disability'],
            ],
            [
                ['suppliers', 'SuperInsure<span style=\"display: none\">78a1bc9e567fa197bb3<\/div>'],
                ['suppliers', 'SuperInsure78a1bc9e567fa197bb3'],
            ],
        ];
    }

}