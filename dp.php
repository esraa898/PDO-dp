<?php


class Database{
   private $host='localhost';
   private $username='root';
   private $password='';
   protected $dbname= 'brand';
   protected $object=array(
     PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES UTF8",
     PDO::MYSQL_ATTR_FOUND_ROWS => true
     );
   protected $sql;
   protected $query;
   protected $pdo;
   protected $stmt;


public function __construct()
{
    $dsn='mysql:host='.$this->host.';dbname='.$this->dbname;

    try{
        $this->pdo= new PDO($dsn,$this->username,$this->password,$this->object);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
         $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE ,PDO::FETCH_ASSOC);

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


// where selection without adding  value of data as aprameter we add it in the excute 
public function where($column ,$compair){
    $this->sql .= " WHERE $column $compair :$column";
    return $this;
}
 public function andWhere($column,$compair){
    $this->sql .= " AND $column $compair :$column";
    return $this;
 }
 public function orWhere($column,$compair){
    $this->sql .= " OR $column $compair :$column";
    return $this;
 }
public function  query(){
    $this->query= $this->pdo->query($this->sql);
    return $this->query;
}


//get data of all columns
public function getAllData(){
    $this->query();
     while ($row =$this->query->fetch()){
      $data[]= $row;
}
return$data;
}


// prepare statement 
public function prepare(){
return $this->stmt= $this->pdo->prepare($this->sql);
}


//get data of one column with 1 selection 
public function getRow($data){
      $this->prepare();
      $this->excute($data);
             $data= $this->stmt->fetchALL();

       foreach($data as $row){
           $row;
       }
return $row;
}


//get data from all columns with same selection 
public function  getAllrow($data){
    $this->prepare();
    $this->excute($data);
           $data= $this->stmt->fetchALL();
           return $data;
}


//get data of one column with multipale selection 
public function getRowMultipaleSelection($data){
    $this->prepare();
    $this->excute($data);
    $data= $this->stmt->fetch();
    foreach($data as $row){
        $row;
    }
return $row;
}

// prepare data to get the keys and add : to it 
public function prepareData($dataparam){
     $row='';
    foreach ($dataparam as $key=>$value)
{
        $row .= "$key = :$key,";
}
$row=rtrim($row,',');
return $row;
}



public function insert($table,$dataparam){
//$this->sql=sprintf('INSERT INTO %s (%s) VALUES (%s)' ,$table,implode(',',array_keys($dataparam)),':'.implode(',:',array_keys($dataparam)));
$row= $this->prepareData($dataparam);
$this->sql= "INSERT INTO $table SET $row ";
return $this;
}


public function Update($table,$dataparam){

 $row= $this->prepareData($dataparam);
    $this->sql="UPDATE $table SET $row";
   return $this;
}

public function delete($table){
    $this->sql="DELETE  FROM $table ";
    return $this;
}

public function excute($data){
$this->prepare();
 $this->stmt->execute($data);
 $count =$this->stmt->rowCount();
if ($count >0){
     echo'sucess';
}
   else{
     echo 'error';
   }





}
}


$conn= New Database ;
$user=[
 
    'name'=>'fresh',
    'category'=>'elctronic'
  
];
//$pd= $conn->delete('brand')->where("category","=")->excute($user);
//$pd= $conn->insert('brand',$user)->excute($user);
//$pd=$conn->Update('brand',$user)->where('id',"=")->excute($user);
// print_r($pd= $conn->select('*','brand')->where('category','=')->getAllRow($user));
// print_r($pd= $conn->select('*','brand')->where('category','=')->getAllRow($user));
