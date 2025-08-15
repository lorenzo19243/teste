<?php
session_start();
include_once('assets/cabecalho.php');
include('config/conexao.php');
include_once("config/seguranca.php");
seguranca_adm();
$pesquisar = $_POST['pesquisar'];
$busca = "SELECT * FROM clientes WHERE nome LIKE '%$pesquisar%' OR bairro LIKE '%$pesquisar%' ORDER BY concluido='NAO' DESC";
$resultado = mysqli_query($conn, $busca);
?>

<?php include_once('assets/menu.php'); ?>
<div class="navbar-collapse offcanvas-collapse bg-dark" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <br>
            <br>
            <br>
            <br>
            <br>
        </ul>
      </div>


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

<header class="p-3 text-bg-dark">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-6 justify-content-center mb-md-0">
        <li class="nav-link">
<a class="btn btn-warning position-relative btn-sm"  href="reparos">CHAMADOS <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-check" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3.854 2.146a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 3.293l1.146-1.147a.5.5 0 0 1 .708 0m0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 7.293l1.146-1.147a.5.5 0 0 1 .708 0m0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
</svg></a></li> <li class="nav-link"><a class="btn btn-warning position-relative btn-sm"  href="reparos_concluidos">CONCLUIDOS <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
  <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
  <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
</svg></a></li>
      <li class="nav-link"><button type="button" class="btn btn-warning position-relative btn-sm" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#cadCliente">NOVO CHAMADO <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-plus" viewBox="0 0 16 16">
  <path d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5"/>
  <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z"/>
</svg></button></li>
        </ul>
        
<div class="col-md-4 justify-content-between p-3">
        <form class="row g-5" method="POST" action="pesquisar_reparos.php">
          <input type="search" class="form-control" name="pesquisar" id="pesquisar" placeholder="PESQUISAR CLIENTES POR NOME" aria-label="Search"></div>
        <div class="col-md-2">
         <button type="submit" class="btn btn-warning">PESQUISAR</button> 
      </div></form>
    </div>
  </header>

<div class="table-responsive-sm">

    <?php
$contar = mysqli_num_rows($resultado);

