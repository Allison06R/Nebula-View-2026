<?php

return [
    'api_key' => env('GOOGLE_TRANSLATE_API_KEY'),
    'url' => 'https://translation.googleapis.com/language/translate/v2',
    'source_language' => 'es',
    'default_target_language' => 'en',
    'max_texts_per_request' => 50,
];
