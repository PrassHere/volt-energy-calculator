<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Volt Energy - Create Account</title>
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
<body class="bg-background font-body-md text-on-background min-h-screen overflow-x-hidden">
<main class="flex min-h-screen">
<!-- Left Column: Registration Form -->
<section class="w-full lg:w-1/2 bg-surface-container-lowest flex items-center justify-center p-8 lg:p-24">
<div class="max-w-md w-full">
<!-- Brand Header -->
<div class="flex items-center gap-2 mb-12">
<span class="text-primary text-4xl">⚡</span>
<h1 class="font-headline-md text-headline-md text-primary uppercase tracking-tight">Volt Energy</h1>
</div>
<!-- Welcome Text -->
<div class="mb-10">
<h2 class="text-display-lg font-display-lg text-on-surface mb-2">Create Account</h2>
<p class="text-on-surface-variant font-body-lg text-body-lg">Join us to start optimizing your energy consumption.</p>
</div>
<!-- Registration Form -->
<form class="space-y-6" id="registrationForm" onsubmit="return false;">
<!-- Full Name -->
<div class="space-y-1.5">
<label class="text-label-md font-label-md text-on-surface-variant" for="fullname">Full Name</label>
<div class="relative flex items-center">
<span class="material-symbols-outlined absolute left-4 text-on-surface-variant">person</span>
<input class="w-full pl-12 pr-4 py-3 bg-white border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all soft-inset-shadow text-on-surface" id="fullname" name="fullname" placeholder="Enter your full name" required="" type="text"/>
</div>
<p class="text-error text-label-sm font-label-sm hidden" id="nameError">Please enter your full name.</p>
</div>
<!-- Email -->
<div class="space-y-1.5">
<label class="text-label-md font-label-md text-on-surface-variant" for="email">Email</label>
<div class="relative flex items-center">
<span class="material-symbols-outlined absolute left-4 text-on-surface-variant">mail</span>
<input class="w-full pl-12 pr-4 py-3 bg-white border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all soft-inset-shadow text-on-surface" id="email" name="email" placeholder="example@domain.com" required="" type="email"/>
</div>
<p class="text-error text-label-sm font-label-sm hidden" id="emailError">Please enter a valid email address.</p>
</div>
<!-- Password -->
<div class="space-y-1.5">
<label class="text-label-md font-label-md text-on-surface-variant" for="password">Password</label>
<div class="relative flex items-center">
<span class="material-symbols-outlined absolute left-4 text-on-surface-variant">lock</span>
<input class="w-full pl-12 pr-12 py-3 bg-white border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all soft-inset-shadow text-on-surface" id="password" name="password" placeholder="Min. 8 characters" required="" type="password"/>
<button class="absolute right-4 text-on-surface-variant hover:text-primary transition-colors focus:outline-none" onclick="togglePassword('password')" type="button">
<span class="material-symbols-outlined" id="eye-password">visibility</span>
</button>
</div>
<p class="text-error text-label-sm font-label-sm hidden" id="passwordError">Password must be at least 8 characters long.</p>
</div>
<!-- Confirm Password -->
<div class="space-y-1.5">
<label class="text-label-md font-label-md text-on-surface-variant" for="confirm_password">Confirm Password</label>
<div class="relative flex items-center">
<span class="material-symbols-outlined absolute left-4 text-on-surface-variant">shield_lock</span>
<input class="w-full pl-12 pr-12 py-3 bg-white border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all soft-inset-shadow text-on-surface" id="confirm_password" name="confirm_password" placeholder="Repeat your password" required="" type="password"/>
<button class="absolute right-4 text-on-surface-variant hover:text-primary transition-colors focus:outline-none" onclick="togglePassword('confirm_password')" type="button">
<span class="material-symbols-outlined" id="eye-confirm_password">visibility</span>
</button>
</div>
<p class="text-error text-label-sm font-label-sm hidden" id="confirmError">Passwords do not match.</p>
</div>
<!-- Submit Button -->
<button class="w-full bg-primary-container text-on-secondary font-headline-sm text-headline-sm py-4 rounded-lg hover:brightness-110 active:scale-[0.98] transition-all flex items-center justify-center gap-2 group" onclick="validateForm()" type="submit">
                        Register Account
                        <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
</button>
</form>
<!-- Footer Link -->
<div class="mt-8 text-center">
<p class="text-on-surface-variant text-body-md font-body-md">
                        Already have an account? 
                        <a class="text-primary font-label-md hover:underline" href="/login">Log In</a>
