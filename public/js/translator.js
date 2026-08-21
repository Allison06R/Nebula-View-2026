// ============================================================
// NEBULA VIEW - TRADUCTOR GLOBAL
// ============================================================

(function () {

    'use strict';

    // ------------------------------------------------------------
    // CONFIGURACIÓN
    // ------------------------------------------------------------

    const TRANSLATE_URL = '/api/translate';

    let currentLanguage =
        localStorage.getItem('nebulaLanguage') || 'es';

    // Guardamos los textos originales de la página
    const originalTexts = new Map();

    // ------------------------------------------------------------
    // CACHÉ DE TRADUCCIONES EN EL NAVEGADOR
    // ------------------------------------------------------------

    const CACHE_KEY = 'nebulaTranslateCache';

    function loadCache() {
        try {
            return JSON.parse(
                localStorage.getItem(CACHE_KEY) || '{}'
            );
        } catch (e) {
            return {};
        }
    }

    function saveCache(cache) {
        try {
            localStorage.setItem(
                CACHE_KEY,
                JSON.stringify(cache)
            );
        } catch (e) {
            // localStorage lleno o no disponible: seguimos sin caché
            console.warn('No se pudo guardar la caché de traducción.', e);
        }
    }

    function cacheKeyFor(text, target) {
        return target + '::' + text;
    }

    // ------------------------------------------------------------
    // ELEMENTOS QUE NO QUEREMOS TRADUCIR
    // ------------------------------------------------------------

    const excludedTags = [
        'SCRIPT',
        'STYLE',
        'NOSCRIPT',
        'CODE',
        'PRE'
    ];

    // ------------------------------------------------------------
    // OBTENER TEXTOS DE LA PÁGINA
    // ------------------------------------------------------------

    function collectPageTexts() {

        if (originalTexts.size > 0) {
            return;
        }

        const walker = document.createTreeWalker(
            document.body,
            NodeFilter.SHOW_TEXT
        );

        let node;

        while (node = walker.nextNode()) {

            const parent = node.parentElement;

            if (!parent) continue;

            // No traducir elementos excluidos
            if (excludedTags.includes(parent.tagName)) {
                continue;
            }

            const text = node.textContent.trim();

            if (!text) continue;

            // Guardar el texto original
            originalTexts.set(node, node.textContent);
        }

        console.log(
            'Textos encontrados para traducir:',
            originalTexts.size
        );
    }

    // ------------------------------------------------------------
    // RESTAURAR ESPAÑOL
    // ------------------------------------------------------------

    function restoreSpanish() {

        originalTexts.forEach((originalText, node) => {

            if (node.parentElement) {
                node.textContent = originalText;
            }

        });

        currentLanguage = 'es';

        localStorage.setItem(
            'nebulaLanguage',
            'es'
        );

        updateButtons();

        console.log('Página restaurada a español.');
    }

    // ------------------------------------------------------------
    // TRADUCIR UNA LISTA DE TEXTOS
    // ------------------------------------------------------------

    async function translateBatch(nodes, texts) {

        const target = 'en';
        const cache = loadCache();

        // Separar lo que ya está en caché de lo que falta traducir
        const pendingIndexes = [];
        const pendingTexts = [];

        texts.forEach((text, index) => {

            const key = cacheKeyFor(text, target);

            if (cache[key] !== undefined) {

                if (nodes[index]) {
                    nodes[index].textContent = cache[key];
                }

            } else {

                pendingIndexes.push(index);
                pendingTexts.push(text);
            }
        });

        // Si todo estaba en caché, no llamamos al servidor
        if (pendingTexts.length === 0) {

            console.log(
                'Traducciones obtenidas de la caché local:',
                texts.length
            );

            return;
        }

        const response = await fetch(
            TRANSLATE_URL,
            {
                method: 'POST',

                headers: {
                    'Content-Type': 'application/json'
                },

                body: JSON.stringify({
                    texts: pendingTexts,
                    target: target
                })
            }
        );

        if (!response.ok) {

            throw new Error(
                `Error HTTP ${response.status}`
            );
        }

        const data = await response.json();

        console.log(
            'Respuesta de Google:',
            data
        );

        if (!data.success) {

            throw new Error(
                data.error ||
                'Google Translation devolvió un error.'
            );
        }

        if (!Array.isArray(data.translations)) {

            throw new Error(
                'La respuesta no contiene traducciones.'
            );
        }

        data.translations.forEach(
            (translation, i) => {

                const originalIndex = pendingIndexes[i];
                const originalText = pendingTexts[i];

                if (nodes[originalIndex]) {

                    nodes[originalIndex].textContent =
                        translation;
                }

                // Guardar en caché local para no volver a pedirlo
                cache[cacheKeyFor(originalText, target)] =
                    translation;
            }
        );

        saveCache(cache);
    }

    // ------------------------------------------------------------
    // TRADUCIR PÁGINA COMPLETA
    // ------------------------------------------------------------

    async function translatePage() {

        collectPageTexts();

        const entries =
            Array.from(originalTexts.entries());

        if (!entries.length) {
            console.warn(
                'No se encontraron textos para traducir.'
            );
            return;
        }

        // Google permite hasta 50 textos por petición
        const BATCH_SIZE = 50;

        for (
            let i = 0;
            i < entries.length;
            i += BATCH_SIZE
        ) {

            const batch =
                entries.slice(
                    i,
                    i + BATCH_SIZE
                );

            const nodes =
                batch.map(item => item[0]);

            const texts =
                batch.map(item =>
                    item[1].trim()
                );

            await translateBatch(
                nodes,
                texts
            );
        }

        currentLanguage = 'en';

        localStorage.setItem(
            'nebulaLanguage',
            'en'
        );

        updateButtons();

        console.log(
            'Página traducida correctamente.'
        );
    }

    // ------------------------------------------------------------
    // ACTUALIZAR BOTONES
    // ------------------------------------------------------------

    function updateButtons() {

        const buttons = document.querySelectorAll(
            '#langToggleMobile, #langToggle'
        );

        buttons.forEach(button => {

            if (currentLanguage === 'es') {

                button.textContent = 'EN';

                button.setAttribute(
                    'aria-label',
                    'Cambiar a inglés'
                );

            } else {

                button.textContent = 'ES';

                button.setAttribute(
                    'aria-label',
                    'Cambiar a español'
                );
            }

        });
    }

    // ------------------------------------------------------------
    // CONECTAR BOTONES
    // ------------------------------------------------------------

    function initTranslator() {

        const buttons = document.querySelectorAll(
            '#langToggleMobile, #langToggle'
        );

        if (!buttons.length) {

            console.warn(
                'No se encontró ningún botón de idioma.'
            );

            return;
        }

        buttons.forEach(button => {

            button.addEventListener(
                'click',
                async function () {

                    if (
                        button.disabled
                    ) {
                        return;
                    }

                    try {

                        button.disabled = true;

                        const previousText =
                            button.textContent;

                        button.textContent =
                            '...';

                        if (
                            currentLanguage === 'es'
                        ) {

                            await translatePage();

                        } else {

                            restoreSpanish();

                        }

                    } catch (error) {

                        console.error(
                            'ERROR DEL TRADUCTOR:',
                            error
                        );

                        alert(
                            'No se pudo realizar la traducción. Revisa la consola para más información.'
                        );

                        updateButtons();

                    } finally {

                        button.disabled = false;

                    }

                }
            );

        });

        updateButtons();

        console.log(
            'Traductor Nebula View iniciado.'
        );
    }

    // ------------------------------------------------------------
    // INICIAR CUANDO CARGUE LA PÁGINA
    // ------------------------------------------------------------

    if (
        document.readyState === 'loading'
    ) {

        document.addEventListener(
            'DOMContentLoaded',
            initTranslator
        );

    } else {

        initTranslator();

    }

})();