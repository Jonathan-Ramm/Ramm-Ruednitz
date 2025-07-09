<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="../styles.css">

    <title>SOR Wahl</title>
</head>
<body>

        <div class="centered" id="headline">Hier geht's zur SOR Gruppen Einwahl</div>
        <?php
            // Prüfen, ob eine Fehlermeldung übergeben wurde
            if (isset($_GET['error'])) {
                echo '<div style="color: red; text-align: center; margin-bottom: 20px;">' . htmlspecialchars($_GET['error']) . '</div>';
            }
            if (isset($_GET['success'])) {
                echo '<div style="color: green; text-align: center; margin-bottom: 20px;">' . htmlspecialchars('Perfekt, dass hat geklappt.') . '</div>';
            }
        ?>
        <div>
            <form class="centered" method="POST" action="checkDB.php">

                <label for="vorn">Vorname:</label>
                <input type="text" id="vorn" name="vorn" required>
                <label for="nachn">Nachname:</label>
                <input type="text" id="nachn" name="nachn" required>
                <label for="kl">Klasse:</label>
                <input type="text" id="kl" name="kl" required>
  <!--           <label for="code">Dein Code:</label>
                <input type="text" id="code" name="code" required> -->

                <label for="dropdown1">Erstwahl:</label>
                <select id="dropdown1" name="option1" required>
                <option value="" disabled selected>Bitte wählen</option>
                    <option value="Projekt1">Projekt 1</option>
                    <option disabled value="Projekt2">Projekt 2</option>
                    <option value="Projekt3">Projekt 3</option>
                    <option value="Projekt4">Projekt 4</option>
                    <option value="Projekt5">Projekt 5</option>
                    <option value="Projekt6">Projekt 6</option>
                    <option disabled value="Projekt7">Projekt 7</option>
                    <option value="Projekt8">Projekt 8</option>
                    <option value="Projekt9">Projekt 9</option>
                    <option disabled value="Projekt10">Projekt 10</option>
                    <option disabled value="Projekt11">Projekt 11</option>
                    <option disabled value="Projekt12">Projekt 12</option>
                    <option value="Projekt13">Projekt 13</option>
                    <option value="Projekt14">Projekt 14</option>
                    <option disabled value="Projekt15">Projekt 15</option>
                    <option value="Projekt16">Projekt 16</option>
                    <option value="Projekt17">Projekt 17</option>
                    <option value="Projekt18">Projekt 18</option>
                    <option value="Projekt19">Projekt 19</option>
                    <option disabled value="Projekt20">Projekt 20</option>
                    <option value="Projekt21">Projekt 21</option>
                    <option value="Projekt22">Projekt 22</option>
                    <option disabled value="Projekt23">Projekt 23</option>
                    <option disabled value="Projekt24">Projekt 24</option>
                    <option value="Projekt25">Projekt 25</option>

                </select>


                <label for="dropdown2">Zweitwahl:</label>
                <select id="dropdown2" name="option2" required>
                <option value="" disabled selected>Bitte wählen</option>
                    <option value="Projekt1">Projekt 1</option>
                    <option disabled value="Projekt2">Projekt 2</option>
                    <option value="Projekt3">Projekt 3</option>
                    <option value="Projekt4">Projekt 4</option>
                    <option value="Projekt5">Projekt 5</option>
                    <option value="Projekt6">Projekt 6</option>
                    <option value="Projekt7">Projekt 7</option>
                    <option value="Projekt8">Projekt 8</option>
                    <option value="Projekt9">Projekt 9</option>
                    <option disabled value="Projekt10">Projekt 10</option>
                    <option disabled value="Projekt11">Projekt 11</option>
                    <option disabled value="Projekt12">Projekt 12</option>
                    <option value="Projekt13">Projekt 13</option>
                    <option value="Projekt14">Projekt 14</option>
                    <option disabled value="Projekt15">Projekt 15</option>
                    <option value="Projekt16">Projekt 16</option>
                    <option value="Projekt17">Projekt 17</option>
                    <option value="Projekt18">Projekt 18</option>
                    <option value="Projekt19">Projekt 19</option>
                    <option disabled value="Projekt20">Projekt 20</option>
                    <option value="Projekt21">Projekt 21</option>
                    <option value="Projekt22">Projekt 22</option>
                    <option disabled value="Projekt23">Projekt 23</option>
                    <option disabled value="Projekt24">Projekt 24</option>
                    <option value="Projekt25">Projekt 25</option>

                </select>


                <label for="dropdown3">Drittwahl:</label>
                <select id="dropdown3" name="option3" required>
                    <option value="" disabled selected>Bitte wählen</option>
                    <option value="Projekt1">Projekt 1</option>
                    <option disabled value="Projekt2">Projekt 2</option>
                    <option value="Projekt3">Projekt 3</option>
                    <option value="Projekt4">Projekt 4</option>
                    <option value="Projekt5">Projekt 5</option>
                    <option value="Projekt6">Projekt 6</option>
                    <option value="Projekt7">Projekt 7</option>
                    <option value="Projekt8">Projekt 8</option>
                    <option value="Projekt9">Projekt 9</option>
                    <option disabled value="Projekt10">Projekt 10</option>
                    <option disabled value="Projekt11">Projekt 11</option>
                    <option disabled value="Projekt12">Projekt 12</option>
                    <option value="Projekt13">Projekt 13</option>
                    <option value="Projekt14">Projekt 14</option>
                    <option disabled value="Projekt15">Projekt 15</option>
                    <option value="Projekt16">Projekt 16</option>
                    <option value="Projekt17">Projekt 17</option>
                    <option value="Projekt18">Projekt 18</option>
                    <option value="Projekt19">Projekt 19</option>
                    <option disabled value="Projekt20">Projekt 20</option>
                    <option value="Projekt21">Projekt 21</option>
                    <option value="Projekt22">Projekt 22</option>
                    <option disabled value="Projekt23">Projekt 23</option>
                    <option disabled value="Projekt24">Projekt 24</option>
                    <option value="Projekt25">Projekt 25</option>
                </select>
                <br><br>

                <button type="submit">Absenden</button>
            
            </form>
        </div>


        <script>
    const selects = [
        document.getElementById("dropdown1"),
        document.getElementById("dropdown2"),
        document.getElementById("dropdown3"),
    ];

    function updateOptions() {
    const selectedValues = selects.map(s => s.value);

    selects.forEach((select, i) => {
        const currentValue = select.value;

        Array.from(select.options).forEach(option => {
            if (option.value === "") return; // Skip "Bitte wählen"

            // ❗ Dauerhaft deaktivierte Optionen nie überschreiben
            if (option.hasAttribute("disabled")) {
                return;
            }

            // Deaktivieren, wenn Option in einem anderen Dropdown gewählt wurde
            option.disabled = selectedValues.includes(option.value) && option.value !== currentValue;
        });
    });
}


    // EventListener für alle Dropdowns
    selects.forEach(select => {
        select.addEventListener("change", updateOptions);
    });

    // Initialer Aufruf beim Laden
    window.addEventListener("DOMContentLoaded", updateOptions);
</script>
<footer style="text-align: center; padding: 1em; font-size: 0.9em; background-color: #f2f2f2; color: #555;">
  <p>© 2025 Jonathan Ramm – <a href="Impressum.html">Impressum</a></p>
</footer>

</body>
</html>



