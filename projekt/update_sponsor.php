<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $stmt = $pdo->prepare("SELECT * FROM sponsors WHERE id = ?");
    $stmt->execute([$id]);
    $sponsor = $stmt->fetch();
}
?>
<style>
    body{
        background-color:lightblue;
    }
    table{
        border: solid 2px black;
    }
    .submit{
        background-color: blue;
        width: 120px;
    }
    input{
        width: 150px;
    }
    select{
        width: 150px;
    }
</style>
<body>
<form method="POST" action="save_sponsor.php">
    <input type="hidden" name="id" value="<?= $sponsor['id'] ?>">
        <label for="sponsor_name">Nazwa Sponsora:</label>
        <input type="text" id="sponsor_name" name="sponsor_name" required><br><br>
        
        <label for="contract_amount">Kwota Kontraktu:</label>
        <input type="number" step="0.01" id="contract_amount" name="contract_amount" required><br><br>
        
        <input type="submit" class="submit" value="Save sponsor">
</form>