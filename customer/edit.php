<?php
include_once "../inc.db.php";
include_once "functions.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    //Post pressed
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone'])) {
        //All fields are set
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $id = $_GET['id'];

        //Check if fields are empty
        if (empty($name) OR empty($email) OR empty($phone)) {
            echo "All fields are required!";
        } else {
            //All fields are filled
            $update = updateCustomer($pdo, $id,$name, $email, $phone);
            //echo $id;
            if (is_numeric($update)) {
                echo "Customer succesfully changed.<br>";
            } else {
                echo "Something went wrong: " . $id . "<br>";
            }
        }
    }
}

if(isset($_GET["id"])){
    $id = $_GET["id"];

    $c = readCustomer($pdo, $id);
    //var_dump($c);
}

?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Klant wijzigen</title>
</head>

<center>
    <h1>Restaurant Excellent Taste</h1>
    <p>
    <h2><a href="../Home.php">Home</a> I <a href="../index.php">Resevering</a> I <a href="index.php">Klanten</a></h2>
    </p>
</center>

<form method="post" action="edit.php?id=<?= $id ?>">
    Name: <input type="text" name="name" value="<?= $c['name'] ?>"><br>
    Email: <input type="text" name="email" value="<?= $c['email'] ?>"><br>
    Phone: <input type="text" name="phone" value="<?= $c['phone'] ?>"><br>
    <input type="submit" value="Save">
</form>