<?php require('partes/cabeza.php'); 
$num1= $_GET['num1'];
$num2= $_GET['num2'];


$resultado=0;
$operacion= $_GET['operacion'];
switch ($operacion) {
    case 'suma':
        $resultado= $num1 + $num2;
        break;
    case 'resta':
        $resultado= $num1 - $num2;
        break;
    case 'multiplicar':
        $resultado= $num1 * $num2;
        break;
    case 'dividir':
        if ($num2 != 0) {
            $resultado= $num1 / $num2;
        } else {
            echo "No se puede dividir entre cero.";
            exit();
        }
        break;
    default:
        echo "Operación no válida.";
        exit();
}
?>  
<h2>Resultado</h2>
<p>El resultado de la <?php echo $operacion; ?> entre <?php echo $num1; ?> y <?php echo $num2; ?> es: <strong><?php echo $resultado; ?></strong></p>
<p><a href="calculadora.php" class="volver">Vuelve a la calculadora magica</a></p>


<?php require('partes/foot.php'); ?>