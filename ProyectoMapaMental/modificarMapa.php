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
<body> 

    <header>  
    <h2>SELECCIONAR BASE DE DATOS</h2>
    </header>
        
    <form id="form" action="mod.php" method="post" name="savedt" > 
        
    <?php  
    session_start();
    include('conectaBD.php');

    //establecer conexion con la BD poniendo los argumentos SERVIDOR DE BASE, EL USUARIO ROOT, CONTRASEÑA(EN CASO DE NO TENER SE POENEN "").
    //or die: es en el caso de que falle la conexion.
    $conexion = mysqli_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD) or die ("No se ha podido conectar al servidor de Base de datos");

    //seleccion de la BD con la variable de CONEXION y BD.
    $db = mysqli_select_db( $conexion, MYSQL_DATABASENAME ) or die ( "No se ha podido conectar a la base de datos" );
    $base=MYSQL_DATABASENAME;
    //preparar la sentencia de buscar los datos.
    $consulta = "SHOW FULL TABLES FROM ".$base;

    //obtengo en la variable RESULTADO  el resultado de la consulta (query) que requiere la CONEXION y la CONSULTA.
    $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
    while ($fila = mysqli_fetch_row($resultado)) {
        echo '<input type="submit" name="bd" value='.$fila[0].' id='.$fila[0].'>';
    }
    
    ?>
    </form>
    
</body>
</html>



