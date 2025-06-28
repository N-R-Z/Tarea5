<?php
include 'includes/header.php';

$age = '';
$category = '';
$error = '';

if (isset($_GET['name'])) {
    $api_url = "https://api.agify.io/?name=" . urlencode($_GET['name']);
    
    // Usar cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Solo para desarrollo local
    $response = curl_exec($ch);
    curl_close($ch);

    if ($response === false) {
        $error = "Error al conectar con la API.";
    } else {
        $data = json_decode($response, true);
        if (isset($data['age'])) {
            $age = $data['age'];
            if ($age < 18) $category = '👶 Joven';
            elseif ($age < 60) $category = '🧑 Adulto';
            else $category = '👴 Anciano';
        } else {
            $error = "No se pudo predecir la edad.";
        }
    }
}
?>

<div class="container mt-5">
    <h2>🎂 Predicción de Edad</h2>
    <form method="GET" class="mb-4">
        <input type="text" name="name" placeholder="Escribe un nombre" required>
        <button type="submit" class="btn btn-success">Predecir</button>
    </form>

    <?php if ($error): ?>
        <div class="alert alert-warning"><?= $error ?></div>
    <?php elseif ($age): ?>
        <div class="alert alert-info">
            <?= htmlspecialchars($_GET['name']) ?> tiene <strong><?= $age ?> años</strong>.<br>
            Categoría: <?= $category ?>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>