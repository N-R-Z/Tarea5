<?php
include 'includes/header.php';

$clima = [];
$error = '';
$api_key = 'TU_API_KEY'; // ¡Reemplázala por tu clave!

if (isset($_GET['city'])) {
    $ciudad = urlencode($_GET['city']);
    $api_url = "https://api.openweathermap.org/data/2.5/weather?q=$ciudad&appid=$api_key&units=metric&lang=es";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Solo para desarrollo
    $response = curl_exec($ch);
    curl_close($ch);

    if ($response === false) {
        $error = "Error al conectar con la API del clima.";
    } else {
        $clima = json_decode($response, true);
        if (isset($clima['cod']) && $clima['cod'] != 200) {
            $error = "Ciudad no encontrada. Intenta con otro nombre.";
        }
    }
}
?>

<div class="container mt-5">
    <h2>🌦️ Clima Actual</h2>
    <form method="GET" class="mb-4">
        <input type="text" name="city" placeholder="Ej: Santo Domingo" required>
        <button type="submit" class="btn btn-success">Buscar</button>
    </form>

    <?php if ($error): ?>
        <div class="alert alert-warning"><?= $error ?></div>
    <?php elseif (!empty($clima)): ?>
        <div class="card <?= ($clima['weather'][0]['main'] == 'Rain') ? 'bg-info text-white' : 'bg-light' ?>">
            <div class="card-body">
                <h3><?= htmlspecialchars($clima['name']) ?>, <?= htmlspecialchars($clima['sys']['country']) ?></h3>
                <div class="d-flex align-items-center">
                    <img src="https://openweathermap.org/img/wn/<?= $clima['weather'][0]['icon'] ?>.png" alt="Icono del clima">
                    <h1 class="display-4"><?= round($clima['main']['temp']) ?>°C</h1>
                </div>
                <p class="mb-0"><?= ucfirst($clima['weather'][0]['description']) ?></p>
                <p>Humedad: <?= $clima['main']['humidity'] ?>%</p>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>