<?php
session_start();
include_once('assets/cabecalho.php');
include_once('assets/rodape.php');
include('config/conexao.php');
include_once("config/seguranca.php");
seguranca_adm();
$consulta = "SELECT * FROM clientes WHERE concluido = 'NAO' ORDER BY ultima_alteracao DESC ; ";
$resultado = mysqli_query($conn, $consulta);
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$dataLocal = date('d/m/Y H:i:s', time());

// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
?>

<?php include_once('assets/menu.php'); ?>

<?php
if (isset($_SESSION['error'])) {
    echo $_SESSION['error'];
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    echo $_SESSION['success'];
    unset($_SESSION['success']);
}
?>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 bg-warning justify-content-between p-3">
        <a class="btn btn-sm btn-dark "  href="JavaScript:location.reload(true);">
ATUALIZAR
</a>        <a class="btn btn-sm btn-dark "  href="listar_chamados.php">
CHAMADOS
</a>
<a class="btn btn-sm btn-dark "  href="listar_chamados_concluidos.php">
CHAMADOS CONCLUIDOS
</a>
<button type="button" class="btn btn-sm btn-dark " data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#cadCliente">NOVO CHAMADO</button>
        </div>
        <div class="col-md-2 bg-warning justify-content-between p-3">
            <div class="form-label-group">
            </div>
        </div>
        <div class="col-md-4 bg-warning  justify-content-between p-3 d-flex"><input type="text" name="pesquisa_cliente" id="pesquisa_cliente" class="form-control" placeholder="PESQUISAR CLIENTES POR NOME" required autofocu  > 
        </div>
    </div>
</div>



<div class="container">
  <div class="row">
    <div class="col">
    </div>
    <div class="col">
<script type="text/javascript">
// Função javascript
function lowerCase(input) {
  input.value = input.value.toLowerCase();
}

</script>
<form method="POST" action="processa_cad_usuarios.php">
			<label><span style="font-weight: bold;">Nome:</span></label>
			<input class="form-control form-control-lg" type="text" name="nome" placeholder="Digite o nome e o sobrenome" required onchange="this.value = this.value.trim()" ><br>
			<label><span style="font-weight: bold;" >Usuário:</span></label>
			<input class="form-control form-control-lg" type="text" name="usuario" placeholder="Digite o usuário" required onchange="this.value = this.value.trim()" onkeyup="return lowerCase(this)"><br>
			<label><span style="font-weight: bold;">Senha:</span></label>
			<input class="form-control form-control-lg" type="password" name="senha" placeholder="Digite a senha" required onchange="this.value = this.value.trim()"><br>
			
			<input class="btn btn-secondary position-relative" type="submit" name="btnCadUsuario" value="Cadastrar"><br><br>
		
		</form>





    </div>
    <div class="col">
    </div>
  </div>
</div>

<!-- ================================== MODAL CADASTRAR CLIENTE----------------------------------------------------------------->
<style>
    .errorInput {
        border: 2px solid red !important;
    }
