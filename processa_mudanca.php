<?php
session_start();
$_SESSION["usuarioNome"]; 
$logins = $_GET["logins"];
include('config/conexao.php');
include_once("config/seguranca.php");

date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$dataLocal = date('d/m/Y H:i:s', time());

require(__DIR__ . DIRECTORY_SEPARATOR . 'WebserviceClient.php');
$host = 'https://ixc.jrnettelecomunicacao.com.br/webservice/v1';
$token = '24:20fbb2320055b1163e20f5e0ebb6087d08b2280cde2605c9573d42c5549a1226';//token gerado no cadastro do usuario (verificar permissões)
$selfSigned = true; //true para certificado auto assinado
$api = new IXCsoft\WebserviceClient($host, $token, $selfSigned);

$params2 = array(
    'qtype' => 'radpop_radio_cliente_fibra.id_login',//campo de filtro
    'query' => ''.$logins.'',//valor para consultar
    'oper' => '=',//operador da consulta
    'page' => '1',//página a ser mostrada
    'rp' => '1',//quantidade de registros por página
    'sortname' => 'radpop_radio_cliente_fibra.id',//campo para ordenar a consulta
    'sortorder' => 'desc'//ordenação (asc= crescente | desc=decrescente)
);
$api->get('radpop_radio_cliente_fibra', $params2);
$retorno2 = $api->getRespostaConteudo(true);
//var_dump($retorno2);

foreach ($retorno2['registros'] as $registro) {
    $nome = $registro['nome']; 
    $onu_tipo = $registro['onu_tipo'];
	$sinal_tx = $registro['sinal_tx']; 
	$sinal_rx = $registro['sinal_rx'];   // ou 'nome', dependendo da chave correta
	echo "";		  

}	

$params3 = array(
    'qtype' => 'radusuarios.id',//campo de filtro
    'query' => ''.$logins.'',//valor para consultar
    'oper' => '=',//operador da consulta
    'page' => '1',//página a ser mostrada
    'rp' => '1',//quantidade de registros por página
    'sortname' => 'radusuarios.id',//campo para ordenar a consulta
    'sortorder' => 'desc'//ordenação (asc= crescente | desc=decrescente)
);
$api->get('radusuarios', $params3);
$retorno3 = $api->getRespostaConteudo(true);// false para json | true para array
//var_dump($retorno3);

 
foreach  ($retorno3['registros'] as $registro) {
$login = $registro['login'];
$id_cliente = $registro['id_cliente']; 
$id_contrato = $registro['id_contrato'];
$porta_http =  $registro['porta_http']; 
$ip_aviso = $registro['ip_aviso']; 
$ssid_router_wifi_5ghz = $registro['ssid_router_wifi_5ghz']; 
$senha_rede_sem_fio_5ghz = $registro['senha_rede_sem_fio_5ghz'];
 

echo "";
		  
		  
		  
}
$params = array(
    'qtype' => 'cliente.id',//campo de filtro
    'query' => ''.$id_cliente.'',//valor para consultar
    'oper' => '=',//operador da consulta
    'page' => '1',//página a ser mostrada
    'rp' => '1',//quantidade de registros por página
    'sortname' => 'cliente.id',//campo para ordenar a consulta
    'sortorder' => 'desc'//ordenação (asc= crescente | desc=decrescente)
);

$api->get('cliente', $params);
$retorno = $api->getRespostaConteudo(true);// false para json | true para array
//var_dump($retorno);

foreach ($retorno['registros'] as $registro) {
    $razao = $registro['razao']; // ou 'nome', dependendo da chave correta
    $endereco = $registro['endereco'];
	$numero = $registro['numero'];
	$bairro = $registro['bairro'];
	$longitude = $registro['longitude'];
	$latitude = $registro['latitude'];
    echo "";

}

$params4 = array(
    'qtype' => 'cliente_contrato.id',//campo de filtro
    'query' => ''.$id_contrato.'',//valor para consultar
    'oper' => '=',//operador da consulta
    'page' => '1',//página a ser mostrada
    'rp' => '1',//quantidade de registros por página
    'sortname' => 'cliente_contrato.id',//campo para ordenar a consulta
    'sortorder' => 'desc'//ordenação (asc= crescente | desc=decrescente)
);
$api->get('cliente_contrato', $params4);
$retorno4 = $api->getRespostaConteudo(true);
//var_dump($retorno4);

