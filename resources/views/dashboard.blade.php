<!doctype html>
<html class="light" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Volt Energy - Dashboard</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "on-secondary": "#ffffff",
              "on-tertiary-container": "#71ee8a",
              error: "#ba1a1a",
              "inverse-surface": "#213145",
              "on-surface": "#0b1c30",
              "on-background": "#0b1c30",
              "primary-container": "#1d4ed8",
              "on-secondary-fixed": "#111c2d",
              primary: "#0037b0",
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
              surface: "#f8f9ff",
              tertiary: "#00501f",
              "secondary-fixed": "#d8e3fb",
              outline: "#747686",
              background: "#f8f9ff",
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
              secondary: "#545f73",
              "on-error-container": "#93000a",
              "surface-tint": "#2151da",
              "surface-dim": "#cbdbf5",
              "primary-fixed-dim": "#b7c4ff",
            },
            borderRadius: {
              DEFAULT: "0.125rem",
              lg: "0.25rem",
              xl: "0.5rem",
              full: "0.75rem",
            },
            spacing: {
              "margin-desktop": "32px",
              "margin-mobile": "16px",
              base: "4px",
              "container-max": "1280px",
              gutter: "24px",
              "topbar-height": "64px",
              "sidebar-width": "280px",
            },
            fontFamily: {
              "headline-sm": ["Inter"],
              "label-md": ["Inter"],
              "headline-md": ["Inter"],
              "label-sm": ["Inter"],
              "body-md": ["Inter"],
              "display-lg": ["Inter"],
              "body-lg": ["Inter"],
            },
            fontSize: {
              "headline-sm": [
                "20px",
                { lineHeight: "28px", fontWeight: "600" },
              ],
              "label-md": ["14px", { lineHeight: "20px", fontWeight: "500" }],
              "headline-md": [
                "24px",
                {
                  lineHeight: "32px",
                  letterSpacing: "-0.01em",
                  fontWeight: "600",
                },
              ],
              "label-sm": ["12px", { lineHeight: "16px", fontWeight: "600" }],
              "body-md": ["16px", { lineHeight: "24px", fontWeight: "400" }],
              "display-lg": [
                "36px",
                {
                  lineHeight: "44px",
                  letterSpacing: "-0.02em",
                  fontWeight: "700",
                },
              ],
              "body-lg": ["18px", { lineHeight: "28px", fontWeight: "400" }],
            },
          },
        },
      };
    </script>
    <style>
      body {
        font-family: "Inter", sans-serif;
        background-color: #f8f9ff;
      }
      .soft-inset-shadow {
        box-shadow:
          0px 1px 3px rgba(0, 0, 0, 0.1),
          0px 1px 2px rgba(0, 0, 0, 0.06);
      }
      .material-symbols-outlined {
        font-variation-settings:
          "FILL" 0,
          "wght" 400,
          "GRAD" 0,
          "opsz" 24;
      }
      .active-border {
        border-left: 4px solid #1d4ed8;
      }
    </style>
  </head>
  <body class="bg-background text-on-background">
    <!-- Sidebar (Shared Component: SideNavBar) -->
    <aside
      class="fixed left-0 top-0 h-full w-[280px] bg-inverse-surface flex flex-col py-8 z-50"
    >
      <div class="px-6 mb-10">
        <h1
          class="text-headline-md font-headline-md font-bold text-on-secondary"
        >
          Volt Energy
        </h1>
        <p
          class="text-label-sm font-label-sm tracking-widest text-on-secondary opacity-60 uppercase mt-1"
        >
          SYSTEM INTERFACE
        </p>
      </div>
      <nav class="flex-grow">
        <ul class="space-y-1">
          <!-- Active Item: Dashboard -->
          <li
            class="border-l-4 border-primary-container bg-inverse-surface text-on-secondary font-bold py-3 px-6 flex items-center gap-4 transition-all duration-200"
          >
            <span class="material-symbols-outlined" data-icon="grid_view"
              >grid_view</span
            >
            <span class="text-label-md font-label-md">Dashboard</span>
          </li>
          <li
            class="text-on-secondary-container opacity-70 hover:bg-secondary-container/10 transition-colors py-3 px-6 flex items-center gap-4"
          >
            <span class="material-symbols-outlined" data-icon="add_circle"
              >add_circle</span
            >
            <span class="text-label-md font-label-md">Add Device</span>
          </li>
          <li
            class="text-on-secondary-container opacity-70 hover:bg-secondary-container/10 transition-colors py-3 px-6 flex items-center gap-4"
          >
            <span class="material-symbols-outlined" data-icon="history"
              >history</span
            >
            <span class="text-label-md font-label-md">History</span>
          </li>
          <li
            class="text-on-secondary-container opacity-70 hover:bg-secondary-container/10 transition-colors py-3 px-6 flex items-center gap-4"
          >
            <span class="material-symbols-outlined" data-icon="bar_chart"
              >bar_chart</span
            >
            <span class="text-label-md font-label-md">Analytics</span>
          </li>
          <li
            class="text-on-secondary-container opacity-70 hover:bg-secondary-container/10 transition-colors py-3 px-6 flex items-center gap-4"
          >
            <span class="text-label-md font-label-md">Eco Tips</span>
          </li>
        </ul>
      </nav>
      <div class="mt-auto border-t border-on-secondary/10 pt-6">
        <ul class="space-y-1">
          <li
            class="text-on-secondary-container opacity-70 hover:bg-secondary-container/10 transition-colors py-3 px-6 flex items-center gap-4"
          >
            <span class="material-symbols-outlined" data-icon="settings"
              >settings</span
            >
            <span class="text-label-md font-label-md">Settings</span>
          </li>
          <li
            class="text-on-secondary-container opacity-70 hover:bg-secondary-container/10 transition-colors py-3 px-6 flex items-center gap-4"
          >
            <span class="material-symbols-outlined" data-icon="logout"
              >logout</span
            >
            <span class="text-label-md font-label-md">Logout</span>
          </li>
        </ul>
      </div>
    </aside>
    <!-- Main Content Wrapper -->
    <div class="ml-[280px] min-h-screen flex flex-col">
      <!-- Top Navigation Bar (Shared Component: TopNavBar) -->
      <header
        class="h-16 flex justify-between items-center px-8 w-full bg-surface border-b border-outline-variant z-40"
      >
        <div class="flex flex-col">
          <h2 class="text-headline-sm font-headline-sm text-on-surface">
            Dashboard Overview
          </h2>
          <p class="text-label-sm font-label-sm text-on-surface-variant">
            Welcome back, Alex. System status is nominal.
          </p>
        </div>
        <div class="flex items-center gap-6">
          <div class="relative group cursor-pointer">
            <span
              class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-colors"
              data-icon="notifications"
              >notifications</span
            >
            <span
              class="absolute top-0 right-0 h-2 w-2 bg-error rounded-full"
            ></span>
          </div>
          <div
            class="flex items-center gap-3 pl-6 border-l border-outline-variant"
          >
            <span class="text-label-md font-label-md text-on-surface"
              >Alex Graham</span
            >
            <img
              alt="Alex Graham"
              class="h-10 w-10 rounded-full border border-outline-variant object-cover"
              data-alt="A professional headshot of a middle-aged male user with short brown hair and a friendly expression, set against a clean, light gray studio background. The lighting is soft and even, highlighting a corporate professional aesthetic. The image is circular-cropped for UI use, reflecting a stable and reliable account profile character within a modern energy management dashboard."
              src="https://lh3.googleusercontent.com/aida-public/AB6AXuCj0ZJL8kn8oDDmbdhfiJ6cVD78b5ms0HDLkaWa6jJiN2Et4Vr4RoxAl57NqoZuROgCznpybpK7HTGz9pqp7R1--JnubMFJxYgnvx54SIO3EdqH7thyJVtYDthjjV50aiJvtE8xxgxUJ17v6RKyGT1ZMNiHvCUo5JhNXnCqUqzXY0IWkK2YUarIRb0Xs40RaFqPqpUqCMkzGdNlcZH-6-RPoWbPCkoJVKgCERbRwBu3wNt4oRgDTcv0lp0WJfU_cjrColM2JXhFwF0"
            />
          </div>
        </div>
      </header>
      <!-- Page Canvas -->
      <main class="p-8 max-w-container-max mx-auto w-full">
        <!-- Summary Cards Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
          <!-- Card 1: Active Devices -->
          <div
            class="bg-surface-container-lowest border border-outline-variant rounded-lg p-6 soft-inset-shadow transition-all hover:border-primary"
          >
            <div class="flex justify-between items-start mb-4">
              <div
                class="h-12 w-12 rounded-lg bg-primary-container/10 flex items-center justify-center"
              >
                <span
                  class="material-symbols-outlined text-primary"
                  data-icon="devices"
                  >devices</span
                >
              </div>
              <span
                class="bg-primary-container/10 text-primary text-[10px] font-bold px-2 py-1 rounded-full"
                >+12%</span
              >
            </div>
            <p
              class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider"
            >
              Active Devices
            </p>
            <h3 class="text-display-lg font-display-lg text-on-surface mt-1">
              24
            </h3>
            <div
              class="mt-4 flex items-center gap-2 text-label-sm text-tertiary"
            >
              <span
                class="material-symbols-outlined text-[16px]"
                style="font-variation-settings: &quot;FILL&quot; 1"
                >check_circle</span
              >
              <span class="">All systems operational</span>
            </div>
          </div>
          <!-- Card 2: Total Monthly kWh -->
          <div
            class="bg-surface-container-lowest border border-outline-variant rounded-lg p-6 soft-inset-shadow transition-all hover:border-primary"
          >
            <div class="flex justify-between items-start mb-4">
              <div
                class="h-12 w-12 rounded-lg bg-primary-container/10 flex items-center justify-center"
              >
                <span
                  class="material-symbols-outlined text-primary"
                  data-icon="bolt"
                  >bolt</span
                >
              </div>
              <span
                class="bg-primary-container/10 text-primary text-[10px] font-bold px-2 py-1 rounded-full"
                >+4.2%</span
              >
            </div>
            <p
              class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider"
            >
              Total Monthly kWh
            </p>
            <h3 class="text-display-lg font-display-lg text-on-surface mt-1">
              1,248
            </h3>
            <div
              class="mt-4 flex items-center gap-2 text-label-sm text-on-surface-variant bg-surface-container-low px-2 py-1 rounded border border-outline-variant/30"
            >
              <span class="text-[10px] font-bold text-primary"
                >BASELINE COMPARISON ACTIVE</span
              >
            </div>
          </div>
          <!-- Card 3: Est. Monthly Cost -->
          <div
            class="bg-surface-container-lowest border border-outline-variant rounded-lg p-6 soft-inset-shadow transition-all hover:border-primary"
          >
            <div class="flex justify-between items-start mb-4">
              <div
                class="h-12 w-12 rounded-lg bg-primary-container/10 flex items-center justify-center"
              >
                <span
                  class="material-symbols-outlined text-primary"
                  data-icon="account_balance_wallet"
                  >account_balance_wallet</span
                >
              </div>
              <span
                class="bg-tertiary-container/10 text-tertiary text-[10px] font-bold px-2 py-1 rounded-full"
                >-$12.00</span
              >
            </div>
            <p
              class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider"
            >
              Est. Monthly Cost
            </p>
            <h3 class="text-display-lg font-display-lg text-on-surface mt-1">
              $142.50
            </h3>
            <div
              class="mt-4 flex items-center gap-2 text-label-sm text-on-surface-variant"
            >
              <span class="h-2 w-2 bg-tertiary rounded-full"></span>
              <span class="">On track for budget goals</span>
            </div>
          </div>
        </div>
        <!-- Consumption Trend Chart -->
        <div
          class="bg-surface-container-lowest border border-outline-variant rounded-lg p-8 soft-inset-shadow"
        >
          <div class="flex justify-between items-center mb-10">
            <div>
              <h4 class="text-headline-sm font-headline-sm text-on-surface">
                Consumption Trend
              </h4>
              <p class="text-body-md font-body-md text-on-surface-variant">
                Real-time energy distribution across selected periods.
              </p>
            </div>
            <div
              class="flex bg-surface-container-low p-1 rounded-lg border border-outline-variant"
            >
              <button
                class="px-4 py-2 rounded-md text-label-sm font-label-sm transition-all bg-surface-container-lowest text-primary soft-inset-shadow"
                id="view-week"
              >
                Week
              </button>
              <button
                class="px-4 py-2 rounded-md text-label-sm font-label-sm transition-all text-on-surface-variant hover:bg-surface-container-highest/20"
                id="view-month"
              >
                Month
              </button>
            </div>
          </div>
          <div class="h-[400px] w-full relative">
            <canvas
              id="consumptionChart"
              width="1088"
              height="500"
              style="
                display: block;
                box-sizing: border-box;
                height: 400px;
                width: 870.4px;
              "
            ></canvas>
          </div>
        </div>
        <!-- Dashboard Interaction Script -->
        <script>
          document.addEventListener("DOMContentLoaded", function () {
            const ctx = document
              .getElementById("consumptionChart")
              .getContext("2d");

            const weekData = {
              labels: ["MON", "TUE", "WED", "THU", "FRI", "SAT", "SUN"],
              datasets: [
                {
                  label: "Energy Consumption (kWh)",
                  data: [42, 38, 55, 48, 62, 35, 30],
                  backgroundColor: "#1d4ed8",
                  borderRadius: 4,
                  barThickness: 32,
                },
              ],
            };

            const monthData = {
              labels: ["Week 1", "Week 2", "Week 3", "Week 4"],
              datasets: [
                {
                  label: "Energy Consumption (kWh)",
                  data: [320, 410, 380, 445],
                  backgroundColor: "#1d4ed8",
                  borderRadius: 4,
                  barThickness: 48,
                },
              ],
            };

            let currentChart = new Chart(ctx, {
              type: "bar",
              data: weekData,
              options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                  legend: { display: false },
                },
                scales: {
                  y: {
                    beginAtZero: true,
                    grid: { color: "#E5E7EB", drawBorder: false },
                    ticks: {
                      color: "#434655",
                      font: { family: "Inter", size: 12 },
                    },
                  },
                  x: {
                    grid: { display: false },
                    ticks: {
                      color: "#434655",
                      font: { family: "Inter", size: 12, weight: "600" },
                    },
                  },
                },
              },
            });

            // Toggle Logic
            const weekBtn = document.getElementById("view-week");
            const monthBtn = document.getElementById("view-month");

            function setActive(btn, other) {
              btn.classList.add(
                "bg-surface-container-lowest",
                "text-primary",
                "soft-inset-shadow",
              );
              btn.classList.remove("text-on-surface-variant");
              other.classList.remove(
                "bg-surface-container-lowest",
                "text-primary",
                "soft-inset-shadow",
              );
              other.classList.add("text-on-surface-variant");
            }

            weekBtn.addEventListener("click", () => {
              setActive(weekBtn, monthBtn);
              currentChart.data = weekData;
              currentChart.update();
            });

            monthBtn.addEventListener("click", () => {
              setActive(monthBtn, weekBtn);
              currentChart.data = monthData;
              currentChart.update();
            });
          });
        </script>
      </main>
    </div>
  </body>
</html>
