<?php
session_start();
include_once('assets/cabecalho.php');
include('config/conexao.php');
include_once("config/seguranca.php");
seguranca_adm();
$consulta = "SELECT * FROM recolhas WHERE concluido = 'SIM' ORDER BY ultima_alteracao DESC ; ";
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

<div class="navbar-collapse offcanvas-collapse bg-dark" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <br>
            <br>
            <br>
            <br>
            <br>
        </ul>
      </div>
<header class="p-3 text-bg-dark">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <ul class="navbar-nav">
<li class="nav-link">
<a class="btn btn-warning position-relative btn-sm"  href="recolhas">
LISTAR <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-check" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3.854 2.146a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 3.293l1.146-1.147a.5.5 0 0 1 .708 0m0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 7.293l1.146-1.147a.5.5 0 0 1 .708 0m0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
</svg></a> <a class="btn btn-warning position-relative btn-sm"  href="recolhas_concluidas">
CONCLUIDAS <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
  <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
  <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
</svg>
</a> <button type="button" class="btn btn-warning position-relative btn-sm" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#cadCliente">AGENDAR <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-plus" viewBox="0 0 16 16">
  <path d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5"/>
  <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z"/>
</svg></button></li>
        </ul>
<div class="col-md-2 justify-content-end">        
</div>        
<div class="col-md-4 justify-content-end">
        <form class="row g-6" role="search" method="POST" action="pesquisar_recolhas.php">
          <input type="search" class="form-control" name="pesquisar" id="pesquisar" placeholder="PESQUISAR CLIENTES POR NOME" aria-label="Search"></div>
        <div class="col-md-2">
         <button type="submit" class="btn btn-warning">PESQUISAR</button> 
      </div></form>
    </div>
  </header>
<div class="table-responsive-sm">
<table class="table table-striped table-sm" style="font-size: 14px;">
    <thead class="bg-dark text text-white">
  <tr>
    <th scope="col" style="border:none"> OS.</th>
    <th scope="col" style="border:none">CLIENTE</th>
    <th scope="col" style="border:none">ENDEREÇO</th>
    <th scope="col" style="border:none">STATUS</th>
    <th scope="col" style="border:none">TECNICO</th>
    <th scope="col" style="border:none">ATENDENTE</th>
    <th scope="col" class="text text-center" colspan="4" style="border:none">AÇÕES</th>
  </tr>
