<?php
    namespace app\core;
    class juego{
        public const MAX_POINT = 10;
        private $jugador_actual_key=0;
        private $jugadores;
        
        public function __construct(
            jugador $jugador1,jugador $jugador2
        ) {
            $this->jugadores=[$jugador1,$jugador2];
            $this->jugador_actual_key=(int)($_COOKIE['jugador_actual']??0);
            $this->managePlayers();
            
        }

        function jugadorActualKey(){
            return $this->jugador_actual_key;
        }

        function jugadorActual(){
            return $this->jugadores[$this->jugador_actual_key];
        }

        private function guardarJugadores()
        {
            foreach($this->jugadores as $jugador) $jugador->save();
        }
        private function resetJugadores()
        {
            foreach($this->jugadores as $jugador) $jugador->reset();
        }

        public function ganador()
        {
            return ( $this->jugadores[0]->tiempo() < $this->jugadores[1]->tiempo() ?
                $this->jugadores[0] : $this->jugadores[1] );
            
        }

        public function jugadores($key=null)
        {
            if(is_null($key))
                return $this->jugadores;

            return $this->jugadores[$key];
        }
        
        private function managePlayers()
        {
            
            $jugador_actual = $this->jugadorActual();

            if ($jugador_actual->getPuntaje() == 0) {
                $jugador_actual->tiempoInicial( microtime(true) );
            } elseif ($jugador_actual->getPuntaje() == self::MAX_POINT) {
                $jugador_actual->tiempoFinal( microtime(true) );
            } elseif ($jugador_actual->getPuntaje() == self::MAX_POINT+9 && $this->jugador_actual_key==0) { 
                setcookie('jugador_actual', 1, time() + CONFIG['TIME_RESTART']);
            }  
            
            $jugador_actual->aumentarPuntaje();

            $this->guardarJugadores();
            
            if ($jugador_actual->getPuntaje() >= self::MAX_POINT+9 && $this->jugador_actual_key==1) { 
                setcookie('jugador_actual', 0, time() + CONFIG['TIME_RESTART']);
                $this->resetJugadores();
            }
            new escenario($this);    
        }
    }
?>