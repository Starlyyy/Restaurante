const URL_BASE = document.querySelector('#confUrlBase').dataset.urlBase

function removerFoto(){
    const foto = document.getElementById('')
}

// Preview da imagem selecionada
function previewFile(event) {
    const input = event.target;
    const file = input.files && input.files[0];
    if (!file) return;

    // pequeno check de tipo
    if (!file.type.startsWith('image/')) {
        mostrarErro("Por favor, selecione um arquivo de imagem válido.");
        return;
    }

    const reader = new FileReader();
    reader.onload = function(e) {
        const img = document.getElementById('previewImg');
        if (img) img.src = e.target.result;
    };
    reader.readAsDataURL(file);

    // Esconder mensagem de erro local (se houver)
    const msgDiv = document.getElementById('msgErroServer');
    if (msgDiv) msgDiv.style.display = 'none';
}


function mostrarErro(text) {
    const msgDiv = document.getElementById('msgErroServer');
    if (!msgDiv) return;
    msgDiv.innerHTML = text;
    msgDiv.style.display = 'block';

    // setTimeout(() => {
    //     msgDiv.style.display = 'none';
    // }, 6000);
}
