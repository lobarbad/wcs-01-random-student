<?php
include('../../_config.php');
include('../function.php');
include('../../class/MyDB.php');
include('../../class/Student.php');
include('../../class/Speeches.php');

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