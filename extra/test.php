<?php


//$data = $_GET["data"];

$data ='{"cart":{"1":{"item_id":"1","item_location":"1","stock_name":"stock","line":"1","name":"apple","item_number":"9988878","description":"","serialnumber":"","allow_alt_description":"0","is_serialized":"0","quantity":"1","discount":"0","in_stock":"-4.000","price":"1200.00","total":"1200.00","discounted_total":"1200.0000"},"2":{"item_id":"2","item_location":"1","stock_name":"stock","line":"2","name":"apple earphone","item_number":"887655","description":"","serialnumber":"","allow_alt_description":"0","is_serialized":"0","quantity":"1","discount":"0","in_stock":"-2.000","price":"1300.00","total":"1300.00","discounted_total":"1300.0000"}},"subtotal":"2500.0000","discounted_subtotal":"2500.0000","tax_exclusive_subtotal":"2500.0000","taxes":{"5.00% Tax1":"60.0000","8.00% Tax2":"96.0000"},"total":"2656.0000","discount":"0","receipt_title":"Sales Receipt","transaction_time":"10/15/2016 14:46:11","transaction_date":"10/15/2016","show_stock_locations":"","comments":"","payments":{"Cash":{"payment_type":"Cash","payment_amount":"2656"}},"amount_change":"0","amount_due":"0","employee":"Ravi Kumar","company_info":"1164/E New Thipssandra Main Road,\r\nNew Delhi\n918888888888\n","invoice_number":"","sale_id_num":"5","sale_id":"POS 5","barcode":"iVBORw0KGgoAAAANSUhEUgAAAMgAAAAeAQMAAABT8cPvAAAABlBMVEX///8AAABVwtN+AAAACXBIWXMAAA7EAAAOxAGVKw4bAAAAK0lEQVQokWNgsDlg8OfPZ+bP5+0NbD58+Pzh8J/P55k/2zEwjMqMyowoGQDqDMHyOVScSQAAAABJRU5ErkJggg==","cur_giftcard_value":null,"print_after_sale":true,"email_receipt":null,"company":null,"receipt_show_taxes":"0","receipt_show_total_discount":"1","receipt_show_date":"0","receipt_show_employee_name":"0","receipt_show_seller_address":"0","receipt_show_seller_phone_number":"0","receipt_show_serialnumber":"1","receipt_set_thank_you_message":"* Thank You.Please Visit Again *"}';