if ($contar == 0)
{
echo "<div class='alert alert-success alert-dismissible fade show text text-center mb-0' role='alert'>
                                
                                <strong> NENHUM AGENDAMENTO NO MOMENTO!  </strong> 
                                    
                                
                        </div>";
}
else
{
echo '<table class="table table-striped table-sm" style="font-size: 14px;" align="center">
    <thead class="bg-dark text text-white">
      <tr>
        <th scope="col" style="border:none"><div class="fs-6 badge d-flex text-light-emphasis bg-light-subtle"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ui-checks" viewBox="0 0 16 16">
  <path d="M7 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zM2 1a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm0 8a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2zm.854-3.646a.5.5 0 0 1-.708 0l-1-1a.5.5 0 1 1 .708-.708l.646.647 1.646-1.647a.5.5 0 1 1 .708.708zm0 8a.5.5 0 0 1-.708 0l-1-1a.5.5 0 0 1 .708-.708l.646.647 1.646-1.647a.5.5 0 0 1 .708.708zM7 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
</svg></div></th>
        <th scope="col" style="border:none" ><div class="fs-6 badge d-flex text-light-emphasis bg-light-subtle"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
  <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z"/>
</svg><span class="vr mx-2"> </span>CLIENTE
              </div></th>
        <th scope="col" style="border:none" ><div class="fs-6 badge d-flex text-light-emphasis bg-light-subtle"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-octagon-fill" viewBox="0 0 16 16">
  <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
</svg><span class="vr mx-2"> </span>SITUAÇÃO </div></th>
        <th scope="col" style="border:none" align="center"><div class="fs-6 badge d-flex text-light-emphasis bg-light-subtle"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-week-fill" viewBox="0 0 16 16">
  <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2M9.5 7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m3 0h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5M2 10.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5"/>
</svg><span class="vr mx-2"> </span>PARA DIA
</div></th>
        <th scope="col" style="border:none" ><div class="fs-6 badge d-flex text-light-emphasis bg-light-subtle"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-strava" viewBox="0 0 16 16">
  <path d="M6.731 0 2 9.125h2.788L6.73 5.497l1.93 3.628h2.766zm4.694 9.125-1.372 2.756L8.66 9.125H6.547L10.053 16l3.484-6.875z"/>
</svg><span class="vr mx-2"> </span>STATUS </div></th>
        <th scope="col" style="border:none" ><div class="fs-6 badge d-flex text-light-emphasis bg-light-subtle"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wrench-adjustable-circle-fill" viewBox="0 0 16 16">
  <path d="M6.705 8.139a.25.25 0 0 0-.288-.376l-1.5.5.159.474.808-.27-.595.894a.25.25 0 0 0 .287.376l.808-.27-.595.894a.25.25 0 0 0 .287.376l1.5-.5-.159-.474-.808.27.596-.894a.25.25 0 0 0-.288-.376l-.808.27z"/>
  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m-6.202-4.751 1.988-1.657a4.5 4.5 0 0 1 7.537-4.623L7.497 6.5l1 2.5 1.333 3.11c-.56.251-1.18.39-1.833.39a4.5 4.5 0 0 1-1.592-.29L4.747 14.2a7.03 7.03 0 0 1-2.949-2.951M12.496 8a4.5 4.5 0 0 1-1.703 3.526L9.497 8.5l2.959-1.11q.04.3.04.61"/>
</svg><span class="vr mx-2"> </span>TECNICO </div></th>
        <th scope="col" style="border:none" ></th>
        <th scope="col" style="border:none" ><div class="fs-6 badge d-flex text-light-emphasis bg-light-subtle"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-headset" viewBox="0 0 16 16">
  <path d="M8 1a5 5 0 0 0-5 5v1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a6 6 0 1 1 12 0v6a2.5 2.5 0 0 1-2.5 2.5H9.366a1 1 0 0 1-.866.5h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 .866.5H11.5A1.5 1.5 0 0 0 13 12h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1V6a5 5 0 0 0-5-5"/>
</svg><span class="vr mx-2"> </span>ATENDENTE </div></th>
        <th scope="col" class="text text-center" colspan="4" style="border:none" width="4%"><div class="fs-6 badge d-flex text-light-emphasis bg-light-subtle"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ui-checks-grid" viewBox="0 0 16 16">
  <path d="M2 10h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1m9-9h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-3a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1m0 9a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1zm0-10a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM2 9a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2zm7 2a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-3a2 2 0 0 1-2-2zM0 2a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm5.354.854a.5.5 0 1 0-.708-.708L3 3.793l-.646-.647a.5.5 0 1 0-.708.708l1 1a.5.5 0 0 0 .708 0z"/>
</svg><span class="vr mx-2"> </span>AÇÕES </div></th>
      </tr>
    </thead>';
}


