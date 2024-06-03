<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $sql = "DELETE FROM players WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    $stmt = $pdo->query("SELECT SUM(salary) AS total_salary FROM players");
    $row = $stmt->fetch();
    $total_salary = $row['total_salary'];

    // Aktualizuj finanse
    $sql = "UPDATE finances SET expenses = ? ORDER BY id DESC LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$total_salary]);

    echo "Player deleted successfully!";
    header("Location: index.php");
}
?>