<?php namespace x\panel\type\chart;

function bar(array $value, $key) {
    $value['state']['type'] = 'bar';
    return \x\panel\type\chart($value, $key);
}

function bubble(array $value, $key) {
    $value['state']['type'] = 'bubble';
    return \x\panel\type\chart($value, $key);
}

function doughnut(array $value, $key) {
    $value['state']['type'] = 'doughnut';
    return \x\panel\type\chart($value, $key);
}

function line(array $value, $key) {
    $value['state']['type'] = 'line';
    return \x\panel\type\chart($value, $key);
}

function pie(array $value, $key) {
    $value['state']['type'] = 'pie';
    return \x\panel\type\chart($value, $key);
}

function polar_area(array $value, $key) {
    $value['state']['type'] = 'polarArea';
    return \x\panel\type\chart($value, $key);
}

function radar(array $value, $key) {
    $value['state']['type'] = 'radar';
    return \x\panel\type\chart($value, $key);
}

function scatter(array $value, $key) {
    $value['state']['type'] = 'scatter';
    return \x\panel\type\chart($value, $key);
}