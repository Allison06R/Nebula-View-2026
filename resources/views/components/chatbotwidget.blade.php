{{--
    Asistente flotante de Nebula View.
    Incluido globalmente en layouts/app.blade.php (se oculta en /test, que ya
    tiene su propio chat con el contexto del diagnóstico).
--}}

<div id="nv-chat-overlay"></div>

<div id="nv-chat" class="nv-chat">

    <button id="nv-chat-bubble" aria-label="Abrir asistente Nebula View" aria-expanded="false">
        <span id="nv-icon-eye">👁</span>
        <svg id="nv-icon-close" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M5 5l14 14M19 5L5 19" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
        </svg>
    </button>

    <div id="nv-chat-window" role="dialog" aria-label="Asistente Nebula View">
        <div class="nv-chat-header">
            <div class="nv-chat-avatar">👁</div>
            <div class="nv-chat-header-info">
                <div class="nv-chat-name">Asistente Nebula View</div>
                <div class="nv-chat-status"><span class="nv-dot"></span>En línea</div>
            </div>
            <button id="nv-chat-close" type="button" aria-label="Minimizar asistente">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 5l14 14M19 5L5 19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </button>
        </div>

        <div id="nv-chat-messages" class="nv-chat-messages"></div>

        <div class="nv-chat-suggestions" id="nv-chat-suggestions"></div>

        <form id="nv-chat-form" class="nv-chat-form">
            <input type="text" id="nv-chat-input" placeholder="Escribe tu pregunta..." autocomplete="off" required>
            <button type="submit" aria-label="Enviar">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 12l16-7-6 7 6 7-16-7z" fill="currentColor"/>
                </svg>
            </button>
        </form>
    </div>
</div>

