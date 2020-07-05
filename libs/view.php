<?php 
/**
 * 
 */
class View
{
	
	function __construct()
	{
		#echo "<p>vista Base</p>";
	}

	function render($viewName){

		require_once 'views/'.$viewName.'.php';

	}
}
 ?>