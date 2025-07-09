<?php if (session_status() === PHP_SESSION_NONE) {
    session_start();
}?>
<?php include("../UI/Highscore+.php") ?>
<script>
  var Username = $_SESSION[username].user_login.php;
  document.getElementById('Username') = Username;
</script>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Fang den Knopf</title>
    <style>#knopf {position: absolute;} #top-left {opacity: 0;}</style>
</head>
<div id="Spiel">
    <button id="knopf">Fang mich doch!</button>
</div>

<script>
    const button = document.getElementById("knopf");
    let punkte = 0;

    function moveButton() {
      const x = Math.random() * (window.innerWidth - 100);
      const y = Math.random() * (window.innerHeight - 50);
      button.style.left = `${x}px`;
      button.style.top = `${y}px`;
    }

    button.addEventListener("click", () => {
      punkte++;
      moveButton();
    });

    moveButton();

    setTimeout(() => {
      alert(`Zeit vorbei! Punkte: ${punkte}`);
      button.disabled = true;
      location.reload();
    }, 15000); // 15 Sekunden
  </script>
</html>
    