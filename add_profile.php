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
    <form method="POST" enctype="multipart/form-data" action="processa_cad_usuarios.php">
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col"> </div>
        <div class="card" style="width: 18rem;"> </div>
        <div class="col"> </div>
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">NOME:</label>
        <input type="text" class="form-control" id="nome" name="nome" value="">
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput1" name="email" class="form-label">EMAIL</label>
        <input type="text" class="form-control" name="email" value="">
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput1" name="email" class="form-label">DATA NASCIMENTO</label>
        <input type="date" class="form-control" name="nasc" value="">
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput1" name="email" class="form-label">TELEFONE</label>
        <input type="text" class="form-control" name="fone" value="">
      </div>
      
      <div class="mb-3">

</div>
      
      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button class="btn btn-primary me-md-2" name="submit" type="submit">ALTERAR</button>
      </div>
    </form>

  </div>
</div>
</main>
<?php
include_once('assets/rodape.php');
?>
