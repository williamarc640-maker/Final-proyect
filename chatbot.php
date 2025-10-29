<?php
header('Content-Type: application/json');
require_once 'config.php';
$data = json_decode(file_get_contents('php://input'), true);
$msg = isset($data['message']) ? trim($data['message']) : '';

if (!$msg) {
    echo json_encode(['reply' => 'Escribe algo para que pueda ayudarte.']);
    exit;
}

/* api del chatbot */

if ($openai_key && $openai_key !== '' && $openai_key !== 'sk-REPLACE_WITH_YOUR_OPENAI_KEY') {

    $payload = [
        'model' => 'gpt-4o',
        'messages' => [
            ['role' => 'system', 'content' => 'Eres un asesor formal y profesional de la tienda SummerWooll. Respondes de manera clara, breve y útil. Evita lenguaje coloquial.'],
            ['role' => 'user', 'content' => $msg]
        ],
        'max_tokens' => 500,
        'temperature' => 0.2
    ];

    $ch = curl_init('https://api.openai.com/v1/chat/completions');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $openai_key
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    $res = curl_exec($ch);
    if (curl_errno($ch)) {
        echo json_encode(['reply' => 'Error contactando la API de OpenAI.']);
        exit;
    }
    $j = json_decode($res, true);
    if (isset($j['choices'][0]['message']['content'])) {
        $reply = $j['choices'][0]['message']['content'];
        echo json_encode(['reply' => $reply]);
        exit;
    } else {
        echo json_encode(['reply' => 'No hubo respuesta desde OpenAI.']);
        exit;
    }
}

// Fallback canned replies (formal tone)
$lower = strtolower($msg);
if (strpos($lower, 'pago') !== false || strpos($lower, 'comprar') !== false) {
    $reply = 'Puede proceder a pagar desde el carrito; al confirmar la compra será dirigido a la pasarela de pago. Si necesita ayuda con métodos de pago, indique cuál.';
} elseif (strpos($lower, 'envio') !== false || strpos($lower, 'entrega') !== false) {
    $reply = 'Los tiempos de envío dependen de la dirección. Por favor proporcione su ciudad y código postal para estimar el tiempo y costo de envío.';
} else {
    $reply = 'Soy el asistente de la tienda SummerWooll. ¿En qué puedo ayudarle hoy?';
}

echo json_encode(['reply' => $reply]);
?>
