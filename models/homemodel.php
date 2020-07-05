<?php 

/**
 * 
 */

class HomeModel extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}








  /**********************************************************
                 REGISTRO  Y INCIO DE SESSION 
  ***********************************************************/


  public function insertRegistro($datos){

    try {

            $query 
            = $this->db->connect()
            ->prepare('INSERT INTO users(nombre_user,apellido_user,email,pass,avatar,rol)VALUES (:nombre,:apellido,:email,:password,:avatar,:rol)');
            $query->execute([
              'nombre' => $datos['nombre'],
              'apellido' => $datos['apellido'],
              'email' => $datos['email'],
              'password' => $datos['password'],
              'avatar' => $datos['avatar'],
              'rol' => $datos['rol']
            ]);
            return true;
            
        } catch (PDOException $e) {
            #echo "Ya existe esa Matricula";
            return false;
            
        }
  }

  public function login($datos){

    $users = [];

    $query 
    = $this->db->connect()
    ->prepare("SELECT * FROM users WHERE email = :user AND pass = :pass");

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

  /***************************************************
            FUNCIONES PAL ADMIN
  ****************************************************/

public function newCategoria($datos){  

        try {

            $query 
            = $this->db->connect()
            ->prepare('INSERT INTO categorias(nombre_categoria,descripcion_categoria,img_categoria)VALUES (:nombre,:descripcion,:imagen)');
            $query->execute([
              'nombre'     => $datos['nombre'],
              'descripcion' => $datos['descripcion'],
              'imagen'     => $datos['imagen']
            ]);
            return true;
            
        } catch (PDOException $e) {
            #echo "Ya existe esa Matricula";
            return false;
            
        }
        
        
    }


    public function getcategorias(){
        $items = [];

        try {

         $query = $this->db->connect()->query("SELECT * FROM categorias");

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


/*********************************************************************
                  CRUD POST newPost
*********************************************************************/

public function newPost($datos){  

        try {

            $query 
            = $this->db->connect()
            ->prepare('INSERT INTO post 
              (img_post,nombre_post,categoria,usuario)VALUES (:img_post,:nombre_post,:categoria,:usuario)');
            $query->execute([
              'img_post'     => $datos['img_post'],
              'nombre_post' => $datos['nombre_post'],
              'categoria' => $datos['categoria'],
              'usuario'     => $datos['usuario']
            ]);
            return true;
            
        } catch (PDOException $e) {
            #echo "Ya existe esa Matricula";
            return false;
            
        }
        
        
    }


    public function getPost(){
        $items = [];

        try {

         $query = $this->db->connect()->query("SELECT * FROM post");

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


public function getPostId($i){
        $id = $i;
        $items = [];

        try {

         $query = $this->db->connect()->query("SELECT * FROM post WHERE categoria = $id");

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


    public function getPostTheUser($i){
        $id = $i;
        $items = [];

        try {

         $query = $this->db->connect()->query("SELECT * FROM post WHERE usuario = $id");

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




































	
	
	
	public function getProducts(){
        $items = [];

        try {

         $query = $this->db->connect()->query("SELECT * FROM products");

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



    public function getCont(){
        $items = [];

        try {

         $query = $this->db->connect()->query("SELECT * FROM cont");

            while($row = $query->FETCHALL(PDO::FETCH_ASSOC)) {
                $items = $row;
            }
            return $items;
            
            
        } catch (PDOException $e) {

            return [];
            return false;
            
        }
    }//fin function get

    public function upCont($datos){

    $query 
        = $this->db->connect()
        ->prepare("UPDATE cont SET contador = :contador ");

        try {

          $query->execute([
            'contador' => $datos
          ]);

          return true;
          
        } catch (PDOException $e) {
          return false;
          
        }
        //var_dump($datos) ;

  }


  
  
  
  
public function csrftokenmodel($datos){

    $query 
        = $this->db->connect()
        ->prepare("UPDATE window SET main = :main ");

        try {

          $query->execute([
            'main' => $datos[0]
          ]);

          return true;
          
        } catch (PDOException $e) {
          return false;
          
        }
        //var_dump($datos) ;

  }




  public function insertCompra($datos){

    try {

            $query 
            = $this->db->connect()
            ->prepare('INSERT INTO compras(name_client,lastname_client,email_client,phone_client,address_client,totalpago,status_compra,fecha)VALUES (:name,:lastname,:email,:phone,:address,:totalpago,:status,NOW())');
            $query->execute([
              'name' => $datos['name'],
              'lastname' => $datos['lastname'],
              'email' => $datos['email'],
              'phone' => $datos['phone'],
              'address' => $datos['address'],
              'totalpago' => $datos['totalPago'],
              'status' => $datos['statuscompra']
            ]);
            return true;
            
        } catch (PDOException $e) {
            #echo "Ya existe esa Matricula";
            return false;
            
        }
  }



  public function getCompra(){
        $items = [];

        try {

         $query = $this->db->connect()->query("SELECT * FROM `compras`ORDER BY id_compra DESC");

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


  public function insertPc($datos){

    try {

            $query 
            = $this->db->connect()
            ->prepare('INSERT INTO 
              productoscomp(id_productosregis,id_comp_real,cant_pc)VALUES (:id_productoregis,:id_comp_real,:cant_pc)');
            $query->execute([
              'id_productoregis' => $datos['id_productoregis'],
              'id_comp_real' => $datos['id_comp_real'],
              'cant_pc' => $datos['cant_pc']
            ]);
            return true;
            
        } catch (PDOException $e) {
            #echo "Ya existe esa Matricula";cant_pc
            return false;
            
        }



  }





  public function deletepost($id){

        $query 
        = $this->db->connect()
        ->prepare("DELETE  FROM post WHERE id_post = :id");

        try {

            $query->execute(['id' => $id]);

            return true;
            
        } catch (PDOException $e) {
            return false;
            
        }



    }


  




	 










}?>