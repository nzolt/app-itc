<?php


namespace Tests\integration\Provider\Service;


class DataProvider
{
	public static function provideListData()
	{
		return [
            [
                [
                    "combgap"=>"Combined GAP",
                    "smart"=>"SMART",
                    "annualtravel"=>"Annual Multi-Trip Travel Insurance",
                    "singletravel"=>"Single-Trip Travel Insurance",
                    "buildcont"=>"Buildings & Contents Insurance",
                    "income"=>"Income Protection",
                    "car"=>"Car Insurance",
                ],
                '{"products":{"combgap":"Combined GAP","smart":"SMART","annualtravel":"Annual Multi-Trip Travel Insurance","singletravel":"Single-Trip Travel Insurance","buildcont":"Buildings & Contents Insurance","income":"Income Protection","car":"Car Insurance"}}',
            ]
        ];
	}

    public static function provideDetailData()
    {
        return [
            [
                "combgap",
                [
                    'name' => 'Combined GAP',
                    'description' => 'Combines the benefits of Total Loss and Finance GAP which pays the higher of the invoice value or the finance settlement figure when a vehicle is deemed a total loss',
                    'type' => 'motor',
                    'suppliers' => 'Vehicle Protect UK|E&M GAP Insurance',
                ]
            ],
            [
                "singletravel",
                [
                    'name' => 'Single-Trip Travel Insurance',
                    'description' => 'Worldwide travel insurance, single-trip',
                    'type' => 'travel',
                    'suppliers' => 'Insuria Travel|Happy Camper UK Ltd',
                ]
            ],
            [
                "income",
                [
                    'name' => 'Income Protection',
                    'description' => 'Protection against redundancy, long term sickness and disability',
                    'type' => 'income',
                    'suppliers' => 'SuperInsure78a1bc9e567fa197bb3',
                ]
            ]
        ];
    }
}
