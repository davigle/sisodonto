var req;
var elem = '';
if (navigator.appName.indexOf('Microsoft') != -1) {
	clientNavigator = "IE";
} else {
	clientNavigator = "Other";
}

function extraiScript(texto) {
	/**
 	 * Fun��o original de SkyWalker.TO do imasters/forum
 	 * Alterada por Micox - micoxjcg@yahoo.com.br
 	 * Alterada por Pita
 	 * Ref.: http://forum.imasters.com.br/index.php?showtopic=165277
 	 * Ref.: http://forum.imasters.com.br/index.php?showtopic=173928&st=0&p=552492&#entry552492
 	 *
 	 */	
	var ini, pos_src, fim, codigo;
	var objScript = null;
	ini = texto.indexOf('<script', 0)
	while (ini!=-1){
		var objScript = document.createElement("script");
		pos_src = texto.indexOf(' src', ini)
		ini = texto.indexOf('>', ini) + 1;
		if (pos_src < ini && pos_src >=0) {
			ini = pos_src + 4;
			fim = texto.indexOf('.', ini)+4;
			codigo = texto.substring(ini,fim);
			codigo = codigo.replace("=","").replace(" ","").replace("\"","").replace("\"","").replace("\'","").replace("\'","").replace(">","");
			objScript.src = codigo;
		} else {
			fim = texto.indexOf('</script>', ini);
			codigo = texto.substring(ini,fim);
			objScript.text = codigo;
		}
		document.body.appendChild(objScript);
		ini = texto.indexOf('<script', fim);
		objScript = null;
	}
}

function DecHex(dec2) { 
    var hex_chars = "0123456789ABCDEF"; 
    var n1 = hex_chars.charAt(Math.floor(dec2 / 16)); 
    var n2 = hex_chars.charAt(dec2 % 16); 
    return n1 + n2; 
} 

function ajaxInit() {
	var requi;
	try {
		requi = new ActiveXObject("Microsoft.XMLHTTP");
	} catch(e) {
		try {
			requi = new ActiveXObject("Msxml2.XMLHTTP");
		} catch(ex) {
			try {
				requi = new XMLHttpRequest();
			} catch(exc) {
			alert("Esse browser n�o tem recursos para uso do Ajax");
			requi = null;
			}
		}
	}
	return requi;
}

function formSender(f, campo) { 
	var acao = f.action; 
	var metodo = f.method.toLowerCase(); 
	var enctipo = f.enctype; 
	if(!acao) { 
		alert("erro: o valor action do formulario nao foi definido"); 
	} 
	var send = new Array(); 
	var elementos = f.elements; 
	for(var i = 0; i < elementos.length; i++) { 
		var e = elementos[i]; 
		if(!e.name) 
			continue; 
		var nVal = ""; 
		for(var x = 0; x < e.value.length; x++) { 
			codeA = e.value.charCodeAt(x); 
			codeA = DecHex(codeA); 
			nVal += "%" + codeA; 
		} 
		var tipo = e.type.toLowerCase(); 
		if(tipo != "checkbox" && tipo != "radio") { 
			send[send.length] = e.name + "=" + nVal; 
		} else { 
			if(e.checked) { 
				send[send.length] = e.name + "=" + nVal; 
			} 
		} 
	} 
	send = send.join("&"); 
	var ajax = ajaxInit(); 
	if(ajax) { 
		if(metodo == "post") { 
			ajax.open("POST", acao, true); 
			if(enctipo == "multipart/form-data") {
				ajax.setRequestHeader("Content-type", "multipart/form-data");
			} else {
				ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
			}
		} else { 
			ajax.open("GET", acao + "?" + send, true); 
		}
		ajax.onreadystatechange = function() { 
			var texto = unescape(ajax.responseText.replace(/\+/g , " "));;
			document.getElementById(campo).innerHTML = texto;
			extraiScript(texto);
		}
		if(metodo == "post") { 
			ajax.send(send); 
		} else { 
			ajax.send(null); 
		} 
	}
}

function Ajax(url, campo, query) {
	elem = campo;
	document.getElementById(elem).innerHTML = "<font color='red'>Carregando...";
	if (window.XMLHttpRequest) {  
		req = new XMLHttpRequest();  
	} else if (window.ActiveXObject) {  
		req = new ActiveXObject("Microsoft.XMLHTTP");  
	} else {  
		alert("Seu navegador n&atilde;o suporta XMLHttpRequest.");  
		return;  
	}
	req.open("GET", url+"_ajax.php?"+query, true);
	req.onreadystatechange = processReqChange;
	req.send(null); 
}

