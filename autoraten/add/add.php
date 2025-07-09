<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bild und Name eingeben</title>
    <link rel="stylesheet" href="../../styles.css">

</head>
<body>
    <h1>Bild und Name eingeben</h1>
    <form action="insert.php" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="bild">Bild auswählen:</label><br>
        <input type="file" id="bild" name="bild"><br><br>
        <input type="submit" value="Senden">
    </form>

    <div id="homeB">
        <form action="http://www.ramm-ruednitz.de" method="get">
            <button type="submit" class="home-button">Home</button>
        </form>
    </div>
</body>
</html>