</thead>
<?php
error_reporting(E_ALL ^ E_DEPRECATED);
function showReport(){
include('config/conexao.php');
    $r = mysqli_query($conn,'SELECT DISTINCT data_fim FROM recolhas WHERE concluido ="SIM"  ORDER BY data_fim DESC');
    echo '<tbody>';
	
    if($r >= null){ 
	    
        while($reg = mysqli_fetch_assoc($r)){
            echo '';
            echo ''; 			
			echo '<tr class="table-dark text text-white" style="border:none">
                <td style="border:none"></td>
                <td style="border:none"><strong> DIA ',  date('d/m/Y', strtotime($reg['data_fim'])); 
				$clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE data_fim = "'. $reg['data_fim'] .'" and concluido="SIM"');        
				$row_cnt = mysqli_num_rows($clientes);
                printf(" - %d RECOLHAS CONCLUIDAS.</strong>\n", $row_cnt);
  			
            $result = mysqli_query($conn,'SELECT * FROM recolhas WHERE data_fim = "'. $reg['data_fim'] .'" and concluido="SIM" ORDER BY ultima_alteracao DESC');
            if($result != null){
                echo '</td>
                <td style="border:none"></td>
                <td style="border:none"></td>
                <td style="border:none"></td>         

<td style="border:none"></td>
<td style="border:none"></td>
<td style="border:none"></td>
<td style="border:none"></td>
<td style="border:none"></td>
<td style="border:none"></td>


                </td>

            </tr>' ;?>
<?php
    while ($linha = mysqli_fetch_assoc($result)) {
        $id_cliente = $linha['id_cliente'];
        $nome = $linha['nome'];
		$status = $linha['status'];
		$rua = $linha['rua'];
		$numero = $linha['numero'];
		$bairro = $linha['bairro'];
		$tecnico = $linha['tecnico'];
		$veiculo = $linha['veiculo'];
        $responsavel = $linha['criado_por'];
		$observacao = $linha['observacao'];
        $alterado_por = $linha['alterado_por'];
		$agendado = $linha['agendado'];
		$conclusao = $linha['conclusao'];
		$roteador_entrada = $linha['roteador_entrada'];
	    $onu_entrada = $linha['onu_entrada'];
    	$timer_entrada = $linha['timer_entrada'];
		$cabo_drop = $linha['cabo_drop'];
        $cabo_utp = $linha['cabo_utp'];
        $conector = $linha['conector'];
        $esticador = $linha['esticador'];
		
        // CONVERTENDO DATA/HORA PARA PADRAO PORTUGUES-BR
        $ultima_alteracao = $linha['ultima_alteracao'];


        // CONVERTENDO DATA/HORA PARA PADRAO PORTUGUES-BR
        $data_cadastro = $linha['data_cadastro'];
        $data_cadastro = date('d/m/y H:i',  strtotime($data_cadastro));
        
                $data1 = new DateTime(''.$ultima_alteracao.'');
$data2 = new DateTime();
$interval = $data1->diff($data2);

    ?>
					
             <tr>
                <td style="text-align: center; vertical-align: middle;"><?php echo $id_cliente ?></td>
                <td ><span style="font-weight: bold;"><?php echo $nome ?> </span><br>BAIRRO - <?php echo $bairro ?> <a href="https://app.xgstelecom.com.br/os/recolhas.php?id=<?php echo $linha['id_cliente']; ?>"  target="_blank" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe-americas" viewBox="0 0 16 16">
  <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0M2.04 4.326c.325 1.329 2.532 2.54 3.717 3.19.48.263.793.434.743.484q-.121.12-.242.234c-.416.396-.787.749-.758 1.266.035.634.618.824 1.214 1.017.577.188 1.168.38 1.286.983.082.417-.075.988-.22 1.52-.215.782-.406 1.48.22 1.48 1.5-.5 3.798-3.186 4-5 .138-1.243-2-2-3.5-2.5-.478-.16-.755.081-.99.284-.172.15-.322.279-.51.216-.445-.148-2.5-2-1.5-2.5.78-.39.952-.171 1.227.182.078.099.163.208.273.318.609.304.662-.132.723-.633.039-.322.081-.671.277-.867.434-.434 1.265-.791 2.028-1.12.712-.306 1.365-.587 1.579-.88A7 7 0 1 1 2.04 4.327Z"/>
</svg></a></td>
                  <td><?php echo $rua = mb_strtoupper($rua); ?>, Nº <?php echo $numero ?></br><?php echo $bairro ?> <?php
$observacao = $observacao;
$id_cliente = $id_cliente;

if ($observacao >= '0') {
    $os = "<button type='button' class='badge rounded-pill text-bg-warning text-light border-0' data-toggle='modal' data-target='#modal$id_cliente'>
OBS!
</button>";
} else {
    $os = "";
}
echo $os;

?></td>

                <td style="text-align: center; vertical-align: middle;">
                    <?php
$status = $status;

if ($status == "REATIVOU")
{
$x = '<span class="badge text-bg-success rounded-pill p-2">REATIVOU</span>';
}
else
{
$x = "";
}

echo $x;
?>
<?php
$status = $status;

if ($status == "CONCLUIDO")
{
$x = '<span class="badge text-bg-success rounded-pill p-2">CONCLUIDO</span>';
}
else
{
$x = "";
}

echo $x;
?>
                <?php
$status = $status;

if ($status == "<button type='button' class='btn btn-success btn-sm' >concluido</button>")
{
$x = '<span class="badge text-bg-success rounded-pill p-2">CONCLUIDO</span>';
}
else
{
$x = "";
}

echo $x;
?><?php
$status = $status;

if ($status == 'A LANÇAR')
{
$x = '<span class="badge text-bg-secondary rounded-pill p-2">A LANÇAR</span>';
}
else
{
$x = "";
}

echo $x;
?><?php
$status = $status;

if ($status == 'ANDAMENTO')
{
$x = '<span class="badge text-bg-primary rounded-pill p-2">ANDAMENTO</span>';
}
else
{
$x = "";
}

echo $x;
?><?php
$status = $status;

if ($status == 'REMARCAR')
{
$x = '<span class="badge text-bg-danger rounded-pill p-2">REMARCAR</span>';
}
else
{
$x = "";
}

echo $x;
?>
<?php
$status = $status;

if ($status == 'DROP')
{
$x = '<span class="badge text-bg-warning text-light rounded-pill p-2">FALTA_DROP</span>';
}
else
{
$x = "";
}

echo $x;
?></td>          
                <td ><?php
$tecnico = $tecnico;

if ($tecnico >= '0')
{
$x = "$tecnico";
}
else
{
$x = "CHAMADO SEM LANÇAR";
}

echo $x;
?><br>
<?php
$veiculo = $veiculo;

if ($veiculo == '')
{
$y = "";
}
else
{
$y = "VEICULO: <span class=\"badge text-bg-dark rounded-pill p-1\">$veiculo</span>";
}

echo $y;
?><?php
$conclusao = $conclusao;
$id_cliente = $id_cliente;

if ($conclusao >= '0')
{
$x = "<a href=\"#\" class=\"position-relative py-2 px-4 rounded-pill\"  data-toggle='modal' data-target='#modala$id_cliente'><svg  xmlns=\"http://www.w3.org/2000/svg\"  width=\"24\"  height=\"24\"  viewBox=\"0 0 24 24\"  fill=\"none\"  stroke=\"currentColor\"  stroke-width=\"2\"  stroke-linecap=\"round\"  stroke-linejoin=\"round\"  class=\"icon icon-tabler icons-tabler-outline icon-tabler-message-user\"><path stroke=\"none\" d=\"M0 0h24v24H0z\" fill=\"none\"/><path d=\"M13 18l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4.5\" /><path d=\"M19 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0\" /><path d=\"M22 22a2 2 0 0 0 -2 -2h-2a2 2 0 0 0 -2 2\" /></svg></a>";
}
else
{
$x = "";
}

echo $x;
?>
 <div class="modal fade" id="modala<?php echo $id_cliente ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"></h5>
                </div>
                <div class="modal-body">
                  <?php
$conclusao = mb_strtoupper($conclusao);

if ($conclusao >= 0)
{
$x = "$conclusao";
}
else
{
$x = "";
}

echo $x;
?>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
              </div>
            </div>
          </div></td>
                <td><?php echo  $alterado_por?><br><span class="badge text-bg-info rounded-pill p-2"><?php echo date('d/m/y H:i',  strtotime($ultima_alteracao)); ?></span></td>
                <td style="vertical-align: middle;">
<a href="#" class="accordion-button"  data-toggle='modal' data-target='#verbaixa<?php echo $id_cliente ?>'><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye-search"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M12 18c-.328 0 -.652 -.017 -.97 -.05c-3.172 -.332 -5.85 -2.315 -8.03 -5.95c2.4 -4 5.4 -6 9 -6c3.465 0 6.374 1.853 8.727 5.558" /><path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M20.2 20.2l1.8 1.8" /></svg></a>            
<div class="modal fade" id="verbaixa<?php echo $id_cliente ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">ORDEM DE SERVIÇO Nº <?php echo $id_cliente ?>  <strong><?php
$status = $status;

if ($status == 'A LANÇAR')
{
$x = '<span class="badge text-bg-secondary rounded-pill p-2">A LANÇAR</span>';
}
else
{
$x = "";
}

echo $x;
?><?php
$status = $status;

if ($status == 'ANDAMENTO')
{
$x = '<span class="badge text-bg-primary rounded-pill p-2">ANDAMENTO</span>';
}
else
{
$x = "";
}

echo $x;
?><?php
$status = $status;

if ($status == 'REMARCAR')
{
$x = '<span class="badge text-bg-danger rounded-pill p-2">REMARCAR</span>';
}
else
{
$x = "";
}

echo $x;
?></strong></h5>
                </div>
                <div class="modal-body"></strong>
<strong>TÉCNICO RESPONSAVEL:</strong> <?php
$tecnico = $tecnico;

if ($tecnico >= '0')
{
$x = "$tecnico";
}
else
{
$x = "CHAMADO SEM LANÇAR";
}

echo $x;
?> <br>
<strong>VEÍCULO:</strong> <?php echo $veiculo ?> <br>

<strong>CLIENTE:</strong> <?php echo $nome ?> <br>
<strong>RUA:</strong> <?php echo $rua ?> - Nº <?php echo $rua ?> <br>
<strong>BAIRRO:</strong> <?php echo $bairro ?> <br>

<strong>EQUIPAMENTOS RECOLHIDOS:</strong><br>
<?php
$roteador_entrada = $roteador_entrada;

if ($roteador_entrada == 0)
{
$b = "";
}
else
{
$b = "$roteador_entrada</br>";
}

echo $b;
?>
<?php
$onu_entrada = $onu_entrada;

if ($onu_entrada == 0)
{
$c = "";
}
else
{
$c = "$onu_entrada</br>";
}

echo $c;
?>
<?php
$timer_entrada = $timer_entrada;

if ($timer_entrada == 0)
{
$d = "";
}
else
{
$d = "$timer_entrada</br>";
}

echo $d;
?>
<?php
$cabo_utp = $cabo_utp;

if ($cabo_utp == 0)
{
$e = "";
}
else
{
$e = "$cabo_utp CABO UTP</br>";
}

echo $e;
?>
<?php
$cabo_drop = $cabo_drop;

if ($cabo_drop == 0)
{
$f = "";
}
else
{
$f = "$cabo_drop METROS DE CABO DROP</br>";
}

echo $f;
?>
<?php
$esticador = $esticador;

if ($esticador == 0)
{
$g = "";
}
else
{
$g = "$esticador ESTICADORES</br>";
}

echo $g;
?>
<?php
$conector = $conector;

if ($conector == 0)
{
$h = "";
}
else
{
$h = "$conector CONECTORES</br>";
}

echo $h;
?> 
<strong>CADASTRADO POR:</strong> <?php echo $responsavel ?> - <?php echo $data_cadastro ?> <br>
<strong>ALTERADO POR:</strong> <?php echo $alterado_por ?> - <?php echo $ultima_alteracao = date('d/m/y H:i',  strtotime($ultima_alteracao));?> <br>


                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
              </div>
            </div>
          </div> 
                   
                </td>

                <td style="vertical-align: middle;">
                    <a class="accordion-button"  href="#" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#editarCliente" data-whatever="<?php echo $linha['id_cliente']; ?>" 
data-whatevernome="<?php echo $linha['nome']; ?>"
data-whateverconclusao="<?php echo $linha['conclusao']; ?>"
data-whateveroperador="<?php echo $linha['criado_por']; ?>" 
data-whateverstatus="" 
data-whatevertecnico="<?php echo $linha['tecnico']; ?>" 
data-whateverveiculo="<?php echo $linha['veiculo']; ?>" 
data-whateverplano="<?php echo $linha['plano']; ?>" 
data-whateverdata-cadastro="<?php echo $data_cadastro ?>" 
data-whateveralterado_por="<?php echo $alterado_por; ?>" 
data-whatevertempo="<?php echo $interval->format('%H:%I'); ?>"
data-whateverultima_alteracao="<?php echo $ultima_alteracao = date('d/m/Y H:i:s',  strtotime($ultima_alteracao));?>">
<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg></a>

<?php 
                        if($_SESSION['perfil_cod'] == 1){
                    ?>
<td style="vertical-align: middle;">
                    <a href="processa_excluir_recolhas.php?id_cliente=<?php echo $linha['id_cliente']; ?>&nome=<?php echo $linha['nome']; ?>" onClick="return confirm('Deseja realmente deletar o agendamento de <?php echo $linha['nome']; ?>?')" class="accordion-button"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a> </td><?php } ?>



                </td>
<td style="vertical-align: middle;">
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>                        
<script type="text/javascript">
const clipboard = new ClipboardJS('.copy')

clipboard.on('success', function(e) {
    alert("CHAMADO COPIADO")
});

clipboard.on('error', function(e) {
    alert("Falha ao copiar texto")
});
</script>


<button type="button" class="copy border border-0" data-clipboard-text="



*ORDEM DE SERVIÇO Nº  <?php echo $linha['id_cliente']; ?>* 

*STATUS:* RECOLHA CONCLUIDA  
*TÉCNICO:* <?php echo $linha['tecnico']; ?> 
*VEÍCULO:* <?php echo $linha['veiculo']; ?> 

*CLIENTE:* <?php echo $linha['nome']; ?> 

*EQUIPAMENTOS RECOLHIDOS:* 
<?php
$roteador_entrada = $roteador_entrada;

if ($roteador_entrada == 0)
{
$b = "";
}
else
{
$b = "$roteador_entrada\n";
}

echo $b;
?>
<?php
$onu_entrada = $onu_entrada;

if ($onu_entrada == 0)
{
$c = "";
}
else
{
$c = "$onu_entrada\n";
}

echo $c;
?>
<?php
$timer_entrada = $timer_entrada;

if ($timer_entrada == 0)
{
$d = "";
}
else
{
$d = "$timer_entrada\n";
}

echo $d;
?>
<?php
$cabo_utp = $cabo_utp;

if ($cabo_utp == 0)
{
$e = "";
}
else
{
$e = "$cabo_utp CABO UTP\n";
}

echo $e;
?>
<?php
$cabo_drop = $cabo_drop;

if ($cabo_drop == 0)
{
$f = "";
}
else
{
$f = "$cabo_drop METROS DE CABO DROP\n";
}

echo $f;
?>
<?php
$esticador = $esticador;

if ($esticador == 0)
{
$g = "";
}
else
{
$g = "$esticador ESTICADORES\n";
}

echo $g;
?>
<?php
$conector = $conector;

if ($conector == 0)
{
$h = "";
}
else
{
$h = "$conector CONECTORES\n";
}

echo $h;
?> 

*CONCLUIDO:* <?php echo date('d/m/y - H:i', strtotime($linha['ultima_alteracao']))?> 
*TEMPO DE CHAMADO:* <?php echo $linha['tempo']; ?> 

*BAIXA POR:*  <?php echo $_SESSION['usuarioNome']; ?> 

*EQUIPAMENTOS RECOLHIDOS COM SUCESSO✅*">
<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-folders"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 2a1 1 0 0 1 .707 .293l1.708 1.707h4.585a3 3 0 0 1 2.995 2.824l.005 .176v7a3 3 0 0 1 -3 3h-1v1a3 3 0 0 1 -3 3h-10a3 3 0 0 1 -3 -3v-9a3 3 0 0 1 3 -3h1v-1a3 3 0 0 1 3 -3zm-6 6h-1a1 1 0 0 0 -1 1v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1 -1v-1h-7a3 3 0 0 1 -3 -3z" /></svg></button></td>
<?php
                }
                echo '';
            }
            echo '</tbody>';
            echo '';
        }
    }else{
        echo '<tr><td>Não existe pedido na tabela de compras</td></tr>';
    }
    echo '</table>';
;
}

