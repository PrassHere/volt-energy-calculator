document.addEventListener('DOMContentLoaded', function () {
    const rawData = window.__ANALYTICS_DATA__ || {};
    if (rawData.kosong) return;

    const tren = rawData.tren || {};
    const alokasi = rawData.alokasi || {};
    const ringkasan = rawData.ringkasan || {};

    const weekLabels = (tren.week && tren.week.labels) || ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
    const weekValues = (tren.week && tren.week.data) || [0, 0, 0, 0, 0, 0, 0];

    const monthLabels = (tren.month && tren.month.labels) || ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'];
    const monthValues = (tren.month && tren.month.data) || [0, 0, 0, 0];

    // 1. Chart Konsumsi Energi (Bar)
    const consumptionCanvas = document.getElementById('analyticsConsumptionChart');
    let consumptionChart = null;

    if (consumptionCanvas) {
        const ctx = consumptionCanvas.getContext('2d');
        consumptionChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: weekLabels,
                datasets: [{
                    label: 'Konsumsi (kWh)',
                    data: weekValues,
                    backgroundColor: '#1D4ED8',
                    hoverBackgroundColor: '#0037B0',
                    borderRadius: 4,
                    barThickness: 28,
                    maxBarThickness: 36
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function (ctx) {
                                return ` ${ctx.parsed.y.toLocaleString('id-ID')} kWh`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#E5E7EB', drawBorder: false },
                        ticks: {
                            color: '#434655',
                            font: { family: 'Inter', size: 11 },
                            callback: val => val + ' kWh'
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: {
                            color: '#434655',
                            font: { family: 'Inter', size: 11, weight: '600' }
                        }
                    }
                }
            }
        });
    }

    // Toggle Period Buttons
    const toggleWeek = document.getElementById('toggle-week');
    const toggleMonth = document.getElementById('toggle-month');
    const activePeriodLabel = document.getElementById('activePeriodLabel');

    if (toggleWeek && toggleMonth && consumptionChart) {
        toggleWeek.addEventListener('click', function () {
            toggleWeek.classList.add('bg-surface-container-lowest', 'text-primary', 'soft-inset-shadow');
            toggleWeek.classList.remove('text-on-surface-variant');
            toggleMonth.classList.remove('bg-surface-container-lowest', 'text-primary', 'soft-inset-shadow');
            toggleMonth.classList.add('text-on-surface-variant');

            if (activePeriodLabel) activePeriodLabel.textContent = 'Mingguan';
            consumptionChart.data.labels = weekLabels;
            consumptionChart.data.datasets[0].data = weekValues;
            consumptionChart.data.datasets[0].barThickness = 28;
            consumptionChart.update();
        });

        toggleMonth.addEventListener('click', function () {
            toggleMonth.classList.add('bg-surface-container-lowest', 'text-primary', 'soft-inset-shadow');
            toggleMonth.classList.remove('text-on-surface-variant');
            toggleWeek.classList.remove('bg-surface-container-lowest', 'text-primary', 'soft-inset-shadow');
            toggleWeek.classList.add('text-on-surface-variant');

            if (activePeriodLabel) activePeriodLabel.textContent = 'Bulanan';
            consumptionChart.data.labels = monthLabels;
            consumptionChart.data.datasets[0].data = monthValues;
            consumptionChart.data.datasets[0].barThickness = 44;
            consumptionChart.update();
        });
    }

    // 2. Chart Alokasi Perangkat (Doughnut)
    const allocationCanvas = document.getElementById('deviceAllocationChart');
    if (allocationCanvas && alokasi.labels && alokasi.labels.length > 0) {
        const colors = (alokasi.items || []).map(i => i.warna);
        const ctxAlloc = allocationCanvas.getContext('2d');
        new Chart(ctxAlloc, {
            type: 'doughnut',
            data: {
                labels: alokasi.labels,
                datasets: [{
                    data: alokasi.data,
                    backgroundColor: colors,
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '72%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function (ctx) {
                                return ` ${ctx.label}: ${ctx.parsed}%`;
                            }
                        }
                    }
                }
            }
        });
    }

    // 3. Chart Proyeksi Biaya (Line)
    const costCanvas = document.getElementById('costProjectionChart');
    if (costCanvas) {
        const biayaBulanan = ringkasan.biaya_bulanan || 0;
        const ctxCost = costCanvas.getContext('2d');

        // Kalkulasi kumulatif mingguan
        const step = biayaBulanan / 4;
        const actualData = [
            Math.round(step * 0.95),
            Math.round(step * 1.9),
            Math.round(step * 2.85),
            Math.round(biayaBulanan)
        ];
        const budgetData = [
            Math.round(step * 1.05),
            Math.round(step * 2.1),
            Math.round(step * 3.15),
            Math.round(biayaBulanan * 1.1)
        ];

        new Chart(ctxCost, {
            type: 'line',
            data: {
                labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
                datasets: [
                    {
                        label: 'Biaya Aktual Terhitung',
                        data: actualData,
                        borderColor: '#1D4ED8',
                        backgroundColor: 'rgba(29, 78, 216, 0.08)',
                        fill: true,
                        tension: 0.3,
                        pointRadius: 4,
                        pointBackgroundColor: '#1D4ED8'
                    },
                    {
                        label: 'Target Anggaran',
                        data: budgetData,
                        borderColor: '#94A3B8',
                        borderDash: [6, 4],
                        fill: false,
                        tension: 0.3,
                        pointRadius: 3,
                        pointBackgroundColor: '#94A3B8'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function (ctx) {
                                return ` ${ctx.dataset.label}: Rp${Number(ctx.parsed.y).toLocaleString('id-ID')}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#E5E7EB', drawBorder: false },
                        ticks: {
                            color: '#434655',
                            font: { family: 'Inter', size: 11 },
                            callback: val => 'Rp' + Number(val).toLocaleString('id-ID')
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: {
                            color: '#434655',
                            font: { family: 'Inter', size: 11, weight: '600' }
                        }
                    }
                }
            }
        });
    }
});
