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
    <div class="container">
<div class="navbar-collapse offcanvas-collapse bg-light" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <br>
            <br>
            <br>
            <br>
            <br>
        </ul>
      </div>

    
<div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
  <div class="row g-3 align-items-center "><div class="d-flex gap-2 justify-content-center py-5">
  <div class="col-auto">
    <label for="inputPassword6" class="col-form-label">SELECIONE O TIPO:</label>
  </div>
  <div class="col-auto">
<select class="form-select" aria-label=".form-select-lg example" onchange="location.replace('?tipo='+this.value)">
              <option value="">selecione...</option>
              <option value="roteador" >ROTEADOR</option>
              <option value="onu">ONU</option>
              <option value="timer">TIMER</option>
              <option value="camera">CAMERA</option>
              <option value="tvbox">BOX</option>
              <option value="controle_tvbox">CONTOLE BOX</option>
              <option value="fonte_tvbox">FONTE BOX</option>
              <option value="conversor_tvbox">CONVERSOR BOX</option>
</select>       
  </div> <a class="btn btn-primary me-md-2"  data-toggle="modal" data-target="#entradaestoque">ENTRADA</a>

<a class="btn btn-primary me-md-2"  data-toggle="modal" data-target="#saidaestoque">SAIDA</a>
<a class="btn btn-primary me-md-2"  href="add_produto.php">ADD NOVO PRODUTO</a>
  
</div>
</div>  
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


if (isset($_GET['tipo']))
    $tipo = $_GET['tipo'];
?>

<div class="row mb-2">
<?php
$consulta = "SELECT * FROM hb_estoque WHERE tipo='$tipo'";
$result = mysqli_query($conn, $consulta);


			
$contar = mysqli_num_rows($result);

if ($contar == 0)
{
echo "<div class='alert alert-success alert-dismissible fade show text text-center mb-0' role='alert'>
                                
                                <strong> NENHUMA CADASTRADA NO MOMENTO!  </strong> 
                                    
                                
                        </div>";
}
else
{
echo ' ';
}


?>
  
    <div class="col-md-12">
    
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">PRODUTO</th>
      <th scope="col">QUANTIDADE</th>
      <th scope="col">TIPO</th>
      <th scope="col">CONF</th>

      <th scope="col" colspan="3" width="4%">AÇÕES</th>
    </tr>
  </thead>
  <tbody> <?php 
    while ($linha = mysqli_fetch_array($result)) {
        $id = $linha['id'];
		$produto = $linha['produto'];
		$quantidade = $linha['quantidade'];
		$tipo = $linha['tipo'];
    ?> 
    <tr>
      <th scope="row"><?php echo $linha['id'] ?></th>
      <td><?php echo $linha['produto']; ?></td>
      <td><?php echo $linha['quantidade']; ?></td>
      <td><?php echo $linha['tipo']; ?></td>
      <td><?php echo $linha['conferencia']; ?></td>
      <td>           
 </td><td>            
</td><td> <a href="processa_excluir_estoque.php?id=<?php echo $linha['id']; ?>&produto=<?php echo $linha['produto']; ?>" onClick="return confirm('Deseja realmente deletar do estoque <?php echo $linha['produto']; ?> ?')" class="accordion-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
</svg></a></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
</div>
</div> 
</div>
</div> 
<div class="modal fade" id="entradaestoque" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">ENTRADA DE ESTOQUE<strong>
                       <form method="POST" action="add_entrada_estoque.php" enctype="multipart/form-data">                     
                       <div class="row">
 <div class="col-md-6 col-sm-12">
          <label for="recipient-urgente" class="col-form-label">PRODUTO:</label>
                                        <select class="form-select" value="" name="produto_entrada" id="produto_entrada">
                                <option value="" selected required>Selecione...</option>
                                <?php
$consulta = "SELECT * FROM hb_estoque ORDER BY produto";
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
          <div class="col-md-2 col-sm-12">
            <label for="recipient-rede" class="col-form-label">Q.:</label>
            <input type="text" name="quantidade_entrada" id="recipient-quantidade" maxlength="50" class="form-control -10">
          </div>
          <div class="col-md-4 col-sm-12">
            <label for="recipient-rede" class="col-form-label">MOV:</label>
            <input type="text" value="ENTRADA" name="mov" id="recipient-quantidade" maxlength="50" class="form-control -10">
          </div>
          <div class="col-md-12 col-sm-12">
            <label for="recipient-rede" class="col-form-label">MOTIVO:</label>
            <input type="text" name="motivo" id="recipient-quantidade" maxlength="50" class="form-control -10">
          </div>
</div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">FECHAR</button>
                  <button type="submit" class="btn btn-primary">SALVAR</button>
                </div></form>
              </div>
            </div>
          </div> 
          <div class="modal fade" id="saidaestoque" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">SAIDA DE ESTOQUE<strong>
                       <form method="POST" action="add_saida_estoque.php" enctype="multipart/form-data">                     
                       <div class="row">
 <div class="col-md-6 col-sm-12">
          <label for="recipient-urgente" class="col-form-label">PRODUTO:</label>
                                        <select class="form-select" value="" name="produto_saida" id="produto_saida">
                                <option value="" selected required>Selecione...</option>
                                <?php
$consulta = "SELECT * FROM hb_estoque ORDER BY produto";
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
          <div class="col-md-2 col-sm-12">
            <label for="recipient-rede" class="col-form-label">Q.:</label>
            <input type="text" name="quantidade_saida" id="recipient-quantidade" maxlength="50" class="form-control -10">
          </div>
          <div class="col-md-4 col-sm-12">
            <label for="recipient-rede" class="col-form-label">MOV:</label>
            <input type="text" value="SAIDA" name="mov" id="recipient-quantidade" maxlength="50" class="form-control -10">
          </div>
          <div class="col-md-12 col-sm-12">
            <label for="recipient-rede" class="col-form-label">MOTIVO:</label>
            <input type="text" name="motivo" id="recipient-quantidade" maxlength="50" class="form-control -10">
          </div>
</div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">FECHAR</button>
                  <button type="submit" class="btn btn-primary">SALVAR</button>
                </div>
              </div>
            </div>
          </div>
  <?php
include_once('assets/rodape.php');
?>