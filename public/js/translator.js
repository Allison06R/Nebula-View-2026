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

    // El botón de idioma maneja su propio texto (EN/ES/...) con
    // updateButtons(); nunca debe pasar por Google Translate.
    const excludedIds = [
        'langToggle',
        'langToggleMobile'
    ];

    function isInsideExcludedElement(parent) {

        if (!parent) return true;

        if (excludedTags.includes(parent.tagName)) {
            return true;
        }

        return Boolean(
            parent.closest &&
            excludedIds.some(
                id => parent.closest('#' + id)
            )
        );
    }

    // Ya escaneamos el documento completo al menos una vez
    let pageScanned = false;

    // ------------------------------------------------------------
    // RECOLECTAR TEXTOS NUEVOS DENTRO DE UNA RAÍZ (reutilizable
    // tanto para la página completa como para contenido dinámico
    // que aparece después, como modales generados con innerHTML)
    // ------------------------------------------------------------

    function collectTextsFrom(root) {

        const newEntries = [];

        const walker = document.createTreeWalker(
            root,
            NodeFilter.SHOW_TEXT
        );

        let node;

        while (node = walker.nextNode()) {

            const parent = node.parentElement;

            if (isInsideExcludedElement(parent)) {
                continue;
            }

            // Ya lo conocíamos de antes: no lo dupliquemos
            if (originalTexts.has(node)) {
                continue;
            }

            const text = node.textContent.trim();

            if (!text) continue;

            // Guardar el texto original
            originalTexts.set(node, node.textContent);

            newEntries.push([node, node.textContent]);
        }

        return newEntries;
    }

    // ------------------------------------------------------------
    // OBTENER TEXTOS DE LA PÁGINA (una sola vez por carga de página)
    // ------------------------------------------------------------

    function collectPageTexts() {

        if (pageScanned) {
            return;
        }

        pageScanned = true;

        collectTextsFrom(document.body);

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
    // TRADUCIR UNA LISTA DE ENTRADAS [nodo, textoOriginal] POR LOTES
    // ------------------------------------------------------------
    // Reutilizable tanto para la traducción inicial de la página
    // como para contenido dinámico detectado más tarde (modales,
    // carruseles, etc.). Devuelve true si algún lote falló.

    async function translateEntries(entries) {

        if (!entries.length) {
            return false;
        }

        // Google permite hasta 50 textos por petición
        const BATCH_SIZE = 50;

        // Si un lote falla (red, timeout, límite de Google, etc.)
        // NO debe cancelar la traducción de los lotes siguientes.
        // Reintentamos una vez por lote antes de darlo por perdido.
        let hadError = false;

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

            try {

                await translateBatch(
                    nodes,
                    texts
                );

            } catch (error) {

                console.warn(
                    'Falló un lote de traducción, reintentando una vez...',
                    error
                );

                try {

                    await translateBatch(
                        nodes,
                        texts
                    );

                } catch (retryError) {

                    console.error(
                        'El lote falló también en el reintento. Se continúa con el resto.',
                        retryError
                    );

                    hadError = true;
                }
            }
        }

        return hadError;
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

        const hadError = await translateEntries(entries);

        // Guardamos como 'en' aunque haya habido errores parciales:
        // lo que sí se tradujo debe mantenerse así al cambiar de
        // página, y el auto-traductor reintentará lo que falló
        // (esos textos no quedaron en caché, así que se piden de nuevo).
        currentLanguage = 'en';

        localStorage.setItem(
            'nebulaLanguage',
            'en'
        );

        updateButtons();

        if (hadError) {

            throw new Error(
                'Algunos textos no se pudieron traducir. Revisa la consola para más información.'
            );
        }

        console.log(
            'Página traducida correctamente.'
        );
    }

    // ------------------------------------------------------------
    // CONTENIDO DINÁMICO (modales, carruseles, etc.)
    // ------------------------------------------------------------
    // Algunas partes del sitio se generan con innerHTML después de
    // que la página ya cargó (por ejemplo, el modal de "Ver más" en
    // Problemas Visuales). El traductor solo escanea el HTML que
    // existe en el momento en que corre, así que ese contenido nuevo
    // se quedaba siempre en español. Este observer detecta cuando
    // aparece contenido nuevo y, si el sitio ya está en inglés, lo
    // traduce automáticamente.

    let dynamicObserverStarted = false;

    function startDynamicContentObserver() {

        if (dynamicObserverStarted) {
            return;
        }

        dynamicObserverStarted = true;

        const observer = new MutationObserver(mutations => {

            // Si el sitio está en español no hay nada que traducir;
            // el contenido nuevo se recolectará solo si más tarde
            // se aprieta el botón de traducir.
            if (currentLanguage !== 'en') {
                return;
            }

            let newEntries = [];

            mutations.forEach(mutation => {

                mutation.addedNodes.forEach(added => {

                    if (added.nodeType === Node.ELEMENT_NODE) {

                        if (isInsideExcludedElement(added)) {
                            return;
                        }

                        newEntries = newEntries.concat(
                            collectTextsFrom(added)
                        );

                    } else if (added.nodeType === Node.TEXT_NODE) {

                        const parent = added.parentElement;

                        if (isInsideExcludedElement(parent)) {
                            return;
                        }

                        if (originalTexts.has(added)) {
                            return;
                        }

                        const text = added.textContent.trim();

                        if (!text) return;

                        originalTexts.set(added, added.textContent);

                        newEntries.push([added, added.textContent]);
                    }
                });
            });

            if (!newEntries.length) {
                return;
            }

            translateEntries(newEntries).catch(error => {
                console.error(
                    'ERROR AL TRADUCIR CONTENIDO DINÁMICO:',
                    error
                );
            });
        });

        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
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

        // Empieza a vigilar el contenido dinámico desde ya, para
        // que quede listo apenas el sitio esté en inglés.
        startDynamicContentObserver();

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

        // ------------------------------------------------------------
        // MANTENER EL IDIOMA AL CAMBIAR DE PÁGINA
        // ------------------------------------------------------------
        // Si el usuario ya había activado inglés en otra página,
        // esta página nueva también debe traducirse automáticamente
        // (usa la caché, así que normalmente no llama a Google).
        if (currentLanguage === 'en') {

            buttons.forEach(button => {
                button.disabled = true;
                button.textContent = '...';
            });

            translatePage()
                .catch(error => {
                    console.error(
                        'ERROR AL AUTOTRADUCIR LA PÁGINA:',
                        error
                    );
                })
                .finally(() => {
                    buttons.forEach(button => {
                        button.disabled = false;
                    });
                    updateButtons();
                });
        }

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