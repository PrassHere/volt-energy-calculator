<!DOCTYPE html><html class="light" lang="en"><head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Volt Energy - Add Device</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
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
        .soft-inset-shadow { box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1), 0px 1px 2px rgba(0, 0, 0, 0.06); }
        input[type="range"] {
            -webkit-appearance: none;
            width: 100%;
            height: 4px;
            background: #d1d5db;
            border-radius: 2px;
            outline: none;
        }
        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 16px;
            height: 16px;
            background: #1D4ED8;
            cursor: pointer;
            border-radius: 50%;
        }
    </style>
</head>
<body class="bg-background text-on-background min-h-screen">
<!-- SideNavBar (Shared Component) -->
<aside class="fixed left-0 top-0 h-full w-[280px] bg-inverse-surface flex flex-col py-8 z-50">
<div class="px-6 mb-10">
<h1 class="text-headline-md font-headline-md font-bold text-on-secondary">Volt Energy</h1>
<p class="text-label-sm font-label-sm text-on-secondary opacity-60 tracking-widest uppercase">SYSTEM INTERFACE</p>
</div>
<nav class="flex-grow">
<ul class="space-y-1">
<li class="">
<a class="flex items-center px-6 py-3 text-on-secondary-container opacity-70 hover:bg-secondary-container/10 transition-colors font-label-md text-label-md" href="#">
<span class="material-symbols-outlined mr-4" data-icon="grid_view">grid_view</span>
                        Dashboard
                    </a>
</li>
<li class="">
<a class="flex items-center px-6 py-3 border-l-4 border-primary-container bg-inverse-surface text-on-secondary font-bold font-label-md text-label-md" href="/add-device">
<span class="material-symbols-outlined mr-4" data-icon="add_circle">add_circle</span>
                        Add Device
                    </a>
</li>
<li class="">
<a class="flex items-center px-6 py-3 text-on-secondary-container opacity-70 hover:bg-secondary-container/10 transition-colors font-label-md text-label-md" href="#">
<span class="material-symbols-outlined mr-4" data-icon="history">history</span>
                        History
                    </a>
</li>
<li class="">
<a class="flex items-center px-6 py-3 text-on-secondary-container opacity-70 hover:bg-secondary-container/10 transition-colors font-label-md text-label-md" href="#">
<span class="material-symbols-outlined mr-4" data-icon="bar_chart">bar_chart</span>
                        Analytics
                    </a>
</li>
<li class="">
<a class="flex items-center px-6 py-3 text-on-secondary-container opacity-70 hover:bg-secondary-container/10 transition-colors font-label-md text-label-md" href="#">

                        Eco Tips
                    </a>
</li>
</ul>
</nav>
<div class="px-6 mt-auto space-y-1">
<a class="flex items-center py-3 text-on-secondary-container opacity-70 hover:bg-secondary-container/10 transition-colors font-label-md text-label-md" href="#">
<span class="material-symbols-outlined mr-4" data-icon="settings">settings</span>
                Settings
            </a>
<a class="flex items-center py-3 text-on-secondary-container opacity-70 hover:bg-secondary-container/10 transition-colors font-label-md text-label-md" href="#">
<span class="material-symbols-outlined mr-4" data-icon="logout">logout</span>
                Logout
            </a>
</div>
</aside>
<!-- Main Content Area -->
<main class="ml-[280px] min-h-screen">
<!-- TopNavBar (Shared Component) -->
<header class="h-16 flex justify-between items-center px-margin-desktop bg-surface border-b border-outline-variant sticky top-0 z-40">
<div class="flex items-center">
<h2 class="text-headline-sm font-headline-sm font-bold text-on-surface">Energy Calculator</h2>
</div>
<div class="flex items-center gap-4">
<button class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-surface-container-low transition-colors">
<span class="material-symbols-outlined text-on-surface-variant" data-icon="notifications">notifications</span>
</button>
<div class="w-8 h-8 rounded-full bg-secondary overflow-hidden">
<img alt="User Avatar" class="w-full h-full object-cover" data-alt="A professional close-up headshot of a corporate engineer in a well-lit modern office environment. The person wears a crisp white shirt and dark blazer, reflecting a clean, academic, and serious professional tone. The lighting is soft and neutral, maintaining a high-key light mode aesthetic consistent with corporate energy management software." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCFO_FoPhKkpqSrKNMLjjzT6nuHvYBNCS861C4nk8OmEjoL-8p7OmkipMtpHxD0N6FxX9xTIo5b-VjXLCMgQTZCNl7qsVrxf9r4DY7gSU-MCep1D1BVyEiZAheM7hXF9osQKMoODRD0yZw7Ihs31M9RWD4GcCHqOhYCbB3mFWdxx7WVydWKAIjS68UboeEgZrs3WnWrG8KvcxVMntmAppdZIWo8LI4Q_mGwV4YXXZ4HHE2TH4OWnqZ3Pt-eDFK1yRA9Xo-FAscFw_o">
</div>
</div>
</header>
<!-- Main Workspace -->
<div class="p-margin-desktop max-w-container-max mx-auto">
<div class="grid grid-cols-12 gap-gutter">
<!-- Left: Device Parameters Form -->
<div class="col-span-12 lg:col-span-7">
<section class="bg-surface-container-lowest border border-outline-variant rounded-lg soft-inset-shadow overflow-hidden">
<header class="px-6 py-4 border-b border-outline-variant flex items-center justify-between">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-primary" data-icon="notes">notes</span>
<h3 class="font-headline-sm text-headline-sm text-on-surface">Device Parameters</h3>
</div>
</header>
<div class="p-6 space-y-6">
<!-- Device Name -->
<div class="space-y-2">
<label class="text-label-sm font-label-sm text-on-surface-variant flex items-center gap-2">
<span class="material-symbols-outlined text-sm" data-icon="monitor">monitor</span>
                                    DEVICE NAME
                                </label>
