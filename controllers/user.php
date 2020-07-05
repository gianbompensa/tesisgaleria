<?php 

include_once 'models/homemodel.php';


/**
 * 
 */
class User extends Controller{

    public $modelhome ;

    function __construct(){
        session_start();
        $this->modelhome = new HomeModel();
        parent::__construct();
        
    }


    function render(){

       if (isset($_SESSION['usuario']) and !empty($_SESSION['usuario'])) {

        if ($_SESSION['usuario'][0]['rol'] == 'u') {
            // si el login manda usuario normal
            $this->view->postuser = $this->modelhome->getPostTheUser($_SESSION['usuario'][0]['id_users']);
            $this->view->categorias = $this->modelhome->getcategorias();
            $this->view->render('home/perfil');
        }else{
            //si no es por que es admin

            $this->view->postuser = $this->modelhome->getPostTheUser($_SESSION['usuario'][0]['id_users']);
            $this->view->categorias = $this->modelhome->getcategorias();
            $this->view->render('home/perfiladmin');

        }               
       }else{

        header('location:'.constant('URL'));

       }

    }


    public function logout(){

    unset($_SESSION['usuario']);
    $this->render();

    }


    public function perfil(){

       if (isset($_SESSION['usuario']) and !empty($_SESSION['usuario'])) {

       if ($_SESSION['usuario'][0]['rol'] == 'u') {
            // si el login manda usuario normal
         $this->view->postuser = $this->modelhome->getPostTheUser($_SESSION['usuario'][0]['id_users']);
            $this->view->categorias = $this->modelhome->getcategorias();
            $this->view->render('home/perfil');
        }else{
            //si no es por que es admin
             $this->view->postuser = $this->modelhome->getPostTheUser($_SESSION['usuario'][0]['id_users']);
            $this->view->categorias = $this->modelhome->getcategorias();
            $this->view->render('home/perfiladmin');

        }  

       }else{

        header('location:'.constant('URL'));

       }
    }







/********************************************************************
                 FUNCIONES PARA EL ADMINISTRADOR
********************************************************************/

public function newCategoria(){

    if ($_SESSION['usuario'][0]['rol'] == 'u') {
            // si el login manda usuario normal
        header('location:'.constant('URL').'user');
    }else{
            //si no es por que es admin entncs fino

        if (isset($_POST['newcategoria'])) {
            if (!empty($_POST['nombre']) AND !empty($_POST['descripcion'])) {

                if ($_FILES['imagen']['name'] != null) {

                    $imagen = $_FILES['imagen']['name'];
                    $paimg = $_FILES['imagen']; 

                    if ($this->subircat($paimg)) {
                        # inserta en la base de datos
                        //aqui inclui otro modelo que no sea usermodel por que no existe

                        $datos =[

                            'nombre'     =>$_POST['nombre'],
                            'descripcion' =>$_POST['descripcion'],
                            'imagen'     =>$imagen
                        ];
                        

                        if ($this->modelhome->newCategoria($datos)) {

                            // si inserto la categoria perfectamente
                            $this->view->messageexito =  "Categoria creada con exito!";
                             $this->view->postuser = $this->modelhome->getPostTheUser($_SESSION['usuario'][0]['id_users']);
                            $this->view->categorias = $this->modelhome->getcategorias();
                            $this->view->render('home/perfiladmin');

                        }else{
                            
                            $this->view->message =  "Ops! algo fallo, intenta de nuevo.";
                             $this->view->postuser = $this->modelhome->getPostTheUser($_SESSION['usuario'][0]['id_users']);
                             $this->view->categorias = $this->modelhome->getcategorias();
                            $this->view->render('home/perfiladmin');
                             
                        }              
                    }else{

                        
                        $this->view->message =  "La imagen no cargo! intenta de nuevo!";
                         
                             $this->view->postuser = $this->modelhome->getPostTheUser($_SESSION['usuario'][0]['id_users']);
                             $this->view->categorias = $this->modelhome->getcategorias();
                         $this->view->render('home/perfiladmin');
                         
                    }
                }else{
                    
                     $this->view->message = "Debes cargar una imagen para su categoria!";
                     
                             $this->view->postuser = $this->modelhome->getPostTheUser($_SESSION['usuario'][0]['id_users']);
                             $this->view->categorias = $this->modelhome->getcategorias();
                     $this->view->render('home/perfiladmin');          
                }
            }else{
                
                $this->view->message =  "Hay campos vacios, para agregar la categoria!";
                
                             $this->view->postuser = $this->modelhome->getPostTheUser($_SESSION['usuario'][0]['id_users']);
                             $this->view->categorias = $this->modelhome->getcategorias();
                $this->view->render('home/perfiladmin');
                 
            }    
        }else{
            $this->view->message =  "Debes Enviar el Formulario";
            
                             $this->view->postuser = $this->modelhome->getPostTheUser($_SESSION['usuario'][0]['id_users']);
                             $this->view->categorias = $this->modelhome->getcategorias();
            $this->view->render('home/perfiladmin');
        }
    }  
}







public function categoriascreadas(){

    if (isset($_SESSION['usuario']) and !empty($_SESSION['usuario'])) {

       if ($_SESSION['usuario'][0]['rol'] == 'u') {
            // si el login manda usuario normal
            header('location:'.constant('URL').'user');
        }else{
            //si no es por que es admin
            $this->view->categorias = $this->modelhome->getcategorias();
            $this->view->render('admin/categorias');

        }  

       }else{

        header('location:'.constant('URL'));

    }

}



/******************************************************************
       METODOS PARA POSTEAR
******************************************************************/

public function newPoster(){

    if (isset($_SESSION['usuario']) and !empty($_SESSION['usuario'])) {
            // si hay sesion postea



        if (isset($_POST['postear'])) {
            if (!empty($_POST['nombre']) AND !empty($_POST['categoria'])) {

                if ($_FILES['imagen']['name'] != null) {

                    $imagen = $_FILES['imagen']['name'];
                    $paimg = $_FILES['imagen']; 

                    if ($this->subirpost($paimg)) {
                        # inserta en la base de datos
                        //aqui inclui otro modelo que no sea usermodel por que no existe

                        $datos =[

                            'img_post'     => $imagen,
                            'nombre_post'  => $_POST['nombre'],
                            'categoria'    => $_POST['categoria'],
                            'usuario'=> $_SESSION['usuario'][0]['id_users']
                        ];
                        

                        if ($this->modelhome->newPost($datos)) {

                            // si inserto la categoria perfectamente
                            $this->view->messageexito =  "Publicacion Exitosa!";
                            $this->view->postuser = $this->modelhome->getPostTheUser($_SESSION['usuario'][0]['id_users']);
                            $this->view->categorias = $this->modelhome->getcategorias();


                            if ($_SESSION['usuario'][0]['rol'] == 'u') {
                                # code...
                                $this->view->render('home/perfil');
                            }else{
                                $this->view->render('home/perfiladmin');
                            }
                            

                        }else{

                            $this->view->message =  "Ops! algo fallo, intenta de nuevo.";
                            $this->view->postuser = $this->modelhome->getPostTheUser($_SESSION['usuario'][0]['id_users']);
                            $this->view->categorias = $this->modelhome->getcategorias();
                            if ($_SESSION['usuario'][0]['rol'] == 'u') {
                                # code...
                                $this->view->render('home/perfil');
                            }else{
                                $this->view->render('home/perfiladmin');
                            }

                        }              
                    }else{

                        $this->view->message =  "La imagen no cargo! intenta de nuevo!";
                        $this->view->postuser = $this->modelhome->getPostTheUser($_SESSION['usuario'][0]['id_users']);
                        $this->view->categorias = $this->modelhome->getcategorias();
                        if ($_SESSION['usuario'][0]['rol'] == 'u') {
                                # code...
                            $this->view->render('home/perfil');
                        }else{
                            $this->view->render('home/perfiladmin');
                        }

                    }
                }else{

                   $this->view->message = "Debes cargar una imagen para su Post!";
                   $this->view->postuser = $this->modelhome->getPostTheUser($_SESSION['usuario'][0]['id_users']);
                   $this->view->categorias = $this->modelhome->getcategorias();
                   if ($_SESSION['usuario'][0]['rol'] == 'u') {
                                # code...
                    $this->view->render('home/perfil');
                }else{
                    $this->view->render('home/perfiladmin');
                };          
            }
        }else{

            $this->view->message =  "Hay campos vacios, para postear!";
            $this->view->postuser = $this->modelhome->getPostTheUser($_SESSION['usuario'][0]['id_users']);
            $this->view->categorias = $this->modelhome->getcategorias();
            if ($_SESSION['usuario'][0]['rol'] == 'u') {
                                # code...
                $this->view->render('home/perfil');
            }else{
                $this->view->render('home/perfiladmin');
            }

        }    
    }else{

        $this->view->postuser = $this->modelhome->getPostTheUser($_SESSION['usuario'][0]['id_users']);
        $this->view->categorias = $this->modelhome->getcategorias();
        if ($_SESSION['usuario'][0]['rol'] == 'u') {
                                # code...
            $this->view->render('home/perfil');
        }else{
            $this->view->render('home/perfiladmin');
        }
    }







}else{
            //si no no puede postear

    $this->render();
}  
}



public function versesion(){

    var_dump($_SESSION['usuario']);
}


/*******************************************************************
                       BORRAR POST USER
*******************************************************************/

public function borrarpostuser($id=null){

    $aidi = $id[0];

    //echo "borrado". $aidi;


    if (isset($_SESSION['usuario']) and !empty($_SESSION['usuario'])) {

        $this->modelhome->deletepost($aidi);

        $this->view->message =  "Post Eliminado Con Exito";
        $this->view->postuser = $this->modelhome->getPostTheUser($_SESSION['usuario'][0]['id_users']);
        $this->view->categorias = $this->modelhome->getcategorias();
        if ($_SESSION['usuario'][0]['rol'] == 'u') {
                                # code...
                $this->view->render('home/perfil');
        }else{
                $this->view->render('home/perfiladmin');
        }
    }else{

    }
}

















































































// VALIDAR QUE CARGO LA IMG 

 public function subircat($img){

    #var_dump($img) ;
    $directorio ="public/img/categorias/";

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
            if($tipoArchivo == "jpg" || $tipoArchivo == "jpeg"|| $tipoArchivo == "png"){
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


 public function subirpost($img){

    #var_dump($img) ;
    $directorio ="public/img/post/";

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
            if($tipoArchivo == "jpg" || $tipoArchivo == "jpeg"|| $tipoArchivo == "png"){
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









}
?>