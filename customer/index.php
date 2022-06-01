<?php

include_once "../inc.db.php";
include_once "functions.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //The form submit button has been pressed
    if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["phone"])) {
        //All fields have a value

        //Check if a field has a value
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];

        //Check if field is empty
        if (empty($name) or empty($email) or empty($phone)) {
            $warning = "Alle velden zijn verplicht!";
        } else {
            //If not empty, add to table
            $id = createCustomer($pdo, $name, $email, $phone);
            //echo $id;
            if (is_numeric($id)) {
                $succes = "Klant met succes toegevoegd! <br>";
            } else {
                $error = "Daar ging wat fout" . $id . "<br>";
            }
        }
    }
}

//Remove customer
if (isset($_GET["delete"])) {
    $id = $_GET["delete"];

    $del = deleteCustomer($pdo, $id);
    if (is_numeric($del)) {
        $succes = "Klant met succes verwijderd!<br>";
    } else {
        $error = "Daar ging wat fout" . $del . "<br>";
    }
}

$customers = customerList($pdo);

//var_dump($customers);
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Klanten</title>
</head>
<body>

<center>
    <h1>Restaurant Excellent Taste</h1>
    <p>
    <h2><a href="../Home.php">Home</a> I <a href="../index.php">Resevering</a> I <b>Klanten</b></h2>
    </p>
</center>

<div class="container-fluid">
    <?php
    if (isset($warning)) {
        ?>
        <div class="alert alert-warning" role="alert">
            <?= $warning ?>
        </div>
        <?php
    }
    ?>
    <?php
    if (isset($succes)) {
        ?>
        <div class="alert alert-success" role="alert">
            <?= $succes ?>
        </div>
        <?php
    }
    ?>
    <?php
    if (isset($error)) {
        ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
        <?php
    }
    ?>
    <div class="row">
        <div class="col-md-6">
            <!--            <form method="post" action="index.php">-->
            <!--                Name:   <input type="text" name="name"><br>-->
            <!--                Email:  <input type="text" name="email"><br>-->
            <!--                Phone:  <input type="text" name="phone"><br>-->
            <!--                <input type="submit" value="Add new customer">-->
            <!--            </form>-->

            <form method="post" action="index.php">
                <div class="row mb-3">
                    <label for="inputname" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" id="inputname">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputemail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" name="email" class="form-control" id="inputemail">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputphone" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="text" name="phone" class="form-control" id="inputphone">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Add new customer</button>
            </form>
        </div>
        <div class="col-md-6">
            <table class="table">
                <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>email</th>
                    <th>phone</th>
                    <th>actions</th>
                </tr>
                </thead>
                <body>
                <?php
                foreach ($customers as $c) {
                    ?>
                    <tr>
                        <td> <?= $c["id"] ?></td>
                        <td> <?= $c["name"] ?></td>
                        <td> <?= $c["email"] ?></td>
                        <td> <?= $c["phone"] ?></td>
                        <td><a class="btn btn-warning" href="edit.php?id=<?= $c["id"] ?>">edit</a> I <a class="btn btn-danger" href="index.php?delete=<?= $c["id"] ?>">delete</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </body>
            </table>
        </div>
    </div>
</div>

<hr>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

</body>
</html>