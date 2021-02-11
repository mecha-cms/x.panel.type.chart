<?php namespace _\lot\x\panel\type;

function chart(array $value, $key) {
    extract($GLOBALS, \EXTR_SKIP);
    $id = 'chart:' . $key;
    $state = $value['state'] ?? [];
    $rgba = static function($hex, $a = 1) {
        if (!$hex) {
            return 'rgba(0, 0, 0, ' . $a . ')';
        }
        $v = \sscanf($hex, '#%02x%02x%02x');
        return 'rgba(' . $v[0] . ', ' . $v[1] . ', ' . $v[2] . ', ' . $a . ')';
    };
    if (isset($value['legend'])) {
        $legend = $value['legend'];
        if (false === $legend) {
            $state['options']['legend']['display'] = false;
        } else {
            if (!empty($legend['side'])) {
                $state['options']['legend']['position'] = $legend['side'];
            }
            if (!empty($legend['skip'])) {
                $state['options']['legend']['display'] = false;
            }
        }
    }
    if (!empty($value['grid'])) {
        $grid = (array) $value['grid'];
        foreach ($grid as $k => $v) {
            $state['options']['scales']['yAxes'][$k]['ticks']['maxTicksLimit'] = $v;
        }
    }
    if (!empty($value['lot'])) {
        $tension = 'chart/radar' === $value['type'] ? 0 : 0.4;
        foreach ($value['lot'] as $k => $v) {
            $color = (array) ($v['color'] ?? "");
            $colors = $v['colors'] ?? [];
            $state['data']['datasets'][] = [
                'backgroundColor' => \count($colors) ? \map($colors, function($color) use(&$rgba) {
                    $color = (array) $color;
                    return $rgba($color[0], $color[1] ?? .6);
                }) : $rgba($color[0], $color[1] ?? .6),
                'borderColor' => \count($colors) ? \map($colors, function($color) use(&$rgba) {
                    $color = (array) $color;
                    return $rgba($color[0], $color[1] ?? .9);
                }) : $rgba($color[0], $color[1] ?? .9),
                'borderWidth' => $v['border'] ?? 1,
                'data' => $v['values'] ?? $v['value'] ?? null,
                'fill' => !empty($v['fill']),
                'label' => \i(...((array) ($v['title'] ?? \To::title($k)))),
                'lineTension' => $v['tension'] ?? $tension
            ];
        }
    }
    if (isset($value['max'])) {
        $max = (array) $value['max'];
        foreach ($max as $k => $v) {
            $state['options']['scales']['yAxes'][$k]['ticks']['max'] = $v;
        }
    }
    if (isset($value['min'])) {
        $min = (array) $value['min'];
        foreach ($min as $k => $v) {
            $state['options']['scales']['yAxes'][$k]['ticks']['min'] = $v;
        }
    }
    if (!empty($value['set'])) {
        foreach ($value['set'] as $v) {
            if (\is_array($v) && isset($v[0]) && false === \strpos($v[0], '%')) {
                $state['data']['labels'][] = \map($v, function($vv) {
                    return \i(...((array) $vv));
                });
                continue;
            }
            $state['data']['labels'][] = \i(...((array) $v));
        }
    }
    if (isset($value['step'])) {
        $step = (array) $value['step'];
        foreach ($step as $k => $v) {
            $state['options']['scales']['yAxes'][$k]['ticks']['stepSize'] = $v;
        }
    }
    if (!empty($value['title'])) {
        $state['options']['title'] = [
            'display' => true,
            'text' => \i(...((array) $value['title']))
        ];
    }
    if (!empty($state['options'])) {
        $state['options']['responsive'] = true;
    }
    $_['asset']['script'][$id] = [
        'id' => false,
        'content' => "new Chart('" . $id . "'," . \json_encode((object) \array_replace([
            // This key was added only to force this script data to refresh on every F3H change event
            'hash' => \uniqid()
        ], $state)) . ");",
        'stack' => 20.1
    ];
    $GLOBALS['_'] = $_;
    $out = [
        0 => $value[0] ?? 'div',
        1 => $value[1] ?? '<canvas id="' . $id . '"></canvas>',
        2 => $value[2] ?? []
    ];
    \_\lot\x\panel\_set_class($out[2], \array_replace([
        'lot' => true,
        'lot:chart' => true,
        'chart:' . ($value['state']['type'] ?? 'line') => true
    ], $value['tags'] ?? []));
    return new \HTML($out);
}

require __DIR__ . \DS . 'type' . \DS . 'chart.php';
