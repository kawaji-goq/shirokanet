    // キャッシュ対策㝮㝟ゝjsを切り出㝙
    const unitNumberDom = document.querySelectorAll('sup');

    if (unitNumberDom.length > 0) {
        unitNumberDom.forEach(dom => {
            dom.style.fontSize = '0.5em';
        });
    }