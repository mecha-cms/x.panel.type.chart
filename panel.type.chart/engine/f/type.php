<?php namespace _\lot\x\panel\type;

function chart(array $value, $key) {
    extract($GLOBALS, \EXTR_SKIP);
    $id = 'chart:' . $key;
    $path = \stream_resolve_include_path(__DIR__ . \DS . '..' . \DS . '..' . \DS . 'lot' . \DS . 'asset');
    $z = \defined("\\DEBUG") && \DEBUG ? '.' : '.min.';
    if (!isset($_['asset']['panel.type.chart:0'])) {
        $_['asset']['panel.type.chart:0'] = [
            'id' => false,
            'path' => $path . \DS . 'css' . \DS . 'index' . \DS . 'chart' . $z . 'css',
            'stack' => 20.1
        ];
    }
    if (!isset($_['asset']['panel.type.chart:1'])) {
        $_['asset']['panel.type.chart:1'] = [
            'id' => false,
            'path' => $path . \DS . 'js' . \DS . 'index' . \DS . 'chart' . $z . 'js',
            'stack' => 20.1
        ];
    }
    if (!isset($_['asset']['panel.type.chart:2'])) {
        $_['asset']['panel.type.chart:2'] = [
            'id' => false,
            'path' => $path . \DS . 'css' . \DS . 'index' . $z . 'css',
            'stack' => 20.2
        ];
    }
    if (!isset($_['asset']['panel.type.chart:3'])) {
        $_['asset']['panel.type.chart:3'] = [
            'id' => false,
            'path' => $path . \DS . 'js' . \DS . 'index' . $z . 'js',
            'stack' => 20.2
        ];
    }
    $_['asset']['script'][$id] = [
        // Generate random ID so that this script will always be up to date
        'id' => \State::get('x.panel.fetch') ? 'f3h:' . \uniqid() : false,
        'content' => 'Chart.instances' . (\preg_match('/^[a-z_$][\w$]*$/i', $id) ? '.' . $id : "['" . $id . "']") . "=new Chart('" . $id . "'," . \json_encode((object) ($value['state'] ?? [])) . ");",
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
