(function () {
    const body = document.body;
    const savedTheme = localStorage.getItem('cn-theme');
    if (savedTheme === 'dark') body.classList.add('dark');

    const menuButton = document.getElementById('mobileMenuButton');
    const nav = document.getElementById('navlinks');
    if (menuButton && nav) {
        menuButton.addEventListener('click', function () {
            const open = nav.classList.toggle('mobile-open');
            menuButton.setAttribute('aria-expanded', open ? 'true' : 'false');
        });
        nav.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => {
            nav.classList.remove('mobile-open');
            menuButton.setAttribute('aria-expanded', 'false');
        }));
    }

    document.querySelectorAll('[data-confirm]').forEach((form) => {
        form.addEventListener('submit', (event) => {
            if (!window.confirm(form.dataset.confirm || 'Are you sure?')) event.preventDefault();
        });
    });

    const fileInput = document.getElementById('document');
    const fileName = document.getElementById('selectedFileName');
    if (fileInput && fileName) {
        fileInput.addEventListener('change', () => {
            fileName.textContent = fileInput.files && fileInput.files[0] ? fileInput.files[0].name : 'No file selected';
        });
    }
})();

function toggleTheme() {
    document.body.classList.toggle('dark');
    localStorage.setItem('cn-theme', document.body.classList.contains('dark') ? 'dark' : 'light');
}

function toast(message) {
    const element = document.getElementById('toast');
    if (!element) return;
    element.textContent = message;
    element.style.display = 'block';
    window.clearTimeout(window.cnToastTimer);
    window.cnToastTimer = window.setTimeout(() => { element.style.display = 'none'; }, 2600);
}
const campusFlash = document.querySelector('[data-toast-message]');
if (campusFlash) toast(campusFlash.dataset.toastMessage || '');
function setResourceView(mode) {
    const grid = document.getElementById('browseResourceGrid');
    if (!grid) return;
    grid.classList.toggle('view-list', mode === 'list');
    localStorage.setItem('cn-resource-view', mode);
}
const browseGrid = document.getElementById('browseResourceGrid');
if (browseGrid && localStorage.getItem('cn-resource-view') === 'list') browseGrid.classList.add('view-list');
