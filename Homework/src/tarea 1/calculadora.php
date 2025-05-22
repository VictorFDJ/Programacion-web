<?php require('partes/cabeza.php'); ?>  

<form method="GET" action="resultado.php">
    <h2>Calculadora Magica</h2>
    <div class="numeros">
        <label for="number1"></label>
        <input type="number" id="number1" name="num1" placeholder="Ingresa el numero 1" required>
    
     <label for="number2"></label>
        <input type="number" id="number2" name="num2" placeholder="Ingresa el numero 2" required>
    </div>

<div class="operaciones">    
    <select name="operacion">
    <option value="">Tome una opcion</option>
    <option value="suma">Suma</option>
    <option value="resta">resta</option>
    <option value="multiplicar">multiplicar</option>
    <option value="dividir">dividir</option>
    </select>
</div>
<div class="imputs">
    <button type="submit">Calcular</button>
</div>

</form>

<?php require('partes/foot.php'); ?>