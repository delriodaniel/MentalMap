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
    </style>

</head>
<body>
    <header > 
        <h1>MapCrtr</h1>
        <nav >
            <button id="btCreate" type="button" class="ClHeadButton" role="link" onclick="window.location='nuevoMapa.php'" >Crear nuevo mapa</button>
            <button id="btModify" type="button" class="ClHeadButton"  role="link" onclick="window.location='modificarMapa.php'">Modificar mapa existente</button>
        </nav>
    </header>
    <div>
        <section>
            <h2>Para un apuro...</h2>
            <p class="p1">&nbsp;&nbsp;&nbsp;&nbsp;¿Quien no ha tenido en algun momento una idea en un lugar sin recursos para plasmarla?<br>
            Se que es tu caso, pues bien, has venido al rincón perfecto para organizar tu gran idea.</p>
            
            <h2>La oferta es tentadora...</h2>
            <p class="p2">&nbsp;&nbsp;&nbsp;&nbsp;Quisiera ofrecerte el mejor de los servicios y la mayor de las facilidades para crear tu esquema.<br>
            Cuentas con la facilidad de guardar y cargar tus propios mapas, de este modo todo te resultara tremendamente comodo<br>
            cada vez que te encuentres lejos de un ordenador.</p>
        </section>
    </div>
    <footer>
        <h3>!!!Usame¡¡¡ Pienso cobrarte lo mismo si me utilizas como si no.</h3>
    </footer>
</body>
</html>