<input class="w-full bg-white border border-outline-variant rounded-lg px-4 py-3 text-body-md focus:border-primary focus:ring-2 focus:ring-primary/30 transition-all outline-none" id="device_name" placeholder="e.g. Workstation PC" type="text">
</div>
<!-- Power Rating -->
<div class="space-y-2">
<label class="text-label-sm font-label-sm text-on-surface-variant flex items-center gap-2">
<span class="material-symbols-outlined text-sm" data-icon="bolt">bolt</span>
                                    POWER RATING (W)
                                </label>
<div class="relative">
<input class="w-full bg-white border border-outline-variant rounded-lg px-4 py-3 text-body-md focus:border-primary focus:ring-2 focus:ring-primary/30 transition-all outline-none" id="power_rating" type="number" value="100">
<span class="absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-label-md">Watts</span>
</div>
</div>
<!-- Daily Usage Slider -->
<div class="space-y-4">
<div class="flex justify-between items-center">
<label class="text-label-sm font-label-sm text-on-surface-variant flex items-center gap-2">
<span class="material-symbols-outlined text-sm" data-icon="schedule">schedule</span>
                                        DAILY USAGE (HOURS)
                                    </label>
<span class="text-primary font-bold text-headline-sm" id="usage_value">8h</span>
</div>
<input id="daily_usage" max="24" min="0" step="0.5" type="range" value="8">
<div class="flex justify-between text-label-sm text-on-surface-variant px-1">
<span class="">0h</span>
<span class="">12h</span>
<span class="">24h</span>
</div>
</div>
<!-- Utility Tariff -->
<div class="space-y-2">
<label class="text-label-sm font-label-sm text-on-surface-variant flex items-center gap-2">
<span class="material-symbols-outlined text-sm" data-icon="payments">payments</span>
                                    UTILITY TARIFF ($/kWh)
                                </label>
<div class="relative">
<input class="w-full bg-white border border-outline-variant rounded-lg px-4 py-3 text-body-md focus:border-primary focus:ring-2 focus:ring-primary/30 transition-all outline-none" id="utility_tariff" step="0.01" type="number" value="0.15">
<span class="absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-label-md">USD</span>
</div>
</div>
<!-- Form Buttons -->
<div class="flex gap-4 pt-4">
<button class="flex-1 py-3 border border-outline-variant text-primary font-bold rounded-lg hover:bg-surface-container-low transition-colors text-label-md" id="reset_btn">
                                    Reset
                                </button>
<button class="flex-[2] py-3 bg-[#16A34A] text-white font-bold rounded-lg hover:bg-[#15803d] transition-colors flex items-center justify-center gap-2 text-label-md" id="save_btn">
<span class="material-symbols-outlined text-lg" data-icon="save">save</span>
                                    Save Data
                                </button>
