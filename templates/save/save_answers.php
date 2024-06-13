<?php
include('../db.php');

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if ($data === null) {
    die("Invalid JSON data.");
}

$username = $conn->real_escape_string($data['username']);
$answers = $data['answers'];
$result = $conn->real_escape_string($data['result']);

$sql = "INSERT INTO user_responses (username, question, answer, result) VALUES ";

$values = [];
foreach ($answers as $answer) {
    $question = $conn->real_escape_string($answer[0]);
    $answer_text = $conn->real_escape_string($answer[1]);
    $values[] = "('$username', '$question', '$answer_text', '$result')";
}

$sql .= implode(", ", $values);

if ($conn->query($sql) === TRUE) {
    echo "New records created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
