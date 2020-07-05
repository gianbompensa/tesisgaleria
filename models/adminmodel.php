<?php 

/**
 * 
 */

class adminModel extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}



	public function login($datos){

    $users = [];

    $query 
    = $this->db->connect()
    ->prepare("SELECT * FROM user WHERE correo = :user AND pass = :pass");

    try {

      $query->execute([
        'user' => $datos['email'],
        'pass'  => $datos['pass']

      ]);

      while($row = $query->FETCHALL(PDO::FETCH_ASSOC)) {
        $users = $row;
      }
      
      return $users;
      return true;

    } catch (PDOException $e) {
      return false;     
    }

  }



/*****************************************************
         CRUD DE CATEGORIAS
*****************************************************/
	
	
public function getCategories(){
        $items = [];

        try {

         $query = $this->db->connect()->query("SELECT * FROM categories");

            while($row = $query->FETCHALL(PDO::FETCH_ASSOC)) {
                $items = $row;
            }
            return $items;
            return true;
            
        } catch (PDOException $e) {

            return [];
            return false;
            
        }
    }//fin function get




public function createCategori($datos){  

        try {

            $query 
            = $this->db->connect()
            ->prepare('INSERT INTO categories(nombre_categories)VALUES (:nombre)');
            $query->execute([
            	'nombre' => $datos['nombre']
            ]);
            return true;
            
        } catch (PDOException $e) {
            #echo "Ya existe esa Matricula";
            return false;
            
        }
        
        
    }


public function deleteCategoria($id){

		$query 
        = $this->db->connect()
        ->prepare("DELETE  FROM categories WHERE id_categories = :id");

        try {

        	$query->execute(['id' => $id]);

        	return true;
        	
        } catch (PDOException $e) {
        	return false;
        	
        }



	}


/****************************************************
      CRUD DE PRODUCTOS
*****************************************************/


 public function createProducts($datos){

   
        try {

             $query 
            = $this->db->connect()
            ->prepare('INSERT INTO products 
                (code_products,marca_products,name_products,price_products,category_products,description_products,img_products)VALUES(:code,:marca,:name,:price,:category,:description,:img)');


           
            $query->execute([
                
            'code'  => $datos['code'],
            'marca' => $datos['marca'],
            'name'  => $datos['name'],
            'price' => $datos['price'],
            'category' => $datos['categoria'],  
            'description' => $datos['description']
            ,'img' => $datos['imagen']
            ]);
            return true;
            
        } catch (PDOException $e) {
            #echo "Ya existe esa Matricula";
            return false;
            
        }
        
        
    }

public function getProducts(){
        $items = [];

        try {

         $query = $this->db->connect()->query("SELECT * FROM products INNER JOIN categories WHERE category_products=id_categories");

            while($row = $query->FETCHALL(PDO::FETCH_ASSOC)) {
                $items = $row;
            }
            return $items;
            return true;
            
        } catch (PDOException $e) {

            return [];
            return false;
            
        }
    }//fin function get

public function deleteProducts($id){

        $query 
        = $this->db->connect()
        ->prepare("DELETE  FROM products WHERE id_products = :id");

        try {

            $query->execute(['id' => $id]);

            return true;
            
        } catch (PDOException $e) {
            return false;
            
        }



    }



public function getVentas(){
        $items = [];



        try {

         $query = $this->db->connect()->query("SELECT * FROM compras");

            while($row = $query->FETCHALL(PDO::FETCH_ASSOC)) {
                $items = $row;
            }
            return $items;
            return true;
            
        } catch (PDOException $e) {

            return [];
            return false;
            
        }
    }//fin function get





 /*   public function Prueba($id){
        $items = [];

        $query = $this->db->connect()->prepare("SELECT * FROM productoscomp WHERE id_comp_real = :id");
        try {

            $query->execute(['id' => $id]);
            while($row = $query->FETCHALL(PDO::FETCH_ASSOC)) {
                $items = $row;
            }
            return $items;
            return true;
            
        } catch (PDOException $e) {
            return [];
            return false;
            
        }
    }//fin function get*/

public function getVentasDetails($id){

        $items = [];
        $aidi = $id;

        $query = $this->db->connect()->prepare("SELECT * FROM compras INNER JOIN productoscomp INNER JOIN products WHERE productoscomp.id_productosregis=products.id_products and id_comp_real=:id and id_compra=$aidi");
        try {

            $query->execute(['id' => $id]);
            while($row = $query->FETCHALL(PDO::FETCH_ASSOC)) {
                $items = $row;
            }
            return $items;
            return true;
            
        } catch (PDOException $e) {
            return [];
            return false;
        }
    }//fin function get


public function getProductosVentasDetails(){

        $items = [];

        $query = $this->db->connect()->prepare("SELECT * FROM products WHERE id_products=:id");
        try {

            $query->execute(['id' => $id]);
            while($row = $query->FETCHALL(PDO::FETCH_ASSOC)) {
                $items = $row;
            }
            return $items;
            return true;
            
        } catch (PDOException $e) {
            return [];
            return false;
            

        }
    }//fin function get



public function getVentasSi(){
        $items = [];



        try {

         $query = $this->db->connect()->query("SELECT * FROM compras INNER JOIN productoscomp INNER JOIN products WHERE productoscomp.id_comp_real = compras.id_compra and products.id_products=productoscomp.id_productosregis");

            while($row = $query->FETCHALL(PDO::FETCH_ASSOC)) {
                $items = $row;
            }
            return $items;
            return true;
            
        } catch (PDOException $e) {

            return [];
            return false;
            
        }
    }//fin function ge










	 










}?>







