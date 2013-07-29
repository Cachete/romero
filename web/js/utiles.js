 
function permite(elEvento, permitidos) {
// Variables que definen los caracteres permitidos

var numeros = "0123456789.,";
var caracteres = " abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ-/";
var numeros_caracteres = numeros + caracteres;
var teclas_especiales = [8, 37, 39, 46, 13, 9];
// 8 = BackSpace, 46 = Supr, 37 = flecha izquierda, 39 = flecha derecha
// Seleccionar los caracteres a partir del parámetro de la función
  switch(permitidos) {
    case 'num':
    permitidos = numeros;
    break;
    case 'car':
    permitidos = caracteres;
    break;
    case 'num_car':
    permitidos = numeros_caracteres;
    break;
}
// Obtener la tecla pulsada
var evento = elEvento || window.event;
var codigoCaracter = evento.charCode || evento.keyCode;
var caracter = String.fromCharCode(codigoCaracter);
// Comprobar si la tecla pulsada es alguna de las teclas especiales
// (teclas de borrado y flechas horizontales)
var tecla_especial = false;
for(var i in teclas_especiales) {
    if(codigoCaracter == teclas_especiales[i]) {
    tecla_especial = true;
    break;
  }
}
// Comprobar si la tecla pulsada se encuentra en los caracteres permitidos
// o si es una tecla especial
return permitidos.indexOf(caracter) != -1 || tecla_especial;
}

//Funcion que nos permite escribir una fecha 
//de una manera rapida
function formafecha(campo)
{
	if (campo.value.length==2 || campo.value.length==5)
	{	
		campo.value = campo.value+"/";
		return false;
	}
}

//Funcion que elimina los espacios en blaco o saltos de linea
//al principio de una cadena
function ltrim(s) {
	return s.replace(/^\s+/, "");
}

//Funcion que elimina los espacios en blaco o saltos de linea
//al final de una cadena
function rtrim(s) {
	return s.replace(/\s+$/, "");
}

//Funcion que elimina los espacios en blanco o saltos de linea
//al comienzo y al final de una cadena
function trim(s) {
	return rtrim(ltrim(s));
}

//Funcion que permite, que cuando se preciona enter se vaya
//al siguien campo de texto del formulario
function handleEnter(field, event) {

	var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
			if (keyCode == 13) {
				var i;
				for (i = 0; i < field.form.elements.length; i++)
					if (field == field.form.elements[i])
						break;
				i = (i + 1) % field.form.elements.length;
				field.form.elements[i].focus();
				return false;
			} 
			else
			return true;
		}

function msg(text)
{
    str = '<p style="margin-top:10px"><span class="ui-icon ui-icon-alert" style="float: left; margin: 0pt 7px 50px 0pt;"></span>'+text+'</p>';
    $("#msgdialog").empty().append(str);
    $("#dialog").dialog("open");
}

function msgok(text)
{
  str = '<p style="margin-top:10px"><span class="ui-icon ui-icon-check" style="float: left; margin: 0pt 7px 50px 0pt;"></span>'+text+'</p>';
    $("#msgdialog").empty().append(str);
    $("#dialog").dialog("open");
}

function msgerror(text)
{
    str = '<p style="margin-top:10px"><span class="ui-icon ui-icon-closethick" style="float: left; margin: 0pt 7px 50px 0pt;"></span>'+text+'</p>';
    $("#msgdialog").empty().append(str);
    $("#dialog").dialog("open");

}
function popup(url,width,height){cuteLittleWindow = window.open(url,"littleWindow","location=no,width="+width+",height="+height+",top=80,left=300,scrollbars=yes"); }

function showboxmsg(text,tipo)
   {
       //@tipo => 1 ok, 2 fail, 3 alert
       var html = "";
       $('.box-msg').css('display','none');
       switch(tipo)
       {
           case 1 : 
                    html = '<p><span class="ui-icon ui-icon-check" style="float: left; margin-right: .3em;"></span>';                    
                        html += text+'</p>';				
                    $('.box-msg').removeClass('ui-state-error-adz');
                    $('.box-msg').addClass('ui-state-active-adz');
                    $('.box-msg').empty().append(html);
                    break;
           case 2 : 
                    html = '<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>';                    
                    html += text+'</p>';
                    $('.box-msg').removeClass('ui-state-active-adz');                    
                    $('.box-msg').addClass('ui-state-error-adz');
                    $('.box-msg').empty().append(html);
                    break;
           case 3 : 
                    html = '<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>';                    
                    html += text+'</p>';
                     $('.box-msg').removeClass('ui-state-error-adz');
                    $('.box-msg').addClass('ui-state-active-adz');
                    $('.box-msg').empty().append(html);
                    break;
           default: break;
       }
       $('.box-msg').show('pulsate',200);
   }
   
   function hideboxmsg()
   {
       $('.box-msg').fadeOut();
   }
   function esrucok(ruc)
   {
      return (!( esnulo(ruc) || !esnumero(ruc) || !eslongrucok(ruc) || !valruc(ruc) ));
   }
   function esnulo(campo){ return (campo == null||campo=="");}
   function esnumero(campo){ return (!(isNaN( campo )));}
   function eslongrucok(ruc){return ( ruc.length == 11 );}
   function valruc(valor)
   {
      valor = trim(valor)
      if ( esnumero( valor ) ) {
        if ( valor.length == 8 ){
          suma = 0
          for (i=0; i<valor.length-1;i++){
            digito = valor.charAt(i) - '0';
            if ( i==0 ) suma += (digito*2)
            else suma += (digito*(valor.length-i))
          }
          resto = suma % 11;
          if ( resto == 1) resto = 11;
          if ( resto + ( valor.charAt( valor.length-1 ) - '0' ) == 11 ){
            return true
          }
        } else if ( valor.length == 11 ){
          suma = 0
          x = 6
          for (i=0; i<valor.length-1;i++){
            if ( i == 4 ) x = 8
            digito = valor.charAt(i) - '0';
            x--
            if ( i==0 ) suma += (digito*x)
            else suma += (digito*x)
          }
          resto = suma % 11;
          resto = 11 - resto
          
          if ( resto >= 10) resto = resto - 10;
          if ( resto == valor.charAt( valor.length-1 ) - '0' ){
            return true
          }      
        }
      }
      return false
    }