<?php

$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root . '_config.php';
require_once $root . 'include/function.php';
require_once $root . 'class/MyDB.php';
require_once $root . 'class/Student.php';
require_once $root . 'class/Speeches.php';

if (isset($_POST['id'])) {
    $id      = strip_tags($_POST['id']);
    $student = Student::getByID($id);
    $student->deleteInDB();
    $list_student = Student::getAll();
    $display      = '';
    foreach ($list_student as $student) {
        $countSpeeches = Speeches::countSpeechesStudentID($student->getStudentID());
        $display .= '
                    <tr>
                        <td>' . mb_ucfirst($student->getFirstname()) . '</td>
                        <td>' . mb_ucfirst($student->getLastname()) . '</td>
                        <td>' . $countSpeeches . '</td>
                        <td><button class="action edit"></button></td>
                        <td><button class="action remove" onclick="removeStudent('.$student->getStudentID().');"></button></td>
                    </tr>';
    }
    echo $display;
}