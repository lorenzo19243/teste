function processa() {
    var logins = document.getElementById("logins").value;
    var cliente = document.getElementById("cliente").value;
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("modal-body").innerHTML = this.responseText;
    }
    xhttp.open("GET", "processa.php?logins="+logins+"&cliente="+cliente);
    xhttp.send();    
}      