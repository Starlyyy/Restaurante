const URL_BASE = document.querySelector('#confUrlBase').dataset.urlBase

const selectComida = document.getElementById('comida');
const descricaoComida = document.getElementById('descricaoComida');
const radios = document.querySelectorAll('input[name="alcoolica"]');
const selectBebida = document.getElementById('bebida');

// Atualizar descrição da comida
selectComida.addEventListener('change', function() {
    const selected = this.options[this.selectedIndex];
    descricaoComida.innerText = selected.dataset.descricao || '';
});

function SelectBebida(bebidas, valorSelecionado = "") {

    selectBebida.innerHTML = '';
    const optDefault = document.createElement('option');
    optDefault.value = "";
    optDefault.disabled = true;
    optDefault.hidden = true;
    optDefault.selected = true;
    optDefault.textContent = "Selecione";
    selectBebida.appendChild(optDefault);

    bebidas.forEach(b => {
        const opt = document.createElement('option');
        opt.value = b.id;
        opt.textContent = `${b.nome} (${b.preco})`;
        opt.dataset.alcoolica = b.alcoolica;
        if (String(b.id) === String(valorSelecionado)) opt.selected = true;
        selectBebida.appendChild(opt);
    });
}

function carregarBebidas(tipo = null, valorSelecionado = "") {
    const xhr = new XMLHttpRequest();
    let url = URL_BASE + '/api/bebidas.php';
    if (tipo) url += '?alcoolica=' + encodeURIComponent(tipo); //serve pra evitar caracteres especiais na url {sempre tem um engracadinho, ne?}

    xhr.open('GET', url, true);
    xhr.onload = function() {

        try {
            const dados = JSON.parse(xhr.responseText);
            SelectBebida(dados, valorSelecionado);
        } catch (e) {
            console.error('Resposta inválida ao carregar bebidas:', e);
            alert('Erro ao processar lista de bebidas.');
        }
        
    };
    xhr.onerror = function() {
        alert('Erro de rede ao carregar bebidas.');
    };
    xhr.send();
}

// Eventos das radios: carregar apenas o tipo selecionado
radios.forEach(r => {
    r.addEventListener('change', function() {
        carregarBebidas(this.value);
    });
});

// se já houver uma radio marcada, carrega esse tipo; caso contrário carrega todas.
document.addEventListener('DOMContentLoaded', function() {
    let marcado = null;
    radios.forEach(r => { if (r.checked) marcado = r.value; });
    carregarBebidas(marcado);
});

function salvarPedido(){
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