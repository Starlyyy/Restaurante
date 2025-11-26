const URL_BASE = document.querySelector('#confUrlBase').dataset.urlBase

function salvarBebida(){
    const nome = document.getElementById('nome').value;
    const alcoolica = document.querySelector('input[name="alcoolica"]:checked');
    const alcool = alcoolica.value;
    const preco = document.getElementById('preco').value;

    const dados = new FormData();
    dados.append('nome', nome);
    dados.append('alcoolica', alcool);
    dados.append('preco', preco);

    const xhttp = new XMLHttpRequest();
    xhttp.open('POST', URL_BASE + '/api/salvarBebida.php');
    xhttp.onload = function(){
        const erros = xhttp.responseText;

        if(erros){
            alert('Erro ao salvar pedido:\n' + erros);
        } else {
            alert('Pedido salvo com sucesso!');
            window.location.href = URL_BASE + '/view/cardapio.php';
        }
    }
    xhttp.send(dados);
}