<?php 

require_once(__DIR__ . "/../../controller/LoginController.php");

$msgErro = "";
$login = "";
$senha = "";

//Rotina para logar
if(isset($_POST['login'])) {
    $login = trim($_POST['login']) ? trim($_POST['login']) : NULL;
    $senha = trim($_POST['senha']) ? trim($_POST['senha']) : NULL;

    $loginCont = new LoginController();
    $erros = $loginCont->login($login, $senha);

    if(! $erros) {
        //Deu certo o login
        header("location: ../../index.php");

    } else {
        $msgErro = implode("<br>", $erros);
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
   <div class="divizinha">
    <form action="" method="post" class="d-flex flex-column gap-4">

        <div class="form-group w-100">
            <label for="nome" class="form-label">Usuário</label>
            <input type="text" name="nome" id="nome" class="form-control">
        </div>

        <div class="form-group w-100">
            <label for="senha" class="form-label">Senha</label>

            <div class="input-group">
                <input type="password" name="senha" id="senha" class="form-control">
                
                <button 
                    type="button" 
                    class="btn btn-show" 
                    onclick="mostrarSenha()"
                >
                    <i class="bi bi-eye-fill"></i>
                </button>
            </div>
        </div>

        <button type="submit" class="btn btn-submit w-100">Entrar</button>

    </form>
</div>



    <script>
        function mostrarSenha(){
            var input = document.querySelector('#senha')
            var inputType = input.getAttribute('type')
            
            
            inputType === 'password' ? input.setAttribute('type', 'text') : input.setAttribute('type', 'password')

        }
    </script>
</body>
</html>