<?php

header('Content-Type: text/plain; charset=utf-8');

echo "=== INFO DEL SERVIDOR ===\n";
echo "PHP corriendo vía: " . php_sapi_name() . "\n";
echo "PHP versión: " . phpversion() . "\n";
echo "cURL versión: " . curl_version()['version'] . "\n";
echo "SSL versión: " . curl_version()['ssl_version'] . "\n\n";

echo "=== PRUEBA 1: conexión simple a Groq (GET) ===\n";
$ch = curl_init('https://api.groq.com');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 15);
curl_setopt($ch, CURLOPT_VERBOSE, false);
$start = microtime(true);
$result = curl_exec($ch);
$elapsed = round((microtime(true) - $start) * 1000);

if (curl_errno($ch)) {
    echo "❌ ERROR: " . curl_error($ch) . " (código " . curl_errno($ch) . ")\n";
    echo "Tiempo transcurrido: {$elapsed}ms\n";
} else {
    echo "✅ ÉXITO en {$elapsed}ms\n";
    echo "Respuesta: " . $result . "\n";
}
curl_close($ch);

echo "\n=== PRUEBA 2: petición POST real a Groq (como hace el chat) ===\n";

$apiKey = getenv('GROQ_API_KEY');
if (!$apiKey) {
    // Intenta leer directo del .env si getenv no lo agarra
    $envPath = __DIR__ . '/../.env';
    if (file_exists($envPath)) {
        $lines = file($envPath);
        foreach ($lines as $line) {
            if (str_starts_with(trim($line), 'GROQ_API_KEY=')) {
                $apiKey = trim(substr(trim($line), strlen('GROQ_API_KEY=')));
                break;
            }
        }
    }
}

if (!$apiKey) {
    echo "⚠️ No se encontró GROQ_API_KEY. Pega tu clave abajo temporalmente para probar:\n";
    $apiKey = 'PEGA_TU_CLAVE_AQUI';
}

$ch2 = curl_init('https://api.groq.com/openai/v1/chat/completions');
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch2, CURLOPT_TIMEOUT, 15);
curl_setopt($ch2, CURLOPT_POST, true);
curl_setopt($ch2, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $apiKey,
]);
curl_setopt($ch2, CURLOPT_POSTFIELDS, json_encode([
    'model' => 'llama-3.3-70b-versatile',
    'messages' => [['role' => 'user', 'content' => 'di hola']],
]));

$start2 = microtime(true);
$result2 = curl_exec($ch2);
$elapsed2 = round((microtime(true) - $start2) * 1000);

if (curl_errno($ch2)) {
    echo "❌ ERROR: " . curl_error($ch2) . " (código " . curl_errno($ch2) . ")\n";
    echo "Tiempo transcurrido: {$elapsed2}ms\n";
} else {
    $httpCode = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
    echo "✅ Respuesta HTTP {$httpCode} en {$elapsed2}ms\n";
    echo "Respuesta: " . $result2 . "\n";
}
curl_close($ch2);