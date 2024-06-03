<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $budget = $_POST['budget'];
    
    $stmt = $pdo->query("SELECT SUM(contract_amount) AS total_revenue FROM sponsors");
    $row = $stmt->fetch();
    $revenue = $row['total_revenue'];

    // Oblicz wydatki jako sumę wynagrodzeń zawodników
    $stmt = $pdo->query("SELECT SUM(salary) AS total_salary FROM players");
    $row = $stmt->fetch();
    $expenses = $row['total_salary'];

    // Aktualizuj finanse
    $sql = "INSERT INTO finances (budget, revenue, expenses) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$budget, $revenue, $expenses]);

    echo "Finances updated successfully!";
    
}
?>
<style>
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
<form method="POST">
    <table><tr>
    <td>Budget:</td> <td><input type="number" step="0.01" name="budget" required><br></td>
    </tr>
    </table>
    <!-- Wydatki i zarobki są automatycznie obliczane i nie wymagają wejścia od użytkownika -->
    <input type="submit" class="submit" value="Update Finances">
</form>
<br>
<h3>Finanse są obliczane automatycznie z przychodu ze sponsorow i z wydatków na pensje zawodników</h3>