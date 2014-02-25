<?php



include ("table.class.php");

$columnas = new l_td();
$filas = new l_tr();
$tabla = new table();

$tal = new td();

$col = array();

$col1 = "Hola0";
$col0 = array("class"=>"uno");

$col[] = array($col1,$col0);
$columnas->add_col2(array($col1,$col0));

$tal->td2(array($col1,$col0));

/*
echo htmlentities($tal->get_td());
echo "<br><br>";
*/
/*
print_r($col);
echo "<br><br>";

var_dump($columnas);
echo "<br><br>";

*/

$col1 = "Hola1";
$col0 = array("class"=>"uno");

$col[] = array($col0,$col1);
$columnas->add_col2(array($col1,$col0));



/*
print_r($col);
echo "<br><br>";
*/

$col1 = "Hola2";
$col0 = array("class"=>"uno");

$col[] = array($col0,$col1);
$columnas->add_col2(array($col1,$col0));

/*
print_r($col);
echo "<br><br>";
*/

$col1 = "Hola3";
$col0 = array("class"=>"uno");

$col[] = array($col0,$col1);
$columnas->add_col2(array($col1,$col0));


$columnas->p_td2();
/*
print_r($col);
echo "<br><br>";
*/


//$columnas->add_col2($col);
/*
echo "<br>columnas<br>";
$columnas->p_td2();

echo htmlentities($columnas->get_tds());
echo "<br>columnas<br>";
*/

$filas->add_row1( array("class"=>"dos"),$columnas);

/*
echo "<br>filas<br>";
var_dump($filas);
echo "<br>filas<br>";

echo "<br><br>1111";
*/
$filas->p_tr2();
//echo htmlentities( $filas->get_trs() );
/*
echo "1111<br><br>";

var_dump($filas);
echo "<br><br>ssssssss";
*/
$tabla->table1(array("class"=>"tres","border"=>"1"),$filas);

/*
echo "<br><br>";

var_dump($tabla);
echo "<br><br>";
*/

//$c1 = new l_td();
$f1 = new l_tr();
$t = new table();

//$tal = new td();

$col = array();


for ($i=0;$i<21;$i++){
    $c1 = new l_td();
    for ($j=0;$j<21;$j++){
        $c1->add_col2(array($i+$j,array("class"=>"uno")));
    }
    $c1->p_td2();
    $f1->add_row1(array("class"=>"dos"),$c1);
    
}

$f1->p_tr2();
$t->table1(array("class"=>"tres","border"=>"1"),$f1);


?>
<html>
    <body>
        <?php //echo htmlentities($tabla->get_tr ()); ?>
        
        <?php echo $tabla->get_tr (); ?>
        <?php echo $t->get_tr (); ?>
    </body>
</html>