<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $exercises = $_POST['exercises'];
    $intensity = $_POST['intensity'];
    $schedule = $_POST['schedule'];

    $sql = "INSERT INTO trainings (name, exercises, intensity, schedule) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $exercises, $intensity, $schedule]);

    echo "Training plan added successfully!";
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
            <td>Nazwa:</td> <td><input type="text" name="name" required></td>
        </tr>
        <tr>
            <td>Ćwiczenia:</td> <td><input name="exercises"></td>
        </tr>
        <tr>    
            <td>Intensywność:</td><td><select name="intensity">
                                    <option value="bardzo mała">Bardzo mała</option>
                                    <option value="mała">Mała</option>
                                    <option value="średnia">Średnia</option>
                                    <option value="duża">Duża</option>
                                    <option value="bardzo duża">Bardzo duża</option>
                                </select></td> 
        </tr>
        <tr>
            <td>Data:</td> <td><input type="date" name="schedule" required></td>
        </tr> 
    </table>
        <input type="submit" class="submit" value="Add Training Plan">
</form>
