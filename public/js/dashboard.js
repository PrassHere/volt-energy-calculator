document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('consumptionChart');
    if (!canvas) return;

    const rawData = window.__DASHBOARD_DATA__ || {};
    const weekLabels = (rawData.week && rawData.week.labels) || ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
    const weekValues = (rawData.week && rawData.week.data) || [0, 0, 0, 0, 0, 0, 0];

    const monthLabels = (rawData.month && rawData.month.labels) || ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'];
    const monthValues = (rawData.month && rawData.month.data) || [0, 0, 0, 0];

    const weekData = {
        labels: weekLabels,
        datasets: [{
            label: 'Konsumsi Energi (kWh)',
            data: weekValues,
            backgroundColor: '#1d4ed8',
            hoverBackgroundColor: '#0037b0',
            borderRadius: 6,
            barThickness: 32,
            maxBarThickness: 48,
        }]
    };

    const monthData = {
        labels: monthLabels,
        datasets: [{
            label: 'Konsumsi Energi (kWh)',
            data: monthValues,
            backgroundColor: '#1d4ed8',
            hoverBackgroundColor: '#0037b0',
            borderRadius: 6,
            barThickness: 48,
            maxBarThickness: 64,
        }]
    };

    const ctx = canvas.getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: weekData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            const val = Number(context.parsed.y || 0).toLocaleString('id-ID', {
                                minimumFractionDigits: 1,
                                maximumFractionDigits: 2
                            });
                            return ` ${context.dataset.label}: ${val} kWh`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#E5E7EB',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#434655',
                        font: { family: 'Inter', size: 12 },
                        callback: function (val) {
                            return val + ' kWh';
                        }
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: {
                        color: '#434655',
                        font: { family: 'Inter', size: 12, weight: '600' }
                    }
                }
            }
        }
    });

    const weekBtn = document.getElementById('view-week');
    const monthBtn = document.getElementById('view-month');

    function setActive(activeBtn, inactiveBtn) {
        activeBtn.classList.add('bg-surface-container-lowest', 'text-primary', 'soft-inset-shadow');
        activeBtn.classList.remove('text-on-surface-variant');
        inactiveBtn.classList.remove('bg-surface-container-lowest', 'text-primary', 'soft-inset-shadow');
        inactiveBtn.classList.add('text-on-surface-variant');
    }

    if (weekBtn && monthBtn) {
        weekBtn.addEventListener('click', function () {
            setActive(weekBtn, monthBtn);
            chart.data = weekData;
            chart.update();
        });

        monthBtn.addEventListener('click', function () {
            setActive(monthBtn, weekBtn);
            chart.data = monthData;
            chart.update();
        });
    }
});
