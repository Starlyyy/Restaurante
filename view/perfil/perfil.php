<?php
include_once(__DIR__ . "/../login/validar.php");

include_once(__DIR__ . "/../../controller/LoginController.php");
include_once(__DIR__ . "/../../controller/PerfilController.php");

//Carregar o objeto referente ao usuário logado
$loginCont = new LoginController();
$usuario = $loginCont->getUsuarioLogado();

if(!$usuario) {
    echo "Usuário não encontrado!";
    exit;
}

//Carregar mensagem de sucesso de acordo com o parâmetro GET msg
$msgSucesso = "";
if(isset($_GET['msg']) && $_GET['msg'] == 1) {
    $msgSucesso = "Foto de perfil atualiza com sucesso.";
}

$msgErro = "";

if(isset($_FILES['foto'])) {
    //print_r($_FILES['foto']);
    $foto = $_FILES['foto'];

    $perfCont = new PerfilController();

    $erros = $perfCont->atualizar($usuario, $foto);
    if($erros) {
        $msgErro = implode("<br>", $erros);
    } else {
        header("location: " . URL_BASE . "/view/perfil/perfil.php?msg=1");
    }

}

include (__DIR__ . '/../include/menu.php');

?>

<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/perfil/perfil.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Perfil</title>
</head>
    <body>
        <h3 class="text-center">
            Perfil
        </h3>

        <div class="row mt-2">
            <div class="col-12 mb-2">
                <span class="fw-bold">Nome:</span>
                <span><?= $usuario->getNomeUsuario() ?></span>
            </div>

            <div class="col-12 mb-2">
                <div class="fw-bold">Foto:</div>
                <!-- <?= $usuario->getFotoUsuario() ?> -->
                <?php if($usuario->getFotoUsuario()): ?>
                    <img src="<?= URL_ARQUIVOS . '/' . $usuario->getFotoUsuario()?>"
                        height="400px">
                <?php else: ?>
                    <img src="<?= URL_BASE ?>/img/perfil_nulo.png" height="400px">    
                <?php endif; ?>
            </div>

            <div class="col-6 mb-2 mt-3">
                <?php if($msgSucesso): ?>
                    <div class="alert alert-success">
                        <?= $msgSucesso ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>
            
        <div class="row mt-5">
            
            <div class="col-6">
                <form action="perfil.php" method="POST"
                    enctype="multipart/form-data" >

                    <div>
                        <label for="foto" class="form-label">Foto de perfil: </label>
                        <input id="foto" type="file" name="foto"
                            class="form-control" accept="image/*">
                    </div>

                    <div class="mt-3">
                        <button class="btn btn-success">Gravar</button>
                    </div>
                    
                    <div class="mt-3">
                        <button class="btn btn-primary">Remover foto</button>
                    </div>
                </form>
            </div>

            <div class="col-6">
                <?php if($msgErro): ?>
                    <div class="alert alert-danger">
                        <?= $msgErro ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
<?php 

    include(__DIR__ . '/../include/footer.php');

?>

