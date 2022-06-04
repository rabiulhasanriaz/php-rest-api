<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/User.php';

  
  $database = new Database();
  $db = $database->connect();

 
  $post = new User($db);

  
  $data = json_decode(file_get_contents("php://input"));

  $post->user_id = $data->user_id;
  $post->sent = $data->sent;
  $post->accept = $data->accept;
  $post->reject = $data->reject;

 
  if($post->create()) {
    echo json_encode(
      array('message' => 'User Created')
    );
  } else {
    echo json_encode(
      array('message' => 'User Not Created')
    );
  }

