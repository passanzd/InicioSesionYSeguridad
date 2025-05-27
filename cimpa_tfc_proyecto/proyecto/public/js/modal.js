document.querySelector('.btn.editar').addEventListener('click', () => {
    document.getElementById('editModal').style.display = 'flex';
});
function closeModal() {
    document.getElementById('editModal').style.display = 'none';
}
function openModalBaja() {
    document.getElementById('modalBaja').style.display = 'flex';
}
function closeModalBaja() {
    document.getElementById('modalBaja').style.display = 'none';
}