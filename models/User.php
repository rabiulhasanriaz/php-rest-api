<?php 
  class User {

    private $conn;
    private $table = 'users';

 
    public $id;
    public $user_id;
    public $sent;
    public $accept;
    public $reject;
    public $created_at;
    public $updated_at;


    public function __construct($db) {
      $this->conn = $db;
    }

    public function read() {
     
      $query = 'SELECT * FROM ' . $this->table;
      
   
      $stmt = $this->conn->prepare($query);

 
      $stmt->execute();

      return $stmt;
    }

  
   


    public function create() {
 
        $query = 'INSERT INTO ' . $this->table . ' SET user_id = :user_id, sent = :sent, accept = :accept, reject = :reject';

    
        $stmt = $this->conn->prepare($query);

   
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->sent = htmlspecialchars(strip_tags($this->sent));
        $this->accept = htmlspecialchars(strip_tags($this->accept));
        $this->reject = htmlspecialchars(strip_tags($this->reject));

    
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':sent', $this->sent);
        $stmt->bindParam(':accept', $this->accept);
        $stmt->bindParam(':reject', $this->reject);

    
        if($stmt->execute()) {
          return true;
    }

  
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

  
    public function update() {
      
          $query = 'UPDATE ' . $this->table . '
                                SET sent = :sent
                                WHERE id = :id';


          $stmt = $this->conn->prepare($query);


          $this->sent = htmlspecialchars(strip_tags($this->sent));
          $this->id = htmlspecialchars(strip_tags($this->id));

   
          $stmt->bindParam(':sent', $this->sent);

          $stmt->bindParam(':id', $this->id);


          if($stmt->execute()) {
            return true;
          }

      
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

    public function client_accept() {
        // Create query
        $query = 'UPDATE ' . $this->table . '
                              SET accept = :accept
                              WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->accept = htmlspecialchars(strip_tags($this->accept));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':accept', $this->accept);

        $stmt->bindParam(':id', $this->id);

        // Execute query
        if($stmt->execute()) {
          return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
  }

  public function client_reject() {
    // Create query
    
        $query = 'UPDATE ' . $this->table . '
                          SET reject = :reject
                          WHERE id = :id';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->reject = htmlspecialchars(strip_tags($this->reject));
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind data
    $stmt->bindParam(':reject', $this->reject);

    $stmt->bindParam(':id', $this->id);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
    
    
}


   
    
  }