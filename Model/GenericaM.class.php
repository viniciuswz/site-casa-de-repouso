<?php 
namespace Model;
use Db\DbConnection;
class GenericaM extends DbConnection{    
    
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
                                $resultado = $this->{"fix" . str_replace(" ", "", $vlr)}(["vlr" => $dados['vlr']]);
                                $indValido[] = $resultado['indValidacao']; // chama funcao dinamicamente
                                // coloca o valor retornado pela validacao
                                // false = invalidos
                                // true = validos
                                if($resultado['vlr'] != null){
                                    $dados['vlr'] = $resultado['vlr'];
                                }
                                break;
                            case 'utf-8-email':
                                $resultado = $this->{"fix" . str_replace(" ", "", $vlr)}(["vlr" => $dados['vlr']]);
                                $indValido[] = $resultado['indValidacao']; // chama funcao dinamicamente                                
                                if($resultado['vlr'] != null){ // esta me retornando os dados validados
                                    $dados['vlr'] = $resultado['vlr'];
                                } 
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
                            return ['indValidacao' => false, "vlr" => null]; // nao preciso retornar o valor entao coloco null
                        }
                        return ['indValidacao' => true, "vlr" => null]; // nao preciso retornar o valor entao coloco null
                        break;
                    case 'utf-8-email':
                        return ['indValidacao' => true, "vlr" => $this->convert_encoding($dados['vlr'], 'UTF-8')];
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

    public function detect_encoding($string){        
        if (preg_match('%^(?: [\x09\x0A\x0D\x20-\x7E] | [\xC2-\xDF][\x80-\xBF] | \xE0[\xA0-\xBF][\x80-\xBF] | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2} | \xED[\x80-\x9F][\x80-\xBF] | \xF0[\x90-\xBF][\x80-\xBF]{2} | [\xF1-\xF3][\x80-\xBF]{3} | \xF4[\x80-\x8F][\x80-\xBF]{2} )*$%xs', $string))
            return 'UTF-8';
    
        //If you need to distinguish between UTF-8 and ISO-8859-1 encoding, list UTF-8 first in your encoding_list.
        //if you list ISO-8859-1 first, mb_detect_encoding() will always return ISO-8859-1.
        return mb_detect_encoding($string, array('UTF-8', 'ASCII', 'ISO-8859-1', 'JIS', 'EUC-JP', 'SJIS'));
    }
 
    public function convert_encoding($string, $to_encoding, $from_encoding = ''){
        if ($from_encoding == '')
            $from_encoding = $this->detect_encoding($string);
    
        if ($from_encoding == $to_encoding)
            return $string;
    
        return mb_convert_encoding($string, $to_encoding, $from_encoding);
    }
}



