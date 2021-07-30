<?php namespace x\panel\route\__test;

function charts($_) {
    $_['title'] = 'Charts';
    extract($GLOBALS, \EXTR_SKIP);
    $data = static function(int $count) {
        $out = [];
        for ($i = 0; $i < $count; ++$i) {
            $out[] = \rand(0, 100);
        }
        return $out;
    };
    $colors = ['#06B6D4', '#0891B2', '#0E7490', '#155E75', '#164E63'];
    $_['lot']['desk']['lot']['form']['lot'][1]['lot']['bar'] = [
        'set' => ['Data 1', 'Data 2', 'Data 3', 'Data 4', 'Data 5'],
        'title' => 'Bar',
        'type' => 'chart/bar',
        'lot' => [
            0 => [
                'title' => 'Subject 1',
                'values' => $data(5),
                'color' => $colors[0]
            ],
            1 => [
                'title' => 'Subject 2',
                'values' => $data(5),
                'color' => $colors[1]
            ],
            2 => [
                'title' => 'Subject 3',
                'values' => $data(5),
                'color' => $colors[2]
            ],
            3 => [
                'title' => 'Subject 4',
                'values' => $data(5),
                'color' => $colors[3]
            ],
            4 => [
                'title' => 'Subject 5',
                'values' => $data(5),
                'color' => $colors[4]
            ]
        ],
        'stack' => 10
    ];
    $data_bubble = static function(int $count) {
        $out = [];
        for ($i = 0; $i < $count; ++$i) {
            $out[] = [
                'r' => \rand(0, 50),
                'x' => \rand(0, 100),
                'y' => \rand(0, 100)
            ];
        }
        return $out;
    };
    $_['lot']['desk']['lot']['form']['lot'][1]['lot']['bubble'] = [
        'set' => ['Data 1', 'Data 2', 'Data 3', 'Data 4', 'Data 5'],
        'legend' => ['side' => 'right'],
        'title' => 'Bubble',
        'type' => 'chart/bubble',
        'tags' => ['mt:2' => true],
        'lot' => [
            0 => [
                'title' => 'Subject 1',
                'values' => $data_bubble(5),
                'color' => $colors[0]
            ],
            1 => [
                'title' => 'Subject 2',
                'values' => $data_bubble(5),
                'color' => $colors[1]
            ],
            2 => [
                'title' => 'Subject 3',
                'values' => $data_bubble(5),
                'color' => $colors[2]
            ],
            3 => [
                'title' => 'Subject 4',
                'values' => $data_bubble(5),
                'color' => $colors[3]
            ],
            4 => [
                'title' => 'Subject 5',
                'values' => $data_bubble(5),
                'color' => $colors[4]
            ]
        ],
        'stack' => 20
    ];
    $_['lot']['desk']['lot']['form']['lot'][1]['lot']['doughnut'] = [
        'set' => ['Data 1', 'Data 2', 'Data 3', 'Data 4', 'Data 5'],
        'legend' => ['side' => 'right'],
        'title' => 'Doughnut',
        'type' => 'chart/doughnut',
        'tags' => ['mt:2' => true],
        'lot' => [
            0 => [
                'title' => 'Subject 1',
                'values' => $data(5),
                'colors' => $colors
            ],
            1 => [
                'title' => 'Subject 2',
                'values' => $data(5),
                'colors' => $colors
            ],
            2 => [
                'title' => 'Subject 2',
                'values' => $data(5),
                'colors' => $colors
            ]
        ],
        'stack' => 30
    ];
    $_['lot']['desk']['lot']['form']['lot'][1]['lot']['line'] = [
        'set' => ['Data 1', 'Data 2', 'Data 3', 'Data 4', 'Data 5'],
        'title' => 'Line',
        'type' => 'chart/line',
        'tags' => ['mt:2' => true],
        'lot' => [
            0 => [
                'title' => 'Subject 1',
                'values' => $data(5),
                'border' => 2,
                'color' => $colors[0]
            ],
            1 => [
                'title' => 'Subject 2',
                'values' => $data(5),
                'border' => 2,
                'color' => $colors[1]
            ],
            2 => [
                'title' => 'Subject 3',
                'values' => $data(5),
                'border' => 2,
                'color' => $colors[2]
            ],
            3 => [
                'title' => 'Subject 4',
                'values' => $data(5),
                'border' => 2,
                'color' => $colors[3]
            ],
            4 => [
                'title' => 'Subject 5',
                'values' => $data(5),
                'border' => 2,
                'color' => $colors[4],
                'fill' => true
            ]
        ],
        'stack' => 30
    ];
    $_['lot']['desk']['lot']['form']['lot'][1]['lot']['pie'] = [
        'set' => ['Data 1', 'Data 2', 'Data 3', 'Data 4', 'Data 5'],
        'legend' => ['side' => 'right'],
        'title' => 'Pie',
        'type' => 'chart/pie',
        'tags' => ['mt:2' => true],
        'lot' => [
            0 => [
                'title' => 'Subject 1',
                'values' => $data(5),
                'colors' => $colors
            ]
        ],
        'stack' => 40
    ];
    $_['lot']['desk']['lot']['form']['lot'][1]['lot']['polar-area'] = [
        'set' => ['Data 1', 'Data 2', 'Data 3', 'Data 4', 'Data 5'],
        'legend' => ['side' => 'right'],
        'title' => 'Polar Area',
        'type' => 'chart/polar-area',
        'tags' => ['mt:2' => true],
        'lot' => [
            0 => [
                'title' => 'Subject 1',
                'values' => $data(5),
                'colors' => $colors
            ]
        ],
        'stack' => 40
    ];
    $_['lot']['desk']['lot']['form']['lot'][1]['lot']['radar'] = [
        'set' => ['Data 1', ['Data 2.0', 'Data 2.1', 'Data 2.2'], 'Data 3', 'Data 4', 'Data 5'],
        'legend' => ['side' => 'right'],
        'title' => 'Radar',
        'type' => 'chart/radar',
        'tags' => ['mt:2' => true],
        'lot' => [
            0 => [
                'title' => 'Subject 1',
                'values' => $data(5),
                'color' => $colors[0]
            ],
            1 => [
                'title' => 'Subject 2',
                'values' => $data(5),
                'color' => $colors[1]
            ],
            2 => [
                'title' => 'Subject 3',
                'values' => $data(5),
                'color' => $colors[2]
            ],
            3 => [
                'title' => 'Subject 4',
                'values' => $data(5),
                'color' => $colors[3]
            ],
            4 => [
                'title' => 'Subject 5',
                'values' => $data(5),
                'color' => $colors[4],
                'fill' => true
            ]
        ],
        'stack' => 50
    ];
    $data_scatter = static function(int $count) {
        $out = [];
        for ($i = 0; $i < $count; ++$i) {
            $out[] = [
                'x' => \rand(-100, 100),
                'y' => \rand(-100, 100)
            ];
        }
        return $out;
    };
    $_['lot']['desk']['lot']['form']['lot'][1]['lot']['scatter'] = [
        'set' => ['Data 1', 'Data 2', 'Data 3', 'Data 4', 'Data 5'],
        'title' => 'Scatter',
        'type' => 'chart/scatter',
        'tags' => ['mt:2' => true],
        'lot' => [
            0 => [
                'title' => 'Subject 1',
                'values' => $data_scatter(5),
                'color' => $colors[0]
            ],
            1 => [
                'title' => 'Subject 2',
                'values' => $data_scatter(5),
                'color' => $colors[1]
            ],
            2 => [
                'title' => 'Subject 3',
                'values' => $data_scatter(5),
                'color' => $colors[2]
            ],
            3 => [
                'title' => 'Subject 4',
                'values' => $data_scatter(5),
                'color' => $colors[3]
            ],
            4 => [
                'title' => 'Subject 5',
                'values' => $data_scatter(5),
                'color' => $colors[4],
                'fill' => true
            ]
        ],
        'stack' => 60
    ];
    return $_;
}
