<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $position = $_POST['position'];
    $stats = $_POST['stats'];
    $salary = $_POST['salary'];
    $health = $_POST['health'];

    $sql = "INSERT INTO players (name, age, position, stats, salary, health) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $age, $position, $stats, $salary, $health]);

    $stmt = $pdo->query("SELECT SUM(salary) AS total_salary FROM players");
    $row = $stmt->fetch();
    $total_salary = $row['total_salary'];

    // Aktualizuj finanse
    $sql = "UPDATE finances SET expenses = ? ORDER BY id DESC LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$total_salary]);

    echo "Player added successfully!";
    
}
?>
<style>
    table{
        border: solid 2px black;
    }
    .submit{
        background-color: blue;
        width: 80px;
    }
    input{
        width: 150px;
    }
    select{
        width: 150px;
    }
</style>
<form method="POST">
    <table>
    <tr>
        <td>Imię:</td> 
        <td><input type="text" name="name" required></td>
    </tr>
    <tr>
        <td>Wiek:</td> 
        <td><input type="number" min="1" max="99" name="age" required></td>
    </tr>
    <tr>
        <td>Pozycja:</td> 
        <td><select name="position">
            <option value="napastnik">Napastnik</option>
            <option value="pomocnik">Pomocnik</option>
            <option value="obrońca">Obrońca</option>
            <option value="bramkarz">Bramkarz</option>
</select></td>
    </tr>
    <tr>
        <td>Statystyki:</td> 
        <td><input type="number" min="1" max="99" name="stats"></input></td>
    </tr>
    <tr>
        <td>Wypłata:</td> 
        <td><input type="number"  name="salary"></input></td>
    </tr>
    <tr>    
        <td>Zdrowię:</td> 
        <td><select name="health">
            <option value="zdrowy">Zdrowy</option>
            <option value="kontuzja">Kontuzja</option>
        </select></td>
    </tr>
    </table>
    <input type="submit" class="submit" value="Add Player">
</form>