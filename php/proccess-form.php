<?php

$name = $_POST["name"];
$message = $_POST["message"];
$priority = filter_input(INPUT_POST, "priority", FILTER_VALIDATE_INT);
$type = filter_input(INPUT_POST, "type", FILTER_VALIDATE_INT);
$terms = filter_input(INPUT_POST, "terms", FILTER_VALIDATE_BOOLEAN);

if (!$terms) {
    die("Terms must be accepted!");
}

$host = 'localhost';
$dbname = 'message'; // Replace with your actual database name
$username = 'andika';
$password = 'raiden69';

$conn = mysqli_connect($host, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    die("Connection error: " . mysqli_connect_error());
}

$sql = "INSERT INTO message (name, body, priority, type)
        VALUES (?, ?, ?, ?)";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    die("Statement preparation error: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "ssii", $name, $message, $priority, $type);

if (!mysqli_stmt_execute($stmt)) {
    die("Execution error: " . mysqli_error($conn));
}

echo "Record saved.";

mysqli_stmt_close($stmt);
mysqli_close($conn);