</style>
<script>
    // ================================ FUNÇÃO PARA MASCARA DE TELEFONE =============================================
    function mask(o, f) {
        setTimeout(function() {
            var v = telefone(o.value);
            if (v != o.value) {
                o.value = v;
            }
        }, 1);
    }

    function telefone(v) {
        var r = v.replace(/\D/g, "");
        r = r.replace(/^0/, ""); //limpa o campo se começar com ZERO (0)
        if (r.length > 10) {
            r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
        } else if (r.length > 5) {
            r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
        } else if (r.length > 2) {
            r = r.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
        } else {
            r = r.replace(/^(\d*)/, "($1");
        }
        return r;
    }

    // ================================ FUNÇÃO PARA MASCARA DE CELULAR =============================================
    function mask(o, f) {
        setTimeout(function() {
            var v = celular(o.value);
            if (v != o.value) {
                o.value = v;
            }
        }, 1);
    }

    function celular(v) {
        var r = v.replace(/\D/g, "");
        r = r.replace(/^0/, ""); //limpa o campo se começar com ZERO (0)
        if (r.length > 10) {
            r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
        } else if (r.length > 5) {
            r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
        } else if (r.length > 2) {
            r = r.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
        } else {
            r = r.replace(/^(\d*)/, "($1");
        }
        return r;
    }

    // ================================ FUNÇÃO PARA MASCARA DE CPF =============================================
    $(document).ready(function() {
        $("#cpf").mask("999.999.999-99");
    });

    // ================================ FUNÇÃO PARA MASCARA DE NASCIMENTO =============================================
    $(document).ready(function() {
        $("#nascimento").mask("99/99/9999");
    });

    // FUNÇÃO PARA ADICONAR ENDEREÇO VIA CEP (https://viacep.com.br/exemplo/javascript/)
    function limpa_formulário_cep() {
        //Limpa valores do formulário de cep.
        document.getElementById('rua').value = ("");
        document.getElementById('bairro').value = ("");
        document.getElementById('numero').value = ("");
        document.getElementById('uf').value = ("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value = (conteudo.rua);
            document.getElementById('bairro').value = (conteudo.bairro);
            document.getElementById('numero').value = (conteudo.numero);
            document.getElementById('uf').value = (conteudo.uf);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }

    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value = "...";
                document.getElementById('bairro').value = "...";
                document.getElementById('cidade').value = "...";
                document.getElementById('uf').value = "...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };


    $(document).ready(function() {

        $('#insert_form').on('submit', function(event) {
            event.preventDefault(); //EVITA O SUBMIT DO FORM

            var nome = $('#nome'); // PEGA O CAMPO CLIENTE DO FORM



            var erro = $('.alert-danger'); // PEGA O CAMPO COM A class alert e CRIA A VARIAVEL erro
            var campo = $('#campo-erro'); // CRIA A VARIAVEL PATA EXIBIR O NOME DO CAMPO COM ERROcampo-sucesso


            erro.addClass('d-none');
            $('.is-invalid').removeClass('is-invalid');
            $('.is-valid').removeClass('is-valid');


            if (!nome.val().match(/[A-Za-z\d]/)) {
                erro.removeClass('d-none'); //REMOVE A CLASSE (d-none) DO BOOTSTRAP E EXIBE O ALERTA
                campo.html('cliente'); // ADICIONA AO ALERTA O NOME DO CAMPO NAO PREENCHIDO
                nome.focus(); //COLOCA O CURSOR NO CAMPO COM ERRO
                nome.addClass('is-invalid');



                return false;

            } else {

                var dados = $("#insert_form").serialize();
                $.post("processa_cad_clientes.php", dados, function(retorna) {
                    if (retorna) {
                        //Limpar os campo
                        $('#insert_form')[0].reset();

                        //Fechar a janela modal cadastrar
                        $('#cadCliente').modal('hide');
                        $('#sucessModal').modal('show');

                        setInterval(function() {
                            var redirecionar = "listar_chamados.php";
                            $(window.document.location).attr('href', redirecionar);

                        }, 3000);

                    } else {

                        return false;
                    }

                });

            }

        });

    });
</script>


<!-- Modal ALERTA DE CADASTRO COM SUCESSO--><!-- Modal ALERTA DE CADASTRO NAO REALIZADO--><!-- ==================================================MODAL CADASTRO DE CLIENTE ==================================== --><!-- -----------------------------------MODAL VISUALIZAR CLIENTE-----------------------------------------------------------------><!-- -----------------------------------SCRIPT MODAL VISUALIZAR CLIENTE----------------------------------------------------------------->
<script type="text/javascript">
    $('#visulaizarCliente').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Botão que acionou o modal
        var recipient = button.data('whatever')
        var recipientnome = button.data('whatevernome')
        var recipientsituacao = button.data('whateversituacao')
		var recipientatendente = button.data('whateveratendente')
		var recipientstatus = button.data('whateverstatus')
		var recipientrua = button.data('whateverrua')
		var recipientbairro = button.data('whateverbairro')
		var recipientnumero = button.data('whatevernumero')
		var recipienttecnico = button.data('whatevertecnico')
		var recipientveiculo = button.data('whateverveiculo')
		var recipientplano = button.data('whateverplano')
        var recipientoperador = button.data('whateveroperador')
        var recipientsituacao = button.data('whateversituacao')
        var recipientdataCadastro = button.data('whateverdata-cadastro')
        var recipientalterado_por = button.data('whateveralterado_por')
        var recipientultima_alteracao = button.data('whateverultima_alteracao')

        var modal = $(this)
        modal.find('.modal-title').text('VISUALIZAR CHAMADO ID: ' + recipient)
        modal.find('#id').val(recipient)
        modal.find('#recipient-nome').val(recipientnome)
		modal.find('#recipient-situacao').val(recipientsituacao)
		modal.find('#recipient-atendente').val(recipientatendente)
		modal.find('#recipient-status').val(recipientstatus)
		modal.find('#recipient-rua').val(recipientrua)
		modal.find('#recipient-bairro').val(recipientbairro)
		modal.find('#recipient-numero').val(recipientnumero)
		modal.find('#recipient-tecnico').val(recipienttecnico)
		modal.find('#recipient-veiculo').val(recipientveiculo)
		modal.find('#recipient-plano').val(recipientplano)
		modal.find('#recipient-operador').val(recipientoperador)
        modal.find('#recipient-dataCadastro').val(recipientdataCadastro)
        modal.find('#recipient-alterado_por').val(recipientalterado_por)
        modal.find('#recipient-ultima_alteracao').val(recipientultima_alteracao)

    })
