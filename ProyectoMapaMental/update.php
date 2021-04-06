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
        button{
            padding: 1em;
            margin-right: 1em;
            background: lightgray;
			border-radius: 20px 20px 20px 0px;
            cursor: pointer;
        }
        button:hover{
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
            justify-content: center;
            align-content: center;
        }
        a {    font-family: verdana, arial, sans-serif;
            font-size: 10pt;
            font-weight: bold;
            padding: 4px;
            background-color: #ffffcc;
            color: #666666;
            text-decoration: none;
        }
        a:link,
        a:visited {
            border-top: 1px solid #cccccc;
            border-bottom: 2px solid #666666;
            border-left: 1px solid #cccccc;
            border-right: 2px solid #666666;
        }
        a:hover {
            border-bottom: 1px solid #cccccc;
            border-top: 2px solid #666666;
            border-right: 1px solid #cccccc;
            border-left: 2px solid #666666;
        }
    </style>
    </head>
<body>

</body>
</html>


<?php
session_start();
include('conectaBD.php');
$stringRecibido=$_POST["save"];
$inputs=$_POST['inputsText'];
$tit=$_POST["textArg"];


$enlace = mysqli_connect(MYSQL_SERVER,MYSQL_USER,MYSQL_PASSWORD)or die ("No se ha podido conectar al servidor de Base de datos");
$db = mysqli_select_db( $enlace, MYSQL_DATABASENAME )or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );

$sqldrop="DROP TABLE IF EXISTS `".$tit."` ";
$resultadodrop = mysqli_query( $enlace, $sqldrop ) or die ( "Algo ha ido mal en la consulta a la base de datos seguramente");


//obtengo en la variable RESULTADO  el resultado de la consulta (query) que requiere la CONEXION y la CONSULTA.



$sentence="CREATE TABLE  `".$tit."`(nodos_al_padre int(10) ,contenido_input varchar(100)) ";
$resultado = mysqli_query( $enlace, $sentence ) or die ( "Algo ha ido mal en la consulta a la base de datos seguramente");


for ($i=0; $i < sizeof($arrayR); $i++) {
    $uno=1;
    $aux;
    if($i>0){
        $aux=$inputs[$i-$uno];
        
    }else{
        $aux=$tit;
    }
    $res=mysqli_query( $enlace, "SELECT EXISTS (SELECT * FROM `".$tit."` WHERE contenido_input='$aux');" );
        $row=mysqli_fetch_row($res); 
    if ($row[0]=="1") {                 

        //Aqui colocas el código que tu deseas realizar cuando el dato existe en la base de datos
    }else{
        if($i==0){
            $sql = "INSERT INTO `".$tit."` (nodos_al_padre, contenido_input) values('" . $arrayR[$i] . "', '" . $tit . "')";
            $resultado2 = mysqli_query( $enlace, $sql ) or die ( "Algo ha ido mal en la consulta a la base de datos coño aqui");    
        }
        if($i>0){
            
            $sql = "INSERT INTO `".$tit."` (nodos_al_padre, contenido_input) values('" . $arrayR[$i] . "', '" . $aux . "')";
            $resultado2 = mysqli_query( $enlace, $sql ) or die ( "Algo ha ido mal en la consulta a la base de datos coño aqui");    
        }
    }
}

mysqli_close($enlace);

$xml = new XMLWriter();
$xml->openMemory();
$xml->setIndent(true);
$xml->setIndentString('	'); 
$xml->startDocument('1.0', 'UTF-8');

    //posible array de contadores para ver en que posicion estaria 
    //cada uno de los input recogido cuantos nodos por encima esta el padre de todos
 // $asmentitems = new SimpleXMLElement('asessmentitem.xml',null,true);
$xml->startElement("form");

    for ($i=0; $i < sizeof($arrayR); $i++) { 
        if($i==0){
            $xml->startElement("div");
                $xml->startElement("input");
                $xml->text($tit);
                $xml->endElement();
            $xml->endElement();
        }else{
            $auxPos=$arrayR[$i];
            if($i==1){
                $xml->startElement("ul");
                    $xml->startElement("li");
                        $xml->startElement("input");
                        $xml->text($inputs[$i-1]);
                        $xml->endElement();

            }else{
                if($arrayR[$i]==$arrayR[$i-1]){
                    
                    $xml->endElement();
                $xml->startElement("li");
                    $xml->startElement("input");
                    $xml->text($inputs[$i-1]);
                    $xml->endElement();
                }
                if($arrayR[$i]>$arrayR[$i-1]){
                    $xml->startElement("ul");
                    $xml->startElement("li");
                        $xml->startElement("input");
                        $xml->text($inputs[$i-1]);
                        $xml->endElement();
                }
                if($arrayR[$i]<$arrayR[$i-1]){
                    $saltos=$arrayR[$i-1]-$arrayR[$i]+1;
                    for ($e=0; $e < $saltos; $e++) { 
                        $xml->endElement();
                    }
                    $xml->startElement("li");
                    $xml->startElement("input");
                    $xml->text($inputs[$i-1]);
                    $xml->endElement();
                }
            }

        } 
    }
    $ultimoArr=array_pop($arrayR);
    for ($i=0; $i < $ultimoArr-1; $i++) { 
        $xml->endElement();
    }
    $xml->endElement();

$xml->endElement();

$contente = $xml->outputMemory();
ob_end_clean();
ob_start();
header('Content-Type: application/xml; charset=UTF-8');
header('Content-Encoding: UTF-8');
header("Content-Disposition: attachment;filename=".$tit.".xml");
header('Expires: 0');
header('Pragma: cache');
header('Cache-Control: private');

$file=fopen($tit.".xml","w") or die("Problemas en la creacion");//En esta linea lo que hace PHP es crear el archivo, si ya existe lo sobreescribe
fputs($file,$contente);//En esta linea abre el archivo creado anteriormente e ingresa el resultado de tu script PHP
fclose($file);//Finalmente lo cierra 

$ruta=$tit.".xml";
header ("Content-Disposition: attachment; filename=".$ruta);
header ("Content-Type: application/octet-stream");
header ("Content-Length: ".filesize($ruta));

echo '<a href='.$ruta.' download>Para descargar xml</a>';
echo '<a href="modificarMapa.php">A modificar</a>';
echo '<a href="index.php">A la pagina inicial</a>';


?>