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
            width: 100%;
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
<form id="form" action="update.php" method="post" name="savedt" > 
    
    <header>  
    <input type="submit" id="arrayAr" name="save" onclick="active()" value="Guardar">

    </header>
<body> 

    
        
     
    <?php  
    session_start();
    include('conectaBD.php');
    $varX=$_POST["bd"];
    
    //establecer conexion con la BD poniendo los argumentos SERVIDOR DE BASE, EL USUARIO ROOT, CONTRASEÑA(EN CASO DE NO TENER SE POENEN "").
    //or die: es en el caso de que falle la conexion.
    $conexion = mysqli_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD) or die ("No se ha podido conectar al servidor de Base de datos");

    //seleccion de la BD con la variable de CONEXION y BD.
    $db = mysqli_select_db( $conexion, MYSQL_DATABASENAME ) or die ( "No se ha podido conectar a la base de datos" );

    $consulta = "SELECT * FROM `".$varX."`";
    $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
    $posicionamiento=array();
    $inputsT=array();
    
    while ($columna = mysqli_fetch_array( $resultado ))
    {
        array_push($posicionamiento, $columna['nodos_al_padre']);
        array_push($inputsT, $columna['contenido_input']);
        
    }
    
    $xml = new XMLWriter();
    $xml->openMemory();
    $xml->setIndent(true);
    $xml->setIndentString('	'); 
    $xml->startDocument('1.0', 'UTF-8');
        //posible array de contadores para ver en que posicion estaria 
        //cada uno de los input recogido cuantos nodos por encima esta el padre de todos
    // $asmentitems = new SimpleXMLElement('asessmentitem.xml',null,true);

        for ($i=0; $i < sizeof($posicionamiento); $i++) { 
            if($i==0){
                $xml->startElement("div");
                    $xml->startElement("input");
                    $xml->writeAttribute("value",$inputsT[$i]);
                    $xml->endElement();
                $xml->endElement();
            }else{
                $auxPos=$posicionamiento[$i];
                if($i==1){
                    $xml->startElement("ul");
                        $xml->startElement("li");
                            $xml->startElement("input");
                            $xml->writeAttribute("value",$inputsT[$i]);
                            $xml->endElement();

                }else{
                    if($posicionamiento[$i]==$posicionamiento[$i-1]){
                        
                        $xml->endElement();
                    $xml->startElement("li");
                        $xml->startElement("input");
                        $xml->writeAttribute("value",$inputsT[$i]);
                        $xml->endElement();
                    }
                    if($posicionamiento[$i]>$posicionamiento[$i-1]){
                        $xml->startElement("ul");
                        $xml->startElement("li");
                            $xml->startElement("input");
                            $xml->writeAttribute("value",$inputsT[$i]);
                            $xml->endElement();
                    }
                    if($posicionamiento[$i]<$posicionamiento[$i-1]){
                        $saltos=$posicionamiento[$i-1]-$posicionamiento[$i]+1;
                        for ($e=0; $e < $saltos; $e++) { 
                            $xml->endElement();
                        }
                        $xml->startElement("li");
                        $xml->startElement("input");
                        $xml->writeAttribute("value",$inputsT[$i]);
                        $xml->endElement();
                    }
                }
                
            } 
        }
        $ultimoArr=array_pop($posicionamiento);
        for ($i=0; $i < $ultimoArr-1; $i++) { 
            $xml->endElement();
        }
        $xml->endElement();


    $content = $xml->outputMemory();
    
    echo $content;
    ?>
    </form>
    
</body>
</html>
<script>

