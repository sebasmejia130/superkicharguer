let jugador=JSON.parse(Cookies.get('jugador1'));
console.log(jugador.puntaje)
if(jugador.puntaje==0)
    alert('bienvenidos')