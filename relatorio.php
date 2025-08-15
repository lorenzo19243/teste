<?php
session_start();
include_once('assets/cabecalho.php');
include('config/conexao.php');
include 'functions.php';
include_once("config/seguranca.php");
seguranca_adm();
$consulta = "SELECT * FROM clientes WHERE concluido = 'NAO' ORDER BY ultima_alteracao DESC ; ";
$resultado = mysqli_query($conn, $consulta);
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$dataLocal = date('d/m/Y H:i:s', time());

// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
?>
<style>
.card-columns {
  @include media-breakpoint-only(lg) {
    column-count: 4;
  }
</style>
<?php include_once('assets/menu.php'); ?>

<div class="navbar-collapse offcanvas-collapse bg-light" id="navbarsExampleDefault">
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

if (isset($_GET['mes']))
    $mes_hoje = $_GET['mes'];
else
    $mes_hoje = date('m');

if (isset($_GET['ano']))
    $ano_hoje = $_GET['ano'];
else
    $ano_hoje = date('Y');
?>


<div class="container-sm">
 <div class="row">
  <div class="row g-3 align-items-center ">
      <div class="col-md-4"></div>
  <div class="col-auto">
    <label for="inputPassword6" class="col-form-label">SELECIONE O ANO:</label>
  </div>
  <div class="col-auto">
  </div>
  <div class="col-auto">
<select class="form-select" aria-label=".form-select-lg example" onchange="location.replace('?mes=<?php echo $mes_hoje?>&ano='+this.value)">
<?php
for ($i=2024;$i<=2026;$i++){
?>
<option class="datatable-selector" value="<?php echo $i?>" <?php if ($i==$ano_hoje) echo "selected=selected"?> ><?php echo $i?></option>
<?php }?>
</select> 
  </div>
</div>  
</div>
  
<div class="row g-3 align-items-center ">
<ul class="nav nav-pills mb-3 " id="pills-tab" role="tablist">
    <?php

$mes_hoje = date('m');

for ($i=1;$i<=13;$i++){
	?>
<?php if ($i!=12) echo ""?> 


<li class="nav-item">
    <a  id="pills-home-tab" data-toggle="pill" href="#pills-<?php echo $i?>" role="tab" aria-controls="pills-<?php echo $i?>"  class="nav-link <?php if($mes_hoje==$i){?>active">
  
    
    
    
    <?php }else{?>
">

    <?php }?>
    
    <?php echo mostraMes($i);?>
    </a></li>
<?php
}
?>
  </li>
</ul>
</div>
<div class="tab-content" id="pills-tabContent">
<div class="tab-pane fade show active" id="pills-1" role="tabpanel" aria-labelledby="pills-1-tab">
    
<div class="row g-1 justify-content-evenly ">
  <div class="card text-white bg-primary mb-3" style="max-width: 16rem;">
  <div class="card-header">REPAROS EM JANEIRO</div>
  <div class="card-body">
    <h1 class="card-title"><?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE MONTH(data_fim)="01" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?> </h1>
    <p class="card-text">REPAROS CONCLUIDOS</p>
  </div>
