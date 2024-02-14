 <?php
    include('app/core/juego.php');
    include('app/core/jugador.php');
    include('app/core/escenario.php');
    include('app/config/config.php');
    use app\core\jugador;
    use app\core\juego;
    $juego=new juego(
        new jugador(CONFIG['jugadores']['vegueta']),
        new jugador(CONFIG['jugadores']['goku']),
    );