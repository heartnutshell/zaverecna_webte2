const insertMathAnswer = (mathAnswer) => {
 
    $.ajax({
        url:"../../php/routes/studentAnswers.php",
        method:"POST",
        data:{
            action:"insertMathAnswer",
            answer: mathAnswer,
        },
        success: (data) => {
            console.log(data);
        },
        error: (xhr, status, err) => {
            console.log(xhr);
        },
    })   
}

const insertDrawAnswer = (drawAnswer) => {

    $.ajax({
        url:"../../php/routes/studentAnswers.php",
        method:"POST",
        data:{
            action:"insertDrawAnswer",
            answer: drawAnswer,
        },
        success: (data) => {
            console.log(data);
        },
        error: (xhr, status, err) => {
            console.log(xhr);
        },
    }) 
}

const getDrawing = (drawAnswer) => {

    $.ajax({
        url:"../../php/routes/studentAnswers.php",
        method:"GET",
        data:{
            action:"getDrawAnswer",
            answer: drawAnswer,
        },
        success: (data) => {
            console.log(data);
            clearCanvas();
            if(data) {
                fabric.loadSVGFromString(data, objects => {
                    canvas.add(...objects);
                    canvas.requestRenderAll();
                });
            }
            
        },
        error: (xhr, status, err) => {
            console.log(xhr);
        },
    })   
}

const getMath = (mathAnswer) => {

    $.ajax({
        url:"../../php/routes/studentAnswers.php",
        method:"GET",
        data:{
            action:"getMathAnswer",
            answer: mathAnswer,
        },
        success: (data) => {
            console.log(data);
            mathfield.setValue(data);
            
        },
        error: (xhr, status, err) => {
            console.log(xhr);
        },
    })  
}