<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Sms_lib
{
	private $CI;

  	public function __construct()
	{
		$this->CI =& get_instance();
	}
	
	/*
	 * SMS sending function
	 * Example of use: $response = sendSMS('4477777777', 'My test message');
	 */
	public function sendSMS($numbers, $message)
	{
		$username   = $this->CI->config->item('msg_uid');
		$hash   = $this->CI->config->item('msg_pwd');
		$sender = $this->CI->config->item('msg_src');
		
		$response = FALSE;
		
		if(!preg_match('/^[0-9,]*$/', $numbers)){
 			$response = "ERROR : Phone number is invalid.";
 			return $response;
		}
		// if any of the parameters is empty return with a FALSE
		if(empty($username) || empty($hash) || empty($numbers) || empty($message) || empty($sender))
		{
			if(empty($username)){
				$response = "ERROR : Username is empty. (Please config message settings in Store Config -> Message)";
			}

			if(empty($hash)){
				$response = "ERROR : Password is empty. (Please config message settings in Store Config -> Message)";
			}

			if(empty($numbers)){
				$response = "ERROR : Phone Number field is empty.";
			}

			if(empty($message)){
				$response = "ERROR : Message field is empty.";
			}

			if(empty($sender)){
				$response = "ERROR : Sender field is empty. (Please config message settings in Store Config -> Message)";
			}
		}
		else
		{	$response = TRUE;
			//http://103.247.98.91/API/SendMsg.aspx?uname=20160715&pass=srilalitha&send=LALITA&dest=9066552096&msg=hellorishifromprp&priority=1&schtm=2017-02-04 17:49


			//$response = TRUE;
			// make sure passed string is url encoded
			//-----$message = rawurlencode($message);
			
			// add call to send a message via 3rd party API here
			// Some examples

			/*
			$url = "http://xxx.xxx.xxx.xxx/send_sms?username=$username&password=$hash&src=$sender&dst=$numbers&msg=$message&dr=1";
			 
			$c = curl_init(); 
			curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($c, CURLOPT_URL, $url); 
			$response = curl_exec($c); 
			curl_close($c);
			*/
			
			// This is a textmarketer.co.uk API call, see: http://wiki.textmarketer.co.uk/display/DevDoc/Text+Marketer+Developer+Documentation+-+Wiki+Home
			/*
			$url = 'https://api.textmarketer.co.uk/gateway/'."?username=$username&password=$hash&option=xml";
			$url .= "&to=$numbers&message=".urlencode($message).'&orig='.urlencode($sender);
			$fp = fopen($url, 'r');
			$response = fread($fp, 1024);
			*/
				// Authorisation details.
			

			//textlocal
			$success_status = "success";
			$failure_status = "failure";
			$debug_level_test = FALSE; // make it to 'TRUE' for enable debug
			// when $debug_level_test is set to TRUE then you can see the json response in
			// browser developer tools
			
			//$username = "<username>";
			//$hash = "<hash_key>";

			// Config variables. Consult http://api.textlocal.in/docs for more info.
			// $test = "1"; //testing (no sms is sent to user)
			// $test = "0"; //production (sms is sent to user)
			$test = "0";

			// Data for text message. This is the text message data.
			//$sender = "TXTLCL"; // This is who the message appears to be from.
			//$numbers = "918888888888"; // A single number or a comma-seperated list of numbers
			//$message = "This is a test message from the PHP API script. -Rishi Anand";
			// 612 chars or less
			// A single number or a comma-seperated list of numbers
			$message = urlencode($message);

			$data_textlocal = "unicode=1&username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
			$data_prpSms = "unicode=1&uname=".$username."&pass=".$hash."&send=".$sender."&dest=".$numbers."&msg=".$message."&priority=1";
			$ch = curl_init('http://103.247.98.91/API/SendMsg.aspx?');
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_prpSms);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($ch); // This is the result from the API
			curl_close($ch);
			return $response;
		}

		// echo $response;
		return $response;
	}
}

?>
