<?php
include('../../_config.php');
include('../function.php');
include('../../class/MyDB.php');
include('../../class/Student.php');
include('../../class/Speeches.php');

$list_student = Student::getAll();
$display      = '';
foreach ($list_student as $student) {
    $countSpeeches = Speeches::countSpeechesStudentID($student->getStudentID());
    $display .= '
                    <tr>
                        <td>' . mb_ucfirst($student->getFirstname()) . '</td>
                        <td>' . mb_ucfirst($student->getLastname()) . '</td>
                        <td>' . $countSpeeches . '</td>
                        <td><button class="action edit" onclick="updateStudent('.$student->getStudentID().',\''.$student->getFirstname().'\',\''.$student->getLastname().'\');"></button></td>
                        <td><button class="action remove" onclick="removeStudent('.$student->getStudentID().');"></button></td>
                    </tr>';
}
echo $display;
