<?php include_once 'views/home/includes/header.php'; ?>



<div class="container">
    <h3 class="text-center my-5">Inicio de Session</h3>
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
            <form action="<?php echo constant('URL');?>home/login" method="POST">
            <div class="form-group mx-2">
                <!-- <label for="exampleInputEmail1">Correo</label> -->
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="correo@ejemplo.com" name="email">
                <small id="emailHelp" class="form-text text-muted">Por favor ingrese el correo con el que se encuentra registrado.</small>
            </div>
            <div class="form-group mx-2">
                <!-- <label for="exampleInputPassword1">Contraseña</label> -->
                <input type="password" class="form-control" id="password" placeholder="...." name="pass">
                <small id="emailHelp" class="form-text text-muted">Ingrese su contraseña.</small>
            </div>
            <div class="form-group mx-2">
                <button type="submit" name="iniciosesion" class="btn btn-success btn-lg btn-block">Entrar</button>  
            </div>
        </form>
        

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h5 class="text-center"><small id="emailHelp" class="form-text text-muted">¿Aun no tienes cuenta? <a href="<?php echo constant('URL');?>home/registro" >¡Registrate ahora!</a></small></h5>             
        </div>
    </div>
</div>
<?php include_once 'views/home/includes/footer.php'; ?>
