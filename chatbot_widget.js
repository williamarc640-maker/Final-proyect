// Simple floating chatbot widget (fetches responses from chatbot.php)
(function(){
  const widget = document.createElement('div');
  widget.id = 'chatbot-widget';
  widget.innerHTML = `
    <div id="chatbot-toggler">Chat</div>
    <div id="chatbot-panel" style="display:none">
      <div id="chatbot-messages"></div>
      <form id="chatbot-form">
        <input id="chatbot-input" placeholder="Escribe tu pregunta..." autocomplete="off"/>
        <button type="submit">Enviar</button>
      </form>
    </div>
  `;
  document.body.appendChild(widget);

  const style = document.createElement('style');
  style.textContent = `
    #chatbot-widget { position: fixed; right: 20px; bottom: 20px; z-index: 9999; font-family: Arial, sans-serif; }
    #chatbot-toggler { background:#0b82f5;color:#fff;padding:10px 14px;border-radius:50px;cursor:pointer;box-shadow:0 4px 12px rgba(0,0,0,0.15)}
    #chatbot-panel { width:320px; max-width:90vw; background:#fff; border:1px solid #ddd; border-radius:8px; padding:8px; box-shadow:0 6px 24px rgba(0,0,0,0.15); margin-top:8px;}
    #chatbot-messages { height:220px; overflow:auto; padding:8px; border-bottom:1px solid #eee; }
    .msg { margin:6px 0; }
    .msg.user { text-align:right; }
    .msg.bot { text-align:left; color:#222; }
    #chatbot-form { display:flex; gap:6px; margin-top:8px; }
    #chatbot-input { flex:1; padding:8px; border:1px solid #ccc; border-radius:6px; }
    #chatbot-form button { padding:8px 10px; border-radius:6px; border:none; background:#0b82f5; color:#fff; cursor:pointer; }
  `;
  document.head.appendChild(style);

  const toggler = widget.querySelector('#chatbot-toggler');
  const panel = widget.querySelector('#chatbot-panel');
  const form = widget.querySelector('#chatbot-form');
  const messages = widget.querySelector('#chatbot-messages');
  const input = widget.querySelector('#chatbot-input');

  toggler.addEventListener('click', ()=> {
    panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
  });

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const text = input.value.trim();
    if (!text) return;
    appendMessage('user', text);
    input.value = '';
    appendMessage('bot', 'Escribiendo...');
    try {
      const res = await fetch('chatbot.php', {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify({message: text})
      });
      const data = await res.json();
      // remove "Escribiendo..." placeholder
      const last = messages.querySelector('.msg.bot:last-child');
      if (last) last.remove();
      appendMessage('bot', data.reply || 'Lo siento, no tengo una respuesta ahora.');
    } catch(err) {
      appendMessage('bot', 'Error de conexión con el chatbot.');
    }
  });

  function appendMessage(cls, txt){
    const d = document.createElement('div');
    d.className = 'msg ' + (cls==='user' ? 'user' : 'bot');
    d.textContent = txt;
    messages.appendChild(d);
    messages.scrollTop = messages.scrollHeight;
  }

})();
