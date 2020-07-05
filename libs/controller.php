<?php 
/**
 * 
 */
class Controller{

	#public $view;
	
	function __construct()
	{
		#echo "<p>controlador Base<p>";
		$this->view = new View();
	}

	function loadModel($model){

		$url = 'models/'.$model.'model.php';

		if (file_exists($url)) {

			require_once $url;

			$modelName = $model.'Model';
			$this->model = new $modelName();
		}


		
	}
}
 ?>