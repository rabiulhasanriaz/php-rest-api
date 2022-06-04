<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/User.php';

 
  $database = new Database();
  $db = $database->connect();

 
  $post = new User($db);
  
  $result = $post->read();
  

  $num = $result->rowCount();

  
  if($num > 0) {
    
    $posts_arr = array();
    

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $post_item = array(
        'id' => $id,
        'user_id' => $user_is,
        'sent' => $sent,
        'accept' => $accept,
        'reject' => $reject,
        'created_at' => $created_at,
        'updated_at' => $updated_at
      );

    
      array_push($posts_arr, $post_item);
      
    }

  
    echo json_encode($posts_arr);

  } else {
 
    echo json_encode(
      array('message' => 'No User Found')
    );
  }
