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
		
		// if any of the parameters is empty return with a FALSE
		if(empty($username) || empty($hash) || empty($numbers) || empty($message) || empty($sender))
		{
			//echo $username . ' ' . $hash . ' ' . $numbers . ' ' . $message . ' ' . $sender;
		}
		else
		{	
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
			$debug_level_test = TRUE; // make it to 'TRUE' for enable debug
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
			$data = "unicode=1&username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
			$ch = curl_init('http://api.textlocal.in/send/?');
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result_json = curl_exec($ch); // This is the result from the API
			curl_close($ch);
			$result = json_decode($result_json);
			$message_sent_status = $result->{'status'};
			if (strcmp($message_sent_status, $success_status) == 0) {
				$response = TRUE;
			}

			// below code will only be executed when $debug_level_test is set to TRUE
			if($debug_level_test) {
			echo $message_sent_status;
			echo $result_json;
			}
		}

		return $response;
	}
}

?>
