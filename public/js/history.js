document.addEventListener('DOMContentLoaded', function () {
    // 1. Toggle Filter Panel
    const btnToggleFilter = document.getElementById('btnToggleFilter');
    const filterPanel = document.getElementById('filterPanel');

    if (btnToggleFilter && filterPanel) {
        btnToggleFilter.addEventListener('click', function () {
            filterPanel.classList.toggle('hidden');
        });
    }

    // 2. Modal Edit
    const modalEdit = document.getElementById('modalEdit');
    const formEdit = document.getElementById('formEditPerangkat');
    const btnCloseEditModal = document.getElementById('btnCloseEditModal');
    const btnCancelEdit = document.getElementById('btnCancelEdit');

    const inputEditNama = document.getElementById('edit_nama');
    const inputEditDaya = document.getElementById('edit_daya');
    const inputEditJam = document.getElementById('edit_jam');
    const inputEditTarif = document.getElementById('edit_tarif');

    function hideEditModal() {
        if (modalEdit) modalEdit.classList.add('hidden');
    }

    if (btnCloseEditModal) btnCloseEditModal.addEventListener('click', hideEditModal);
    if (btnCancelEdit) btnCancelEdit.addEventListener('click', hideEditModal);

    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', function () {
            if (!modalEdit || !formEdit) return;

            const action = this.dataset.action;
            const nama = this.dataset.nama || '';
            const daya = this.dataset.daya || '';
            const jam = this.dataset.jam || '';
            const tarif = this.dataset.tarif || '';

            formEdit.action = action;
            if (inputEditNama) inputEditNama.value = nama;
            if (inputEditDaya) inputEditDaya.value = daya;
            if (inputEditJam) inputEditJam.value = jam;
            if (inputEditTarif) inputEditTarif.value = tarif;

            modalEdit.classList.remove('hidden');
        });
    });

    // 3. Modal Delete
    const modalDelete = document.getElementById('modalDelete');
    const formDelete = document.getElementById('formDeletePerangkat');
    const btnCloseDeleteModal = document.getElementById('btnCloseDeleteModal');
    const btnCancelDelete = document.getElementById('btnCancelDelete');
    const deleteDeviceName = document.getElementById('deleteDeviceName');

    function hideDeleteModal() {
        if (modalDelete) modalDelete.classList.add('hidden');
    }

    if (btnCloseDeleteModal) btnCloseDeleteModal.addEventListener('click', hideDeleteModal);
    if (btnCancelDelete) btnCancelDelete.addEventListener('click', hideDeleteModal);

    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function () {
            if (!modalDelete || !formDelete) return;

            const action = this.dataset.action;
            const nama = this.dataset.nama || 'perangkat ini';

            formDelete.action = action;
            if (deleteDeviceName) deleteDeviceName.textContent = nama;

            modalDelete.classList.remove('hidden');
        });
    });

    // Close on Escape or click outside
    window.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            hideEditModal();
            hideDeleteModal();
        }
    });

    [modalEdit, modalDelete].forEach(modal => {
        if (!modal) return;
        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });
    });
});
