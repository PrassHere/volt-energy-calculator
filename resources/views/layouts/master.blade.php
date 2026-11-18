<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Volt Energy')</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    
<script>
tailwind.config = {
    darkMode: "class",
    theme: {
        extend: {
            colors: {
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
            borderRadius: {
                DEFAULT: "0.125rem",
                lg: "0.25rem",
                xl: "0.5rem",
                full: "0.75rem"
            },
            spacing: {
                "margin-desktop": "32px",
                "margin-mobile": "16px",
                "base": "4px",
                "container-max": "1280px",
                "gutter": "24px",
                "topbar-height": "64px",
                "sidebar-width": "280px"
            },
            fontFamily: {
                "headline-sm": ["Inter"],
                "label-md": ["Inter"],
                "headline-md": ["Inter"],
                "label-sm": ["Inter"],
                "body-md": ["Inter"],
                "display-lg": ["Inter"],
                "body-lg": ["Inter"]
            },
            fontSize: {
                "headline-sm": ["20px", {lineHeight: "28px", fontWeight: "600"}],
                "label-md": ["14px", {lineHeight: "20px", fontWeight: "500"}],
                "headline-md": ["24px", {lineHeight: "32px", letterSpacing: "-0.01em", fontWeight: "600"}],
                "label-sm": ["12px", {lineHeight: "16px", fontWeight: "600"}],
                "body-md": ["16px", {lineHeight: "24px", fontWeight: "400"}],
                "display-lg": ["36px", {lineHeight: "44px", letterSpacing: "-0.02em", fontWeight: "700"}],
                "body-lg": ["18px", {lineHeight: "28px", fontWeight: "400"}]
            }
        }
    }
};
</script>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('head_scripts')
    @stack('styles')
</head>

<body class="bg-surface text-on-surface font-sans">

    @if (request()->is('/') || request()->is('auth.login') || request()->is('auth.registrasi'))

        {{-- Halaman Login & Registrasi tanpa sidebar --}}
        @yield('content')

    @else

        {{-- Halaman aplikasi dengan sidebar --}}
        @include('partials.nav')

        <div class="ml-60 min-h-screen flex flex-col">

            @include('partials.header')

            <main class="flex-1">
                @yield('content')
            </main>

            @include('partials.footer')

        </div>

    @endif

    @stack('scripts')

</body>
</html>