function processReqChange() {
	if (req.readyState == 4) {
		if (req.status == 200) {
			//document.getElementById(elem).innerHTML = unescape(req.responseText.replace(/\+/g , " "));;
			var texto = unescape(req.responseText.replace(/\+/g , " "));;
			document.getElementById(elem).innerHTML = texto;
			extraiScript(texto);
		}
	}
}

function confirmLink(theLink) {
	if (typeof(window.opera) != 'undefined') {
		return true;
	}
	var is_confirmed = confirm('Tem certeza que deseja excluir estes dados?');
	if (is_confirmed) {
		if ( typeof(theLink.href) != 'undefined' ) {
			theLink.href += "&confirm_del=delete')";
		} else if ( typeof(theLink.form) != 'undefined' ) {
			theLink.form.action += '?confirm_del=delete';
		}
	}
	return is_confirmed;
}

function Bloqueia_Caracteres(evnt){
	/**
 	 * Fun��o original de Diego Pires Plentz
 	 *
 	 */
	if (clientNavigator == "IE") {
		if (evnt.keyCode < 48 || evnt.keyCode > 57) {
			return false
		}
	} else {
		if ((evnt.charCode < 48 || evnt.charCode > 57) && (evnt.keyCode == 0 || evnt.keyCode == 13)) {
			return false
		}
	}
}

function Ajusta_Data(input, evnt){
	/**
 	 * Fun��o original de Diego Pires Plentz
 	 *
 	 */	
	if (input.value.length == 2 || input.value.length == 5) {
		if(clientNavigator == "IE") {
			input.value += "/";
		} else {
			if(evnt.keyCode == 0) {
				input.value += "/";
			}
		}
	}
	return Bloqueia_Caracteres(evnt);
}

function Ajusta_MesAno(input, evnt){
	/**
 	 * Adapta��o da fun��o original de Diego Pires Plentz
 	 * extends Ajusta_Data()
 	 *
 	 */	
	if (input.value.length == 2) {
		if(clientNavigator == "IE") {
			input.value += "/";
		} else {
			if(evnt.keyCode == 0) {
				input.value += "/";
			}
		}
	}
	return Bloqueia_Caracteres(evnt);
}

function Ajusta_DMA(input, evnt, valor) {
	if(valor == 'dia') {
		return Ajusta_Data(input, evnt);
	} else {
		if(valor == 'mes') {
			return Ajusta_MesAno(input, evnt);
		} else {
			if(valor == 'ano') {
				return true;
			}
		}
	}
}

function Ajusta_Telefone(input, evnt){
	if (input.value.length == 0) {
		if(clientNavigator == "IE") {
            if(evnt.keyCode != 48) {
                input.value += "(";
			}
		} else {
			if(evnt.keyCode == 0 && evnt.charCode != 48) {
				input.value += "(";
			}
		}
	}
	if (input.value.length == 3 && input.value.slice(0, 1) != '0') {
		if(clientNavigator == "IE") {
			input.value += ")";
		} else {
			if(evnt.keyCode == 0) {
				input.value += ")";
			}
		}
	}
	if (input.value.length == 8 && input.value.slice(0, 1) != '0') {
		if(clientNavigator == "IE") {
			input.value += "-";
		} else {
			if(evnt.keyCode == 0) {
				input.value += "-";
			}
		}
	}
	if ((input.value.length == 4 || input.value.length == 8) && input.value.slice(0, 1) == '0') {
		if(clientNavigator == "IE") {
			input.value += " ";
		} else {
			if(evnt.keyCode == 0) {
				input.value += " ";
			}
		}
	}
	return Bloqueia_Caracteres(evnt);
}

function Ajusta_Valor(input, evnt){
	if (clientNavigator == "IE") {
		if (evnt.keyCode == 44) {
			input.value += '.';

		}
		if (evnt.keyCode < 48 || evnt.keyCode > 57) {
			return false
		}		
	} else {
		if ((evnt.charCode == 44) && evnt.keyCode == 0) {
			input.value += '.';
			return false;
		}
		if ((evnt.charCode < 48 || evnt.charCode > 57) && evnt.keyCode == 0) {
			return false
		}
	}
}

function Ajusta_CEP(input, evnt){
	/**
 	 * Fun��o original de Pedro Henrique Braga Moreira
 	 *
 	 */
	if (input.value.length == 5) {
		if(clientNavigator == "IE") {
			input.value += "-";
		} else {
			if(evnt.keyCode == 0) {
				input.value += "-";
			}
		}
	}
	return Bloqueia_Caracteres(evnt);
}

function Ajusta_CPF(input, evnt){
	/**
 	 * Fun��o original de Pedro Henrique Braga Moreira
 	 *
 	 */
	if (input.value.length == 3 || input.value.length == 7) {
		if(clientNavigator == "IE") {
			input.value += ".";
		} else {
			if(evnt.keyCode == 0) {
				input.value += ".";
			}
		}
	}
	if (input.value.length == 11) {
		if(clientNavigator == "IE") {
			input.value += "-";
		} else {
			if(evnt.keyCode == 0) {
				input.value += "-";
			}
		}
	}
	return Bloqueia_Caracteres(evnt);
}

