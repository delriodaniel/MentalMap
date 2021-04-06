<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
	<title>Bienvenido</title>
    <style>
        @media (min-width:320px)  { 
        /* smartphones, portrait iPhone, portrait 480x320 phones (Android) */
            table, p, img {
            padding-right: 1em;
            width: 100%;
            }
        }
        @media (min-width:480px)  { 
        /* smartphones, Android phones, landscape iPhone */ 
        }
        @media (min-width:600px)  { 
        /* portrait tablets, portrait iPad, e-readers (Nook/Kindle), landscape 800x480 phones (Android) */ 
        }
        @media (min-width:801px)  { 
        /* tablet, landscape iPad, lo-res laptops ands desktops */ 
        }
        @media (min-width:1025px) { 
        /* big landscape tablets, laptops, and desktops */ 
        }
        @media (min-width:1281px) { 
        /* hi-res laptops and desktops */ 
        }
        html, body{
            margin: 1em;
            background-color: lightgray;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        input{
            padding: 1em;
            margin-right: 1em;
            background: lightgray;
			border-radius: 20px 20px 20px 0px;
            cursor: pointer;
        }
        input:hover{
            background-color: grey;
        }
        div{
            display: flex;
            justify-content: left;
            align-content: left;   
            
        }
        h2{
            margin-top: 2em;
        }
        li{
            margin-top: 1.5em;
        }
        li nav{
            margin-top: 0.5em;
            display: flex;
            justify-content: left;
            align-content: left; 
        }
        
        header{
            background-color: lightskyblue;
            padding: 1em;
            border-radius: 20px 20px 20px 0px;
            
            
        }
        
        footer{
            margin-top: 2em;
            position: relative;
            bottom: 0%;
            background-color: lightskyblue;
            padding: 1em;
            border-radius: 20px 20px 20px 0px;
            display: flex;
            justify-content: left;
            align-content: center;
        }
        
        #btLoad{
            margin-right: 30%;

        }
        #dvForm{
            background-color: lightskyblue;
            padding: 1em;
            border-radius: 0px 20px 20px 0px;
        }
        .dvCreated{
            background-color: gray;
        }
        
    </style>

</head>
<body> 

    <header> 
        <nav>
            <div id="dvEdit"> 
                <input id="firstbt" class="btEdit" type="button" onclick="createFirstContent()" value="Primer nodo" ></input>
            </div>
        </nav> 
    </header>
    <form id="form" action="Guardar.php" method="post" name="savedt" > 
        <div id="dvForm">
        <input type="submit" id="arrayAr" name="save" onclick="active()" value="Guardar">
        </div>
        
    </form>
    
</body>
</html>

<script>

// Capturamos el click y lo pasamos a una funcion
// var elementsClick="";

// function capture_click(e) {
// // Funcion para capturar el click del raton
//     var madeClick = e.target.tagName;
//     // Añadimos el elemento al array de elementos
//     elementsClick=madeClick;
//     alert(elementsClick);
//     // Una prueba con salida en consola
    
// }
// if(elementsClick==""){
//     document.onclick = capture_click;
// }
var contul=0;
var contli=0;
function createFirstContent(){
    var bt = document.getElementById("firstbt");
    var form = document.getElementById("form");
    bt.setAttribute("disabled","");

    var newDiv = document.createElement("div");
    newDiv.setAttribute("id","dvprincip");
    newDiv.setAttribute("class","dvCreated");
    newDiv.setAttribute("name","divpr");
    
    var newInput=document.createElement("input");
    newInput.setAttribute("type","text");
    newInput.setAttribute("id","textArgPr");
    newInput.setAttribute("name","textArg");

    newDiv.appendChild(newInput);

    form.appendChild(newDiv);
    navEditor("dvprincip");
    
}

function createNode(){
    
    var newInput=document.createElement("input");
    newInput.setAttribute("type","text");
    newInput.setAttribute("class","textArg");
    newInput.setAttribute("name","inputsText[]");

    
    return newInput;

}

