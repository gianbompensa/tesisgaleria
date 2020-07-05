<?php 

/**
 * 
 */
class Admin extends Controller
{
    
function __construct(){

    session_start();
    parent::__construct();
}

// render view
function render(){
    if (isset($_SESSION['administrator'])) {
        $this->view->useractive = $_SESSION['administrator'];
        $this->view->categorias = $this->model->getCategories();
        $this->view->productos = $this->model->getProducts();
        $this->view->render('admin/adminHome');
    }else{
       header('location:'.constant('URL')); 
    }
    
}


// Function Login 
function login(){

    if (isset($_SESSION['administrator'])) {
        $this->render();
    }else{

        if (isset($_POST['login'])) {

        if (!empty($_POST['email']) and !empty($_POST['pass']) ) {

            $datos=[
                'email'=> $_POST['email'],
                'pass'=> $_POST['pass']

            ];

            if ($this->model->login($datos)) {

                
                $_SESSION['administrator'] 
                = $this->model->login($datos)[0]['id_user'];

                $this->view->useractive = $_SESSION['administrator'];

                 $this->render();
                
            }else{
                header('location:'.constant('URL'));
            }
            
        }else{
            header('location:'.constant('URL'));
        }

    }else{
        header('location:'.constant('URL'));
    }

    }
}

/****************************************************
             CRUD CATEGORIAS
****************************************************/

function crearCategoria(){
    
    if (isset($_POST)) {
        if (!empty($_POST['nombre'])) {

            $datos = [

                'nombre' => $_POST['nombre']

            ];

            if ($this->model->createCategori($datos)) {
               $this->render();
            }else{
                $this->render();
            }
           
        }else{
            $this->render();
        }

    }else{
        $this->render();
    }

}


function borrarCategoria($id){
    $aidi = $id[0];
    if ($this->model->deleteCategoria($aidi)) {
        $this->render();
    }else{
        $this->render();
    }

}














/***************************************************************
       CRUD PRODUCTOS
****************************************************************/




public function crearProducto(){
        if (isset($_SESSION['administrator'])) {
            if (isset($_POST)) {

                if (!empty($_POST['code'])   AND 
                    !empty($_POST['marca'])   AND 
                    !empty($_POST['name'])    AND 
                    !empty($_POST['price'])   AND 
                    !empty($_POST['categoria']) AND 
                    !empty($_POST['description'])) {
                    

                $code = $_POST['code'];
                $marca = $_POST['marca'];
                $name = $_POST['name'];
                $price = $_POST['price'];
                $categoria = $_POST['categoria'];
                $description = $_POST['description'];
                $imagen = "imagen";


                if ($_FILES['imagen']['name'] != null) {

                    $imagen = $_FILES['imagen']['name'];
                    $paimg = $_FILES['imagen']; 

                }

                $datosproduct = [
                    "code" => $code,
                    "marca" => $marca,
                    "name" => $name,
                    "price" => $price,
                    "categoria" => $categoria,
                    "description" => $description,
                    "imagen" => $imagen
                ];

                if ($imagen !== 'imagen') {
                    if ($this->model->createProducts($datosproduct)) {
                        $this->chekarImg($paimg);
                        echo "El Producto ha sido Creado con Exito";
                    }else{
                        $this->render();
                    }

                    $this->render();
                }else{
                    $this->render();
                }

                
            }else{
                
               $this->render();
                

            }



        }else{
            
          $this->render();
            
        }

    }else{
        header('location:'.constant('URL'));
    }
}




function borrarProducto($id){
    $aidi = $id[0];
    if ($this->model->deleteProducts($aidi)) {
        $this->render();
    }else{
        $this->render();
    }

}



function ventas(){

    #$this->view->ventasDetalles = $this->model->getVentasDetails();
    $this->view->ventas = $this->model->getVentas();
    $this->view->render('admin/ventas');

}

  
function detalleVenta($id){

 
   $aidi = $id[0];
   $this->view->datos = $this->model->getVentasDetails($aidi);
   $this->view->render('admin/detalleVenta');
/*echo "<h1>Estos son los productos del cliente".$PCOMPRADOS[0]['name_client']."</h1>";
 foreach($PCOMPRADOS as $producto)
{
    echo "<h1>".
         $producto['id_products']
    ." ".$producto['code_products']
    ." ".$producto['marca_products']
    ." ".$producto['name_products'] 
    ." ".$producto['price_products']
    ." ".$producto['description_products']
    ." ".$producto['img_products']
    ."</h1>";
 
    
}*/


    
   




}





















































































































public function chekarImg($img){

    #var_dump($img) ;
    $directorio ="public/img/productos/";

    $archivo = $directorio . basename($img["name"]);

    $tipoArchivo = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));

    // valida que es imagen
    $checarSiImagen = getimagesize($img["tmp_name"]);

    //var_dump($size);

    if($checarSiImagen != false){

        //validando tamaño del archivo
        $size = $img["size"];

        if($size > 500000000000){
            #echo "El archivo tiene que ser menor a 500kb";
            return false;
        }else{

            //validar tipo de imagen
            if($tipoArchivo == "jpg" || $tipoArchivo == "jpeg"){
                // se validó el archivo correctamente
                if(move_uploaded_file($img["tmp_name"], $archivo)){
                    #echo "El archivo se subió correctamente";
                    return true;
                }else{
                    #echo "Hubo un error en la subida del archivo";
                    return false;
                }
            }else{
                return false;
                #echo "Solo se admiten archivos jpg/jpeg";
            }
        }
    }else{
        return false;
        #echo "El documento no es una imagen";
    }

    }









}?>