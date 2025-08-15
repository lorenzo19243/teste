<html>
<head>
<script>
 function notificarUsuario77(){
 // Caso window.Notification n�o exista, quer dizer que o browser n�o possui suporte a web notifications, ent�o cancela a execu��o
oi
 if(!window.Notification){
 return true;
 }
 
 // Fun��o utilizada para enviar a notifica��o para o usu�rio
 var notificar = function(){
 var tituloMensagem = "Nova Mensagem de Sistema (Autom�tico)!";
 var icone = "http://icon-icons.com/icons2/270/PNG/512/messages_29935.png";
 var mensagem = "Assunto: Nova resposta: crediario \n\n V� at� mensagens e verifique!";
 
 return new Notification(tituloMensagem,{
 icon : icone,
 body : mensagem
 });
 };
 
 // Verifica se existe a permiss�o para exibir a notifica��o; caso ainda n�o exista ("default"), ent�o solicita permiss�o.
 // Existem tr�s estados para a permiss�o:
 // "default" => o usu�rio ainda n�o deu nem negou permiss�o (neste caso deve ser feita a solicita��o da permiss�o)
 // "denied" => permiss�o negada (como o usu�rio n�o deu permiss�o, o web notifications n�o ir� funcionar)
 // "granted" => permiss�o concedida
 
 // A permiss�o j� foi concedida, ent�o pode enviar a notifica��o
 if(Notification.permission==="granted"){
 notificar();
 }else if(Notification.permission==="default"){
 // Solicita a permiss�o e caso o usu�rio conceda, envia a notifica��o
 Notification.requestPermission(function(permission){
 if(permission=="granted"){
 notificar();
 }
 });
 }
 };</script>


</head>

<body onload="notificarUsuario77();">
                     
 
</body>
</html>