?>
     <tbody> 
   <?php 
    while ($linha = mysqli_fetch_assoc($resultado)) {
        $id_cliente = $linha['id_cliente'];
        $nome = $linha['nome'];
		$atendente = $linha['atendente'];
		$status = $linha['status'];
		$rua = $linha['rua'];
		$numero = $linha['numero'];
		$bairro = $linha['bairro'];
		$tecnico = $linha['tecnico'];
		$veiculo = $linha['veiculo'];
        $responsavel = $linha['criado_por'];
        $situacao = $linha['situacao'];
		$observacao = $linha['observacao'];
		$conclusao = $linha['conclusao'];
		$rede = $linha['rede'];
		$redesenha = $linha['redesenha'];
		$sinal = $linha['sinal'];
		$pppoe = $linha['pppoe'];
		$plano = $linha['plano'];
		$remoto = $linha['remoto'];
		$repetidor = $linha['repetidor'];
        $alterado_por = $linha['alterado_por'];
        $agendado = $linha['agendado'];
        $onu = $linha['onu'];
        $urgente = $linha['urgente'];
        $longitude = $linha['longitude'];
		$latitude = $linha['latitude'];
		$tempo = $linha['tempo'];
		
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
        <td ><span style="font-weight: bold;"><?php echo $nome ?> </span><br>BAIRRO - <?php echo $bairro ?> <a href="https://app.xgstelecom.com.br/os/reparos.php?id=<?php echo $linha['id_cliente']; ?>"  target="_blank" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe-americas" viewBox="0 0 16 16">
  <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0M2.04 4.326c.325 1.329 2.532 2.54 3.717 3.19.48.263.793.434.743.484q-.121.12-.242.234c-.416.396-.787.749-.758 1.266.035.634.618.824 1.214 1.017.577.188 1.168.38 1.286.983.082.417-.075.988-.22 1.52-.215.782-.406 1.48.22 1.48 1.5-.5 3.798-3.186 4-5 .138-1.243-2-2-3.5-2.5-.478-.16-.755.081-.99.284-.172.15-.322.279-.51.216-.445-.148-2.5-2-1.5-2.5.78-.39.952-.171 1.227.182.078.099.163.208.273.318.609.304.662-.132.723-.633.039-.322.081-.671.277-.867.434-.434 1.265-.791 2.028-1.12.712-.306 1.365-.587 1.579-.88A7 7 0 1 1 2.04 4.327Z"/>
</svg></a> </td>
        <td ><?php echo $situacao ?><br>
<?php
$observacao = $observacao;
$id_cliente = $id_cliente;

if ($observacao >= '0') {
    $os = "<button type='button' class='badge text-bg-warning text-light rounded-pill p-1 border-0' data-toggle='modal' data-target='#modal$id_cliente'>
OBS!
</button>";
} else {
    $os = "";
}
echo $os;

?> 
<?php
$sinal = $sinal;

if ($sinal >= 'RX: 0.00 | TX: 0.00')
{
$x = '<span class="badge text-bg-danger rounded-pill p-1">ONU OFF</span>';
}
else
{
$x = '<span class="badge text-bg-success rounded-pill p-1">'.$sinal.'</span>';
}

echo $x;
?>
</td>   <td style="text-align: center; vertical-align: middle;"><h5><span class="badge text-bg-secondary  rounded-pill p-1"><?php echo date('d/m/y',  strtotime($agendado));?></span><br><span class="badge text-primary-emphasis bg-primary-subtle rounded-pill p-1">ÁS <?php echo date('H:i',  strtotime($agendado));?></span></h5></td>
        <td style="text-align: center; vertical-align: middle;" ><?php
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
?></td>
        <td><?php
$tecnico = $tecnico;

if ($tecnico >= '0')
{
$x = "$tecnico";
}
else
{
$x = "CHAMADO A LANÇAR";
}

echo $x;
?><br><?php
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
$x = "<a href=\"#\" class=\"position-relative py-2 px-1 rounded-pill\"  data-toggle='modal' data-target='#modala$id_cliente'><svg  xmlns=\"http://www.w3.org/2000/svg\"  width=\"24\"  height=\"24\"  viewBox=\"0 0 24 24\"  fill=\"none\"  stroke=\"currentColor\"  stroke-width=\"2\"  stroke-linecap=\"round\"  stroke-linejoin=\"round\"  class=\"icon icon-tabler icons-tabler-outline icon-tabler-message-user\"><path stroke=\"none\" d=\"M0 0h24v24H0z\" fill=\"none\"/><path d=\"M13 18l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4.5\" /><path d=\"M19 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0\" /><path d=\"M22 22a2 2 0 0 0 -2 -2h-2a2 2 0 0 0 -2 2\" /></svg></a>";
}
else
{
$x = "";
}

