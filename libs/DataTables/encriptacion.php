<?php
$pass='NuevaClave';
echo ("La clave depositada es :".$pass.'<br/>');
echo md5($pass).'<br/>';
echo sha1($pass).'<br/>';

foreach(hash_algos() as $result){
    echo $result . ': ' . hash($result,$pass) . '<br/>';
}
//password_hash
$hash=password_hash($pass,PASSWORD_DEFAULT,['cost'=>5]);
echo $hash . '<br/>';
//password_verify
if(password_verify($pass,$hash)){
    echo 'El password es correcto';
}
?>