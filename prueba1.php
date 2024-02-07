<html>
 <head>
  <title>Prueba de PHP</title>
 </head>
 <body>
 <?php $expresión = true; ?>
 
 <?php if ($expresión == true): ?>
  Esto se mostrará si la expresión es verdadera.
 <?php else: ?>
  En caso contrario se mostrará esto.
 <?php endif; ?>
 <?php
    $un_bool = true;   // un valor booleano
    $un_str  = "foo";  // una cadena de caracteres
    $un_str2 = 'foo';  // una cadena de caracteres
    $un_int  = 12;     // un número entero

    echo gettype($un_bool); // imprime: boolean
    echo gettype($un_str);  // imprime: string

    // Si este valor es un entero, incrementarlo en cuatro
    if (is_int($un_int)) {
    $un_int += 4;
    echo $un_int;
}

// Si $un_bool es una cadena, imprimirla
// (no imprime nada)
if (is_string($un_bool)) {
    echo "Cadena: $un_bool";
}
 
 function nombre_funcion(){
    echo 'soy una funcion putitos, ademas hago matematica';
}


 call_user_func('nombre_funcion');
 
 function nombre_funcion2($a){
    return $a * 2;
}

echo nombre_funcion2(2);
echo call_user_func('nombre_funcion2',2);

   
  

?>
 </body> 
</html>