let last_log_id = 0;
let last_student_id = 0;

const teacherApiUrl = "../php/routes/";

const updateNotifications = (test_key) => {
    $.ajax({
        url: teacherApiUrl + "teacher.php",
        method: "POST",
        data: {
            type: "teacher-test",
            action: "get-notifications",
            last_id: last_log_id,
            test_key,
        },
        dataType: "json",
        success: (data) => {
            data.map((log) => {
                $("#notifications--body").prepend(`
                <tr>
                    <td>${log["id"]}</td>
                    <td>${log["name"]}</td>
                    <td>${log["surname"]}</td>
                    <td>${log["visibility"]}</td>
                    <td>${log["timestamp"]}</td>
                </tr>
                `);

                // Get the latest row id
                last_log_id = parseInt(log[0]) > last_log_id ? parseInt(log[0]) : last_log_id;
            });
        },
        error: (xhr, status, err) => {
            console.log(xhr);
        },
    });
};

const updateStudentsData = (test_key) => {
    $.ajax({
        url: teacherApiUrl + "teacher.php",
        method: "POST",
        data: {
            type: "teacher-test",
            action: "get-students",
            last_id: last_student_id,
            test_key,
        },
        dataType: "json",
        success: (data) => {
            data.map((student) => {
                $("#students--body").append(`
                <tr>
                    <td>${student[0]}</td>
                    <td>${student["name"]}</td>
                    <td>${student["surname"]}</td>
                    <td>${student["completed"]}</td>
                </tr>
                `);

                // Get the latest row id
                last_student_id = parseInt(student[0]) > last_student_id ? parseInt(student[0]) : last_student_id;
            });
        },
        error: (xhr, status, err) => {
            console.log(xhr);
        },
    });
};

const getTestKeys = (e) => {
    $.ajax({
        url: teacherApiUrl + "teacher.php",
        method: "GET",
        data: {
            type: "tests",
            action: "get-test-keys",
        },
        success: (data) => {
            const keys = JSON.parse(data);

            for (const key in keys) {
                // Test Key exists
                if (keys[key][0].toLowerCase() === e.target.value.toLowerCase()) {
                    localStorage.setItem("test_key", "");
                    e.target.classList.add("is-invalid");
                    e.target.classList.remove("is-valid");
                    $("#test_key--invalid").html("Kód testu už existuje");
                    break;
                }
                // Test key is Available
                toggleCreateQuestionButtons("enable");
                localStorage.setItem("test_key", e.target.value);
                e.target.classList.add("is-valid");
                e.target.classList.remove("is-invalid");
            }
        },
    });
};

const submitCreateTest = (formData) => {
    $.ajax({
        url: teacherApiUrl + "teacherCreateTest.php",
        method: "POST",
        data: {
            formData,
        },
        success: (data) => {
            console.log(data);
        },
        error: (xhr, status, err) => {
            console.log(err);
            console.log(xhr);
        },
    });
};

const toggleTestStatus = (event, status, test_key) => {
    let newStatus = status ? 0 : 1;
    console.log(event.target.setAttribute("disabled", "disabled"));
    $.ajax({
        url: teacherApiUrl + "teacher.php",
        method: "POST",
        data: {
            type: "tests",
            action: "toggle-test-status",
            status: newStatus,
            test_key,
        },
        success: (data) => {
            event.target.removeAttribute("disabled");
            location.reload();
        },
        error: (xhr, status, err) => {
            console.log(xhr);
            console.log(status);
            console.log(err);
        },
        timeout: 3000,
    });
};
