<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Login - Volt Energy</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .soft-inset-shadow {
            box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1), 0px 1px 2px rgba(0, 0, 0, 0.06);
        }
    </style>
<script id="tailwind-config">
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              "colors": {
                      "on-secondary": "#ffffff",
                      "on-tertiary-container": "#71ee8a",
                      "error": "#ba1a1a",
                      "inverse-surface": "#213145",
                      "on-surface": "#0b1c30",
                      "on-background": "#0b1c30",
                      "primary-container": "#1d4ed8",
                      "on-secondary-fixed": "#111c2d",
                      "primary": "#0037b0",
                      "surface-bright": "#f8f9ff",
                      "surface-container-lowest": "#ffffff",
                      "tertiary-fixed-dim": "#62df7d",
                      "secondary-container": "#d5e0f8",
                      "on-secondary-container": "#586377",
                      "on-tertiary": "#ffffff",
                      "on-tertiary-fixed": "#002109",
                      "tertiary-fixed": "#7ffc97",
                      "on-primary-container": "#cad3ff",
                      "on-primary-fixed-variant": "#0039b5",
                      "on-error": "#ffffff",
                      "on-secondary-fixed-variant": "#3c475a",
                      "surface-container-low": "#eff4ff",
                      "secondary-fixed-dim": "#bcc7de",
                      "outline-variant": "#c4c5d7",
                      "inverse-on-surface": "#eaf1ff",
                      "inverse-primary": "#b7c4ff",
                      "on-primary-fixed": "#001551",
                      "surface": "#f8f9ff",
                      "tertiary": "#00501f",
                      "secondary-fixed": "#d8e3fb",
                      "outline": "#747686",
                      "background": "#f8f9ff",
                      "error-container": "#ffdad6",
                      "primary-fixed": "#dce1ff",
                      "on-primary": "#ffffff",
                      "on-tertiary-fixed-variant": "#005320",
                      "surface-variant": "#d3e4fe",
                      "on-surface-variant": "#434655",
                      "tertiary-container": "#006b2c",
                      "surface-container-highest": "#d3e4fe",
                      "surface-container-high": "#dce9ff",
                      "surface-container": "#e5eeff",
                      "secondary": "#545f73",
                      "on-error-container": "#93000a",
                      "surface-tint": "#2151da",
                      "surface-dim": "#cbdbf5",
                      "primary-fixed-dim": "#b7c4ff"
              },
              "borderRadius": {
                      "DEFAULT": "0.125rem",
                      "lg": "0.25rem",
                      "xl": "0.5rem",
                      "full": "0.75rem"
              },
              "spacing": {
                      "margin-desktop": "32px",
                      "margin-mobile": "16px",
                      "base": "4px",
                      "container-max": "1280px",
                      "gutter": "24px",
                      "topbar-height": "64px",
                      "sidebar-width": "280px"
              },
              "fontFamily": {
                      "headline-sm": ["Inter"],
                      "label-md": ["Inter"],
                      "headline-md": ["Inter"],
                      "label-sm": ["Inter"],
                      "body-md": ["Inter"],
                      "display-lg": ["Inter"],
                      "body-lg": ["Inter"]
              },
              "fontSize": {
                      "headline-sm": ["20px", {"lineHeight": "28px", "fontWeight": "600"}],
                      "label-md": ["14px", {"lineHeight": "20px", "fontWeight": "500"}],
                      "headline-md": ["24px", {"lineHeight": "32px", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                      "label-sm": ["12px", {"lineHeight": "16px", "fontWeight": "600"}],
                      "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                      "display-lg": ["36px", {"lineHeight": "44px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                      "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}]
              }
            },
          },
        }
    </script>
</head>
<body class="bg-background text-on-background font-body-md min-h-screen flex items-stretch">
<main class="w-full flex flex-col md:flex-row min-h-screen">
<!-- LEFT COLUMN: Decorative Hero -->
<section class="hidden md:flex md:w-1/2 relative bg-inverse-surface items-center justify-center p-margin-desktop overflow-hidden">
<!-- Background Image with Overlay -->
<div class="absolute inset-0 z-0">
<img class="w-full h-full object-cover opacity-30 grayscale mix-blend-overlay" data-alt="A clean, modern architectural rendering of a sustainable smart home equipped with sleek solar panels and an electric vehicle charger. The lighting is crisp morning daylight, emphasizing a high-end corporate minimalist aesthetic with cool blue and slate tones. The mood is professional, efficient, and technologically advanced, suggesting academic precision in energy management and carbon footprint reduction." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAjih2jz_IJEY-vc9OU4m6Qog77t2KwFM8X21QZkREVtZmcCeyM5_04Ow8GWePgqWGSVVe1RwQMFiuHcjvZ-Fh9QTKinDrO_zmVgnx0oXfOpQPGL4BNZz1kiNfJ5u4DEG0oRgluk4PG96YZWz5-O9rD6Q3AFtz1HmZJk2a_DVnocI92kFILDofrNLoPM1n0ACm5BuiwgcMHotGNxTxUoOWygkWP10Ufxh1gPuGkbW4vFuQtC258LkMQ3okDhKTQerSVm2bCvaT3-n0"/>
<div class="absolute inset-0 bg-gradient-to-br from-inverse-surface via-inverse-surface/80 to-primary/20"></div>
</div>
<!-- Content Overlay -->
<div class="relative z-10 max-w-lg text-left">
<div class="mb-8 inline-flex items-center justify-center w-16 h-16 rounded-lg bg-primary-container/20 border border-primary-container/30 backdrop-blur-sm">
<span class="material-symbols-outlined text-on-primary-container !text-4xl" data-icon="electric_bolt">electric_bolt</span>
</div>
<h1 class="text-display-lg font-display-lg text-on-secondary mb-6 tracking-tight">
                    Empower Your Energy Decisions
                </h1>
