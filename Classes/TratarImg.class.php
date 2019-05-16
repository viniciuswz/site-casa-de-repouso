<?php
namespace Classes;

class TratarImg{

    public function tratarImagem($dadosImagem, $pastaDestino){ // Mexer depois nessa funcao       //Fazer a parada da thumb 

        $img = str_replace('data:image/jpeg;base64,', '', $dadosImagem);
        $img = str_replace(' ', '+', $img); 
        $data = base64_decode($img);                
        $novoNome = $this->gerarNome();             
        $indSucess = file_put_contents('Img'. DIRECTORY_SEPARATOR . $pastaDestino . DIRECTORY_SEPARATOR. $novoNome, $data);
        if(!$indSucess){            
            throw new \Exception("Erro ao enviar a imagem",10); 
        }
        return $novoNome;        
    }

    public function gerarNome(){        
        $novoNome =  uniqid(mt_rand(),TRUE); 
        $novoNome = str_replace(".","",$novoNome) . ".png";
        return $novoNome;
    }
}