// ═══════════════════════════════════════════════
// NEBULA VIEW - TRADUCTOR GLOBAL
// Español ↔ English
// Groq + Caché + Contenido dinámico
// ═══════════════════════════════════════════════


// ═══════════════════════════════════════════════
// CONFIGURACIÓN
// ═══════════════════════════════════════════════

const TRANSLATOR_URL =
    window.NEBULA_TRANSLATOR_URL ||
    '/translate';

const CACHE_NAME =
    'nebulaTranslationCache';

const CACHE_VERSION =
    '1';

let currentLanguage =
    localStorage.getItem('nebulaLanguage') || 'es';


// Textos originales
const originalTexts =
    new Map();


// Atributos originales
const originalAttributes =
    new Map();


// Evita varias traducciones simultáneas
let translating = false;


// ═══════════════════════════════════════════════
// ELEMENTOS QUE SE PUEDEN TRADUCIR
// ═══════════════════════════════════════════════

const TRANSLATABLE_ATTRIBUTES = [

    'placeholder',

    'title',

    'alt',

    'aria-label'

];


// ═══════════════════════════════════════════════
// INICIAR
// ═══════════════════════════════════════════════

document.addEventListener(
    'DOMContentLoaded',
    async () => {

        console.log(
            'Nebula View Translator iniciado.'
        );


        // Guardar contenido original
        saveOriginalContent();


        // Configurar botón
        setupLanguageButton();


        // Configurar contenido dinámico
        setupMutationObserver();


        // Actualizar botón
        updateLanguageButton();


        // Si estaba en inglés
        if (currentLanguage === 'en') {

            await changeLanguage('en');

        }

    }
);


// ═══════════════════════════════════════════════
// CONFIGURAR BOTÓN
// ═══════════════════════════════════════════════

function setupLanguageButton() {

    const buttons = [
        document.getElementById('langToggle'),
        document.getElementById('langToggleMobile')
    ].filter(Boolean);


    if (!buttons.length) {

        console.warn(
            'No se encontró #langToggle ni #langToggleMobile'
        );

        return;

    }


    buttons.forEach(button => {

        button.addEventListener(
            'click',
            async () => {

                if (translating) return;


                const newLanguage =
                    currentLanguage === 'es'
                        ? 'en'
                        : 'es';


                await changeLanguage(
                    newLanguage
                );

            }
        );

    });

}


// ═══════════════════════════════════════════════
// GUARDAR CONTENIDO ORIGINAL
// ═══════════════════════════════════════════════

function saveOriginalContent() {

    saveTextNodes(
        document.body
    );

    saveAttributes(
        document.body
    );

}


// ═══════════════════════════════════════════════
// GUARDAR TEXTOS
// ═══════════════════════════════════════════════

function saveTextNodes(container) {

    const walker =
        document.createTreeWalker(
            container,
            NodeFilter.SHOW_TEXT
        );


    let node;


    while (
        node = walker.nextNode()
    ) {

        const parent =
            node.parentElement;


        if (!parent) continue;


        // Ignorar elementos
        if (
            shouldIgnoreElement(
                parent
            )
        ) {

            continue;

        }


        const text =
            node.textContent.trim();


        if (!text) continue;


        originalTexts.set(
            node,
            node.textContent
        );

    }

}


// ═══════════════════════════════════════════════
// GUARDAR ATRIBUTOS
// ═══════════════════════════════════════════════

function saveAttributes(container) {

    const elements =
        container.querySelectorAll(
            '*'
        );


    elements.forEach(
        element => {

            if (
                shouldIgnoreElement(
                    element
                )
            ) {

                return;

            }


            TRANSLATABLE_ATTRIBUTES.forEach(
                attribute => {

                    const value =
                        element.getAttribute(
                            attribute
                        );


                    if (
                        value &&
                        value.trim()
                    ) {

                        if (
                            !originalAttributes.has(
                                element
                            )
                        ) {

                            originalAttributes.set(
                                element,
                                {}
                            );

                        }


                        originalAttributes
                            .get(element)[
                                attribute
                            ] = value;

                    }

                }
            );

        }
    );

}


// ═══════════════════════════════════════════════
// ELEMENTOS QUE NO SE TRADUCEN
// ═══════════════════════════════════════════════

