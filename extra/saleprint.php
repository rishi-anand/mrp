<?php


require __DIR__ . '/../escpos_php/autoload.php';
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;

$connector = new FilePrintConnector("/dev/usb/lp0");
$printer = new Printer($connector);

$data = $_GET["data"];

$data ='{"cart":{"1":{"item_id":"2","item_location":"1","stock_name":"stock","line":"1","name":"Apple Earphone and playbookis","item_number":"345677","description":"Best earphone ever","serialnumber":"","allow_alt_description":"1","is_serialized":"0","quantity":"3","discount":"0","in_stock":"99.000","price":"200.50","total":"600","discounted_total":"600.5000"},"2":{"item_id":"1","item_location":"1","stock_name":"stock","line":"2","name":"Apple iMac","item_number":"33333333","description":"Best Computer ever","serialnumber":"","allow_alt_description":"1","is_serialized":"0","quantity":"2","discount":"0","in_stock":"97.000","price":"1200","total":"2400","discounted_total":"2400.0000"},"3":{"item_id":"3","item_location":"1","stock_name":"stock","line":"3","name":"classic mild","item_number":"99998777","description":"","serialnumber":"","allow_alt_description":"0","is_serialized":"0","quantity":"1","discount":"0","in_stock":"0.000","price":"13.00","total":"13.00","discounted_total":"13.0000"}},"subtotal":"3013.0000","discounted_subtotal":"3013.0000","tax_exclusive_subtotal":"3013.0000","taxes":{"8.00% Tax 1":"240.0000","10.00% Tax 2":"300.0000"},"total":"3553.0000","discount":"0","receipt_title":"Sales Receipt","transaction_time":"09/25/2016 17:51:06","transaction_date":"09/25/2016","show_stock_locations":"","comments":"","payments":{"Cash":{"payment_type":"Cash","payment_amount":"3553"}},"amount_change":"0","amount_due":"0","employee":"Ravi Kumar","company_info":"MRP\n918888888888\n","customer":"","first_name":"Bob","last_name":"Smith","customer_email":"bsmith@nowhere.com","customer_address":"MRP Solutions","customer_location":"11111 Awesome","customer_account_number":"","customer_discount_percent":"5.00","customer_info":"\n123 Nowhere Street\n11111 Awesome\n","invoice_number":"1","sale_id_num":"2","sale_id":"POS 2","barcode":"iVBORw0KGgoAAAANSUhEUgAAAMgAAAAeAQMAAABT8cPvAAAABlBMVEX///8AAABVwtN AAAACXBIWXMAAA7EAAAOxAGVKw4bAAAAK0lEQVQokWNgsDlg8OfPZ bP5 0NbD58 PDH LABP/NnOwaGUZlRmRElAwBR3X4YATNysAAAAABJRU5ErkJggg==","cur_giftcard_value":null,"print_after_sale":true,"email_receipt":"1"}';

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

*/
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
      if(strlen($value["name"]) > 25){
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

function printTaxes() {

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
}

function getDateToday() {
  $date = date_default_timezone_set('Asia/Kolkata');
  $date_today = date("d/m/Y H:i", time());
  return $date_today;
}

$data = (array) json_decode($data);
//if( false ){
if( $data["print_after_sale"] ){

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

    printCenter($data["company"]);

    if( $data["receipt_show_seller_address"] || $data["receipt_show_seller_phone_number"] ){
     $address_phone_arr =  explode("\n", $data["company_info"]);

      // ******** printing COMPANY ADDRESS ONLY ********
      if( $data["receipt_show_seller_address"] && !$data["receipt_show_seller_phone_number"] ){
         for ($x=0; $x < sizeof($address_phone_arr)-2 ;$x++){
            printCenter($address_phone_arr[$x]);
          }
      }

      // ******** printing COMPANY PHONE NUMBER ONLY ********
      if( !$data["receipt_show_seller_address"] && $data["receipt_show_seller_phone_number"] ){
            printCenter($address_phone_arr[sizeof($address_phone_arr)-2]);
      }

      // ******** printing COMPANY ADDRESS AND PHONE NUMBER ONLY ********
      if( $data["receipt_show_seller_address"] && $data["receipt_show_seller_phone_number"] ){
         for ($x=0; $x < sizeof($address_phone_arr)-1 ;$x++){
            printCenter($address_phone_arr[$x]);
          }
      }

    }
    $printer -> feed(1);
    $printer -> selectPrintMode(Printer::MODE_FONT_A);

    if ( $data["receipt_show_date"] || $data["receipt_show_serialnumber"] || $data["receipt_show_employee_name"] ){
      $printer -> text("--------------------------------"."\n");

      // ******** printing DATE ONLY ********
      if ( $data["receipt_show_date"] && !$data["receipt_show_serialnumber"] ){
        printCenter("Date : ".getDateToday());
      }

      // ******** printing RECEIPT SERIAL NUMBER ONLY ********
      if ( !$data["receipt_show_date"] && $data["receipt_show_serialnumber"] ){
        printCenter("Serial No : ".$data["sale_id_num"]);
      }

      // ******** printing DATE AND RECEIPT SERIAL NUMBER ********
      if ( $data["receipt_show_date"] && $data["receipt_show_serialnumber"] ){
        printCenter(getDateToday()."  Sr No: ".$data["sale_id_num"]);
      }

      // ******** printing EMPLOYEE/STAFF NAME ********
      if( $data["receipt_show_employee_name"] ){
        printCenter("Staff : ".$data["employee"]);
      }
    }


    $printer -> text("--------------------------------"."\n");
    $printer -> text("NAME/             QTY    PRICE"."\n");
    $printer -> text("PRICE-UNIT"."\n");
    $printer -> text("--------------------------------"."\n");
    $printer -> selectPrintMode(Printer::MODE_FONT_A);

    // ******** printing ITEMS/PRICE-UNIT, QUANTITY AND PRICE ********
    printItems();

    // ******** printing TAXES ********
    if( $data["receipt_show_taxes"] && count($data["taxes"]) ){
      printTaxes();
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
      printCenter($data["receipt_set_thank_you_message"]);
    }
    foreach($data["taxes"] as $key => $value) {
    echo($key);
    echo($value);
    }
    $printer -> feed(2);

    $printer -> cut();
    $printer -> close();
}



?>