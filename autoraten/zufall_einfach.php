<?php if (session_status() === PHP_SESSION_NONE) {
    session_start();
} include("../UI/Highscore+.php") ?>
<?php
if (!isset($_SESSION['actScoreU'])) {
    $_SESSION['actScoreU'] = 0; // oder ein anderer Initialwert
}

if (!isset($_SESSION['HsU'])) {
    $_SESSION['HsU'] = 0; // oder ein anderer Initialwert
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'addscore') {
        $_SESSION['actScoreU'] += 1;
        if ($_SESSION['actScoreU'] > $_SESSION['HsU']) {
            $_SESSION['HsU'] = $_SESSION['actScoreU'];
        }
    } elseif (isset($_POST['action']) && $_POST['action'] === 'fail') {
        $_SESSION['actScoreU'] = 0;
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Random Image</title>
    <style>
    #tableContainer {
        width: 100%;
        max-height: 300px;
        overflow-y: auto;
        border: 1px solid #ccc;
    }
    </style>

</head>
<body>
    <h1>Gib den Namen des Autos ein</h1>
    <img id="random-image" src="" alt="Random Image" style="width: auto; height: 500px;">
    <form>
        <label for="nameInput">Name des Autos:</label>
        <input placeholder="Wie hei&szlig;t das Auto?" onkeyup="getInput()" autofocus autocomplete="off" type="text" id="nameInput">
        <button type="button" onclick="checkInput()">&Uuml;berpr&uuml;fen</button>
    </form>  

    <div id="tableContainer">    
        <table id="resultTable" border="1">
            <thead>
                <tr>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
                <!-- Ergebnisse werden hier eingefügt -->
            </tbody>
        </table>
    </div>
</body>
</html>


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
                        document.getElementById('random-image').setAttribute('data-nameInput', data.name);
                    }
                })
                .catch(error => console.error('Error fetching image:', error));
        }

        function checkInput() {
            var userInput = document.getElementById('nameInput').value;
            var imageName = document.getElementById('random-image').getAttribute('data-nameInput');

            if ((userInput.toLowerCase().replace(/ /g, "")) == (imageName.toLowerCase().replace(/ /g, ""))) {
                alert('Richtig! Die Eingabe stimmt mit dem Namen des Bildes \u00FCberein.');
                updateScore('addscore');

            } else {
                alert('Falsch! Die Eingabe stimmt nicht mit dem Namen des Bildes \u00FCberein. Der korrekte Name ist: ' + imageName + " deine eingabe war: " + userInput);
                updateScore('fail');
            }
        }

        function updateScore(action) {
            var formData = new FormData();
            formData.append('action', action);

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
            document.getElementById("nameInput").addEventListener("keypress", handleKeyPress);
        });

        function getInput(){
            const searchInput = document.querySelector("#nameInput")
            searchInput.addEventListener("input", (e) => {
                console.log(e.target.value)                             
            })
        };

    $(document).ready(function() {
    $('#nameInput').on('input', function(e) {
        var name = e.target.value;
        console.log("AJAX-Aufruf mit Name:", name); // Debugging

        $.ajax({
            url: 'get_all.php',
            type: 'GET',
            data: { name: name },
            success: function(response) {
                console.log("Antwort erhalten:", response); // Debugging
                
                // Tabelle leeren
                $('#resultTable tbody').empty();

                // Antwort parsen
                var data = JSON.parse(response);
                console.log("Geparste Daten:", data); // Debugging

                // Daten in Tabelle einfügen
                data.forEach(function(row) {
                    var tr = $('<tr>');
                    tr.append($('<td>').text(row.name));
                    $('#resultTable tbody').append(tr);
                });
            },
            error: function(xhr, status, error) {
                console.error('Fehler:', error); // Debugging
            }
        });
    });
});
       

    window.onload = fetchRandomImage();
</script>