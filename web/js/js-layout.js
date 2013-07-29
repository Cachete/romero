       $(document).ready(function() {           
           str = 'controller=config&action=get';
           $("#title-banner").css("display","none");
           $("#title-banner").show("slide",750);                 
           $.get('index.php','controller=index&action=Menu',function(menu){
                $("#menu").empty();                    
                var opciones_menu = menu;
                w = $(document).width();                
                $(".head_nav").generaMenu(opciones_menu);
                //$("#m0").find('a').addClass("home");
            },'json');    
            
                 var $floatingbox = $('#site_head');
 
                 if($('#body').length > 0){

                  var bodyY = parseInt($('#body').offset().top);
                  var originalX = $floatingbox.css('margin-left');

                  $(window).scroll(function () { 
                       
                   var scrollY = $(window).scrollTop();
                   var isfixed = $floatingbox.css('position') == 'fixed';

                   if($floatingbox.length > 0){
                      if ( scrollY > bodyY && !isfixed ) {                                
                                $floatingbox.stop().css({
                                  position: 'fixed',                                  
                                  marginLeft: 0,
                                  top:0
                                });
                        } else if ( scrollY < bodyY && isfixed ) {
                                  $floatingbox.css({
                                  position: 'absolute',
                                  top:0,
                                  marginLeft: originalX
                        });
                     }		
                   }
               });
             }             
             
        });
//document.oncontextmenu = function(){ return false; }