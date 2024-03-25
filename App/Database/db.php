<?php

class db
{

    public $connection;
    public $sql;
    public $query;

    public function __construct()
    {
        $this->connection = mysqli_connect(
            "localhost",
            "root",
            "Ahmed@123@",
            "student_management"
        );
    }

    public function select($selector, $table)
    {
        $this->sql = "SELECT $selector FROM `$table`";
        return $this;
    }

    public function getAll()
    {
        $this->query();
        while ($row = mysqli_fetch_assoc($this->query)){
            $data[] = $row;
        }
        return $data ?? null;
    }

    public function getRow()
    {
        $this->query();
        $row = mysqli_fetch_assoc($this->query);
        return $row;
    }

    public function where($key, $compare, $value)
    {
        $this->sql .= " WHERE $key $compare $value";
        return $this;
    }

    public function orWhere($key, $compare, $value)
    {
        $this->sql .= " OR `$key` $compare '$value'";
        return $this;
    }

    public function andWhere($key, $compare, $value)
    {
        $this->sql .= " AND `$key` $compare '$value'";
        return $this;
    }

    public function join($tablename, $column1, $column2)
    {
        $this->sql .= " INNER JOIN $tablename ON $column1 = $column2";
//         echo $this->sql;die;
        return $this;
    }

    public function insert($table, $data)
    {
        $data = $this->prepareData($data);
        $this->sql = "INSERT INTO `$table` SET $data";
        return $this;
    }

    public function update($table, $data)
    {
        $data = $this->prepareData($data);
        $this->sql = "UPDATE `$table` SET $data";
        return $this;
    }

    public function delete($table)
    {
        $this->sql = "DELETE FROM `$table`";
        return $this;
    }

    public function prepareData($data)
    {
        $row = "";
        foreach($data as $key => $value){
            $row .= " `$key` = " . ((gettype($value) == 'string') ? "'$value'" : "$value") . ",";
        }
        $row = rtrim($row,",");
        return  $row;
    }

    public function query()
    {
//        echo $this->sql;die;

        $this->query = mysqli_query($this->connection, $this->sql);
    }

    public function execute()
    {
        $this->query();
        if(mysqli_affected_rows($this->connection) > 0){
            return true;
        }else{
             $this->showError();
        }
    }

    public function showError()
    {
        $errors = mysqli_error_list($this->connection);
        foreach($errors as $error){
            echo "<h2 style='color:red'>Error</h2> : ".$error['error']."<br> <h3 style='color:red'>Error Code : </h3>".$error['errno'];
        }
    }
    public function __destruct()
    {
        mysqli_close($this->connection);
    }

}