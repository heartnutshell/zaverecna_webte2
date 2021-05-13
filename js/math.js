var mathfields = [];

document.querySelectorAll("math-field").forEach(item => {
    const mf = MathLive.makeMathField(item, {
        onContentDidChange: (mf) => {
        },
    });
    mathfields.push(item.id);
});

mathfields.forEach(item => {
    document.getElementById(item).addEventListener('input', (e) => {
        let id = item.split('-')[1];
            console.log(e.target.value);
            document.getElementById(id).value = escapeHtml(e.target.value);
    })
});



/*//uloženie vzorca
const saveMath = () => {
    document.getElementById('save').addEventListener('click', (e) => {
                save = escapeHtml(document.getElementById('mf').value);
                console.log(save);
                insertMathAnswer(save);              
            });
}*/

//načítanie vzorca
const loadMath = () => {
    document.getElementById('load').addEventListener('click', (e) => {
        document.getElementById('mf').setValue(save);
    });
}

//upravenie latex outputu
function escapeHtml(string) {
    return String(string).replace(/[&<>"'`=/\u200b]/g, function (
        s
    ) {
        return (
            {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;',
                '/': '&#x2F;',
                '`': '&#x60;',
                '=': '&#x3D;',
                '\u200b': '&amp;#zws;',
            }[s] || s
        );
    });
}