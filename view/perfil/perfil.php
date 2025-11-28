<?php
include_once(__DIR__ . "/../login/validar.php");

include_once(__DIR__ . "/../../controller/LoginController.php");
include_once(__DIR__ . "/../../controller/PerfilController.php");
// include_once(__DIR__ . '/../../util/config.php');

//Carregar o objeto referente ao usuário logado
$loginCont = new LoginController();
$usuario = $loginCont->getUsuarioLogado();

if (!$usuario) {
    echo "Usuário não encontrado!";
    exit;
}

//Carregar mensagem de sucesso de acordo com o parâmetro GET msg
$msgSucesso = "";
if (isset($_GET['msg']) && $_GET['msg'] == 1) {
    $msgSucesso = "Foto de perfil atualiza com sucesso.";
}

$msgErro = "";

if (isset($_FILES['foto'])) {
    //print_r($_FILES['foto']);
    $foto = $_FILES['foto'];

    $perfCont = new PerfilController();

    $erros = $perfCont->atualizar($usuario, $foto);
    if ($erros) {
        $msgErro = implode("<br>", $erros);
    } else {
        header("location: " . URL_BASE . "/view/perfil/perfil.php?msg=1");
    }
}


include(__DIR__ . '/../include/menu.php');

?>

<!DOCTYPE html>
<html lang="pt-Br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../styles/perfil/perfil.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Perfil</title>
    <style>
        :root {
            --bege-claro: #fbe9e7;
            --terracota: #d2695e;
            --argila: #a0522d;
            --tijolo: #8b3e2f;
            --marrom-suave: #6d4c41;
            --marrom-escuro: #3e2723;
            --white: #ffffff;
            --shadow: rgba(0, 0, 0, 0.25);
        }

        .container-fluid {
            margin-top: -1.4rem;  
            margin-bottom: 2rem;                      
            padding: 1rem 2rem;                            
        }

        body {
            background: linear-gradient(135deg, #321d19ff, var(--tijolo));
            min-height: 100vh;
            color: var(--bege-claro);
            font-family: "Poppins", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            padding-top: 18px;
            padding-bottom: 40px;
        }

        .container-profile {
            max-width: 980px;
            margin: 0 auto;
        }

        .profile-card {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.02), rgba(0, 0, 0, 0.04));
            border: 1px solid rgba(255, 255, 255, 0.03);
            padding: 22px;
            border-radius: 12px;
            box-shadow: 0 8px 24px var(--shadow);
        }

        .profile-title {
            color: var(--bege-claro);
            font-weight: 700;
            letter-spacing: 0.4px;
            margin-bottom: 14px;
            text-align: center;
        }

        .profile-img-wrap {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 16px;
        }

        .profile-img {
            width: 320px;
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            border: 3px solid var(--tijolo);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.45);
            object-fit: cover;
            background: #fff;
        }

        .form-card {
            background: rgba(255, 255, 255, 0.02);
            padding: 16px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.03);
        }

        .form-label {
            color: var(--bege-claro);
            font-weight: 600;
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid var(--tijolo);
            background-color: var(--bege-claro);
            color: var(--marrom-escuro);
            transition: box-shadow 0.18s ease, border-color 0.18s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--argila);
            box-shadow: 0 0 8px rgba(160, 95, 60, 0.18);
        }

        .btn-gravar {
            background-color: var(--marrom-escuro);
            color: var(--white) !important;
            border: 1px solid var(--tijolo);
            border-radius: 10px;
            padding: 10px 14px;
            font-weight: 700;
            width: 100%;
        }

        .btn-gravar:hover {
            background-color: var(--tijolo);
            transform: translateY(-1px);
        }

        .btn-remover {
            background-color: var(--terracota);
            color: var(--white) !important;
            border: 1px solid var(--tijolo);
            border-radius: 10px;
            padding: 10px 14px;
            width: 100%;
            font-weight: 700;
        }

        .btn-remover:hover {
            background-color: var(--argila);
            transform: translateY(-1px);
        }

        .alert-custom-success {
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.04), rgba(255, 255, 255, 0.02));
            border-left: 6px solid var(--bege-claro);
            color: var(--bege-claro);
            font-weight: 600;
        }

        .alert-custom-danger {
            background: rgba(139, 62, 47, 0.08);
            border-left: 6px solid #ffb3a7;
            color: var(--bege-claro);
            font-weight: 600;
        }

    </style>
</head>

<body>

    <span id='confUrlBase' data-url-base='<?=URL_BASE?>'></span>

    <div class="container container-profile">

        <div class="profile-card">
            <h3 class="profile-title">Perfil</h3>

            <div class="row gy-3">

                <div class="col-12 col-md-6">
                    <div class="mb-2"><span class="meta-line">Nome:</span> <span><?= htmlspecialchars($usuario->getNomeUsuario()) ?></span></div>

                    <div class="profile-img-wrap">
                        <?php if ($usuario->getFotoUsuario()): ?>
                            <img id="previewImg" class="profile-img" src="<?= URL_ARQUIVOS . '/' . htmlspecialchars($usuario->getFotoUsuario()) ?>" alt="Foto de perfil" class='fotoAntiga'>
                        <?php else: ?>
                            <img id="previewImg" class="profile-img" src="<?= URL_BASE ?>/img/perfil_nulo.png" alt="Sem foto">
                        <?php endif; ?>
                    </div>

                    <!-- Success alert -->
                    <?php if ($msgSucesso): ?>
                        <div class="alert alert-custom-success" role="alert">
                            <?= htmlspecialchars($msgSucesso) ?>
                        </div>
                    <?php endif; ?>

                </div>

                <div class="col-12 col-md-6">
                    <div class="form-card">
                        <form id="formFoto" action="perfil.php" method="POST" enctype="multipart/form-data" class="d-flex flex-column gap-3">

                            <div>
                                <label for="foto" class="form-label">Foto de perfil</label>
                                <input id="foto" type="file" name="foto" accept="image/*" class="form-control" onchange="previewFile(event)">
                            </div>

                            <div>
                                <button type="submit" class="btn btn-gravar">Gravar</button>
                            </div>

                            <!-- aqui da pra usar a funcao do remover arquivo que ja existe, mas como que eu faco isso?? -->
                            <!-- <div>
                                <button type="button" name="remover" class="btn btn-remover" onclick="removerFoto()">Remover foto</button>
                            </div> -->

                        </form>


                        <?php if ($msgErro): ?>
                            <div id="msgErroServer" class="alert alert-custom-danger mt-3" role="alert">
                                <?= $msgErro ?>
                            </div>
                        <?php else: ?>
                            <div id="msgErroServer" class="alert alert-custom-danger mt-3" role="alert" style="display:none;"></div>
                        <?php endif; ?>

                    </div>
                </div>

            </div> <!-- row -->
        </div> <!-- card -->

    </div> <!-- container -->

    <script src="../js/scriptPerfil.js"></script>
    <?php

    include(__DIR__ . '/../include/footer.php');

    ?>