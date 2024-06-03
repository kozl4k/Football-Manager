<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $sponsor_name = $_POST['sponsor_name'];
    $contract_amount = $_POST['contract_amount'];
    

    $sql = "UPDATE sponsors SET sponsor_name = ?, contract_amount = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$sponsor_name, $contract_amount,  $id]);

     // Aktualizuj sumę wynagrodzeń
     $stmt = $pdo->query("SELECT SUM(contract_amount) AS total_revenue FROM sponsors");
     $row = $stmt->fetch();
     $total_revenue = $row['total_revenue'];
 
     // Aktualizuj finanse
     $sql = "UPDATE finances SET revenue = ? ORDER BY id DESC LIMIT 1";
     $stmt = $pdo->prepare($sql);
     $stmt->execute([$total_revenue]);

    echo "Sponsor updated successfully!";
    header("Location: index.php");
}
?>