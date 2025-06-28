<?php
include 'includes/header.php';

$chiste = [];
$error = '';

$api_url = "https://official-joke-api.appspot.com/random_joke";
    
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

if ($response === false) {
    $error = "Error al conectar con la API de chistes.";
} else {
    $chiste = json_decode($response, true);
    if (!isset($chiste['setup'])) {
        $error = "No se pudo cargar un chiste en este momento.";
    }
}
?>

<div class="container mt-5">
    <h2 class="text-center">🤣 Chiste Aleatorio</h2>
    <div class="text-center mb-4">
        <a href="api_chistes.php" class="btn btn-warning">Nuevo Chiste</a>
    </div>

    <?php if ($error): ?>
        <div class="alert alert-danger w-50 mx-auto"><?= $error ?></div>
    <?php elseif (!empty($chiste)): ?>
        <div class="card mx-auto" style="max-width: 600px;">
            <div class="card-body text-center">
                <h4 class="card-title"><?= $chiste['setup'] ?></h4>
                <p class="card-text fs-5 mt-3">👉 <?= $chiste['punchline'] ?></p>
            </div>
            <div class="card-footer text-muted">
                Categoría: <?= ucfirst($chiste['type']) ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>