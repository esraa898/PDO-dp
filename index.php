<?php
// //data source name.
// $dsn="mysql:host=localhost;dbname=cms;charest=UTF8";

// $connect = new PDO($dsn,"root","");
// $connect ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


//select by pdo 
// $res=$connect->query("SELECT * FROM `review`");

// $data= $res->fetchAll(2);
// echo "<pre>";
// print_r($data);



//delete by pdo using prepare &bind
// $id=5;
// $sql="DELETE FROM `review` WHERE `id` = :id ";
// $query= $connect->prepare($sql);
// $query ->bindParam(":id",$id,PDO::PARAM_INT);
// $query->execute();


// var_dump(get_loaded_extensions());
// try{
// $pdo= new PDO('mysql://hostname=localhost;dbname=medical',"root","",array(
//     PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION,
//     PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES UTF8'
// ));}catch(PDOException $e){

// }

$host= 'localhost';
$user= 'root';
$password='';
$dpname='brand';


//set dsn (data source name)
$dsn='mysql:host='.$host.';dbname='.$dpname;

//create A pdo instance (connection)
// $pdo =new PDO($dsn,$user,$password);
// $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);//هنا غيرت الدفولت  بتاعي ل obj بدلا من Array;
// $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false) ;
// becouse by default emulation  it has pdo steps to placeholder with actual data
// instead of sending it seprately so we close it to make limit work 


//EXCEPTION 

$options=array(
    PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES UTF8'
);
try{
    $pdo =new PDO($dsn,$user,$password ,$options);
     $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
     $q= "INSERT INTO brand (name) VALUES ('نايك')";
     $pdo->exec($q);
    echo 'you are connected';
}
catch(PDOException $e){
    echo 'failed'.$e->getMessage();

}
//pdo query


// $query= $pdo->query('SELECT * FROM  brand ');

// while ($row = $query->fetch(PDO::FETCH_ASSOC)){
//   print_r($row['name']."<br>") ;
// };

// while ($row = $query->fetch(PDO::FETCH_OBJ)){
//     print_r($row->name."<br>") ;
//   };



// prepared statements (prepare & execute)

// $sql = "SELECT * FROM brand where  category = '$category'";  //un safe way 

// fetch multiple 

// user input 
 $category='clothes';
// $name ='nike';
// $id=2;
    // positional parameter 
 $sql ='SELECT * FROM brand where category = ?';
$query= $pdo->prepare($sql);
 $query->execute([$category]);
 print_r($brands =$query->fetchAll());

    // named params 

//     $sql ='SELECT * FROM brand WHERE category = :category && name=:name';
//     $query= $pdo->prepare($sql);
//     $query->execute(['category' => $category,
// 'name'=> $name]);
//    $brands= $query-> fetchAll();



//    foreach($brands as $brand ){
//     echo $brand->name;
// }
// echo "<pre>";
// var_dump($brand);



// fetch single 

// $sql ='SELECT * FROM brand WHERE id= :id';
//     $query= $pdo->prepare($sql);
//     $query->execute(['id'=>$id]);
//    $brand= $query-> fetch();






//get row count

// $query = $pdo->prepare('SELECT * FROM brand WHERE category =? ');
// $query->execute([$category]);
// echo $count= $query->rowCount();





// insert data 

//     $name= 'puma';
//     $category= 'clothes';

// $sql = $pdo->prepare('INSERT INTO brand(name,category) VALUES  (:name,:category) ');
// $query= $sql->execute([
//     'name'=>$name,
//     'category'=>$category
// ]);

// echo "post adedd";



//update data 

// $name='puma';
// $id=2;

// $sql= "UPDATE brand SET name=:name WHERE  id= :id";
// $query= $pdo->prepare($sql);
// $query->execute([
//     'name'=>$name,'id'=>$id
// ]);
// echo "updated";




//search data 

// $search="%c%";
// $sql= "SELECT * from brand WHERE name LIKE ?";
// $query =$pdo->prepare($sql);
// $query->execute([$search]);
// $brands=$query->fetchAll();

// foreach ($brands as $brand ){
//    echo $brand->category."<br>";
// }