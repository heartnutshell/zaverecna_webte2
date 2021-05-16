<?php

require_once __DIR__ . '/php/session/Session.php';

$session = new Session();
$session->sessionStart(0, "/", "wt100.fei.stuba.sk", true, true);

require_once __DIR__ . '/php/database/DatabaseController.php';

$db = new DatabaseController;

if (isset($_POST['email']) && isset($_POST['password'])) {

    //hladanie účta v DB
    try {

        $email = $_POST['email'];

        $result = $db->getTeacherByEmail($email);

        if ($result == NULL) {
            $message = "Neznámy email!";
            echo "<script type='text/javascript'>alert('$message');</script>";
        } else {
            //overenie správnosti hesla
            $password = $_POST['password'];

            if (password_verify($password, $result[0]['password'])) {

                $_SESSION["isLogged"] = true;
                $_SESSION["teacher_id"] = $result[0]["id"];
                $_SESSION["teacher_name"] = $result[0]["name"];
                $_SESSION["teacher_surname"] = $result[0]["surname"];
                header("Location: pages/teacher.php");
            } else {
                if ($user_found = 1) {

                    $message = "Nesprávne heslo!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="sk">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prihlásenie</title>
    <link rel="icon" type="image/png" href="img/favicon.png" />
    <!-- CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="lib/fabric.min.js"></script>
    <script src="lib/jscolor.min.js"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <header>
                <span class="title">Učitel</span>
            </header>
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                        </li>
                    </ul>
                    <form class="d-flex">
                        <a class="btn btn-secondary my-2 my-sm-0" href="index.php">Späť</a>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container page-content">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form-row other-center">
            <div class="form-group col">
                <label for='email'>E-mail</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="" required />
            </div>
            <div class="form-group col">
                <label for='password'>Heslo</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                    required />
            </div>
            <div class="form-group col"></br>
                <input class="btn btn-primary" type="submit" value="Prihlásiť sa"><br>
                <span>Pre vytvorenie nového konta učitela kliknite </span><a href="register.php">tu</a><span>.</span>
            </div>
        </form>
    </div>

    <?php include 'footer.php'; ?>

</body>

</html>