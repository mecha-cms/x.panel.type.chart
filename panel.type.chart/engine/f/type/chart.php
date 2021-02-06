<?php namespace _\lot\x\panel\type\chart;

function bar(array $value, $key) {
    $value['state']['type'] = 'bar';
    return \_\lot\x\panel\type\chart($value, $key);
}

function bubble(array $value, $key) {
    $value['state']['type'] = 'bubble';
    return \_\lot\x\panel\type\chart($value, $key);
}

function doughnut(array $value, $key) {
    $value['state']['type'] = 'doughnut';
    return \_\lot\x\panel\type\chart($value, $key);
}

function line(array $value, $key) {
    $value['state']['type'] = 'line';
    return \_\lot\x\panel\type\chart($value, $key);
}

function pie(array $value, $key) {
    $value['state']['type'] = 'pie';
    return \_\lot\x\panel\type\chart($value, $key);
}

function polar_area(array $value, $key) {
    $value['state']['type'] = 'polarArea';
    return \_\lot\x\panel\type\chart($value, $key);
}

function radar(array $value, $key) {
    $value['state']['type'] = 'radar';
    return \_\lot\x\panel\type\chart($value, $key);
}

function scatter(array $value, $key) {
    $value['state']['type'] = 'scatter';
    return \_\lot\x\panel\type\chart($value, $key);
}
