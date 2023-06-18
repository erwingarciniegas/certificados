<?php include('../templates/cabecera.php');?>
<?php include('../secciones/alumnos.php');?>


<div class="row">
    <div class="col-12">
        <br/>
        <div class="row">
        <div class="col-5">
        <form action="" method="post">
        <div class="card">
                <div class="card-header">
                Alumnos
                </div>
            <div class="card-body">

                    <div class="mb-3 d-none">
                    <label for="" class="form-label">ID</label>
                    <input type="text" 
                            class="form-control" 
                            name="id"
                            id="id" 
                            value="<?php echo $id;?>"
                            aria-describedby="helpId"  placeholder="ID">
            </div>

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text"
                        class="form-control" 
                        name="nombre" 
                        id="nombre"
                        value="<?php echo $nombre;?>"
                        aria-describedby="helpId" 
                        placeholder="escriba el nombre">
            </div>

            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text"
                        class="form-control" 
                        name="apellidos" 
                        id="apellidos"
                        value="<?php echo $apellidos;?>"
                        aria-describedby="helpId" 
                        placeholder="escriba los apellidos">
            </div>

            <div class="mb-3">
            <label for="" class="form-label">Cursos del alumno:</label>

            <select multiple class="form-control" name="cursos[]" id="listacursos">

                <?php foreach($cursos as $curso){ ?>
                        <option
                        <?php
                        if(!empty($arreglocursos)):
                            if(in_array($curso['id'],$arreglocursos)):
                                echo "selected";
                            endif;
                        endif;
                    ?>
                        value="<?php echo $curso['id'];?>" ><?php echo $curso['id'];?> - <?php echo $curso['nombre_curso'];?> 
                    
                    </option>>
                
                        <?php } ?>
                
            </select>

            </div>

            <div class="btn-group" role="group" aria-label="">
                <button type="submit" name="accion" value="agregar" class="btn btn-success">Agregar</button>
                <button type="submit" name="accion" value="editar"  class="btn btn-warning">Editar</button>
                <button type="submit" name="accion" value="borrar"  class="btn btn-danger">Borrar</button>
            </div>

        </div>

</div>

</form>






</div>


<div class="col-7">
<div class="table-responsive">
    <table class="table table-primary">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>

        <?php foreach($alumnos as $alumno): ?>
            <tr>
                <td> <?php echo $alumno['id']; ?></td>
                    <td> 
                        <?php echo $alumno['nombre']; ?> <?php echo $alumno['apellidos']; ?>
                        <br/>
                        <?php foreach($alumno["cursos"] as $curso){ ?>
                            -  <a href="certificado.php?idcurso=<?php echo $curso['id']; ?>&idalumno=<?php echo $alumno["id"];?>"> 
                            <i class="bi bi-filetype-pdf text-danger" ></i> <?php echo $curso['nombre_curso']; ?> </a><br/>
                            
                        <?php } ?>     

                    </td>


                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="id" value="<?php echo $alumno['id']; ?>">
                                    <input type="submit" value="seleccionar" name="accion" class="btn btn-info"> 

                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?> 

                </tbody>
            </table> 


    </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
<script>
    new TomSelect('#listacursos');
</script>

<?php include('../templates/pie.php');?>