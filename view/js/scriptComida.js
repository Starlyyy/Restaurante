const URL_BASE = document.querySelector('#confUrlBase').dataset.urlBase

function salvarComida(){
    const nome = document.getElementById('nome').value;
    const descricao = document.getElementById('descricao').value;
    const preco = document.getElementById('preco').value;

    const dados = new FormData();
    dados.append('nome', nome);
    dados.append('descricao', descricao);
    dados.append('preco', preco);

    const xhttp = new XMLHttpRequest();
    xhttp.open('POST', URL_BASE + '/api/salvarComida.php');

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