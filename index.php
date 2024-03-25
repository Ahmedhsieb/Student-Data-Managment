<?php
    require_once "App/Models/student.php";

    $student = new student;

    $all_students = $student->getStudentList();

    if (isset($_GET['id'])){
        $student_data = $student->getStudentById($_GET['id']);
    }


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link type="text/css" href="Assets/main.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>

    <div id="container">
        <form action="App/Handler/studentHandler.php" method="post">
            <aside>
                <div id="div">
                    <img width="200px" src="Assets/logo2.jpg" alt="logo">

                    <h3>Dashboard</h3>

                    <label>Student Name:</label><br>
                    <input type="text" name="name"
                       <?php if (!empty($student_data)): ?>
                            value="<?=$student_data['name']?>"
                       <?php endif; ?>
                    ><br>

                    <label>Student Address:</label><br>
                    <input type="text" name="address"
                        <?php if (!empty($student_data)): ?>
                            value="<?=$student_data['address']?>"
                        <?php endif; ?>
                    ><br>

                    <input type="hidden" name="id"
                        <?php if (!empty($student_data)): ?>
                            value="<?=$student_data['id']?>"
                        <?php endif; ?>
                    >

                    <button name="add">Add</button>
                    <button name="update">Update</button>
                    <button name="del">Delete</button>
                </div>
            </aside>
            <main>
                <table id="tbl">
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Student Address</th>
<!--                        <th>Update</th>-->
                    </tr>

                    <?php
                    if (!empty($all_students)):
                        foreach ($all_students as $index => $student): ?>

                                <tr>
                                    <td><a href="index.php?id=<?= $student['id']?>"><?= $index + 1?> </a></td>
                                    <td><?= $student['name']?></td>
                                    <td><?= $student['address']?></td>
                                </tr>

                    <?php
                        endforeach;
                    endif;
                    ?>

                </table>
            </main>
        </form>
    </div>

</body>
</html>