<?php
include 'includes/header.php';

$pais = [];
$error = '';

if (isset($_GET['name'])) {
    $nombre = urlencode($_GET['name']);
    $api_url = "https://restcountries.com/v3.1/name/$nombre";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    if ($response === false) {
        $error = "Error al conectar con la API.";
    } else {
        $data = json_decode($response, true);
        if (isset($data[0]['name'])) {
            $pais = $data[0];
        } else {
            $error = "País no encontrado. Intenta con otro nombre en inglés (Ej: Spain).";
        }
    }
}
?>

<div class="container mt-5">
    <h2 class="text-center">🌍 Datos del País</h2>
    <form method="GET" class="mb-4 text-center">
        <input type="text" name="name" placeholder="Ej: Dominican Republic" required class="form-control w-50 mx-auto">
        <button type="submit" class="btn btn-success mt-2">Buscar</button>
    </form>

    <?php if ($error): ?>
        <div class="alert alert-warning w-50 mx-auto"><?= $error ?></div>
    <?php elseif (!empty($pais)): ?>
        <div class="card mx-auto" style="max-width: 500px;">
            <img src="<?= $pais['flags']['png'] ?>" class="card-img-top" alt="Bandera de <?= $pais['name']['common'] ?>" style="height: 200px; object-fit: cover;">
            <div class="card-body">
                <h3 class="card-title"><?= $pais['name']['common'] ?></h3>
                <p class="card-text">Capital: <strong><?= implode(', ', $pais['capital']) ?></strong></p>
                <p class="card-text">Población: <strong><?= number_format($pais['population']) ?> habitantes</strong></p>
                <p class="card-text">Moneda: <strong><?= key($pais['currencies']) ?> (<?= $pais['currencies'][key($pais['currencies'])]['name'] ?>)</strong></p>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>