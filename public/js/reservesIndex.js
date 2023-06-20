const cancelModal = document.getElementById('cancelModal');
const cancelForm = document.forms.cancelForm;

cancelModal.addEventListener('show.bs.modal', e => {
    let btn = e.relatedTarget;
    let id = btn.dataset.id;
    let name = btn.dataset.name;
    let date = btn.dataset.date;
    let time = btn.dataset.time;

    document.getElementById('store_name').textContent = name;
    document.getElementById('reserve_date').textContent = date;
    document.getElementById('reserve_time').textContent = time;
    cancelForm.action = `reserves/${id}`;
});
