<?php
include('config/conexao.php');
session_start(); //Iniciar a sessao

// Limpar o buffer
ob_start(); 

// Receber os dados formulario
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
var_dump($dados);

// Verificar se o usuario clicou no botao
if(!empty($dados['editUsuarios'])){

    //Ler os do do formulario
    foreach($dados['id'] as $chave => $id){
        /*echo "Chave: $chave <br>";
        echo "ID: " . $dados['id'][$chave] . "<br>";
        echo "Nome: " . $dados['nome'][$chave] . "<br>";
        echo "E-mail: " . $dados['email'][$chave] . "<br>";
        echo "<hr>";*/

        // Criar a QUERY editar no BD
        $query_usuario = "UPDATE horarios SET tecnicos=:tecnicos, semana=:semana WHERE id=:id";
         
        // Preparar a QUERY
        $edit_usuario = $con->prepare($query_usuario);

        // Substituir os links pelos valores que vem do formulario
        $edit_usuario->bindParam(':tecnicos', $dados['tecnicos'][$chave]);
        $edit_usuario->bindParam(':semana', $dados['semana'][$chave]);
        $edit_usuario->bindParam(':id', $dados['id'][$chave]);

        // Executar QUERY
        $edit_usuario->execute();
    }

    // Variavel global com a mensagem de sucesso
    $_SESSION['msg'] = "<p style='color: green;'>Horario editado com sucesso!</p>";

    // Redirecionar o usuario para a pagina inicial
    header("Location: horarios_plantao.php");

}else{
     // Variavel global com a mensagem de sucesso
     $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Horario não editado com sucesso!</p>";

     // Redirecionar o usuario para a pagina inicial
     header("Location: horarios_plantao.php");
}