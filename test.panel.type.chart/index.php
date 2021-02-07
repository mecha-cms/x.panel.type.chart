<?php namespace _\lot\x\panel\route\__test;

// TODO: Move this to a separate extension
function chart($_) {
    extract($GLOBALS, \EXTR_SKIP);
    $_['title'] = 'Chart Example';
    $_['lot']['desk']['lot']['form']['lot'][0]['title'] = 'Chart Title Goes Here';
    $_['lot']['desk']['lot']['form']['lot'][0]['description'] = 'Chart description goes here.';
    $_['lot']['desk']['lot']['form']['lot'][0]['type'] = 'section';
    $_['lot']['desk']['lot']['form']['lot'][0]['content'] = '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>';
    // Create empty statistic for one year
    $assets_count = $comments_count = $pages_count = $users_count = 0;
    $assets_data = $comments_data = $pages_data = $users_data = \array_fill(0, 12, 0);
    $assets_status = $comments_status = $pages_status = $users_status = [0, 0, 0];
    // Get current year from URL
    $year_current = (int) (\Get::get('year') ?? \date('Y'));
    // Generate statistic for asset(s)
    foreach (\g(\LOT . \DS . 'asset', 1, true) as $k => $v) {
        $t = \explode('-', \date('Y-m-d', \filectime($k)));
        if ($year_current !== (int) $t[0]) {
            continue;
        }
        ++$assets_count;
        ++$assets_data[((int) $t[1]) - 1];
    }
    // Generate statistic for comment(s)
    if (null !== \State::get('x.comment')) {
        foreach (\g(\LOT . \DS . 'comment', 'archive,draft,page', true) as $k => $v) {
            $comment = new \Comment($k);
            ++$comments_count;
            ++$comments_status[[
                'archive' => 0,
                'draft' => 1,
                'page' => 2
            ][$comment->x]];
            $t = \explode('-', (string) $comment->time->format('Y-m-d'));
            if ($year_current !== (int) $t[0]) {
                continue;
            }
            ++$comments_data[((int) $t[1]) - 1];
        }
    }
    // Generate statistic for page(s)
    if (null !== \State::get('x.page')) {
        foreach (\g(\LOT . \DS . 'page', 'archive,draft,page', true) as $k => $v) {
            $page = new \Page($k);
            ++$pages_count;
            ++$pages_status[[
                'archive' => 0,
                'draft' => 1,
                'page' => 2
            ][$page->x]];
            $t = \explode('-', (string) $page->time->format('Y-m-d'));
            if ($year_current !== (int) $t[0]) {
                continue;
            }
            ++$pages_data[((int) $t[1]) - 1];
        }
    }
    // Generate statistic for user(s)
    if (null !== \State::get('x.user')) {
        foreach (\g(\LOT . \DS . 'user', 'archive,draft,page') as $k => $v) {
            $user = new \User($k);
            ++$users_count;
            ++$users_status[[
                'archive' => 0,
                'draft' => 1,
                'page' => 2
            ][$user->x]];
            $t = \explode('-', (string) $user->time->format('Y-m-d'));
            if ($year_current !== (int) $t[0]) {
                continue;
            }
            ++$users_data[((int) $t[1]) - 1];
        }
    }
    $_['lot']['desk']['lot']['form']['lot'][1]['lot']['chart-0'] = [
        'set' => ['Archive', 'Draft', 'Public'],
        'title' => 'Overview',
        'type' => 'chart/bar',
        'lot' => [
            0 => [
                'title' => 'Comments',
                'values' => $comments_status,
                'color' => '#164E63'
            ],
            1 => [
                'title' => 'Pages',
                'values' => $pages_status,
                'color' => '#0E7490'
            ],
            2 => [
                'title' => 'Users',
                'values' => $users_status,
                'color' => '#06B6D4'
            ]
        ],
        'min' => 0,
        'stack' => 10
    ];
    $_['lot']['desk']['lot']['form']['lot'][1]['lot']['chart-1'] = [
        'set' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        'title' => ['Year %d', $year_current],
        'type' => 'chart/line',
        'lot' => [
            0 => [
                'title' => 'Assets',
                'values' => $assets_data,
                'color' => '#DC2626'
            ],
            1 => [
                'title' => 'Comments',
                'values' => $comments_data,
                'color' => '#D97706'
            ],
            2 => [
                'title' => 'Pages',
                'values' => $pages_data,
                'color' => '#65A30D'
            ]
        ],
        'min' => 0,
        'tags' => ['mt:2' => true],
        'stack' => 20
    ];
    $links = [$year_current - 1];
    if ((int) \date('Y') !== $year_current) {
        $links[] = $year_current + 1;
    }
    $links = \implode("", \map($links, function($v) use($_, $url) {
        return '<a href="' . $url . $_['/'] . '/::g::/' . $_['path'] . $url->query('&amp;', [
            'year' => $v
        ]) . '">' . \i('Year %d', $v) . '</a>';
    }));
    $_['lot']['desk']['lot']['form']['lot'][1]['lot']['history'] = [
        'type' => 'content',
        'content' => '<p style="display:flex;justify-content:space-between;">' . $links . '</p>',
        'stack' => 30
    ];
    return $_;
}

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
