    // キャッシュ対策のためjsを切り出す
    const unitNumberDom = document.querySelectorAll('sup');

    if (unitNumberDom.length > 0) {
        unitNumberDom.forEach(dom => {
            dom.style.fontSize = '0.5em';
        });
    }