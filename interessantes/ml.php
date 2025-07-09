<?php
session_start();
$_SESSION['isAdmin'] = 0;
include'checkAdmin.php';
include'autoraten/Count.php';
include("UI/Highscore+.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MNIST ML</title>
    <style>
        canvas {
            border: 1px solid black;
            cursor: crosshair;
        }
        .prediction-container {
            margin-top: 20px;
        }
        .prediction-bar {
            width: 100%;
            height: 30px;
            background-color: #f0f0f0;
            border-radius: 5px;
            position: relative;
        }
        .prediction-fill {
            height: 100%;
            background-color: #4caf50;
            border-radius: 5px;
            text-align: center;
            color: white;
            font-weight: bold;
            line-height: 30px;
            transition: width 0.3s ease-in-out;
        }
        #result {
            margin-top: 10px;
            font-size: 18px;
        }
    </style>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h1>Mal eine Ziffer</h1>
    <canvas id="canvas" width="560" height="560"></canvas>
    <button id="clear-btn">Clear</button>
    <button id="predict-btn">Predict</button>
    <p id="result">Prediction: </p>

    <div class="prediction-container">
        <div class="prediction-bar">
            <div class="prediction-fill" id="prediction-bar" style="width: 0%;">0%</div>
        </div>
    </div>

    <script>
        const canvas = document.getElementById("canvas");
        const ctx = canvas.getContext("2d");
        const clearBtn = document.getElementById("clear-btn");
        const predictBtn = document.getElementById("predict-btn");
        const result = document.getElementById("result");
        const predictionBar = document.getElementById("prediction-bar");

        ctx.fillStyle = "black";
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        let drawing = false;
        let lastX = 0, lastY = 0;
        const lineWidth = 30;  // Optimierte Pinselgröße für schnelleres Zeichnen
        const smoothingFactor = 0.2; // Glättung der Linien

        canvas.addEventListener("mousedown", (event) => {
            drawing = true;
            const rect = canvas.getBoundingClientRect();
            lastX = event.clientX - rect.left;
            lastY = event.clientY - rect.top;
        });

        canvas.addEventListener("mouseup", () => {
            drawing = false;
        });

        canvas.addEventListener("mousemove", (event) => {
            if (!drawing) return;

            const rect = canvas.getBoundingClientRect();
            const x = event.clientX - rect.left;
            const y = event.clientY - rect.top;

            // Linien nur zeichnen, wenn der Abstand signifikant genug ist
            if (Math.abs(x - lastX) > lineWidth || Math.abs(y - lastY) > lineWidth) {
                const newX = lastX + smoothingFactor * (x - lastX);
                const newY = lastY + smoothingFactor * (y - lastY);

                ctx.lineWidth = lineWidth;
                ctx.lineCap = "round";  // Weiche Linienenden
                ctx.strokeStyle = "white";
                ctx.beginPath();
                ctx.moveTo(lastX, lastY);
                ctx.lineTo(newX, newY);
                ctx.stroke();

                lastX = newX;
                lastY = newY;
            }
        });
        clearBtn.addEventListener("click", () => {
            ctx.fillStyle = "black";
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            result.textContent = "Prediction: ";
            predictionBar.style.width = "0%";
            predictionBar.textContent = "0%";
        });

        predictBtn.addEventListener("click", async () => {
            const dataURL = canvas.toDataURL("image/png");
            const response = await fetch("https://ml-ahet.onrender.com/predict", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ image: dataURL.split(",")[1] }),
            });
            const prediction = await response.json();
            const predictedClass = prediction.prediction;
            const probability = prediction.probability * 100;  // Annahme: "probability" ist zwischen 0 und 1
            result.textContent = `Prediction: ${predictedClass}`;
            updatePredictionBar(probability);
        });

        function updatePredictionBar(probability) {
            predictionBar.style.width = `${probability}%`;
            predictionBar.textContent = `${Math.round(probability)}%`;
        }
    </script>
</body>
</html>
