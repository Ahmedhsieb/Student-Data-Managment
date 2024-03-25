<?php

if (
    (file_exists("../Database/db.php") && is_readable("../Database/db.php") && include_once("../Database/db.php")))
{
    include_once "../Database/db.php";
}else {
    include_once "App/Database/db.php";

}

class student extends db
{
    public function getStudentById($id){
        return $this->select("*", "students")->where("id", "=", $id)->getRow();
    }

    public function getStudentList(){
        return $this->select("*", "students")->getAll();
    }

    public function checkStudentExist($name, $address){
        return $this->select("*", "students")
            ->where("name", "=", "'$name'")
            ->andWhere("address", "=", $address)->getRow();
    }

    public function addStudent($data){
        return $this->insert("students", $data)->execute();
    }

    public function deleteStudent($id){
        return $this->delete("students")->where("id", "=", $id)->execute();
    }

    public function updateStudent($id, $data){
        return $this->update("students", $data)->where("id", "=", $id)->execute();
    }
}