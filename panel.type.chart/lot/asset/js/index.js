(function(win, doc) {
    let root = doc.documentElement;
    function getStyle(key, node) {
        return win.getComputedStyle(node || root).getPropertyValue(key);
    }
    Object.assign(Chart.defaults.global, {
        defaultColor: getStyle('color'),
        defaultFontColor: getStyle('color'),
        defaultFontFamily: getStyle('font-family'),
        defaultFontSize: win.parseInt(getStyle('font-size'), 10),
        defaultFontStyle: getStyle('font-style')
    });
    Chart.instances = {};
    Chart.platform.disableCSSInjection = true;
})(window, document);
