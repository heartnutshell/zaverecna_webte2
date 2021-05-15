<?php



require_once __DIR__ . "/partials/Partial.php";
require_once __DIR__ . "/../php/database/DatabaseController.php";
require_once __DIR__ . "/../php/questions/CreateQuestion.php";

$partial = new Partial();

// Check if user is logged, otherwise redirect to Login page
$partial->authenticate();

["teacher_id" => $teacher_id, "teacher_name" => $name, "teacher_surname" => $surname] = $_SESSION;

// $createQ = new CreateQuestion();
$db = new DatabaseController();

// Creating Header
$partial->createHeader("Učiteľ | Home");

// Fetch Teacher's tests
$tests = $db->getAllTeacherTests($teacher_id);

?>

<main class="container page-content">

    <section>
        <h4 class="part">Informácie o konte</h4>
        <p><?= "ID : $teacher_id <br> Meno : $name <br>Priezvisko : $surname"; ?></p>
    </section>

    <section>
        <h4 class="part">Moje testy</h4>

        <?php if (count($tests) == 0) : ?>

        <h6>Žiadne testy</h6>

        <?php else : ?>
        <table class="table table-hover">

            <thead>
                <tr>
                    <th scope="col">Kód testu</th>
                    <th scope="col">Časový limit</th>
                    <th scope="col">Max bodov</th>
                    <th scope="col">Status</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($tests as $key => $test) : ?>
                <tr>

                    <td><?= $test["test_key"]; ?></td>
                    <td><?= $test["time_limit"]; ?></td>
                    <td><?= $test["max_points"]; ?></td>

                    <?php if ($test["active"]) : ?>
                    <td class="test active"><?= $test["active"] ?> </td>
                    <?php else : ?>
                    <td class="test not-active"><?= $test["active"] ?></td>
                    <?php endif; ?>

                    <td>
                        <a href="testOverview.php?test_key=<?= $test["test_key"] ?>">
                            <i class="bi bi-nut"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>

            </tbody>
        </table>

        <?php endif; ?>
    </section>


</main>
<?php include '../footer.php';?>
</body>

</html>