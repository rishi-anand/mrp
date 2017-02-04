<?php

require __DIR__ . '/../escpos_php/autoload.php';
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;

$connector = new FilePrintConnector("/dev/usb/lp0");
$printer = new Printer($connector);

$dataJSON = $_GET["data"];
$data = (array) json_decode($dataJSON);
try {
  exec('sudo chmod -R 777 /var/www/html/*');
  exec('sudo chmod -R 777 /var/www/html/');
  exec('sudo chmod 777 /dev/usb/lp0');
}catch (Exception $e){

}

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
          return "false";
          //die("Connection failed: " . $this->$conn->connect_error);
      }
      $id = (string) $id;
      $id = "'".$id."'";
      //echo $id;
      $sql = "SELECT sale_data FROM Sale_Print where sale_no = ".$id;
      //echo $sql;
      $result = $con->query($sql);
      //echo "hhhhhh".$result->num_rows."hhhhhhh";
      if ($result->num_rows == 1) {
          $row = $result->fetch_assoc();
          //echo "Hmm!  There is only one string for this id";
          return $row["sale_data"];
          // if there is multiple string corresponding to one id
          // while($row = $result->fetch_assoc()) {
          //     echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
          // }
      } else if($result->num_rows > 1){
        //echo "Awww!!  There are more than 1 string for this id";
          return 0;
      }else{
        echo "Ohhh!  No result found";
        return -1;
      }
    }
}
//echo $data["sale_id_num"];
//echo "mdfxr";
//echo $data;
//echo "mdfxr";
$databaseOperation = new DatabaseOperation;
$databaseOperation->insertIntoTable($data["sale_id_num"],$dataJSON);
$var = $databaseOperation->getStringFromTable($data["sale_id_num"]);
echo $var;
//$databaseOperation->insertIntoTable('4','rishi');
//$databaseOperation->insertIntoTable('5','five'); // 0 then it didn't got saved and 1 means it got saved
//$databaseOperation->getStringFromTable('5'); // retuurn string
//$databaseOperation->

//$data ='{"cart":{"1":{"item_id":"1","item_location":"1","stock_name":"stock","line":"1","name":"apple","item_number":"9988878","description":"","serialnumber":"","allow_alt_description":"0","is_serialized":"0","quantity":"1","discount":"0","in_stock":"-6.000","price":"1200.00","total":"1200.00","discounted_total":"1200.0000"}},"subtotal":"1200.0000","discounted_subtotal":"1200.0000","tax_exclusive_subtotal":"1200.0000","taxes":{"5.00% Tax1":"60.0000","8.00% Tax2":"96.0000"},"total":"1356.0000","discount":"0","receipt_title":"Sales Receipt","transaction_time":"10/16/2016 14:04:59","transaction_date":"10/16/2016","show_stock_locations":"","comments":"","payments":{"Cash":{"payment_type":"Cash","payment_amount":"1356"}},"amount_change":"0","amount_due":"0","employee":"Ravi Kumar","company_info":"1164/E New Thipssandra Main Road,\r\nNew Delhi\n918888888888\n","invoice_number":"","sale_id_num":"7","sale_id":"POS 7","barcode":"iVBORw0KGgoAAAANSUhEUgAAAMgAAAAeAQMAAABT8cPvAAAABlBMVEX///8AAABVwtN+AAAACXBIWXMAAA7EAAAOxAGVKw4bAAAAK0lEQVQokWNgsDlg8OfPZ+bP5+0NbD58+PP582f788yf7RgYRmVGZUaUDABaWLLUBjxkHwAAAABJRU5ErkJggg==","cur_giftcard_value":null,"print_after_sale":true,"email_receipt":null,"company":"MRP","receipt_show_taxes":"1","receipt_show_total_discount":"1","receipt_show_date":"1","receipt_show_employee_name":"1","receipt_show_seller_address":"1","receipt_show_seller_phone_number":"1","receipt_show_serialnumber":"1","receipt_set_thank_you_message":"* Thank You.Please Visit Again *"}';

