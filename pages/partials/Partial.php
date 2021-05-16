<?php

class Partial
{

    public function createHeader($title)
    {
        $time = time();
        echo "
    <!DOCTYPE html>
    <html lang='en'>

    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <!-- Bootstrap -->
        <link href='../css/bootstrap.min.css' rel='stylesheet'>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css'>
        <!-- CSS -->
        <link href='../css/style.css?v=$time' rel='stylesheet'>
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.15.3/css/all.css'
            integrity='sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk' crossorigin='anonymous'>
        <!-- JS -->
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js'
            integrity='sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8' crossorigin='anonymous'>
        </script>
        <script src='https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js'></script>
        <script src='https://polyfill.io/v3/polyfill.min.js?features=es6'></script>
<script id='MathJax-script' async src='https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js'></script>

        <title>$title</title>
        </head>

    <body>
        <nav class='navbar navbar-dark navbar-expand-lg bg-primary'>
            <div class='container'>
                <span class='title'>Učitel</span>
                <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarColor01' aria-controls='navbarColor01' aria-expanded='false' aria-label='Toggle navigation'>
                    <span class='navbar-toggler-icon'></span>
                </button>
                <div class='collapse navbar-collapse' id='navbarColor01'>
                    <ul class='navbar-nav me-auto'>
                        <li class='nav-item'><a class='nav-link' href='teacher.php'>Prehľad</a></li>
                        <li class='nav-item'><a class='nav-link' href='createTest.php'>Vytvoriť test</a></li>                   
                    </ul>
                    <a class='nav-link logout' href='logout.php'>Odhlásiť <i class='bi bi-box-arrow-right'></i></a>


                </div>
            </nav>

    ";
    }

    public function authenticate()
    {
        require_once __DIR__ . "/../../php/session/Session.php";

        $session = new Session();
        $session->sessionStart(0, "/", "wt100.fei.stuba.sk", true, true);
        if (!isset($_SESSION["isLogged"])) {
            header("Location: ../login.php");
        }
        if ($_SESSION["isLogged"] != true) {
            header("Location: ../login.php");
        }
    }

    public function notAuthorized($title, $page)
    {
        echo "
    <h2>$title</h2>
    <a href='javascript:history.go(-1)'>Späť</a>
    <br>
    <a href='$page.php'>Späť učiteľ home</a>
    ";
    }
}