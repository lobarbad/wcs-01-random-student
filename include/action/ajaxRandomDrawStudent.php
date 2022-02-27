<?php
include('../../_config.php');
include('../function.php');
include('../../class/MyDB.php');
include('../../class/Student.php');
include('../../class/Speeches.php');


$list_student  = Student::getAll();
$list_speeches = Speeches::getAll();
$max           = Speeches::maxCount();
$drawList      = [];
foreach ($list_student as $student) {
    $id            = $student->getStudentID();
    $countSpecches = Speeches::countSpeechesStudentID($id);
    if ($countSpecches < $max) {
        array_push($drawList, $id);
    } else {
        $max = $countSpecches;
    }
}
if (empty($drawList)) $drawList = Student::getAllStudentID();
$randomID  = array_rand($drawList);
$student   = Student::getByID($drawList[$randomID]);
$studentID = $student->getStudentID();
$firstname = $student->getFirstname();
$lastname = $student->getLastname();
$date      = date("Y-m-d H:i");
$speech    = new Speeches();
$speech
    ->setStudentID($studentID)
    ->setDate($date)
    ->createInDB();
echo mb_ucfirst($firstname).' '.mb_ucfirst($lastname);


