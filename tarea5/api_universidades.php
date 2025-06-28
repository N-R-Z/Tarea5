<?php
include 'includes/header.php';

$universidades = [];
$error = '';

if (isset($_GET['country'])) {
    $pais = urlencode($_GET['country']);
    $api_url = "http://universities.hipolabs.com/search?country=$pais";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    if ($response === false) {
        $error = "Error al conectar con la API.";
    } else {
        $universidades = json_decode($response, true);
        if (empty($universidades)) {
            $error = "No se encontraron universidades para este país.";
        }
    }
}
?>

<div class="container mt-5">
    <h2>🎓 Universidades por País</h2>
    <form method="GET" class="mb-4">
        <input type="text" name="country" placeholder="Ej: Dominican Republic" required>
        <button type="submit" class="btn btn-success">Buscar</button>
    </form>

    <?php if ($error): ?>
        <div class="alert alert-warning"><?= $error ?></div>
    <?php elseif (!empty($universidades)): ?>
        <div class="list-group">
            <?php foreach ($universidades as $uni): ?>
                <div class="list-group-item">
                    <h5><?= htmlspecialchars($uni['name']) ?></h5>
                    <p class="mb-1">Dominio: <?= htmlspecialchars($uni['domains'][0] ?? 'N/A') ?></p>
                    <a href="<?= htmlspecialchars($uni['web_pages'][0] ?? '#') ?>" target="_blank" class="btn btn-sm btn-primary">Visitar sitio</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>