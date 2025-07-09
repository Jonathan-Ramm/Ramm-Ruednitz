<div name="Score">
<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['Hs'])) {
  include'autoraten/load_high.php';
  $_SESSION['Hs'] = $_SESSION['HsDB']; 
}
if (!isset($_SESSION['actScore'])) {
        $_SESSION['actScore'] = 0;
}
?>

</div>
<div id="homeB">
    <form action="https://www.ramm-ruednitz.de" method="get">
        <button type="submit" class="home-button">Home</button>
    </form>
</div>
<div id="top-left">
    <div name="profil">
        <div class="profile-button-container" style="z-index: 100;">
            <button id="profile-button" onclick="toggleButtons()"><?php if($_SESSION['username'] != ""){echo $_SESSION['username'];}else{echo "Unbekannter";}; ?></button>
            <div id="dropdown-buttons" class="hidden">
                <button class="dropdown-button" onclick="settings()">Einstellungen</button>
                <button class="dropdown-button" onclick="int()">Interessantes</button>
                <button class="dropdown-button" onclick="logout()">Logout</button>
            </div>
        </div>
    <div id="highscore">
            <p>Dein Highscore: <?php echo $_SESSION['Hs']; ?></p>
    </div>
    <div id="actscore">
            <p>Dein aktueller Score: <?php echo $_SESSION['actScore']; ?></p>
    </div>
</div>
<script>
function int(){
    window.location.href = "interessantes.php"
}
function settings(){
    window.location.href = "einstellungen.php";
}
function logout() {
    window.location.href = "logout.php";
  }

function toggleButtons() {
    var dropdown = document.getElementById('dropdown-buttons');
    if (dropdown.classList.contains('hidden')) {
        dropdown.classList.remove('hidden');
    } else {
        dropdown.classList.add('hidden');
    }
}
</script>
</div> 