<?php 

/**
 * 
 */
require_once 'controllers/woops.php';
class App 
{
	
	function __construct()
	{
		#echo "<p>Nueva App</p>";
		$url = isset($_GET['url'])? $_GET['url']: null;
		$url = rtrim($url,'/');
		$url = explode('/',$url);
		
		if(empty($url[0])){
            $archivoController = 'controllers/home.php';
            require $archivoController;
            $controller = new Home();
            #$controller->render();
            $controller->loadModel('home');
            $controller->render();
            return false;
        }else{

        	$archivoController = 'controllers/'.$url[0].'.php';
        }

		



		if (file_exists($archivoController)) {

            require_once $archivoController ;

			//inicializar el controlador
		    $controller = new $url[0];
		    $controller->loadModel($url[0]);

		    //numero de elementos de la url para saber si se quiere cargar un parametro osea un numero 3

		    $nparam = sizeof($url);

		    switch ($nparam) {

				case 1:
					#echo $nparam;
				    $controller->render();
					break;

				case 2:
					#echo $nparam;
				    if (method_exists($controller,$url[1])) {
				    	$controller->{$url[1]}();
				    }else{
				    	$controller = new Woops();
			            #$controller->render();
				    }				    
					break;

				case 3:
					
				    $param = [];
					for ($i=2; $i < $nparam ; $i++) { 
						array_push($param, $url[$i]);
					}



					if (method_exists($controller,$url[1])) {
				    	$controller->{$url[1]}($param);
				    }else{
				    	$controller = new Woops();
			            #$controller->render();
				    }

					
					break;		
				
				default:
					    $controller = new Woops();
			           # $controller->render();
					break;
			}

		    

		}else{
           $controller = new Woops();
		}
	}
}





 ?>