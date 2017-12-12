<?php
function passCrypt($pass){
    $salt ='$5$rounds=5000$usesomes2343ilasslystgforlt$';
    return $hashed_password = crypt($pass,$salt);
}
function valid_pass($pass) {
    $r1='/[A-Z]/';  //Uppercase
    $r2='/[a-z]/';  //lowercase
    $r3='/[!@#$%^&*()\-_=+{};:,<.>]/';  // whatever you mean by 'special char'
    $r4='/[0-9]/';  //numbers

    if(preg_match_all($r1,$pass, $o)<2) return FALSE;

    if(preg_match_all($r2,$pass, $o)<2) return FALSE;

    if(preg_match_all($r3,$pass, $o)<2) return FALSE;

    if(preg_match_all($r4,$pass, $o)<2) return FALSE;

    if(strlen($pass)<8) return FALSE;

    return passCrypt($pass);
 }
?>