cargarNav();
function cargarNav(){
    var lisNav= document.getElementsByTagName("li");
    var divPR=document.getElementsByTagName("div");
    for ( index = 0; index < lisNav.length; index++) {
        if(lisNav[index].childNodes.length>1){
            var auuux=lisNav[index].childNodes;
            cont=0;
            for ( index2 = 0; index2 < auuux.length; index2++) { 
                if(cont==0){
                    if(auuux[index2].nodeName=="INPUT"){
                        var navv= document.createElement("nav");
                        navv.setAttribute("class","navEditor");

                        var bt1= document.createElement("input");
                        bt1.setAttribute("type","button");
                        bt1.setAttribute("value","aceptar");
                        bt1.setAttribute("class","firstnav");
                        bt1.setAttribute("onclick",'acept(this)');
                        


                        var bt2= document.createElement("input");
                        bt2.setAttribute("type","button");
                        bt2.setAttribute("value","+");
                        bt2.setAttribute("class","firstnav");
                        bt2.setAttribute("onclick",'addel(this)'); 
                        bt2.setAttribute("disabled","");


                        var bt3= document.createElement("input");
                        bt3.setAttribute("type","button");
                        bt3.setAttribute("value","-");
                        bt3.setAttribute("class","firstnav");
                        bt3.setAttribute("onclick",'erase(this)');  
                        bt3.setAttribute("disabled","");
                                        
                        var bt4= document.createElement("input");
                        bt4.setAttribute("type","button");
                        bt4.setAttribute("value","editar");
                        bt4.setAttribute("class","firstnav");
                        bt4.setAttribute("onclick",'edit(this)');
                        bt4.setAttribute("disabled",""); 


                        navv.appendChild(bt1);
                        navv.appendChild(bt2);
                        navv.appendChild(bt3);
                        navv.appendChild(bt4);
                        lisNav[index].insertBefore(navv,auuux[index2+1]);
                        break;
                    }


                }
  
            }
 
        }
                
        
    }
    if(divPR.length==1){
        var navv= document.createElement("nav");
        navv.setAttribute("class","navEditor");

        
        var bt1= document.createElement("input");
        bt1.setAttribute("type","button");
        bt1.setAttribute("value","aceptar");
        bt1.setAttribute("class","firstnav");
        bt1.setAttribute("onclick",'acept(this)');
        

        var bt2= document.createElement("input");
        bt2.setAttribute("type","button");
        bt2.setAttribute("value","+");
        bt2.setAttribute("class","firstnav");
        bt2.setAttribute("onclick",'addel(this)'); 
        bt2.setAttribute("disabled","");


        var bt3= document.createElement("input");
        bt3.setAttribute("type","button");
        bt3.setAttribute("value","-");
        bt3.setAttribute("class","firstnav");
        bt3.setAttribute("onclick",'erase(this)');  
        bt3.setAttribute("disabled","");
                        
        var bt4= document.createElement("input");
        bt4.setAttribute("type","button");
        bt4.setAttribute("value","editar");
        bt4.setAttribute("class","firstnav");
        bt4.setAttribute("onclick",'edit(this)');
        bt4.setAttribute("disabled","");


        navv.appendChild(bt1);
        navv.appendChild(bt2);
        navv.appendChild(bt3);
        navv.appendChild(bt4);
        divPR[0].appendChild(navv);

    }
    letUlId();
    letLiId();
    letInputId();
    inputsNa();
}


function acept(e){
    activGuard();

    var liCont = e.parentNode.parentNode;
    for ( index = 0; index < liCont.childNodes.length; index++) {
        if(liCont.childNodes[index].nodeName=="INPUT"){
            liCont.childNodes[index].setAttribute("disabled","");
        }else if(liCont.childNodes[index].nodeName=="NAV"){
            var auxN=liCont.childNodes[index].childNodes;
            for ( index2 = 0; index2 < auxN.length; index2++) {
                if(index2==0){
                    auxN[index2].setAttribute("disabled","");
                }else{
                    auxN[index2].removeAttribute("disabled");
                }
                
            }
        }
        
    }
    
}

