<?php
session_start();
include_once('assets/cabecalho.php');
include('config/conexao.php');
include_once("config/seguranca.php");
seguranca_adm();
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$dataLocal = date('d/m/Y H:i:s', time());

// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
?>

<div class="navbar-collapse offcanvas-collapse bg-light" id="navbarsExampleDefault">
  <ul class="navbar-nav mr-auto">
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
  </ul>
</div>
<?php include_once('assets/menu.php'); ?>
<main class="container">

  <div class="bg-body-tertiary p-5 rounded mt-3"> 
    <form method="POST" enctype="multipart/form-data" action="processa_add_produto_lojafrente.php">
      <div class="row">
      <div class="col-md-4">
        <label for="exampleFormControlInput1"  class="col-form-label">PRODUTO:</label>
        <input type="text" class="form-control" id="produto" name="produto" value="">
      </div>
      <div class="col-md-2">
        <label for="exampleFormControlInput1" name="email"  class="col-form-label">QUANTIDADE:</label>
        <input type="text" class="form-control" name="quantidade" value="">
      </div>
      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button class="btn btn-primary me-md-2" name="submit" type="submit">CADASTRAR</button>
      </div>

</div>
      

    </form>

  </div>
</div>
</main>
<?php
include_once('assets/rodape.php');
?>
