<?php include_once 'views/home/includes/header.php'; ?>



<div class="container">
    <h3 class="text-center my-5">Registrate en nuestra plataforma!</h3>
    <?php if (isset($this->mensajeerror)): ?>
        <div class="row justify-content-center">
            <div class="col-md-6">

              <div class="alert alert-danger alert-dismissible fade show" role="alert">

                  <strong><?php echo ucfirst($this->mensajeerror);?> </strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>     

        </div>
    </div>
<?php endif ?>

<?php if (isset($this->mensajeexito)): ?>
        <div class="row justify-content-center">
            <div class="col-md-6">
             
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                
                  <strong><?php echo ucfirst($this->mensajeexito);?> </strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>     

        </div>
    </div>
<?php endif ?>


    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="<?php echo constant('URL');?>home/registro" method="POST">
                    <div class="form-group mx-2">
                        <!-- <label for="exampleInputEmail1">Nombre</label> -->
                        <input type="text" class="form-control" id="email" aria-describedby="Nombres" placeholder="Nombre..." name="nombre">
                        <!-- <small id="emailHelp" class="form-text text-muted">Por favor ingrese el correo con el que se encuentra registrado.</small> -->
                    </div>                    
                    
                    <div class="form-group mx-2">
                        <!-- <label for="apellido">Apellido</label> -->
                        <input type="text" class="form-control" id="email" aria-describedby="Nombres" placeholder="Apellido" name="apellido">
                        <!-- <small id="emailHelp" class="form-text text-muted">Por favor ingrese el correo con el que se encuentra registrado.</small> -->
                    </div>
                    
                    <div class="form-group mx-2">
                       <!--  <label for="apellido">Correo electrónico</label> -->
                        <input type="email" class="form-control" id="email" aria-describedby="Nombres" placeholder="example@example.com" name="email">
                        <!-- <small id="emailHelp" class="form-text text-muted">Por favor ingrese el correo con el que se encuentra registrado.</small> -->
                    </div>

                    <div class="form-group mx-2">
                        <!-- <label for="exampleInputPassword1">Contraseña</label> -->
                        <input type="password" class="form-control" id="password" placeholder="Contraseña" name="password">
                        <!-- <small id="emailHelp" class="form-text text-muted">Ingrese su contraseña.</small> -->
                    </div>
                    <div class="form-group mx-2">
                        <button type="submit" name="registrar" class="btn btn-primary btn-lg btn-block">Guardar</button>  
                    </div>
                </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h5 class="text-center"><small id="emailHelp" class="form-text text-muted">Ya tienes cuenta?<a href="<?php echo constant('URL');?>home/login" >¡Inicia Sesion!</a></small></h5>             
        </div>
    </div>
</div>
<?php include_once 'views/home/includes/footer.php'; ?>
