<?php
include 'includes/header.php';

$pokemon = [];
$error = '';

if (isset($_GET['name'])) {
    $nombre = strtolower(trim($_GET['name']));
    $api_url = "https://pokeapi.co/api/v2/pokemon/$nombre";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    if ($response === false) {
        $error = "Error al conectar con la API.";
    } else {
        $pokemon = json_decode($response, true);
        if (isset($pokemon['detail']) && $pokemon['detail'] === 'Not found.') {
            $error = "¡Pokémon no encontrado! Intenta con otro nombre.";
        }
    }
}
?>

<div class="container mt-5" style="background-color: #f8f9fa; border-radius: 15px; padding: 20px; border: 3px solid #ffcb05;">
    <h2 class="text-center" style="color: #3d7dca;">⚡ Buscador Pokémon</h2>
    <form method="GET" class="mb-4 text-center">
        <input type="text" name="name" placeholder="Ej: Pikachu" required class="form-control w-50 mx-auto">
        <button type="submit" class="btn btn-warning mt-2">Buscar</button>
    </form>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php elseif (!empty($pokemon)): ?>
        <div class="card mb-3 mx-auto" style="max-width: 400px; background: linear-gradient(135deg, #3d7dca 0%, #ffcb05 100%);">
            <div class="card-body text-center">
                <img src="<?= $pokemon['sprites']['front_default'] ?>" alt="<?= $pokemon['name'] ?>" class="img-fluid mb-3">
                <h3 class="text-white"><?= ucfirst($pokemon['name']) ?></h3>
                <p class="text-white">Experiencia base: <strong><?= $pokemon['base_experience'] ?></strong></p>
                <div class="abilities">
                    <h5 class="text-white">Habilidades:</h5>
                    <ul class="list-unstyled">
                        <?php foreach ($pokemon['abilities'] as $ability): ?>
                            <li class="text-white"><?= ucfirst($ability['ability']['name']) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <!-- Audio del Pokémon (ejemplo con Pikachu) -->
                <audio controls class="mt-3">
                    <source src="https://play.pokemonshowdown.com/audio/cries/<?= $pokemon['name'] ?>.mp3" type="audio/mpeg">
                    Tu navegador no soporta audio.
                </audio>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>