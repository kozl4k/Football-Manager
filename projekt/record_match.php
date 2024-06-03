<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = $_POST['result'];
    $goal_scorers = $_POST['goal_scorers'];
    $assists = $_POST['assists'];
    $cards = $_POST['cards'];
    $injuries = $_POST['injuries'];
    $match_date = $_POST['match_date'];

    $sql = "INSERT INTO matches (result, goal_scorers, assists, cards, injuries, match_date) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$result, $goal_scorers, $assists, $cards, $injuries, $match_date]);

    echo "Match result recorded successfully!";
}
?>
<style>
    table{
        border: solid 2px black;
    }
    .submit{
        background-color: blue;
        width: 150px;
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
            <td>Wynik:</td> <td><input type="text" name="result" required></td>
        </tr>
        <tr>
            <td>Strzelcy:</td> <td><input name="goal_scorers"></td>
        </tr>
        <tr>
            <td>Asysty:</td> <td><input name="assists"></td>
        </tr>
        <tr>
            <td>Kartki:</td> <td><input name="cards"></td>
        </tr>
        <tr>
            <td>Kontuzje:</td> <td><input name="injuries"><br>
        </tr>
        <tr>
            <td>Data meczu:</td> <td><input type="date" name="match_date" required></td>
        </tr>
    </table>
    <input type="submit" class="submit" value="Dodaj wynik meczu">
</form>