<?php
// Todas as configuraçoes aqui

namespace Config; //Agrupamento de classes
// visando evitar o conflito entre nomes

class Config{

    public function __construct(){
        date_default_timezone_set("America/Sao_Paulo");
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese'); 
    }

    /* Pegar hora atual */    
    public function getDataAtual($format = ["USA", true]){
        if(count($format) < 2){
            throw new \Exception("Parâmetros incompletos", 25);            
        }
        $dataHora = new \DateTime('now');
        if($format[0] == 'USA'){ // americano
            if($format[1]){ // precisa ter hora
                return $dataHora->format('Y-m-d H:i:s'); 
            }
            return $dataHora->format('Y-m-d'); 
        }else{ // brasileiro
            if($format[1]){ // precisa ter hora
                return $dataHora->format('d-m-Y H:i:s'); 
            }
            return $dataHora->format('d-m-Y'); 
        }
    }

    /* Tirar Acentuação */
    public function tirarAcentos($palavra){ // Tirar acentos de palavras
        $semAcento = strtolower(preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $palavra )));       
        $tirarEspacos = str_replace(" ", "", $semAcento);
        return $tirarEspacos;        
    }

    /* Gerar Hash */
    public function gerarHash($senha){
        return password_hash($senha, PASSWORD_DEFAULT, array("cost"=>12));
    }

}