from flask import Flask, request, jsonify
import numpy as np
from tensorflow.keras.models import load_model
import base64, io, time
from io import BytesIO
from PIL import Image
import os

app = Flask(__name__)

# Cross-Origin-Requests zulassen (falls notwendig)
from flask_cors import CORS
CORS(app)

# Modell laden
model = load_model("model.h5")

# Zielverzeichnis für gespeicherte Bilder
saved_images_dir = 'saved_images'

# Sicherstellen, dass das Verzeichnis existiert
if not os.path.exists(saved_images_dir):
    os.makedirs(saved_images_dir)

@app.route("/predict", methods=["POST"])
def predict():
    data = request.get_json()
    
    # Bild dekodieren
    img_data = base64.b64decode(data["image"])
    img = Image.open(BytesIO(img_data)).convert("L")  # Umwandlung in Graustufen
    img = img.resize((28, 28))  # Skalierung auf 28x28
    
    # Bild speichern
    save_image(img)
    
    # Bild in numpy Array umwandeln
    img_array = np.array(img).reshape(1, 784).astype('float32') / 255.0
    
    # Vorhersage
    prediction = model.predict(img_array)
    predicted_class = np.argmax(prediction)
    probability = float(np.max(prediction))  # Maximale Wahrscheinlichkeit

    # Rückgabe der Vorhersage und Wahrscheinlichkeit
    return jsonify({"prediction": str(predicted_class), "probability": probability})


if __name__ == '__main__':
    app.run(debug=True)
    