</p>
</div>
</div>
</section>
<!-- Right Column: Decorative Imagery -->
<section class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-primary-container">
<!-- Decorative Image -->
<div class="absolute inset-0 z-0">
<img alt="Sustainable Energy" class="w-full h-full object-cover mix-blend-overlay opacity-60" data-alt="A majestic, high-contrast photograph of a single large white wind turbine spinning against a deep blue, clear twilight sky. The scene captures the essence of clean, sustainable energy with a modern, corporate aesthetic. The lighting is crisp and cool, highlighting the sleek aerodynamic curves of the turbine blades. The composition is clean and minimalist, evoking a sense of powerful environmental responsibility and technological precision." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDxmUSMUveqbPE3Sec3zhRbQiRR2cqd9DSRcJme9VOYHXqrOy94OtZzC5Hdt2lof-7M5N72bzc1OFBvewjty_Y-bGe08XqmaxaX6A4B1X6u4jyA3bnQ7NG9stFaTG5HEmT1L3W6d5535eSFMKNIFPYdXzMcr44CQkK0yio-zjoEkrumZCrUvQyk8NBEZ_5GoMA7P7L9i2DWfmBCUOpfgZ4mrDmVyhH5u5qwOd49V5z_TxfJ4FMpIZY0Gcd2n0_3AMhO7zyIj2IYMfg"/>
</div>
<!-- Overlay Gradient for text readability -->
<div class="absolute inset-0 bg-gradient-to-t from-primary/80 to-transparent z-10"></div>
<!-- Bottom Badge -->
<div class="absolute bottom-16 left-16 right-16 z-20">
<div class="bg-white/10 backdrop-blur-md border border-white/20 p-8 rounded-xl max-w-sm">
<div class="flex items-center gap-3 mb-3">
<div class="bg-on-tertiary-container text-primary rounded-full p-1 flex items-center justify-center">
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">check_circle</span>
</div>
<span class="text-white font-label-md text-label-md uppercase tracking-widest">Sustainable Tracking</span>
</div>
<p class="text-white text-body-md font-body-md leading-relaxed opacity-90">
                        Monitor your carbon footprint in real-time with Volt Energy. Our precision tools ensure every watt is accounted for.
                    </p>
</div>
</div>
<!-- Atmospheric Lighting Element -->
<div class="absolute -top-24 -right-24 w-96 h-96 bg-tertiary-fixed opacity-10 blur-[100px] rounded-full"></div>
</section>
</main>
<script>
        /**
         * Toggles the visibility of password input fields
         */
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById('eye-' + inputId);
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerText = 'visibility_off';
            } else {
                input.type = 'password';
                icon.innerText = 'visibility';
            }
        }

        /**
         * Basic validation logic to show the requested error messages
         */
        function validateForm() {
            const name = document.getElementById('fullname');
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const confirm = document.getElementById('confirm_password');

            const nameError = document.getElementById('nameError');
            const emailError = document.getElementById('emailError');
            const passwordError = document.getElementById('passwordError');
            const confirmError = document.getElementById('confirmError');

            let isValid = true;

            // Name check
            if (name.value.trim().length < 2) {
                nameError.classList.remove('hidden');
                name.classList.add('border-error');
                isValid = false;
            } else {
                nameError.classList.add('hidden');
                name.classList.remove('border-error');
            }

            // Email check (simple regex)
            if (!email.value.includes('@')) {
                emailError.classList.remove('hidden');
                email.classList.add('border-error');
                isValid = false;
            } else {
                emailError.classList.add('hidden');
                email.classList.remove('border-error');
            }

            // Password check
            if (password.value.length < 8) {
                passwordError.classList.remove('hidden');
                password.classList.add('border-error');
                isValid = false;
            } else {
                passwordError.classList.add('hidden');
                password.classList.remove('border-error');
            }

            // Confirm check
            if (confirm.value !== password.value || confirm.value === "") {
                confirmError.classList.remove('hidden');
                confirm.classList.add('border-error');
                isValid = false;
            } else {
                confirmError.classList.add('hidden');
                confirm.classList.remove('border-error');
            }

            if (isValid) {
                console.log("Registration submitted for:", name.value);
                // Simulated redirection
                alert("Account created successfully!");
            }
            
            return isValid;
        }
    </script>
</body></html>