const micBtn = document.getElementById("micBtn");
    const input = document.getElementById("voiceSearchInput");

    let recognition;
    let isListening = false;

    if ("webkitSpeechRecognition" in window) {
      recognition = new webkitSpeechRecognition();
      recognition.continuous = false;
      recognition.interimResults = false;
      recognition.lang = "en-US";

      recognition.onresult = (event) => {
        const transcript = event.results[0][0].transcript;
        input.value = transcript;
      };

      recognition.onerror = (event) => {
        console.error("Speech recognition error:", event.error);
      };
    } else {
      alert("Speech recognition not supported in your browser.");
    }

    micBtn.addEventListener("click", () => {
      if (isListening) {
        recognition.stop();
        micBtn.classList.remove("active");
        isListening = false;
      } else {
        recognition.start();
        micBtn.classList.add("active");
        isListening = true;
      }
    });


