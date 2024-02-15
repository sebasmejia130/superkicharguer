    <div class='cajon'>

        <?php if ($this->jugador_actual->getPuntaje() == 0) :?>
            <p> 
                recarga para iniciar 
                <strong><?= $this->jugador_actual->getNombre() ?></strong>
            </p>
            
            <img src="<?= $this->jugador_actual->asset('inicio') ?>">

        <?php elseif ($this->jugador_actual->getPuntaje() <= $this->juego::MAX_POINT) : ?>

            <p> 
                <strong><?= $this->jugador_actual->getNombre() ?></strong>
                <span class='puntaje jugador-<?= $this->juego->jugadorActualkey() ?>'>
                    <?= $this->jugador_actual->getPuntaje() ?>
                </span>
            </p>

            <img src="<?= $this->jugador_actual->asset('juego') ?>">

        <?php elseif ($this->jugador_actual->getPuntaje() <= ($this->juego::MAX_POINT + 10) && $this->juego->jugadorActualkey()==0) : ?>
            
            <p>
                <strong>Preparense para terminar en </strong><span class='puntaje final'><?= ($this->juego::MAX_POINT + 10) - $this->jugador_actual->getPuntaje() ?></span>
            </p>

            <img src="<?= $this->jugador_actual->asset('fin') ?>">

        <?php elseif ($this->jugador_actual->getPuntaje() <= ($this->juego::MAX_POINT + 10) && $this->juego->jugadorActualkey()==1) :?>
            
            <div>

                <strong>El ganador es</strong> 
                <span class='puntaje final'><?= $this->juego->ganador()->getNombre() ?></span>

                <p>Tiempo <?= $this->juego->jugadores(0)->getNombre() ?>: <span class="puntaje"><?= $this->juego->jugadores(0)->tiempo() ?></span></p>
                <p>Tiempo <?= $this->juego->jugadores(1)->getNombre() ?>: <span class="puntaje"><?= $this->juego->jugadores(1)->tiempo() ?></span></p>
            
            </div>
            <img src="<?= $this->juego->ganador()->asset('ganador') ?>" alt="pantalla final">
            
            <p>
                <strong>Preparese para reiniciar en</strong> <span class='puntaje final'><?= ($this->juego::MAX_POINT + 10) - $this->jugador_actual->getPuntaje() ?></span>
            </p>
        <?php endif; ?>

    </div>