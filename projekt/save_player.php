<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $position = $_POST['position'];
    $stats = $_POST['stats'];
    $salary = $_POST['salary'];
    $health = $_POST['health'];

    $sql = "UPDATE players SET name = ?, age = ?, position = ?, stats = ?, salary = ?, health = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $age, $position, $stats, $salary, $health, $id]);

     // Aktualizuj sumę wynagrodzeń
     $stmt = $pdo->query("SELECT SUM(salary) AS total_salary FROM players");
     $row = $stmt->fetch();
     $total_salary = $row['total_salary'];
 
     // Aktualizuj finanse
     $sql = "UPDATE finances SET expenses = ? ORDER BY id DESC LIMIT 1";
     $stmt = $pdo->prepare($sql);
     $stmt->execute([$total_salary]);

    echo "Player updated successfully!";
    header("Location: index.php");
}
?>