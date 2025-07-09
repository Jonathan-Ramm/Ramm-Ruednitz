<?php if (session_status() === PHP_SESSION_NONE) {
    session_start();
} include("../UI/Highscore+.php") ?>
<?php
if (!isset($_SESSION['actScore'])) {
    $_SESSION['actScore'] = 0; // oder ein anderer Initialwert
}

if (!isset($_SESSION['Hs'])) {
    $_SESSION['Hs'] = 0; // oder ein anderer Initialwert
    include 'load_high.php';
}
if ($_SESSION['Hs'] < $_SESSION['HsDB']) {
    $_SESSION['Hs'] = $_SESSION['HsDB'];
}

if (!isset($_SESSION['Try'])) {
    $_SESSION['Try'] = 0; // oder ein anderer Initialwert
    include 'load_try.php';
}
if ($_SESSION['Try'] < $_SESSION['TryDB']) {
    $_SESSION['Try'] = $_SESSION['TryDB'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'addscore':
                $_SESSION['actScore'] += 1;
                if ($_SESSION['actScore'] > $_SESSION['Hs']) {
                    $_SESSION['Hs'] = $_SESSION['actScore'];
                    include 'save_high.php';
                }
                break;
            case 'fail':
                $_SESSION['actScore'] = 0;
                break;
        }
    }

    // Unabhängig vom Ergebnis Versuch hochzählen:
    if (isset($_POST['addTry']) && $_POST['addTry'] === 'true') {
        $_SESSION['Try'] += 1;
        include 'save_try.php';
    }

    exit();
}

?>


<!DOCTYPE html>
<html lang="de">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">

    <title>Random Image</title>
    <script>
        function fetchRandomImage() {
            fetch('get_random_image.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        console.error('Error:', data.error);
                    } else {
                        document.getElementById('random-image').src = "Bilder/" + data.image_url || 'fallback-image.jpg';
                        document.getElementById('random-image').setAttribute('data-image-name', data.name);
                    }
                })
                .catch(error => console.error('Error fetching image:', error));
        }

        function checkInput() {
            const userInput = document.getElementById('image-name').value;
            const imageName = document.getElementById('random-image').getAttribute('data-image-name');
            const correct = (userInput.toLowerCase().replace(/ /g, "") === imageName.toLowerCase().replace(/ /g, ""));

            if (correct) {
                alert('Richtig! Die Eingabe stimmt mit dem Namen des Bildes \u00FCberein.');
                updateScoreAndTry('addscore');
            } else {
                alert('Falsch! Die Eingabe stimmt nicht mit dem Namen des Bildes \u00FCberein. Der korrekte Name ist: ' + imageName + " deine eingabe war: " + userInput);
                updateScoreAndTry('fail');
            }
        }

        function updateScoreAndTry(scoreAction) {
            const formData = new FormData();
            formData.append('action', scoreAction);
            formData.append('addTry', 'true'); // Signalisiere auch einen Versuch

            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(() => {
                location.reload();
            });
        }

        function handleKeyPress(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                checkInput();
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("image-name").addEventListener("keypress", handleKeyPress);
        });


        window.onload = fetchRandomImage();
    </script>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Gib den Namen des Autos ein</h1>
    <img id="random-image" src="" alt="Random Image" style="width: auto; height: 500px;">
    <form>
        <label for="image-name">Name des Autos:</label>
        <input autofocus autocomplete="off" type="text" id="image-name">
        <button type="button" onclick="checkInput()">&Uuml;berpr&uuml;fen</button>
    </form>    
</body>
</html>
