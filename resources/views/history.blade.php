<!DOCTYPE html><html class="light" lang="en"><head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Volt Energy - Device History</title>
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
                        "headline-sm": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
                        "label-md": ["14px", { "lineHeight": "20px", "fontWeight": "500" }],
                        "headline-md": ["24px", { "lineHeight": "32px", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                        "label-sm": ["12px", { "lineHeight": "16px", "fontWeight": "600" }],
                        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                        "display-lg": ["36px", { "lineHeight": "44px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }]
                    }
                },
            },
        }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        body {
            background-color: #f8f9ff;
            color: #0b1c30;
            font-family: 'Inter', sans-serif;
        }
        .soft-inset-card {
            box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1), 0px 1px 2px rgba(0, 0, 0, 0.06);
            border: 1px solid #E5E7EB;
        }
    </style>
</head>
<body class="flex min-h-screen">
<!-- SideNavBar Anchor -->
<aside class="fixed left-0 top-0 h-full w-[280px] bg-inverse-surface flex flex-col py-8 z-50">
<div class="px-6 mb-12">
<h1 class="text-headline-md font-headline-md font-bold text-on-secondary">Volt Energy</h1>
<p class="text-label-sm font-label-sm text-on-secondary opacity-60 tracking-widest">SYSTEM INTERFACE</p>
</div>
<nav class="flex-grow">
<ul class="space-y-1">
<!-- Dashboard -->
<li class="">
<a class="flex items-center px-6 py-3 text-on-secondary-container opacity-70 hover:bg-secondary-container/10 transition-colors text-label-md font-label-md" href="#">
<span class="material-symbols-outlined mr-4" data-icon="grid_view">grid_view</span>
                        Dashboard
                    </a>
</li>
<!-- Add Device -->
<li class="">
<a class="flex items-center px-6 py-3 text-on-secondary-container opacity-70 hover:bg-secondary-container/10 transition-colors text-label-md font-label-md" href="#">
<span class="material-symbols-outlined mr-4" data-icon="add_circle">add_circle</span>
                        Add Device
                    </a>
</li>
<!-- History - ACTIVE -->
<li class="">
<a class="flex items-center px-6 py-3 border-l-4 border-primary-container bg-inverse-surface text-on-secondary font-bold text-label-md font-label-md opacity-90 transition-all duration-200" href="/history">
<span class="material-symbols-outlined mr-4" data-icon="history">history</span>
                        History
                    </a>
</li>
<!-- Analytics -->
<li class="">
<a class="flex items-center px-6 py-3 text-on-secondary-container opacity-70 hover:bg-secondary-container/10 transition-colors text-label-md font-label-md" href="#">
<span class="material-symbols-outlined mr-4" data-icon="bar_chart">bar_chart</span>
                        Analytics
                    </a>
</li>
<!-- Eco Tips -->
<li class="">
<a class="flex items-center px-6 py-3 text-on-secondary-container opacity-70 hover:bg-secondary-container/10 transition-colors text-label-md font-label-md" href="#">

                        Eco Tips
                    </a>
</li>
</ul>
</nav>
<div class="px-6 mt-auto space-y-4 pt-8 border-t border-on-secondary/10">
<button class="w-full bg-primary-container text-white py-3 px-4 rounded font-label-md text-label-md flex items-center justify-center hover:bg-primary transition-colors">
<span class="material-symbols-outlined mr-2" data-icon="add">add</span>
                Add Device
            </button>
<div class="space-y-1">
<a class="flex items-center py-2 text-on-secondary-container opacity-70 hover:text-on-secondary transition-colors text-label-md font-label-md" href="#">
<span class="material-symbols-outlined mr-4" data-icon="settings">settings</span>
                    Settings
                </a>
<a class="flex items-center py-2 text-on-secondary-container opacity-70 hover:text-on-secondary transition-colors text-label-md font-label-md" href="#">
<span class="material-symbols-outlined mr-4" data-icon="logout">logout</span>
                    Logout
                </a>