<style>
    .nv-chat {
        position: fixed;
        bottom: 26px;
        left: 26px;
        z-index: 9999;
        font-family: 'DM Sans', sans-serif;
    }

    /* Fondo difuminado detrás del chat, visible mientras la ventana está abierta */
    #nv-chat-overlay {
        position: fixed;
        inset: 0;
        z-index: 9998;
        background: rgba(20, 10, 40, 0.25);
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }
    #nv-chat-overlay.open {
        animation: nv-overlay-in 0.28s ease forwards;
        pointer-events: auto;
    }
    #nv-chat-overlay.closing {
        animation: nv-overlay-out 0.22s ease forwards;
        pointer-events: none;
    }

    @keyframes nv-overlay-in {
        0%   { opacity: 0; visibility: visible; }
        100% { opacity: 1; visibility: visible; }
    }
    @keyframes nv-overlay-out {
        0%   { opacity: 1; visibility: visible; }
        100% { opacity: 0; visibility: hidden; }
    }

    #nv-chat-bubble {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        border: none;
        cursor: pointer;
        background: linear-gradient(135deg, var(--violet), var(--plum));
        box-shadow: var(--shadow-lifted);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--white);
        transition: transform 0.18s ease;
    }
    #nv-chat-bubble:hover { transform: scale(1.06); }
    #nv-chat-bubble #nv-icon-eye { font-size: 24px; line-height: 1; }
    #nv-chat-bubble #nv-icon-close { width: 24px; height: 24px; display: none; }
    .nv-chat.open #nv-chat-bubble #nv-icon-eye { display: none; }
    .nv-chat.open #nv-chat-bubble #nv-icon-close { display: block; }

    #nv-chat-window {
        position: absolute;
        bottom: 78px;
        left: 0;
        width: 400px;
        max-width: calc(100vw - 40px);
        height: 620px;
        max-height: 78vh;
        background: var(--white);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-lifted);
        border: 1px solid var(--lilac);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        opacity: 0;
        transform: translateY(24px) scale(0.9);
        transform-origin: bottom left;
        pointer-events: none;
    }
    .nv-chat.open #nv-chat-window {
        animation: nv-window-in 0.32s cubic-bezier(.34,1.56,.64,1) forwards;
        pointer-events: auto;
    }
    .nv-chat.closing #nv-chat-window {
        animation: nv-window-out 0.2s ease-in forwards;
        pointer-events: none;
    }

    @keyframes nv-window-in {
        0%   { opacity: 0; transform: translateY(24px) scale(0.9); }
        100% { opacity: 1; transform: translateY(0) scale(1); }
    }
    @keyframes nv-window-out {
        0%   { opacity: 1; transform: translateY(0) scale(1); }
        100% { opacity: 0; transform: translateY(16px) scale(0.92); }
    }

    .nv-chat-header {
        background: linear-gradient(135deg, var(--plum), var(--mid));
        padding: 16px 18px;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .nv-chat-avatar {
        width: 38px; height: 38px;
        border-radius: 50%;
        background: rgba(255,255,255,0.15);
        display: flex; align-items: center; justify-content: center;
        font-size: 19px;
        flex-shrink: 0;
    }
    .nv-chat-header-info { flex: 1; min-width: 0; }
    .nv-chat-name {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        font-size: 17px;
        color: var(--white);
    }
    .nv-chat-status {
        font-size: 13px;
        color: rgba(255,255,255,0.75);
        display: flex; align-items: center; gap: 5px;
        margin-top: 2px;
    }
    .nv-dot {
        width: 6px; height: 6px; border-radius: 50%;
        background: var(--success);
        display: inline-block;
    }
    #nv-chat-close {
        border: none;
        background: rgba(255,255,255,0.15);
        color: var(--white);
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        flex-shrink: 0;
        transition: background 0.15s ease, transform 0.15s ease;
    }
    #nv-chat-close:hover { background: rgba(255,255,255,0.28); transform: scale(1.06); }
    #nv-chat-close svg { width: 15px; height: 15px; }

    .nv-chat-messages {
        flex: 1;
        overflow-y: auto;
        padding: 16px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        background: var(--blush);
    }
    .nv-chat-messages::-webkit-scrollbar { width: 6px; }
    .nv-chat-messages::-webkit-scrollbar-thumb { background: var(--lavender); border-radius: 4px; }

    .nv-msg { display: flex; }
    .nv-msg-bubble {
        max-width: 82%;
        padding: 11px 15px;
        border-radius: var(--radius-sm);
        font-size: 15.5px;
        line-height: 1.55;
    }
    .nv-msg.bot { justify-content: flex-start; }
    .nv-msg.bot .nv-msg-bubble {
        background: var(--white);
        color: var(--text);
        border: 1px solid var(--lilac);
        border-bottom-left-radius: 4px;
    }
    .nv-msg.user { justify-content: flex-end; }
    .nv-msg.user .nv-msg-bubble {
        background: linear-gradient(135deg, var(--violet), var(--plum));
        color: var(--white);
        border-bottom-right-radius: 4px;
    }
    .nv-msg.typing .nv-msg-bubble { color: var(--muted); font-style: italic; }

    .nv-chat-suggestions {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        padding: 0 14px 10px;
        background: var(--blush);
    }
    .nv-sug {
        font-size: 13.5px;
        color: var(--plum);
        background: var(--lilac);
        border-radius: 999px;
        padding: 7px 13px;
        cursor: pointer;
        transition: background 0.15s ease;
        white-space: nowrap;
    }
    .nv-sug:hover { background: var(--lavender); color: var(--white); }

    .nv-chat-form {
        display: flex;
        gap: 8px;
        padding: 12px;
        background: var(--white);
        border-top: 1px solid var(--lilac);
    }
    #nv-chat-input {
        flex: 1;
        border: 1px solid var(--lilac);
        border-radius: var(--radius-sm);
        padding: 11px 15px;
        font-size: 15px;
        color: var(--text);
        outline: none;
        font-family: inherit;
    }
    #nv-chat-input:focus { border-color: var(--violet); }
    #nv-chat-input::placeholder { color: var(--muted); }

    .nv-chat-form button {
        width: 38px;
        border: none;
        border-radius: var(--radius-sm);
        background: var(--plum);
        color: var(--white);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.15s ease;
    }
    .nv-chat-form button:hover { background: var(--mid); }
    .nv-chat-form button svg { width: 16px; height: 16px; }

    @media (max-width: 900px) {
        #nv-chat-window { width: 380px; }
    }

    @media (max-width: 480px) {
        #nv-chat-window { width: calc(100vw - 32px); height: 72vh; left: -10px; }
        .nv-chat { left: 16px; bottom: 16px; }
    }

    @media (prefers-reduced-motion: reduce) {
        #nv-chat-bubble, #nv-chat-window { transition: none; }
    }

    [data-theme="dark"] #nv-chat-window { background: var(--dark); border-color: rgba(255,255,255,0.08); }
    [data-theme="dark"] .nv-chat-messages { background: #241442; }
    [data-theme="dark"] .nv-msg.bot .nv-msg-bubble { background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.1); color: var(--text); }
    [data-theme="dark"] .nv-chat-form { background: var(--dark); border-color: rgba(255,255,255,0.08); }
    [data-theme="dark"] #nv-chat-input { background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.1); color: var(--text); }
