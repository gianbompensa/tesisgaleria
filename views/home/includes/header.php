<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?php echo constant('URL');?>public/img/home/ico.png" type="image/png">

    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/toastr.css">

    <link rel="stylesheet" type="text/css" href="<?php echo constant('URL');?>public/css/style.css">
    <script type="text/javascript" src="<?php echo constant('URL');?>public/fontawesome/all.js"></script>



    <title>Gallery</title>
</head>
<body>
    <div class="header">

        <nav class="navbar sticky-top navbar-expand-lg navbar-light " id="navbars" style="padding-bottom: 1px !important;padding-top: 1px !important;">
            <a class="navbar-brand" href="<?php echo constant('URL');?>" style=""><h3 class="mx-5" style="font-family: 'Source Sans Variable', sans-serif; font-weight: lighter; color: #e2d7d7;">Gallery</h3></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent" id="navbars">
                <ul class="nav justify-content-end">

                    <?php if (isset($_SESSION['usuario']) and !empty($_SESSION['usuario'])): ?>

                    <li class="nav-item">
                        <a class="nav-link item-corsetti" href="<?php echo  constant('URL');?>">Categorias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link item-corsetti " href="<?php echo  constant('URL');?>user/perfil"><?php echo ucfirst($_SESSION['usuario'][0]['nombre_user']).' '.ucfirst($_SESSION['usuario'][0]['apellido_user']); ?></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link item-corsetti " href="<?php echo  constant('URL');?>user/logout">Salir</a>
                    </li>
                        
                    
                        
                    <?php else: ?>
                        
                    <li class="nav-item">
                        <a class="nav-link item-corsetti" href="<?php echo  constant('URL');?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link item-corsetti " href="<?php echo  constant('URL');?>home/login">Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link item-corsetti " href="<?php echo  constant('URL');?>home/registro">Sign Up</a>
                    </li>

                    <?php endif ?>


                </ul> 
            </div>
        </nav>
</div>





<!-- Modal de sesion-->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                


                <h5 class="modal-title text-center" id="exampleModalLabel">Inicio de sesión.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
             <form action="">
                    <div class="form-group mx-2">
                        <label for="exampleInputEmail1">Correo</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="correo@ejemplo.com" name="email">
                        <small id="emailHelp" class="form-text text-muted">Por favor ingrese el correo con el que se encuentra registrado.</small>
                    </div>
                    <div class="form-group mx-2">
                        <label for="exampleInputPassword1">Contraseña</label>
                        <input type="password" class="form-control" id="password" placeholder="...." name="password">
                        <small id="emailHelp" class="form-text text-muted">Ingrese su contraseña.</small>
                    </div>
                    <div class="form-group mx-2">
                        <button type="submit" class="btn btn-success btn-lg btn-block">Entrar</button>  
                    </div>
                </form>
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="text-center"><small id="emailHelp" class="form-text text-muted">¿Aun no tienes cuenta? <a href="" data-toggle="modal" data-target="#registroModal" data-dismiss="modal" aria-label="Close">¡Registrate ahora!</a></small></h5>             
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- Modal de registro-->
<div class="modal fade" id="registroModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Registro de usuario.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group mx-2">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" class="form-control" id="email" aria-describedby="Nombres" placeholder="Nombre..." name="nombre">
                        <!-- <small id="emailHelp" class="form-text text-muted">Por favor ingrese el correo con el que se encuentra registrado.</small> -->
                    </div>                    
                    
                    <div class="form-group mx-2">
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control" id="email" aria-describedby="Nombres" placeholder="Apellido" name="apellido">
                        <!-- <small id="emailHelp" class="form-text text-muted">Por favor ingrese el correo con el que se encuentra registrado.</small> -->
                    </div>
                    
                    <div class="form-group mx-2">
                        <label for="apellido">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" aria-describedby="Nombres" placeholder="example@example.com" name="email">
                        <!-- <small id="emailHelp" class="form-text text-muted">Por favor ingrese el correo con el que se encuentra registrado.</small> -->
                    </div>

                    <div class="form-group mx-2">
                        <label for="exampleInputPassword1">Contraseña</label>
                        <input type="password" class="form-control" id="password" placeholder="Contraseña" name="password">
                        <!-- <small id="emailHelp" class="form-text text-muted">Ingrese su contraseña.</small> -->
                    </div>
                    <div class="form-group mx-2">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Guardar</button>  
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>



