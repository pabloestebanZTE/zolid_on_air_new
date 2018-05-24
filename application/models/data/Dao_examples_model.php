<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dao_examples_model extends CI_Model {
    protected $session;
    public function __construct() {
        $this->load->model('dto/Users');
    }
   /**
   * Retornará todos los registros de la entidad Users en un arreglo de objetos...
   */
    public function getAll($request){
      try{
        $user = new Users();
        $datos = $user->get();
        $response = new Response(EMessages::QUERY);
        $response->setData($datos);
        return $response;
      }catch(DeplynException $ex){
        return $ex;
      }
    }
    /**
    * Retornará una lista(array) de objetos que coincidan con las reglas de la consulta.
    */
    public function getCustom($request){
      try{
        $user = new Users();
        $datos = $user->where("token","=","123")
                 ->orWhere("password","=","12345")
                 ->get();
        $response = new Response(EMessages::QUERY);
        $response->setData($datos);
        return $response;
      }catch(DeplynException $ex){
        return $ex;
      }
    }
    /**
    * Consulta haciendo uso del eloquent con parámetros personalizados...
    */
    public function getCustom2($request){
      try{
        //Se seleccionan solo dos parámetros que se desean mostrar (password y token se excluirán)...
        $data = DB::table('users')
                ->select("id","username")
                ->get();
        $response = new Response(EMessages::QUERY);
        $response->setData($data);
        return $response;
      }catch(DeplynException $ex){
        return $ex;
      }
    }
    /**
    * En el siguiente ejemplo se listan los usuarios, se hace una ordenación por id
    * de forma descendente y se limita el número de registros a solo uno.
    */
    public function getCustom3($request){
      try{
        $data = DB::table("users")
                ->where("token","=","123")
                ->orderBy("id","DESC")
                ->limit(1)->get();
        $response = new Response(EMessages::QUERY);
        $response->setData($data);
        return $response;
      }catch(DeplynException $ex){
        return $ex;
      }
    }
    /**
    * En el siguiente ejemplo se listan los usuarios, y al igual que antes se
    * se hace un limit pero esta vez se pasan dos parámetros al método limit, esto,
    * con el fin de hacer limites entre rangos especificos de archivos (Muy útil para las páginaciones).
    */
    public function getCustom4($request){
      try{
        $data = DB::table("users")
                ->where("token","=","123")
                ->limit(0,2)
                ->get();
        $response = new Response(EMessages::QUERY);
        $response->setData($data);
        return $response;
      }catch(DeplynException $ex){
        return $ex;
      }
    }
    /**
    * Consultará un objeto con los datos del usuario.
    */
    public function findById($request){
          try{
            $user = new Users();
            $datos = $user
                  ->where("id", "=", $request->id)
                  ->first();
            $response = new Response(EMessages::QUERY);
            $response->setData($datos);
            return $response;
          }catch(DeplynException $ex){
            return $ex;
          }
    }
    /**
    * Se inserta un usuario.
    */
    public function insert($request){
      try{
        $request->token = Hash::md5($request->email);
        $request->password = Hash::whirlpool($request->password);
        $user = new Users();
        $user->insert($request->all());
        return new Response(EMessages::INSERT);
      }catch(DeplynException $ex){
        return $ex;
      }
    }
   /**
   * Se actualiza un usuario.
   */
    public function update($request){
      try{
        $user = new Users();
        $user->where("id","=",$request->id)
             ->update($request->all());
        return new Response(EMessages::UPDATE);
      }catch(DeplynException $ex){
        return $ex;
      }
    }
    /**
    * Se elimina un usuario.
    */
    public function delete($request){
      try{
        $user = new Users();
        $user->where("id","=",$request->id)
             ->delete();
        return new Response(EMessages::DELETE);
      }catch(DeplynException $ex){
        return $ex;
      }
    }
}
