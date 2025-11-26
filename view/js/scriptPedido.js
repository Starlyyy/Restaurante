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