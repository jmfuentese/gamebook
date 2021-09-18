var minas = inicializaMatriz();	
var x = document.getElementById("niv");
var filas = 0;
var columnas = 0;
var totalMinas;
var cb=0;

function cargarTablero(){
	inic.setAttribute('disabled', 'disabled');
	var n = document.getElementById("niv");
	var nivel = n.options[n.selectedIndex].text;
	if (nivel != '----------') {
		obtenerNivel();
		crearTablero();
		crearMinas(minas);
		bombasAlrededor(minas);
	}else{
		alert('Elije un nivel!!!');
		inic.removeAttribute('disabled');
	}
}



function obtenerNivel(){
	var nivel = x.options[x.selectedIndex].text;
	if (nivel == 'Principiante') {
		filas = 8;
		columnas = 8;
		tablerominas.style.width = '416px';
		tablerominas.style.height = '416px';
		totalMinas = 10;
	}else if (nivel == 'Intermedio') {
		filas = 16;
		columnas = 16;
		tablerominas.style.width = '432px';
		tablerominas.style.height = '432px';
		tablerominas.style.margin = '30px auto';
		totalMinas = 40;
	}else if (nivel == 'Avanzado') {
		filas = 16;
		columnas = 30;
		tablerominas.style.width = '1560px';
		tablerominas.style.height = '832px';
		totalMinas = 99;
	}
	
	console.log(nivel + ' ' + filas + ' ' + columnas);
}


function inicializaMatriz(){
	var tabla = [];
	// for(var i = 0; i < 8; i++){			        
 //        tabla[i] = [0,0,0,0,0,0,0,0];			        
 //    }
	for(var i=0; i<8; i++) {
	   tabla[i] = [];
	   for(var j=0; j<8; j++) {
	       tabla[i][j] = 0;
	   }
	}
    return tabla;
}		

function crearTablero(){
	var ind = 0;
	for(var i = 0; i < filas; i++){
        for(var j = 0; j < columnas; j++){			           
           var div = document.createElement("div");
            // if (ind < 10) {
           	// 	div.id = 0 +""+ ind;
            // }else{
            // 	div.id = ind;
            // }
            if(totalMinas == 40){
            	div.style.width = "25px";
            	div.style.height = "25px";
            }
            div.id = i + "" + j;			            
            div.addEventListener("click",mostrarNumero, true);			            
            tablerominas.appendChild(div);
            ind++;
        }
    }		    
    
}

function mostrarNumero(e){
	var auxstr = this.id.split("");
	var myid = "";
	for (var i = 0; i < auxstr.length; i++) {
		myid += auxstr[i];
	}			
	console.log(myid);
	divObj = document.getElementById(myid);

	if(minas[parseInt(auxstr[0],10)][parseInt(auxstr[1],10)] == 0){
		divObj.style.backgroundColor = "white";					
		abrirAlrededor(parseInt(auxstr[0],10),parseInt(auxstr[1],10),minas);
	}else{
		if(minas[parseInt(auxstr[0],10)][parseInt(auxstr[1],10)] != "*"){
			document.getElementById(myid).innerHTML = "<p style='margin-top:15px;'>" + minas[parseInt(auxstr[0],10)][parseInt(auxstr[1],10)] + "</p>";
			divObj.style.backgroundColor = "white";
		}else{
			divObj.style.backgroundImage = "url(img/bomba.jpg)";					
			abrirTablero(minas);
			alert("Perdiste !!!");
		}
	}						
}				

function bombasAlrededor(tablero){
	for(var i = 0; i < filas; i++){
        for(var j = 0; j < columnas; j++){			           
           if(tablero[i][j] == "*"){
           		if(i == 0 && j == 0){
           			colocaNumeroBombas(i, j, i + 1, j + 1,tablero);
           		}
           		else if (i == 0 && (j > 0 && j < 7)) {
           			colocaNumeroBombas(i, j - 1, i + 1, j + 1,tablero);
           		}
           		else if(i == 0 && j == 7){
           			colocaNumeroBombas(i, j - 1, i + 1, j,tablero);
           		}
           		else if(j == 7 && (i > 0 && i < 7)){
           			colocaNumeroBombas(i - 1, j - 1, i + 1, j,tablero);
           		}
           		else if(i == 7 && j == 7){
           			colocaNumeroBombas(i - 1, j - 1, i, j,tablero);
           		}
           		else if(i == 7 && (j > 0 && j < 7)){
           			colocaNumeroBombas(i - 1, j - 1, i, j + 1,tablero);
           		}
           		else if(i == 7 && j == 0){
           			colocaNumeroBombas(i - 1, j, i, j + 1,tablero);
           		}
           		else if(j == 0 && (i > 0 && i < 7)){
           			colocaNumeroBombas(i - 1, j, i + 1, j + 1,tablero);
           		}else{
           			colocaNumeroBombas(i - 1, j - 1, i + 1, j + 1,tablero);
           		}
           }
        }
    }
}

