<?php
require_once '_config.php';
require_once 'include/_autoload.php';
require_once 'include/function.php';

$list_student  = Student::getAll();
$list_speeches = Speeches::getAll();

include('list-student.php');