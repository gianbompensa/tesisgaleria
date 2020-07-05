<?php include_once 'views/home/includes/header.php'; ?>

<!-- <style type="text/css">
    .image-upload>input {
  display: none;
}
</style>
<div class="image-upload">
  <label for="file-input">
    <img src="https://icon-library.net/images/upload-photo-icon/upload-photo-icon-21.jpg"/>
  </label>

  <input id="file-input" type="file" />
</div> -->




<div class="container mt-1 mb-5">
    <div class="row justify-content-center">
       <!--  <div class="col-md-3 text-center">
            <?php if ($_SESSION['usuario'][0]['avatar'] != 'noimg'): ?>
                
            <img src="<?php echo constant('URL');?>public/avatars/<?php $_SESSION['usuario']['avatar']; ?>" alt="noimg">                
            <?php else: ?>
            <img src="<?php echo constant('URL');?>public/img/avatars/avatarorigin.png" class="rounded-circle" style="width: 100px; height: 100px;" alt="noimg">
            <?php endif ?>
            <h5 class="text-dark"><?php echo ucfirst($_SESSION['usuario'][0]['nombre_user']) .' '.$_SESSION['usuario'][0]['apellido_user']; ?></h5>
        </div> -->
        <div class="col-md-12 my-auto">
            <h1 class=" text-dark text-center my-5">Perfil de Usuario</h1>
            <?php if (isset($this->messageexito)): ?>
              <div class="row justify-content-center">
                <div class="col-md-6">

                  <div class="alert alert-success alert-dismissible fade show" role="alert">

                    <strong><?php echo ucfirst($this->messageexito);?> </strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>     

                </div>
              </div>
            <?php endif ?>
            <?php if (isset($this->message)): ?>
              <div class="row justify-content-center">
                <div class="col-md-6">

                  <div class="alert alert-success alert-dismissible fade show" role="alert">

                    <strong><?php echo ucfirst($this->message);?> </strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>     

                </div>
              </div>
            <?php endif ?>
            <hr>    
            <div class="row justify-content-center">
                <div class="col-md-2">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#aggpub"><!-- <i class="fas fa-plus"></i> --><i class="fas fa-camera"></i> Nuevo Post </button>
                </div>
            </div> 
            <hr>    
        </div>
    </div>
</div>


<!-- <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-2">
            <button type="button" class="btn btn-info"><i class="fas fa-plus"></i><i class="fas fa-camera"></i> Nuevo Post </button>
        </div>
    </div>
</div> -->
    





























<div class="container my-5">
    <div class="row">





        <div class="col-md-6 overflow-auto">
            <h3 class="text-center text-dark "> Publicaciones Realizadas</h3>
            <table class="table table-responsive">
              <thead class="bg-info">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Imagen</th>
                  <th scope="col">Fecha</th>
                  <th scope="col">Settings</th>
                </tr>
               </thead>
               <tbody>
                <?php foreach ($this->postuser as $postuser): ?>
                  
                <tr>
                  <th scope="row"><?php echo ucfirst($postuser['id_post']);?></th>
                  <td><?php echo ucfirst($postuser['nombre_post']);?></td>
                  <td><img src="<?php echo constant('URL').'public/img/post/'.$postuser['img_post'];?>" class="img-fluid" alt=""></td>
                  <td><?php echo ucfirst($postuser['created_at']);?></td>
                  
                  <td>

                    <div class="btn-group mr-2" role="group" aria-label="First group">
                       <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminarpostuser<?php echo $postuser['id_post'];?>">
                        <i class="fas fa-trash-alt"></i>
                      </button>
                      <button type="button" class="btn btn-success">
                        <i class="fas fa-edit"></i>
                      </button>

                    </div>

                  </td>
                </tr>

                <?php endforeach ?>
               </tbody>
            </table>
        </div>



        <div class="col-md-6">
            <h3 class="text-center text-dark "> Publicaciones Favoritas</h3>
            <table class="table table-responsive">
              <thead class="bg-info">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Imagen</th>
                  <th scope="col">Fecha</th>
                  <th scope="col">Categoria</th>
                  <th scope="col">Settings</th>
                </tr>
               </thead>
               <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                  <td>Otto</td>
                  <td>
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                      <button type="button" class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i>
                      </button>
                      <button type="button" class="btn btn-success">
                        <i class="fas fa-edit"></i>
                      </button>

                    </div>

                  </td>
                </tr>
               </tbody>
            </table>
        </div>



   </div>
</div>
























































<?php 

//var_dump($_SESSION['usuario']);

//var_dump($this->postuser);
 ?>




<div class="modal fade" id="aggpub" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center" style="background-image: linear-gradient(to bottom right, #163363, #26b18a); color: white;">
        <h4 class="modal-title w-100 font-weight-bold">Postear</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <form action="<?php echo constant('URL');?>user/newPoster/" method="POST" enctype="multipart/form-data">
          <div class="row">
    
            <div class="form-group col-md-12">  
              <input type="file" class="form-control" id="imagen" name="imagen" required="required">
            </div>

            <div class="form-group col-md-6"> 
              <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre Poster" required="required">
            </div>

            <div class="form-group col-md-6">
              <select name="categoria" class="form-control">
                <option selected="selected" disabled="">CATEGORIA</option>
                <?php foreach ($this->categorias as $cat): ?>
                <option value="<?php echo $cat['id_categoria']; ?>"><?php echo $cat['nombre_categoria'];?> </option>

                <?php endforeach ?>
              </select>
            </div>

          </div>
            
          
            
        
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" name="postear" class="btn btn-secondary">Postear</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>




<!--ELIMINAR POST-->
<?php foreach ($this->postuser as $postuser): ?>
<div class="modal fade" id="eliminarpostuser<?php echo $postuser["id_post"]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center" style="background:#da4747; color: white;">
        <h4 class="modal-title w-100 font-weight-bold">Seguro que Deseas Eliminar <?php echo ucwords($postuser["nombre_post"]);?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <div class="row text-center">
          <div class="col-md-6">
            <a type="submit" href="<?php echo constant('URL');?>user/borrarpostuser/<?php echo $postuser["id_post"];?>" class="btn btn-secondary">Eliminar</a>
          </div>
          <div class="col-md-6">
            <button type="reset" name="agg" class="btn btn-secondary " data-dismiss="modal">Cancelar</button>
          </div>
        </div>
        
         
      </div>      
    </div>
  </div>
</div> 
<?php endforeach ?>




<?php include_once 'views/home/includes/footer.php'; ?>
