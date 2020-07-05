<?php include_once 'views/home/includes/header.php'; ?>
<?php include_once 'views/home/includes/slider.php'; ?>


<div class="container my-5">
    <div class="row justify-content-center my-5">
        <div class="col-md-6" style="border-bottom: 1px solid gray;">
            <h3 class="text-center text-dark">Las mejores colecciones para profesionales</h3>
        </div>
    </div>
    <div class="row justify-content-center">

        <?php foreach ($this->post as $post): ?>
        <!--CARD -->
        <div class="col-4col-md-4  my-3">
            <div class="card cartaca" style="width: 18rem;">
                <img src="<?php echo constant('URL');?>public/img/post/<?php echo $post['img_post'];?>" class="card-img-top" alt="..." style="heighst: 200px;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo ucfirst($post['nombre_post']);?></h5>
                </div>
            </div>
        </div>
        <!--CARD FIN-->
        <?php endforeach ?>



    </div>
</div>












  	


      

<?php include_once 'views/home/includes/footer.php'; ?>




	



	