function navEditor(e){
    var contntn=document.getElementById(e);
    var newNav = document.createElement("nav");
    newNav.setAttribute("class","navEditor");

    var bt1=document.createElement("input");
    bt1.setAttribute("type","button");
    bt1.setAttribute("value","aceptar");
    bt1.setAttribute("class","firstnav");
    bt1.setAttribute("onclick",'acept("'+e+'")');
    
    var bt2=document.createElement("input");
    bt2.setAttribute("type","button");
    bt2.setAttribute("value","+"); 
    bt2.setAttribute("disabled","");
    bt2.setAttribute("class","firstnav");
    bt2.setAttribute("onclick",'addel("'+e+'",this)');

    var bt3=document.createElement("input");
    bt3.setAttribute("type","button");
    bt3.setAttribute("value","-");
    bt3.setAttribute("onclick",'erase(this)');
    bt3.setAttribute("disabled","");
    bt3.setAttribute("class","firstnav");

    var bt4=document.createElement("input");
    bt4.setAttribute("type","button");
    bt4.setAttribute("value","editar");
    bt4.setAttribute("onclick",'edit("'+e+'")');
    bt4.setAttribute("disabled","");
    bt4.setAttribute("class","firstnav");

    newNav.appendChild(bt1);
    newNav.appendChild(bt2);
    newNav.appendChild(bt3);
    newNav.appendChild(bt4);
    contntn.appendChild(newNav);
    letInputId();
}
    
    function contadorP(){
        var parentgl=document.getElementById("form");
        var inputsText=parentgl.getElementsByTagName("input");
        var arrPos=[];
        var auxArr=[];
        for ( index = 0; index < inputsText.length; index++) {
            if(inputsText[index].getAttribute("type")=="text"){
                arrPos.push(countParent(parentgl,inputsText[index],0));
            }
        }
        return arrPos;
    }

    function countParent(parentGlobal,elementoCont,cont){
        var aux=cont;
         if(elementoCont.nodeName==parentGlobal.nodeName){
            return aux;
            exit;
        }
        else {
            aux++;
            return countParent(parentGlobal,elementoCont.parentNode,aux);
        }
    }
    function arrStr(arrayR){
        return arrayR.toString();
    }
    

// function findinpttext(){
//     var aux="";
//     var inpt=document.getElementsByTagName("input");
//     for ( index = 0; index < inpt.length; index++) {
//         if(inpt[index].gettype=="text"){
//             aux= inpt[index].getAttribute("id");
//             alert(aux);
//         }else{
//             alert("no funciona nada");
//         }
//     }
//     return aux;
// }

function acept(e){
    activGuard();
    var contenT=document.getElementById(e);
    var inputs=contenT.childNodes;
    var exp;
    var inputsCopy=[];
    var dvNavP;

    for (index = 0; index < inputs.length; index++) {
        if(inputs[index].parentNode.nodeName=="DIV"){
            dvNavP=document.getElementById(e);
            inputsCopy=dvNavP.getElementsByTagName("input");
            
        }else if(inputs[index].parentNode.nodeName=="LI"){
            
            if(inputs[index].nodeName!="UL"){
               
            }
             if(inputs[index].nodeName=="INPUT"){
                
                inputsCopy.push(inputs[index]);
            }
             if(inputs[index].nodeName=="NAV"){
                
                exp=inputs[index].childNodes;
                inputsCopy.push(exp[0]);
                inputsCopy.push(exp[1]);
                inputsCopy.push(exp[2]);
                inputsCopy.push(exp[3]);
                    
            }
 
        }  
    }
    
    for (index2 = 0; index2 < inputsCopy.length; index2++) {
        if(inputsCopy[index2].getAttribute("disabled")!=null){
            inputsCopy[index2].removeAttribute("disabled");
        }else{
            inputsCopy[index2].setAttribute("disabled","");
        }  
                
    }
       
}


function edit(e){
    activGuard();
    var contenT=document.getElementById(e);
    var inputs=contenT.childNodes;
    var exp;
    var inputsCopy=[];
    var dvNavP;
    for (index = 0; index < inputs.length; index++) {
        if(inputs[index].parentNode.nodeName=="DIV"){
            dvNavP=document.getElementById(e);
            inputsCopy=dvNavP.getElementsByTagName("input");
        }else if(inputs[index].parentNode.nodeName=="LI"){
            
            if(inputs[index].nodeName=="UL"){
                continue;
            }
            if(inputs[index].nodeName=="INPUT"){
                
                inputsCopy.push(inputs[index]);
            }
            if(inputs[index].nodeName=="NAV"){
                
                    exp=inputs[index].childNodes;
                    inputsCopy.push(exp[0]);
                    inputsCopy.push(exp[1]);
                    inputsCopy.push(exp[2]);
                    inputsCopy.push(exp[3]);    
            }

        }  
    }
    for (index2 = 0; index2 < inputsCopy.length; index2++) {
        if(inputsCopy[index2].getAttribute("disabled")!=null){
            inputsCopy[index2].removeAttribute("disabled");
        }else{
            inputsCopy[index2].setAttribute("disabled","");
        }  
                
    }
    // var alue=trans(contadorP()).toString;
    // alert(alue);
}

