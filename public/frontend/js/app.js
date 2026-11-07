(() => {
    'use strict';

    const toggle = document.querySelector('.cn-menu-toggle');
    const nav = document.querySelector('#cn-primary-nav');

    if (!toggle || !nav) return;

    const closeMenu = () => {
        toggle.setAttribute('aria-expanded', 'false');
        toggle.setAttribute('aria-label', 'Open navigation menu');
        nav.classList.remove('is-open');
    };

    toggle.addEventListener('click', () => {
        const isExpanded = toggle.getAttribute('aria-expanded') === 'true';
        toggle.setAttribute('aria-expanded', String(!isExpanded));
        toggle.setAttribute('aria-label', isExpanded ? 'Open navigation menu' : 'Close navigation menu');
        nav.classList.toggle('is-open', !isExpanded);
    });

    nav.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', closeMenu);
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') closeMenu();
    });

    document.addEventListener('click', (event) => {
        if (!nav.contains(event.target) && !toggle.contains(event.target)) closeMenu();
    });
})();
