<?php
require __DIR__ . '/../../third_party/escpos/autoload.php';
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;
$connector = new FilePrintConnector("/dev/usb/lp0");
$printer = new Printer($connector);
$printer -> text("Hello World!\n");
$printer -> cut();
$printer -> close();

?>