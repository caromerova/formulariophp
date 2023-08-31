<?php
include("conexion.php");//Incluimos el archivo de conexion y asi podemos usar las variables creadas en ese documento
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <center>
        <h2>Manipulacion de datos con HP</h2>
        <form action="formulario.php" enctype="multipart/form-data" method="post">
            <label for="">buscar</label>
            <input type="text" name="nitoccbusc" id="" placeholder="Buscar Cliente">
            <input type="submit" value="Buscar" name="buscar">
            <hr>
             <label for="">Nit o CC</label>
            <input type="text" name="nitocc" id="" placeholder="Ingrese el Nit o Cedula del nuevo cliente">
            <br><br>
             <label for="">Nombre</label>
            <input type="text" name="nombre" id="" placeholder="Ingresa el nombre completo">
            <br><br>
             <label for="">Direccion</label>
            <input type="text" name="direccion" id="" placeholder="Ej: kra 84 # 33-20">
            <br><br>
            <label for="">Telefono</label>
            <input type="number" name="telefono" id="" placeholder="Ej: 3106832925">
            <br><br>
            <label for="">Fecha de ingreso</label>
            <input type="date" name="fechaingreso" id="">
            <br><br>
            <label for="">Cupo del credito</label>
            <input type="number" name="cupocredito" id="" placeholder="$ valor en pesos">
            <br><br>
            <label for="">Subir foto</label>
            <input type="file" name="foto" id="">
            <br><br>
            <label for="">Foto</label>
            <img src="" alt="" width="80" height="80">
            <br><br>
            <input type="submit" value="Guardar Nuevo Cliente" name="guardar">
            <input type="submit" value="Lista Todos Los Clientes" name="listar">
            <input type="submit" value="Actualizar Cliente" name="actualizar">
            <input type="submit" value="Eliminar  Cliente" name="eliminar">
        </form>
    </center>
    <?php
        if(isset($_POST['guardar']))
        {
            //los datos de entrada almacenados en variables
            $nitocc=$_POST['nitocc'];
            $nombre=$_POST['nombre'];
            $direccion=$_POST['direccion'];
            $telefono=$_POST['telefono'];
            $fechaingreso=$_POST['fechaingreso'];
            $cupocredito=$_POST['cupocredito'];
            //Maneejo de archivos:
            $nombre_foto=$_FILES['foto']['name'];//nombre de la foto
            $ruta=$_FILES['foto']['tmp_name'];// ruta o path del archivo
            $foto='fotos/'.$nombre_foto;//ruta y el nombre del archivo
            copy($ruta,$foto);//Guarda el archivo en una ruta especifica

            //verificar que no existan valores duplicados para el campo de Nitocc
            $sqlbuscar="SELECT nitocc FROM tblcliente WHERE nitocc='$nitocc' ORDER BY nitocc";
            if($resultado=mysqli_query($conexion,$sqlbuscar))
            {
                $nroregistros=mysqli_num_rows($resultado);
                if($nroregistros>0)
                {
                    echo "<script>alert('Ese NIT o CC ya existe');</script>";
                }
                else
                {
                    mysqli_query($conexion,"INSERT INTO tblcliente (nitocc,nombre,direccion,telefono,fechaingreso,cupocredito,foto)
                    VALUES ('$nitocc','$nombre','$direccion','$telefono','$fechaingreso','$cupocredito','$foto')");
                    echo "Datos Guardados Correctamente";
                }
            }
        }
    ?>
    
</body>
</html>