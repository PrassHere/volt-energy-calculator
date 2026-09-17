<!DOCTYPE html><html lang="en"><head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Volt Energy — Eco Tips</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
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
<style>
        body { font-family: 'Inter', sans-serif; }
        .soft-inset { box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1), 0px 1px 2px rgba(0, 0, 0, 0.06); }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
    </style>
</head>
<body class="bg-background text-on-background">
<!-- SIDEBAR NAVIGATION -->
<aside class="fixed left-0 top-0 h-full w-[280px] bg-inverse-surface flex flex-col py-8 z-50">
<div class="px-6 mb-10">
<h1 class="text-headline-md font-headline-md font-bold text-on-secondary">Volt Energy</h1>
<p class="text-label-sm font-label-sm tracking-widest text-on-secondary opacity-60 mt-1 uppercase">System Interface</p>
</div>
<nav class="flex-1 space-y-1">
<a class="flex items-center px-6 py-3 transition-colors hover:bg-secondary-container/10 text-on-secondary-container opacity-70 font-label-md text-label-md" href="#">
<span class="material-symbols-outlined mr-4" data-icon="grid_view">grid_view</span>
                Dashboard
            </a>
<a class="flex items-center px-6 py-3 transition-colors hover:bg-secondary-container/10 text-on-secondary-container opacity-70 font-label-md text-label-md" href="#">
<span class="material-symbols-outlined mr-4" data-icon="add_circle">add_circle</span>
                Add Device
            </a>
<a class="flex items-center px-6 py-3 transition-colors hover:bg-secondary-container/10 text-on-secondary-container opacity-70 font-label-md text-label-md" href="#">
<span class="material-symbols-outlined mr-4" data-icon="history">history</span>
                History
            </a>
<a class="flex items-center px-6 py-3 transition-colors hover:bg-secondary-container/10 text-on-secondary-container opacity-70 font-label-md text-label-md" href="#">
<span class="material-symbols-outlined mr-4" data-icon="bar_chart">bar_chart</span>
                Analytics
            </a>
<a class="flex items-center px-6 py-3 border-l-4 border-primary-container bg-inverse-surface text-on-secondary font-bold font-label-md text-label-md" href="#">

                Eco Tips
            </a>
</nav>
<div class="mt-auto space-y-1 pt-8 border-t border-on-secondary/10">
<a class="flex items-center px-6 py-3 transition-colors hover:bg-secondary-container/10 text-on-secondary-container opacity-70 font-label-md text-label-md" href="#">
<span class="material-symbols-outlined mr-4" data-icon="settings">settings</span>
                Settings
            </a>
<a class="flex items-center px-6 py-3 transition-colors hover:bg-secondary-container/10 text-on-secondary-container opacity-70 font-label-md text-label-md" href="#">
<span class="material-symbols-outlined mr-4" data-icon="logout">logout</span>
                Logout
            </a>
</div>
</aside>
<!-- MAIN WRAPPER -->
<div class="ml-[280px] min-h-screen flex flex-col">
<!-- TOP NAVBAR -->
<header class="h-16 flex justify-between items-center px-margin-desktop w-full bg-surface border-b border-outline-variant sticky top-0 z-40">
<div class="flex items-center bg-surface-container-low px-4 py-2 rounded-lg border border-outline-variant w-96">
<span class="material-symbols-outlined text-on-surface-variant mr-3" data-icon="search">search</span>
<input class="bg-transparent border-none focus:ring-0 text-label-md w-full text-on-surface" placeholder="Search systems..." type="text">
</div>
<div class="flex items-center space-x-6">
<button class="relative hover:bg-surface-container-low p-2 rounded-full transition-colors">
<span class="material-symbols-outlined text-on-surface-variant" data-icon="notifications">notifications</span>
<span class="absolute top-2 right-2 w-2 h-2 bg-primary rounded-full"></span>
</button>
<div class="flex items-center space-x-3 border-l border-outline-variant pl-6">
<div class="text-right">
<p class="font-label-md text-label-md text-on-surface leading-none">Admin User</p>
<p class="font-label-sm text-label-sm text-on-surface-variant">System Manager</p>
</div>
<div class="w-10 h-10 bg-primary-container rounded-full overflow-hidden border border-outline-variant">
<img alt="User Avatar" class="w-full h-full object-cover" data-alt="A professional close-up headshot of a middle-aged corporate manager with a neutral expression. He is wearing a tailored navy blue blazer over a crisp white shirt. The background is a soft-focus office environment with clean white walls and subtle grey shadows. The lighting is diffused and bright, creating a high-quality, modern corporate portrait feel in a light-mode aesthetic." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDNFdbPWDnSCl2g6ii13faxwU9EwTDbiQMPgOpaDvSCAJuGC4wTMxa71eD7UdeDdZqmwD_ywvCBfI-bUQrGtASwv_rt4W3V_Oe1RuZmb_xoawpteMLu_Y51v560Fxr6P5qdLG6kPv7eVRATLv9yIkPDM0yaga7u3XOB_A0J0lhvveNpZML6cnFreMqvIf2tLHYyV3THyWtqEBeaHwhGI2w6xKvI6P4gijxoshk0OX6cb_7tyDrixt91YnV8UmUZTajUXdtQ02kBEvQ">
</div>
</div>
</div>
</header>
<!-- CONTENT AREA -->
<main class="flex-1 p-margin-desktop max-w-container-max mx-auto w-full">
<!-- HEADER SECTION -->
<section class="mb-12">
<h2 class="font-display-lg text-display-lg text-on-surface mb-2">Ways to Save</h2>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-3xl">
                    Small changes make a big impact. Discover practical habits and efficiency tweaks to lower your energy footprint and save on costs.
                </p>
