<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OverCozido - Sistema de Pedidos</title>
    <link rel="stylesheet" href="../view/styles/telaInicial.css">
</head>
<body>
    <!-- TELA INICIAL (SPLASH SCREEN) -->
    <div class="splash-screen">
        <div class="logo">
            <div class="logo-text">OverCozido</div>
            <div class="logo-subtitle">Experimentar o paraíso na sua boca é possível!</div>
        </div>
        <div class="loading-bar">
            <div class="loading-progress"></div>
        </div>
    </div>

    <script>
        // Aguarda 3 segundos e redireciona via JavaScript
        setTimeout(() => {
            window.location.href = '../view/pedidos/listar.php';
        }, 3300);
    </script>
</body>
</html>