showReport();
?>
</div>
<?php
include_once('assets/rodape.php');
?>
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

<!-- Modal ALERTA DE CADASTRO COM SUCESSO-->
<div class="modal fade" id="sucessModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
      </div>
      <div class="modal-body bg-success text text-center text-white"> CLIENTE CADASTRADO COM SUCESSO! </div>
      <div class="modal-footer"> </div>
    </div>
  </div>
</div>
<!-- Modal ALERTA DE CADASTRO NAO REALIZADO-->
<div class="modal fade" id="dangerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
      </div>
      <div class="modal-body bg-danger text text-center text-white"> CLIENTE NÃO CADASTRADO! </div>
      <div class="modal-footer"> </div>
    </div>
  </div>
</div>
<!-- ==================================================MODAL CADASTRO DE CLIENTE ==================================== -->
<div class="modal fade" id="cadCliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header ">
        <h5 class="modal-title" id="exampleModalLabel">AGENDAR RECOLHA!</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <!-- ALERTA PARA ERRO DE PREENCHIMENTO DE FORMULARIO -->
      <div class="alert alert-danger d-none fade show m-3" role="alert"> <strong>ERRO!</strong> - <strong>Preencha o campo <span id="campo-erro"></span></strong>! <span id="msg"></span> </div>
      <div class="modal-body">
      <div class="row g-5">
      <div class="col-sm-6">
  <div class="input-group">
   <div class="input-group-text">ID LOGIN:</div>
    <input type="text" class="form-control" name="logins" id="logins">
  </div>
