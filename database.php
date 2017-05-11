<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myregistration";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql="CREATE DATABASE IF NOT EXISTS myregistration";
    $conn->exec($sql);
    $sql="use myregistration";
    $conn->exec($sql);
    // sql to create table
    $sql = "CREATE TABLE IF NOT EXISTS r_elements (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    gender boolean,
    password VARCHAR(20);
    )";
    $conn->exec($sql);
    $sql="use r_elements";
    $conn->exec($sql);
    $sql="INSERT INTO r_elements(firstname,lastname,email,gender,password)VALUES(:firstName, :lastName, :email, :gender, :password1)";
    $conn->exec($sql);
    
    echo "Table MyGuests created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?> 
