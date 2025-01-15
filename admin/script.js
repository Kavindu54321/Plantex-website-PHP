document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebar');
    const toggleButton = document.createElement('button');
    toggleButton.classList.add('sidebar-toggle');
    toggleButton.textContent = '☰';
    document.body.appendChild(toggleButton);

    toggleButton.addEventListener('click', function () {
        sidebar.classList.toggle('open');
    });
});