</div>
</div>
</section>
</div>
<!-- Right: Results Display -->
<div class="col-span-12 lg:col-span-5 space-y-gutter">
<!-- Primary Blue Card -->
<div class="bg-primary-container rounded-lg p-8 text-on-secondary shadow-lg relative overflow-hidden">
<!-- Abstract Background Decoration -->
<div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
<div class="relative z-10">
<p class="text-label-sm font-label-sm opacity-80 mb-2 uppercase tracking-widest">ESTIMATED MONTHLY COST</p>
<h4 class="text-display-lg font-display-lg mb-8" id="result_monthly_cost">$3.60 /mo</h4>
<div class="space-y-4 pt-6 border-t border-white/20">
<div class="flex justify-between items-center">
<span class="text-label-md opacity-70">Monthly Consumption</span>
<span class="font-bold text-body-lg" id="result_monthly_energy">24.0 kWh</span>
</div>
<div class="flex justify-between items-center">
<span class="text-label-md opacity-70">Daily Cost Average</span>
<span class="font-bold text-body-lg" id="result_daily_cost">$0.12</span>
</div>
</div>
</div>
</div>
<!-- Supplemental Data Cards -->
<div class="grid grid-cols-2 gap-4">
<div class="bg-surface-container-lowest border border-outline-variant rounded-lg p-5 soft-inset-shadow">
<p class="text-label-sm font-label-sm text-on-surface-variant mb-1">DAILY ENERGY</p>
<p class="text-headline-sm font-headline-sm text-primary" id="result_daily_energy">0.80 kWh</p>
</div>
<div class="bg-surface-container-lowest border border-outline-variant rounded-lg p-5 soft-inset-shadow">
<p class="text-label-sm font-label-sm text-on-surface-variant mb-1">WEEKLY ENERGY</p>
<p class="text-headline-sm font-headline-sm text-primary" id="result_weekly_energy">5.60 kWh</p>
</div>
</div>
<!-- Info/Tip Card -->
<div class="bg-surface-container border border-outline-variant rounded-lg p-6 flex gap-4 items-start">
<span class="material-symbols-outlined text-primary-container" data-icon="lightbulb">lightbulb</span>
<div>
<h5 class="font-bold text-label-md text-on-surface mb-1">Pro Tip</h5>
<p class="text-label-sm text-on-surface-variant leading-relaxed">Reducing daily usage by just 2 hours can lower your monthly energy expenses by up to 25% for high-wattage devices.</p>
</div>
</div>
</div>
</div>
</div>
</main>
<script>
        const powerInput = document.getElementById('power_rating');
        const usageInput = document.getElementById('daily_usage');
        const tariffInput = document.getElementById('utility_tariff');
        const usageDisplay = document.getElementById('usage_value');

        const monthlyCostDisplay = document.getElementById('result_monthly_cost');
        const monthlyEnergyDisplay = document.getElementById('result_monthly_energy');
        const dailyCostDisplay = document.getElementById('result_daily_cost');
        const dailyEnergyDisplay = document.getElementById('result_daily_energy');
        const weeklyEnergyDisplay = document.getElementById('result_weekly_energy');

        const calculateEnergy = () => {
            const power = parseFloat(powerInput.value) || 0;
            const hours = parseFloat(usageInput.value) || 0;
            const tariff = parseFloat(tariffInput.value) || 0;

            usageDisplay.innerText = `${hours}h`;

            // Calculations
            const dailyKwh = (power * hours) / 1000;
            const weeklyKwh = dailyKwh * 7;
            const monthlyKwh = dailyKwh * 30;

            const dailyCost = dailyKwh * tariff;
            const monthlyCost = monthlyKwh * tariff;

            // Update UI
            monthlyCostDisplay.innerText = `$${monthlyCost.toFixed(2)} /mo`;
            monthlyEnergyDisplay.innerText = `${monthlyKwh.toFixed(1)} kWh`;
            dailyCostDisplay.innerText = `$${dailyCost.toFixed(2)}`;
            dailyEnergyDisplay.innerText = `${dailyKwh.toFixed(2)} kWh`;
            weeklyEnergyDisplay.innerText = `${weeklyKwh.toFixed(2)} kWh`;
        };

        [powerInput, usageInput, tariffInput].forEach(input => {
            input.addEventListener('input', calculateEnergy);
        });

        document.getElementById('reset_btn').addEventListener('click', () => {
            document.getElementById('device_name').value = '';
            powerInput.value = 100;
            usageInput.value = 8;
            tariffInput.value = 0.15;
            calculateEnergy();
        });

        document.getElementById('save_btn').addEventListener('click', () => {
            const btn = document.getElementById('save_btn');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<span class="material-symbols-outlined animate-spin" data-icon="sync">sync</span> Saving...';
            btn.classList.add('opacity-80');
            
            setTimeout(() => {
                btn.innerHTML = '<span class="material-symbols-outlined" data-icon="check_circle">check_circle</span> Saved!';
                btn.classList.replace('bg-[#16A34A]', 'bg-tertiary-container');
                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.classList.replace('bg-tertiary-container', 'bg-[#16A34A]');
                    btn.classList.remove('opacity-80');
                }, 2000);
            }, 800);
        });

        // Initial Calc
        calculateEnergy();
    </script>


</body></html>