const initCanvas = (id) => {
    return new fabric.Canvas(id, {
        width: 500,
        height: 500,
        backgroundColor: 'white',
        isDrawingMode: true,
    })
}

function changeColor(id){
    let color = document.getElementById(id+'color');
    canvases[id].freeDrawingBrush.color = color.value;
}

function changeSize(id){
    let size = document.getElementById(id+'size');
    canvases[id].freeDrawingBrush.width = parseInt(size.value, 10);
}

const clearCanvas = (id) => {  
    canvases[id].getObjects().forEach((o) => {
        if(o != canvases[id].backgroundColor) {
            canvases[id].remove(o);
        }
    });
}

const saveDrawing = (id) => {
    drawingSave = canvases[id].toSVG()
    const hidden = document.getElementById(id.split("-")[0]);
    hidden.value = drawingSave;
    //insertDrawAnswer(drawingSave);
}

var canvases = [];
var can_ids = [];

document.querySelectorAll("canvas").forEach(item => {
    const canvas = initCanvas(item.id);
    canvas.on('mouse:up', function(options) {
        saveDrawing(item.id);
      });
    canvases[item.id] = canvas;
    can_ids.push(item.id);
});


can_ids.forEach(item => {
    const picker = document.getElementById(item+'color');
    const slider = document.getElementById(item+'size');
    const clear = document.getElementById(item+'clear');
    picker.addEventListener("change", () => {
        changeColor(item);
    });
    slider.addEventListener("change", () => {
        changeSize(item);
    });
    clear.addEventListener("click", () => {
        clearCanvas(item);
    });
   
})

console.log(canvases);



const loadDrawing = () => { //len na testovanie
    clearCanvas();
    //need to get save from DB
    if(drawingSave) {
        fabric.loadSVGFromString(drawingSave, objects => {
            canvas.add(...objects);
            canvas.requestRenderAll();
        });
    }
}

let drawingSave;
