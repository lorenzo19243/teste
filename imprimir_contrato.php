
<?php
session_start();
include('config/conexao.php');
include_once("config/seguranca.php");

$id_cliente = $_GET["id_cliente"]; 

$consulta = "SELECT * FROM instalacoes WHERE id_cliente = ".$id_cliente."";
$resultado = mysqli_query($conn, $consulta);
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$dataLocal = date('d/m/Y H:i:s', time());

// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
<!-- Meta tags Obrigatórias -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="bootstrap@4.5.3/dist/css/bootstrap.min.css" crossorigin="anonymous">    <!-- IMPORTANDO PLUGIN DO SELECT2 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js">
</script>
<script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
</head>
<style>
@media print { 
#noprint { display:none; } 
body { background: #fff; }
}
</style>
<body ng-controller="GeradorContratoCtrl">


<div class="container">
<div class="row" >
<div class="col-md-12">
    </div>

<div class="col-md-12"  id="contrato">	
    <?php  
	
    while ($linha = mysqli_fetch_assoc($resultado)) {
		$id_cliente = $linha['id_cliente'];
        $nome = $linha['nome'];
		$status = $linha['status'];
		$rua = $linha['rua'];
		$numero = $linha['numero'];
		$bairro = $linha['bairro'];
        $responsavel = $linha['criado_por'];
		$pppoe = $linha['pppoe'];
        $alterado_por = $linha['alterado_por'];
        $cpf = $linha['cpf'];
		
        // CONVERTENDO DATA/HORA PARA PADRAO PORTUGUES-BR
        $ultima_alteracao = $linha['ultima_alteracao'];
       

        // CONVERTENDO DATA/HORA PARA PADRAO PORTUGUES-BR
        $data_cadastro = $linha['data_cadastro'];
        $data_cadastro = date('d/m/Y H:i:s',  strtotime($data_cadastro));
        
        $data1 = new DateTime(''.$ultima_alteracao.'');
$data2 = new DateTime();
$interval = $data1->diff($data2);
 
    ?>
		<div  id="contrato">
			<h4 id="titulo" style="text-align:center">CONTRATO DE PRESTAÇÃO DE SERVIÇO</h4><br>
            <br>
			<p id="infoIniciais">
			<strong>COMODANTE: BRAGA TELECOMUNICAÇÕES E SERVIÇOS LTDA</strong>, com sede na 
AVENIDA TIRADENTES, 453, SÃO FRANCISCO, 47520-000, IBOTIRAMA, BAHIA, inscrita no CNPJ sob o nº 19.227.983/0002-02. <br/>
			<br/><br>

			<strong>COMODATÁRIA: <?php echo $nome ?></strong>, com residência
na <strong><?php echo $rua ?></strong> nº <strong><?php echo $numero ?></strong>, no bairro <strong><?php echo $bairro ?></strong>, inscrito no CPF sob o
nº <strong><?php echo $cpf ?></strong>.
<br>As partes acima identificadas acordam com o presente Contrato de Comodato
de Roteador, que se regerá pelas cláusulas seguintes:
DO OBJETO DO CONTRATO<br>

			<p><strong>Cláusula 1ª</strong>. A COMODANTE cede a título de empréstimo ao COMODATÁRIO, o seguinte equipamento:
            <br><br>
( ) ONU BRIDGE + ROTEADOR + SENSOR TIME<br>
( ) CAMERAS<br>
( ) TV BOX<br>
( ) ONU BRIDGE
<br>
<br>Fibra (Drop) e dois conectores APC/UPC, para seu exclusivo uso, nas condições do CONTRATO DE PRESTAÇÃO DE SERVIÇOS DE INTERNET BANDA LARGA acima mencionado, que passa a regular e integrar o presente comodato.<br></p>

			<p><strong>Cláusula 2ª</strong>. Os equipamentos, objeto deste contrato, deverão ser utilizados
somente na residência onde se encontra cadastrado no Sistema do
COMODANTE.<br> </p>
			<p><strong>Cláusula 3ª</strong>. O COMODANTE fica obrigado (a) em realizar a devida
manutenção técnica dos equipamentos após a solicitação ou reclamação feita
pelo COMODATARIO.<br></p>
			<p><strong>Cláusula 4ª</strong>. Fica obrigada a COMODATÁRIA em devolver os equipamentos
ao COMODANTE em bom estado de uso sem Avarias.<br></p>
			<p><strong>Cláusula 5ª</strong>. Os equipamentos devem ser devolvidos dentro de 48 horas após
a COMODATÁRIA solicitar o cancelamento junto do COMODANTE.<br></p>

			<p><strong>Cláusula 6ª</strong>. A COMODATÁRIA deverá pagar o valor total do equipamento, Caso
o mesmo apresente falhas ou esteja danificado impossibilitando o uso
após a devolução. <br></p>
            <p><strong>Cláusula 7ª</strong>. O contrato poderá ser rescindido por qualquer das partes, mediante aviso prévio e por escrito, com antecedência mínima de 30 (trinta) dias, sem ônus. <br></p>
   <p>
			E, por estarem assim, juntos e contratados, de pleno acordo, assinam o presente “INSTRUMENTO DE PRESTAÇÃO DE SERVIÇOS”, em 2 vias de igual teor.
			</p>

			<br>
            <br>
            <br>
            
			<p style="text-align:center">IBOTIRAMA-BA, <span class="dados"><span class="dados"><?PHP echo date('d/m/Y - H:i:s');?></span>.
			</p>
            <br>
            <br>
            <br><p style="text-align:center">__________________________________________</p>
			<p style="text-align:center">Assinatura da contratada:</p> 
            <br>

            <br>
            <p style="text-align:center">__________________________________________</p>
            <p style="text-align:center">Assinatura da contratante:</p>
		</div>
	</div>
<?php } ?>
<div class="col-md-2">
    </div>
</div>

<div class="row"> 
<div class="col-md-2">
    </div>
				<div class="col-md-8" id="noprint" >
<button type="button" class="btn btn-primary btn-block btn-lg" onclick="printDiv('contrato')" >Imprimir!</button>					
				</div>
<div class="col-md-2">
    </div>				
</div>
</div>
</body>
</html>