</section>
<!-- TIPS DISPLAY -->
<div class="space-y-gutter">
<!-- FEATURED TIP (Index 0) -->
<div class="bg-surface-container-lowest border border-outline-variant border-l-[6px] border-l-primary p-8 flex items-start soft-inset rounded-lg transition-transform hover:scale-[1.01] duration-300">
<div class="w-16 h-16 bg-primary-fixed flex items-center justify-center rounded-xl mr-8 shrink-0">
<span class="material-symbols-outlined text-primary text-[32px]" data-icon="lightbulb">lightbulb</span>
</div>
<div>
<div class="flex items-center space-x-3 mb-3">
<span class="px-3 py-1 bg-secondary-container text-on-secondary-container font-label-sm text-label-sm rounded-full uppercase tracking-wider">Priority Efficiency</span>
<span class="text-primary font-label-md text-label-md font-bold">Recommended for your home</span>
</div>
<h3 class="font-headline-md text-headline-md text-on-surface mb-4">Optimize Your HVAC Scheduling</h3>
<p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-6 max-w-4xl">
                            Adjusting your thermostat by just 7-10 degrees for 8 hours a day from its normal setting can save as much as 10% a year on heating and cooling. Program your system to reduce output during peak daytime hours when the house is empty, ensuring comfort only when you're present.
                        </p>
<div class="flex items-center text-primary font-label-md text-label-md">
<span class="material-symbols-outlined mr-2" data-icon="trending_down">trending_down</span>
                            Estimated Annual Savings: $180 - $240
                        </div>
</div>
</div>
<!-- GRID OF REMAINING TIPS -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
<!-- TIP 1 -->
<div class="bg-surface-container-lowest border border-outline-variant p-6 soft-inset rounded-lg hover:bg-surface-container-low transition-colors group">
<div class="flex justify-between items-start mb-6">
<div class="w-12 h-12 bg-surface-container-high group-hover:bg-primary-container/20 flex items-center justify-center rounded-lg transition-colors">
<span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary" data-icon="leaf">gleaf</span>
</div>
<span class="px-2 py-0.5 bg-surface-container-high text-on-surface-variant font-label-sm text-label-sm rounded uppercase tracking-wider">Efficiency</span>
</div>
<h4 class="font-headline-sm text-headline-sm text-on-surface mb-2">Seal Air Leaks and Insulation</h4>
<p class="font-body-md text-body-md text-on-surface-variant">
                            Check for drafts around windows and doors. Using weatherstripping or caulk to seal small gaps prevents treated air from escaping, reducing the load on your climate control systems.
                        </p>
</div>
<!-- TIP 2 -->
<div class="bg-surface-container-lowest border border-outline-variant p-6 soft-inset rounded-lg hover:bg-surface-container-low transition-colors group">
<div class="flex justify-between items-start mb-6">
<div class="w-12 h-12 bg-surface-container-high group-hover:bg-primary-container/20 flex items-center justify-center rounded-lg transition-colors">
<span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary" data-icon="water_drop">water_drop</span>
</div>
<span class="px-2 py-0.5 bg-surface-container-high text-on-surface-variant font-label-sm text-label-sm rounded uppercase tracking-wider">Water Heat</span>
</div>
<h4 class="font-headline-sm text-headline-sm text-on-surface mb-2">Lower Water Heater Temp</h4>
<p class="font-body-md text-body-md text-on-surface-variant">
                            Most water heaters are set to 140°F by default. Lowering this to 120°F provides sufficient heat for most households while significantly reducing standby heat loss and energy consumption.
                        </p>
