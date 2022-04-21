<?php
include_once(__DIR__ . '/../../bootstrap.php');

$email = $_REQUEST["q"];

$conn = DB::getConnection();
$statement = $conn->prepare("select email from Users where email = :email");
$statement->bindValue("email", htmlspecialchars($email));
$statement->execute();
$results = $statement->fetchAll();;
if (count($results) > 0) {
    //var_dump($results);
    echo "this email is already in use";
} else {
    echo "email available";
}