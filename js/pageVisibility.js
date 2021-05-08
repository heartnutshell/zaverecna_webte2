$(document).ready(() => {
    document.addEventListener("visibilitychange", () => {
        const state = document.visibilityState;
        console.log(state);
        if (state === "hidden") {
            // Student sa prepol na ine okno
            // TODO : Pridať zaznam do DB

            $.ajax({
                url: "../php/routes/activity.php",
                method: "POST",
                data: {
                    action: "left-tab",
                    test_key: "OS2021",
                    student_id: 11111,
                },
                success: (data) => {
                    console.log(data);
                },
            });
        } else if (state === "visible") {
            $.ajax({
                url: "../php/routes/activity.php",
                method: "POST",
                data: {
                    action: "enter-tab",
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
