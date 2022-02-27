<?php
include('../../_config.php');
include('../function.php');
include('../../class/MyDB.php');
include('../../class/Student.php');

if (isset($_POST['firstname']) && isset($_POST['lastname'])) {
    $firstname = strip_tags($_POST['firstname']);
    $lastname  = strip_tags($_POST['lastname']);
    $student   = new Student();
    $student
        ->setFirstname(mb_strtolower($firstname))
        ->setLastname(mb_strtolower($lastname))
        ->createInDB();
echo $firstname;
}