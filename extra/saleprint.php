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
$data ='{"cart":{"1":{"item_id":"2","item_location":"1","stock_name":"stock","line":"1","name":"Apple Earphone","item_number":"345677","description":"Best earphone ever","serialnumber":"","allow_alt_description":"1","is_serialized":"0","quantity":"3","discount":"0","in_stock":"99.000","price":"200","total":"600","discounted_total":"600.0000"},"2":{"item_id":"1","item_location":"1","stock_name":"stock","line":"2","name":"Apple iMac","item_number":"33333333","description":"Best Computer ever","serialnumber":"","allow_alt_description":"1","is_serialized":"0","quantity":"2","discount":"0","in_stock":"97.000","price":"1200","total":"2400","discounted_total":"2400.0000"},"3":{"item_id":"3","item_location":"1","stock_name":"stock","line":"3","name":"classic mild","item_number":"99998777","description":"","serialnumber":"","allow_alt_description":"0","is_serialized":"0","quantity":"1","discount":"0","in_stock":"0.000","price":"13.00","total":"13.00","discounted_total":"13.0000"}},"subtotal":"3013.0000","discounted_subtotal":"3013.0000","tax_exclusive_subtotal":"3013.0000","taxes":{"8.00% Tax 1":"240.0000","10.00% Tax 2":"300.0000"},"total":"3553.0000","discount":"0","receipt_title":"Sales Receipt","transaction_time":"09/25/2016 17:51:06","transaction_date":"09/25/2016","show_stock_locations":"","comments":"","payments":{"Cash":{"payment_type":"Cash","payment_amount":"3553"}},"amount_change":"0","amount_due":"0","employee":"Ravi Kumar","company_info":"MRP\n918888888888\n","customer":"","first_name":"Bob","last_name":"Smith","customer_email":"bsmith@nowhere.com","customer_address":"123 Nowhere Street","customer_location":"11111 Awesome","customer_account_number":"","customer_discount_percent":"5.00","customer_info":"\n123 Nowhere Street\n11111 Awesome\n","invoice_number":"1","sale_id_num":"2","sale_id":"POS 2","barcode":"iVBORw0KGgoAAAANSUhEUgAAAMgAAAAeAQMAAABT8cPvAAAABlBMVEX///8AAABVwtN AAAACXBIWXMAAA7EAAAOxAGVKw4bAAAAK0lEQVQokWNgsDlg8OfPZ bP5 0NbD58 PDH LABP/NnOwaGUZlRmRElAwBR3X4YATNysAAAAABJRU5ErkJggg==","cur_giftcard_value":null,"print_after_sale":true,"email_receipt":"1"}';

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