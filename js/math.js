const mf = MathLive.makeMathField('mf', {
    onContentDidChange: (mf) => {
        const latex = mf.getValue();
        document.getElementById('latex').value = latex;
    },
});

document.getElementById('latex').addEventListener('input', (ev) => {
    mf.setValue(ev.target.value);
});

document
        .getElementById('save')
        .addEventListener('click', (ev) => {
            console.log(document.getElementById('latex'));
        });
/*¯\_(ツ)_/¯*/