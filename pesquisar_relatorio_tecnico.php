<?php
session_start();
include_once('assets/cabecalho.php');
include('config/conexao.php');
include_once("config/seguranca.php");
seguranca_adm();

?>

<div class="navbar-collapse offcanvas-collapse bg-dark" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>

        </ul>
      </div>
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
    <div class="col-md-4 bg-dark justify-content-between p-3">
    </div>
    <div class="col-md-4 bg-dark justify-content-between p-3">
      <form class="row g-5" method="POST" action="pesquisar_relatorio_tecnico.php">
     <select id="pesquisar" name="pesquisar" class="selectpicker form-control" multiple aria-label="size 3 select example" required>
    <option value="ADRIANO">ADRIANO</option>
    <option value="BRUNO">BRUNO</option>
    <option value="EDUARDO">EDUARDO</option>
    <option value="EMERSON">EMERSON</option>
    <option value="DOUGLAS">DOUGLAS</option>
    <option value="LEANDRO">LEANDRO</option>
    <option value="LUIS">LUIS</option>
    <option value="MIGUEL">MIGUEL</option>
<option value="UELITON">UELITON</option>
<option value="UALAS">UALAS</option>
<option value="JOSEVAN">JOSEVAN</option>
<option value="KALEBHE">KALEBHE</option>
<option value="JEFFERSON">JEFFERSON</option>
<option value="WENDEL">WENDEL</option>
<option value="CARLEAN">CARLEAN</option>
<option value="ETEVALDO">ETEVALDO</option>
<option value="HELBER">HELBER</option>
<option value="ERIK">ERIK</option>
<option value="HENRIQUE">HENRIQUE</option>
<option value="MANOEL">MANOEL</option>
<option value="ALAN">ALAN</option>
<option value="RENANTO">RENATO</option>
<option value="YAN">YAN</option>
            </select> 
            
        </div>
        <div class="col-md-4 bg-dark justify-content-between p-3">
        <button type="submit" class="btn btn-primary mb-3">PESQUISAR</button>  
        </div></form>
    </div>
    </div>
<div class="container-sm">
<body>
<div class="modal-body">
</br>  


<?php 
$pesquisar = $_POST['pesquisar'];

?> 

<div class="alert alert-primary" role="alert">
  RELATORIO GERAL DO TECNICO <?php echo $pesquisar ?> !
</div>

<div class="modal-body">
  <div class="col-sm-12 mb-3 mb-sm-0" id="pills-geral" role="tabpanel" aria-labelledby="pills-geral-tab"> 
  <div class="card-group">
  <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
  <div class="card-header"><?php echo $pesquisar ?> CONCLUIU</div>
  <div class="card-body">
    <h1 class="card-title"><?php 
$busca = mysqli_query($conn,'SELECT * FROM clientes WHERE concluido="SIM" AND tecnico LIKE "%'.$pesquisar.'%"');
				$row_cnt = mysqli_num_rows($busca);

printf("%d", $row_cnt); ?> </h1>
    <p class="card-text">REPAROS</p>
  </div>
</div>
  <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
  <div class="card-header"><?php echo $pesquisar ?> CONCLUIU</div>
  <div class="card-body">
    <h1 class="card-title"><?php 
$busca = mysqli_query($conn,'SELECT * FROM instalacoes WHERE concluido="SIM" AND tecnico LIKE "%'.$pesquisar.'%"');
				$row_cnt = mysqli_num_rows($busca);

printf("%d", $row_cnt); ?></h1>
    <p class="card-text">INSTALAÇÕES</p>
  </div>
</div>
  <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
  <div class="card-header"><?php echo $pesquisar ?> CONCLUIU</div>
  <div class="card-body">
    <h1 class="card-title"><?php 
$busca = mysqli_query($conn,'SELECT * FROM mudanca WHERE concluido="SIM" AND tecnico LIKE "%'.$pesquisar.'%"');
				$row_cnt = mysqli_num_rows($busca);

printf("%d", $row_cnt); ?></h1>
    <p class="card-text">MUDANÇAS</p>
  </div>
</div>
  <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
  <div class="card-header"><?php echo $pesquisar ?> CONCLUIU</div>
  <div class="card-body">
    <h1 class="card-title"><?php 
$busca = mysqli_query($conn,'SELECT * FROM cameras WHERE concluido="SIM" AND tecnico LIKE "%'.$pesquisar.'%"');
				$row_cnt = mysqli_num_rows($busca);

printf("%d", $row_cnt); ?></h1>
    <p class="card-text">CAMERAS</p>
  </div>
</div>
   <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
  <div class="card-header"><?php echo $pesquisar ?> CONCLUIU</div>
  <div class="card-body">
    <h1 class="card-title"><?php 
$busca = mysqli_query($conn,'SELECT * FROM recolhas WHERE concluido="SIM" AND tecnico LIKE "%'.$pesquisar.'%"');
				$row_cnt = mysqli_num_rows($busca);

printf("%d", $row_cnt); ?></h1>
    <p class="card-text">RECOLHAS</p>
  </div>
</div>
 <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
  <div class="card-header"><?php echo $pesquisar ?> CONCLUIU</div>
  <div class="card-body">
    <h1 class="card-title"><?php $result=mysqli_query($conn, "SELECT (SELECT COUNT(*) FROM clientes WHERE concluido = 'SIM' AND tecnico LIKE '%".$pesquisar."%') +
    (SELECT COUNT(*) FROM instalacoes WHERE concluido = 'SIM' AND tecnico LIKE '%".$pesquisar."%') +
    (SELECT COUNT(*) FROM mudanca WHERE concluido = 'SIM' AND tecnico LIKE '%".$pesquisar."%') +
    (SELECT COUNT(*) FROM cameras WHERE concluido = 'SIM' AND tecnico LIKE '%".$pesquisar."%') +
    (SELECT COUNT(*) FROM recolhas WHERE concluido='SIM' AND tecnico LIKE '%".$pesquisar."%' ) AS total;");
	
$data=mysqli_fetch_assoc($result);
echo $data['total']; ?></h1>
    <p class="card-text">TOTAL DE CHAMADOS</p>
  </div>
</div>

  </div>
</div>        
        
   </div>
</div>       
        
  </div>
</div>    
<?php
include_once('assets/rodape.php');
?>
<script src="bootstrap-select.min.js"></script>
<link rel="stylesheet" href="bootstrap-select.min.css" />