import tensorflow as tf
import tensorflowjs as tfjs

# Lade das Keras-Modell
model = tf.keras.models.load_model('model.h5')

# Konvertiere das Modell in TensorFlow.js Format
tfjs.converters.save_keras_model(model, 'tfjs_model')
