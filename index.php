<!-- se inicia una etiqueta de marcacion especial php, indicando que se procesara php -->

<?php
//se le indica al script que se incluira(se llamaran) funciones que se encuentren dentro de "functions.php"
include('functions.php');

//define() se utiliza para definir constantes, por lo tanto aqui se inicializa una constante definida como "MAX_POINT", la cual tendra un valor de 10 en integral
define('MAX_POINT', 10);

//se define la constante "TIME_RESTART" con un valor de 30 en integral
define('TIME_RESTART', 30);


//El servidor inicializa las variables, se le pregunta al servidor que busque una cookie llamada "jugadores"
//si el servidor no encuentra una cookie con tal nombre, la va a inicializar con la informacion entre llaves
//generando un array recursivo de 2 strings (jugadores), los cuales a su vez poseen cantidad y tiempo.
//Se inicializa la cantidad en -1 con el objetivo de permiter mostrar una pantalla de aviso para la preparacion del siguiente jugador
if (!isset($_COOKIE['jugadores'])) {
    $jugadores = [
        "jugador1" => [
            'cantidad' => -1,
            'tiempo' => [
                'inicio' => 0,
                'fin' => 0,
            ],
        ],
        "jugador2" => [
            'cantidad' => -1,
            'tiempo' => [
                'inicio' => 0,
                'fin' => 0,
            ],
        ]
    ];
    //una vez con la informacion de la cookie otorgada, se realizara la iniciacion de la cookie "jugadores"
    //trayendo la informacion de "jugadores" a un bloque de script JSON, ademas de agregarle un tiempo para la reiniciacion de la cookie
    //es importante realizar la conversion a JSON para poder tener datos actualizables entre ciclos
    setcookie('jugadores', json_encode($jugadores), time() + TIME_RESTART);

    // lo anterior sucedera unicamente en el primer ciclo o inicio del juego
    // si la cookie ya esta iniciada, la ejecucion de este bloque de codigo decofificara la informacion
    //que se encuentra presente en el JSON de la cookie "jugadores", el true es para que permita la operacion
} else {

    $jugadores = json_decode($_COOKIE['jugadores'], true);
}


// asignacion de turno a cada jugador y finalización y reinicio del juego
// el codigo primero verifica si dentro de la cookie "jugadores" si el valor asociado a la Key "cantidad" de "jugador1" es un valor menor al
//valor establecido en la constante "MAX_POINT"+10, los 10 de adicion son para
//tener un valor de margen en el que se pueda mostrar una pantalla de preparacion para el siguiente jugador
if ($jugadores["jugador1"]["cantidad"] < MAX_POINT + 10) {

    //en caso tal de que cantida sea menor a 20, se jugardara en una variable llamada "jugador_Actual"
    //el resultado de la funcion "managePlayer()", pasandole como parametros la cookie "jugadores" y la key "jugador1"
    //con los parametros dados lo que realiza la funcion es que actualiza el valor ligado a cantidad del jugador el cual se otroga como parametro
    //en este primer caso, seria el "jugador1" (la funcion "managePlayer" funciona por autoincremento, es decir "++")
    //es importante mencionar que podemos usar la funcion "managePlayer" por que anteriormente incluimos a "functions.php"
    //ya que el codigo para el funcionamiento de la funcion "managePlayer" se encuentra en "functions.php"
    $jugador_actual = managePlayers($jugadores, 'jugador1');
}
//en caso de que el valor ligado a la key "cantidad" de "jugador1" supere el valor de la constante MAX_POINT+10 (lo cual indica que su turno y la pantalla de preparacion terminaron)
//realizara el mismo proceso con el jugador 2, primero verificara que su valor asociado a la key "cantidad" sea menor a la constante MAX_POINT+10 
//si esto se cumple, guarda en la variable "jughador actual" el resultado de la funcion "managePlayers" (hasta que supere el "MAX_POINT"+10)
elseif ($jugadores["jugador2"]["cantidad"] < MAX_POINT + 10) {
    $jugador_actual = managePlayers($jugadores, 'jugador2');
}

//aqui preparamos el final del juego, si el valor asociado ala key cantidad de jugador2 es igual a la constante MAX_POINT+10 (20)
//el servidor reiniciara la cookie jugadores con datos null (" "), por lo que eliminara la cookie (la cual se reinicializa si el juego vuelve a empezar)
if ($jugadores["jugador2"]["cantidad"] == MAX_POINT + 10) {
    setcookie('jugadores', '', time() - 3600);

    //ya dadas las instrucciones del juego, en caso de que no se termine la partida (es decir, el jugador 2 no llegue 20)
    // se actualizara la cookie y se guardara en un JSON para su posterior uso en un siquiente ciclo    
} else {
    setcookie('jugadores', json_encode($jugadores), time() + TIME_RESTART);
}
//Imprimimos la informacion contenida en la variable "jugador_actual" que si recoramos, la informacion que esta contiene
//es el resultado de la funcion managePlayer, la cual se encarga de manejar la informacion de la key cantidad
//y se usa managePlayerScene() por que esta funcion es la que contiene la informacion html y CSS para la estructura y formato de las letras en pantalla
//basicamente nos da formato a la informacion guardada en $jugador_actual
managePlayerScene($jugador_actual);
?>