</div>
</div>
</aside>
<!-- Main Content Wrapper -->
<div class="flex-grow ml-[280px]">
<!-- TopNavBar Anchor -->
<header class="flex justify-between items-center h-16 px-margin-desktop w-full bg-surface border-b border-outline-variant sticky top-0 z-40">
<div class="flex-1 max-w-xl">
<div class="relative group">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">search</span>
<input class="w-full pl-10 pr-4 py-2 bg-surface-container-low border border-outline-variant rounded focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all text-body-md font-body-md" placeholder="Search devices or history..." type="text">
</div>
</div>
<div class="flex items-center space-x-6 ml-4">
<button class="relative text-on-surface-variant hover:bg-surface-container-low p-2 rounded transition-colors">
<span class="material-symbols-outlined" data-icon="notifications">notifications</span>
<span class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full border-2 border-surface"></span>
</button>
<div class="flex items-center space-x-3 border-l border-outline-variant pl-6">
<div class="text-right">
<p class="text-label-sm font-label-sm text-on-surface">Alex Rivera</p>
<p class="text-[10px] text-on-surface-variant uppercase tracking-tighter">Researcher</p>
</div>
<img alt="User Avatar" class="w-8 h-8 rounded-full bg-secondary-container object-cover border border-outline-variant" data-alt="A professional headshot of a person with a neutral, focused expression. The lighting is studio-quality, clean, and bright, reflecting a modern corporate aesthetic. The background is a soft, out-of-focus high-tech research facility with cool blue and white tones that match the energy calculator app's visual identity." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCueVujRcEdBL4NQYyLSzYOeR4Igu-Kg6tme2dSFC7LjhK13ckHX_PX0zVT8yspb_H8Gh_NUvxeM-dXISn2sdhf4L7CvuaY4iBkJPFXIRBsg0m8NF9DZ2b0dS62oRsMKGvH4eirhVGsiKAoVziR5W_bD77OPxdYyY3ybFWmz_yNY9s6P5J9n1fWdiP847Fl8mQPhCeyJUIOFmtmrdPpIaod3ctEFcbP7jYlQRd-Sh34WsW7RQHoTjS2C-h7mRgr7Gdi3YVSghwycJo">
</div>
</div>
</header>
<!-- Page Canvas -->
<main class="p-margin-desktop max-w-container-max mx-auto">
<!-- Heading & Actions -->
<div class="flex flex-col md:flex-row md:items-end justify-between mb-8">
<div>
<h2 class="text-display-lg font-display-lg text-on-surface mb-1">Device History</h2>
<p class="text-body-md font-body-md text-on-surface-variant">Review energy consumption data for registered devices.</p>
</div>
<div class="flex items-center space-x-3 mt-4 md:mt-0">
<button class="flex items-center px-4 py-2 border border-outline text-on-surface-variant rounded hover:bg-surface-container-low transition-colors text-label-md font-label-md">
<span class="material-symbols-outlined text-[18px] mr-2" data-icon="filter_list">filter_list</span>
                        Filter
                    </button>
<button class="flex items-center px-4 py-2 border border-outline text-on-surface-variant rounded hover:bg-surface-container-low transition-colors text-label-md font-label-md">
<span class="material-symbols-outlined text-[18px] mr-2" data-icon="ios_share">ios_share</span>
                        Export
                    </button>