/*
      $data["company"] -- DONE
      $data["receipt_show_taxes"] -- DONE
      $data["receipt_show_date"] -- DONE
      $data["receipt_show_employee_name"] -- DONE
      $data["receipt_show_seller_address"] -- DONE
      $data["receipt_show_seller_phone_number"] -- DONE
      $data["receipt_show_serialnumber"] -- DONE
      $data["receipt_set_thank_you_message"] -- DONE


     $printer -> text("IAMRISHIANANDANDWHOAREYOUTHISISC"."\n");

     $array =  explode("\n", "1164/E New Thipssandra Main Road,\r\nNew Delhi\n918888888888\n");
     echo "phone " . $array[sizeof($array)-2]; //only phone number
     
     for ($x=0; $x < sizeof($array)-2 ;$x++)   // only address
        echo "n".$array[$x];

     for ($x=0; $x < sizeof($array)-1 ;$x++)   // address and phone number
        echo "n".$array[$x];

      $add = preg_replace('/\W/', " ", $address_phone_arr[$x]);
      $add = rtrim($add);

*/


/*
function printC($text,$printer) {
    $length_text = strlen($text);
    
    if( $length_text <= 4 && $length_text >= 3 ){
      $printer -> text("              ".$text."\n");
    }
    if( $length_text <= 7 && $length_text > 4 ){
      $printer -> text("            ".$text."\n");
    }
    if( $length_text <= 10 && $length_text > 7 ){
      $printer -> text("           ".$text."\n");
    }
    if( $length_text <= 12 && $length_text > 10 ){
      $printer -> text("          ".$text."\n");
    }
    if( $length_text <= 14 && $length_text > 12 ){
      $printer -> text("         ".$text."\n");
    }
    if( $length_text <= 16 && $length_text > 14 ){
      $printer -> text("        ".$text."\n");
    }    
    if( $length_text <= 18 && $length_text > 16 ){
      $printer -> text("       ".$text."\n");
    }
    if( $length_text <= 20 && $length_text > 18 ){
      $printer -> text("      ".$text."\n");
    }
    if( $length_text <= 22 && $length_text > 20 ){
      $printer -> text("     ".$text."\n");
    }
    if( $length_text <= 24 && $length_text > 22 ){
      $printer -> text("    ".$text."\n");
    }
    if( $length_text <= 26 && $length_text > 24 ){
      $printer -> text("   ".$text."\n");
    }
    if( $length_text <= 28 && $length_text > 26 ){
      $printer -> text(" ".$text."\n");
    }
    if( $length_text > 28 ){
      $printer -> text($text."\n");
    }

}
*/


function printCenter($text,$printer) {
  $printer -> setJustification(Printer::JUSTIFY_CENTER);
  $printer -> text($text."\n");
  $printer -> setJustification();
}