function addel(e){
    activGuard();

    var contGuia=e.parentNode.parentNode;
    if(contGuia.nodeName=="DIV"){
        ulN=document.body.getElementsByTagName("ul");
        if(ulN.length==0){
            createUl(contGuia);
            letUlId();
            letLiId();
     
        }else{
            for ( index2 = 0; index2 < ulN.length; index2++) {  
                addLi(ulN[index2]);
            }     
        }
    }else{
        ulN=contGuia.getElementsByTagName("ul");
        if(ulN.length==0){
            
            createUl(contGuia);
            letUlId();
            letLiId();
      
        }else{
            for ( index2 = 0; index2 < ulN.length; index2++) {   
                addLi(ulN[index2]);
            }     
        }
    }
    var part=contGuia;
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
    createnavEditor(cont);  
    limpiar();

}
function erase(e){
    activGuard();

    var contli=e.parentNode.parentNode;
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

function edit(e){
    activGuard();
    var liCont = e.parentNode.parentNode;
    for ( index = 0; index < liCont.childNodes.length; index++) {
        if(liCont.childNodes[index].nodeName=="INPUT"){
            liCont.childNodes[index].removeAttribute("disabled");
        }else if(liCont.childNodes[index].nodeName=="NAV"){
            var auxN=liCont.childNodes[index].childNodes;
            for ( index2 = 0; index2 < auxN.length; index2++) {
                if(index2==0){
                    auxN[index2].removeAttribute("disabled");

                }else{
                    
                    auxN[index2].setAttribute("disabled","");

                }
                
            }
        }
        
    }

}
function createnavEditor(e){
    var contntn=document.getElementById(e);
    var newNav = document.createElement("nav");
    newNav.setAttribute("class","navEditor");

    var bt1=document.createElement("input");
    bt1.setAttribute("type","button");
    bt1.setAttribute("value","aceptar");
    bt1.setAttribute("class","firstnav");
    bt1.setAttribute("onclick",'acept(this)');
    
    var bt2=document.createElement("input");
    bt2.setAttribute("type","button");
    bt2.setAttribute("value","+"); 
    bt2.setAttribute("disabled","");
    bt2.setAttribute("class","firstnav");
    bt2.setAttribute("onclick",'addel(this)');

    var bt3=document.createElement("input");
    bt3.setAttribute("type","button");
    bt3.setAttribute("value","-");
    bt3.setAttribute("onclick",'erase(this)');
    bt3.setAttribute("disabled","");
    bt3.setAttribute("class","firstnav");

    var bt4=document.createElement("input");
    bt4.setAttribute("type","button");
    bt4.setAttribute("value","editar");
    bt4.setAttribute("onclick",'edit(this)');
    bt4.setAttribute("disabled","");
    bt4.setAttribute("class","firstnav");

    newNav.appendChild(bt1);
    newNav.appendChild(bt2);
    newNav.appendChild(bt3);
    newNav.appendChild(bt4);
    contntn.appendChild(newNav);
    letInputId();
}
function createNode(){
    
    var newInput=document.createElement("input");
    newInput.setAttribute("type","text");
    newInput.setAttribute("class","textArg");
    newInput.setAttribute("name","inputsText[]");

    
    return newInput;

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

function limpiar(){
    var elementosABorrar=document.getElementsByTagName("li");
    for ( index = 0; index < elementosABorrar.length; index++) {
        
        if(elementosABorrar[index].childNodes.length<2){
            var eras=elementosABorrar[index].parentNode.removeChild(elementosABorrar[index]);
        }
        
    }
}
function addLi(e){
    
    var lis = document.createElement("li");
    lis.setAttribute("class","lis");

    lis.appendChild(createNode());
    e.appendChild(lis);
    letLiId();
}

function inputsNa(){
    var inpts=document.getElementsByTagName("input");
    for ( index = 0; index < inpts.length; index++) {
        if(inpts[index].type=="text"){
            if(inpts[index].id=="form_1"){
                inpts[index].setAttribute("name","textArg");
            }else{
                inpts[index].setAttribute("name","inputsText[]");
            }
        }
        
    }
}
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
function active(){
    var ele=document.getElementsByTagName("input");
    for ( index = 0; index < ele.length; index++) {
        if(ele[index].type=="text"){
            ele[index].removeAttribute("disabled","");
        }   
    }
    var arasig=arrStr(contadorP());
    document.getElementById("arrayAr").value=arasig;
    document.getElementById("arrayAr").setAttribute("hidden","");

}
function activGuard(){
    var bt= document.getElementById("arrayAr");
    if(bt.hasAttribute("hidden")==true){
        bt.removeAttribute("disabled","");
    }
}
function contadorP(){
        var parentgl=document.getElementById("form");
        var inputsText=parentgl.getElementsByTagName("input");
        var arrPos=[];
        var auxArr=[];
        for ( index = 0; index < inputsText.length; index++) {
            if(inputsText[index].type=="text"){
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

</script>



