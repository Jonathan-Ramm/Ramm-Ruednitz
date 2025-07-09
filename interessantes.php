<?php session_start()?>
<?php include("UI/Highscore+.php") ?>
<script>
  var Username = $_SESSION[username].user_login.php;
  document.getElementById('Username') = Username;
</script>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Interessantes</title>
    <style>
        canvas {
            background-color: #202020;
            display: block;
            margin: 0 auto;
        }
        table {
          table-layout: fixed; /* sorgt für gleiche Spaltenbreite */
        }
    </style>

</head>
<h1>Hier gibt es Interessante Fakten zu dieser Website</h1>
<p>Die aktuelle Anzahl an Eintr&auml;gen betr&auml;gt:   <?php echo $_SESSION['Count']; ?> </p>

<table>
  <thead>
    <tr>
      <th>Machine Learning</th>
      <th>Fang den Button</th>
      <th>Quiz</th>
      <th>Morse Geheimnis</th>
    </tr>
  </thead>
  <tbody>
  <tr>
    <td>
      <p>Das Projekt diente zum ausprobieren und kennenlernen von neuralen Netzwerken. Es erkennt Zahlen im gezeichneten Fenster aktuell noch mit einem lokal laufendne Python Programm. Es ist trainiert mit der MNIST Datenbank. Dadurch, dass es lokal l&auml;uft funktioniert es aktuell noch nicht f&uuml;r Aussenstehende.</p>
    </td>
    <td>
      <p>Das Projekt diente zum kennenlernen von Events, Zeitsteuerung und ein ganz einfacher Alert.</p>
    </td>
    <td>
      <p>Dieses Projekt diente zum kennenlernen von der fetch Funktion und der zuf&auml;lligen Sortierung von json Dateien</p>
    </td>
    <td>
      <p>Das ist einfach nur eine kleine Spielerei, weil ich Morse Code sehr mag. 😁</p>
    </td>
  </tr>
  <tr>
    <td><form action="interessantes/ml.php" method="get">  <button type="submit">Hier lang!</button>  </form></td>
    <td><form action="interessantes/spiele.php" method="get">  <button type="submit">Hier lang!</button>  </form></td>
    <td><form action="interessantes/quiz.php" method="get">  <button type="submit">Hier lang!</button>  </form></td>
    <td><button id="playButton">Ausprobieren</button></td>
  </tr>
  </tbody>
</table>




<canvas id="heartCanvas" width="800" height="800"></canvas>
    
<script name="Herz Zeichnung">
        const canvas = document.getElementById("heartCanvas");
        const ctx = canvas.getContext("2d");
        const centerX = canvas.width / 2;
        const centerY = canvas.height / 2;
        function hearta(k) {
            return 15 * Math.sin(k) ** 3;
        }
        function heartb(k) {
            return (
                12 * Math.cos(k) -
                5 * Math.cos(2 * k) -
                2 * Math.cos(3 * k) -
                Math.cos(4 * k)
            );
        }
        let i = 0;
        function drawHeart() {
            if (i === 0) {
                ctx.beginPath();
            }

            const x = hearta(i / 100) * 20;
            const y = -heartb(i / 100) * 20; 

            ctx.fillStyle = "red";
            ctx.lineWidth = 2;
            ctx.lineTo(centerX + x, centerY + y);
            ctx.fill();
            

            i++;

            // Animation fortsetzen, solange wir noch Punkte haben
            if (i < 6000) {
                requestAnimationFrame(drawHeart);
            } else {
                ctx.closePath(); // Herzform abschließen
            }
        }

        drawHeart(); // Animation starten
</script>
<script name="EMMA Morse CODE">


  const morseCode = "- .- -.-- .- / .. .-.. -.. / .... . .- .-. -";

  // settings
  const dotDuration = 100;
  const dashDuration = dotDuration * 3;
  const frequency = 500; //Hz

  function playTone(duration) {
    const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
    const oscillator = audioCtx.createOscillator();
    const gainNode = audioCtx.createGain();

    oscillator.type = "sine"; // Tone type
    oscillator.frequency.setValueAtTime(frequency, audioCtx.currentTime);
    oscillator.connect(gainNode);
    gainNode.connect(audioCtx.destination);

    oscillator.start();
    setTimeout(() => {
      oscillator.stop();
    }, duration);
  }

  function playMorseCode() {
    const symbols = morseCode.split("");
    let currentTime = 0;

    symbols.forEach((symbol) => {
      if (symbol === ".") {
        setTimeout(() => playTone(dotDuration), currentTime);
        currentTime += dotDuration + dotDuration; // Add pause after short
      } else if (symbol === "-") {
        setTimeout(() => playTone(dashDuration), currentTime);
        currentTime += dashDuration + dotDuration; // Add pause after long
      } else if (symbol === " ") {
        currentTime += dotDuration * 7; // Space between letters
      }
    });
  }

  document.getElementById("playButton").addEventListener("click", playMorseCode);
</script>   