function colocaNumeroBombas(vari,varj,fini,finj,tablero){
	for(var i = vari; i <= fini; i++){
        for(var j = varj; j <= finj; j++){			           
           if(tablero[i][j] != "*"){
           		tablero[i][j] = (parseInt(tablero[i][j])+1);		           		
           }
        }
    }
}

function crearMinas(tablero){
	var fil = 0;
	var col = 0;

	fil = Math.floor((Math.random()*(filas-1))+0);
	console.log(fil);
	col = Math.floor((Math.random()*(columnas-1))+0);
	console.log(col);

	for(var i = 0; i < totalMinas; i++){
		while (tablero[fil][col] == "*"){
			fil = Math.floor((Math.random()*(filas-1))+0);
			col = Math.floor((Math.random()*(columnas-1))+0);
		}
		tablero[fil][col] = "*";			
	}
}

function abrirCeros(vari,varj,fini,finj,cori,corj,tablero){
	for(var i = vari; i <= fini; i++){
        for(var j = varj; j <= finj; j++){		
        	var myid = i+""+j;
        	var objDiv =  document.getElementById(myid)	           
           if(objDiv.textContent == ""){			           		
           		if(tablero[i][j] == 0){			           			
           			if(i == cori && j == corj){			           				
           				objDiv.textContent = ""	; 
           				objDiv.style.backgroundColor = "white";	          				
           			}else{
           				if(objDiv.style.backgroundColor != "white"){
           					abrirAlrededor(i, j,tablero);
           				}			           				
           			}

           		}else{
           			if(tablero[i][j] != "*"){
           				document.getElementById(myid).innerHTML = "<p style='margin-top:15px;'>" + tablero[i][j] + "</p>"; 
           				objDiv.style.backgroundColor = "white";	
           			}
           		}			           			           		
           }			           
        }
    }
}

function abrirAlrededor(xi,xj,tablero){
	if(xi == 0 && xj == 0){
		abrirCeros(xi, xj, xi + 1, xj + 1, xi, xj,tablero);
	}
	else if(xi == 0 && (xj > 0 && xj < (columnas-1))){
		abrirCeros(xi, xj - 1, xi + 1, xj + 1, xi, xj,tablero);
	}
	else if(xi == 0 && xj == 7){
		abrirCeros(xi, xj - 1, xi + 1, xj, xi, xj,tablero);
	}
	else if(xj == (filas-1) && (xi > 0 && xi < (columnas-1))){
		abrirCeros(xi - 1, xj - 1, xi + 1, xj, xi, xj,tablero);
	}
	else if(xi == (filas-1) && xj == 7){
		abrirCeros(xi - 1, xj - 1, xi, xj, xi, xj,tablero);
	}
	else if(xi == (filas-1) && (xj > 0 && xj < (columnas-1))){
		abrirCeros(xi - 1, xj - 1, xi, xj + 1, xi, xj,tablero);
	}
	else if(xi == (filas-1) && xj == 0){
		abrirCeros(xi - 1, xj, xi, xj + 1, xi, xj,tablero);
	}
	else if(xj == 0 && (xi > 0 && xi < (columnas-1))){
		abrirCeros(xi - 1, xj, xi + 1, xj + 1, xi, xj,tablero);
	}else{
		abrirCeros(xi - 1, xj - 1, xi + 1, xj + 1, xi, xj,tablero);
	}
} 

function abrirTablero(tablero){
	for(var i = 0; i < filas; i++){
        for(var j = 0; j < columnas; j++){	
        	var myid = i+""+j;
        	var objDiv =  document.getElementById(myid);		           
           if(tablero[i][j] == "*"){			        		
           		objDiv.style.backgroundImage = "url(img/bomba.jpg)";
           }
        }
    }
}