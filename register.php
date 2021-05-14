<?php

    require_once 'php/database/DatabaseController.php';

    $db = new DatabaseController;

    try {

        if(isset($_POST['email'])){
            
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $email = $_POST['email'];
            $name = $_POST['name'];
            $surname = $_POST['surname'];

            $result = $db->insertTeacherWithName($email, $password, $name, $surname);

            if($result){
                $message =  "Registrácia úspešná!";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } else {
                $message =  "Registrácia neúspešná!";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        }

    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="sk">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registrácia</title>
        <link rel="icon" type="image/png" href="img/favicon.png" />
        <!-- CSS --> 
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">    
        <!-- JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <script src="lib/fabric.min.js"></script>
        <script src="lib/jscolor.min.js"></script>
    </head>

    <body>

        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <header>
                    <span class="title">Registrácia</span>
                </header>
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                        </li>
                    </ul>
                    <form class="d-flex">
                        <a class="btn btn-secondary my-2 my-sm-0" href="login.php">Späť</a>
                    </form>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container">
            <form
                action="<?php echo $_SERVER['PHP_SELF'] ?>"
                class="needs-validation center"
                method="post"
                enctype="multipart/form-data"
                novalidate
            >
                <fieldset>
                    <div class="form-group">
                        <div class="form-group form-row">
                            <div class="col">
                                <label for="name">Meno*</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    name="name"
                                    pattern="[^()/><\][\\\x22,;|]+"
                                    autocomplete="off"
                                    required
                                />
                            </div>
                            <div class="col">
                                <label for="surname">Priezvisko*</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="surname"
                                    name="surname"
                                    pattern="[^()/><\][\\\x22,;|]+"
                                    autocomplete="off"
                                    required
                                />
                            </div>
                        </div>

                        <label for="email">E-mail*</label>
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            aria-describedby="emailHelp"
                            pattern="^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$"
                            autocomplete="off"
                            required
                        />
                        <small
                            id="emailHelp"
                            class="form-text text-muted"
                        ></small>
                        
                        <div class="form-group">
                            <label for="password">Heslo*</label><small> Minimálne 8 znakov.</small>
                            <input
                                type="password"
                                class="form-control"
                                id="password"
                                name="password"
                                placeholder="Password"
                                minlength="8"
                                autocomplete="off"
                                required
                            />                           
                        </div>

                    </div>
                    <small>*povinné</small><br>
                    <button type="submit" class="btn btn-primary">
                        Registrovať
                    </button>
                </fieldset>
            </form>
        </div>

        <?php include 'footer.php';?>
        <script src="js/validateForm.js"></script>

    </body>
</html>
