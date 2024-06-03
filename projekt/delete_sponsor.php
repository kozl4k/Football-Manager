<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $sql = "DELETE FROM sponsors WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    $stmt = $pdo->query("SELECT SUM(contract_amount) AS total_revenue FROM sponsors");
    $row = $stmt->fetch();
    $total_revenue = $row['total_revenue'];

    // Aktualizuj finanse
    $sql = "UPDATE finances SET revenue = ? ORDER BY id DESC LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$total_revenue]);

    echo "Sponsor deleted successfully!";
    header("Location: index.php");
}
?>