function addel(e,idB){
    activGuard();
    var dir=document.getElementById(e);
    var ulN;
    
    if(dir.nodeName=="DIV"){
        ulN=document.body.getElementsByTagName("ul");
        if(ulN.length==0){
            createUl(dir);
            letUlId();
            letLiId();
     
        }else{
            for ( index2 = 0; index2 < ulN.length; index2++) {  
                addLi(ulN[index2]);
            }     
        }
    }else{
        ulN=dir.getElementsByTagName("ul");
        if(ulN.length==0){
            
            createUl(dir);
            letUlId();
            letLiId();
      
        }else{
            for ( index2 = 0; index2 < ulN.length; index2++) {   
                addLi(ulN[index2]);
            }     
        }
    }
    
    var part=document.getElementById(idB.id).parentNode.parentNode;
    var idPart=part.id;
    var auxli;
    var contli;
    var aux;
    var cont;
    if(part.nodeName=="LI"){
        aux=document.getElementById(idPart);
        var auxUl=aux.getElementsByTagName("ul");
        if(auxUl.length==1){
            contli=auxUl[0].getElementsByTagName("li");
            for ( index = 0; index < contli.length; index++) {
                auxli=contli[index].id; 
            }
        }else{
            for (index = 0; index < auxUl.length; index++) {
                contli=auxUl[index].getElementsByTagName("li");
                for (index2 = 0; index2 < contli.length; index2++) {
                    if(contli[index2].getElementsByTagName("input").length<5){
                        auxli=contli[index2].id;
                        
                    }
                    
                }
                
            }
        }
        cont=auxli;

    }else{

        var auxUl=document.body.getElementsByTagName("ul");

        if(auxUl.length==1){
            contli=auxUl[0].getElementsByTagName("li");
            for ( index = 0; index < contli.length; index++) {
                auxli=contli[index].id;
            }
        }else{
            for (index = 0; index < auxUl.length; index++) {
                contli=auxUl[0].getElementsByTagName("li");
                for (index2 = 0; index2 < contli.length; index2++) {
                    if(contli[index2].getElementsByTagName("input").length<5){
                        auxli=contli[index2].id;  
                    }
                    
                }
                
            }
        }
        cont=auxli;
    } 
    navEditor(cont);  
    limpiar();
}

function erase(btid){
    activGuard();

    var contli=document.getElementById(btid.id).parentNode.parentNode;
    var contul=contli.parentNode;  

    if(contul.nodeName=="UL"){
        if(contul.childNodes.length==1){
            var eras=contul.parentNode.removeChild(contul);
        }else{
            var eras=contul.removeChild(contli);
        }
    }else{
        alert("No me borres que soy el titulo del mapa, solo editame.");
    }
}

function createUl(e){
    var uls = document.createElement("ul");
    addLi(uls);
    if(e.nodeName=="DIV"){
        e.parentNode.appendChild(uls);
    }else{
        e.appendChild(uls);
    }      
}


function addLi(e){
    
    var lis = document.createElement("li");
    lis.setAttribute("class","lis");

    lis.appendChild(createNode());
    e.appendChild(lis);
    letLiId();
}

function getChildNodes(element) {
    let result=[];
    for (var i = 0; i < element.childNodes.length; i++) { // cuenta los hijos primarios que tiene
        if(element.childNodes[i].getAttribute("type")=="button"){
            continue;
        }
        result.push(element.childNodes[i]);
        if (element.childNodes[i].getAttribute("type")=="text") { // si es un texto no lo guardamos
            result.push(element.childNodes[i]);
            continue;
        }
            
        if (element.childNodes[i].hasChildNodes()) { // si tiene hijos
            result=result.concat(getChildNodes(element.childNodes[i])); // llamamos la funcion nuevamente
        }
    }
    return result;
}



function active(){
    var ele=document.getElementsByTagName("input");
    for ( index = 0; index < ele.length; index++) {
        if(ele[index].getAttribute("type")=="text"){
            ele[index].removeAttribute("disabled","");
        }   
    }
    var arasig=arrStr(contadorP());
    document.getElementById("arrayAr").value=arasig;
    document.getElementById("arrayAr").setAttribute("hidden","");

}

function limpiar(){
    var elementosABorrar=document.getElementsByTagName("li");
    for ( index = 0; index < elementosABorrar.length; index++) {
        
        if(elementosABorrar[index].childNodes.length<2){
            var eras=elementosABorrar[index].parentNode.removeChild(elementosABorrar[index]);
        }
        
    }
}
function activGuard(){
    var bt= document.getElementById("arrayAr");
    if(bt.hasAttribute("hidden")==true){
        bt.removeAttribute("disabled","");
    }
}


///////////////////////////
//asignacion de ids dinamicamente
//////////////////////////

function letUlId(){
    var uls = document.getElementsByTagName("ul");
    var index;
    for (index = 0; index < uls.length; index++) {
        uls[index].setAttribute("id","ul_"+index);   
    }   
}

function letLiId(){
    var uls = document.getElementsByTagName("ul");
    var lis ;

    for ( index = 0; index < uls.length; index++) {
        lis=uls[index].getElementsByTagName("li");
        for ( index2 = 0; index2 < lis.length; index2++) {
            if(lis[index2].parentNode==uls[index]){
                if(lis[index2].hasAttribute("id")==false){
                lis[index2].setAttribute("id","li_"+index2+"_"+uls[index].getAttribute("id"));
                 }
            } 
        }  
    }    
}

function letInputId(){
    var auxNm="";
    var x;
    var inptsNm=document.getElementsByTagName("input");
    for ( index = 0; index < inptsNm.length; index++) {
        if(inptsNm[index].hasAttribute("id")==false){
            auxNm=inptsNm[index].parentNode.parentNode.id;
            X=inptsNm[index].setAttribute("id",auxNm+"_"+index);   
        }  
    }
}


</script>

<?php

 

?>