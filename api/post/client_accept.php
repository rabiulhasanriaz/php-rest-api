<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/User.php';

  
  $database = new Database();
  $db = $database->connect();

  
  $post = new User($db);

  
  $data = json_decode(file_get_contents("php://input"));

  
  $post->id = $data->id;

  $post->accept = $data->accept;

  if($post->client_accept()) {
    echo json_encode(
      array('message' => 'Client Accepted')
    );
  } else {
    echo json_encode(
      array('message' => 'Client Not Accept')
    );
  }

