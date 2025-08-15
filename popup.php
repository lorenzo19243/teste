<?php
if (!isset($_COOKIE['Seen']) || $_COOKIE['Seen'] != 'true') {
    setcookie('Seen', 'false');
}
?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"> </script>
<script type="text/javascript" src="js/popup.js"> </script>
<LINK REL=StyleSheet HREF="style/style.css" TYPE="text/css" MEDIA=screen>


<html>
<head>  </head>
<body>
<!-- Element to pop up -->

<?php
if ($_COOKIE['Seen'] == 'true') {echo '<div style="all:none; visibility:hidden; display:none">';}
else {
    echo '<div id="element_to_pop_up">';
    $value = 'true';
    $expire = time()+60*60*24;
    setcookie('Seen', $value, $expire);
}
?>

<a href="#"class="b-close" style="position:absolute; margin-top:5px; margin-left:550px;"><img src="./image/close.png"><a/>
    <iframe frameBorder="0" name="iFrame" width="600" height="500" src="welcome.php" scrolling="no"></iframe>

    </div>

</body>
</html>