function printItems($printer) {
  global $data;
  foreach ($data["cart"] as $value) {
      $value = (array) $value;
      if(strlen($value["name"]) > 25){
        $value["name"] = substr($value["name"], 0, 24);
      }

      $value["price"] = number_format($value["price"], 2, '.', '');
      $value["total"] = number_format($value["total"], 2, '.', '');
      $value["quantity"] = number_format($value["quantity"], 0, '.', '');
      $sentence = $value["name"] ."/". $value["price"];
      $length_sentence = strlen($sentence);

      if($length_sentence >= 18){
        $line1 = substr($sentence, 0, floor(strlen($sentence) / 2));
        $line2 = substr($sentence, floor(strlen($sentence) / 2));
        $length_line1 = strlen($line1);

          if( $length_line1 <= 10 && $length_line1 > 7 ){
            $printer -> text($line1."          ".$value["quantity"]."   ".$value["total"]."\n");
            $printer -> text($line2."\n");
          }
          if( $length_line1 <= 12 && $length_line1 > 10 ){
            $printer -> text($line1."        ".$value["quantity"]."   ".$value["total"]."\n");
            $printer -> text($line2."\n");
          }
          if( $length_line1 <= 14 && $length_line1 > 12 ){
            $printer -> text($line1."      ".$value["quantity"]."   ".$value["total"]."\n");
            $printer -> text($line2."\n");
          }
          if( $length_line1 < 16 && $length_line1 > 14 ){
            $printer -> text($line1."    ".$value["quantity"]."   ".$value["total"]."\n");
            $printer -> text($line2."\n");
          }
          if( $length_line1 >= 16 ){ 
            $printer -> text($line1."   ".$value["quantity"]."   ".$value["total"]."\n");
            $printer -> text($line2."\n");
          }
      }else{
          if( $length_sentence <= 7 ){
            $printer -> text($sentence."             ".$value["quantity"]."   ".$value["total"]."\n");
          }
          if( $length_sentence <= 10 && $length_sentence > 7 ){
            $printer -> text($sentence."          ".$value["quantity"]."   ".$value["total"]."\n");
          }
          if( $length_sentence <= 12 && $length_sentence > 10 ){
            $printer -> text($sentence."        ".$value["quantity"]."   ".$value["total"]."\n");
          }
          if( $length_sentence <= 14 && $length_sentence > 12 ){
            $printer -> text($sentence."      ".$value["quantity"]."   ".$value["total"]."\n");
          }
          if( $length_sentence < 16 && $length_sentence > 14 ){
            $printer -> text($sentence."    ".$value["quantity"]."   ".$value["total"]."\n");
          }
          if( $length_sentence >= 16 ){
            $printer -> text($sentence."   ".$value["quantity"]."   ".$value["total"]."\n");
          }
      }
  }
}

function printTaxes($printer) {
  global $data;
  $printer -> setFont(Printer::FONT_C);
  foreach($data["taxes"] as $key => $value) {

    $value = number_format($value, 2, '.', '');
    $length_key = strlen($key);

    if( $length_key > 16 ){
      $key = substr($key, 0, 15);
    }

    if( $length_key == 3 ){
      $printer -> text($key."                    ".$value."\n");
    }
    if( $length_key == 4 ){
      $printer -> text($key."                   ".$value."\n");
    }
    if( $length_key == 5 ){
      $printer -> text($key."                  ".$value."\n");
    }
    if( $length_key == 6 ){
      $printer -> text($key."                 ".$value."\n");
    }
    if( $length_key == 7 ){
      $printer -> text($key."                ".$value."\n");
    }
    if( $length_key == 8 ){
      $printer -> text($key."               ".$value."\n");
    }
    if( $length_key == 9 ){
      $printer -> text($key."              ".$value."\n");
    }
    if( $length_key == 10 ){
      $printer -> text($key."             ".$value."\n");
    }
    if( $length_key == 11 ){
      $printer -> text($key."            ".$value."\n");
    }
    if( $length_key == 12 ){
      $printer -> text($key."           ".$value."\n");
    }
    if( $length_key == 13 ){
      $printer -> text($key."          ".$value."\n");
    }
    if( $length_key == 14 ){
      $printer -> text($key."         ".$value."\n");
    }
    if( $length_key == 15 ){
      $printer -> text($key."        ".$value."\n");
    }
    if( $length_key == 16 ){
      $printer -> text($key."       ".$value."\n");
    }
  }

  $printer -> setFont();
}

function getDateToday() {
  $date = date_default_timezone_set('Asia/Kolkata');
  $date_today = date("d/m/Y H:i", time());
  return $date_today;
}




























































