function showDeleteConfirm(id) {
    const form = document.getElementById("deleteForm");
    form.action = `/barang/${id}`; // route delete
    document.getElementById("deleteAlert").classList.remove("hidden");
}

function hideDeleteConfirm() {
    document.getElementById("deleteAlert").classList.add("hidden");
}

setTimeout(() => {
    const alert = document.getElementById("alert");
    if (alert) alert.remove();
}, 3000);

lucide.createIcons();
