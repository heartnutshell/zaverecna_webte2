let save = "";

//document.querySelectorAll("math-field").forEach(item => {
    const mf = MathLive.makeMathField(item, {
        onContentDidChange: (mf) => {        
        },
    });
    const mathfield = document.getElementById(item);
//});


//uloženie vzorca
const saveMath = () => {
    document.getElementById('save').addEventListener('click', (e) => {
                save = escapeHtml(mathfield.value); //len na testovanie
                insertMathAnswer(save);
            });
}

//načítanie vzorca
const loadMath = () => {
    document.getElementById('load').addEventListener('click', (e) => {
        mathfield.setValue(save);
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