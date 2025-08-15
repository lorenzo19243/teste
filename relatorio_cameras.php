<?php
session_start();
include_once('assets/cabecalho.php');
include_once('assets/rodape.php');
include('config/conexao.php');
include_once("config/seguranca.php");
seguranca_adm();
$consulta = "SELECT * FROM cameras WHERE concluido = 'NAO' ORDER BY ultima_alteracao DESC ; ";
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
        <div class="col-md-4 bg-warning  justify-content-between p-3 d-flex"><input type="text" name="pesquisa_cliente" id="pesquisa_cliente" class="form-control" placeholder="PESQUISAR cameras POR NOME" required autofocus>
            
        </div>
    </div>
</div>

<div class="container-sm">
 <div class="modal-content border-0">
  <div class="badge  text-wrap">
    <div class="col-md-auto"><h5><small class="text-muted">
     <?php
	 
	$_SESSION["usuarioNome"]; 
    $data = date('D');
    $mes = date('M');
    $dia = date('d');
    $ano = date('Y');
    
    $semana = array(
        'Sun' => 'Domingo', 
        'Mon' => 'Segunda-Feira',
        'Tue' => 'Terça-Feira',
        'Wed' => 'Quarta-Feira',
        'Thu' => 'Quinta-Feira',
        'Fri' => 'Sexta-Feira',
        'Sat' => 'Sabado'
    );
    
    $mes_extenso = array(
        'Jan' => 'Janeiro',
        'Feb' => 'Fevereiro',
        'Mar' => 'Março',
        'Apr' => 'Abril',
        'May' => 'Maio',
        'Jun' => 'Junho',
        'Jul' => 'Julho',
        'Aug' => 'Agosto',
        'Nov' => 'Novembro',
        'Sep' => 'Setembro',
        'Oct' => 'Outubro',
        'Dec' => 'Dezembro'
    );
    
    echo 'Olá ','<strong>', $_SESSION["usuarioNome"],'</strong>', ' Hoje é ', $semana["$data"] .  ", dia {$dia} de " . $mes_extenso["$mes"] . " de {$ano}"; ?></small></h5>
        <span class="btn btn-primary btn-sm"><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE  STATUS="<button type=\'button\' class=\'btn btn-primary btn-sm\'> andamento</button>" ORDER BY nome DESC;');
				$row_cnt = mysqli_num_rows($cameras);

printf("%d", $row_cnt); ?> REPAROS EM ANDAMENTO!</span>

<button type='button' class='btn btn-primary btn-sm' data-toggle='modal' ><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE  STATUS="<button type=\'button\' class=\'btn btn-primary btn-sm\'> andamento</button>" ORDER BY nome DESC;');
				$row_cnt = mysqli_num_rows($cameras);

printf("%d", $row_cnt); ?>
 INSTALAÇÃO EM ANDAMENTO!</button>


    <span class="btn btn-primary btn-sm"><?php $cameras = mysqli_query($conn,'SELECT * FROM mudanca WHERE  STATUS="<button type=\'button\' class=\'btn btn-primary btn-sm\'> andamento</button>" ORDER BY nome DESC;');
				$row_cnt = mysqli_num_rows($cameras);

printf("%d", $row_cnt); ?> MUDANÇAS EM ANDAMENTO!</span>
<span class="btn btn-primary btn-sm"><?php $cameras = mysqli_query($conn,'SELECT * FROM recolhas WHERE  STATUS="<button type=\'button\' class=\'btn btn-primary btn-sm\'> andamento</button>" ORDER BY nome DESC;');
				$row_cnt = mysqli_num_rows($cameras);

printf("%d", $row_cnt); ?> RECOLHAS EM ANDAMENTO!</span>
    </div>
  </div>