</div>
      <div class="col-sm">
        <button class="btn btn-primary mb-3" onClick="processa_rec()">PESQUISA</button>
</div>
<div id="modal-body"> </div>
    </div>
  </div>
</div>
</div>
</div>


<!-- -----------------------------------MODAL VISUALIZAR CLIENTE----------------------------------------------------------------->
<div class="modal fade" id="visulaizarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <label for="recipient-nome" class="col-form-label">NOME</label>
                            <input type="text" class="form-control" id="recipient-nome" disabled>
                        </div>
                                                <div class="col-md-10 col-sm-12">
                            <label for="recipient-tecnico" class="col-form-label">TECNICO</label>
                            <input type="text" name="tecnico" id="recipient-tecnico" maxlength="50" class="form-control" disabled>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <label for="recipient-veiculo" class="col-form-label">VEICULO</label>
                            <input type="text" name="veiculo" id="recipient-veiculo" maxlength="50" class="form-control -10" disabled>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-12 col-sm-12">
                            <label for="recipient-conclusao" class="col-form-label">CONCLUSAO</label>
                            <textarea class="form-control" name="conclusao" id="recipient-conclusao"  aria-label="With textarea"disabled style="height: 159px;"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5 col-sm-12">
                            <label for="recipient-bairro" class="col-form-label">BAIRRO</label>
                            <input type="text" name="bairro" id="recipient-bairro" maxlength="50" class="form-control" disabled>
                        </div>
                        <div class="col-md-5 col-sm-12">
                            <label for="recipient-rua" class="col-form-label">RUA</label>
                            <input type="text" name="rua" id="recipient-rua" maxlength="50" class="form-control -10" disabled>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <label for="recipient-numero" class="col-form-label">NUMERO</label>
                            <input type="text" name="numero" id="recipient-numero" maxlength="50" class="form-control" disabled>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <label for="recipient-alterado_por" class="col-form-label cli">ENCERRADO POR</label>
                            <input type="text" name="alterado_por" id="recipient-alterado_por" maxlength="50" class="form-control" disabled>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label for="recipient-ultima_alteracao" class="col-form-label">ÚLTIMA ALTERAÇÃO</label>
                            <input type="text" class="form-control" name="ultima_alteracao" id="recipient-ultima_alteracao" disabled>
                        </div>
                                   <div class="col-md-4 col-sm-12">
            <label for="recipient-status" class="col-form-label">STATUS</label>
            
            <button type="button" class="btn btn-success btn-sm form-control">CONCLUIDO</button>
          </div>
        </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>

            </div>
            </form>


        </div>
    </div>