function shouldIgnoreElement(element) {

    if (!element) return true;


    if (
        element.closest(
            'script, style, noscript, code, pre'
        )
    ) {

        return true;

    }


    if (
        element.closest(
            '[data-no-translate]'
        )
    ) {

        return true;

    }


    return false;

}


// ═══════════════════════════════════════════════
// CAMBIAR IDIOMA
// ═══════════════════════════════════════════════

async function changeLanguage(
    language
) {

    if (translating) return;


    currentLanguage =
        language;


    localStorage.setItem(
        'nebulaLanguage',
        language
    );


    updateLanguageButton();


    // ═══════════════════════════════════════
    // ESPAÑOL
    // ═══════════════════════════════════════

    if (
        language === 'es'
    ) {

        restoreSpanish();

        return;

    }


    // ═══════════════════════════════════════
    // INGLÉS
    // ═══════════════════════════════════════

    await translatePageToEnglish();

}


// ═══════════════════════════════════════════════
// BOTÓN
// ═══════════════════════════════════════════════

function updateLanguageButton() {

    const desktopButton =
        document.getElementById(
            'langToggle'
        );

    const mobileButton =
        document.getElementById(
            'langToggleMobile'
        );


    if (desktopButton) {

        desktopButton.textContent =
            currentLanguage === 'es'
                ? 'EN'
                : 'ES';

    }


    if (mobileButton) {

        mobileButton.textContent =
            currentLanguage === 'es'
                ? 'EN'
                : 'ES';

    }

}


// ═══════════════════════════════════════════════
// TRADUCIR TODA LA PÁGINA
// ═══════════════════════════════════════════════

async function translatePageToEnglish() {

    translating = true;


    try {

        // Asegurar que todo el contenido
        // actual esté guardado
        saveOriginalContent();


        const items = [];


        // ═══════════════════════════════════
        // TEXTOS
        // ═══════════════════════════════════

        originalTexts.forEach(
            (originalText, node) => {

                const text =
                    originalText.trim();


                if (!text) return;


                items.push({

                    type: 'text',

                    node: node,

                    original: originalText,

                    value: text

                });

            }
        );


        // ═══════════════════════════════════
        // ATRIBUTOS
        // ═══════════════════════════════════

        originalAttributes.forEach(
            (attributes, element) => {

                Object.entries(
                    attributes
                ).forEach(
                    ([attribute, value]) => {

                        if (
                            !value ||
                            !value.trim()
                        ) {

                            return;

                        }


                        items.push({

                            type: 'attribute',

                            element:
                                element,

                            attribute:
                                attribute,

                            original:
                                value,

                            value:
                                value.trim()

                        });

                    }
                );

            }
        );


        if (!items.length) {

            return;

        }


        // ═══════════════════════════════════
        // OBTENER TEXTOS ÚNICOS
        // ═══════════════════════════════════

        const uniqueTexts =
            [
                ...new Set(
                    items.map(
                        item =>
                            item.value
                    )
                )
            ];


        console.log(
            `Nebula View: ${uniqueTexts.length} textos para traducir.`
        );


        // ═══════════════════════════════════
        // BUSCAR EN CACHÉ
        // ═══════════════════════════════════

        const translations =
            {};


        const textsToTranslate = [];


        uniqueTexts.forEach(
            text => {

                const cached =
                    getCachedTranslation(
                        text
                    );


                if (cached) {

                    translations[text] =
                        cached;

                } else {

                    textsToTranslate.push(
                        text
                    );

                }

            }
        );


        console.log(
            `Caché: ${Object.keys(translations).length}`
        );


        // ═══════════════════════════════════
        // PEDIR A GROQ LO QUE FALTA
        // ═══════════════════════════════════

        if (
            textsToTranslate.length
        ) {

            const newTranslations =
                await translateWithGroq(
                    textsToTranslate
                );


            Object.entries(
                newTranslations
            ).forEach(
                ([original, translated]) => {

                    translations[
                        original
                    ] = translated;


                    saveCachedTranslation(
                        original,
                        translated
                    );

                }
            );

        }


        // ═══════════════════════════════════
        // APLICAR TRADUCCIONES
        // ═══════════════════════════════════

        items.forEach(
            item => {

                const translated =
                    translations[
                        item.value
                    ];


                if (
                    !translated
                ) {

                    return;

                }


                if (
                    item.type === 'text'
                ) {

                    item.node.textContent =
                        item.original.replace(
                            item.value,
                            translated
                        );

                }


                if (
                    item.type === 'attribute'
                ) {

                    item.element.setAttribute(
                        item.attribute,
                        translated
                    );

                }

            }
        );


        console.log(
            'Nebula View: traducción completada.'
        );


    } catch (error) {

        console.error(
            'Nebula View Translator:',
            error
        );

    } finally {

        translating = false;

    }

}


