let save = "";

const mf = MathLive.makeMathField('mf', {
    onContentDidChange: (mf) => {        
    },
});

const mathfield = document.getElementById('mf');

//uloženie vzorca
document.getElementById('save').addEventListener('click', (e) => {
            save = escapeHtml(mathfield.value); //len na testovanie
            insertMathAnswer(save);
        });

//načítanie vzorca
document.getElementById('load').addEventListener('click', (e) => {
    mathfield.setValue(save);
});

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