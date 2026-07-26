(function () {
    const overlay  = document.getElementById('nebula-preloader');
    if (!overlay) return;

    const topLid   = overlay.querySelector('.np-eyelid-top');
    const eyeScene = overlay.querySelector('.np-eye-wrap');

    document.body.style.overflow = 'hidden';

    // Parpadeo 1: se abren los párpados y aparece el ojo "Cargando..."
    requestAnimationFrame(() => {
        setTimeout(() => overlay.classList.add('np-open'), 150);
    });

    window.addEventListener('load', () => {
        setTimeout(closeAndReveal, 500);
    });

    function closeAndReveal() {
        overlay.classList.remove('np-open'); // Parpadeo 2: se cierran

        topLid.addEventListener('transitionend', function handler() {
            topLid.removeEventListener('transitionend', handler);

            eyeScene.style.display = 'none';
            overlay.classList.add('np-open');

            overlay.addEventListener('transitionend', function h2() {
                overlay.removeEventListener('transitionend', h2);
                overlay.remove();
                document.body.style.overflow = '';
            }, { once: true });
        }, { once: true });
    }
})();