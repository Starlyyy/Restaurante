const URL_BASE = document.querySelector('#confUrlBase').dataset.urlBase

function salvarComida(){
    const mesa = document.getElementById('mesa').value;
    const bebida = document.getElementById('bebida').value;
    const comida = document.getElementById('comida').value;

    const dados = new FormData();
    dados.append('idMesa', mesa);
    dados.append('idBebida', bebida);
    dados.append('idComida', comida);

    const xhttp = new XMLHttpRequest();
    xhttp.open('POST', URL_BASE + '/api/salvarPedido.php');

    xhttp.onload = function(){
        const erros = xhttp.responseText;

        if(erros){
            alert('Erro ao salvar pedido:\n' + erros);
        } else {
            alert('Pedido salvo com sucesso!');
            window.location.href = URL_BASE + '/view/pedidos/listar.php';
        }
    }
    xhttp.send(dados);
}