function Ajusta_CNPJ(input, evnt){
	/**
 	 * Fun��o original de Pedro Henrique Braga Moreira
 	 *
 	 */
	if (input.value.length == 2 || input.value.length == 6) {
		if(clientNavigator == "IE") {
			input.value += ".";
		} else {
			if(evnt.keyCode == 0) {
				input.value += ".";
			}
		}
	}
	if (input.value.length == 10) {
		if(clientNavigator == "IE") {
			input.value += "/";
		} else {
			if(evnt.keyCode == 0) {
				input.value += "/";
			}
		}
	}
	if (input.value.length == 15) {
		if(clientNavigator == "IE") {
			input.value += "-";
		} else {
			if(evnt.keyCode == 0) {
				input.value += "-";
			}
		}
	}
	return Bloqueia_Caracteres(evnt);
}

function Ajusta_CPFCNPJ(input, evnt, valor) {
	if(valor == 'cpf') {
		return Ajusta_CPF(input, evnt);
	} else {
        return Ajusta_CNPJ(input, evnt);
	}
}

function NewWindow(myPage, myName, Width, Height, Scroll, Resizable) {
	/**
 	 * Fun��o original de sOul
 	 *
 	 */	
	var winTop = ((screen.height - Height) / 2);
	var winLeft= ((screen.width - Width) / 2);
	winProps = 'top=' +winTop+ ',left=' +winLeft+ ',height=' +Height+ ',width=' +Width+ ',Scrollbars=' +Scroll+ ',Resizable=' +Resizable+ ';'
	Win = window.open(myPage, myName, winProps);
		
		if (parseInt(navigator.appVersion) >= 4) { 
			Win.window.focus(); //set focus to the window
		}
}

function displayQCalendar(m, y) {
	document.getElementById('calendario').innerHTML = "<font color='red'>Carregando...";
	if (window.XMLHttpRequest) {
		req = new XMLHttpRequest();
	} else if (window.ActiveXObject) {
		req = new ActiveXObject("Microsoft.XMLHTTP");
	} else {
		alert("Seu navegador n&atilde;o suporta XMLHttpRequest.");
		return;
	}
	req.open("GET", "lib/calendario.inc.php?m="+m+"&y="+y, true);
	req.onreadystatechange = createQCObject;
	req.send(null);
}

function createQCObject() {
	if (req.readyState == 4) {
		if (req.status == 200) {
			//document.getElementById(elem).innerHTML = unescape(req.responseText.replace(/\+/g , " "));;
			var texto = unescape(req.responseText.replace(/\+/g , " "));;
			document.getElementById('calendario').innerHTML = texto;
			extraiScript(texto);
		}
	}
}

/*function createQCObject() {
   var req;
   if(window.XMLHttpRequest){
      // Firefox, Safari, Opera...
      req = new XMLHttpRequest();
   } else if(window.ActiveXObject) {
      // Internet Explorer 5+
      req = new ActiveXObject("Microsoft.XMLHTTP");
   } else {
      alert('Problem creating the XMLHttpRequest object');
   }
   return req;
}

// Make the XMLHttpRequest object
var http = createQCObject();

function displayQCalendar(m,y) {
	http.open('GET', '/lib/calendario.inc.php?m='+m+'&y='+y);
   	http.onreadystatechange = function() {
		if(http.readyState == 4 && http.status == 200) {
      		var response = http.responseText;
      		if(response) {
	alert(m+"/"+y);
				document.getElementById("calendario").innerHTML = http.responseText;
      		}
   		}
	}
   	http.send(null);
}*/

function findPosX(obj) {
	var curleft = 0;
	if (obj.offsetParent) {
		do {
			curleft += obj.offsetLeft;
		} while (obj = obj.offsetParent);
	}
	return curleft;
}
function findPosY(obj) {
	var curtop = 0;
	if (obj.offsetParent) {
		do {
			curtop += obj.offsetTop;
		} while (obj = obj.offsetParent);
	}
	return curtop;
}
function abreCalendario(obj) {
    var calendar = document.getElementById('calendario');
    calendar.style.display = "block";
    var posX = findPosX(obj) - 100;
    var posY = findPosY(obj) + 20;
    calendar.style.left = posX+'px';
    calendar.style.top = posY+'px';
}
function fechaCalendario() {
    var calendar = document.getElementById('calendario');
    calendar.style.display = "none";
}
function escolheData(data) {
    var campo = document.getElementById('procurar');
    campo.value = data;
    fechaCalendario();
    campo.focus();
}
