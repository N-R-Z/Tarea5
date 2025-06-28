<?php
include 'includes/header.php';

$noticias = [];
$error = '';

if (isset($_GET['url'])) {
    $url = rtrim($_GET['url'], '/'); // Elimina la barra final si existe
    $api_url = "$url/wp-json/wp/v2/posts?per_page=3";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);

    if ($response === false) {
        $error = "Error al conectar con el sitio WordPress.";
    } else {
        $noticias = json_decode($response, true);
        if (isset($noticias['code']) && $noticias['code'] === 'rest_no_route') {
            $error = "Este sitio no tiene la API REST activa.";
        }
    }
}
?>

<div class="container mt-5">
    <h2 class="text-center">📰 Últimas Noticias WordPress</h2>
    <form method="GET" class="mb-4">
        <input type="text" name="url" placeholder="Ej: https://ejemplo.com" required class="form-control">
        <button type="submit" class="btn btn-primary mt-2">Buscar Noticias</button>
    </form>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php elseif (!empty($noticias)): ?>
        <div class="row">
            <?php foreach ($noticias as $noticia): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($noticia['title']['rendered']) ?></h5>
                            <div class="card-text"><?= wp_trim_words(strip_tags($noticia['content']['rendered']), 20) ?></div>
                        </div>
                        <div class="card-footer bg-white">
                            <a href="<?= $noticia['link'] ?>" target="_blank" class="btn btn-sm btn-info">Leer más</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>