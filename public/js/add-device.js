document.addEventListener('DOMContentLoaded', function () {
    const powerInput = document.getElementById('power_rating');
    const usageInput = document.getElementById('daily_usage');
    const usageValueText = document.getElementById('usage_value');
    const tariffInput = document.getElementById('utility_tariff');

    const resultMonthlyCost = document.getElementById('result_monthly_cost');
    const resultMonthlyEnergy = document.getElementById('result_monthly_energy');
    const resultDailyCost = document.getElementById('result_daily_cost');
    const resultWeeklyCost = document.getElementById('result_weekly_cost');
    const resultDailyEnergy = document.getElementById('result_daily_energy');
    const resultWeeklyEnergy = document.getElementById('result_weekly_energy');

    function formatRupiah(num) {
        return 'Rp' + Math.round(num || 0).toLocaleString('id-ID');
    }

    function formatKwh(num, digits = 2) {
        return Number(num || 0).toLocaleString('id-ID', {
            minimumFractionDigits: digits,
            maximumFractionDigits: digits
        }) + ' kWh';
    }

    function calculateLocal() {
        const daya = parseFloat(powerInput ? powerInput.value : 0) || 0;
        const jam = parseFloat(usageInput ? usageInput.value : 0) || 0;
        const tarif = parseFloat(tariffInput ? tariffInput.value : 0) || 0;

        if (usageValueText) {
            usageValueText.textContent = jam.toString().replace('.', ',') + ' jam';
        }

        if (daya <= 0 || jam <= 0 || tarif <= 0) {
            if (resultMonthlyCost) resultMonthlyCost.textContent = 'Rp0';
            if (resultMonthlyEnergy) resultMonthlyEnergy.textContent = '0,00 kWh';
            if (resultDailyCost) resultDailyCost.textContent = 'Rp0';
            if (resultWeeklyCost) resultWeeklyCost.textContent = 'Rp0';
            if (resultDailyEnergy) resultDailyEnergy.textContent = '0,00 kWh';
            if (resultWeeklyEnergy) resultWeeklyEnergy.textContent = '0,00 kWh';
            return;
        }

        // KF-04: Rumus Konsumsi kWh = watt x jam / 1000
        const kwhHarian = (daya * jam) / 1000;
        const kwhMingguan = kwhHarian * 7;
        const kwhBulanan = kwhHarian * 30;

        const biayaHarian = kwhHarian * tarif;
        const biayaMingguan = kwhMingguan * tarif;
        const biayaBulanan = kwhBulanan * tarif;

        if (resultMonthlyCost) resultMonthlyCost.textContent = formatRupiah(biayaBulanan) + '/bulan';
        if (resultMonthlyEnergy) resultMonthlyEnergy.textContent = formatKwh(kwhBulanan, 2);
        if (resultDailyCost) resultDailyCost.textContent = formatRupiah(biayaHarian);
        if (resultWeeklyCost) resultWeeklyCost.textContent = formatRupiah(biayaMingguan);
        if (resultDailyEnergy) resultDailyEnergy.textContent = formatKwh(kwhHarian, 2);
        if (resultWeeklyEnergy) resultWeeklyEnergy.textContent = formatKwh(kwhMingguan, 2);
    }

    let debounceTimer = null;
    function calculateServer() {
        const url = window.__CALCULASI_URL__;
        if (!url) return;

        const daya = parseFloat(powerInput ? powerInput.value : 0) || 0;
        const jam = parseFloat(usageInput ? usageInput.value : 0) || 0;
        const tarif = parseFloat(tariffInput ? tariffInput.value : 0) || 0;

        if (daya <= 0 || jam <= 0 || tarif <= 0) return;

        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            const tokenMeta = document.querySelector('meta[name="csrf-token"]');
            const token = tokenMeta ? tokenMeta.getAttribute('content') : '';

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    daya: daya,
                    waktu_penggunaan: jam,
                    tarif_listrik: tarif
                })
            })
            .then(res => res.ok ? res.json() : null)
            .then(data => {
                if (data && data.teks) {
                    if (resultMonthlyCost) resultMonthlyCost.textContent = data.teks.biaya_bulanan + '/bulan';
                    if (resultMonthlyEnergy) resultMonthlyEnergy.textContent = data.teks.kwh_bulanan;
                    if (resultDailyCost) resultDailyCost.textContent = data.teks.biaya_harian;
                    if (resultWeeklyCost) resultWeeklyCost.textContent = data.teks.biaya_mingguan;
                    if (resultDailyEnergy) resultDailyEnergy.textContent = data.teks.kwh_harian;
                    if (resultWeeklyEnergy) resultWeeklyEnergy.textContent = data.teks.kwh_mingguan;
                }
            })
            .catch(() => {
                // Keep local calculated values on connection issues
            });
        }, 200);
    }

    function onInputChange() {
        calculateLocal();
        calculateServer();
    }

    if (powerInput) powerInput.addEventListener('input', onInputChange);
    if (usageInput) usageInput.addEventListener('input', onInputChange);
    if (tariffInput) tariffInput.addEventListener('input', onInputChange);

    // Initial calculation on load
    calculateLocal();
    calculateServer();
});
