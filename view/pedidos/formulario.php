<?php
session_start();

require_once(__DIR__ . "/../../controller/BebidaController.php");
require_once(__DIR__ . "/../../controller/ComidaController.php");

$controladorBebida = new BebidaController();
$controladorComida = new ComidaController();

$bebidas = $controladorBebida->listar();
$comidas = $controladorComida->listar();

// Mensagem de erro e dados antigos
$msgErro = $_SESSION['erro'] ?? '';
$old = $_SESSION['old'] ?? [];

// Inputs antigos
$mesaSelecionada       = $old['mesa'] ?? '';
$bebidaSelecionada     = $old['bebida'] ?? '';
$comidaSelecionada     = $old['comida'] ?? '';
$alcoolicaSelecionada  = $old['alcoolica'] ?? '';

// Limpa erro (pra não ficar persistindo sempre)
unset($_SESSION['erro']);
?>
<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Fazer Pedido</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../styles/Pedido/style.css">
    </head>

    <body>

        <div class="container my-5 col-8">

            
            <?php if ($msgErro): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($msgErro) ?></div>
            <?php endif; ?>
                
            <form method="POST" action="inserir.php" class="p-4 rounded shadow">

                <a href="listar.php" class="text-decoration-none fs-5 mb-4">🠔 Voltar</a>
                <h1 class="text-center mb-4 w-50">🍷 Fazendo pedido</h1>
                <!-- Mesa -->
                <h2 class="mb-3">Selecione a mesa</h2>
                <div class="mb-3">
                    <label for="mesa" class="form-label">Número da mesa:</label>
                    <input type="number" name="mesa" id="mesa" min="1" max="24" class="form-control"
                        value="<?= htmlspecialchars($mesaSelecionada) ?>">
                </div>

                <!-- Bebida -->
                <h2 class="mb-3">Selecione a bebida</h2>
                <h3 class="mb-2">Tipo:</h3>
                <div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="alcoolica" id="alcoolicaS" value="S" class="form-check-input"
                            <?= $alcoolicaSelecionada === 'S' ? 'checked' : '' ?>>
                        <label for="alcoolicaS" class="form-check-label">Alcoólica</label>
                    </div>
                    <div class="form-check form-check-inline mb-3">
                        <input type="radio" name="alcoolica" id="alcoolicaN" value="N" class="form-check-input"
                            <?= $alcoolicaSelecionada === 'N' ? 'checked' : '' ?>>
                        <label for="alcoolicaN" class="form-check-label">Não alcoólica</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="bebida" class="form-label">Bebida:</label>
                    <select name="bebida" id="bebida" class="form-select">
                        <option value="" hidden disabled <?= !$bebidaSelecionada ? 'selected' : '' ?>>Selecione</option>
                        <?php foreach ($bebidas as $bebida): ?>
                            <option value="<?= $bebida->getId() ?>"
                                data-alcoolica="<?= $bebida->getAlcoolica() ?>"
                                <?= $bebidaSelecionada == $bebida->getId() ? 'selected' : '' ?>>
                                <?= $bebida->getNome() ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Comida -->
                <h2 class="mb-3">Selecione a comida</h2>
                <div class="mb-3">
                    <label for="comida" class="form-label">Comida:</label>
                    <select name="comida" id="comida" class="form-select">
                        <option value="" hidden disabled <?= !$comidaSelecionada ? 'selected' : '' ?>>Selecione</option>
                        <?php foreach ($comidas as $comida): ?>
                            <option value="<?= $comida->getId() ?>"
                                data-descricao="<?= htmlspecialchars($comida->getDescricao()) ?>"
                                <?= $comidaSelecionada == $comida->getId() ? 'selected' : '' ?>>
                                <?= $comida->getNome() ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <p class="fst-italic text-muted" id="descricaoComida">
                    <?php
                    if ($comidaSelecionada) {
                        foreach ($comidas as $c) {
                            if ($c->getId() == $comidaSelecionada) {
                                echo htmlspecialchars($c->getDescricao());
                            }
                        }
                    }
                    ?>
                </p>

                <!-- Botão -->
                <button type="submit" class="btn btn-primary w-100 mt-3">Enviar pedido</button>
            </form>
        </div>

        <script>
            const selectComida = document.getElementById('comida');
            const descricaoComida = document.getElementById('descricaoComida');
            const radios = document.querySelectorAll('input[name="alcoolica"]');
            const selectBebida = document.getElementById('bebida');

            // Atualizar descrição da comida
            selectComida.addEventListener('change', function() {
                const selected = this.options[this.selectedIndex];
                descricaoComida.innerText = selected.dataset.descricao || '';
            });

            // Filtrar bebidas
            function filtrarBebidas(tipo) {
                for (let opt of selectBebida.options) {
                    if (opt.value === "") continue; // ignora "Selecione"
                    opt.style.display = (opt.dataset.alcoolica === tipo) ? "block" : "none";
                }
                // reseta se a atual não for compatível
                if (selectBebida.selectedIndex > 0 && selectBebida.options[selectBebida.selectedIndex].dataset.alcoolica !== tipo) {
                    selectBebida.value = "";
                }
            }

            radios.forEach(r => {
                r.addEventListener('change', function() {
                    filtrarBebidas(this.value);
                });
            });

            // Se já veio preenchido da sessão, aplica filtro
            <?php if ($alcoolicaSelecionada): ?>
                filtrarBebidas("<?= $alcoolicaSelecionada ?>");
            <?php endif; ?>
        </script>

    </body>

</html>