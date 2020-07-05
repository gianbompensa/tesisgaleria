<?php include_once 'views/home/includes/header.php'; ?>
<?php include_once 'views/home/includes/slider.php'; ?>


<div class="container my-5">
    <div class="row justify-content-center my-5">
        <div class="col-md-6" style="border-bottom: 1px solid gray;">
            <h3 class="text-center text-dark">Las mejores colecciones para profesionales</h3>
            <h6 class="text-center text-dark"><a href="<?php echo constant('URL');?>home/publicaciones">VerTodo</a></h6>
        </div>
    </div>
    <div class="row justify-content-center">

        <?php foreach ($this->categorias as $categoria): ?>
        <!--CARD -->
        <a href="<?php echo constant('URL');?>home/categoria/<?php echo $categoria['id_categoria'];?>" style="text-decoration: none;">
        <div class="col-md-4 col-6 my-3">
            <div class="card cartaca" style="width: 18rem;">
                <img src="<?php echo constant('URL');?>public/img/categorias/<?php echo $categoria['img_categoria'];?>" class="card-img-top" alt="..." style="height: 200px;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo ucfirst($categoria['nombre_categoria']);?></h5>
                    <p class="card-text"><?php echo ucfirst($categoria['descripcion_categoria']);?></p>
                </div>
            </div>
        </div>
        </a>
        <!--CARD FIN-->
        <?php endforeach ?>



    </div>
</div>












  	


      

<?php include_once 'views/home/includes/footer.php'; ?>




	



	

