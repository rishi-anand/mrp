<?php

/*
require __DIR__ . '/../autoload.php';
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;


$connector = new FilePrintConnector("/dev/usb/lp0");
$printer = new Printer($connector);

$data = $_GET["data"];

*/
//echo $data;
$data ='{"cart":{"1":{"item_id":"1","item_location":"1","stock_name":"stock","line":"1","name":"apple","item_number":"999999","description":"","serialnumber":"","allow_alt_description":"0","is_serialized":"0","quantity":"1","discount":"0","in_stock":"-13.000","price":"1200.00","total":"1200.00","discounted_total":"1200.0000"},"2":{"item_id":"2","item_location":"1","stock_name":"stock","line":"1","name":"apple_mac","item_number":"9945","description":"","serialnumber":"","allow_alt_description":"0","is_serialized":"0","quantity":"1","discount":"0","in_stock":"-13.000","price":"2200.00","total":"3200.00","discounted_total":"3200.0000"}},"subtotal":"1200.0000","discounted_subtotal":"1200.0000","tax_exclusive_subtotal":"1200.0000","taxes":[],"total":"1200.0000","discount":"0","receipt_title":"Sales Receipt","transaction_time":"09/24/2016 15:02:37","transaction_date":"09/24/2016","show_stock_locations":"","comments":"","payments":{"Cash":{"payment_type":"Cash","payment_amount":"1200"}},"amount_change":"0","amount_due":"0","employee":"Ravi Kumar","company_info":"New Delhi\n918888888888\n","customer":"Jon Bob","first_name":"Jon","last_name":"Bob","customer_email":"rishi.anand0@gmail.com","customer_address":"","customer_location":"","customer_account_number":"","customer_discount_percent":"0.00","customer_info":"Jon Bob\n\n\n","invoice_number":"6","sale_id_num":"14","sale_id":"POS 14","barcode":"iVBORw0KGgoAAAANSUhEUgAAAMgAAAAeAQMAAABT8cPvAAAABlBMVEX///8AAABVwtN AAAACXBIWXMAAA7EAAAOxAGVKw4bAAAAIklEQVQokWNgAIMMv7ey293OzLlpfTJ5HQMyGJUZlRkhMgAdF9Q7EyLH8gAAAABJRU5ErkJggg==","cur_giftcard_value":null,"print_after_sale":true,"email_receipt":"1"}';

// check if print_after_sale is true then only print thermal print
//echo $data;
$sale = json_decode($data, true);

//foreach($sale as $key => $value) {
//    echo 'key = '.($key).', value = '.($value).' ; ';
//}
//echo $sale['sale_id_num'].PHP_EOL;

//echo json_encode($sale['cart']);

/*
$printer -> text("Hello World!\n");
$printer -> cut();
$printer -> close();




function traverse($array) {
   foreach ($array as $key => $value) {
      if (is_array($value)) {
         traverse($array);
         continue;
      }
      echo 'key = '.($key).', value = '.($value).' ; ';
   }
}

traverse($sale);
*/
foreach($sale as $key=>$value){
    if( is_array($value) ) {
        foreach($value as $key2=>$value2) {
            if( is_array($value2) ) {
                foreach($value2 as $key3=>$value3) {
                    echo 'key = '.($key3).', value = '.($value3).' ; ';
                }
            }else {
                echo 'key = '.($key2).', value = '.($value2).' ; ';
            }
        }
    } else {
    echo 'key = '.($key).', value = '.($value).' ; ';
    }
}

?>