</script>

<!-- -----------------------------------MODAL EDITAR CLIENTE----------------------------------------------------------------->



<div class="modal fade" id="editarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<!-- -----------------------------------SCRIPT MODAL EDITAR CLIENTE----------------------------------------------------------------->
<script type="text/javascript">
    $('#editarCliente').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Botão que acionou o modal
        var recipient = button.data('whatever')
        var recipientnome = button.data('whatevernome')
        var recipienttecnico = button.data('whatevertecnico')
        var recipienttelefone = button.data('whatevertelefone')
        var recipientrua = button.data('whateverrua')
        var recipientnumero = button.data('whatevernumero')
        var recipientbairro = button.data('whateverbairro')
        var recipientcomplemento = button.data('whatevercomplemento')
        var recipientcep = button.data('whatevercep')
        var recipientcidade = button.data('whatevercidade')
        var recipientuf = button.data('whateveruf')
        var recipienttelefone = button.data('whatevertelefone')
        var recipientcelular = button.data('whatevercelular')
        var recipientcpf = button.data('whatevercpf')
        var recipientrg = button.data('whateverrg')
        var recipientnascimento = button.data('whatevernascimento')
        var recipientoperador = button.data('whateveroperador')
        var recipientsituacao = button.data('whateversituacao')
		var recipientconcluido = button.data('whateverconcluido')
        var recipientdataCadastro = button.data('whateverdata-cadastro')
        var recipientalterado_por = button.data('whateveralterado_por')
        var recipientultima_alteracao = button.data('whateverultima_alteracao')

        var modal = $(this)
        modal.find('.modal-title').text('EDITAR CLIENTE CÓDIGO: ' + recipient)
        modal.find('#id').val(recipient)
        modal.find('#recipient-nome').val(recipientnome)
		modal.find('#recipient-tecnico').val(recipienttecnico)
        modal.find('#recipient-operador').val(recipientoperador)
        modal.find('#recipient-situacao').val(recipientsituacao)
		modal.find('#recipient-concluido').val(recipientconcluido)
        modal.find('#recipient-dataCadastro').val(recipientdataCadastro)
        modal.find('#recipient-alterado_por').val(recipientalterado_por)
        modal.find('#recipient-ultima_alteracao').val(recipientultima_alteracao)

    })
</script>


<script>
    $(document).ready(function() {
        $(function() {
            //Pesquisar os cursos sem refresh na página
            $("#pesquisa_cliente").keyup(function() {

                var pesquisa_cliente = $(this).val();

                //Verificar se há algo digitado
                if (pesquisa_cliente != '') {
                    var dados = {
                        palavra: pesquisa_cliente
                    }
                    $.post('busca_clientes.php', dados, function(retorna) {
                        //Mostra dentro da ul os resultado obtidos
                        $(".resultado_cliente").html(retorna);
                    });
                } else {
                    $(".resultado_cliente").html('');
                }
            });
        });

    });
</script>