echo $x;
?> 
<td></td>

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
        <td ><?php echo $responsavel?><br><span class="badge text-bg-info rounded-pill p-2"><?php echo $data_cadastro ?></span></td>
        <td style="vertical-align: middle;">
           <a href="#" class="accordion-button"  data-toggle='modal' data-target='#verbaixa<?php echo $id_cliente ?>'><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye-search"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M12 18c-.328 0 -.652 -.017 -.97 -.05c-3.172 -.332 -5.85 -2.315 -8.03 -5.95c2.4 -4 5.4 -6 9 -6c3.465 0 6.374 1.853 8.727 5.558" /><path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M20.2 20.2l1.8 1.8" /></svg></a>            
<div class="modal fade" id="verbaixa<?php echo $id_cliente ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">ORDEM DE SERVIÇO Nº <?php echo $id_cliente ?>  <strong>
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
<strong>PPPOE:</strong> <?php echo $pppoe ?> <br>
<strong>REDE:</strong> <?php echo $rede ?> <br>
<strong>SENHA:</strong> <?php echo $redesenha ?> <br>
<strong>PLANO:</strong> <?php echo $plano ?> <br>
<strong>OBS:</strong> <?php echo $observacao ?> <br>
<strong>SINAL IXC:</strong> <?php
$sinal = $sinal;

if ($sinal >= 'RX: 0.00 | TX: 0.00')
{
$x = '<span class="badge text-bg-danger rounded-pill p-1">ONU OFF</span>';
}
else
{
$x = '<span class="badge text-bg-success rounded-pill p-1">'.$sinal.'</span>';
}

echo $x;
?> <br>

<strong>SITUAÇÃO:</strong> <?php echo $conclusao = mb_strtoupper($conclusao) ?> <br>
<strong>TEMPO DE CHAMADO:</strong> <?php $interval = $data1->diff($data2);
		      
			  echo $interval->format('%H:%I');
		 ?> <br>
<strong>CADASTRADO POR:</strong> <?php echo $responsavel ?> - <?php echo $data_cadastro ?> <br>
<strong>ALTERADO POR:</strong> <?php echo $alterado_por ?> - <?php echo $ultima_alteracao = date('d/m/y H:i',  strtotime($ultima_alteracao));?> <br>


                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
              </div>
            </div>
          </div>   </td>
        <td class="text text-center" style="text-align: center; vertical-align: middle;"><a class="accordion-button" href="#" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#editarCliente" data-whatever="<?php echo $linha['id_cliente']; ?>" 
data-whatevernome="<?php echo $linha['nome']; ?>"
data-whateveroperador="<?php echo $linha['criado_por']; ?>" 
data-whateverveiculo="<?php echo $linha['veiculo']; ?>"
data-whateverconclusao="<?php echo $linha['conclusao']; ?>"  
data-whateversinal="<?php echo $linha['sinal']; ?>" 
data-whatevertecnico="<?php echo $linha['tecnico']; ?>" 
data-whateverplano="<?php echo $linha['plano']; ?>" 
data-whateverrede="<?php echo $linha['rede']; ?>" 
data-whateverredesenha="<?php echo $linha['redesenha']; ?>" 
data-whateverdata-cadastro="<?php echo $data_cadastro ?>" 
data-whatevertempo="<?php echo $interval->format('%H:%I'); ?>"
data-whateveralterado_por="<?php echo $alterado_por; ?>" 
data-whateveragendado="<?php echo $agendado ?>"
data-whateverultima_alteracao="<?php echo $ultima_alteracao = date('d/m/Y H:i:s',  strtotime($ultima_alteracao));?>"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg></a>
<?php 
                        if($_SESSION['perfil_cod'] == 1){
                    ?>
<td class="text text-center" style="text-align: center; vertical-align: middle;">
                    <a href="processa_excluir_clientes.php?id_cliente=<?php echo $linha['id_cliente']; ?>&nome=<?php echo $linha['nome']; ?>" onClick="return confirm('Deseja realmente deletar o agendamento de <?php echo $linha['nome']; ?> ?')" class="accordion-button"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a> </td><?php } ?>



