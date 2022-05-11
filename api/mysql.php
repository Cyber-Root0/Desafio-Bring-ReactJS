<?php
class BancoDados{
   public $con;
    //processo de conexão com o Banco de dados mysqli
    public function conectar(){
    $this->con=new mysqli('localhost', 'root', '', 'jogo');
           if($this->con->connect_error){
             return false;
            }else{
            return true;
          }
     
    }
   
    //função para inserir dados na tabela
    public function insert($ganhador,$hitory_x,$history_o){
    if ($this->con->query("INSERT INTO jogo (ganhador,historico_x,historico_o) VALUES ('$ganhador','$hitory_x','$history_o') ")){
        return true;
    }else{
        return false;
    }

    }
    //função para buscar dados e registros no banco de dados
    public function select($id){
       if ($id==0){
        $data=$this->con->query("SELECT * FROM jogo");
        return $data;
       }else if ($id==true){
         $data=$this->con->query("SELECT * FROM jogo ORDER BY id DESC LIMIT 4");
        return $data;
       }else{
        $data=$this->con->query("SELECT * FROM jogo WHERE id=$id");
        return $data;
       }

    }


}
?>



