<?php 
// use function GuzzleHttp\json_encode;
require 'vendor/autoload.php';
require 'db.php';?>


<?php

// if(data in redis){
//     step 1: return data;
// }else{
//     step 1: query MYSQL
//     step 2: Save in redis
//     step 3: return data
// }

function getData(){
    global $redis;

    if($redis->exists("student"))
    {
        return dataFromRedis();
    }
    else{
        global $conn;
        $sql = "SELECT firstname FROM student";
        $query = mysqli_query($conn,$sql);
        $rows = array();
        while($row = mysqli_fetch_row($query)) {
            $rows[] = $row;
           
        }
            // var_dump($rows);
        //pushing data to  redis
        global $redis;
        $redis->set('student',json_encode($rows));
        error_log("Mysql===>".json_encode($rows));
        return $rows;
    }
}
function dataFromRedis(){
    global $redis;

    $data = json_decode($redis->get('student'),true);

    error_log("Redis====>965".json_encode($data));
    
   return $data;

}
 $printData = getData();

?>
