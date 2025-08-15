<?php
session_start();//INCICIA A SESSÃO
// seta configurações  hora e tempo limite de inatividade//
date_default_timezone_set('America/Sao_Paulo');
$tempolimite = 6400;
//fim das configurações de hora e limite de inatividade//

// aqui ta o seu script de autenticação no momento em que ele for validado você seta as configurações abaixo.//
// seta as configurações de tempo permitido para inatividade//
 $_SESSION['registro'] = time(); // armazena o momento em que autenticado //
 $_SESSION['limite'] = $tempolimite; // armazena o tempo limite sem atividade //
// fim das configurações de tempo inativo//

include('config/conexao.php'); //INCLUI A CONEXÃO COM BANCO DE DADOS



if ((isset($_POST['email'])) && (isset($_POST['senha']))) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);
    $ultima_alteracao = date('Y-m-d H:i:s');
    $senha = md5($senha);

   
    $result_usuario = "SELECT * FROM usuarios WHERE email = '$email' && senha = '$senha'";
    //&& status = 0 LIMIT 1
    $resultado_usuario = mysqli_query($conn, $result_usuario);
    $resposta .= mysqli_query($conn, $log_categoria);
    $resultado = mysqli_fetch_assoc($resultado_usuario);
    $token = md5($email . $senha); // CRIA UM TOKEN SIMPLES COM MD5, USUARIO E SENHA
    $result_token = $resultado['token'];
    

    if (trim($result_token) === trim($token)) { // SE OS DADOS FOREM CONFIRMADOS PERMITE ACESSO AO SISTEMA

        $_SESSION['usuarioToken'] = $resultado['token'];
        $_SESSION['usuarioNome'] = $resultado['nome'];
		$_SESSION['usuarioId'] = $resultado['id'];
		$_SESSION['status'] = $resultado['LOGADO'];
        $_SESSION['usuarioLogin'] = $resultado['usuario'];
        $_SESSION['usuarioEmail'] = $resultado['email'];
        $_SESSION['usuarioSenha'] = $resultado['senha'];
        $_SESSION['perfil_cod'] = $resultado['perfil_cod']; 
        

        header("Location: home");

    } else if ($resultado) {

        $_SESSION['usuarioToken'] = $token;
        $_SESSION['usuarioNome'] = $resultado['nome'];
		$_SESSION['usuarioId'] = $resultado['id'];
		$_SESSION['status'] = $resultado['LOGADO'];
        $_SESSION['usuarioLogin'] = $resultado['usuario'];
        $_SESSION['usuarioEmail'] = $resultado['email'];
        $_SESSION['usuarioSenha'] = $resultado['senha'];
        $_SESSION['perfil_cod'] = $resultado['perfil_cod'];

        $usuario = $resultado['usuario'];
        $nome = $resultado['nome'];
        $senha = $resultado['senha'];

        $inserir_token = ("UPDATE usuarios SET token='$token', status='1' WHERE email = '$email' && senha = '$senha'");
        $log_categoria = "INSERT INTO hb_os_logs set log='FEZ LOGIN NO SISTEMA', data='$ultima_alteracao', utilizador='$email'";
        $resultado_token = mysqli_query($conn, $inserir_token);
        $resposta .= mysqli_query($conn, $log_categoria);

        header("Location: home");

    } else {
        
        $_SESSION['loginErro'] = "<div class='alert alert-danger alert-dismissible fade show text text-center mb-0' role='alert'>
                                
                                <strong> USUÁRIO OU SENHA INVALÍDO </strong> </div>";
        $log_categoria = "INSERT INTO hb_os_logs set log='TENTOU ACESSAR O SISTEMA MAS DEU ERRO DE EMAIL OU SENHA!', data='$ultima_alteracao', utilizador='$email'"; 
        $resposta = mysqli_query($conn, $log_categoria);
                                
        header("Location: login");
    }
  
} 