<p class="text-body-lg font-body-lg text-on-secondary/80 leading-relaxed">
                    Volt Energy Calculator provides precise, reliable insights to optimize your home's energy and reduce your carbon footprint.
                </p>
<div class="mt-12 grid grid-cols-2 gap-gutter">
<div class="p-base">
<div class="text-headline-md font-headline-md text-tertiary-fixed mb-1">98%</div>
<div class="text-label-sm font-label-sm text-on-secondary/60 uppercase tracking-wider">Calculation Accuracy</div>
</div>
<div class="p-base">
<div class="text-headline-md font-headline-md text-tertiary-fixed mb-1">2.4k+</div>
<div class="text-label-sm font-label-sm text-on-secondary/60 uppercase tracking-wider">Carbon Tons Saved</div>
</div>
</div>
</div>
<!-- Decorative Element -->
<div class="absolute bottom-0 right-0 p-8">
<div class="w-64 h-64 border border-on-secondary/5 rounded-full -mr-32 -mb-32"></div>
<div class="w-96 h-96 border border-on-secondary/5 rounded-full -mr-48 -mb-48"></div>
</div>
</section>
<!-- RIGHT COLUMN: Login Form -->
<section class="w-full md:w-1/2 flex items-center justify-center bg-surface p-margin-mobile md:p-margin-desktop">
<div class="w-full max-w-md">
<!-- Branding -->
<div class="flex items-center gap-3 mb-12">
<div class="w-10 h-10 bg-primary-container flex items-center justify-center rounded-lg shadow-sm">
<span class="material-symbols-outlined text-white" data-icon="bolt">bolt</span>
</div>
<span class="text-headline-sm font-headline-sm text-on-surface tracking-tight">Volt Energy Calculator</span>
</div>
<!-- Header -->
<div class="mb-8">
<h2 class="text-display-lg font-display-lg text-on-surface mb-2">Welcome Back</h2>
<p class="text-body-md font-body-md text-on-surface-variant">Enter your credentials to access your dashboard.</p>
</div>
<!-- Login Form -->
<form class="space-y-6" id="loginForm" onsubmit="return handleLogin(event)">
<!-- Email Field -->
<div class="space-y-2">
<label class="text-label-md font-label-md text-on-surface-variant" for="email">Email Address</label>
<div class="relative group">
<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-outline">
<span class="material-symbols-outlined" data-icon="mail">mail</span>
</div>
<input class="block w-full pl-10 pr-3 py-3 bg-white border border-outline-variant rounded-lg text-on-surface placeholder:text-outline focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all duration-200" id="email" name="email" placeholder="name@company.com" required="" type="email"/>
</div>
<p class="hidden text-error text-label-sm font-label-sm mt-1" id="email-error">Please enter a valid email address.</p>
</div>
<!-- Password Field -->
<div class="space-y-2">
<label class="text-label-md font-label-md text-on-surface-variant" for="password">Password</label>
<div class="relative group">
<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-outline">
<span class="material-symbols-outlined" data-icon="lock">lock</span>
</div>
<input class="block w-full pl-10 pr-10 py-3 bg-white border border-outline-variant rounded-lg text-on-surface placeholder:text-outline focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all duration-200" id="password" name="password" placeholder="••••••••" required="" type="password"/>
<button class="absolute inset-y-0 right-0 pr-3 flex items-center text-outline hover:text-on-surface-variant transition-colors" onclick="togglePassword()" type="button">
<span class="material-symbols-outlined" data-icon="visibility" id="password-toggle-icon">visibility</span>
</button>
</div>
<p class="hidden text-error text-label-sm font-label-sm mt-1" id="password-error">Invalid password credentials.</p>
</div>
<!-- Login Button -->
<button class="w-full py-4 bg-primary-container text-white font-label-md text-label-md rounded-lg hover:bg-primary transition-all duration-200 active:scale-[0.98] shadow-md shadow-primary/10" type="submit">
                        Login to Dashboard
                    </button>
</form>
<!-- Footer Links -->
<div class="mt-8 text-center">
<a class="text-label-md font-label-md text-primary hover:underline transition-all" href="/register">
                        Don't have an account? Register here
                    </a>
</div>
</div>
</section>
</main>
<script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('password-toggle-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.innerText = 'visibility_off';
            } else {
                passwordInput.type = 'password';
                toggleIcon.innerText = 'visibility';
            }
        }

        function handleLogin(event) {
            event.preventDefault();
            
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const emailError = document.getElementById('email-error');
            const passwordError = document.getElementById('password-error');
            
            // Reset errors
            emailError.classList.add('hidden');
            passwordError.classList.add('hidden');
            
            let hasError = false;

            // Simple demo validation logic
            if (!email.includes('@')) {
                emailError.classList.remove('hidden');
                hasError = true;
            }

            if (password.length < 6) {
                passwordError.classList.remove('hidden');
                hasError = true;
            }

            if (!hasError) {
                console.log('Login attempt successful for:', email);
                // In a real app, redirection would happen here
                // window.location.href = '/dashboard';
            }

            return false;
        }

        // Add visual feedback to inputs on interaction
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', () => {
                input.parentElement.parentElement.querySelector('label').classList.replace('text-on-surface-variant', 'text-primary');
            });
            input.addEventListener('blur', () => {
                input.parentElement.parentElement.querySelector('label').classList.replace('text-primary', 'text-on-surface-variant');
            });
        });
    </script>
</body></html>