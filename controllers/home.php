<?php 

/**
 * 
 */
include_once 'models/homemodel.php';

class Home extends Controller
{

	public $modelhome;
	
function __construct(){


	session_start();
	$this->modelhome = new HomeModel();
	parent::__construct();
}

// render view
function render(){

	$this->view->categorias = $this->modelhome->getcategorias();	
	$this->view->render('home/index');
}



public function publicaciones(){

	$this->view->post = $this->modelhome->getPost();
	$this->view->render('home/publicaciones');


}


public function categoria($id=null){

	if (isset($id)) {
	
	$this->view->post = $this->modelhome->getPostId($id[0]);
	$this->view->render('home/publicaciones');
	
	}else{
		header('location:'.constant('URL').'home/publicaciones');

	}



}








// cargar login 
public function login(){

	if (isset($_SESSION['usuario']) and !empty($_SESSION['usuario'])) {
	    header('location:'.constant('URL').'user');
	}else{

		// no esta logeado entncs verifica si quiere entrar
		if (isset($_POST['iniciosesion'])) {
			// verifica si estan vacios los campos

			if (!empty($_POST['email']) AND
		        !empty($_POST['pass'])) {
				// si no estan vacion entncs metelos en un array

				$datos = [

					'email'   => $_POST['email'],
					'pass' => $_POST['pass']

				];
				// verifica si estan en la tabla users

				if ($this->model->login($datos)) {
					// si encontro un registro se lo trae y inicia session


					$_SESSION['usuario'] = $this->model->login($datos);
					// ver que tipo de usuario es

					



					//$this->view->mensajeexito = 'Inicio Exitoso, bienvenido!';
				    //$this->view->render('home/login');
				    header('location:'.constant('URL').'user');
				}else{
					//si no hay un usuario asi
				   $this->view->mensajeerror = 
				   'Ops..! Tus Datos son Incorrectos!';
		           $this->view->render('home/login');
				} 
			}else{
			$this->view->mensajeerror = 'Ops! Tus campos estan vacios!';
		    $this->view->render('home/login');
			}

			
		}else{
		$this->view->render('home/login');
		}
	}

}



public function registro(){

	// verifica si esta logeado el usuario

	if (isset($_SESSION['usuario']) and !empty($_SESSION['usuario'])) {
	    header('location:'.constant('URL').'user');
	}else{
		// no esta logeado verifica si se quiere registrar

		if (isset($_POST['registrar'])) {
			// aqui se quiere registrar y no esta logeado verificar campos

			if (!empty($_POST['nombre']) AND
		        !empty($_POST['apellido']) AND
	            !empty($_POST['email']) AND
                !empty($_POST['password']) ) {
				// si no estan vacion entncs metelos en un array

				$datos = [

					'nombre'   => $_POST['nombre'],
					'apellido' => $_POST['apellido'],
					'email'    => $_POST['email'],
					'password' => $_POST['password'],
					'avatar'   => 'noimg',
					'rol'      => 'u'

				];
				// insertar en la tabla users

				if ($this->model->insertRegistro($datos)) {
					$this->view->mensajeexito = 'Registro Exitoso, bienvenido! inicia sesion';
					$this->view->render('home/login');
				}else{
					//si no inserta hay un campo malo
				   $this->view->mensajeerror = 
				   'Ops..! El correo ya esta registrado!';
		           $this->view->render('home/registro');
				} 
			}else{
			$this->view->mensajeerror = 'Ops! verifica que los campos no esten vacios!';
		    $this->view->render('home/registro');
			}
		}else{
			//no se quiere registrar mandalo al registro
		    $this->view->render('home/registro');
		}


	}

}



















































































































// Function Logout
function logout(){
	unset($_SESSION['administrator']);
	$this->render();
}

























function aggcarrito(){
// var_dump($_POST);
		if (isset($_POST['enviar'])) {
			
			if (!isset($_SESSION['carrito'])) {

				

				$producto =[

					'id' => $_POST['idoculto'],
					'nombre' => $_POST['noculto'],
					'cantidad' => $_POST['cantidad'],
					'color' => $color ,
					'precio' => $_POST['poculto'],
					'codigo' => $_POST['codigo'],
					'imagen' => $_POST['imagen'],
					'marca' => $_POST['marca']


				];
				$_SESSION['carrito'][0]=$producto;
			}else{
				$numProducto = count($_SESSION['carrito']);
				$producto =[

					'id' => $_POST['idoculto'],
					'nombre' => $_POST['noculto'],
					'cantidad' => $_POST['cantidad'],
					'color' => $color ,
					'precio' => $_POST['poculto'],
					'codigo' => $_POST['codigo'],
					'imagen' => $_POST['imagen'],
					'marca' => $_POST['marca']

				];
				$_SESSION['carrito'][$numProducto]=$producto;
			}

			// var_dump($_POST);
		}
		header('location:'.constant('URL').'home/verCarrito/');
	}



function verCarrito(){
	$this->view->render('home/carrito');
}


function deletarticulo($id=null){
        
	foreach ($_SESSION['carrito'] as $indice=>$carritodecompras){
		if ($carritodecompras['id']==$id[0]) {
			unset($_SESSION['carrito'][$indice]);
			header('location:'.constant('URL').'home/verCarrito');
		}		
	}      
}



function checkOut(){

	if (isset($_POST['totalPago'])) {

		$_SESSION['totalPago'] = $_POST['totalPago'];
	    $this->view->render('home/checkout');
	    
	}else{
		header('location:'.constant('URL'));
	}
}

function prueba(){

	var_dump($_SESSION);
}















function processingPayment(){	

	if (isset($_SESSION['totalPago']) and !empty($_SESSION['totalPago'])) {

		if (isset($_POST)) {

			if (!empty($_POST['name']) and 
				!empty($_POST['lastname']) and 
				!empty($_POST['email']) and 
				!empty($_POST['phone']) and 
				!empty($_POST['address'])
			){


				$name     =  $_POST['name'];
			    $lastname =  $_POST['lastname'];
			    $email    =  $_POST['email'];
			    $phone    =  $_POST['phone'];
			    $address  =  $_POST['address'];


			    $datosCompra = [

				         'name'      => $name ,
				         'lastname'  => $lastname,
				         'email'     => $email,
				         'phone'     => $phone,
				         'address'   => $address,
				         'totalPago' =>$_SESSION['totalPago'],
				         'statuscompra' => 'Aprobada'
			        ];













			Stripe\Stripe::setApiKey("sk_test_lj8VaRlOpWYh401QCQhiCpPu00aHQyYchN");

            $pricep = str_replace(',', '',$_SESSION['totalPago']) ;
			$price = floatval(str_replace('.', '',$pricep)) ;
			$token = $_POST["stripeToken"];

			$charge = \Stripe\Charge::create([
				"amount" => $price,
				"currency" => "usd",
				"description" => "Nombre: ".ucfirst($name).' '.ucfirst($lastname).' Correo: '.$email.' Telefono: '.$phone.' direccion: '.$address,
				"source" => $token
			]);




			if ($charge['status'] == "succeeded") {







				if ($this->model->insertCompra($datosCompra)) {

					if ($this->model->getCompra()) {
						$compra = $this->model->getCompra()[0]['id_compra'];


						foreach ($_SESSION['carrito'] as $pc ) {

							$datos = [

								'id_productoregis' => $pc['id'],
								'id_comp_real'     => $compra,
								'cant_pc' => $pc['cantidad']
							];
							$this->model->insertPc($datos);
						}
						echo "LA COMPRA SE REALIZO Y SE INSERTO TODO CORRECTAMENTE";

					}else{
						echo "NO ME TRAJO LOS DATOS DE LA ULTIMA COMPRA";
					}	
				}else{

					echo "NO INSERTADO LOS DATOS DE LA COMPRA";
				}





				echo "TODO BIEN";

			}else{
				echo "todo mal";
			}




			
		}else{
			echo "Esta vacio todo ese beta";
		}


	}else{
		echo "no envio form";
	}
	
}else{
	header('location:'.constant('URL'));
}

}// FIN de function precessingPayment











function finalizarCompra(){
	session_destroy();
}







}?>