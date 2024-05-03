<?php
function getDefaultData(){
    return [
        "year" => '',
        "months" => [],
        "attributes" => [],
        "numericalDataNumByAttribute" => []
    ];
}

function getSampleFetchedDataRegistrations($selectedYear) {
    return [
        "year" => $selectedYear,
        "months" => ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        "attributes" => ["EV", "General", "Disability"],
        "numericalDataNumByAttribute" => [
            "EV" => [
                "Jan" => 5,
                "Feb" => 3,
                "Mar" => 7,
                "Apr" => 2,
                "May" => 4,
                "Jun" => 6,
                "Jul" => 8,
                "Aug" => 3,
                "Sep" => 5,
                "Oct" => 7,
                "Nov" => 2,
                "Dec" => 4
            ],
            "General" => [
                "Jan" => 4,
                "Feb" => 6,
                "Mar" => 8,
                "Apr" => 3,
                "May" => 5,
                "Jun" => 7,
                "Jul" => 2,
                "Aug" => 4,
                "Sep" => 6,
                "Oct" => 8,
                "Nov" => 3,
                "Dec" => 5
            ],
            "Disability" => [
                "Jan" => 3,
                "Feb" => 5,
                "Mar" => 7,
                "Apr" => 4,
                "May" => 6,
                "Jun" => 8,
                "Jul" => 3,
                "Aug" => 5,
                "Sep" => 7,
                "Oct" => 2,
                "Nov" => 4,
                "Dec" => 6
            ]
        ]
    ];
}

function getSampleFetchedDataDeletions($selectedYear){
    return [
        "year" => $selectedYear,
        "months" => ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        "attributes" => ["Vip", "Usual"],
        "numericalDataNumByAttribute" => [
            "Vip" => [
                "Jan" => 7,
                "Feb" => 2,
                "Mar" => 9,
                "Apr" => 4,
                "May" => 6,
                "Jun" => 8,
                "Jul" => 3,
                "Aug" => 5,
                "Sep" => 7,
                "Oct" => 2,
                "Nov" => 4,
                "Dec" => 6
            ],
            "Usual" => [
                "Jan" => 5,
                "Feb" => 7,
                "Mar" => 3,
                "Apr" => 5,
                "May" => 7,
                "Jun" => 2,
                "Jul" => 4,
                "Aug" => 6,
                "Sep" => 8,
                "Oct" => 3,
                "Nov" => 5,
                "Dec" => 7
            ]
        ]
    ];
}

function getSampleFetchedDataReservations($selectedYear){
    return [
        "year" => $selectedYear,
        "months" => ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        "attributes" => ["AAA", "Usual"],
        "numericalDataNumByAttribute" => [
            "AAA" => [
                "Jan" => 10,
                "Feb" => 2,
                "Mar" => 9,
                "Apr" => 4,
                "May" => 6,
                "Jun" => 8,
                "Jul" => 3,
                "Aug" => 5,
                "Sep" => 7,
                "Oct" => 2,
                "Nov" => 4,
                "Dec" => 6
            ],
            "Usual" => [
                "Jan" => 5,
                "Feb" => 7,
                "Mar" => 3,
                "Apr" => 5,
                "May" => 7,
                "Jun" => 2,
                "Jul" => 4,
                "Aug" => 6,
                "Sep" => 8,
                "Oct" => 3,
                "Nov" => 5,
                "Dec" => 7
            ]
        ]
    ];
}

function getSampleFetchedDataCancellations($selectedYear){
    return [
        "year" => $selectedYear,
        "months" => ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        "attributes" => ["BBB", "Usual"],
        "numericalDataNumByAttribute" => [
            "BBB" => [
                "Jan" => 11,
                "Feb" => 2,
                "Mar" => 9,
                "Apr" => 4,
                "May" => 6,
                "Jun" => 8,
                "Jul" => 3,
                "Aug" => 5,
                "Sep" => 7,
                "Oct" => 2,
                "Nov" => 4,
                "Dec" => 6
            ],
            "Usual" => [
                "Jan" => 5,
                "Feb" => 7,
                "Mar" => 3,
                "Apr" => 5,
                "May" => 7,
                "Jun" => 2,
                "Jul" => 4,
                "Aug" => 6,
                "Sep" => 8,
                "Oct" => 3,
                "Nov" => 5,
                "Dec" => 7
            ]
        ]
    ];
}

function getSampleFetchedDataSales($selectedYear){
    $cccSales = [
        "Jan" => 12,
        "Feb" => 2,
        "Mar" => 9,
        "Apr" => 4,
        "May" => 6,
        "Jun" => 8,
        "Jul" => 3,
        "Aug" => 5,
        "Sep" => 7,
        "Oct" => 2,
        "Nov" => 4,
        "Dec" => 6
    ];

    $usualSales = [
        "Jan" => 5,
        "Feb" => 7,
        "Mar" => 3,
        "Apr" => 5,
        "May" => 7,
        "Jun" => 2,
        "Jul" => 4,
        "Aug" => 6,
        "Sep" => 8,
        "Oct" => 3,
        "Nov" => 5,
        "Dec" => 7
    ];

    $totalSales = [];
    foreach ($cccSales as $month => $sales) {
        $totalSales[$month] = $sales + $usualSales[$month];
    }

    return [
        "year" => $selectedYear,
        "months" => ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        "attributes" => ["CCC", "Usual", "Total"],
        "numericalDataNumByAttribute" => [
            "CCC" => $cccSales,
            "Usual" => $usualSales,
            "Total" => $totalSales
        ]
    ];
}