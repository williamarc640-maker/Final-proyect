<?php
// ==========================================
// CONFIGURACIÓN GENERAL DEL PROYECTO
// ==========================================

// Habilitar errores solo en desarrollo (comenta estas 3 líneas en producción)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ==========================================
// 1) CLAVES DE STRIPE - MODO REAL
// ==========================================
// 🔑 Coloca aquí tus claves reales de Stripe (desde tu dashboard)
/*codigo que no se puede subir en github*/

// ==========================================
// 2) CONEXIÓN A LA BASE DE DATOS
// ==========================================
$host   = "localhost";
$user   = "root";      // cámbialo si tu hosting usa otro usuario
$pass   = "";          // coloca tu contraseña si la hay
$dbname = "mvc_crud"; // nombre de tu base de datos

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

// ==========================================
// 3) CARGAR STRIPE (VÍA COMPOSER)
// ==========================================
$vendorAutoload = __DIR__ . '/vendor/autoload.php';
if (file_exists($vendorAutoload)) {
    require_once $vendorAutoload;
} else {
    die("❌ No se encontró 'vendor/autoload.php'. Ejecuta en tu terminal: composer require stripe/stripe-php");
}

// ==========================================
// 4) INICIALIZAR STRIPE
// ==========================================
try {
    \Stripe\Stripe::setApiKey($stripe_secret_key);
} catch (Exception $e) {
    die("Error al inicializar Stripe: " . $e->getMessage());
}

// ==========================================
// 5) OPCIONAL: FUNCIONES ÚTILES
// ==========================================

// Verificar conexión rápida
function db_check() {
    global $conn;
    return $conn->ping();
}

// Formato básico de respuesta JSON
function json_response($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}
?>

