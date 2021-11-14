<?php


class Database{
    private $host='localhost';
   private $username='root';
   private $password='';
   protected $dbname= 'brand';
 public $object=array(
     PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES UTF8",
     
 );
 protected $sql;
 protected $query;
 protected $pdo;
public function __construct()
{
    $dsn='mysql:host='.$this->host.';dbname='.$this->dbname;

    try{
        $this->pdo= new PDO($dsn,$this->username,$this->password,$this->object);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
         $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE ,PDO::FETCH_OBJ);

        return $this;
       }
    catch(PDOException $e){
        echo"failed".$e->getMessage();
    }

}
public function  select($column ,$table){

  $this->sql= "SELECT $column FROM $table";
  return $this;
}
public function  query(){
    $this->query= $this->pdo->query($this->sql);
    return $this->query;
}
public function getData(){
    $this->query();
     while ($row =$this->query->fetch()){
      $data[]= $row;
}
return$data;
}
public function where(){
    $this->sql .= "WHERE id = ?";
    return $this;
}
public function getRow($value){
       $stmt= $this->pdo->prepare($this->sql);
       $stmt->execute([$value]);
       $data= $stmt->fetchAll();
       foreach($data as $row){
            $row;
       }
return $row;
}


}

$conn= New Database ;
  $pd= $conn->select('*','brand')->where()->getRow(3);