//if( false ){
if( $data["print_after_sale"] == true){

    $printer -> selectPrintMode(Printer::MODE_DOUBLE_HEIGHT);
    
    // ******** printing COMPANY NAME ********
    $length_company = strlen($data["company"]);
    $company_name = $data["company"];
    if( $length_company < 3 ){
      $data["company"] = "MRP Solutions";
    }

    if( $length_company > 28 ){
      $data["company"] = substr($data["company"], 0, 27);
    }

    printCenter($data["company"],$printer);

    $printer -> selectPrintMode(Printer::MODE_FONT_A);
    if( $data["receipt_show_seller_address"] || $data["receipt_show_seller_phone_number"] ){
     $address_phone_arr =  explode("\n", $data["company_info"]);

      // ******** printing COMPANY ADDRESS ONLY ********
      if( $data["receipt_show_seller_address"] && !$data["receipt_show_seller_phone_number"] ){
         for ($x=0; $x < sizeof($address_phone_arr)-2 ;$x++){

            $add = preg_replace('/\W/', " ", $address_phone_arr[$x]);
            $add = rtrim($add);
            printCenter($add,$printer);
          }
      }

      // ******** printing COMPANY PHONE NUMBER ONLY ********
      if( !$data["receipt_show_seller_address"] && $data["receipt_show_seller_phone_number"] ){
            printCenter($address_phone_arr[sizeof($address_phone_arr)-2],$printer);
      }

      // ******** printing COMPANY ADDRESS AND PHONE NUMBER ONLY ********
      if( $data["receipt_show_seller_address"] && $data["receipt_show_seller_phone_number"] ){
         for ($x=0; $x < sizeof($address_phone_arr)-1 ;$x++){

            $add = preg_replace('/\W/', " ", $address_phone_arr[$x]);
            $add = rtrim($add);
            printCenter($add,$printer);
          }
      }

    }

    if ( $data["receipt_show_date"] || $data["receipt_show_serialnumber"] || $data["receipt_show_employee_name"] ){
      $printer -> text("--------------------------------"."\n");
      $printEmployee = 1;

      // ******** printing DATE ONLY ********
      if ( $data["receipt_show_date"] && !$data["receipt_show_serialnumber"] ){
        printCenter("Date : ".getDateToday(),$printer);
      }

      // ******** printing RECEIPT SERIAL NUMBER ONLY ********
      if ( !$data["receipt_show_date"] && $data["receipt_show_serialnumber"] && !$data["receipt_show_employee_name"] ){
        printCenter("Serial No : ".$data["sale_id_num"],$printer);
      }
      
      // ******** printing EMPLOYEE/STAFF AND RECEIPT SERIAL NUMBER ONLY ********
      if ( !$data["receipt_show_date"] && $data["receipt_show_serialnumber"] && $data["receipt_show_employee_name"] ){
        printCenter("Staff:".$data["employee"]."    "."Sr No:".$data["sale_id_num"],$printer);
        $printEmployee = 0;
      }

      // ******** printing DATE AND RECEIPT SERIAL NUMBER ********
      if ( $data["receipt_show_date"] && $data["receipt_show_serialnumber"] ){
        printCenter(getDateToday()."    Sr No: ".$data["sale_id_num"],$printer);
      }

      // ******** printing EMPLOYEE/STAFF NAME ********
      if( $data["receipt_show_employee_name"] && $printEmployee ){
        printCenter("Staff : ".$data["employee"],$printer);
      }
    }


    $printer -> text("--------------------------------"."\n");
    $printer -> text("NAME/             QTY    PRICE"."\n");
    $printer -> text("PRICE-UNIT"."\n");
    $printer -> text("--------------------------------"."\n");
    $printer -> selectPrintMode(Printer::MODE_FONT_A);

    // ******** printing ITEMS/PRICE-UNIT, QUANTITY AND PRICE ********
    printItems($printer);

    // ******** printing TAXES ********
    if( $data["receipt_show_taxes"] && count($data["taxes"]) ){
      printTaxes($printer);
    }

    // ******** printing TOTAL ********
    $data["total"] = number_format($data["total"], 2, '.', '');
    $printer -> text("--------------------------------"."\n");
    $printer -> text("         TOTAL        : ".$data["total"]."\n");
    $printer -> text("--------------------------------"."\n");

    if(strlen($data["receipt_set_thank_you_message"]) > 2){
      $printer -> feed(1);
      if( strlen($data["receipt_set_thank_you_message"]) > 55 ){
        $data["receipt_set_thank_you_message"] = substr($data["receipt_set_thank_you_message"], 0, 53);
      }

      // ******** printing THANK YOU MESSAGE ********
      printCenter($data["receipt_set_thank_you_message"],$printer);
    }
    $printer -> feed(2);

    $printer -> cut();
    $printer -> close();
}



?>