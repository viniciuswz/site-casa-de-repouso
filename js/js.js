



jQuery(function($){
    
    
    
    window.addEventListener("load", function(event) {
        var menu = document.querySelector('.menu');
        var ativo = document.querySelector('.fa-bars');
        var close = document.querySelector('.mobile-close');
        
        
        function closeMenu(){
            menu.classList.remove('menu-ativo');
            $('body').css('overflow','auto');
        }

        ativo.addEventListener('click',function(){
            if(window.scrollY < 500){
                $('html, body').animate({scrollTop: 500}, 'slow');
            }
            menu.classList.add('menu-ativo');
            $('body').css('overflow','hidden');
            
        },false)
        close.addEventListener('click',closeMenu,false)
      
        $(document).on("click",".menu ul li",function(){
            
            if(window.innerWidth <=768){
                closeMenu();
                return $('html, body').animate({scrollTop: $('.'+this.id).offset().top - 50}, 'slow');
                 
               
            }
            $('html, body').animate({scrollTop: $('.'+this.id).offset().top - 80}, 'slow');
            
        })
    });
    
    
    
    
    
})



function scrollBanner() {
    var scrollPos;
    var headerText = document.querySelector('.banner div');
    var menu = document.querySelector('header');
    var main = document.querySelector('main');
    scrollPos = window.scrollY;
  
    if (scrollPos <= 600) {
        headerText.style.transform =  "translateY(" + (-scrollPos/3) +"px" + ")";
        headerText.style.opacity = 1 - (scrollPos/600);
        //menu.style.opacity = 0 +(scrollPos/600)
    }
    if (scrollPos < 500){
        menu.style.opacity = 0 +(scrollPos/500);
        menu.style.backgroundColor = `rgba(83, 152, 255, ${0+scrollPos/500})`; 
    }

    if (scrollPos > 560){
        main.classList.add("header-margin-top");
       
    }else{
        main.classList.remove('header-margin-top')
    }


  }
  
  window.addEventListener('scroll', scrollBanner);