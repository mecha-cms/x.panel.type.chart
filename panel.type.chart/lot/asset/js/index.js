(function(win, doc, $) {
    let root = doc.documentElement;
    function getStyle(key, node) {
        return win.getComputedStyle(node || root).getPropertyValue(key);
    }
    let color = getStyle('color'),
        colorBorder = getStyle('border-color') || getStyle('border-top-color') || getStyle('border-right-color') || getStyle('border-bottom-color') || getStyle('border-left-color') || color,
        fontFamily = getStyle('font-family'),
        fontSize = win.parseFloat(getStyle('font-size')),
        fontStyle = getStyle('font-style'),
        lineHeight = win.parseFloat(getStyle('line-height'));
    Object.assign(Chart.defaults.global, {
        defaultColor: color,
        defaultFontColor: color,
        defaultFontFamily: fontFamily,
        defaultFontSize: fontSize,
        defaultFontStyle: fontStyle,
        defaultLineHeight: lineHeight / fontSize,
    });
    Chart.defaults.scale.gridLines.borderDash = [3, 1];
    Chart.defaults.scale.gridLines.color = colorBorder;
    Chart.defaults.scale.gridLines.zeroLineColor = colorBorder;
    Chart.platform.disableCSSInjection = true;
    // <https://stackoverflow.com/a/37089126>
    Chart.scaleService.defaults.radialLinear.ticks.backdropColor = 'rgba(0,0,0,0)';
    function onChange() {
        let charts = doc.querySelectorAll('.lot\\:chart canvas');
        charts.length && charts.forEach(chart => {
            let state = JSON.parse(chart.textContent);
            chart.textContent = "";
            new Chart(chart, state || {});
        });
    } onChange();
    $.on('change', onChange);
})(window, document, _);