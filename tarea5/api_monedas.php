<?php
include 'includes/header.php';

$tasas = [];
$error = '';
$resultado = '';

if (isset($_GET['amount'])) {
    $monto = floatval($_GET['amount']);
    $api_url = "https://api.exchangerate-api.com/v4/latest/USD";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    if ($response === false) {
        $error = "Error al conectar con la API de monedas.";
    } else {
        $tasas = json_decode($response, true);
        if (isset($tasas['rates'])) {
            $dop = $monto * $tasas['rates']['DOP'];
            $eur = $monto * $tasas['rates']['EUR'];
            $resultado = "
                <div class='alert alert-success mt-4'>
                    <strong>$$monto USD</strong> equivale a:<br>
                    💵 <strong>" . number_format($dop, 2) . " DOP</strong> (Pesos Dominicanos)<br>
                    💶 <strong>" . number_format($eur, 2) . " EUR</strong> (Euros)
                </div>
            ";
        }
    }
}
?>

<div class="container mt-5">
    <h2 class="text-center">💰 Conversor de Monedas</h2>
    <form method="GET" class="mb-4 text-center">
        <div class="input-group mx-auto" style="max-width: 300px;">
            <span class="input-group-text">$</span>
            <input type="number" name="amount" placeholder="Monto en USD" required step="0.01" class="form-control">
            <button type="submit" class="btn btn-success">Convertir</button>
        </div>
    </form>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php else: ?>
        <?= $resultado ?>
        <div class="mt-3 text-center">
            <small class="text-muted">Tasas actualizadas: <?= date('d/m/Y') ?></small>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>