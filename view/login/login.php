<?php 

require_once(__DIR__ . "/../../controller/LoginController.php");

$msgErro = "";
$nome = "";
$senha = "";

//Rotina para logar
if(isset($_POST['nome'])) {
    $nome = trim($_POST['nome']) ? trim($_POST['nome']) : NULL;
    $senha = trim($_POST['senha']) ? trim($_POST['senha']) : NULL;

    $loginCont = new LoginController();
    $erros = $loginCont->login($nome, $senha);

    if(!$erros) {
        //Deu certo o login
        header("location: ../pedidos/listar.php");
        // echo "OI MUNDO";

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

    <style>

/* Paleta */
:root {
    --bege-claro: #fbe9e7;
    --terracota: #d2695e;
    --argila: #a0522d;
    --tijolo: #8b3e2f;
    --marrom-suave: #6d4c41;
    --marrom-escuro: #3e2723;
    --white: #ffffff;
}

/* Fundo */
body {
    background: linear-gradient(135deg, var(--marrom-escuro), var(--marrom-suave));
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: "Poppins", sans-serif;
}

/* Card principal */
.divizinha {
    background-color: var(--terracota) !important;
    width: 420px;
    padding: 40px 30px;
    border-radius: 12px;
    border: 2px solid var(--tijolo);
    box-shadow: 0px 10px 25px rgba(0,0,0,0.35);
    color: var(--white);
    animation: fadeIn 0.6s ease;
}

/* Animação */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(30px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* Labels */
.form-label {
    font-weight: 600;
    margin-bottom: 6px;
}

/* Inputs Bootstrap */
.form-control {
    border: 2px solid var(--tijolo);
    background-color: var(--bege-claro);
    color: var(--marrom-escuro);
    border-radius: 10px;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: var(--argila);
    box-shadow: 0 0 8px var(--argila);
}

/* Botão Mostrar Senha */
.btn-show {
    border: 2px solid var(--white);
    color: var(--white);
    border-radius: 10px;
    transition: 0.3s ease;
}

.btn-show:hover {
    background-color: var(--bege-claro);
    color: var(--marrom-escuro);
}

/* Botão Enviar */
.btn-submit {
    background-color: var(--tijolo);
    border: none;
    padding: 10px;
    border-radius: 10px;
    font-weight: bold;
    transition: 0.3s ease;
}

.btn-submit:hover {
    background-color: var(--marrom-escuro);
}

    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
   <div class="divizinha">
    <form action="" method="POST" class="d-flex flex-column gap-4">

        <div class="form-group w-100">
            <label for="nome" class="form-label">Usuário</label>
            <input type="text" name="nome" id="nome" class="form-control" value="<?= $nome ?>">
        </div>

        <div class="form-group w-100">
            <label for="senha" class="form-label">Senha</label>

            <div class="input-group">
                <input type="password" name="senha" id="senha" class="form-control" value='<?= $senha ?>'>
                
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

        <div>
            <?php if ($msgErro): ?>
                <div id="msgErro"><?= $msgErro ?></div>
            <?php endif; ?>
        </div>

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