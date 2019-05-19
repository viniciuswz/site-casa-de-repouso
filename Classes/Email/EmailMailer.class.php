<?php
namespace Classes\Email;
require_once "vendor/autoload.php";


//Import PHPMailer classes into the global namespace
use Model\GenericaM;
use PHPMailer\PHPMailer\PHPMailer;

class EmailMailer extends GenericaM{

        public function enviarEmailFalaConosco(){
                  
          $destino = $this->getEmail();
          
          $arquivo =  wordwrap($this->htmlEmailFaleConosco($this->getAssunto(), $this->getTexto(), $this->getTelefone()),70);
          $assunto = "Casa de Repouso";
          
          $headers =  'MIME-Version: 1.0' . "\r\n"; 
          $headers .= "From: Casa de Repouso <casaderepousonaweb.com>" . "\r\n";
          $headers .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
          
          $enviaremail = mail($destino, $this->getAssunto(), $arquivo, $headers);
          
          
          if(!$enviaremail){
              throw new \Exception("Erro ao enviar email",312);
          }
        }
    
        public function htmlEmailFaleConosco($assunto, $textoDigitado, $telefone){

$html= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8"/>
<meta http-equiv="Content-Type" content="text/plain; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<meta name="MobileOptimized" content="320" />
<meta name="HandHeldFriendly" content="true" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<style type="text/css">
table {
border-collapse:collapse !important	
}
/*MOBILE*/
@media only screen and (max-width: 600px){
.tableFull, .tableHAlf {
width:100% !important;

}
.mobileContainer{
max-width: 90% !important;
align:center !important}
}
/*DESKTOP*/
@media only screen and (min-width: 481px){


}
</style>
<!--[if mso]>
<style type="text/css">
.tableFull {
width:600px !important;
}
.tableHAlf {
width:300px !important;
}
</style>
<![endif]-->
<title>Casa de Repouso</title>
</head>
<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" 
bgcolor="#009688" style="height:100%; width:100%; min-width:100%;
margin:0; padding:0; background-color:#009688;">

<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tbody>
<tr>
<td>
<table width="600" cellspacing="0" cellpadding="0" border="0"
 align="center" bgcolor="#009688" style="min-width:300px;" 
 class="tableFull">
<tbody>
<tr>
<td height="20" style="height: 20px; 
line-height: 20px; font-size: 0">
&nbsp;
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>

<td align="center">

<table width="600" cellspacing="0" cellpadding="0" 
border="0" align="center" style="min-width:300px; 
border-radius: 6px;background-color:#fff " 
class="tableFull mobileContainer">
<tbody>
<tr>
<td>
<table width="600" cellpadding="0" cellspacing="0"
 border="0" align="center" class="tableFull">
<tbody>
<tr>
<td height="20" style="height: 20px; line-height:
 20px; font-size: 0">
&nbsp;
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>
<table width="600" cellpadding="0" cellspacing="0"
 border="0" class="tableFull" 
 style="background-color:#fff">
<tbody>

<tr>

<td>

<table width="580"  cellpadding="0" cellspacing="0"
 border="0" align="center" style="margin: 0 auto"
  class="tableFull">
<tbody>
<tr>
<td align="center">

</td>
</tr>
</tbody>
</table>

</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>
<table width="600" cellpadding="0" cellspacing="0"
border="0" class="tableFull" style="background-color:#fff">
<tbody>
<tr>
<td>
<table cellpadding="0" cellspacing="0" border="0"
align="center" class="tableFull"
style="border-bottom: 1px solid #e2e2e2;
max-width: 80%; width: 90% ;
background-color:#fff" >
<tbody>
<tr>
<td height="15" style="height: 15px;
line-height: 15px; font-size: 0">
&nbsp;
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>
<table width="600" cellpadding="0" cellspacing="0"
border="0" align="center" class="tableFull"
style="background-color:#fff">
<tbody>
<tr>
<td height="45" style="height: 45px;
line-height: 45px; font-size: 0">
&nbsp;
</td>
</tr>
</tbody>
</table>
</td>
</tr>

<!--MIOLO-->
<tr>
<td>
<table width="600" cellpadding="0" cellspacing="0"
border="0" align="center" class="tableFull"
style="background-color:#fff">
<tbody>
<tr>
<td>
<table width="580" cellpadding="0" cellspacing="0"
border="0" align="center" class="tableFull"
style="max-width: 90%; text-align: center;">
<tbody>
<tr>
<td style="font-family:Arial, Helvetica,
sans-serif; font-size:16px">
<strong style="font-size:17px; color: #303030">
  Telefone: '.$telefone.'
</strong>
<br><br>
<strong style="font-size:22px; color: #303030">
  '.$assunto.'
</strong>
<br><br><br>
<span style="font-size: 12px; color: #292929">
'.$textoDigitado.'
</span>
</td>
</tr>
</tbody>
</table>
<table width="600" cellpadding="0" cellspacing="0"
border="0" align="center" class="tableFull">
<tbody>
<tr>
<td height="35" style="height: 35px; line-height: 35px;
font-size: 0">
&nbsp;
</td>
</tr>
</tbody>
</table>
<table width="600" cellpadding="0" cellspacing="0" border="0"
align="center" class="tableFull">
<tbody>
<tr>
<td>
<table align="center" border="0" cellspacing="0"
cellpadding="0" style="margin: 0 auto">
<tr>

</tr>
</table>
</td>
</tr>
</tbody>
</table>
<table width="600" cellpadding="0" cellspacing="0" border="0"
align="center" class="tableFull">
<tbody>
<tr>
<td height="35" style="height: 35px; line-height: 35px;
font-size: 0">
&nbsp;
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>

</td>
</tr>
<!--FIM MIOLO-->
</tbody>
</table>
</td>
</tr>
<tr>
<td>
<table width="600" cellspacing="0" cellpadding="0" border="0"
align="center" bgcolor="#009688" style="min-width:300px;"
class="tableFull">
<tbody>
<tr>
<td height="10" style="height: 10px; line-height: 10px;
font-size: 0">
&nbsp;
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>
<table width="600" cellspacing="0" cellpadding="0" border="0"
align="center" bgcolor="#009688" style="min-width:300px;"
class="tableFull">
<tbody>
<tr>
<td>
<table width="600" cellpadding="0" cellspacing="0" border="0"
align="center" class="tableFull">
<tbody>
<tr>
<td>
<table width="580" cellpadding="0" cellspacing="0" border="0"
align="center" class="tableFull" style="max-width: 90%;
text-align: center;">
</table>

</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>
<table width="600" cellspacing="0" cellpadding="0" border="0"
align="center" bgcolor="#009688" style="min-width:300px;"
class="tableFull">
<tbody>
<tr>
<td height="10" style="height: 10px; line-height: 10px;
font-size: 0">
&nbsp;
</td>
</tr>
</tbody>
</table>
</td>
</tr>

</tbody>

</table>

</body>
</html>
';
        return $html;
            
        }    

        
} 