</td>
        <td class="text text-center" style="text-align: center; vertical-align: middle;"><script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script> 
          <script type="text/javascript">
const clipboard = new ClipboardJS('.copy')

clipboard.on('success', function(e) {
    alert("CHAMADO COPIADO")
});

clipboard.on('error', function(e) {
    alert("Falha ao copiar texto")
});
</script>
          <button type="button" class="copy border border-0 btn" data-clipboard-text="
*ORDEM DE SERVIÇO Nº <?php echo $linha['id_cliente']; ?>* 

*TIPO:* <?php echo $situacao ?>ㅤ   
*TÉCNICO:* <?php echo $linha['tecnico']; ?> 
*VEÍCULO:* <?php echo $linha['veiculo']; ?>  

*SINAL ATUAL:* <?php echo $linha['sinal']; ?>  
*MENSAGEM:* <?php
$observacao = mb_strtoupper($observacao);

if ($observacao >= 0)
{
$x = "$observacao";
}
else
{
$x = "";
}

echo $x;
?> - ENVIAR FOTOS DO REPARO

*DADOS DO CLIENTE:*
*NOME:* <?php echo $linha['nome']; ?>   
*PPPOE:* <?php echo $linha['pppoe']; ?>   
*END:* <?php echo $rua = mb_strtoupper($rua); ?>, Nº <?php echo $linha['numero']; ?> - <?php echo $linha['bairro']; ?>  
*PLANO:* <?php echo $linha['plano']; ?> 
*ONU:* <?php echo $linha['onu']; ?> 
*REDE:* <?php echo $linha['rede']; ?> 
*SENHA:* <?php echo $linha['redesenha']; ?> 

*LANÇADO POR:* <?php echo $_SESSION['usuarioNome'] ?> 

*MAPA:* https://app.xgstelecom.com.br/os/reparos.php?id=<?php echo $linha['id_cliente']; ?> 
"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-folders"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 2a1 1 0 0 1 .707 .293l1.708 1.707h4.585a3 3 0 0 1 2.995 2.824l.005 .176v7a3 3 0 0 1 -3 3h-1v1a3 3 0 0 1 -3 3h-10a3 3 0 0 1 -3 -3v-9a3 3 0 0 1 3 -3h1v-1a3 3 0 0 1 3 -3zm-6 6h-1a1 1 0 0 0 -1 1v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1 -1v-1h-7a3 3 0 0 1 -3 -3z" /></svg></button>
          <div class="modal fade" id="modal<?php echo $linha['id_cliente']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">ATENÇÃO!!!</h5>
                </div>
                <div class="modal-body">
                  <?php
$observacao = mb_strtoupper($observacao);

if ($observacao >= 0)
{
$x = "$observacao";
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
          </td>
      </tr><?php } ?>
    </tbody>
    
  </table>
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

<!-- ==================================================MODAL CADASTRO DE CLIENTE ==================================== -->
<?php require "modais/modal_cad_reparo.php"?>
<!-- -----------------------------------MODAL EDITAR CLIENTE----------------------------------------------------------------->

<div class="modal fade" id="editarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">New message</h5><button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      <form method="POST" action="processa_edit_clientes.php" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12 col-sm-12">
            <label for="recipient-nome" class="col-form-label">NOME:</label>
            <input type="text" class="form-control" id="recipient-nome" name="nome">
          </div>
          <div class="col-md-10 col-sm-12">
            <label for="recipient-tecnico" class="col-form-label">TECNICOS:</label>
<select id="recipient-tecnico" name="tecnico[]" class="selectpicker form-control" multiple aria-label=".form-select-lg example" required>
    <?php
