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

/**
 * chatReply — submits a chat reply form over AJAX so the page never reloads.
 * On success the server sends back the rendered <x-chat-bubble> HTML for the
 * new reply, which is appended straight into the thread.
 *
 * Shared by the guest, user and admin chat threads:
 *   <div x-data="chatReply({ action: '...' })">
 */
window.chatReply = function ({ action }) {
    return {
        text: '',
        sending: false,
        error: null,

        send() {
            const file = this.$refs.file?.files?.[0] ?? null;

            if (!this.text.trim() && !file) {
                this.error = 'Type a message or attach a file.';
                return;
            }

            this.sending = true;
            this.error = null;

            const formData = new FormData();
            formData.append('message', this.text);
            if (file) formData.append('file', file);

            axios.post(action, formData, { headers: { Accept: 'application/json' } })
                .then(({ data }) => {
                    this.$refs.thread.insertAdjacentHTML('beforeend', data.html);
                    this.text = '';
                    if (this.$refs.file) this.$refs.file.value = '';

                    this.$nextTick(() => {
                        this.$refs.thread.lastElementChild?.scrollIntoView({ behavior: 'smooth', block: 'end' });
                    });
                })
                .catch((err) => {
                    this.error = err.response?.data?.message
                        ?? err.response?.data?.errors?.message?.[0]
                        ?? 'Failed to send. Please try again.';
                })
                .finally(() => {
                    this.sending = false;
                });
        },
    };
};

Alpine.start();
