import './bootstrap';
import Alpine from 'alpinejs'

window.Alpine = Alpine

// HERO REVEAL (GLOBAL)
window.heroReveal = function () {
    return {
        init() {
            const items = [
                this.$refs.badge,
                this.$refs.title,
                this.$refs.desc,
                this.$refs.cta,
            ]

            items.forEach((el, index) => {
                el.classList.add(
                    'transition-all',
                    'duration-700',
                    'ease-out',
                    'opacity-0',
                    'translate-y-4'
                )

                requestAnimationFrame(() => {
                    setTimeout(() => {
                        el.classList.remove('opacity-0', 'translate-y-4')
                        el.classList.add('opacity-100', 'translate-y-0')
                    }, index * 120)
                })
            })
        }
    }
}

Alpine.start()

