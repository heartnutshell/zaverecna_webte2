let last_log_id = 0;
let last_student_id = 0;

const updateNotifications = (test_key) => {
    $.ajax({
        url: "../php/routes/teacher.php",
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
                last_log_id = log[0] > last_log_id ? log[0] : last_log_id;
            });
        },
        error: (xhr, status, err) => {
            console.log(xhr);
        },
    });
};

const updateStudentsData = (test_key) => {
    $.ajax({
        url: "../php/routes/teacher.php",
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
                last_student_id = student[0] > last_student_id ? student[0] : last_student_id;
            });
        },
        error: (xhr, status, err) => {
            console.log(xhr);
        },
    });
};
