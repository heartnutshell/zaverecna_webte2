const initCanvas = (id) => {
    return new fabric.Canvas(id, {
        width: 500,
        height: 500,
        backgroundColor: 'white',
        isDrawingMode: true,
    })
}

const clearCanvas = () => {  
    canvas.getObjects().forEach((o) => {
        if(o != canvas.backgroundColor) {
            canvas.remove(o);
        }
    });
}

const saveDrawing = () => {
    drawingSave = canvas.toSVG()
    //need to save into DB
}

const loadDrawing = () => {
    clearCanvas();
    //need to get save from DB
    if(drawingSave) {
        fabric.loadSVGFromString(drawingSave, objects => {
            canvas.add(...objects);
            canvas.requestRenderAll();
        });
    }
}

const canvas = initCanvas('drawHere');
const picker = document.getElementById('colorPicker');
const slider = document.getElementById('sizeSlider');
let drawingSave;

//set brush color
picker.onchange = function() {
    canvas.freeDrawingBrush.color = this.value;
}

//set brush size
slider.onchange = function() {
    canvas.freeDrawingBrush.width = parseInt(this.value, 10);
}