</div>
<!-- -----------------------------------SCRIPT MODAL VISUALIZAR CLIENTE-----------------------------------------------------------------> 
<script type="text/javascript">
    $('#visulaizarCliente').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Botão que acionou o modal
        var recipient = button.data('whatever')
        var recipientnome = button.data('whatevernome')
        var recipientsituacao = button.data('whateversituacao')
		var recipientatendente = button.data('whateveratendente')
		var recipientstatus = button.data('whateverstatus')
			var recipientplano = button.data('whateverplano')
		var recipientrua = button.data('whateverrua')
		var recipientbairro = button.data('whateverbairro')
		var recipientnumero = button.data('whatevernumero')
		var recipienttecnico = button.data('whatevertecnico')
		var recipientveiculo = button.data('whateverveiculo')
        var recipientoperador = button.data('whateveroperador')
        var recipientsituacao = button.data('whateversituacao')
		var recipientconclusao = button.data('whateverconclusao')
        var recipientdataCadastro = button.data('whateverdata-cadastro')
        var recipientalterado_por = button.data('whateveralterado_por')
        var recipientultima_alteracao = button.data('whateverultima_alteracao')

        var modal = $(this)
        modal.find('.modal-title').text('ORDEM DE SERVIÇO Nº' + recipient)
        modal.find('#id').val(recipient)
        modal.find('#recipient-nome').val(recipientnome)
		modal.find('#recipient-situacao').val(recipientsituacao)
		modal.find('#recipient-atendente').val(recipientatendente)
		modal.find('#recipient-status').val(recipientstatus)
		modal.find('#recipient-plano').val(recipientplano)
		modal.find('#recipient-rua').val(recipientrua)
		modal.find('#recipient-bairro').val(recipientbairro)
		modal.find('#recipient-numero').val(recipientnumero)
		modal.find('#recipient-tecnico').val(recipienttecnico)
		modal.find('#recipient-veiculo').val(recipientveiculo)
		modal.find('#recipient-operador').val(recipientoperador)
		modal.find('#recipient-conclusao').val(recipientconclusao)
        modal.find('#recipient-dataCadastro').val(recipientdataCadastro)
        modal.find('#recipient-alterado_por').val(recipientalterado_por)
        modal.find('#recipient-ultima_alteracao').val(recipientultima_alteracao)

    })
