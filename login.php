<?php

require_once 'php/database/DatabaseController.php';

$db = new DatabaseController;

if(isset($_POST['email']) && isset($_POST['password'])){

    //hladanie účta v DB
    try {
            
        $email = $_POST['email'];

        $result = $db->getTeacherByUsername($email);

        if ($result == NULL){
            $message = "Neznámy email!";
            echo "<script type='text/javascript'>alert('$message');</script>";
        } else {
            //overenie správnosti hesla
            $password = $_POST['password'];
            if(password_verify($password, $result[0]['password'])){       
                
                session_start();
                //pridať vytvorenie session -> interface pre učitela

            } else{
                if($user_found = 1){
                    $message = "Nesprávne heslo!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
            }
        }
    
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    } 
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

        <div class="container">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form-row">                 
                <div class="form-group col">                       
                    <input
                        type="text"
                        class="form-control"
                        id="email"
                        name="email"
                        placeholder=""
                        required
                    />
                </div>
                <div class="form-group col">            
                    <input
                        type="password"
                        class="form-control"
                        id="password"
                        name="password"
                        placeholder="Password"
                        required
                    />
                </div>
                <div class="form-group col">
                    <input class="btn btn-primary" type="submit" value="Prihlásiť sa">                        
                </div>               
            </form>      
        </div>

    </body>
</html>