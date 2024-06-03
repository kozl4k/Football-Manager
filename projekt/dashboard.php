<?php
require 'db.php';

// Fetch data from the database
$players = $pdo->query("SELECT * FROM players")->fetchAll();
$finances = $pdo->query("SELECT * FROM finances ORDER BY id DESC LIMIT 1")->fetch();
$sponsors = $pdo->query("SELECT * FROM sponsors")->fetchAll();
$matches = $pdo->query("SELECT * FROM matches")->fetchAll();
$trainings = $pdo->query("SELECT * FROM trainings")->fetchAll();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Football Manager Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Football Manager Dashboard</h1>

    <h2>Zawodnicy</h2>
    <table border="1">
        <tr>
            
            <th>Nazwa zawodnika</th>
            <th>Wiek</th>
            <th>Pozycja</th>
            <th>Statystyki</th>
            <th>Wynagrodzenie</th>
            <th>Zdrowie</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($players as $player): ?>
        <tr>
            
            <td><?= $player['name'] ?></td>
            <td><?= $player['age'] ?></td>
            <td><?= $player['position'] ?></td>
            <td><?= $player['stats'] ?></td>
            <td><?= $player['salary'] ?></td>
            <td><?= $player['health'] ?></td>
            <td>
                
                <form method="POST" action="update_player.php" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $player['id'] ?>">
                    <input type="submit" value="Update">
                </form>
                <form method="POST" action="delete_player.php" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $player['id'] ?>">
                    <input type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this player?');">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Sponsorzy</h2>
    <table border="1">
            <tr>
                
                <th>Nazwa sponsora</th>
                <th>Kwota</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($sponsors as $sponsor): ?>
            <tr>
                
                <td><?= $sponsor['sponsor_name'] ?></td>
                <td><?= $sponsor['contract_amount'] ?></td>
                <td>
                    <form method="POST" action="update_sponsor.php" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $sponsor['id'] ?>">
                    <input type="submit" value="Update">

                    <form method="POST" action="delete_sponsor.php" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $sponsor['id'] ?>">
                    <input type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this sponsor?');">
                </form></td>
            </tr>
            <?php endforeach; ?>
    </table>

    <h2>Wyniki Meczy</h2>
    <table border="1">
            <tr>
                
                <th>Wynik</th>
                <th>Strzelcy</th>
                <th>Asysty</th>
                <th>Kartki</th>
                <th>Kontuzje</th>
                <th>Data Meczu</th>
            </tr>
            <?php foreach ($matches as $match): ?>
            <tr>
                
                <td><?= $match['result'] ?></td>
                <td><?= $match['goal_scorers'] ?></td>
                <td><?= $match['assists'] ?></td>
                <td><?= $match['cards'] ?></td>
                <td><?= $match['injuries'] ?></td>
                <td><?= $match['match_date'] ?></td>
            </tr>
            <?php endforeach; ?>
    </table>

    <h2>Treningi</h2>
    <table border="1">
            <tr>
                
                <th>Nazwa treningu</th>
                <th>Ćwiczenia</th>
                <th>Intensywność treningu</th>
                <th>Data</th>
    
            </tr>
            <?php foreach ($trainings as $training): ?>
            <tr>
                
                <td><?= $training['name'] ?></td>
                <td><?= $training['exercises'] ?></td>
                <td><?= $training['intensity'] ?></td>
                <td><?= $training['schedule'] ?></td>
                
            </tr>
            <?php endforeach; ?>
    </table>


    <h2>Podsumowanie Finansów</h2>

    <p>Wykres pokazuje się tuż po dodaniu pierwszego zawodnika, sponsora lub po dodaniu budgetu.</p>
    <canvas id="financesChart"></canvas>
    <script>
        var ctx = document.getElementById('financesChart').getContext('2d');
        var financesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Budget', 'Przychody', 'Wydatki'],
                datasets: [{
                    label: 'Amount',
                    data: [
                        <?= $finances['budget'] ?>,
                        <?= $finances['revenue'] ?>,
                        <?= $finances['expenses'] ?>
                    ],
                    backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)'],
                    borderColor: ['rgba(75, 192, 192, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    
</body>
</html>