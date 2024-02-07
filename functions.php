<?php
//definimos la funcion managePlayer(), las cuales como parametros utilizaran la variable global (o bueno, que se afecta fuera del script, esto inficado por & antes del nombre de variable)
//por lo que estamos diciendo que para usar la funcion le daremos 2 datos, uno como players, y otro como players_key (que basicamente corresponden al array de jugadores y a la key "jugador1" o "jugador2" (el jugador actual pues))
function managePlayers(&$players,  $players_key)
{
    //se genera la variable local "jugador_actual", la cual corresponde al valor de "players" (recordar en este caso es el array de jugadores) con la key "players_key" (que se utiliza para seleccionar el jugador dentro del array jugadores)
    $jugador_actual = $players[$players_key];


    //ya con la informacion guardada en la variable temporal "jugador_Actual", se verifica si en ese jugador en cuestion el valor asociado a la key "cantidad" sea igual a 0
    if ($jugador_actual["cantidad"] == 0) {

        //si el valor de cantidad es igual a 0, quiere decir que apenas inicia el turno del jugador
        //por lo que si queremos guardar el tiempo total de ejecucion del turno, es necesario guardar el tiempo de inicio
        //por lo que si el jugador apenas inicia su turno, se  guarda en la key "tiempo" y a su vez en la key "inicio" el valor en microtime actual
        $jugador_actual["tiempo"]["inicio"] = microtime(true);

        //como ya tenemos el tiempo en el que inicio su turno, para poder calcular cuanto se demoro jugando, debemos guardar el valor de finalizacion del turno
        //para esto la funcion verifica si el valor asociado a "cantidad" es igual al de la constante MAX_POINT
        //ojo, no a MAX_POINT+10 por que recordar que este no es el final del turno, si no la pantalla de preparacion para el otro turno
    } elseif ($jugador_actual['cantidad'] == MAX_POINT) {

        //y va a guardar esta informacion final en la key "tiempo" y a su vez en la key "fin"
        $jugador_actual["tiempo"]["fin"] = microtime(true);
    }

    //una vez definidos los tiempos, la funcion tomara el valor que se encuentra en la key "cantidad" y lo autoincrementara en 1 valor (++)
    $jugador_actual['cantidad']++;

    //crea un campo llamado "nombre" en jugador_actual, lo que se guarda es el valor almacenado en players_key (jugador1 o jugador2)
    $jugador_actual['nombre'] = $players_key;
    //guarda dentro de "jugador_actual" el valor players[players_key], en este caso, el jugador dentro del array jugadores
    $players[$players_key] = $jugador_actual;
    //devuelve el jugador actual,que con los datos anteriormente mostrados sera jugador1 o jugador2
    return $jugador_actual;
}
//esta funcion se encarga de dar formato a impresion de resultados. se le otorga la informacion del jugador_actual
function managePlayerScene($jugador_actual)
{

    //se le avisa que vamos a usar los valores de la variable global jugadores. es decir, que la variable esta en otro script.
    global $jugadores;

    //definimos el headerhtml o el encabezado
    headerhtml();
?>
    <!--se indica que se utilizara una clase "cajon", estas ya las reconoce HTML -->
    <div class='cajon'>

        <!--entonces se verifica si el jugador actual posee el valor 0 en su key "cantidad" -->
        <?php
        if ($jugador_actual['cantidad'] == 0) :
        ?>
            <!-- como el valor es en 0, se va a mostrar la pantalla de inicio, la cual le avisa al jugador que recargue la pagina para iniciar -->
            recarga para iniciar <strong><?= $jugador_actual['nombre'] ?></strong>

            <?php
            if ($jugador_actual['nombre'] == 'jugador1') :
            ?>
                <img src="goku1.png" alt="retrato identificador de jugador 1">
            <?php elseif ($jugador_actual['nombre'] == 'jugador2') : ?>
                <img src="vegueta1.png" alt="retrato identificador de jugador 2">
            <?php endif; ?>

            <!--pantalla de juego antes de llegar al final, mostrara los puntajes en negrilla, notece como se muestran diferentes datos asociados a distintas key de jugador_Actual -->
        <?php elseif ($jugador_actual['cantidad'] <= MAX_POINT) : ?>
            <Strong><?= $jugador_actual['nombre'] ?></Strong><span class='puntaje <?= $jugador_actual['nombre'] ?>'><?= $jugador_actual['cantidad'] ?></span>

            <?php
            if ($jugador_actual['nombre'] == 'jugador1') :
            ?>
                <img src='gokuentreno.gif' alt='retrato de pantallad e juego jugador1'>
            <?php elseif ($jugador_actual['nombre'] == 'jugador2') : ?>
                <img src="veguetaentreno.gif" alt="retrato identificador de jugador 2">
            <?php endif; ?>


            <!--pantalla de preparacion para el siguiente jugador, con 10 puntos/recargas se mostrara -->
        <?php elseif ($jugador_actual['cantidad'] <= (MAX_POINT + 10) && $jugador_actual['nombre'] == 'jugador1') : ?>
            <Strong>Preparense para terminar en </Strong><span class='puntaje final'><?= (MAX_POINT + 10) - $jugador_actual['cantidad'] ?></span>
            
            <?php
            if ($jugador_actual['nombre'] == 'jugador1') :
            ?>
                <img src='vs.gif' alt='retrato pantalla final jugador 1'>
            <?php elseif ($jugador_actual['nombre'] == 'jugador2') : ?>
                <img src="veguetacansado.gif" alt="retrato pantalla final jugador 2">
            <?php endif; ?>

            <!--pantalla final del juego, si el valor asociado a jugador 2 en cantidad es menor o igual al maximo+10
     se mostrara los tiempo de ejecucion de cada jugador -->
        <?php elseif ($jugador_actual['cantidad'] <= (MAX_POINT + 10) && $jugador_actual['nombre'] == 'jugador2') :
            $t1 = $jugadores['jugador1']['tiempo']['fin'] - $jugadores['jugador1']['tiempo']['inicio'];
            $t2 = $jugadores['jugador2']['tiempo']['fin'] - $jugadores['jugador2']['tiempo']['inicio'];
        ?>



            <!--se da formato y se imprime al ganador, se muestra los tiempo -->
            <div>
                <Strong>El ganador es</Strong> <span class='puntaje final'><?= $t1 < $t2 ? 'Jugador 1' : 'Jugador 2' ?></span>
                <p>Tiempo jugador 1: <span class="puntaje"><?= $t1 ?></span></p>
                <p>Tiempo jugador 2: <span class="puntaje"><?= $t2 ?></span></p>
            </div>

            <img src="yes.gif" alt="pantalla final">

            <!--mensaje de reinicio en caso de querer jugar una nueva partida -->
            <Strong>Preparese para reiniciar en</Strong> <span class='puntaje final'><?= (MAX_POINT + 10) - $jugador_actual['cantidad'] ?></span>
            <?php endif; ?>
    </div>
<?php
    footerhtml();
}
//empieza codigo css el cual le da la informacion de formato al header
function headerhtml()
{
?>
    <!-- cogido de formato HTML5 -->
    <!doctype html>
    <html>

    <head>

        <!-- tipo de letras a usar -->
        <meta charset="UTF-8">

        <!-- escala y tamaño -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- se define el formato de la clase .cajon y .puntaje -->
        <style>
            .cajon {
                padding: 2px;
                border: 1px solid #999;
                border-radius: 10px;
                text-align: center;
                width: 400px;

            }

            .puntaje {
                padding: 5px;
                font-weight: bold;
                border: 1px solid red;
                background-color: red;
                color: white;
                font-weight: bold;
                border-radius: 100%;
                text-align: center;
                width: 50px;
                width: 50px;

            }
        </style>
    </head>

    <body>
    <?php
}
//empieza codigo css el cual le da la informacion de formato al footer
function footerhtml()
{
    ?>
    </body>

    </html>
        <?php
    }