</script> 

<!-- -----------------------------------MODAL EDITAR CLIENTE----------------------------------------------------------------->

<div class="modal fade" id="editarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">New message</h5>
      <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      <form method="POST" action="processa_edit_recolhas.php" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-10 col-sm-12">
            <label for="recipient-tecnico" class="col-form-label">TECNICOS</label>
            <input type="text" name="tecnico" id="recipient-tecnico" maxlength="50" class="form-control">
          </div>
          <div class="col-md-2 col-sm-12">
            <label for="recipient-veiculo" class="col-form-label">VEICULO</label>
            <select class="form-control form-select" name="veiculo" id="veiculo" aria-label=".form-select-lg example">
              <option value="01">01</option>
              <option value="02">02</option>
              <option value="03">03</option>
              <option value="04">04</option>
              <option value="05">05</option>
              <option value="06">06</option>
              <option value="07">07</option>
              <option value="08">08</option>
              <option value="09">09</option>
              <option value="S10">S10</option>
              <option value="YBR">YBR</option>
              <option value="BIZ">BIZ</option>
              <option value="POP">POP</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 col-sm-12">
            <label for="recipient-operador" class="col-form-label cli">Cadastrado por</label>
            <input type="text" name="operador" id="recipient-operador" maxlength="50" class="form-control" disabled>
          </div>
          <div class="col-md-4 col-sm-12">
            <label for="recipient-dataCadastro" class="col-form-label">Data do cadastro</label>
            <input type="text" class="form-control" id="recipient-dataCadastro" disabled>
          </div>
          <div class="col-md-4 col-sm-12">
            <label for="recipient-status" class="col-form-label">Situação</label>
            <select class="form-control form-select" name="status" id="status" aria-label=".form-select-lg example">
              <option value="EM ANDAMENTO">EM ANDAMENTO</option>
              <option value="REMARCAR">REMARCAR</option>
              <option value="CONCLUIDO">CONCLUIDO</option>
              <option value="DROP">FALTA O DROP</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 col-sm-12">
            <label for="recipient-operador" class="col-form-label cli">Alterado por</label>
            <input type="text" name="alterado_por" id="recipient-alterado_por" maxlength="50" class="form-control" disabled value="<?php echo $_SESSION['usuarioNome'] ?>">
          </div>
          <div class="col-md-4 col-sm-12">
            <label for="recipient-ultima_alteracao" class="col-form-label">Última Alteração</label>
            <input type="text" class="form-control" name="ultima_alteracao" id="recipient-ultima_alteracao" value="<?php echo date('d/m/Y - H:i:s') ?>" disabled>
          </div>
          <div class="col-md-4 col-sm-12">
            <label for="recipient-concluido" class="col-form-label">CONCLUIDO</label>
            <select class="form-control form-select" name="concluido" id="concluido" aria-label=".form-select-lg example">
              <option value="NAO">NAO</option>
              <option value="SIM">SIM</option>
            </select>
          </div>
          </div>
          <input type="hidden" name="id" class="form-control" id="id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </div>
      </form>
    </div>
  </div>
</div>
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
        modal.find('.modal-title').text('EDITAR ORDEM DE SERVIÇO Nº' + recipient)
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script> 
<script type="text/javascript">
const clipboard = new ClipboardJS('.copy')

clipboard.on('success', function(e) {
    alert("BAIXA COPIADA")
});

clipboard.on('error', function(e) {
    alert("Falha ao copiar texto")
});
</script> 
<script>
function processa_rec() {
    var cliente = document.getElementById("cliente").value;
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("modal-body").innerHTML = this.responseText;
    }
    xhttp.open("GET", "processa_recolhas.php?cliente="+cliente);
    xhttp.send();    
}      
</script>
