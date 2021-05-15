$(document).ready(() => {
    document.addEventListener("visibilitychange", () => {
        const state = document.visibilityState;
        // TODO Get Student DATA from Sesstion or Storage
        if (state === "hidden") {
            console.log("Visibility Change");
            // Student sa prepol na ine okno
            const test_key = document.querySelector("#test_key").value;
            const student_id = document.querySelector("#student_id").value;
            $.ajax({
                url: "php/routes/teacher.php",
                method: "POST",
                data: {
                    type: "page-visibility",
                    action: "left-tab",
                    test_key,
                    student_id,
                },
            });
        }
    });
});
