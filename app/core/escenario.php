<?php
namespace app\core;
class escenario
{
    private $jugador_actual;

    public function __construct(
        private juego $juego) {
            $this->jugador_actual=$juego->jugadorActual();
            $this->managePlayerScene();
    }

    private function managePlayerScene()
    {
        $this->headerhtml();
        include('resources/view/escena.php');
        $this->footerhtml();
    }
    //empieza codigo css el cual le da la informacion de formato al header
    private function headerhtml()
    {
        include('resources/view/header.php');
    }
    
    private function footerhtml()
    {
        include('resources/view/footer.php');
    }
}
