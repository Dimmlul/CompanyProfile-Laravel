import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

/**
 * x-reveal — fade + slide an element in once it scrolls into view.
 *
 * The hidden state is applied from JS, so if scripts fail to load the
 * content still renders normally (progressive enhancement).
 *
 *   <div x-data x-reveal>...</div>
 *   <div x-data x-reveal="{ threshold: 0.3, delay: 150 }">...</div>
 */
Alpine.directive('reveal', (el, { expression }) => {
    // Accept JS object-literal syntax (e.g. { delay: 80 }), not just JSON.
    // Wrapped so a malformed expression can never throw and halt Alpine init.
    let options = {};
    if (expression) {
        try {
            options = (new Function(`return (${expression})`))() || {};
        } catch (e) {
            options = {};
        }
    }
    const { threshold = 0.15, delay = 0 } = options;

    el.classList.add('opacity-0', 'translate-y-6', 'transition-all', 'duration-700', 'ease-out');
    if (delay) el.style.transitionDelay = `${delay}ms`;

    const observer = new IntersectionObserver(([entry]) => {
        if (!entry.isIntersecting) return;
        el.classList.remove('opacity-0', 'translate-y-6');
        observer.unobserve(el);
    }, { threshold });

    observer.observe(el);
});

Alpine.start();
