<!DOCTYPE html>
<html lang="fr-FR" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width,initial-scale=1.0,shrink-to-fit=no"/>
        <title></title>
        <meta name="description" content=""/>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <div id="cache"></div>
        <div id="box-wrapper">
        </div>
        <header><h1>Tour de parole</h1></header>
        <div id="wrapper">
            <section id="draw">
                <h2>Tirage au sort d'un étudiant</h2>
                <button onclick="randomDraw(this);">Tirage au sort</button>
            </section>
            <section id="crew">
                <h2>L'équipe</h2>
                <form method="post" >
                    <span class="error-field"></span>
                    <label for="firstname">Prénom&nbsp;:</label>
                    <input type="text" id="firstname" name="firstname" onchange="checkDatas(this,'le prénom','name');" autocomplete="off"/>
                    <label for="lastname">Nom&nbsp;:</label>
                    <input type="text" id="lastname" name="lastname" onchange="checkDatas(this,'le nom','name');" autocomplete="off"/>
                    <button id="save" onclick="saveStudent(); return false;">Ajouter</button>
                </form>
            </section>
            <table id="list-student">
                <thead>
                    <tr>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Intervention</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($list_student as $student) {
                        ?>
                        <tr>
                            <td><?= mb_ucfirst($student->getFirstname()); ?></td>
                            <td><?= mb_ucfirst($student->getLastname()); ?></td>
                            <td><?= $countSpeeches = Speeches::countSpeechesStudentID($student->getStudentID()); ?></td>
                            <td>
                                <button class="action edit" onclick="updateStudent(<?= $student->getStudentID(); ?>,'<?=$student->getFirstname()?>','<?=$student->getLastname(); ?>');"></button>
                            </td>
                            <td>
                                <button class="action remove"
                                        onclick="removeStudent(<?= $student->getStudentID(); ?>);"></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
                <section id="list-speeches">
                    <h2>Interventions</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Prénom</th>
                                <th>Nom</th>
                                <th>Date</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($list_speeches as $speech) {
                                $studentID    = $speech->getStudentID();
                                $student      = Student::getByID($studentID);
                                $dateComplete = explode(' ',$speech->getDate());
                                $date         = $dateComplete[0];
                                $time         = $dateComplete[1];
                                ?>
                                <tr>
                                    <td><?= mb_ucfirst($student->getFirstname()); ?></td>
                                    <td><?= mb_ucfirst($student->getLastname()); ?></td>
                                    <td><?= $date ?></td>
                                    <td><?= $time ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </section>
        </div>
        <footer>
            Loïc BARBADO
        </footer>
        <script src="js/function.js"></script>
    </body>
</html>