</div>
</div>
<!-- Data Table Card -->
<div class="bg-white soft-inset-card rounded overflow-hidden">
<div class="overflow-x-auto">
<table class="w-full border-collapse text-left">
<thead>
<tr class="bg-surface-container-low border-b border-outline-variant">
<th class="px-6 py-4 text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">Device Name</th>
<th class="px-6 py-4 text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">Power (W)</th>
<th class="px-6 py-4 text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">Usage (Hrs/Day)</th>
<th class="px-6 py-4 text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">Energy (kWh)</th>
<th class="px-6 py-4 text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">Est. Cost</th>
<th class="px-6 py-4 text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider">Date Added</th>
<th class="px-6 py-4 text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider text-right">Actions</th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant">
<!-- Row 1 -->
<tr class="hover:bg-surface-container-lowest transition-colors group">
<td class="px-6 py-4">
<div class="flex items-center">
<div class="w-10 h-10 rounded bg-secondary-container/30 flex items-center justify-center mr-3">
<span class="material-symbols-outlined text-primary" data-icon="computer">computer</span>
</div>
<div>
<p class="text-label-md font-label-md text-on-surface">Workstation PC</p>
<p class="text-[11px] text-on-surface-variant">Dell Precision 5820</p>
</div>
</div>
</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface">450W</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface">8.5h</td>
<td class="px-6 py-4 text-body-md font-body-md text-primary font-semibold">3.83 kWh</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface">$0.57</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface-variant">May 12, 2024</td>
<td class="px-6 py-4 text-right">
<div class="flex items-center justify-end space-x-1 opacity-0 group-hover:opacity-100 transition-opacity">
<button class="p-2 text-on-surface-variant hover:text-primary transition-colors">
<span class="material-symbols-outlined text-[18px]" data-icon="edit">edit</span>
</button>
<button class="p-2 text-on-surface-variant hover:text-error transition-colors">
<span class="material-symbols-outlined text-[18px]" data-icon="delete">delete</span>
</button>
</div>
</td>
</tr>
<!-- Row 2 -->
<tr class="hover:bg-surface-container-lowest transition-colors group">
<td class="px-6 py-4">
<div class="flex items-center">
<div class="w-10 h-10 rounded bg-secondary-container/30 flex items-center justify-center mr-3">
<span class="material-symbols-outlined text-primary" data-icon="ac_unit">ac_unit</span>
</div>
<div>
<p class="text-label-md font-label-md text-on-surface">AC Unit - Main Lab</p>
<p class="text-[11px] text-on-surface-variant">Carrier Comfort 15</p>
</div>
</div>
</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface">1,200W</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface">12.0h</td>
<td class="px-6 py-4 text-body-md font-body-md text-primary font-semibold">14.40 kWh</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface">$2.16</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface-variant">May 10, 2024</td>
<td class="px-6 py-4 text-right">
<div class="flex items-center justify-end space-x-1 opacity-0 group-hover:opacity-100 transition-opacity">
<button class="p-2 text-on-surface-variant hover:text-primary transition-colors">
<span class="material-symbols-outlined text-[18px]" data-icon="edit">edit</span>
</button>
<button class="p-2 text-on-surface-variant hover:text-error transition-colors">
<span class="material-symbols-outlined text-[18px]" data-icon="delete">delete</span>
</button>
</div>
</td>
</tr>
<!-- Row 3 -->
<tr class="hover:bg-surface-container-lowest transition-colors group">
<td class="px-6 py-4">
<div class="flex items-center">
<div class="w-10 h-10 rounded bg-secondary-container/30 flex items-center justify-center mr-3">
<span class="material-symbols-outlined text-primary" data-icon="lightbulb">lightbulb</span>
</div>
<div>
<p class="text-label-md font-label-md text-on-surface">Server Room Lighting</p>
<p class="text-[11px] text-on-surface-variant">LED Grid Array</p>
</div>
</div>
</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface">85W</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface">24.0h</td>
<td class="px-6 py-4 text-body-md font-body-md text-primary font-semibold">2.04 kWh</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface">$0.31</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface-variant">May 09, 2024</td>
<td class="px-6 py-4 text-right">
<div class="flex items-center justify-end space-x-1 opacity-0 group-hover:opacity-100 transition-opacity">
<button class="p-2 text-on-surface-variant hover:text-primary transition-colors">
<span class="material-symbols-outlined text-[18px]" data-icon="edit">edit</span>
</button>
<button class="p-2 text-on-surface-variant hover:text-error transition-colors">
<span class="material-symbols-outlined text-[18px]" data-icon="delete">delete</span>
</button>
</div>
</td>
</tr>
<!-- Row 4 -->
<tr class="hover:bg-surface-container-lowest transition-colors group">
<td class="px-6 py-4">
<div class="flex items-center">
<div class="w-10 h-10 rounded bg-secondary-container/30 flex items-center justify-center mr-3">
<span class="material-symbols-outlined text-primary" data-icon="print">print</span>
</div>
<div>
<p class="text-label-md font-label-md text-on-surface">Industrial 3D Printer</p>
<p class="text-[11px] text-on-surface-variant">Ultimaker S7</p>
</div>
</div>
</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface">500W</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface">5.0h</td>
<td class="px-6 py-4 text-body-md font-body-md text-primary font-semibold">2.50 kWh</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface">$0.38</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface-variant">May 08, 2024</td>
<td class="px-6 py-4 text-right">
<div class="flex items-center justify-end space-x-1 opacity-0 group-hover:opacity-100 transition-opacity">
<button class="p-2 text-on-surface-variant hover:text-primary transition-colors">
<span class="material-symbols-outlined text-[18px]" data-icon="edit">edit</span>
</button>
<button class="p-2 text-on-surface-variant hover:text-error transition-colors">
<span class="material-symbols-outlined text-[18px]" data-icon="delete">delete</span>
</button>
</div>
</td>
</tr>
<!-- Row 5 -->
<tr class="hover:bg-surface-container-lowest transition-colors group">
<td class="px-6 py-4">
<div class="flex items-center">
<div class="w-10 h-10 rounded bg-secondary-container/30 flex items-center justify-center mr-3">
<span class="material-symbols-outlined text-primary" data-icon="kitchen">kitchen</span>
</div>
<div>
<p class="text-label-md font-label-md text-on-surface">Breakroom Fridge</p>
<p class="text-[11px] text-on-surface-variant">Samsung RF28</p>
</div>
</div>
</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface">150W</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface">24.0h</td>
<td class="px-6 py-4 text-body-md font-body-md text-primary font-semibold">3.60 kWh</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface">$0.54</td>
<td class="px-6 py-4 text-body-md font-body-md text-on-surface-variant">May 07, 2024</td>
<td class="px-6 py-4 text-right">
<div class="flex items-center justify-end space-x-1 opacity-0 group-hover:opacity-100 transition-opacity">
<button class="p-2 text-on-surface-variant hover:text-primary transition-colors">
<span class="material-symbols-outlined text-[18px]" data-icon="edit">edit</span>
</button>
<button class="p-2 text-on-surface-variant hover:text-error transition-colors">
<span class="material-symbols-outlined text-[18px]" data-icon="delete">delete</span>
</button>
</div>
</td>
</tr>
</tbody>
</table>
</div>
<!-- Pagination Area -->
<div class="px-6 py-4 bg-surface-container-low border-t border-outline-variant flex flex-col sm:flex-row items-center justify-between gap-4">
<p class="text-label-md font-label-md text-on-surface-variant">
                        Showing 1 to 5 of 42 devices
                    </p>
