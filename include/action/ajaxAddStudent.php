<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root . '_config.php';
require_once $root . 'include/function.php';
require_once $root . 'class/MyDB.php';
require_once $root . 'class/Student.php';

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