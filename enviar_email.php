<?php
// session_start();
require_once('Config/Define.php');
require_once(SITE_ROOT.DS.'autoload.php');  
use Classes\Email\EmailMailer;


try{
    $email = new EmailMailer();
    $email->setEmail([
        "vlr" => $_POST['email'],
        "validacoes" => [
            "not null"
        ]
    ]);
    $email->setAssunto([
        "vlr" => $_POST["assunto"],
        "validacoes" => [
            "not null",
            "utf-8-email"
        ]
    ]);
    $email->setTexto([
        "vlr" => $_POST['texto'],
        "validacoes" => [
            "not null",
            "utf-8-email"
        ]
    ]);
    $email->setTelefone([
        "vlr" => $_POST['telefone'],
        "validacoes" => [
            "not null"
        ]
    ]);
    $email->enviarEmailFalaConosco();
}catch(Exception $exc){
    echo $exc->getMessage();
}




// use Classes\UrlAmigavel;
// try{
//     $url = new UrlAmigavel($_SERVER['REQUEST_URI']);
//     $nome = $url->partesUrl[1];
//     $ind = $url->indRetornar;
//     if(!$ind){ // nao precisa voltar
//         if(is_file('view/' . $nome)){
//             require_once('view/' . $nome);
//         }
//     }else{ // precisa voltar        
//         header("Location: ../$nome");
//     }   
// }catch(Exception $exc){
//     echo $exc->getMessage();
// }