<?php include 'includes/header.php'; ?>

<div class="container text-center mt-5">
    <h1>¡Hola, soy <span class="text-primary">Asiel</span>! 👋</h1>
    <img src="assets/img/foto_asiel.jpg" alt="Foto de Asiel" class="img-thumbnail rounded-circle w-25">
    <p class="mt-3">Bienvenido/a a mi portal de APIs dinámicas. Explora las siguientes herramientas:</p>
    
    <!-- Menú de APIs en tarjetas -->
    <div class="row mt-4 g-4">
        <!-- API 1: Género -->
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">👦👧 Predicción de Género</h5>
                    <p class="card-text">Descubre si un nombre es masculino o femenino.</p>
                    <a href="api_gender.php" class="btn btn-outline-primary">Ir</a>
                </div>
            </div>
        </div>
        
        <!-- API 2: Edad -->
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">🎂 Predicción de Edad</h5>
                    <p class="card-text">Estima la edad basada en un nombre.</p>
                    <a href="api_age.php" class="btn btn-outline-success">Ir</a>
                </div>
            </div>
        </div>
        
        <!-- API 3: Universidades -->
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">🎓 Universidades</h5>
                    <p class="card-text">Lista de universidades por país.</p>
                    <a href="api_universidades.php" class="btn btn-outline-info">Ir</a>
                </div>
            </div>
        </div>
        
        <!-- API 4: Clima -->
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">🌦️ Clima</h5>
                    <p class="card-text">Consulta el clima actual.</p>
                    <a href="api_clima.php" class="btn btn-outline-warning">Ir</a>
                </div>
            </div>
        </div>
        
        <!-- API 5: Pokémon -->
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">⚡ Pokémon</h5>
                    <p class="card-text">Busca información de Pokémon.</p>
                    <a href="api_pokemon.php" class="btn btn-outline-danger">Ir</a>
                </div>
            </div>
        </div>
        
        <!-- API 6: Noticias -->
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">📰 Noticias WordPress</h5>
                    <p class="card-text">Últimas noticias de sitios WordPress.</p>
                    <a href="api_noticias.php" class="btn btn-outline-dark">Ir</a>
                </div>
            </div>
        </div>
        
        <!-- API 7: Monedas -->
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">💰 Conversor de Monedas</h5>
                    <p class="card-text">Convierte USD a DOP y más.</p>
                    <a href="api_monedas.php" class="btn btn-outline-primary">Ir</a>
                </div>
            </div>
        </div>
        
        <!-- API 8: Imágenes IA -->
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">🖼️ Generador de Imágenes</h5>
                    <p class="card-text">Imágenes basadas en palabras clave.</p>
                    <a href="api_imagenes.php" class="btn btn-outline-success">Ir</a>
                </div>
            </div>
        </div>
        
        <!-- API 9: Países -->
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">🌍 Datos de Países</h5>
                    <p class="card-text">Bandera, capital y más.</p>
                    <a href="api_paises.php" class="btn btn-outline-info">Ir</a>
                </div>
            </div>
        </div>
        
        <!-- API 10: Chistes -->
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">🤣 Chistes Aleatorios</h5>
                    <p class="card-text">Ríete con chistes random.</p>
                    <a href="api_chistes.php" class="btn btn-outline-warning">Ir</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
