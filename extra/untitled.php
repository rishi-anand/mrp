

<?php



class DatabaseOperation{
    var $isConnectionCreated = true;
    var $conn = "";
    function createConnection(){
      $servername = "localhost";
      $username = "root";
      $password = "9934";
      $dbname = "myDB";

      // Create connection
      $con = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($con->connect_error) {
          //$isConnectionCreated = false;
          $this->conn = $con;
          $this->isConnectionCreated = false;
          return "false";
          //die("Connection failed: " . $this->$conn->connect_error);
      }else{
        return "true";
      }
    }
    function insertIntoTable($id,$string){
      if(!$id)
        return 0;
      $id = (string) $id;
      $id = "'".$id."'";
      $string = (string) $string;
      $string = "'".$string."'";
      $servername = "localhost";
      $username = "root";
      $password = "9934";
      $dbname = "myDB";

      // Create connection
      $con = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($con->connect_error) {
          //$isConnectionCreated = false;
          $this->conn = $con;
          $this->isConnectionCreated = false;
          return "false";
          //die("Connection failed: " . $this->$conn->connect_error);
      }
      $sql = "INSERT INTO Sale_Print (sale_no, sale_data)
            VALUES ($id, $string)";
      if ($con->query($sql) === TRUE) {
          //echo "New record created successfully";
          return 1;
      } else {
          //echo "Error: " . $sql . "<br>" . $con->error;
          return 0;
      }
    }
    function getStringFromTable($id){
      if(!$id)
        return 0;
      $servername = "localhost";
      $username = "root";
      $password = "9934";
      $dbname = "myDB";

      // Create connection
      $con = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($con->connect_error) {
          //$isConnectionCreated = false;
          return "false";
          //die("Connection failed: " . $this->$conn->connect_error);
      }
      $id = (string) $id;
      $id = "'".$id."'";
      //echo $id;
      $sql = "SELECT sale_data FROM Sale_Print where sale_no = ".$id;
      echo $sql;
      $result = $con->query($sql);
      //echo "hhhhhh".$result->num_rows."hhhhhhh";
      if ($result->num_rows == 1) {
          $row = $result->fetch_assoc();
          //echo "==23==";
          return $row["sale_data"];
          // if there is multiple string corresponding to one id
          // while($row = $result->fetch_assoc()) {
          //     echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
          // }
      } else if($result->num_rows > 1){
        //echo "$$23$$";
          return 0;
      }else{
        //echo "**23**";
        return -1;
      }
    }
}
//echo $data["sale_id_num"];
//echo "mdfxr";
//echo $data;
//echo "mdfxr";
$databaseOperation = new DatabaseOperation;
$databaseOperation->insertIntoTable('6','six');
$var = $databaseOperation->getStringFromTable('6');
echo $var;

?>