</style>

<script>
(function () {
    const widget   = document.getElementById('nv-chat');
    const overlay  = document.getElementById('nv-chat-overlay');
    const bubble   = document.getElementById('nv-chat-bubble');
    const closeBtn = document.getElementById('nv-chat-close');
    const messages = document.getElementById('nv-chat-messages');
    const form     = document.getElementById('nv-chat-form');
    const input    = document.getElementById('nv-chat-input');
    const sugBox   = document.getElementById('nv-chat-suggestions');

    const CHAT_WIDGET_URL = "{{ route('chat.widget.send') }}";
    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

    let history = [];
    let loading = false;
    let opened = false;

    const suggestions = [
        '¿Cómo funciona el test de diagnóstico?',
        '¿Qué lentes me recomiendan?',
        '¿Cómo agendo con un profesional?',
    ];

    function renderSuggestions() {
        sugBox.innerHTML = suggestions.map(s => `<span class="nv-sug">${s}</span>`).join('');
        sugBox.querySelectorAll('.nv-sug').forEach((el, i) => {
            el.addEventListener('click', () => sendMessage(suggestions[i]));
        });
    }

    function addMessage(text, who) {
        const row = document.createElement('div');
        row.className = 'nv-msg ' + who;
        const bubbleDiv = document.createElement('div');
        bubbleDiv.className = 'nv-msg-bubble';
        bubbleDiv.textContent = text;
        row.appendChild(bubbleDiv);
        messages.appendChild(row);
        messages.scrollTop = messages.scrollHeight;
        return row;
    }

    function addTyping() {
        const row = document.createElement('div');
        row.className = 'nv-msg bot typing';
        row.innerHTML = '<div class="nv-msg-bubble">Escribiendo...</div>';
        messages.appendChild(row);
        messages.scrollTop = messages.scrollHeight;
        return row;
    }

    function closeChat() {
        widget.classList.remove('open');
        overlay.classList.remove('open');
        bubble.setAttribute('aria-expanded', 'false');
    }

    bubble.addEventListener('click', () => {
        widget.classList.toggle('open');
        const isOpen = widget.classList.contains('open');
        bubble.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        overlay.classList.toggle('open', isOpen);

        if (isOpen) {
            input.focus();
            if (!opened) {
                opened = true;
                addMessage('Hola 👋 Soy el asistente de Nebula View. ¿En qué puedo ayudarte hoy?', 'bot');
                renderSuggestions();
            }
        }
    });

    closeBtn.addEventListener('click', closeChat);
    overlay.addEventListener('click', closeChat);

    async function sendMessage(text) {
        text = text.trim();
        if (!text || loading) return;

        loading = true;
        sugBox.innerHTML = '';
        input.value = '';
        addMessage(text, 'user');
        const typingRow = addTyping();

        try {
            const res = await fetch(CHAT_WIDGET_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                },
                body: JSON.stringify({ mensaje: text, historial: history }),
            });

            const data = await res.json();
            typingRow.remove();

            const reply = data.reply || 'No pude generar una respuesta.';
            addMessage(reply, 'bot');

            history.push({ role: 'user', content: text });
            history.push({ role: 'assistant', content: reply });
            history = history.slice(-12);
        } catch (err) {
            typingRow.remove();
            addMessage('Ocurrió un error al enviar tu mensaje. Intenta de nuevo.', 'bot');
            console.error(err);
        } finally {
            loading = false;
            input.focus();
        }
    }

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        sendMessage(input.value);
    });
})();
</script>