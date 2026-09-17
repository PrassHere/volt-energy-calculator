<!DOCTYPE html><html class="light" lang="en"><head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Volt Energy - Analytics</title>
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
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .chart-grid-line { stroke: #E5E7EB; stroke-width: 1; stroke-dasharray: 4; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #D1D5DB; border-radius: 10px; }
    </style>
</head>
<body class="bg-background text-on-background">
<!-- Sidebar Navigation -->
<aside class="fixed left-0 top-0 h-full w-[280px] bg-inverse-surface flex flex-col py-8 z-50">
<div class="px-6 mb-10">
<h1 class="text-headline-md font-headline-md font-bold text-on-secondary">Volt Energy</h1>
<p class="text-label-sm font-label-sm text-on-secondary opacity-60 tracking-widest">SYSTEM INTERFACE</p>
</div>
<nav class="flex-1 px-4 space-y-1">
<a class="flex items-center gap-3 px-4 py-3 text-on-secondary-container opacity-70 hover:bg-secondary-container/10 transition-colors rounded-lg group" href="#">
<span class="material-symbols-outlined">grid_view</span>
<span class="text-label-md font-label-md">Dashboard</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-on-secondary-container opacity-70 hover:bg-secondary-container/10 transition-colors rounded-lg group" href="#">
<span class="material-symbols-outlined">add_circle</span>
<span class="text-label-md font-label-md">Add Device</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-on-secondary-container opacity-70 hover:bg-secondary-container/10 transition-colors rounded-lg group" href="#">
<span class="material-symbols-outlined">history</span>
<span class="text-label-md font-label-md">History</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 border-l-4 border-primary-container bg-inverse-surface text-on-secondary font-bold transition-all duration-200" href="#">
<span class="material-symbols-outlined" style="font-variation-settings: &quot;FILL&quot; 1;">bar_chart</span>
<span class="text-label-md font-label-md">Analytics</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-on-secondary-container opacity-70 hover:bg-secondary-container/10 transition-colors rounded-lg group" href="#">

<span class="text-label-md font-label-md">Eco Tips</span>
</a>
</nav>
<div class="mt-auto px-4 space-y-1">
<a class="flex items-center gap-3 px-4 py-3 text-on-secondary-container opacity-70 hover:bg-secondary-container/10 transition-colors rounded-lg" href="#">
<span class="material-symbols-outlined">settings</span>
<span class="text-label-md font-label-md">Settings</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-on-secondary-container opacity-70 hover:bg-secondary-container/10 transition-colors rounded-lg" href="#">
<span class="material-symbols-outlined">logout</span>
<span class="text-label-md font-label-md">Logout</span>
</a>
</div>
</aside>
<!-- Main Content Area -->
<main class="ml-[280px] min-h-screen flex flex-col">
<!-- Top Navigation Bar -->
<header class="h-16 flex justify-between items-center px-8 w-full border-b border-outline-variant bg-surface sticky top-0 z-40">
<div class="flex items-center gap-4">
<h2 class="text-headline-sm font-headline-sm text-on-surface">Analytics Overview</h2>
</div>
<div class="flex items-center gap-6">
<!-- Toggle Switch -->
<div class="flex bg-surface-container-low p-1 rounded-lg border border-outline-variant">
<button class="px-4 py-1 text-label-sm font-label-sm bg-surface-container-lowest text-primary soft-inset-shadow rounded transition-all" id="toggle-week">Week</button>
<button class="px-4 py-1 text-label-sm font-label-sm text-on-surface-variant hover:text-on-surface transition-all" id="toggle-month">Month</button>
</div>
<div class="flex items-center gap-3 border-l border-outline-variant pl-6">
<button class="text-on-surface-variant hover:bg-surface-container-low p-2 rounded-full transition-colors">
<span class="material-symbols-outlined">notifications</span>
</button>
<img alt="User Avatar" class="w-8 h-8 rounded-full border border-outline-variant bg-surface-container-high" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBfHWku7HVcqTI5tkYd4EG0FxPheuY3nefZgBYXoWlvNNXgFh6gTH9-BLOMGI8sUv44HUyqvvzDOFl18CbsHR3IfF0_BQpsc2V5DOu7P15sDOWlAJEJ-ePbIGHBwdrrRHHV36s3ZBzCBvnKnXoWs1wd0y-ZHsHeiEbw_IWCsvJDLPWac2qID2d5TXgVL02e1FOk1rpaoD5w855Veaas9ZjPnG6UZ1NG9uYbx0wghD6OLrZHnAg0feHBKTTSWFnL3OCEDfZ_mlwff0M">
</div>
</div>
</header>
<!-- Analytics Canvas -->
<div class="p-8 space-y-8 max-w-[1400px]">
<!-- Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
<!-- Total Consumption Card -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 soft-inset-shadow flex justify-between items-start">
<div class="space-y-4">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-lg bg-primary-container/10 flex items-center justify-center text-primary">
<span class="material-symbols-outlined" style="font-variation-settings: &quot;FILL&quot; 1;">bolt</span>
</div>
<span class="text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Total Consumption</span>
</div>
<div class="space-y-1">
<h3 class="text-display-lg font-display-lg text-on-surface">1,284.5 <span class="text-headline-sm font-headline-sm text-on-surface-variant">kWh</span></h3>
</div>
</div>
<div class="flex items-center gap-1 px-3 py-1 bg-tertiary-fixed text-on-tertiary-fixed-variant rounded-full text-label-sm font-label-sm">
<span class="material-symbols-outlined text-[16px]">arrow_downward</span>
                        12% vs last month
                    </div>
</div>
<!-- Estimated Cost Card -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 soft-inset-shadow flex justify-between items-start">
<div class="space-y-4">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-lg bg-secondary-container/50 flex items-center justify-center text-primary">
<span class="material-symbols-outlined" style="font-variation-settings: &quot;FILL&quot; 1;">account_balance_wallet</span>
</div>
<span class="text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Estimated Cost</span>
</div>
<div class="space-y-1">
<h3 class="text-display-lg font-display-lg text-on-surface">$241.08</h3>
</div>
</div>
<div class="flex items-center gap-1 px-3 py-1 bg-error-container text-on-error-container rounded-full text-label-sm font-label-sm">
<span class="material-symbols-outlined text-[16px]">arrow_upward</span>
                        3% vs expected
                    </div>
</div>
</div>
<!-- Side-by-Side Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-gutter">
<!-- Energy Consumption Bar Chart -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 soft-inset-shadow">
<div class="flex justify-between items-center mb-8 border-b border-outline-variant pb-4">
<h4 class="text-headline-sm font-headline-sm text-on-surface">Energy Consumption</h4>
<span class="text-label-sm font-label-sm text-on-surface-variant">Daily Average: 42.1 kWh</span>
</div>
<div class="h-64 flex items-end justify-between gap-2 px-2">
<!-- Monday -->
<div class="flex-1 flex flex-col items-center gap-2 group">
<div class="w-full bg-primary-container/20 rounded-t-sm h-[40%] group-hover:bg-primary-container transition-all relative">
<div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-inverse-surface text-on-secondary text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">38kWh</div>
</div>
<span class="text-label-sm font-label-sm text-on-surface-variant">MON</span>
</div>
<!-- Tuesday -->
<div class="flex-1 flex flex-col items-center gap-2 group">
<div class="w-full bg-primary-container/20 rounded-t-sm h-[65%] group-hover:bg-primary-container transition-all relative">
<div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-inverse-surface text-on-secondary text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">52kWh</div>
</div>
<span class="text-label-sm font-label-sm text-on-surface-variant">TUE</span>
</div>
<!-- Wednesday -->
<div class="flex-1 flex flex-col items-center gap-2 group">
<div class="w-full bg-primary-container/20 rounded-t-sm h-[55%] group-hover:bg-primary-container transition-all relative">
<div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-inverse-surface text-on-secondary text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">45kWh</div>
</div>
<span class="text-label-sm font-label-sm text-on-surface-variant">WED</span>
</div>
<!-- Thursday -->
<div class="flex-1 flex flex-col items-center gap-2 group">
<div class="w-full bg-primary-container/20 rounded-t-sm h-[85%] group-hover:bg-primary-container transition-all relative">
<div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-inverse-surface text-on-secondary text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">68kWh</div>
</div>
<span class="text-label-sm font-label-sm text-on-surface-variant">THU</span>
</div>
<!-- Friday -->
<div class="flex-1 flex flex-col items-center gap-2 group">
<div class="w-full bg-primary-container/20 rounded-t-sm h-[70%] group-hover:bg-primary-container transition-all relative">
<div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-inverse-surface text-on-secondary text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">58kWh</div>
</div>
<span class="text-label-sm font-label-sm text-on-surface-variant">FRI</span>
</div>
<!-- Saturday -->
<div class="flex-1 flex flex-col items-center gap-2 group">
<div class="w-full bg-primary-container/20 rounded-t-sm h-[45%] group-hover:bg-primary-container transition-all relative">
<div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-inverse-surface text-on-secondary text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">41kWh</div>
</div>
<span class="text-label-sm font-label-sm text-on-surface-variant">SAT</span>
</div>
<!-- Sunday -->
<div class="flex-1 flex flex-col items-center gap-2 group">
<div class="w-full bg-primary-container h-[35%] rounded-t-sm transition-all relative">
<div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-inverse-surface text-on-secondary text-[10px] px-2 py-1 rounded opacity-100 transition-opacity">32kWh</div>
</div>
<span class="text-label-sm font-label-sm text-primary font-bold">SUN</span>
</div>
</div>
</div>
<!-- Device Allocation Donut Chart -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 soft-inset-shadow">
<div class="flex justify-between items-center mb-8 border-b border-outline-variant pb-4">
<h4 class="text-headline-sm font-headline-sm text-on-surface">Device Allocation</h4>
<span class="text-label-sm font-label-sm text-on-surface-variant">Oct 1 - Oct 7</span>
</div>
<div class="flex items-center justify-around h-64">
<!-- Custom SVG Donut -->
<div class="relative w-48 h-48">
<svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
<!-- Base Circle -->
<circle cx="50" cy="50" fill="transparent" r="40" stroke="#E5E7EB" stroke-width="12"></circle>
<!-- HVAC 45% -->
<circle cx="50" cy="50" fill="transparent" r="40" stroke="#1D4ED8" stroke-dasharray="251.2" stroke-dashoffset="138.16" stroke-width="12"></circle>
<!-- Lighting 25% -->
<circle cx="50" cy="50" fill="transparent" r="40" stroke="#60A5FA" stroke-dasharray="251.2" stroke-dashoffset="200.96" stroke-width="12" transform="rotate(162 50 50)"></circle>
<!-- Appliances 20% -->
<circle cx="50" cy="50" fill="transparent" r="40" stroke="#93C5FD" stroke-dasharray="251.2" stroke-dashoffset="213.52" stroke-width="12" transform="rotate(252 50 50)"></circle>
<!-- Others 10% -->
<circle cx="50" cy="50" fill="transparent" r="40" stroke="#DBEAFE" stroke-dasharray="251.2" stroke-dashoffset="238.64" stroke-width="12" transform="rotate(324 50 50)"></circle>
</svg>
<div class="absolute inset-0 flex flex-col items-center justify-center">
<span class="text-display-lg font-display-lg leading-tight">45%</span>
<span class="text-label-sm font-label-sm text-on-surface-variant">HVAC</span>
</div>
</div>
<!-- Legend -->
<div class="space-y-3">
<div class="flex items-center gap-3">
<span class="w-3 h-3 rounded-full bg-[#1D4ED8]"></span>
<span class="text-label-md font-label-md text-on-surface w-24">HVAC</span>
<span class="text-label-md font-label-md text-on-surface-variant">45%</span>
</div>
<div class="flex items-center gap-3">
<span class="w-3 h-3 rounded-full bg-[#60A5FA]"></span>
<span class="text-label-md font-label-md text-on-surface w-24">Lighting</span>
<span class="text-label-md font-label-md text-on-surface-variant">25%</span>
</div>
<div class="flex items-center gap-3">
<span class="w-3 h-3 rounded-full bg-[#93C5FD]"></span>
<span class="text-label-md font-label-md text-on-surface w-24">Appliances</span>
<span class="text-label-md font-label-md text-on-surface-variant">20%</span>
</div>
<div class="flex items-center gap-3">
<span class="w-3 h-3 rounded-full bg-[#DBEAFE]"></span>
<span class="text-label-md font-label-md text-on-surface w-24">Others</span>
<span class="text-label-md font-label-md text-on-surface-variant">10%</span>
</div>
</div>
</div>
</div>
</div>
<!-- Full-Width Cost Projection Chart -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 soft-inset-shadow">
<div class="flex justify-between items-center mb-8 border-b border-outline-variant pb-4">
<div class="space-y-1">
<h4 class="text-headline-sm font-headline-sm text-on-surface">Cost Projections</h4>
<p class="text-body-md font-body-md text-on-surface-variant">Based on current usage patterns and utility rates</p>
</div>
<div class="flex gap-4">
<div class="flex items-center gap-2">
<span class="w-4 h-0.5 bg-primary"></span>
<span class="text-label-sm font-label-sm text-on-surface-variant">Actual Cost</span>
</div>
<div class="flex items-center gap-2">
<span class="w-4 h-0.5 border-t-2 border-dashed border-outline"></span>
<span class="text-label-sm font-label-sm text-on-surface-variant">Projected Budget</span>
</div>
</div>
</div>
<div class="relative h-80 w-full">
<!-- Simple SVG Line Chart Placeholder for professional look -->
<svg class="w-full h-full overflow-visible" preserveAspectRatio="none" viewBox="0 0 1000 300">
<!-- Grid Lines -->
<line class="chart-grid-line" x1="0" x2="1000" y1="300" y2="300"></line>
<line class="chart-grid-line" x1="0" x2="1000" y1="225" y2="225"></line>
<line class="chart-grid-line" x1="0" x2="1000" y1="150" y2="150"></line>
<line class="chart-grid-line" x1="0" x2="1000" y1="75" y2="75"></line>
<line class="chart-grid-line" x1="0" x2="1000" y1="0" y2="0"></line>
<!-- Projected Budget Line (Dashed) -->
<polyline fill="none" points="0,200 250,180 500,160 750,140 1000,120" stroke="#94A3B8" stroke-dasharray="8,4" stroke-width="2"></polyline>
<!-- Actual Cost Line (Solid Blue) -->
<path d="M 0 250 Q 125 240, 250 210 T 500 180 T 750 145" fill="none" stroke="#1D4ED8" stroke-linecap="round" stroke-width="3"></path>
<!-- Data Point -->
<circle cx="750" cy="145" fill="#1D4ED8" r="5" stroke="white" stroke-width="2"></circle>
</svg>
<!-- X-Axis Labels -->
<div class="flex justify-between mt-4 px-2">
<span class="text-label-sm font-label-sm text-on-surface-variant">Week 1</span>
<span class="text-label-sm font-label-sm text-on-surface-variant">Week 2</span>
<span class="text-label-sm font-label-sm text-on-surface-variant">Week 3</span>
<span class="text-label-sm font-label-sm text-on-surface-variant">Week 4</span>
</div>
<!-- Y-Axis Labels -->
<div class="absolute -left-12 inset-y-0 flex flex-col justify-between text-label-sm font-label-sm text-on-surface-variant py-0">
<span class="">$400</span>
<span class="">$300</span>
<span class="">$200</span>
<span class="">$100</span>
<span class="">$0</span>
</div>
</div>
</div>
</div>
</main>
<script>
        // Micro-interactions for toggles
        const weekBtn = document.getElementById('toggle-week');
        const monthBtn = document.getElementById('toggle-month');

        const setActive = (active, inactive) => {
            active.classList.add('bg-surface-container-lowest', 'text-primary', 'soft-inset-shadow');
            active.classList.remove('text-on-surface-variant');
            inactive.classList.remove('bg-surface-container-lowest', 'text-primary', 'soft-inset-shadow');
            inactive.classList.add('text-on-surface-variant');
        };

        weekBtn.addEventListener('click', () => setActive(weekBtn, monthBtn));
        monthBtn.addEventListener('click', () => setActive(monthBtn, weekBtn));
    </script>


</body></html>