foreach ($retorno4['registros'] as $registro) {
    $contrato = $registro['contrato'];
    // ou 'nome', dependendo da chave correta
	

		  
		  };



echo '
<form method="POST" action="processa_cad_mudancas.php">
        <div class="row">
          <div class="col-md-12 col-sm-12">
            <label for="recipient-nome" class="col-form-label">NOME:</label>
            <input value="'.$razao.'" type="text" name="nome" id="nome" maxlength="50" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col-md-9 col-sm-12">
            <label for="recipient-observacao" class="col-form-label">OBSERVAÇÃO:</label>
            <input type="text" name="observacao" id="observacao" maxlength="50" class="form-control">
          </div>
           
<div class="col-md-3 col-sm-12">
            <label for="recipient-plano" class="col-form-label">PLANO</label>
           <input value="'.substr("$contrato", 6, 7).'" type="text" name="plano" id="plano" maxlength="50" class="form-control -10">
          </div>
          <div class="col-md-5 col-sm-12">
            <label for="recipient-bairro" class="col-form-label">LONGITUDE:</label>
            <input value="'.$longitude.'"type="text" name="longitude" id="longitude" maxlength="50" class="form-control">
          </div>
          <div class="col-md-5 col-sm-12">
            <label for="recipient-bairro" class="col-form-label">LATITUDE:</label>
            <input value="'.$latitude.'"type="text" name="latitude" id="latitude" maxlength="50" class="form-control">
          </div>
          <div class="col-md-5 col-sm-12">
            <label for="recipient-bairro" class="col-form-label">ANTIGO BAIRRO</label>
            :
             <input value="'.$bairro.'" type="text" name="bairro" id="recipient-bairro" maxlength="50" class="form-control -10">
          </div>
          <div class="col-md-5 col-sm-12">
            <label for="recipient-rua" class="col-form-label">ANTIGA RUA:</label>
           <input value="'.$endereco.'" type="text" name="rua" id="rua" maxlength="50" class="form-control -10">
          </div>
          <div class="col-md-2 col-sm-12">
            <label for="recipient-numero" class="col-form-label">N</label>
            :
             <input value="'.$numero.'" type="text" name="numero" id="numero" maxlength="50" class="form-control -10 border border-warning" >
          </div>
        </div>
        <div class="row">
          <div class="col-md-5 col-sm-12">
            <label for="recipient-bairro2" class="col-form-label">NOVO BAIRRO</label>
            :          
            <select class="form-control form-select" aria-label="Default select example" name="bairro2" id="bairro2">
              <option selected>SELECIONE O BAIRRO</option>
              <option value="ALDEIA KIRIRI">ALDEIA KIRIRI</option>
              <option value="ALDEIA TUXA">ALDEIA TUXA</option>
              <option value="ALDEIA TUXA RIACHO SERRA BRANCA">ALDEIA TUXA RIACHO SERRA BRANCA</option>
              <option value="ALTO DO CRUZEIRO">ALTO DO CRUZEIRO</option>
              <option value="ALTO DO FUNDAO">ALTO DO FUNDAO</option>
              <option value="BARREIROS DA PASSAGEM">BARREIROS DA PASSAGEM</option>
              <option value="CALUMBI">CALUMBI</option>
              <option value="CAMPO VERDE">CAMPO VERDE</option>
              <option value="CANABRAVA">CANABRAVA</option>
              <option value="CANTINHO 1">CANTINHO 1</option>
              <option value="CANTINHO 2 ">CANTINHO 2 </option>
              <option value="CENTRO">CENTRO</option>
              <option value="CIDADE NOVA">CIDADE NOVA</option>
               <option value="CIPÓ">CIPÓ</option>
              <option value="FAZENDA GRANDE">FAZENDA GRANDE</option>
              <option value="IBOTIRAMINHA">IBOTIRAMINHA</option>
              <option value="JARDIM IMPERIAL">JARDIM IMPERIAL</option>
              <option value="JARDIM NOVO TEMPO">JARDIM NOVO TEMPO</option>
              <option value="KM7">KM7</option>
              <option value="KM8">KM8</option>
              <option value="KM9">KM9</option>
              <option value="KM10">KM10</option>
              <option value="MARIA DA LUZ">MARIA DA LUZ</option>
              <option value="MORADA REAL">MORADA REAL</option>
              <option value="NEGO DO BODE">NEGO DO BODE</option>
              <option value="OLHOS DAGUAS">OLHOS DAGUAS</option>
              <option value="PASSAGEM">PASSAGEM</option>
              <option value="PIXAIN">PIXAIN</option>
              <option value="POV. DO ALECRIM">POV. DO ALECRIM</option>
              <option value="POV. DAS PEDRAS">POV. DAS PEDRAS</option>
              <option value="REFORMA CAPITAO LAMARCA">REFORMA CAPITAO LAMARCA</option>
              <option value="REFORMA RIACHO DE SERRA BRANCA">REFORMA RIACHO DE SERRA BRANCA</option>
              <option value="RIACHO DE SERRA BRANCA">RIACHO DE SERRA BRANCA</option>
              <option value="SAO FRANCISCO">SAO FRANCISCO </option>
              <option value="SAO JOAO">SAO JOAO</option>
              <option value="TIXINHAS">TIXINHAS</option>
              <option value="VEREDINHA">VEREDINHA</option>
              <option value="VIJA FRIJOA">VILA FRIJOA</option>
              <option value="XIXA">XIXA</option>
            </select>
          </div>
          <div class="col-md-5 col-sm-12">
            <label for="recipient-rua2" class="col-form-label">NOVA RUA:</label>
            <input type="text" name="rua2" id="rua2" maxlength="50" class="form-control -10">
          </div>
          <div class="col-md-2 col-sm-12">
            <label for="recipient-numero2" class="col-form-label">N</label>
            :
            <input type="text" name="numero2" id="numero2" maxlength="50" class="form-control -10 border border-warning" >
          </div>
        </div>
        <div class="row">
          
          <div class="col-md-3 col-sm-12">
            <label for="recipient-agendado" class="col-form-label">PARA  DIA:</label>
            <input class="w3-input w3-border form-control " value="'.date('Y-m-d H:i').'" type="datetime-local"  name="agendado"  name="agendado" id="agendado"required>
          </div>
          <div class="col-md-3 col-sm-12">
            <label for="recipient-pppoe" class="col-form-label">PPPOE:</label>
            <input value="'.$login.'" type="text" name="pppoe" id="pppoe" maxlength="50" class="form-control -10">
          </div>

        <div class="col-md-3 col-sm-10">
            <label for="recipient-rua" class="col-form-label">REDE WIFI ATUAL:</label>
             <input value="'.$ssid_router_wifi_5ghz.'" type="text" name="rede" id="rede" maxlength="50" class="form-control -10">
          </div>
          <div class="col-md-3 col-sm-12">
            <label for="recipient-rua" class="col-form-label">SENHA WIFI ATUAL:</label>
             <input value="'.$senha_rede_sem_fio_5ghz.'" type="text" name="redesenha" id="redesenha" maxlength="50" class="form-control -10">
          </div>        </div>
        <div class="row mb-3">
          <div class="col-md-4 col-sm-12">
            <label for="recipient-operador" class="col-form-label cli">ATENDENTE:</label>
            <input type="text" name="operador" id="operador" maxlength="50" class="form-control" disabled value="'.$_SESSION['usuarioNome'].'">
          </div>
          <div class="col-md-4 col-sm-12">
            <label for="recipient-dataCadastro" class="col-form-label">DATA DO CADASTRO:</label>
            <input type="text" class="form-control"  value="'.date('d/m/Y - H:i:s').'" disabled>
          </div>
          <div class="col-md-4 col-sm-12">
            <label for="recipient-status" class="col-form-label">STATUS:</label>
            <input type="text" name="status" id="status" maxlength="50" class="form-control" value="A LANÇAR" >
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">FECHAR</button>
          <button type="submit" class="btn btn-primary" id="btn-cadastrar">AGENDAR</button>
        </div>
        </div>
      </form>
    </div>
  </div>
 ';
?>
<form>

