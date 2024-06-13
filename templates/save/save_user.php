<?php
include('../db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    $data = json_decode(file_get_contents('php://input'), true);

    $firstname = $conn->real_escape_string($data['firstname']);
    $lastname = $conn->real_escape_string($data['lastname']);
    $username = $conn->real_escape_string($data['username']);
    $address = $conn->real_escape_string($data['address']);
    $gender=$conn->real_escape_string($data['gender']);
    $phone = $conn->real_escape_string($data['phone']);
    $password = $conn->real_escape_string($data['password']);
    $age = $conn->real_escape_string($data['age']);
    $creater = $conn->real_escape_string($data['creater']);
    $sql = "INSERT INTO patient_register (firstname, lastname, username, address, age,gender, phone, password,created_by) VALUES ('$firstname', '$lastname', '$username', '$address',' $age','$gender', '$phone', '$password','$creater')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success', 'message' => 'User data saved successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error saving user data: ' . $conn->error]);
    }

} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

$conn->close();
?>
