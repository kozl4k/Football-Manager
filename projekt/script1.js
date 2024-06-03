sites = [
    "add_player.php",
    "manage_finances.php",
    "plan_training.php",
    "record_match.php",
    "add_sponsor.php"
    
];
changeSite(0);

function changeSite(siteID) {
    var site = document.getElementById("embedded-site");
    site.setAttribute("src",sites[siteID]);
}