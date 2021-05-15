let cards = document.querySelectorAll("card-body");
let canvass = document.querySelectorAll("canvas");

function resizeCanvas() {
    canvass.forEach( item => {
        
    })
}



cards.forEach( item => {
    item.addEventListener("resize", resizeCanvas, false);
});