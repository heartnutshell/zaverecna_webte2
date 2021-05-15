const test_key = document.getElementById("test_key");
const student_id = document.getElementById("student_id");
let time_left = document.getElementById("time_left");
const submit = document.getElementById("submit_test")

var source = new EventSource("php/sse/sse.php?test_key="+test_key.value+"&student_id="+student_id.value);
source.addEventListener('evt', function(e) {
    if (e.data <= 0) {
        $("#submit_test").click();
    }
    let hours = Math.floor(e.data/3600)
    let minutes = Math.floor((e.data - (hours * 3600))/60)
    let seconds = ((e.data - (hours * 3600))) - (minutes*60)
    time_left.innerHTML = hours.toString().padStart(2, "0")+":"+minutes.toString().padStart(2, "0")+
        ":"+seconds.toString().padStart(2, "0")
    if (e.data <= 300) {
        time_left.style.backgroundColor = '#ff4136';
    }
}, false)