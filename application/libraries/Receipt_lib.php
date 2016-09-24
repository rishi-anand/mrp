<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require __DIR__ . '/../third_party/escpos/autoload.php';
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;
 
class Receipt_lib
{
	private $CI;

  	public function __construct()
	{
		$this->CI =& get_instance();
	}
	
	public function printReceipt($message)
	{
		
		$response = FALSE;
		$message = urlencode($message);

		$connector = new FilePrintConnector("/dev/usb/lp0");
		$printer = new Printer($connector);
		$printer -> text($message);
		$printer -> cut();
		$printer -> close();
		$response = TRUE;
	}
}

?>
