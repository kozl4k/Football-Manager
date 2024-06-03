<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sponsor_name = $_POST['sponsor_name'];
    $contract_amount = $_POST['contract_amount'];

    // Dodaj sponsora do bazy danych
    $sql = "INSERT INTO sponsors (sponsor_name, contract_amount) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$sponsor_name, $contract_amount]);

    // Aktualizuj sumę przychodów
    $stmt = $pdo->query("SELECT SUM(contract_amount) AS total_revenue FROM sponsors");
    $row = $stmt->fetch();
    $total_revenue = $row['total_revenue'];

    $sql = "UPDATE finances SET revenue = ? ORDER BY id DESC LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$total_revenue]);

    // Przekieruj z powrotem do formularza lub do strony z finansami
    
    header("Location: add_sponsor.php");
}
?>
<style>
        .submit{
        background-color: blue;
        width: 120px;
    }
</style>

    <h1>Dodaj Sponsora</h1>
    <form method="POST" action="add_sponsor.php">
        <label for="sponsor_name">Nazwa Sponsora:</label>
        <input type="text" id="sponsor_name" name="sponsor_name" required><br><br>
        
        <label for="contract_amount">Kwota Kontraktu:</label>
        <input type="number" step="0.01" id="contract_amount" name="contract_amount" required><br><br>
        
        <input type="submit" class="submit" value="Dodaj Sponsora">
    </form>
