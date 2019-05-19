<?php 
namespace Model;
class GenericaM{    
    
    private $dadosAtributos;    

    public function __call($jaca, $dados){   
        $indValido = array(); // indicador se o dados que ira ser inserido esta valido     
        $acao = strtolower(substr($jaca,0,3)); //ficar tudo minusculo
        $nomeMetodo = strtolower(substr($jaca,3,strlen($jaca)));// ficar tudo minusculo    
        
        switch($acao){
            case 'set': 
                if(!is_array($dados)){ // é necessário que seja uma array
                    throw new \Exception("É necessário setar os dados como Array para a propiedade $nomeMetodo", 720);                    
                } 
                $dados = $dados[0]; // nao preciso q fique no indice zero
                if(!isset($dados['vlr'])){ // tem q existir o dado pra setar
                    throw new \Exception("É necessário setar um valor na propiedade $nomeMetodo", 720);
                }                
                
                if(isset($dados['validacoes'])){ // se precisar de validacoes
                    if(!is_array($dados['validacoes'])){ // tem q estar em uma array
                        throw new \Exception("É necessário setar as validacoes como Array para a propiedade $nomeMetodo", 720);
                    }
                    foreach($dados['validacoes'] as $vlr){ // percorrer a array
                        switch(strtolower($vlr)){ // transformar em minusculo
                            case 'not null': // nao pode ser vazio 
                                // fix = nome que inventei q se refere a validacoes
                                $indValido[] = $this->{"fix" . str_replace(" ", "", $vlr)}(["vlr" => $dados['vlr']]); // chama funcao dinamicamente
                                // coloca o valor retornado pela validacao
                                // false = invalidos
                                // true = validos
                                break;
                            // para criar uma nova validacaoes é só criar um novo case, com o nome e depois copiar a linha de cima 
                            // receita de bolo
                            // depois tem q ir no switch case do fix é criar a validacao
                        }    
                    }                    
                    foreach($indValido as $indValidoItem){ // percorrer a array com o resultado das validacoes
                        if($indValidoItem == false){ // se for falso para a execucao
                            throw new \Exception("Os dados setados da propiedade $nomeMetodo não são válidos", 720);                            
                        }
                    }                    
                    $this->dadosAtributos[$nomeMetodo] = $dados['vlr']; // so depois de tudo seta o vlr
                }else{ // nao quero nenhum validacao
                    $this->dadosAtributos[$nomeMetodo] = $dados['vlr'];
                }                        
                break;
            case 'get':                                    
                return $this->dadosAtributos[$nomeMetodo];
                break;            
            case 'fix': // validacoes                
                $dados = $dados[0];
                switch($nomeMetodo){
                    case 'notnull':
                        if(empty($dados['vlr']) || $dados['vlr'] == "" || $dados['vlr'] == null){
                            return false;
                        }
                        return true;
                        break;
                    default:
                        throw new \Exception("O método $nomeMetodo de validação não existe", 720);        
                        break;                
                }               
                break;
        }  
        
    }
    
    public function getValores(){
        return $this->dadosAtributos;
    }

}



