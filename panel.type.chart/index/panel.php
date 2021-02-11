<?php

$path = stream_resolve_include_path(__DIR__ . DS . '..' . DS . 'lot' . DS . 'asset');
$z = defined('DEBUG') && DEBUG ? '.' : '.min.';

$_['asset']['panel.type.chart:0'] = [
    'id' => false,
    'path' => $path . DS . 'css' . DS . 'index' . DS . 'chart' . $z . 'css',
    'stack' => 20.1
];

$_['asset']['panel.type.chart:1'] = [
    'id' => false,
    'path' => $path . DS . 'js' . DS . 'index' . DS . 'chart' . $z . 'js',
    'stack' => 20.1
];

$_['asset']['panel.type.chart:2'] = [
    'id' => false,
    'path' => $path . DS . 'css' . DS . 'index' . $z . 'css',
    'stack' => 20.2
];

$_['asset']['panel.type.chart:3'] = [
    'id' => false,
    'path' => $path . DS . 'js' . DS . 'index' . $z . 'js',
    'stack' => 20.2
];
