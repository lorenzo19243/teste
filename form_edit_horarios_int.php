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
    <h6 class="border-bottom pb-2 mb-0">Alterar horarios:</h6>
        
    <div class="d-flex text-body-secondary pt-3">
      <p class="pb-3 mb-0 small lh-sm border-bottom">
        <strong class="d-block text-gray-dark"></strong>
        
      </p>
      

<?php

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//var_dump($dados);
?>

      <?php

    if (!empty($dados['tecnicos'])) {
        // Recuperar os ID dos usuario e converter e uma string
        $valor_pesq = implode(", ", $dados['tecnicos']);
        //var_dump($valor_pesq);

        // Recuperar os usuarios do banco de dados
        $query_usuarios = "SELECT id, tecnicos, semana
                    FROM horarios 
                    WHERE id IN ($valor_pesq)";

        // Preparar a QUERY                    
        $result_usuarios = $con->prepare($query_usuarios);

        // Executar a QUERY
        $result_usuarios->execute();

        echo "";

        // Inicio do formulario
        echo "<form method='POST' action='processa_edit_horarios_int.php'>";

        // Ler os registros retornado do BD
        while ($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)) {
            //var_dump($row_usuario);
            extract($row_usuario);
            echo "<input type='hidden' name='id[]' value='$id'>";
            echo "TECNICOS: <input type='text' name='tecnicos[]' value='$tecnicos' placeholder='Nome do usuário'><br><br>";
            echo "HORARIO: <input type='text' name='semana[]' value='$semana' placeholder=''><br><br>";
            echo "<hr>";
        }

        echo "<input type='submit' value='Editar' name='editUsuarios'>";

        // Fim do formulario
        echo "</form>";
    } else {
        // Variavel global com a mensagem de sucesso
        $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não editado com sucesso!</p>";

        // Redirecionar o usuario para a pagina inicial
        header("Location: horarios.php");
    }
    ?>

    </div>

  </div>

</main>
<?php
include_once('assets/rodape.php');
?>