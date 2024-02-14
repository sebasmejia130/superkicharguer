    <!--se indica que se utilizara una clase "cajon", estas ya las reconoce HTML -->
    <div class='cajon'>
        
   
        <!--entonces se verifica si el jugador actual posee el valor 0 en su key "cantidad" -->
        <?php if ($this->jugador_actual->getPuntaje() == 0) :?>
            recarga para iniciar <strong><?= $this->jugador_actual->getNombre() ?></strong>
            <img src="<?= $this->jugador_actual->asset('inicio') ?>" alt="retrato identificador de jugador">
        <?php elseif ($this->jugador_actual->getPuntaje() <= $this->juego::MAX_POINT) : ?>
            <Strong><?= $this->jugador_actual->getNombre() ?></Strong><span class='puntaje <?= $this->jugador_actual->getNombre() ?>'><?= $this->jugador_actual->getPuntaje() ?></span>
            <img src="<?= $this->jugador_actual->asset('juego') ?>" alt="retrato identificador de jugador">
        <?php elseif ($this->jugador_actual->getPuntaje() <= ($this->juego::MAX_POINT + 10) && $this->juego->jugadorActualkey()==0) : ?>
            <Strong>Preparense para terminar en </Strong><span class='puntaje final'><?= ($this->juego::MAX_POINT + 10) - $this->jugador_actual->getPuntaje() ?></span>
            <img src="<?= $this->jugador_actual->asset('fin') ?>" alt="retrato identificador de jugador">
        <?php elseif ($this->jugador_actual->getPuntaje() <= ($this->juego::MAX_POINT + 10) && $this->juego->jugadorActualkey()==1) :?>
            <div>
                <Strong>El ganador es</Strong> <span class='puntaje final'><?= $this->juego->ganador()->getNombre() ?></span>
                <p>Tiempo <?= $this->juego->jugadores(0)->getNombre() ?>: <span class="puntaje"><?= $this->juego->jugadores(0)->tiempo() ?></span></p>
                <p>Tiempo <?= $this->juego->jugadores(1)->getNombre() ?>: <span class="puntaje"><?= $this->juego->jugadores(1)->tiempo() ?></span></p>
            </div>
            <img width="250" src="<?= $this->juego->ganador()->asset('ganador') ?>" alt="pantalla final">
            <!--mensaje de reinicio en caso de querer jugar una nueva partida -->
            <Strong>Preparese para reiniciar en</Strong> <span class='puntaje final'><?= ($this->juego::MAX_POINT + 10) - $this->jugador_actual->getPuntaje() ?></span>
            <?php endif; ?>
    </div>