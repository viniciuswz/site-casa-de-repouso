
<!--
<link rel="stylesheet" type="text/css" href="View/css/cssTemporario.css"/> 
<form action="enviar_email.php" method="post">
    <div class="agrupa-todo-mundo">
        <input type="email" placeholder="Digite seu email" name="email" required>
        <input type="text" placeholder="Digite um assunto" name="assunto" required>
        <textarea placeholder="digite o conteudo do seu email" name="texto" required></textarea>
        <button type="submit">Enviar</button>
    </div>
    
</form>
-->
<?php


// session_start();
require_once('Config/Define.php');
require_once(SITE_ROOT.DS.'autoload.php');  
use Action\testeA;
try{
    $teste = new testeA();
// $teste->getJaca('Daniel');
// $teste->getJAqiunha('Churros');
$teste->setJaca(
    [
        "vlr" => "Churros da Silva",
        "validacoes" => [
            "not null"
        ]
    ]
    );    
echo $teste->getJaca();

$teste->setJui([
    "vlr" => "suco de laranja",
    "validacoes" => [
        "not null"
    ]
]);
echo '<br>';
echo $teste->getJui();

$teste->setJaquinha([
    "vlr" => "Ola mundooo",
    "validacoes" => [
        "not null"
    ]
]);
echo '<br>';
echo $teste->getJaquinha();
}catch(Exception $exc){
    echo $exc->getMessage();

}

// echo '<form>
//         <input type="email" name="email" placeholder="digite seu email">
//         <br/>
//         <textarea name="texto">Digite o texto</textarea>
//     </form>';



// use Classes\Email\EmailMailer;

// $email = new EmailMailer();
// $email->enviar("danielcost9009@gmail.com", "teste", 23);
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