/*
      $data["company"]
      $data["receipt_show_taxes"]
      $data["receipt_show_total_discount"]
      $data["receipt_show_date"]
      $data["receipt_show_employee_name"]
      $data["receipt_show_seller_address"]
      $data["receipt_show_seller_phone_number"]
      $data["receipt_show_serialnumber"]
      $data["receipt_set_thank_you_message"]


function printCenter($text) {
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
    if( $length_text > 26 ){
      $printer -> text("  ".$text."\n");
    }

}

function printItems() {
  foreach ($data["cart"] as $value) {
      $value = (array) $value;
      echo $value["name"] ." / ". $value["price"] . $value["total"];
      while(strlen($value["name"]) > 25){
        $value["name"] = substr($value["name"], 0, 24);
      }

      $value["price"] = number_format($value["price"], 2, '.', '');
      $value["total"] = number_format($value["total"], 2, '.', '');
      $sentence = $value["name"] ."/". $value["price"];
      $length_sentence = strlen($sentence);

      if($length_sentence >= 18){
        $line1 = substr($sentence, 0, floor(strlen($sentence) / 2));
        $line2 = substr($sentence, floor(strlen($sentence) / 2));
        $length_line1 = strlen($line1);

          if( $length_line1 <= 10 && $length_line1 > 7 ){
            $printer -> text($line1."          ".$value["quantity"]."    ".$value["total"]."\n");
            $printer -> text($line2."\n");
          }
          if( $length_line1 <= 12 && $length_line1 > 10 ){
            $printer -> text($line1."        ".$value["quantity"]."    ".$value["total"]."\n");
            $printer -> text($line2."\n");
          }
          if( $length_line1 <= 14 && $length_line1 > 12 ){
            $printer -> text($line1."      ".$value["quantity"]."    ".$value["total"]."\n");
            $printer -> text($line2."\n");
          }
          if( $length_line1 < 16 && $length_line1 > 14 ){
            $printer -> text($line1."    ".$value["quantity"]."    ".$value["total"]."\n");
            $printer -> text($line2."\n");
          }
          if( $length_line1 >= 16 ){ 
            $printer -> text($line1."   ".$value["quantity"]."    ".$value["total"]."\n");
            $printer -> text($line2."\n");
          }
      }else{
          if( $length_sentence <= 7 ){
            $printer -> text($sentence."             ".$value["quantity"]."    ".$value["total"]."\n");
          }
          if( $length_sentence <= 10 && $length_sentence > 7 ){
            $printer -> text($sentence."          ".$value["quantity"]."    ".$value["total"]."\n");
          }
          if( $length_sentence <= 12 && $length_sentence > 10 ){
            $printer -> text($sentence."        ".$value["quantity"]."    ".$value["total"]."\n");
          }
          if( $length_sentence <= 14 && $length_sentence > 12 ){
            $printer -> text($sentence."      ".$value["quantity"]."    ".$value["total"]."\n");
          }
          if( $length_sentence < 16 && $length_sentence > 14 ){
            $printer -> text($sentence."    ".$value["quantity"]."    ".$value["total"]."\n");
          }
          if( $length_sentence >= 16 ){
            $printer -> text($sentence."   ".$value["quantity"]."    ".$value["total"]."\n");
          }
      }
  }
}

function getDateToday() {
  $date = date_default_timezone_set('Asia/Kolkata');
  $date_today = date("d/m/Y H:i", time());
  return $date_today;
}
*/
$data = (array) json_decode($data);
//if( false ){
/*
if( $data["print_after_sale"] ){

    $printer -> selectPrintMode(Printer::MODE_DOUBLE_HEIGHT);

    //$data["company_info"] = explode("\n", $data["company_info"], 2)[0];
    $length_company = strlen($data["company"]);
    $company_name = $data["company"];
    if( $length_company < 3 && $length_company > 28 ){
      $data["company_info"] = "MRP Solutions";
    }

    printCenter($data["company"]);
    $printer -> feed(1);
    $printer -> selectPrintMode(Printer::MODE_FONT_A);

    if ( $data["receipt_show_date"] || $data["receipt_show_serialnumber"] || $data["receipt_show_employee_name"] ){
      $printer -> text("--------------------------------"."\n");
      if ( $data["receipt_show_date"] && !$data["receipt_show_serialnumber"] ){
        printCenter("Date : ".getDateToday());
      }

      if ( !$data["receipt_show_date"] && $data["receipt_show_serialnumber"] ){
        printCenter("Serial No : ".$data["sale_id_num"]);
      }

      if ( $data["receipt_show_date"] && $data["receipt_show_serialnumber"] ){
        printCenter(getDateToday()."  Sr No: ".$data["sale_id_num"]);
      }

      if( $data["receipt_show_employee_name"] ){
        printCenter("Staff : ".$data["employee"]);
      }
    }

    //$printer -> text("IAMRISHIANANDANDWHOAREYOUTHISISC"."\n");
    $printer -> text("--------------------------------"."\n");
    $printer -> text("NAME/             QTY    PRICE"."\n");
    $printer -> text("PRICE-UNIT"."\n");
    $printer -> text("--------------------------------"."\n");
    $printer -> selectPrintMode(Printer::MODE_FONT_A);

    printItems();

    $data["total"] = number_format($data["total"], 2, '.', '');
    $printer -> text("--------------------------------"."\n");
    $printer -> text("         TOTAL        : ".$data["total"]."\n");
    $printer -> text("--------------------------------"."\n");
    if(strlen($data["receipt_set_thank_you_message"]) > 2){
      $printer -> feed(1);
      printCenter($data["receipt_set_thank_you_message"]);
    }

   
    
    echo count($data["taxes"]);

    
    foreach($data["taxes"] as $key => $value) {
    echo("Key : ".$key." , Value : ");
    echo($value." ; ");
    }
 */
    if(!0){
      echo "india";
    }
    /*
    $printer -> feed(2);

    $printer -> cut();
    $printer -> close();

}

    */



?>