</div>
<!-- TIP 3 -->
<div class="bg-surface-container-lowest border border-outline-variant p-6 soft-inset rounded-lg hover:bg-surface-container-low transition-colors group">
<div class="flex justify-between items-start mb-6">
<div class="w-12 h-12 bg-surface-container-high group-hover:bg-primary-container/20 flex items-center justify-center rounded-lg transition-colors">
<span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary" data-icon="power_settings_new">power_settings_new</span>
</div>
<span class="px-2 py-0.5 bg-surface-container-high text-on-surface-variant font-label-sm text-label-sm rounded uppercase tracking-wider">Standby</span>
</div>
<h4 class="font-headline-sm text-headline-sm text-on-surface mb-2">Eliminate Phantom Loads</h4>
<p class="font-body-md text-body-md text-on-surface-variant">
                            Electronics continue to draw power even when turned off. Use smart power strips to completely cut power to devices like consoles, monitors, and chargers when they are not in active use.
                        </p>
</div>
<!-- TIP 4 -->
<div class="bg-surface-container-lowest border border-outline-variant p-6 soft-inset rounded-lg hover:bg-surface-container-low transition-colors group">
<div class="flex justify-between items-start mb-6">
<div class="w-12 h-12 bg-surface-container-high group-hover:bg-primary-container/20 flex items-center justify-center rounded-lg transition-colors">
<span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary" data-icon="microwave">microwave</span>
</div>
<span class="px-2 py-0.5 bg-surface-container-high text-on-surface-variant font-label-sm text-label-sm rounded uppercase tracking-wider">Appliances</span>
</div>
<h4 class="font-headline-sm text-headline-sm text-on-surface mb-2">Switch to Smart LED Bulbs</h4>
<p class="font-body-md text-body-md text-on-surface-variant">
                            LED bulbs use at least 75% less energy and last 25 times longer than incandescent lighting. Smart LEDs allow for automated scheduling and dimming to further minimize wasted light.
                        </p>
</div>
<!-- TIP 5 -->
<div class="bg-surface-container-lowest border border-outline-variant p-6 soft-inset rounded-lg hover:bg-surface-container-low transition-colors group">
<div class="flex justify-between items-start mb-6">
<div class="w-12 h-12 bg-surface-container-high group-hover:bg-primary-container/20 flex items-center justify-center rounded-lg transition-colors">
<span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary" data-icon="laundry">laundry</span>
</div>
<span class="px-2 py-0.5 bg-surface-container-high text-on-surface-variant font-label-sm text-label-sm rounded uppercase tracking-wider">Laundry</span>
</div>
<h4 class="font-headline-sm text-headline-sm text-on-surface mb-2">Cold Water Laundry Cycles</h4>
<p class="font-body-md text-body-md text-on-surface-variant">
                            About 90% of the energy used by a washing machine goes toward heating the water. Switching to cold water cycles for the majority of loads can drastically reduce appliance-related costs.
                        </p>
</div>
<!-- TIP 6 -->
<div class="bg-surface-container-lowest border border-outline-variant p-6 soft-inset rounded-lg hover:bg-surface-container-low transition-colors group">
<div class="flex justify-between items-start mb-6">
<div class="w-12 h-12 bg-surface-container-high group-hover:bg-primary-container/20 flex items-center justify-center rounded-lg transition-colors">
<span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary" data-icon="solar_power">solar_power</span>
</div>
<span class="px-2 py-0.5 bg-surface-container-high text-on-surface-variant font-label-sm text-label-sm rounded uppercase tracking-wider">Renewable</span>
</div>
<h4 class="font-headline-sm text-headline-sm text-on-surface mb-2">Solar-Powered Outdoor Lights</h4>
<p class="font-body-md text-body-md text-on-surface-variant">
                            Replace hard-wired outdoor path and security lighting with solar-powered alternatives. These units require zero grid electricity and reduce installation complexity and cost.
                        </p>
</div>
</div>
</div>
<!-- FOOTER INFO -->
<footer class="mt-16 pt-8 border-t border-outline-variant flex justify-between items-center text-on-surface-variant">
<p class="font-label-md text-label-md">© 2024 Volt Energy Management Systems</p>
<div class="flex space-x-6">
<a class="font-label-sm text-label-sm hover:text-primary transition-colors" href="#">Data Privacy</a>
<a class="font-label-sm text-label-sm hover:text-primary transition-colors" href="#">Resource Center</a>
</div>
</footer>
</main>
</div>
<script>
        // Simple hover interaction for cards to enhance "clickable" feel without actual buttons
        document.querySelectorAll('.soft-inset').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.borderColor = '#1d4ed8'; // primary-container
            });
            card.addEventListener('mouseleave', () => {
                card.style.borderColor = '#E5E7EB'; // outline-variant
            });
        });
    </script>


</body></html>