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
?>
<main class="container">
  
        
  
  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-0">HORARIOS DA SEMANA EXTERNOS:</h6>
    <?php

    // Verificar se existe a mensagem
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    } ?>    
    <div class="d-flex text-body-secondary pt-3">
      <p class="pb-3 mb-0 small lh-sm border-bottom">
        <strong class="d-block text-gray-dark">    </strong>
        
      </p>
      

    <?php


    //Criar a QUERY para recuperar os usuarios
    $query_usuarios = "SELECT id, tecnicos, semana  FROM horarios WHERE local='plantao'";

    //Preparar a QUERY
    $result_usuarios = $con->prepare($query_usuarios);

    //Executar a QUERY
    $result_usuarios->execute();

    //Inicio do formulario
    echo "<form method='POST' action='form_edit_horarios_plantao.php'>";

    // Ler os registros retornado do BD
    while ($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)) {
        //var_dump($row_usuario);
        extract($row_usuario);
        echo "<input type='checkbox' name='tecnicos[$id]' value='$id' id='tecnicos'>";
        echo "ID: $id <br>";
        echo "TECNICOS: $tecnicos <br>";
        echo "PLANTAO: $semana <br>";
        echo "<br>";
    }
    echo "<input onclick=\"toggle(this);\" type=\"checkbox\" /> select all<br>";
    echo "<input type='submit' value='Editar' name='editUsuarios'>";

    //Fim do formulario
    echo "</form>";
    ?>

    </div>

  </div>
<script language="JavaScript">
function toggle(source) {
var checkboxes = document.querySelectorAll('input[type="checkbox"]');
for (var i = 0; i < 7; i++) {
if (checkboxes[i] != source)
checkboxes[i].checked = source.checked;
}
}

</script>

</main>
<?php
include_once('assets/rodape.php');
?>