</br>  
</div>
</div><body>
<div class="table-responsive-sm">
<table class="table" style="font-size: 12px;">
  <thead class="bg-dark text text-white">
    <tr>
      <th scope="col">#</th>
      <th scope="col">JANEIRO</th>
      <th scope="col">FEVEREIRO</th>
      <th scope="col">MARÇO</th>
       <th scope="col">ABRIL</th>
        <th scope="col">MAIO</th>
         <th scope="col">JUNHO</th>
          <th scope="col">JULHO</th>
           <th scope="col">AGOSTO</th>
            <th scope="col">SETEMBRO</th>
            <th scope="col">OUTUBRO</th>
             <th scope="col">NOVEMBRO</th>
              <th scope="col">DEZEMBRO</th>
              <th scope="col">TOTAL</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">REPAROS</th>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="01" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d REPAROS", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="02" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d REPAROS", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="03" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d REPAROS", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="04" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d REPAROS", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="05" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d REPAROS", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="06" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d REPAROS", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="07" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d REPAROS", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="08" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d REPAROS", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM tvbox_chamados WHERE MONTH(data_fim)="9" AND situacao="VERIFICAR TVBOX" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d REPARO", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM tvbox_chamados WHERE MONTH(data_fim)="10" AND situacao="VERIFICAR TVBOX" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d REPARO", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="11" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d REPAROS", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="12" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d REPAROS", $row_cnt);				
 ?></td>
      <td> <?php $cameras = mysqli_query($conn,'SELECT * FROM tvbox_chamados WHERE YEAR(data_fim)="2024" AND concluido="SIM" AND situacao="VERIFICAR TVBOX";');
				
$row_cnt = mysqli_num_rows($cameras);

printf(" %d", $row_cnt);				
 ?></td>
     
<tr>
      <th scope="row">INSTALAÇÕES</th>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="01" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d INSTAL.", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="02" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d INSTAL.", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="03" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d INSTAL.", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="04" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d INSTAL.", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="05" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d INSTAL.", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="06" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d INSTAL.", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="07" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d INSTAL.", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="08" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d INSTAL.", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM tvbox_chamados WHERE MONTH(data_fim)="9" AND situacao="INSTALACAO TVBOX" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d INSTAL.", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM tvbox_chamados WHERE MONTH(data_fim)="10" AND situacao="INSTALACAO TVBOX" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d INSTAL.", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="11" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d INSTAL.", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="12" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d INSTAL.", $row_cnt);				
 ?></td>
      <td> <?php $cameras = mysqli_query($conn,'SELECT * FROM tvbox_chamados WHERE YEAR(data_fim)="2024" AND concluido="SIM" AND situacao="INSTALACAO TVBOX";');
				
$row_cnt = mysqli_num_rows($cameras);

printf(" %d", $row_cnt);				
 ?></td>  
 <tr>
      <th scope="row">RECOLHAS</th>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="01" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d MUDANÇAS", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="02" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d MUDANÇAS", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="03" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d MUDANÇAS", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="04" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d MUDANÇAS", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="05" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d MUDANÇAS", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="06" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d MUDANÇAS", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="07" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d MUDANÇAS", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="08" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d MUDANÇAS", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM tvbox_chamados WHERE MONTH(data_fim)="9" AND situacao="RECOLHA TVBOX" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d RECOLHA", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM tvbox_chamados WHERE MONTH(data_fim)="10" AND situacao="RECOLHA TVBOX" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d RECOLHA", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM tvbox_chamados WHERE MONTH(data_fim)="11" AND situacao="RECOLHA TVBOX" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d RECOLHA", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="12" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d MUDANÇAS", $row_cnt);				
 ?></td>
      <td> <?php $cameras = mysqli_query($conn,'SELECT * FROM tvbox_chamados WHERE YEAR(data_fim)="2024" AND concluido="SIM" AND situacao="RECOLHA TVBOX";');
				
$row_cnt = mysqli_num_rows($cameras);

