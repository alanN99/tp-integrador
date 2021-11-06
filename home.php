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
        <link rel="stylesheet" href="estilos/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body class="container">
      <div class="jumbotron text-center">
      <h1>Sistema de Facturación</h1>
      </div>    
      <div class="text-center">
        <h3>Hola <?php echo $nomApe;?></h3>
        <br>        
        <a class="btn btn-primary" href="facturas/crear_factura.php" target="_blank" rel="noopener noreferrer">Agregar Factura</a>        
        <br><hr>
        <h3>Listado de facturas</h3>
        <table class="table table-striped">
          <tr>
            <th>Número</th><th>Nombre</th><th>Apellido</th><th>Detalle</th><th>Importe</th><th>Ciudad</th><th>Calle</th><th>Altura</th><th>Editar</th><th>Eliminar</th>
          </tr>
          <?php
          if (count($factura) == 0){
            echo "<tr><td colspan='5'>No tiene facturas creadas</td></tr>";            
          } else {
            foreach ($factura as $unaFactura) {
              $n = $unaFactura->getNumero();
              echo '<tr>';
              echo "<td>$n</td>";
              echo "<td data-target='nombre'>".$unaFactura->getNombre()."</td>";
              echo "<td data-target='apellido'>".$unaFactura->getApellido()."</td>";
              echo "<td data-target='detalle'>".$unaFactura->getDetalle()."</td>";
              echo "<td data-target='importe'>".$unaFactura->getImporte()."</td>";
              echo "<td data-target='ciudad'>".$unaFactura->getCiudad()."</td>";
              echo "<td data-target='calle'>".$unaFactura->getCalle()."</td>";
              echo "<td data-target='altura'>".$unaFactura->getAltura()."</td>";
              ?>
              <td><a type='button' class='btn btn-warning' data-role="update" data-id="<?php echo $n['n'] ;?>">Editar</td>
              <?php 
              
              echo "<td><a type='button' class='btn btn-danger' href='facturas/eliminar.php?n=$n'>Eliminar</td>";
              echo '</tr>';
            }
          }
          ?>
        </table>        

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Editar</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
                      <div class="col-md-6">
                          <label for="nombre">Nombre</label>
                          <input type="text" name="nombre" placeholder="Ingresar nombre" id="nombre" class="form-control"> 
                          <label for="apellido">Apellido</label>
                          <input type="text" name="apellido" placeholder="Ingresar apellido" id="apellido" class="form-control">                    
                      </div><br>
                      <div class="col-md-6">
                          <label for="detalle">Detalle</label>
                          <input type="text" name="detalle" placeholder="Ingresar descripción" id="detalle" class="form-control">
                          <label for="importe">Importe $</label>
                          <input type="number" name="importe" placeholder="Ingresar monto" id="importe" class="form-control">
                      </div>
            </div>
            <br>                                    
                  <div class="row">
                      <div class="col-md-6">
                          <label for="ciudad">Ciudad</label>
                          <input type="text" name="ciudad" placeholder="Ingresar Ciudad" id="ciudad" class="form-control">
                          <label for="calle">Calle</label>
                          <input type="text" name="calle" placeholder="Ingresar calle" id="calle" class="form-control">
                      </div>
                      <div class="col-md-6">             
                          <label for="altura">Altura</label>
                          <input type="number" name="altura" placeholder="Ingresar altura" id="altura" class="form-control">                                        
                      </div>
                  </div><br>
              <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              </div>
          </div>      
        </div>
      </div>         
      </div>  
        </div>
        <br><hr>
        <p><a href="login/logout.php">Cerrar sesión</a></p>
      
      <script>
          $(document).ready(function(){
            $(document).on('click', 'a[data-role=update]', function(){
                var numero = $(this).data('n');
                var nombre = $('#'+numero).children('td[data-target=nombre]').text();
                var apellido = $('#'+numero).children('td[data-target=apellido]').text();
                var detalle = $('#'+numero).children('td[data-target=detalle]').text();
                var importe = $('#'+numero).children('td[data-target=importe]').text();
                var ciudad = $('#'+numero).children('td[data-target=ciudad]').text();
                var calle = $('#'+numero).children('td[data-target=calle]').text();
                var altura = $('#'+numero).children('td[data-target=altura]').text();

                $('#nombre').val(nombre);
                $('#apellido').val(apellido);
                $('#detalle').val(detalle);
                $('#importe').val(importe);
                $('#ciudad').val(ciudad);
                $('#calle').val(calle);
                $('#altura').val(altura);
                $('#myModal').modal('toggle');
            })
            
          });
      </script>

    </body>
</html>

