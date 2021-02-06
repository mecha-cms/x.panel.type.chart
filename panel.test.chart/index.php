<?php namespace _\lot\x\panel\route\__test;

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
    $grid_color = \State::is('dark') ? 'rgba(255, 255, 255, .125)' : 'rgba(0, 0, 0, .125)';
    $grid_lines = [
        'borderDash' => [3, 1],
        'color' => $grid_color,
        'drawBorder' => false,
        'zeroLineColor' => $grid_color,
        'zeroLineWidth' => 2
    ];
    $state_chart_0 = [
        'data' => [
            'labels' => [
                \i('Archive'),
                \i('Draft'),
                \i('Public')
            ],
            'datasets' => [
                0 => [
                    'label' => \i('Comments'),
                    'data' => $comments_status,
                    'backgroundColor' => 'rgba(12, 74, 110, .6)',
                    'borderColor' => 'rgba(12, 74, 110, .9)',
                    'borderWidth' => 1
                ],
                1 => [
                    'label' => \i('Pages'),
                    'data' => $pages_status,
                    'backgroundColor' => 'rgba(3, 105, 161, .6)',
                    'borderColor' => 'rgba(3, 105, 161, .9)',
                    'borderWidth' => 1
                ],
                2 => [
                    'label' => \i('Users'),
                    'data' => $users_status,
                    'backgroundColor' => 'rgba(14, 165, 233, .6)',
                    'borderColor' => 'rgba(14, 165, 233, .9)',
                    'borderWidth' => 1
                ]
            ]
        ],
        'options' => [
            'responsive' => true,
            'title' => [
                'display' => true,
                'text' => \i('Overview')
            ],
            'legend' => [
                'position' => 'right'
            ],
            'scales' => [
                'xAxes' => [
                    0 => [
                        'gridLines' => $grid_lines
                    ]
                ],
                'yAxes' => [
                    0 => [
                        'gridLines' => $grid_lines
                    ]
                ]
            ]
        ]
    ];
    $state_chart_1 = [
        'data' => [
            'labels' => [
                \i('Jan'),
                \i('Feb'),
                \i('Mar'),
                \i('Apr'),
                \i('May'),
                \i('Jun'),
                \i('Jul'),
                \i('Aug'),
                \i('Sep'),
                \i('Oct'),
                \i('Nov'),
                \i('Dec')
            ],
            'datasets' => [
                0 => [
                    'label' => \i('Assets'),
                    'data' => $assets_data,
                    'fill' => true,
                    'backgroundColor' => 'rgba(165, 66, 66, .6)',
                    'borderColor' => 'rgba(165, 66, 66, .9)',
                    'borderWidth' => 1
                ],
                1 => [
                    'label' => \i('Comments'),
                    'data' => $comments_data,
                    'fill' => true,
                    'backgroundColor' => 'rgba(222, 147, 95, .6)',
                    'borderColor' => 'rgba(222, 147, 95, .9)',
                    'borderWidth' => 1
                ],
                2 => [
                    'label' => \i('Pages'),
                    'data' => $pages_data,
                    'fill' => true,
                    'backgroundColor' => 'rgba(140, 148, 64, .6)',
                    'borderColor' => 'rgb(140, 148, 64, .9)',
                    'borderWidth' => 1
                ]
            ],
        ],
        'options' => [
            'responsive' => true,
            'title' => [
                'display' => true,
                'text' => \i('Year %d', $year_current)
            ],
            'scales' => [
                'xAxes' => [
                    0 => [
                        'gridLines' => $grid_lines
                    ]
                ],
                'yAxes' => [
                    0 => [
                        'gridLines' => $grid_lines,
                        'ticks' => [
                            'min' => 0
                        ]
                    ]
                ]
            ]
        ]
    ];
    $_['lot']['desk']['lot']['form']['lot'][1]['lot']['chart-0'] = [
        'type' => 'chart/bar',
        'state' => $state_chart_0,
        'stack' => 10
    ];
    $_['lot']['desk']['lot']['form']['lot'][1]['lot']['chart-1'] = [
        'type' => 'chart/line',
        'state' => $state_chart_1,
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

