(function(){
    'use strict'
   
    var mensagem = {
        'cpf': 'O CPF não foi digitado',
        'email': 'O E-mail não foi digitado',
        'senha': 'A senha não foi digitada',
        'nome': 'O nome não foi digitado',
        'Csenha': 'A senha não foi confirmada',
        'nascimento': 'selecione sua data de nasc',
        'senha': 'A senha não foi digitada',
        'Csenha': 'A senha não foi confirmada',
        'remove': ''
    }
    
    var validacoes = {
        Csenha: function(Csenha,senha){
            if(Csenha.value != senha.value){
                return redInput.call(redInput,Csenha,'Confirmar senha esta errado');//false  
            }
            return true;
        }
    }
    
    var erroAjax = {
        'Senha inválida': function(){
            redInput('#senha','errosenha')
        },
        'login': function(){
            location.href="";
        }
    }
    
    jQuery(function(){
        
        var $inputs = document.querySelectorAll('form:nth-child(1) input');
        var $senha = document.querySelector('input[name="senha"]');
        var okay;
        $('#login').submit(function(){
           

            okay = Array.prototype.every.call($inputs,function($this){
                return $this.value != '';  
            });

            Array.prototype.forEach.call($inputs,function($this){
                if($this.value != '' && $this.type != 'submit'){
                    okayInput.call(okayInput,$this); 
                }

                if($this.value == '' && $this.type != 'submit' ){
                    return redInput.call(redInput,$this,mensagem[$this.name]);                    
                }

                if(outraValidacao($this)){
                   return okay = validacoes[$this.name]($this,$senha);
                }
                
            })
            if(okay){   
               // alert('enviado')            
                $.ajax({
                    url: '../Logar.php',
                    type: 'post',
                    data: $('#login').serialize(),
                    success:function(result){
                        erroAjax[result]();
                    }
                });
            }
            return false
        })
        
    })
    
    function outraValidacao($this){
        return !!validacoes[$this.name];
    }
    
    function redInput(doc,txt){
        $(doc).addClass('errado');
        doc.parentElement.firstElementChild.firstElementChild.innerHTML =txt;
        return false;
    }
    
    function okayInput(doc){
        $(doc).removeClass('errado');
        doc.parentElement.firstElementChild.firstElementChild.innerHTML = mensagem.remove;
    }
    function limiteData(){
        var hoje = new Date();
        var dd = hoje.getDate();
        var mm = hoje.getMonth()+1; 
        var yyyy = hoje.getFullYear();
        if(dd<10){
            dd='0'+dd
        } 
        if(mm<10){
            mm='0'+mm
        } 
        
        hoje = yyyy+'-'+mm+'-'+dd;
        document.getElementById("nasc").setAttribute("max", hoje);
    }

    $(document).ready(function(){
        limiteData();
        $("#cpf").mask("999.999.999-999");
    });
})()