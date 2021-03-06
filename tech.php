<?php



?>

<!DOCTYPE html>
<html lang="sk">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Technická dokumentácia</title>
        <link rel="icon" type="image/png" href="img/favicon.png"/>
        <!-- CSS --> 
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css'>  
        <!-- JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <script src="lib/fabric.min.js"></script>
        <script src="lib/jscolor.min.js"></script>
    </head>

    <body>

        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container center">
                <header>
                    <span class="title">Dokumentácia</span>
                </header>
                <div class="container-fluid">
                    <div class="navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                        </li>
                    </ul>
                    <form class="d-flex">
                        <a class="title" href="index.php"><i class="bi bi-arrow-left-square-fill"></i></a>
                    </form>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container page-content">

            <h3 class="part">Technická dokumentácia</h3>
            <h5>Použité JavaScript knižnice:</h5>
            <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>fabric.js</th>
                    <td>v4.4.0</td>
                    <td>Kreslenie na canvas s ukladaním obrázkov vo forme SVG</td>
                </tr>
                <tr>
                    <th>html2pdf.js</th>
                    <td>v0.9.3</td>
                    <td>Export výsledkov do PDF</td>
                </tr>
                <tr>
                    <th>jQuery.js</th>
                    <td>v3.6.0</td>
                    <td>Data handling (Ajax)</td>
                </tr>
                <tr>
                    <th>jscolor.js</th>
                    <td>v2.4.5</td>
                    <td>Výber farieb pri kreslení</td>
                </tr>
                <tr>
                    <th>mathlive.js</th>
                    <td>v0.65.0</td>
                    <td>Vkladanie formátovaných vzorcov pri odpovedi na matematické otázky</td>
                </tr>
                <tr>
                    <th>mathjax.js</th>
                    <td>v3.0</td>
                    <td>Zobrazovanie matematických vzorcov</td>
                </tr>

            </table>
            </div>

            <h5>CSS Štýly:</h5>
            <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Bootstrap</th>
                    <td>v5.0.0</td>
                    <td>Téma Lumen (https://bootswatch.com/lumen/)</td>
                </tr>
            </table>
            </div>

        <h3 class="part">Rozdelenie úloh</h3>
            <div>
            <div class="table-responsive">
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                        <th scope="col">Úloha</th>
                        <th scope="col">Richard Dávidek</th>
                        <th scope="col">Filip Frank</th>
                        <th scope="col">Filip Králik</th>
                        <th scope="col">Viet Quoc Le</th>
                        <th scope="col">Tomáš Singhofer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Prihlasovanie</th>
                            <td></td>
                            <td><i class="bi bi-check-lg"></i></td>
                            <td><i class="bi bi-check-lg"></i></td>
                            <td><i class="bi bi-check-lg"></i></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">Multiple-choice otázka</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><i class="bi bi-check-lg"></i></td>
                            <td><i class="bi bi-check-lg"></i></td>
                        </tr>
                        <tr>
                            <th scope="row">Otázka s krátkou odpoveďou</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><i class="bi bi-check-lg"></i></td>
                            <td><i class="bi bi-check-lg"></i></td>
                        </tr>
                        <tr>
                            <th scope="row">Párovacia otázka</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><i class="bi bi-check-lg"></i></td>
                            <td><i class="bi bi-check-lg"></i></td>
                        </tr>
                        <tr>
                            <th scope="row">Kresliaca otázka</th>
                            <td></td>
                            <td><i class="bi bi-check-lg"></i></td>
                            <td><i class="bi bi-check-lg"></i></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">Matematická otázka</th>
                            <td></td>
                            <td><i class="bi bi-check-lg"></i></td>
                            <td><i class="bi bi-check-lg"></i></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">Vyhodnotenie otázok</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><i class="bi bi-check-lg"></i></td>
                        </tr>
                        <tr>
                            <th scope="row">Ukončenie testu</th>
                            <td></td>
                            <td><i class="bi bi-check-lg"></i></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">Vytváranie testov, ativácia/deaktivácia</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><i class="bi bi-check-lg"></i></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">Info o zbiehaní testov pre učiteľa</th>
                            <td><i class="bi bi-check-lg"></i></td>
                            <td></td>
                            <td></td>
                            <td><i class="bi bi-check-lg"></i></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">Export do PDF</th>
                            <td><i class="bi bi-check-lg"></i></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><i class="bi bi-check-lg"></i></td>
                        </tr>
                        <tr>
                            <th scope="row">Export do CSV</th>
                            <td><i class="bi bi-check-lg"></i></td>
                            <td></td>
                            <td><i class="bi bi-check-lg"></i></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">Docker balíček(pokúsili sme sa)</th>
                            <td>¯\_(ツ)_/¯</td>
                            <td>¯\_(ツ)_/¯</td>
                            <td>¯\_(ツ)_/¯</td>
                            <td>¯\_(ツ)_/¯</td>
                            <td>¯\_(ツ)_/¯</td>
                        </tr>
                        <tr>
                            <th scope="row">Design</th>
                            <td></td>
                            <td></td>
                            <td><i class="bi bi-check-lg"></i></td>
                            <td></td>
                            <td></td>
                        </tr>                     
                        <tr>
                            <th scope="row">Databáza</th>
                            <td><i class="bi bi-check-lg"></i></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><i class="bi bi-check-lg"></i></td>
                        </tr>
                        <tr>
                            <th scope="row">Finalizácia</th>
                            <td></td>
                            <td><i class="bi bi-check-lg"></i></td>
                            <td><i class="bi bi-check-lg"></i></td>
                            <td><i class="bi bi-check-lg"></i></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">BONUS(tablet/ovládanie dotykom)</th>
                            <td></td>
                            <td></td>
                            <td><i class="bi bi-check-lg"></i></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            </div>
        </div>

        <?php include 'footer.php';?>

    </body>
</html>