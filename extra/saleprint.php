<?php


require __DIR__ . '/../escpos_php/autoload.php';
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;

$connector = new FilePrintConnector("/dev/usb/lp0");
$printer = new Printer($connector);

$data = $_GET["data"];

//$data ='{"cart":{"1":{"item_id":"2","item_location":"1","stock_name":"stock","line":"1","name":"Apple Earphone and playbookis","item_number":"345677","description":"Best earphone ever","serialnumber":"","allow_alt_description":"1","is_serialized":"0","quantity":"3","discount":"0","in_stock":"99.000","price":"200.50","total":"600","discounted_total":"600.5000"},"2":{"item_id":"1","item_location":"1","stock_name":"stock","line":"2","name":"Apple iMac","item_number":"33333333","description":"Best Computer ever","serialnumber":"","allow_alt_description":"1","is_serialized":"0","quantity":"2","discount":"0","in_stock":"97.000","price":"1200","total":"2400","discounted_total":"2400.0000"},"3":{"item_id":"3","item_location":"1","stock_name":"stock","line":"3","name":"classic mild","item_number":"99998777","description":"","serialnumber":"","allow_alt_description":"0","is_serialized":"0","quantity":"1","discount":"0","in_stock":"0.000","price":"13.00","total":"13.00","discounted_total":"13.0000"}},"subtotal":"3013.0000","discounted_subtotal":"3013.0000","tax_exclusive_subtotal":"3013.0000","taxes":{"8.00% Tax 1":"240.0000","10.00% Tax 2":"300.0000"},"total":"3553.0000","discount":"0","receipt_title":"Sales Receipt","transaction_time":"09/25/2016 17:51:06","transaction_date":"09/25/2016","show_stock_locations":"","comments":"","payments":{"Cash":{"payment_type":"Cash","payment_amount":"3553"}},"amount_change":"0","amount_due":"0","employee":"Ravi Kumar","company_info":"MRP\n918888888888\n","customer":"","first_name":"Bob","last_name":"Smith","customer_email":"bsmith@nowhere.com","customer_address":"MRP Solutions","customer_location":"11111 Awesome","customer_account_number":"","customer_discount_percent":"5.00","customer_info":"\n123 Nowhere Street\n11111 Awesome\n","invoice_number":"1","sale_id_num":"2","sale_id":"POS 2","barcode":"iVBORw0KGgoAAAANSUhEUgAAAMgAAAAeAQMAAABT8cPvAAAABlBMVEX///8AAABVwtN AAAACXBIWXMAAA7EAAAOxAGVKw4bAAAAK0lEQVQokWNgsDlg8OfPZ bP5 0NbD58 PDH LABP/NnOwaGUZlRmRElAwBR3X4YATNysAAAAABJRU5ErkJggg==","cur_giftcard_value":null,"print_after_sale":true,"email_receipt":"1"}';


$data = (array) json_decode($data);
if($data["print_after_sale"] == true){
    $printer -> selectPrintMode(Printer::MODE_DOUBLE_HEIGHT);
    $printer -> text($data["customer_address"]."\n");
    //$printer -> text("IAMRISHIANANDANDWHOAREYOUTHISISC"."\n");
    $printer -> feed(1);
    $printer -> selectPrintMode(Printer::MODE_FONT_A);
    $printer -> text("--------------------------------"."\n");
    $printer -> text("NAME/             QTY     PRICE"."\n");
    $printer -> text("PRICE-UNIT"."\n");
    $printer -> text("--------------------------------"."\n");
    $printer -> selectPrintMode(Printer::MODE_FONT_A);

    foreach ($data["cart"] as $value) {
        $value = (array) $value;
        echo $value["name"] ." / ". $value["price"] . $value["total"];
        while(strlen($value["name"]) > 25){
          $value["name"] = substr($value["name"], 0, 24);
        }
        $value["price"] = floor($value["price"] * 10) / 10;
        $value["total"] = floor($value["total"] * 10) / 10;
        $sentence = $value["name"] ."/". $value["price"];
        $length_sentence = strlen($sentence);

        if($length_sentence >= 18){
          $line1 = substr($sentence, 0, floor(strlen($sentence) / 2));
          $line2 = substr($sentence, floor(strlen($sentence) / 2));
          $length_line1 = strlen($line1);

            if( $length_line1 <= 10 && $length_line1 > 7 ){
              $printer -> text($line1."          ".$value["quantity"]."     ".$value["total"]."\n");
              $printer -> text($line2."\n");
            }
            if( $length_line1 <= 12 && $length_line1 > 10 ){
              $printer -> text($line1."        ".$value["quantity"]."     ".$value["total"]."\n");
              $printer -> text($line2."\n");
            }
            if( $length_line1 <= 14 && $length_line1 > 12 ){
              $printer -> text($line1."      ".$value["quantity"]."     ".$value["total"]."\n");
              $printer -> text($line2."\n");
            }
            if( $length_line1 < 16 && $length_line1 > 14 ){
              $printer -> text($line1."    ".$value["quantity"]."     ".$value["total"]."\n");
              $printer -> text($line2."\n");
            }
            if( $length_line1 >= 16 ){ 
              $printer -> text($line1."   ".$value["quantity"]."     ".$value["total"]."\n");
              $printer -> text($line2."\n");
            }
        }else{
            if( $length_sentence <= 7 ){
              $printer -> text($sentence."             ".$value["quantity"]."     ".$value["total"]."\n");
            }
            if( $length_sentence <= 10 && $length_sentence > 7 ){
              $printer -> text($sentence."          ".$value["quantity"]."     ".$value["total"]."\n");
            }
            if( $length_sentence <= 12 && $length_sentence > 10 ){
              $printer -> text($sentence."        ".$value["quantity"]."     ".$value["total"]."\n");
            }
            if( $length_sentence <= 14 && $length_sentence > 12 ){
              $printer -> text($sentence."      ".$value["quantity"]."     ".$value["total"]."\n");
            }
            if( $length_sentence < 16 && $length_sentence > 14 ){
              $printer -> text($sentence."    ".$value["quantity"]."     ".$value["total"]."\n");
            }
            if( $length_sentence >= 16 ){
              $printer -> text($sentence."   ".$value["quantity"]."     ".$value["total"]."\n");
            }
        }
    }
    $printer -> text("--------------------------------"."\n");
    $printer -> text("          TOTAL          : ".$data["total"]."\n");
    $printer -> text("--------------------------------"."\n");
    $printer -> feed(1);
    $printer -> text("* Thank You.Please Visit Again *"."\n");
    $printer -> feed(2);

    $printer -> cut();
    $printer -> close();
}



?>