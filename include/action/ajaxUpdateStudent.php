<?php
include('../../_config.php');
include('../function.php');
include('../../class/MyDB.php');
include('../../class/Student.php');

if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['id'])) {
    $firstname = strip_tags($_POST['firstname']);
    $lastname  = strip_tags($_POST['lastname']);
    $id        = strip_tags($_POST['id']);
    echo $id;
    $student = Student::getByID($id);
    $student
        ->setFirstname(mb_strtolower($firstname))
        ->setLastname(mb_strtolower($lastname))
        ->updateInDB();

}