<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style1.css">
    <title>Football manager</title>
</head>
<body>
    <div id="con">
        <?php 
            include_once "db.php"
        ?>
        <div id="listaAkcji">
                
            <div class='przycisk'><button onclick="changeSite(0)">Dodaj zawodnika</button></div>
            <div class='przycisk'><button onclick="changeSite(1)">Finanse</button></div>
            <div class='przycisk'><button onclick="changeSite(2)">Plan treningowy</button></div>
            <div class='przycisk'><button onclick="changeSite(3)">Mecze</button></div>
            <div class='przycisk'><button onclick="changeSite(4)">Sponsorzy</button></div>
            
        </div>

        <div id="prawy">
            <?php
                include 'dashboard.php';
            ?>
        </div>

        <iframe id="embedded-site"></iframe>

    </div>
    <script src="script1.js"></script>
</body>
</html>