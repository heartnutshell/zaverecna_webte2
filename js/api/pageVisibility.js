$(document).ready(() => {
    document.addEventListener("visibilitychange", () => {
        const state = document.visibilityState;
        // TODO Get Student DATA from Sesstion or Storage
        if (state === "hidden") {
            // Student sa prepol na ine okno
            $.ajax({
                url: "../php/routes/teacher.php",
                method: "POST",
                data: {
                    type: "page-visibility",
                    action: "left-tab",
                    test_key: "OS2021",
                    student_id: 11111,
                },
                success: (data) => {
                    console.log(data);
                },
            });
        }
    });
});
