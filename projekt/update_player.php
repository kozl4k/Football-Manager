<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $stmt = $pdo->prepare("SELECT * FROM players WHERE id = ?");
    $stmt->execute([$id]);
    $player = $stmt->fetch();
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
        background-color: #f0f0f0;
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
<form method="POST" action="save_player.php">
    <input type="hidden" name="id" value="<?= $player['id'] ?>">
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
    <input type="submit" class="submit" value="Save">
</form>
</body>