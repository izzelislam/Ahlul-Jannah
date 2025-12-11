<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pondok Informatika Al-Madinah')</title>

    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/site.webmanifest">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    @php
        $primaryColor = \App\Models\Setting::get('theme_primary_color', '#2563eb');
        $secondaryColor = \App\Models\Setting::get('theme_secondary_color', '#1c7ed6');
        
        // Convert hex to RGB for Tailwind
        function hexToRgb($hex) {
            $hex = str_replace('#', '', $hex);
            return [
                'r' => hexdec(substr($hex, 0, 2)),
                'g' => hexdec(substr($hex, 2, 2)),
                'b' => hexdec(substr($hex, 4, 2))
            ];
        }
        
        $primaryRgb = hexToRgb($primaryColor);
        $secondaryRgb = hexToRgb($secondaryColor);
    @endphp
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50:  'rgb({{ $primaryRgb['r'] + 40 }}, {{ $primaryRgb['g'] + 40 }}, {{ $primaryRgb['b'] + 40 }})',
                            100: 'rgb({{ $primaryRgb['r'] + 30 }}, {{ $primaryRgb['g'] + 30 }}, {{ $primaryRgb['b'] + 30 }})',
                            200: 'rgb({{ $primaryRgb['r'] + 20 }}, {{ $primaryRgb['g'] + 20 }}, {{ $primaryRgb['b'] + 20 }})',
                            300: 'rgb({{ $primaryRgb['r'] + 10 }}, {{ $primaryRgb['g'] + 10 }}, {{ $primaryRgb['b'] + 10 }})',
                            400: 'rgb({{ $primaryRgb['r'] + 5 }}, {{ $primaryRgb['g'] + 5 }}, {{ $primaryRgb['b'] + 5 }})',
                            500: '{{ $primaryColor }}',
                            600: '{{ $primaryColor }}',
                            700: 'rgb({{ max(0, $primaryRgb['r'] - 20) }}, {{ max(0, $primaryRgb['g'] - 20) }}, {{ max(0, $primaryRgb['b'] - 20) }})',
                            800: 'rgb({{ max(0, $primaryRgb['r'] - 40) }}, {{ max(0, $primaryRgb['g'] - 40) }}, {{ max(0, $primaryRgb['b'] - 40) }})',
                            900: 'rgb({{ max(0, $primaryRgb['r'] - 60) }}, {{ max(0, $primaryRgb['g'] - 60) }}, {{ max(0, $primaryRgb['b'] - 60) }})',
                        },
                        secondary: '{{ $secondaryColor }}',
                    }
                }
            }
        }
    </script>
    <style>
        .hero-pattern {
            background-color: #ffffff;
            background-image: radial-gradient(#14b8a6 0.5px, transparent 0.5px), radial-gradient(#14b8a6 0.5px, #ffffff 0.5px);
            background-size: 20px 20px;
            background-position: 0 0, 10px 10px;
            opacity: 0.1;
        }
        .blob {
            position: absolute;
            filter: blur(40px);
            z-index: -1;
            opacity: 0.4;
        }
    </style>
    @stack('styles')
</head>
<body class="font-sans antialiased text-slate-800 bg-white">

    @include('partials.landing.header')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    @include('partials.landing.footer')

    <!-- Chat Bubble Widget -->
    <div id="chat-widget" class="fixed bottom-6 right-6 z-50">
        <!-- Floating Button - Always at bottom right -->
        <button onclick="toggleChat()" id="chat-toggle" class="w-14 h-14 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white rounded-full shadow-lg shadow-primary-600/30 flex items-center justify-center transition-all duration-300 hover:scale-110 group relative">
            <i class="fas fa-comments text-xl transition-transform" id="chat-icon"></i>
            <!-- Notification Badge -->
            <span id="chat-badge" class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 rounded-full text-xs flex items-center justify-center font-bold animate-bounce">1</span>
        </button>
        
        <!-- Chat Box - Positioned above button -->
        <div id="chat-box" class="hidden absolute bottom-16 right-0 w-80 sm:w-96 bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden transform transition-all duration-300 scale-95 opacity-0 origin-bottom-right">
            <!-- Chat Header -->
            <div class="bg-gradient-to-r from-primary-600 to-primary-700 px-4 py-3 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-robot text-white text-lg"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-bold text-sm">Asisten PPDB</h4>
                        <p class="text-primary-100 text-xs flex items-center gap-1">
                            <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                            Online
                        </p>
                    </div>
                </div>
                <button onclick="toggleChat()" class="text-white/80 hover:text-white transition">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            
            <!-- Chat Messages -->
            <div id="chat-messages" class="h-72 overflow-y-auto p-4 space-y-3 bg-slate-50">
                <!-- Welcome Message -->
                <div class="flex items-start gap-2">
                    <div class="w-8 h-8 bg-primary-600 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-robot text-white text-xs"></i>
                    </div>
                    <div class="bg-white rounded-2xl rounded-tl-none px-4 py-2 shadow-sm max-w-[80%]">
                        <p class="text-sm text-slate-700">Assalamu'alaikum! 👋 Saya asisten virtual PPDB. Ada yang bisa saya bantu?</p>
                    </div>
                </div>
            </div>
            
            <!-- WhatsApp Button -->
            <div class="px-3 pt-3 bg-white">
                <a href="https://wa.me/6281234567890?text=Halo%2C%20saya%20ingin%20bertanya%20tentang%20PPDB" target="_blank" class="flex items-center justify-center gap-2 w-full py-2.5 bg-green-500 hover:bg-green-600 text-white text-sm font-semibold rounded-full transition-colors">
                    <i class="fab fa-whatsapp text-lg"></i>
                    Lanjut ke WhatsApp
                </a>
            </div>
            
            <!-- Chat Input -->
            <div class="p-3 bg-white border-t border-slate-100">
                <form id="chat-form" onsubmit="sendMessage(event)" class="flex items-center gap-2">
                    <input 
                        type="text" 
                        id="chat-input" 
                        placeholder="Ketik pesan..." 
                        class="flex-1 px-4 py-2.5 bg-slate-100 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:bg-white transition"
                        autocomplete="off"
                    >
                    <button type="submit" id="send-btn" class="w-10 h-10 bg-primary-600 hover:bg-primary-700 text-white rounded-full flex items-center justify-center transition-colors">
                        <i class="fas fa-paper-plane text-sm"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const WEBHOOK_URL = 'https://cokelatoz.websitegan.com/webhook/d96d8079-81fe-4d11-9496-081a55ac1c77';
        let isChatOpen = false;

        function toggleChat() {
            const chatBox = document.getElementById('chat-box');
            const chatBadge = document.getElementById('chat-badge');
            const chatIcon = document.getElementById('chat-icon');
            
            isChatOpen = !isChatOpen;
            
            // Add spin animation then change icon
            chatIcon.classList.add('fa-spin');
            setTimeout(() => {
                chatIcon.classList.remove('fa-spin');
                if (isChatOpen) {
                    chatIcon.classList.remove('fa-comments');
                    chatIcon.classList.add('fa-xmark');
                } else {
                    chatIcon.classList.remove('fa-xmark');
                    chatIcon.classList.add('fa-comments');
                }
            }, 300);
            
            if (isChatOpen) {
                chatBox.classList.remove('hidden');
                setTimeout(() => {
                    chatBox.classList.remove('scale-95', 'opacity-0');
                    chatBox.classList.add('scale-100', 'opacity-100');
                }, 10);
                chatBadge.classList.add('hidden');
                document.getElementById('chat-input').focus();
            } else {
                chatBox.classList.remove('scale-100', 'opacity-100');
                chatBox.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    chatBox.classList.add('hidden');
                }, 300);
            }
        }

        function addMessage(message, isUser = false) {
            const messagesContainer = document.getElementById('chat-messages');
            const messageDiv = document.createElement('div');
            
            if (isUser) {
                messageDiv.className = 'flex items-start gap-2 justify-end';
                messageDiv.innerHTML = `
                    <div class="bg-primary-600 text-white rounded-2xl rounded-tr-none px-4 py-2 shadow-sm max-w-[80%]">
                        <p class="text-sm">${escapeHtml(message)}</p>
                    </div>
                `;
            } else {
                messageDiv.className = 'flex items-start gap-2';
                messageDiv.innerHTML = `
                    <div class="w-8 h-8 bg-primary-600 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-robot text-white text-xs"></i>
                    </div>
                    <div class="bg-white rounded-2xl rounded-tl-none px-4 py-2 shadow-sm max-w-[80%]">
                        <p class="text-sm text-slate-700">${escapeHtml(message)}</p>
                    </div>
                `;
            }
            
            messagesContainer.appendChild(messageDiv);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        function addTypingIndicator() {
            const messagesContainer = document.getElementById('chat-messages');
            const typingDiv = document.createElement('div');
            typingDiv.id = 'typing-indicator';
            typingDiv.className = 'flex items-start gap-2';
            typingDiv.innerHTML = `
                <div class="w-8 h-8 bg-primary-600 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-robot text-white text-xs"></i>
                </div>
                <div class="bg-white rounded-2xl rounded-tl-none px-4 py-3 shadow-sm">
                    <div class="flex gap-1">
                        <span class="w-2 h-2 bg-slate-400 rounded-full animate-bounce" style="animation-delay: 0ms"></span>
                        <span class="w-2 h-2 bg-slate-400 rounded-full animate-bounce" style="animation-delay: 150ms"></span>
                        <span class="w-2 h-2 bg-slate-400 rounded-full animate-bounce" style="animation-delay: 300ms"></span>
                    </div>
                </div>
            `;
            messagesContainer.appendChild(typingDiv);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        function removeTypingIndicator() {
            const typing = document.getElementById('typing-indicator');
            if (typing) typing.remove();
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        async function sendMessage(event) {
            event.preventDefault();
            
            const input = document.getElementById('chat-input');
            const sendBtn = document.getElementById('send-btn');
            const message = input.value.trim();
            
            if (!message) return;
            
            // Add user message
            addMessage(message, true);
            input.value = '';
            
            // Disable input while processing
            input.disabled = true;
            sendBtn.disabled = true;
            
            // Show typing indicator
            addTypingIndicator();
            
            try {
                const response = await fetch(WEBHOOK_URL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        message: message,
                        timestamp: new Date().toISOString(),
                        page: window.location.pathname
                    })
                });
                
                const data = await response.json();
                removeTypingIndicator();
                
                if (data.status === 'success' && data.message) {
                    addMessage(data.message);
                } else {
                    addMessage('Maaf, terjadi kesalahan. Silakan coba lagi.');
                }
            } catch (error) {
                console.error('Chat error:', error);
                removeTypingIndicator();
                addMessage('Maaf, tidak dapat terhubung ke server. Silakan coba lagi nanti.');
            }
            
            // Re-enable input
            input.disabled = false;
            sendBtn.disabled = false;
            input.focus();
        }
    </script>

    @stack('scripts')
</body>
</html>