printf(" %d", $row_cnt);				
 ?></td>      
 <tr>
 <tr>
      <th scope="row">TOTAL</th>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="01" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d ", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="02" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="03" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="04" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="05" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="06" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="07" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="08" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d", $row_cnt);				
 ?></td>
      <td><strong><?php $result=mysqli_query($conn, 'SELECT (SELECT COUNT(*) FROM tvbox_chamados WHERE MONTH(data_fim)="9" AND concluido="SIM" AND situacao="VERIFICAR TVBOX") +
    (SELECT COUNT(*) FROM tvbox_chamados WHERE MONTH(data_fim)="9" AND concluido="SIM" AND situacao="INSTALACAO TVBOX") +
    (SELECT COUNT(*) FROM tvbox_chamados WHERE MONTH(data_fim)="9" AND concluido="SIM" AND situacao="RECOLHA TVBOX") AS total;');
	
$data=mysqli_fetch_assoc($result);
echo $data['total']; ?></strong></td>

      <td><strong><?php $result=mysqli_query($conn, 'SELECT (SELECT COUNT(*) FROM tvbox_chamados WHERE MONTH(data_fim)="10" AND concluido="SIM" AND situacao="VERIFICAR TVBOX") +
    (SELECT COUNT(*) FROM tvbox_chamados WHERE MONTH(data_fim)="10" AND concluido="SIM" AND situacao="INSTALACAO TVBOX") +
    (SELECT COUNT(*) FROM tvbox_chamados WHERE MONTH(data_fim)="10" AND concluido="SIM" AND situacao="RECOLHA TVBOX") AS total;');
	
$data=mysqli_fetch_assoc($result);
echo $data['total']; ?></strong></td>
      <td><strong><?php $result=mysqli_query($conn, 'SELECT (SELECT COUNT(*) FROM tvbox_chamados WHERE MONTH(data_fim)="11" AND concluido="SIM" AND situacao="VERIFICAR TVBOX") +
    (SELECT COUNT(*) FROM tvbox_chamados WHERE MONTH(data_fim)="11" AND concluido="SIM" AND situacao="INSTALACAO TVBOX") +
    (SELECT COUNT(*) FROM tvbox_chamados WHERE MONTH(data_fim)="11" AND concluido="SIM" AND situacao="RECOLHA TVBOX") AS total;');
	
$data=mysqli_fetch_assoc($result);
echo $data['total']; ?></strong></td>
      <td><strong><?php $result=mysqli_query($conn, 'SELECT (SELECT COUNT(*) FROM tvbox_chamados WHERE MONTH(data_fim)="12" AND concluido="SIM" AND situacao="VERIFICAR TVBOX") +
    (SELECT COUNT(*) FROM tvbox_chamados WHERE MONTH(data_fim)="12" AND concluido="SIM" AND situacao="INSTALACAO TVBOX") +
    (SELECT COUNT(*) FROM tvbox_chamados WHERE MONTH(data_fim)="12" AND concluido="SIM" AND situacao="RECOLHA TVBOX") AS total;');
	
$data=mysqli_fetch_assoc($result);
echo $data['total']; ?></strong></td>
      <td><strong><?php $result=mysqli_query($conn, "SELECT (SELECT COUNT(*) FROM tvbox_chamados WHERE concluido = 'SIM') AS total;");
	
$data=mysqli_fetch_assoc($result);
echo $data['total']; ?></strong></td>                 
    </tr>
  </tbody>
</table>
<div class="container">
  <div class="row">
    <div class="col">
      
    </div>
    <div class="badge  text-wrap">

<button  class="btn btn-secondary" type='button' class='badge btn-warning' data-toggle='modal' data-target='#modalw'>
IMPRIMIR
</button>
<div class="modal fade" id="modalw" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">IMPRIMIR</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <script type="text/javascript">
        function PrintDiv(id) {
            var data=document.getElementById(id).innerHTML;
            var myWindow = window.open('', 'my div', 'height=600,width=900px');
            myWindow.document.write('<html><head><title>my div</title>');
            /*optional stylesheet*/ //myWindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
            myWindow.document.write('</head><body >');
            myWindow.document.write(data);
            myWindow.document.write('</body></html>');
            myWindow.document.close(); // necessary for IE >= 10

            myWindow.onload=function(){ // necessary if the div contain images

                myWindow.focus(); // necessary for IE >= 10
                myWindow.print();
                myWindow.close();
            };
        }
    </script><body>
    <div id="myDiv" style="alignment-adjust:central" align="center">
        <table cellpadding=3 cellspacing=0 style="font-size: 12px; text-align:left;">
  <thead class="bg-dark text text-white">
    <tr>
      <th scope="col">#</th>
      <th scope="col" style="padding: 5px 15px 5px 5px;">JANEIRO</th>
      <th scope="col">FEVEREIRO</th>
      <th scope="col" style="padding: 5px 20px 5px 5px;" >MARÇO</th>
       <th scope="col" style="padding: 5px 30px 5px 5px;">ABRIL</th>
        <th scope="col" style="padding: 5px 30px 5px 5px;">MAIO</th>
         <th scope="col" style="padding: 5px 30px 5px 5px;">JUNHO</th>
          <th scope="col"style="padding: 5px 30px 5px 5px;">JULHO</th>
           <th scope="col"style="padding: 5px 30px 5px 5px;">AGOSTO</th>
            <th scope="col" style="padding: 5px 15px 5px 5px;">SETEMBRO</th>
            <th scope="col" style="padding: 5px 15px 5px 5px;">OUTUBRO</th>
             <th scope="col" style="padding: 5px 15px 5px 5px;">NOVEMBRO</th>
              <th scope="col">DEZEMBRO</th>
              <th scope="col">TOTAL</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">REPAROS</th>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="01" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d REPAROS", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="02" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d REPAROS", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="03" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d REPAROS", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="04" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d REPAROS", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="05" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d REPAROS", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="06" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d REPAROS", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="07" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d REPAROS", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="08" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d REPAROS", $row_cnt);				
 ?> </td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM tvbox_chamados WHERE MONTH(data_fim)="9" AND situacao="VERIFICAR TVBOX" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d REPARO", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM tvbox_chamados WHERE MONTH(data_fim)="10" AND situacao="VERIFICAR TVBOX" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d REPARO", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="11" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d REPAROS", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="12" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d REPAROS", $row_cnt);				
 ?></td>
      <td> <?php $cameras = mysqli_query($conn,'SELECT * FROM tvbox_chamados WHERE YEAR(data_fim)="2024" AND concluido="SIM" AND situacao="VERIFICAR TVBOX";');
				
$row_cnt = mysqli_num_rows($cameras);

printf(" %d", $row_cnt);				
 ?></td>
     
<tr>
      <th scope="row">INSTALAÇÕES</th>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="01" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d INSTAL.", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="02" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d INSTAL.", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="03" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d INSTAL.", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="04" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d INSTAL.", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="05" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d INSTAL.", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="06" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d INSTAL.", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="07" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d INSTAL.", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="08" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d INSTAL.", $row_cnt);				
 ?> </td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM tvbox_chamados WHERE MONTH(data_fim)="9" AND situacao="INSTALACAO TVBOX" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d INSTAL.", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM tvbox_chamados WHERE MONTH(data_fim)="10" AND situacao="INSTALACAO TVBOX" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d INSTAL.", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="11" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d INSTAL.", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="12" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d INSTAL.", $row_cnt);				
 ?></td>
      <td> <?php $cameras = mysqli_query($conn,'SELECT * FROM tvbox_chamados WHERE YEAR(data_fim)="2024" AND concluido="SIM" AND situacao="INSTALACAO TVBOX";');
				
$row_cnt = mysqli_num_rows($cameras);

printf(" %d", $row_cnt);				
 ?></td>  
 <tr>    
 <tr>
      <th scope="row">RECOLHAS</th>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="01" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d RECOL.", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="02" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d RECOL.", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="03" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d RECOL.", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="04" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d RECOL.", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="05" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d RECOL.", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="06" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d RECOL.", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="07" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d RECOL.", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="08" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d RECOL.", $row_cnt);				
 ?> </td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM tvbox_chamados WHERE MONTH(data_fim)="9" AND situacao="RECOLHA TVBOX" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d RECOLHA", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM tvbox_chamados WHERE MONTH(data_fim)="10" AND situacao="RECOLHA TVBOX" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d RECOLHA", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM recolhas WHERE MONTH(data_fim)="11" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d RECOL.", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="12" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d RECO.", $row_cnt);				
 ?></td>
      <td> <?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE YEAR(data_fim)="2024" AND concluido="SIM" AND situacao="RECOLHA CAMERAS";');
				
