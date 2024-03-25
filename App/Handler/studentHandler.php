<?php

require_once "../Models/student.php";
require_once "../Core/helpers.php";
require_once "../Core/validations.php";


$student = new student;

if (isset($_POST['add'])){
    $name = $_POST['name'];
    $address = $_POST['address'];

    $check = $student->checkStudentExist($name, $address);

    if (!empty($check)){
        helpers::redirect("../../index.php");die();
    }

    $res = $student->addStudent([
        'name' => $name,
        'address' => $address
    ]);

    helpers::redirect("../../index.php");

}elseif (isset($_POST['update']) && !empty($_POST['id'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];

    $res = $student->updateStudent($id,
    [
        'name' => $name,
        'address' => $address
    ]);

    helpers::redirect("../../index.php");

}elseif (isset($_POST['del']) && !empty($_POST['id'])){
    $id = $_POST['id'];

    $res = $student->deleteStudent($id);

    helpers::redirect("../../index.php");

}else{
    helpers::redirect("../../index.php");
}