<div class="flex items-center space-x-1">
<button class="w-8 h-8 flex items-center justify-center rounded border border-outline-variant text-on-surface-variant hover:bg-surface-container-highest transition-all">
<span class="material-symbols-outlined text-[18px]" data-icon="chevron_left">chevron_left</span>
</button>
<button class="w-8 h-8 flex items-center justify-center rounded border border-primary bg-primary text-white font-label-md text-label-md">1</button>
<button class="w-8 h-8 flex items-center justify-center rounded border border-outline-variant text-on-surface-variant hover:bg-surface-container-highest transition-all font-label-md text-label-md">2</button>
<button class="w-8 h-8 flex items-center justify-center rounded border border-outline-variant text-on-surface-variant hover:bg-surface-container-highest transition-all font-label-md text-label-md">3</button>
<button class="w-8 h-8 flex items-center justify-center rounded border border-outline-variant text-on-surface-variant hover:bg-surface-container-highest transition-all">
<span class="material-symbols-outlined text-[18px]" data-icon="chevron_right">chevron_right</span>
</button>
</div>
</div>
</div>
<!-- Footer Meta -->
<div class="mt-8 pt-8 border-t border-outline-variant flex flex-col md:flex-row items-center justify-between gap-4">
<div class="flex items-center space-x-4">
<div class="flex items-center text-label-sm font-label-sm text-on-surface-variant">
<span class="material-symbols-outlined text-[16px] mr-1" data-icon="update">update</span>
                        Last updated: 14 mins ago
                    </div>
<div class="flex items-center text-label-sm font-label-sm text-on-surface-variant">
<span class="material-symbols-outlined text-[16px] mr-1" data-icon="database">database</span>
                        Source: Lab Mainframe
                    </div>
</div>
<p class="text-[11px] text-on-surface-variant/60 font-medium uppercase tracking-widest">Volt Energy System v2.4.1</p>
</div>
</main>
</div>
<!-- Micro-interaction Script -->
<script>
        // Simple search highlight effect
        const searchInput = document.querySelector('input[type="text"]');
        searchInput.addEventListener('focus', () => {
            searchInput.parentElement.classList.add('scale-[1.01]');
        });
        searchInput.addEventListener('blur', () => {
            searchInput.parentElement.classList.remove('scale-[1.01]');
        });

        // Row hover interaction logic is handled by Tailwind 'group' and 'hover:' classes
    </script>


</body></html>