</div>
  <div class="card text-white bg-success mb-3" style="max-width: 16rem;">
  <div class="card-header">INSTAL. EM JANEIRO</div>
  <div class="card-body">
    <h1 class="card-title"><?php $clientes = mysqli_query($conn,'SELECT * FROM instalacoes WHERE MONTH(data_fim)="01" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?></h1>
    <p class="card-text">INSTAL. CONCLUIDAS</p>
  </div>
</div>
  <div class="card text-white bg-warning mb-3" style="max-width: 16rem;">
  <div class="card-header">MUDANÇAS EM JANEIRO</div>
  <div class="card-body">
    <h1 class="card-title"><?php $clientes = mysqli_query($conn,'SELECT * FROM mudanca WHERE MONTH(data_fim)="01" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?></h1>
    <p class="card-text">MUDANÇAS CONCLUIDAS</p>
  </div>
</div>
   <div class="card text-white bg-danger mb-3" style="max-width: 16rem;">
  <div class="card-header">RECOLHAS EM JANEIRO</div>
  <div class="card-body">
    <h1 class="card-title"><?php $clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE MONTH(data_fim)="01" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?></h1>
    <p class="card-text">RECOLHAS CONCLUIDAS</p>
  </div>
</div>
 <div class="card text-white bg-secondary mb-3" style="max-width: 16rem;">
  <div class="card-header">TOTAL DE CHAMADOS</div>
  <div class="card-body">
    <h1 class="card-title"><?php $result=mysqli_query($conn, 'SELECT (SELECT COUNT(*) FROM clientes WHERE MONTH(data_fim)="01" AND concluido="SIM") +
    (SELECT COUNT(*) FROM instalacoes WHERE MONTH(data_fim)="01" AND concluido="SIM") +
    (SELECT COUNT(*) FROM mudanca WHERE MONTH(data_fim)="01" AND concluido="SIM") +
    (SELECT COUNT(*) FROM recolhas WHERE MONTH(data_fim)="01" AND concluido="SIM") AS total;');
	
$data=mysqli_fetch_assoc($result);
echo $data['total']; ?></h1>
    <p class="card-text">TOTAL DE CHAMADOS CONCLUIDOS</p>
  </div>
</div>
</div>
</div>
<div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab"><div class="row g-1 justify-content-evenly ">
  <div class="card text-white bg-primary mb-3" style="max-width: 16rem;">
  <div class="card-header">REPAROS EM FEVEREIRO</div>
  <div class="card-body">
    <h1 class="card-title"><?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE MONTH(data_fim)="02" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?> </h1>
    <p class="card-text">REPAROS CONCLUIDOS</p>
  </div>
</div>
  <div class="card text-white bg-success mb-3" style="max-width: 16rem;">
  <div class="card-header">INSTAL. EM JANEIRO</div>
  <div class="card-body">
    <h1 class="card-title"><?php $clientes = mysqli_query($conn,'SELECT * FROM instalacoes WHERE MONTH(data_fim)="02" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?></h1>
    <p class="card-text">INSTAL. CONCLUIDAS</p>
  </div>
</div>
  <div class="card text-white bg-warning mb-3" style="max-width: 16rem;">
  <div class="card-header">MUDANÇAS EM JANEIRO</div>
  <div class="card-body">
    <h1 class="card-title"><?php $clientes = mysqli_query($conn,'SELECT * FROM mudanca WHERE MONTH(data_fim)="02" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?></h1>
    <p class="card-text">MUDANÇAS CONCLUIDAS</p>
  </div>
</div>
   <div class="card text-white bg-danger mb-3" style="max-width: 16rem;">
  <div class="card-header">RECOLHAS EM JANEIRO</div>
  <div class="card-body">
    <h1 class="card-title"><?php $clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE MONTH(data_fim)="02" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?></h1>
    <p class="card-text">RECOLHAS CONCLUIDAS</p>
  </div>
</div>
 <div class="card text-white bg-secondary mb-3" style="max-width: 16rem;">
  <div class="card-header">TOTAL DE CHAMADOS</div>
  <div class="card-body">
    <h1 class="card-title"><?php $result=mysqli_query($conn, 'SELECT (SELECT COUNT(*) FROM clientes WHERE MONTH(data_fim)="02" AND concluido="SIM") +
    (SELECT COUNT(*) FROM instalacoes WHERE MONTH(data_fim)="02" AND concluido="SIM") +
    (SELECT COUNT(*) FROM mudanca WHERE MONTH(data_fim)="02" AND concluido="SIM") +
    (SELECT COUNT(*) FROM recolhas WHERE MONTH(data_fim)="02" AND concluido="SIM") AS total;');
	
$data=mysqli_fetch_assoc($result);
echo $data['total']; ?></h1>
    <p class="card-text">TOTAL DE CHAMADOS CONCLUIDOS</p>
  </div>
</div>
</div></div>
<div class="tab-pane fade" id="pills-3" role="tabpanel" aria-labelledby="pills-3-tab">...</div>
  <div class="tab-pane fade" id="pills-4" role="tabpanel" aria-labelledby="pills-4-tab">...</div>
  <div class="tab-pane fade" id="pills-5" role="tabpanel" aria-labelledby="pills-5-tab">...</div>
  <div class="tab-pane fade" id="pills-6" role="tabpanel" aria-labelledby="pills-6-tab">...</div>
  <div class="tab-pane fade" id="pills-7" role="tabpanel" aria-labelledby="pills-7-tab">...</div>
  <div class="tab-pane fade" id="pills-8" role="tabpanel" aria-labelledby="pills-8-tab">...</div>
  <div class="tab-pane fade" id="pills-9" role="tabpanel" aria-labelledby="pills-9-tab">...</div>
  <div class="tab-pane fade" id="pills-10" role="tabpanel" aria-labelledby="pills-10-tab">
  
 <div class="row g-1 justify-content-evenly ">
  <div class="card text-white bg-primary mb-3" style="max-width: 16rem;">
  <div class="card-header">REPAROS EM OUTUBRO</div>
  <div class="card-body">
    <h1 class="card-title"><?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE MONTH(data_fim)="10" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?> </h1>
    <p class="card-text">REPAROS CONCLUIDOS</p>
  </div>
</div>
  <div class="card text-white bg-success mb-3" style="max-width: 16rem;">
  <div class="card-header">INSTAL. EM OUTUBRO</div>
  <div class="card-body">
    <h1 class="card-title"><?php $clientes = mysqli_query($conn,'SELECT * FROM instalacoes WHERE MONTH(data_fim)="10" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?></h1>
    <p class="card-text">INSTAL. CONCLUIDAS</p>
  </div>
</div>
  <div class="card text-white bg-warning mb-3" style="max-width: 16rem;">
  <div class="card-header">MUDANÇAS EM OUTUBRO</div>
  <div class="card-body">
    <h1 class="card-title"><?php $clientes = mysqli_query($conn,'SELECT * FROM mudanca WHERE MONTH(data_fim)="10" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?></h1>
    <p class="card-text">MUDANÇAS CONCLUIDAS</p>
  </div>
</div>
   <div class="card text-white bg-danger mb-3" style="max-width: 16rem;">
  <div class="card-header">RECOLHAS EM OUTUBRO</div>
  <div class="card-body">
    <h1 class="card-title"><?php $clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE MONTH(data_fim)="10" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?></h1>
    <p class="card-text">RECOLHAS CONCLUIDAS</p>
  </div>
</div>
 <div class="card text-white bg-secondary mb-3" style="max-width: 16rem;">
  <div class="card-header">TOTAL DE CHAMADOS</div>
  <div class="card-body">
    <h1 class="card-title"><?php $result=mysqli_query($conn, 'SELECT (SELECT COUNT(*) FROM clientes WHERE MONTH(data_fim)="10" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM") +
    (SELECT COUNT(*) FROM instalacoes WHERE MONTH(data_fim)="10" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM") +
    (SELECT COUNT(*) FROM mudanca WHERE MONTH(data_fim)="10" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM") +
    (SELECT COUNT(*) FROM recolhas WHERE MONTH(data_fim)="10" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM") AS total;');
	
$data=mysqli_fetch_assoc($result);
echo $data['total']; ?></h1>
    <p class="card-text">TOTAL DE CHAMADOS CONCLUIDOS</p>
  </div>
</div>
</div> 
  </div>
  <div class="tab-pane fade" id="pills-11" role="tabpanel" aria-labelledby="pills-11-tab">
<div class="row g-1 justify-content-evenly ">
  <div class="card text-white bg-primary mb-3" style="max-width: 16rem;">
  <div class="card-header">REPAROS EM NOVEMBRO</div>
  <div class="card-body">
    <h1 class="card-title"><?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE MONTH(data_fim)="11" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?> </h1>
    <p class="card-text">REPAROS CONCLUIDOS</p>
  </div>
</div>
  <div class="card text-white bg-success mb-3" style="max-width: 16rem;">
  <div class="card-header">INSTAL. EM NOVEMBRO</div>
  <div class="card-body">
    <h1 class="card-title"><?php $clientes = mysqli_query($conn,'SELECT * FROM instalacoes WHERE MONTH(data_fim)="11" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?></h1>
    <p class="card-text">INSTAL. CONCLUIDAS</p>
  </div>
</div>
  <div class="card text-white bg-warning mb-3" style="max-width: 16rem;">
  <div class="card-header">MUDAN. EM NOVEMBRO</div>
  <div class="card-body">
    <h1 class="card-title"><?php $clientes = mysqli_query($conn,'SELECT * FROM mudanca WHERE MONTH(data_fim)="11" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?></h1>
    <p class="card-text">MUDANÇAS CONCLUIDAS</p>
  </div>
</div>
   <div class="card text-white bg-danger mb-3" style="max-width: 16rem;">
  <div class="card-header">RECOLHAS EM NOVEMBRO</div>
  <div class="card-body">
    <h1 class="card-title"><?php $clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE MONTH(data_fim)="11" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?></h1>
    <p class="card-text">RECOLHAS CONCLUIDAS</p>
  </div>
</div>
 <div class="card text-white bg-secondary mb-3" style="max-width: 16rem;">
  <div class="card-header">TOTAL DE CHAMADOS</div>
  <div class="card-body">
    <h1 class="card-title"><?php $result=mysqli_query($conn, 'SELECT (SELECT COUNT(*) FROM clientes WHERE MONTH(data_fim)="11" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM") +
    (SELECT COUNT(*) FROM instalacoes WHERE MONTH(data_fim)="11" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM") +
    (SELECT COUNT(*) FROM mudanca WHERE MONTH(data_fim)="11" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM") +
    (SELECT COUNT(*) FROM recolhas WHERE MONTH(data_fim)="11" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM") AS total;');
	
$data=mysqli_fetch_assoc($result);
echo $data['total']; ?></h1>
    <p class="card-text">TOTAL DE CHAMADOS CONCLUIDOS</p>
  </div>
</div>
</div> 
</div>
  <div class="tab-pane fade" id="pills-12" role="tabpanel" aria-labelledby="pills-12-tab"> 
  <div class="row g-1 justify-content-evenly ">
  <div class="card text-white bg-primary mb-3" style="max-width: 16rem;">
  <div class="card-header">REPAROS EM DEZEMBRO</div>
  <div class="card-body">
    <h1 class="card-title"><?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE MONTH(data_fim)="12" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?> </h1>
    <p class="card-text">REPAROS CONCLUIDOS</p>
  </div>
</div>
  <div class="card text-white bg-success mb-3" style="max-width: 16rem;">
  <div class="card-header">INSTAL. EM DEZEMBRO</div>
  <div class="card-body">
    <h1 class="card-title"><?php $clientes = mysqli_query($conn,'SELECT * FROM instalacoes WHERE MONTH(data_fim)="12" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?></h1>
    <p class="card-text">INSTAL. CONCLUIDAS</p>
  </div>
</div>
  <div class="card text-white bg-warning mb-3" style="max-width: 16rem;">
  <div class="card-header">MUDAN. EM DEZEMBRO</div>
  <div class="card-body">
    <h1 class="card-title"><?php $clientes = mysqli_query($conn,'SELECT * FROM mudanca WHERE MONTH(data_fim)="12" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?></h1>
    <p class="card-text">MUDANÇAS CONCLUIDAS</p>
  </div>
</div>
   <div class="card text-white bg-danger mb-3" style="max-width: 16rem;">
  <div class="card-header">RECOLHAS EM DEZEMBRO</div>
  <div class="card-body">
    <h1 class="card-title"><?php $clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE MONTH(data_fim)="12" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf("%d", $row_cnt);				
 ?></h1>
    <p class="card-text">RECOLHAS CONCLUIDAS</p>
  </div>
</div>
 <div class="card text-white bg-secondary mb-3" style="max-width: 16rem;">
  <div class="card-header">TOTAL DE CHAMADOS</div>
  <div class="card-body">
    <h1 class="card-title"><?php $result=mysqli_query($conn, 'SELECT (SELECT COUNT(*) FROM clientes WHERE MONTH(data_fim)="12" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM") +
    (SELECT COUNT(*) FROM instalacoes WHERE MONTH(data_fim)="12" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM") +
    (SELECT COUNT(*) FROM mudanca WHERE MONTH(data_fim)="12" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM") +
    (SELECT COUNT(*) FROM recolhas WHERE MONTH(data_fim)="12" AND YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM") AS total;');
	
$data=mysqli_fetch_assoc($result);
echo $data['total']; ?></h1>
    <p class="card-text">TOTAL DE CHAMADOS CONCLUIDOS</p>
  </div>
</div>
</div>
</div>
  <div class="tab-pane fade" id="pills-13" role="tabpanel" aria-labelledby="pills-13-tab"> 
<div class="row g-1 justify-content-evenly ">
  <div class="card text-white bg-primary mb-3" style="max-width: 16rem;">
  <div class="card-header">REPAROS TOTAIS</div>
  <div class="card-body">
    <h1 class="card-title"><?php $clientes = mysqli_query($conn,'SELECT * FROM clientes WHERE YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf(" %d", $row_cnt);				
 ?></h1>
    <p class="card-text">REPAROS CONCLUIDOS</p>
  </div>
</div>
  <div class="card text-white bg-success mb-3" style="max-width: 16rem;">
  <div class="card-header">INSTALAÇÕES TOTAIS</div>
  <div class="card-body">
    <h1 class="card-title"><?php $clientes = mysqli_query($conn,'SELECT * FROM instalacoes WHERE YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf(" %d", $row_cnt);				
 ?></h1>
    <p class="card-text">INSTALAÇÕES CONCLUIDAS</p>
  </div>
</div>
  <div class="card text-white bg-warning mb-3" style="max-width: 16rem;">
  <div class="card-header">MUDANÇAS TOTAIS</div>
  <div class="card-body">
    <h1 class="card-title"><?php $clientes = mysqli_query($conn,'SELECT * FROM mudanca WHERE YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf(" %d", $row_cnt);				
 ?></h1>
    <p class="card-text">MUDANÇAS CONCLUIDAS</p>
  </div>
</div>
   <div class="card text-white bg-danger mb-3" style="max-width: 16rem;">
  <div class="card-header">RECOLHAS TOTAIS</div>
  <div class="card-body">
    <h1 class="card-title"><?php $clientes = mysqli_query($conn,'SELECT * FROM recolhas WHERE YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM" ORDER BY nome DESC;');
				
$row_cnt = mysqli_num_rows($clientes);

printf(" %d", $row_cnt);				
 ?></h1>
    <p class="card-text">RECOLHAS CONCLUIDAS</p>
  </div>
</div>
 <div class="card text-white bg-secondary mb-3" style="max-width: 16rem;">
  <div class="card-header">TOTAL DE CHAMADOS</div>
  <div class="card-body">
    <h1 class="card-title"><?php $result=mysqli_query($conn, 'SELECT (SELECT COUNT(*) FROM clientes  WHERE YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM") +
    (SELECT COUNT(*) FROM instalacoes WHERE YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM") +
    (SELECT COUNT(*) FROM mudanca WHERE YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM") +
    (SELECT COUNT(*) FROM recolhas WHERE YEAR(data_fim)="'.$ano_hoje.'" AND concluido="SIM") AS total;');
	
$data=mysqli_fetch_assoc($result);
echo $data['total']; ?></h1>
    <p class="card-text">TOTAL DE CHAMADOS CONCLUIDOS</p>
  </div>
</div>
 
 </div>
</div>
</div>
</div>
<div class="container">
  <div class="row">
    <div class="col">
      
    </div>
    <div class="badge  text-wrap">

<a  class="btn btn-secondary" target="_blank" href="pdf">
IMPRIMIR
</a>
</div>
</div>
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