$row_cnt = mysqli_num_rows($cameras);

printf(" %d", $row_cnt);				
 ?></td>  
 <tr>
      <th scope="row">TOTAL</th>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="01" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d ", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="02" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="03" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="04" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="05" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="06" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="07" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d", $row_cnt);				
 ?></td>
      <td><?php $cameras = mysqli_query($conn,'SELECT * FROM cameras WHERE MONTH(data_fim)="08" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($cameras);

printf("%d", $row_cnt);				
 ?> </td>
      <td><strong><?php $result=mysqli_query($conn, 'SELECT (SELECT COUNT(*) FROM tvbox_chamados WHERE MONTH(data_fim)="9" AND concluido="SIM" AND situacao="VERIFICAR TVBOX") +
    (SELECT COUNT(*) FROM tvbox_chamados WHERE MONTH(data_fim)="9" AND concluido="SIM" AND situacao="INSTALACAO TVBOX") +
    (SELECT COUNT(*) FROM tvbox_chamados WHERE MONTH(data_fim)="9" AND concluido="SIM" AND situacao="RECOLHA TVBOX") AS total;');
	
$data=mysqli_fetch_assoc($result);
echo $data['total']; ?></strong></td>
      <td><strong><?php $result=mysqli_query($conn, 'SELECT (SELECT COUNT(*) FROM tvbox_chamados WHERE MONTH(data_fim)="10" AND concluido="SIM" AND situacao="VERIFICAR TVBOX") +
    (SELECT COUNT(*) FROM tvbox_chamados WHERE MONTH(data_fim)="10" AND concluido="SIM" AND situacao="INSTALACAO TVBOX") +
    (SELECT COUNT(*) FROM tvbox_chamados WHERE MONTH(data_fim)="10" AND concluido="SIM" AND situacao="RECOLHA TVBOX") AS total;');
	
$data=mysqli_fetch_assoc($result);
echo $data['total']; ?></strong></td>
      <td><strong><?php $result=mysqli_query($conn, 'SELECT (SELECT COUNT(*) FROM tvbox_chamados WHERE MONTH(data_fim)="11" AND concluido="SIM" AND situacao="VERIFICAR TVBOX") +
    (SELECT COUNT(*) FROM tvbox_chamados WHERE MONTH(data_fim)="11" AND concluido="SIM" AND situacao="INSTALACAO TVBOX") +
    (SELECT COUNT(*) FROM tvbox_chamados WHERE MONTH(data_fim)="11" AND concluido="SIM" AND situacao="RECOLHA TVBOX") AS total;');
	
$data=mysqli_fetch_assoc($result);
echo $data['total']; ?></strong></td>
      <td><strong><?php $result=mysqli_query($conn, 'SELECT (SELECT COUNT(*) FROM tvbox_chamados WHERE MONTH(data_fim)="12" AND concluido="SIM" AND situacao="VERIFICAR TVBOX") +
    (SELECT COUNT(*) FROM tvbox_chamados WHERE MONTH(data_fim)="12" AND concluido="SIM" AND situacao="INSTALACAO TVBOX") +
    (SELECT COUNT(*) FROM tvbox_chamados WHERE MONTH(data_fim)="12" AND concluido="SIM" AND situacao="RECOLHA TVBOX") AS total;');
	
$data=mysqli_fetch_assoc($result);
echo $data['total']; ?></strong></td>
      <td><strong><?php $result=mysqli_query($conn, "SELECT (SELECT COUNT(*) FROM tvbox_chamados WHERE concluido = 'SIM') AS total;");
	
$data=mysqli_fetch_assoc($result);
echo $data['total']; ?></strong></td>                 
    </tr>
  </tbody>
</table>
    </div>
    <div></div>
    <div id="anotherDiv"></div>
</body>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <form>
            <input class="btn btn-secondary" type="button" value="IMPRIMIR" onClick="PrintDiv('myDiv')" />

</form>
      </div>
    </div>
  </div>
</div>


    </div>
    <div class="col">
      
    </div>
  </div>
</div>
</div>
<footer class="bd-footer py-5 mt-5 bg-light">
  <div class="container">
  <div class="row">
    <div class="col">
 
    </div>
    <div class="badge  text-wrap">
      <p class="mt-5 mb-1 text-muted">&copy;  <?php echo date('d/m/Y') ?></p>
      <p class="mt-1 mb-1 text-muted">HB WEB E CIA - All Rights Reserved</p>
      <p class="mt-1 mb-1 text-muted">Versão 1.0 </p>

    </div>
    <div class="col">
      
    </div>
  </div>
</div>
      
</footer>

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
                $.post("processa_cad_cameras.php", dados, function(retorna) {
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
            <div class="modal-body bg-success text text-center text-white">
                CHAMADO CADASTRADO COM SUCESSO!
            </div>
            <div class="modal-footer">

            </div>
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
            <div class="modal-body bg-danger text text-center text-white">
                CHAMADO NÃO CADASTRADO!
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<!-- ==================================================MODAL CADASTRO DE CLIENTE ==================================== -->
<div class="modal fade" id="cadCliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="exampleModalLabel">CADASTRAR CHAMADO</h5>


                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>


            </div>


            <!-- ALERTA PARA ERRO DE PREENCHIMENTO DE FORMULARIO -->
            <div class="alert alert-danger d-none fade show m-3" role="alert">
                <strong>ERRO!</strong> - <strong>Preencha o campo <span id="campo-erro"></span></strong>!
                <span id="msg"></span>
            </div>

            <div class="modal-body">
                <form method="POST" id="insert_form">

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <label for="recipient-nome" class="col-form-label">NOME:</label>
                            <input type="text" name="nome" id="nome" maxlength="50" class="form-control">
                        </div>


</div><div class="row">
                        <div class="col-md-12 col-sm-12">
                            <label for="recipient-situacao" class="col-form-label">SITUAÇÃO:</label>
                            <input type="text" name="situacao" id="situacao" maxlength="50" class="form-control">
                        </div>


</div>
                    <div class="row">
                        <div class="col-md-9 col-sm-12">
                            <label for="recipient-observacao" class="col-form-label">OBSERVAÇÃO:</label>
                            <input type="text" name="observacao" id="observacao" maxlength="200" class="form-control">
                        </div>
                        <div class="col-md-3 col-sm-12">
                           
                        </div>

                        <div class="col-md-5 col-sm-12">
                            <label for="recipient-bairro" class="col-form-label">BAIRRO</label>
                            :
                            <input type="text" name="bairro" id="bairro" maxlength="50" class="form-control">
                        </div>
                        <div class="col-md-5 col-sm-12">
                            <label for="recipient-rua" class="col-form-label">RUA:</label>
                            <input type="text" name="rua" id="rua" maxlength="50" class="form-control -10">
                        </div>
                        <div class="col-md-2 col-sm-12">
                          <label for="recipient-numero" class="col-form-label">N</label>
                          :
                          <input type="text" name="numero" id="numero" maxlength="50" class="form-control -10 border border-warning" >
                        </div>
                        
                        <div class="col-md-5 col-sm-12">
                            <label for="recipient-bairro" class="col-form-label">SINAL:</label>
                            <input type="text" name="sinal" id="sinal" maxlength="50" class="form-control">
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label for="recipient-rua" class="col-form-label">PPPOE:</label>
                            <input type="text" name="pppoe" id="pppoe" maxlength="50" class="form-control -10">
                        </div>
                        
                        <div class="col-md-5 col-sm-10">
                            <label for="recipient-rua" class="col-form-label">REDE WIFI ATUAL:</label>
                            <input type="text" name="rede" id="rede" maxlength="50" class="form-control -10">
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label for="recipient-rua" class="col-form-label">SENHA WIFI ATUAL:</label>
                            <input type="text" name="redesenha" id="redesenha" maxlength="50" class="form-control -10">
                        </div>
                    <div class="col-md-3 col-sm-12">
                            <label for="recipient-numero" class="col-form-label">PLANO</label>
                            :
                            <select class="form-control form-select-lg mb-5 select2" name="plano" id="plano" aria-label=".form-select-lg example">
                                <option value="30 MEGA">30 MEGA</option>                            
                                <option value="110 MEGA">110 MEGA</option>
                                <option value="200 MEGA">200 MEGA</option>
                                <option value="310 MEGA">310 MEGA</option>
                                <option value="510 MEGA">510 MEGA</option>
                                <option value="710 MEGA">710 MEGA</option>

                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <label for="recipient-operador" class="col-form-label cli">ATENDENTE:</label>
                            <input type="text" name="operador" id="operador" maxlength="50" class="form-control" disabled value="<?php echo $_SESSION['usuarioNome'] ?>">
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label for="recipient-dataCadastro" class="col-form-label">DATA DO CADASTRO:</label>
                            <input type="text" class="form-control" value="<?php echo date('d/m/Y - H:i:s') ?>" disabled>
                        </div>
                        <div class="col-md-4 col-sm-12">

 <label for="recipient-status" class="col-form-label">SITUAÇÃO</label>
<input type="text" name="status" id="status" maxlength="50" class="form-control" value="A LANÇAR" >


                            </select>
</div>
                        </div>
                    
                  <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary" id="btn-cadastrar">Salvar</button>
</div>
            </div>

            </form>


        </div>
    </div>
</div>


<!-- -----------------------------------MODAL VISUALIZAR CLIENTE----------------------------------------------------------------->
<div class="modal fade" id="visulaizarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <label for="recipient-nome" class="col-form-label">NOME</label>
                            <input type="text" class="form-control" id="recipient-nome" disabled>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <label for="recipient-situacao" class="col-form-label">SITUACAO</label>
                            <input type="text" class="form-control" id="recipient-situacao" disabled>
                        </div>
                    
                    <div class="col-md-4 col-sm-12">
                            <label for="recipient-veiculo" class="col-form-label">SINAL</label>
                            <input type="text" name="veiculo" id="recipient-veiculo" maxlength="50" class="form-control -10" disabled>
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
                        <div class="col-md-8 col-sm-12">
                            <label for="recipient-tecnico" class="col-form-label">OBSERVACAO</label>
                            <input type="text" name="observacao" id="recipient-observacao" maxlength="50" class="form-control" disabled>
                        </div>
                        
                        <div class="col-md-4 col-sm-12">
                            <label for="recipient-plano" class="col-form-label">PLANO</label>
                            <input type="text" name="plano" id="recipient-plano" maxlength="50" class="form-control -10" disabled>
                        </div>
</div>

                    
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <label for="recipient-operador" class="col-form-label cli">CADASTRADO POR</label>
                            <input type="text" name="operador" id="recipient-operador" maxlength="50" class="form-control" disabled>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label for="recipient-dataCadastro" class="col-form-label">DATA DO CADASTRO</label>
                            <input type="text" class="form-control" id="recipient-dataCadastro" disabled>
                        </div>

                        
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <label for="recipient-alterado_por" class="col-form-label cli">ALTERADO POR</label>
                            <input type="text" name="alterado_por" id="recipient-alterado_por" maxlength="50" class="form-control" disabled>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label for="recipient-ultima_alteracao" class="col-form-label">ÚLTIMA ALTERAÇÃO</label>
                            <input type="text" class="form-control" name="ultima_alteracao" id="recipient-ultima_alteracao" disabled>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="processa_edit_cameras.php" enctype="multipart/form-data">



                    <div class="row">
                        <div class="col-md-10 col-sm-12">
                            <label for="recipient-tecnico" class="col-form-label">TECNICOS</label>
                            <input type="text" name="tecnico" id="recipient-tecnico" maxlength="50" class="form-control">
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <label for="recipient-veiculo" class="col-form-label">VEICULO</label>
                            <select class="form-control form-select-lg mb-5 select2" name="veiculo" id="veiculo" aria-label=".form-select-lg example">
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
                            <select class="form-control form-select-lg mb-5 select2" name="status" id="status" aria-label=".form-select-lg example">
                                <option value="<button type='button' class='btn btn-primary btn-sm'> andamento</button>">EM ANDAMENTO</option>
                                <option value="<button type='button' class='btn btn-danger btn-sm' >remarcar</button>">REMARCAR</option>
                                <option value="<button type='button' class='btn btn-success btn-sm' >concluido</button>">CONCLUIDO</option>

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
                            <select class="form-control form-select-lg mb-5 select2" name="concluido" id="concluido" aria-label=".form-select-lg example">
                                <option value="NAO">NAO</option>
                                <option value="SIM">SIM</option>          
                            </select>

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
                    $.post('busca_cameras.php', dados, function(retorna) {
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

