  <style>
      body {
          margin: 0;
          font-family: Arial, sans-serif;
      }

      #chat-button {
          position: fixed;
          bottom: 150px;
          right: 30px;
          background: rgb(33, 33, 33);
          width: 50px;
          height: 50px;
          border-radius: 50%;
          display: flex;
          align-items: center;
          justify-content: center;
          font-size: 26px;
          cursor: pointer;
          box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
          z-index: 1001;
      }

      #chat-window {
          position: fixed;
          bottom: 90px;
          right: 20px;
          width: 320px;
          height: 450px;
          max-width: 90%;
          background: white;
          border-radius: 12px;
          box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
          overflow: hidden;
          z-index: 1000;
          display: none;
          /* Masqué par défaut */
          flex-direction: column;
      }

      .chat-header {
          display: flex;
          align-items: center;
          background: #f5f5f5;
          padding: 10px;
          border-bottom: 1px solid #ddd;
      }

      .avatar {
          width: 40px;
          height: 40px;
          border-radius: 50%;
          margin-right: 10px;
      }

      .chat-header button {
          margin-left: auto;
          background: transparent;
          border: none;
          font-size: 18px;
          cursor: pointer;
      }

      .chat-body {
          padding: 15px;
          flex: 1;
          overflow-y: scroll;
      }

      .chat-input {
          display: flex;
          border-top: 1px solid #ddd;
      }

      .chat-input input {
          flex: 1;
          padding: 10px;
          border: none;
          outline: none;
      }

      .chat-input button {
          background: rgb(21, 99, 223);
          border: none;
          padding: 10px 15px;
          cursor: pointer;
          font-size: 18px;
      }

      .bot-message,
      .user-message {
          margin-bottom: 10px;
          font-size: 14px;
          padding: 8px 12px;
          border-radius: 12px;
          max-width: 99%;
          word-wrap: break-word;
      }

      .bot-message {
          background: #f0f0f0;
          align-self: flex-start;
      }

      .user-message {
          background: #dcf8c6;
          align-self: flex-end;
          text-align: right;
      }
  </style>
  <!-- Bouton de chat flottant -->
  <div id="chat-button">💬</div>

  <!-- Fenêtre du chatbot -->
  <div id="chat-window">
      <div class="chat-header">
          <img src="{{ asset('frontend/img/favicon.png') }}" alt="Lina" class="avatar" />
          <div>
              <strong>AgenceDigitals</strong><br />
              <small>Bienvenue sur notre Bot </small>
          </div>
          <button id="close-chat">✖</button>
      </div>

      <div class="chat-body" id="chat-body">
          <div class="bot-message">
              <p class="mb-2">👋 Bonjour, je suis votre assistante IA de AgenceDigitals !
                  Je suis là pour :</p>
              <p class="mb-1">✅ Vous aider à trouver des produits</p>
              <p class="mb-2">✅ Répondre à toutes vos questions</p>
              <p class="">✨ Comment puis-je vous aider aujourd’hui ?</p>
          </div>
      </div>

      <div class="chat-input">
          <input type="text" id="user-input" placeholder="Écrivez votre message..." />
          <button id="send-msg">➤</button>
      </div>
  </div>
  <script>
      const chatButton = document.getElementById('chat-button');
      const chatWindow = document.getElementById('chat-window');
      const closeChat = document.getElementById('close-chat');
      const sendMsg = document.getElementById('send-msg');
      const userInput = document.getElementById('user-input');
      const chatBody = document.getElementById('chat-body');

      // Ouvrir le chat
      chatButton.addEventListener('click', () => {
          chatWindow.style.display = 'flex';

      });

      // Fermer le chat
      closeChat.addEventListener('click', () => {
          chatWindow.style.display = 'none';

      });

      // Envoi de message
      sendMsg.addEventListener('click', sendMessage);
      userInput.addEventListener('keypress', function(e) {
          if (e.key === 'Enter') sendMessage();
      });

      async function sendMessage() {
          const text = userInput.value.trim();
          if (text === '') return;

          const userMsg = document.createElement('div');
          userMsg.classList.add('user-message');
          userMsg.innerText = text;
          chatBody.appendChild(userMsg);

          userInput.value = '';
          chatBody.scrollTop = chatBody.scrollHeight;

          // Affiche d'abord "Je réfléchis... ⏳"
          const botMsg = document.createElement('div');
          botMsg.classList.add('bot-message');
          botMsg.innerText = "Je réfléchis... ⏳";
          chatBody.appendChild(botMsg);
          chatBody.scrollTop = chatBody.scrollHeight;

          // Obtenir la réponse (locale ou ChatGPT)
          const reply = await generateBotResponse2(text);
          botMsg.innerHTML = reply;
          chatBody.scrollTop = chatBody.scrollHeight;
      }

      async function generateBotResponse(input) {
          const msg = input.toLowerCase();
          if (msg.includes("bonjour") || msg.includes("salut")) {
              return "Bonjour 👋 ! Comment puis-je vous aider aujourd'hui ?";
          } else {
              // Appel à OpenAI
              const response = await fetch("https://api.openai.com/v1/chat/completions", {
                  method: "POST",
                  headers: {
                      "Content-Type": "application/json",
                      "Authorization": "Bearer " + env('OPENAI_API_KEY') // ⚠️ sécurise-la en prod !
                  },
                  body: JSON.stringify({
                      model: "gpt-4o-mini",
                      messages: [{
                          role: "user",
                          content: input
                      }]
                  })
              });

              const data = await response.json();
              return data.choices[0].message.content;
          }
      }

      async function generateBotResponse2(input) {
          const msg = input.toLowerCase();

          try {
              // On envoie directement la question à n8n via HTTP POST
              const response = await fetch(
                  "https://n8n.srv1043341.hstgr.cloud/webhook/383d97e6-7bd4-481e-8496-6a755979e327", {
                      method: "POST",
                      headers: {
                          "Content-Type": "application/json"
                      },
                      body: JSON.stringify({
                          question: input
                      })
                  });

              const data = await response.json();

              // n8n doit retourner un JSON du type
              return data.output || "Désolé, je n'ai pas compris.";
          } catch (error) {
              console.error("Erreur lors de la requête à n8n:", error);
              return "Une erreur est survenue lors de la consultation du serveur.";
          }
      }
  </script>
