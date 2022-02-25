<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root . '_config.php';
require_once $root . 'include/function.php';
require_once $root . 'class/MyDB.php';
require_once $root . 'class/Student.php';
require_once $root . 'class/Speeches.php';

$list_speeches = Speeches::getAll();
$display = '';
foreach ($list_speeches as $speech) {
    $studentID    = $speech->getStudentID();
    $student      = Student::getByID($studentID);
    $dateComplete = explode(' ', $speech->getDate());
    $date         = $dateComplete[0];
    $time         = $dateComplete[1];
    $display      .= '
                    <tr>
                        <td>' . mb_ucfirst($student->getFirstname()) . '</td>
                        <td>' . mb_ucfirst($student->getLastname()) . '</td>
                        <td>' . $date . '</td>
                        <td>' . $time . '</td>
                    </tr>';
}
echo $display;