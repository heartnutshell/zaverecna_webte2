let last_log_id = 0;
let last_student_id = 0;

const teacherApiUrl = "../php/routes/teacher.php";

const updateNotifications = (test_key) => {
    $.ajax({
        url: teacherApiUrl,
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
        url: teacherApiUrl,
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
        url: teacherApiUrl,
        method: "GET",
        data: {
            type: "tests",
            action: "get-test-keys",
        },
        success: (data) => {
            const keys = JSON.parse(data);

            for (key in keys) {
                if (keys[key][0] === e.target.value) {
                    toggleCreateQuestionButtons("disable");
                    localStorage.setItem("test_key", "");
                    e.target.classList.add("is-invalid");
                    e.target.classList.remove("is-valid");
                } else {
                    toggleCreateQuestionButtons("enable");
                    localStorage.setItem("test_key", e.target.value);
                    e.target.classList.add("is-valid");
                    e.target.classList.remove("is-invalid");
                }
            }

            // console.log(keys.hasOwnProperty(e.target.value));
        },
    });
};