$hoje = date("Y-m-d");
$consulta = "SELECT * FROM equipes WHERE data = '$hoje' ORDER BY veiculo";
$resultado = mysqli_query($conn, $consulta);
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$dataLocal = date('d/m/Y H:i:s', time());

// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
?>
                                <?php
                                while ($dados = mysqli_fetch_array($resultado)) {
                                    ?>
                                    <option value="<?php echo $dados['tecnicos']; ?>">
                                        <?php
                                            echo  $dados['tecnicos'];
                                            ?> - (<?php
                                            echo  $dados['veiculo'];
                                            ?>)
                                            </option>
<?php
                                }
                                ?>
  </select>
          </div>
          <div class="col-md-2 col-sm-12">
            <label for="recipient-veiculo" class="col-form-label">VEICULO:</label>
            <select class="form-select" name="veiculo" id="recipient-veiculo" aria-label=".form-select-lg example">
              <option value="01">01</option>
              <option value="02">02</option>
              <option value="03">03</option>
              <option value="04">04</option>
              <option value="05">05</option>
              <option value="06">06</option>
              <option value="07">07</option>
              <option value="08">08</option>
              <option value="09">09</option>
              <option value="10">10</option>
              <option value="YBR">YBR</option>
              <option value="BIZ">BIZ</option>
              <option value="POP">POP</option>
              <option value="UNO_C">UNO_C</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-10 col-sm-12">
            <label for="recipient-conclusao" class="col-form-label">CONCLUSAO:</label>
            <textarea class="form-control" name="conclusao" id="recipient-conclusao"  aria-label="With textarea"></textarea>
          </div>
          <div class="col-md-2 col-sm-12">
            <label for="recipient-urgente" class="col-form-label">URGENCIA?</label>
            <select class="form-select" name="urgente" id="urgente" aria-label=".form-select-lg example">
              <option value="">NAO</option>
              <option value="SIM">SIM</option>
            </select>
          </div>
          <div class="col-md-3 col-sm-12">
          <label for="recipient-urgente" class="col-form-label">ROTEADOR</label>
                                        <select class="form-select" value="" name="roteador_saida" id="roteador_saida">
                                <option value="" selected required>Selecione...</option>
                                <?php
$consulta = "SELECT * FROM hb_estoque WHERE tipo='roteador' ORDER BY produto";
$resultado = mysqli_query($conn, $consulta);
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$dataLocal = date('d/m/Y H:i:s', time());

// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
?>
                                <?php
                                while ($dados = mysqli_fetch_array($resultado)) {
                                    ?>
                                    <option value="<?php echo $dados['produto']; ?>">
                                        <?php
                                            echo  $dados['produto'];
                                            ?> <?php
                        echo  '('. $dados['quantidade'] . ')';
                        
                        
                        ?>  
                       
                        
                               </option>
                                <?php
                                }
                                ?>
                            </select>
          </div>
       <div class="col-md-1">
        <label for="exampleFormControlInput1" name="email"  class="col-form-label">QTD:</label>
        <input type="text" class="form-control" name="roteador_quantidade_saida" value="">
      </div>
          <div class="col-md-3 col-sm-12">
          <label for="recipient-urgente" class="col-form-label">ONU</label>
                                        <select class="form-select" value="" name="onu_saida" id="onu_saida">
                                <option value="" selected required>Selecione...</option>
                                <?php
$consulta = "SELECT * FROM hb_estoque WHERE tipo='onu'";
$resultado = mysqli_query($conn, $consulta);
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$dataLocal = date('d/m/Y H:i:s', time());

// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
?>
                                <?php
                                while ($dados = mysqli_fetch_array($resultado)) {
                                    ?>
                                    <option value="<?php echo $dados['produto']; ?>">
                                        <?php
                                            echo  $dados['produto'];
                                            ?> <?php
                        echo  '('. $dados['quantidade'] . ')';
                        
                        
                        ?>  
                       
                        
                               </option>
                                <?php
                                }
                                ?>
                            </select>
          </div>
                   <div class="col-md-1">
        <label for="exampleFormControlInput1" name="email"  class="col-form-label">QTD:</label>
        <input type="text" class="form-control" name="onu_quantidade_saida" value="">
      </div>
          <div class="col-md-3 col-sm-12">
          <label for="recipient-urgente" class="col-form-label">TIMER</label>
                                        <select class="form-select" value="" name="timer_saida" id="timer_saida">
                                <option value="" selected required>Selecione...</option>
                                <?php
$consulta = "SELECT * FROM hb_estoque WHERE tipo='timer'";
$resultado = mysqli_query($conn, $consulta);
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$dataLocal = date('d/m/Y H:i:s', time());

// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
?>
                                <?php
                                while ($dados = mysqli_fetch_array($resultado)) {
                                    ?>
                                    <option value="<?php echo $dados['produto']; ?>">
                                        <?php
                                            echo  $dados['produto'];
                                            ?> <?php
                        echo  '('. $dados['quantidade'] . ')';
                        
                        
                        ?>  
                       
                        
                               </option>
                                <?php
                                }
                                ?>
                            </select>
          </div>
                   <div class="col-md-1">
        <label for="exampleFormControlInput1" name="email"  class="col-form-label">QTD:</label>
        <input type="text" class="form-control" name="timer_quantidade_saida" value="">
      </div>
          <div class="col-md-3 col-sm-12">
            <label for="recipient-rede" class="col-form-label">REDE WIFI:</label>
            <input type="text" name="rede" id="recipient-rede" maxlength="50" class="form-control -10">
          </div>
          <div class="col-md-3 col-sm-12">
            <label for="recipient-redesenha" class="col-form-label">SENHA WIFI:</label>
            <input type="text" name="redesenha" id="recipient-redesenha" maxlength="50" class="form-control -10">
          </div>
            <div class="col-md-3 col-sm-12">
            <label for="recipient-sinal" class="col-form-label">SINAL ATUAL:</label>
            <input type="text" name="sinal" id="recipient-sinal" maxlength="50" class="form-control">
          </div>
           <div class="col-md-1 col-sm-12">
            <label for="recipient-drop" class="col-form-label">DROP:</label>
            <input type="text" name="cabo_drop" id="cabo_drop" maxlength="50" class="form-control -10">
          </div>
          <div class="col-md-2 col-sm-12">
            <label for="recipient-dropsolto" class="col-form-label">DROP SOLTO:</label>
            <select class="form-select" name="drop_solto" id="drop_solto" aria-label=".form-select-lg example">
              <option value="NAO">NAO</option>
              <option value="SIM">SIM</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 col-sm-12">
            <label for="recipient-operador" class="col-form-label cli">CADASTRADO POR:</label>
            <input type="text" name="operador" id="recipient-operador" maxlength="50" class="form-control" disabled>
          </div>
          <div class="col-md-3 col-sm-12">
            <label for="recipient-dataCadastro" class="col-form-label">DATA DO CADASTRO:</label>
            <input type="text" class="form-control" id="recipient-dataCadastro" disabled>
          </div>
          <div class="col-md-3 col-sm-12">
            <label for="recipient-concluido" class="col-form-label">REMOTO:</label>
            <select class="form-select" name="remoto" id="remoto" aria-label=".form-select-lg example">
              <option value="ATIVADO">ATIVADO</option>
              <option value="NAO">NAO</option>
            </select>
          </div>
          <div class="col-md-3 col-sm-12">
            <label for="recipient-status" class="col-form-label">SITUAÇÃO:</label>
            <select class="form-select" name="status" id="status" aria-label=".form-select-lg example">
            
              <option value="ANDAMENTO">EM ANDAMENTO</option>
              <option value="REMARCAR">REMARCAR</option>
              <option value="A LANÇAR">A LANÇAR</option>
              <option value="CONCLUIDO">CONCLUIDO</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 col-sm-12">
            <label for="recipient-operador" class="col-form-label cli">ALTERADO POR:</label>
            <input type="text" name="alterado_por" id="recipient-alterado_por" maxlength="50" class="form-control" disabled value="<?php echo $_SESSION['usuarioNome'] ?>">
          </div>
          <div class="col-md-3 col-sm-12">
            <label for="recipient-agendado" class="col-form-label">P/ DIA:</label>
            <input class="form-control "  type="datetime-local"  name="recipient-agendado" id="recipient-agendado">
          </div>
         <div class="col-md-2 col-sm-12">
            <label for="recipient-tempo" class="col-form-label">TEMPO:</label>
            <input type="text" name="tempo" id="recipient-tempo" maxlength="50" class="form-control">
          </div>
         <div class="col-md-2 col-sm-12">
            <label for="recipient-concluido" class="col-form-label">REPETIDOR:</label>
            <select class="form-select" name="repetidor" id="repetidor" aria-label=".form-select-lg example">
              <option value="NAO">NAO</option>
              <option value="SIM">SIM</option>
            </select>
          </div>
          <div class="col-md-2 col-sm-12">
            <label for="recipient-concluido" class="col-form-label">CONCLUIDO:</label>
            <select class="form-select" name="concluido" id="concluido" aria-label=".form-select-lg example">
              <option value="NAO">NAO</option>
              <option value="SIM">SIM</option>
            </select>
          </div>
          <input type="hidden" name="id" class="form-control" id="id">
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">FECHAR</button>
          <button type="submit" class="btn btn-primary">ALTERAR</button>
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
		var recipientveiculo = button.data('whateverveiculo')
		var recipientconclusao = button.data('whateverconclusao')
		var recipientsinal = button.data('whateversinal')
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
		var recipientrede = button.data('whateverrede')
		var recipientredesenha = button.data('whateverredesenha')
        var recipientdataCadastro = button.data('whateverdata-cadastro')
        var recipientalterado_por = button.data('whateveralterado_por')
        var recipientultima_alteracao = button.data('whateverultima_alteracao')
        var recipienttempo = button.data('whatevertempo')
        var recipienturgente = button.data('whateverurgente')
        var recipientagendado = button.data('whateveragendado')

        var modal = $(this)
        modal.find('.modal-title').text('ALTERAR ORDEM DE SERVIÇO Nº' + recipient)
        modal.find('#id').val(recipient)
        modal.find('#recipient-nome').val(recipientnome)
		modal.find('#recipient-tecnico').val(recipienttecnico)
		modal.find('#recipient-veiculo').val(recipientveiculo)
		modal.find('#recipient-conclusao').val(recipientconclusao)
		modal.find('#recipient-sinal').val(recipientsinal)
        modal.find('#recipient-operador').val(recipientoperador)
        modal.find('#recipient-situacao').val(recipientsituacao)
		modal.find('#recipient-concluido').val(recipientconcluido)
		modal.find('#recipient-rede').val(recipientrede)
		modal.find('#recipient-redesenha').val(recipientredesenha)
        modal.find('#recipient-dataCadastro').val(recipientdataCadastro)
        modal.find('#recipient-alterado_por').val(recipientalterado_por)
        modal.find('#recipient-ultima_alteracao').val(recipientultima_alteracao)
        modal.find('#recipient-tempo').val(recipienttempo)
        modal.find('#recipient-urgente').val(recipienturgente)
         modal.find('#recipient-agendado').val(recipientagendado)

    })
</script> 
<script>
function processa() {
    var logins = document.getElementById("logins").value;
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("modal-body").innerHTML = this.responseText;
    }
    xhttp.open("GET", "processa.php?logins="+logins);
    xhttp.send();    
}      
</script>
<script src="bootstrap-select.min.js"></script>
<link rel="stylesheet" href="bootstrap-select.min.css" />