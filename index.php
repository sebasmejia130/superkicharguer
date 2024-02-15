 <?php
    include('app/config/config.php');
    include('app/core/juego.php');
    include('app/core/jugador.php');
    include('app/core/escenario.php');
    use app\core\jugador;
    use app\core\juego;
    $juego=new juego(
        new jugador(CONFIG['jugadores']['goku'],'jugador1'),
        new jugador(CONFIG['jugadores']['vegueta'],'jugador2'),
    );