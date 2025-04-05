<?php
// === CORS Headers ===
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// === Obsługa preflight (CORS) ===
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

function haversineGreatCircleDistance($lat1, $lon1, $lat2, $lon2, $earthRadius = 6371000) {
    $latFrom = deg2rad($lat1);
    $lonFrom = deg2rad($lon1);
    $latTo   = deg2rad($lat2);
    $lonTo   = deg2rad($lon2);

    $latDelta = $latTo - $latFrom;
    $lonDelta = $lonTo - $lonFrom;

    $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
        cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
    return $angle * $earthRadius;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['lat1'], $data['lon1'], $data['lat2'], $data['lon2'])) {
        http_response_code(400);
        echo json_encode(["error" => "Brak wymaganych danych"]);
        exit;
    }

    $lat1 = $data['lat1'];
    $lon1 = $data['lon1'];
    $lat2 = $data['lat2'];
    $lon2 = $data['lon2'];

    if (!is_numeric($lat1) || !is_numeric($lon1) || !is_numeric($lat2) || !is_numeric($lon2)) {
        http_response_code(400);
        echo json_encode(["error" => "Nieprawidłowe dane wejściowe"]);
        exit;
    }

    $distanceMeters = haversineGreatCircleDistance($lat1, $lon1, $lat2, $lon2);
    $distanceKilometers = $distanceMeters / 1000;

    echo json_encode([
        "meters" => round($distanceMeters, 2),
        "kilometers" => round($distanceKilometers, 3)
    ]);
}
