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

<form method="post" action="edit.php?id=<?= $id ?>">
    Name: <input type="text" name="name" value="<?= $c['name'] ?>"><br>
    Email: <input type="text" name="email" value="<?= $c['email'] ?>"><br>
    Phone: <input type="text" name="phone" value="<?= $c['phone'] ?>"><br>
    <input type="submit" value="Save">
</form>