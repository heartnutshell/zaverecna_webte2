<?php

class Partial
{

    function createHeader($title)
    {
        echo "
    <!DOCTYPE html>
    <html lang='en'>

    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <!-- Bootstrap -->
        <link href='css/bootstrap.min.css' rel='stylesheet'>
        <!-- JS -->
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js' integrity='sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8' crossorigin='anonymous'></script>
        <script src='https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js'></script>

        <title>$title</title>
    </head>

    <body>
        <nav>
            <ul>
                <li><a href='teacher.php'>Home</a></li>
                <li><a href='createTest.php'>Vytvoriť test</a></li>
                <li><a href='student.php'>Student</a></li>
            </ul>
        </nav>
    </body>
    ";
    }
}