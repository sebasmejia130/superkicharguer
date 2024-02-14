<?php
    namespace app\core;
    class jugador{
        public const TIME_RESTART = 30;
        private $tiempo_inicial=null;
        private $tiempo_final=null;
        private $puntaje=-1;
        private $nombre;
        private $assets;
        private $cookie_key;

        public function __construct($config,$cookie_key=null) {
            $this->nombre=$config['nombre'];
            $this->assets=$config['assets'];
            $this->cookie_key=$cookie_key??$this->nombre;
            if (isset($_COOKIE[$this->cookie_key])) {
                $this->loadData();
            }else{
                $this->save();
            }
        }

        public function asset($key){
            return $this->assets[$key];
        }

        public function tiempo(){
            return $this->tiempo_final-$this->tiempo_inicial;
        }

        public function getPuntaje(){
            return $this->puntaje;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function aumentarPuntaje(){
            $this->puntaje=$this->puntaje+1;
        }

        public function tiempoInicial($tiempo){
            $this->tiempo_inicial=$tiempo;
        }

        public function tiempoFinal($tiempo){
            $this->tiempo_final=$tiempo;
        }

        public function reset(){
            setcookie($this->cookie_key,'',time() - CONFIG['TIME_RESTART']);
        }

        public function save(){
            $datos = [
                'tiempo_inicial'=>$this->tiempo_inicial,
                'tiempo_final'=>$this->tiempo_final,
                'puntaje'=>$this->puntaje,
            ];
            setcookie($this->cookie_key,json_encode($datos),time() + CONFIG['TIME_RESTART']);
        }

        private function loadData(){
            $datos = json_decode($_COOKIE[$this->cookie_key], true);
            $this->tiempo_inicial=$datos['tiempo_inicial'];
            $this->tiempo_final=$datos['tiempo_final'];
            $this->puntaje=$datos['puntaje'];
        }

        

    }
?>