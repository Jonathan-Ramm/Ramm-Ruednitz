
  let fragen = [];
  let aktuelleFrage = 0;
  let punkte = 0;
  
  async function ladeFragen() {
    try {
      const response = await fetch("fragen.json");
      if (!response.ok) throw new Error("Fehler beim Laden der Fragen.");
      fragen = await response.json();
      fragen.sort(() => Math.random() - 0.5);
      ladeFrage();
    } catch (error) {
      console.error(error);
      document.getElementById("quiz-container").innerHTML =
        "<p>Fehler beim Laden der Fragen. Bitte versuche es später erneut.</p>";
    }
  }

  function ladeFrage() {
    const f = fragen[aktuelleFrage];
    document.getElementById("frage").textContent = f.frage;
    
  
    const antwortenContainer = document.getElementById("antworten");
    antwortenContainer.className = "frage";
    antwortenContainer.innerHTML = "";
  
    const anzahl = f.antworten.length;
  
    f.antworten.forEach((antwort, index) => {
      const button = document.createElement("button");
      button.className = "antwort-button";
      button.textContent = antwort;
      button.onclick = () => prüfeAntwort(index);
  
      // Position berechnen
      const faktor = (index + 1) / (anzahl + 1);
      button.style.left = `${faktor * 100}%`;
      button.style.top = `50%`;
  
      antwortenContainer.appendChild(button);
    });
  }
  
  function prüfeAntwort(index) {
    const korrekt = fragen[aktuelleFrage].korrekt;
    if (index === korrekt) punkte++;
  
    aktuelleFrage++;
    if (aktuelleFrage < fragen.length) {
      ladeFrage();
      aktualisiereFortschritt();
    } else {
      zeigeErgebnis();
      aktualisiereFortschritt();
    }
  }
  
  function zeigeErgebnis() {
    document.getElementById("quiz-container").innerHTML =
      `<h2>Fertig!</h2><p>Du hast ${punkte} von ${fragen.length} richtig.</p>`;
  }
  
  function aktualisiereFortschritt() {
    const fortschritt = (aktuelleFrage / fragen.length) * 100;
    document.getElementById("progress-bar").style.width = `${fortschritt}%`;
  }
  
  // Starte das Quiz
  document.getElementById("naechste").style.display = "none";
  ladeFragen();
