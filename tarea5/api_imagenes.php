<?php
include 'includes/header.php';

$imagen = '';
$error = '';
$api_key = 'TU_API_KEY_UNSPLASH'; // ¡Reemplázala!

if (isset($_GET['keyword'])) {
    $keyword = urlencode($_GET['keyword']);
    $api_url = "https://api.unsplash.com/photos/random?query=$keyword&client_id=$api_key";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    if ($response === false) {
        $error = "Error al conectar con Unsplash.";
    } else {
        $data = json_decode($response, true);
        if (isset($data['urls']['regular'])) {
            $imagen = $data['urls']['regular'];
            $autor = $data['user']['name'];
        } else {
            $error = "No se encontraron imágenes para esta palabra clave.";
        }
    }
}
?>

<div class="container mt-5">
    <h2 class="text-center">🖼️ Generador de Imágenes</h2>
    <form method="GET" class="mb-4 text-center">
        <input type="text" name="keyword" placeholder="Ej: playa, montaña, tecnología" required class="form-control w-50 mx-auto">
        <button type="submit" class="btn btn-primary mt-2">Generar</button>
    </form>

    <?php if ($error): ?>
        <div class="alert alert-danger w-50 mx-auto"><?= $error ?></div>
    <?php elseif ($imagen): ?>
        <div class="card mx-auto" style="max-width: 600px;">
            <img src="<?= $imagen ?>" class="card-img-top" alt="Imagen generada">
            <div class="card-footer text-muted">
                Foto por <?= $autor ?> en <a href="https://unsplash.com/" target="_blank">Unsplash</a>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>