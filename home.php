<?php
require_once 'clases/Usuario.php';
require_once 'clases/Factura.php';
require_once 'clases/RepositorioFactura.php';

session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $nomApe = $usuario->getNombreApellido();
    $rc = new RepositorioFactura();
    $factura = $rc->get_all($usuario);
} else {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Sistema de Facturación</title>
        <link rel="stylesheet" href="bootstrap.min.css">
    </head>
    <body class="container">
      <div class="jumbotron text-center">
      <h1>Sistema de Facturación</h1>
      </div>    
      <div class="text-center">
        <h3>Hola <?php echo $nomApe;?></h3>
        <br>        
        <a class="btn btn-primary" href="crear_factura.php" target="_blank" rel="noopener noreferrer">Agregar Factura</a>        
        <br><hr>
        <h3>Listado de facturas</h3>
        <table class="table table-striped">
          <tr>
            <th>Número</th><th>Nombre</th><th>Apellido</th><th>Detalle</th><th>Importe</th><th>Ciudad</th><th>Calle</th><th>Altura</th><th>Acción</th>
          </tr>
          <?php
          if (count($factura) == 0){
            echo "<tr><td colspan='5'>No tiene facturas creadas</td></tr>";            
          } else {
            foreach ($factura as $unaFactura) {
              $n = $unaFactura->getNumero();
              echo '<tr>';
              echo "<td>$n</td>";
              echo "<td>".$unaFactura->getNombre()."</td>";
              echo "<td>".$unaFactura->getApellido()."</td>";
              echo "<td>".$unaFactura->getDetalle()."</td>";
              echo "<td>".$unaFactura->getImporte()."</td>";
              echo "<td>".$unaFactura->getCiudad()."</td>";
              echo "<td>".$unaFactura->getCalle()."</td>";
              echo "<td>".$unaFactura->getAltura()."</td>";
              echo "<td><a type='button' class='btn btn-danger' href='eliminar.php?n=$n'>Eliminar</td>";
              echo '</tr>';
            }
          }
          ?>
        </table>
        <br><hr>
        <p><a href="logout.php">Cerrar sesión</a></p>
      </div> 
    </body>
</html>