// ═══════════════════════════════════════════════
// GROQ
// ═══════════════════════════════════════════════

async function translateWithGroq(
    texts
) {

    const result =
        {};


    // Dividir en grupos de 50
    const batches =
        chunkArray(
            texts,
            50
        );


    for (
        const batch of batches
    ) {

        const response =
            await fetch(
                TRANSLATOR_URL,
                {

                    method: 'POST',

                    headers: {

                        'Content-Type':
                            'application/json'

                    },

                    body:
                        JSON.stringify({

                            texts:
                                batch

                        })

                }
            );


        if (!response.ok) {

            throw new Error(
                `Error HTTP ${response.status}`
            );

        }


        const data =
            await response.json();


        if (
            !data.success
        ) {

            throw new Error(
                data.error ||
                'Error desconocido.'
            );

        }


        const translations =
            data.translations;


        batch.forEach(
            (original, index) => {

                if (
                    translations[index]
                ) {

                    result[original] =
                        translations[index];

                }

            }
        );

    }


    return result;

}


// ═══════════════════════════════════════════════
// CACHE
// ═══════════════════════════════════════════════

function getCache() {

    try {

        return JSON.parse(
            localStorage.getItem(
                CACHE_NAME
            )
        ) || {};

    } catch {

        return {};

    }

}


function getCachedTranslation(
    text
) {

    const cache =
        getCache();


    const key =
        createCacheKey(
            text
        );


    return cache[key] || null;

}


function saveCachedTranslation(
    original,
    translated
) {

    const cache =
        getCache();


    const key =
        createCacheKey(
            original
        );


    cache[key] =
        translated;


    try {

        localStorage.setItem(
            CACHE_NAME,
            JSON.stringify(cache)
        );

    } catch {

        console.warn(
            'No se pudo guardar el caché.'
        );

    }

}


function createCacheKey(
    text
) {

    return (
        CACHE_VERSION +
        ':' +
        text
    );

}


// ═══════════════════════════════════════════════
// RESTAURAR ESPAÑOL
// ═══════════════════════════════════════════════

function restoreSpanish() {

    originalTexts.forEach(
        (originalText, node) => {

            node.textContent =
                originalText;

        }
    );


    originalAttributes.forEach(
        (attributes, element) => {

            Object.entries(
                attributes
            ).forEach(
                ([attribute, value]) => {

                    element.setAttribute(
                        attribute,
                        value
                    );

                }
            );

        }
    );


    console.log(
        'Nebula View: español restaurado.'
    );

}


// ═══════════════════════════════════════════════
// CONTENIDO DINÁMICO
// ═══════════════════════════════════════════════

function setupMutationObserver() {

    const observer =
        new MutationObserver(
            mutations => {

                mutations.forEach(
                    mutation => {

                        mutation.addedNodes
                            .forEach(
                                node => {

                                    if (
                                        node.nodeType !==
                                        Node.ELEMENT_NODE
                                    ) {

                                        return;

                                    }


                                    saveTextNodes(
                                        node
                                    );


                                    saveAttributes(
                                        node
                                    );

                                }
                            );

                    }
                );


                // Si estamos en inglés,
                // traducir contenido nuevo
                if (
                    currentLanguage === 'en' &&
                    !translating
                ) {

                    translatePageToEnglish();

                }

            }
        );


    observer.observe(
        document.body,
        {

            childList: true,

            subtree: true

        }
    );

}


// ═══════════════════════════════════════════════
// DIVIDIR ARRAY
// ═══════════════════════════════════════════════

function chunkArray(
    array,
    size
) {

    const chunks = [];


    for (
        let i = 0;
        i < array.length;
        i += size
    ) {

        chunks.push(
            array.slice(
                i,
                i + size
            )
        );

    }


    return chunks;

}