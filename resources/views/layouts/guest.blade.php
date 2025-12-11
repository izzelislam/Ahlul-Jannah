<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
        
        <!-- Tailwind CSS CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
            
            .login-card {
                background: white;
                padding: 2rem;
                border-radius: 1rem;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            }
            
            .login-input {
                appearance: none;
                width: 100%;
                padding: 0.75rem 1rem 0.75rem 2.75rem;
                border: 1px solid #e2e8f0;
                border-radius: 0.5rem;
                font-size: 0.875rem;
                line-height: 1.25rem;
                color: #1e293b;
                background-color: #f8fafc;
                transition: all 0.15s ease;
            }
            
            .login-input:focus {
                outline: none;
                border-color: #6366f1;
                background-color: white;
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            }
            
            .login-input::placeholder {
                color: #94a3b8;
            }
            
            .login-button {
                position: relative;
                width: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 0.75rem 1rem;
                border: none;
                border-radius: 0.5rem;
                font-size: 0.875rem;
                font-weight: 600;
                color: white;
                background: linear-gradient(to right, #6366f1, #4f46e5);
                cursor: pointer;
                transition: all 0.15s ease;
            }
            
            .login-button:hover {
                background: linear-gradient(to right, #4f46e5, #4338ca);
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
            }
            
            .input-icon {
                transition: color 0.15s ease;
            }
            
            .input-wrapper:focus-within .input-icon {
                color: #6366f1;
            }
            
            .logo-circle {
                animation: pulse-glow 2s infinite;
            }
            
            @keyframes pulse-glow {
                0%, 100% {
                    box-shadow: 0 0 0 0 rgba(99, 102, 241, 0.4);
                }
                50% {
                    box-shadow: 0 0 0 10px rgba(99, 102, 241, 0);
                }
            }
        </style>
    </head>
    <body class="bg-gradient-to-br from-slate-100 to-slate-200 min-h-screen">
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
