<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mail;
use Zend\Mail\Transport\Smtp;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Validator\NotEmpty;
use Zend\Json\Json;
use Zend\Mime\Mime;
use Zend\Validator\Digits;
use Zend\Filter\StripTags;
use Zend\Filter\StringTrim;
use Zend\Filter\HtmlEntities;

class CommonController extends AbstractActionController {
	
	/**
	 * The default action - show the home page
	 */
	public function indexAction() {
		return new ViewModel ();
	}
	
	/**
	 * Create random key
	 *
	 * @return string
	 */
	public static function createRandomKey() {
		$chars = "abcdefgh2w2222ijkmnopqr2222stu222vwxyz023456789";
		srand ( ( double ) microtime () * 1000000 );
		$i = 0;
		$pass = '';
		while ( $i <= 7 ) {
			$num = rand () % 33;
			$tmp = substr ( $chars, $num, 1 );
			$pass = $pass . $tmp;
			$i ++;
		}
		
		return $pass;
	}
	
	/**
	 * Send email using SMTP with attachment.
	 * SMTP configuation exists in global.php
	 *
	 * @param string $serviceLocator        	
	 * @param string $to        	
	 * @param string $recipientName        	
	 * @param string $subject        	
	 * @param string $body        	
	 * @param string $filePath        	
	 */
	/*
	 * public static function sendEmail($serviceLocator, $to, $recipientName, $subject, $body, $filePath = ""){ // read smtp config // get smtp configuration options $SMTPconfig = $serviceLocator->get('SMTP'); //Create a new PHPMailer instance $mail = new \PHPMailer(); //Tell PHPMailer to use SMTP $mail->isSMTP(); $mail->SMTPDebug = $SMTPconfig['debug_mail']; //Ask for HTML-friendly debug output $mail->Debugoutput = 'html'; //Set the hostname of the mail server $mail->Host = $SMTPconfig['name']; //Set the SMTP port number - likely to be 25, 465 or 587 $mail->Port = $SMTPconfig['port']; //Whether to use SMTP authentication $mail->SMTPAuth = true; //Username to use for SMTP authentication $mail->Username = $SMTPconfig['connection_config']['username']; //Password to use for SMTP authentication $mail->Password = $SMTPconfig['connection_config']['password']; //Set who the message is to be sent from $mail->setFrom($SMTPconfig['from_email'], $SMTPconfig['from_name']); //Set an alternative reply-to address //$mail->addReplyTo('replyto@example.com', 'First Last'); //Set who the message is to be sent to $mail->addAddress($to, $recipientName); //Set the subject line $mail->Subject = $subject; //Read an HTML message body from an external file, convert referenced images to embedded, //convert HTML into a basic plain-text alternative body $mail->msgHTML($body); //Replace the plain text body with one created manually $mail->AltBody = strip_tags($body); if($filePath != "" && is_file($filePath)){ //Attach an image file $mail->addAttachment($filePath); } //send the message, check for errors if (!$mail->send()) { echo "Mailer Error: " . $mail->ErrorInfo; } else { echo "Message sent!"; } }
	 */
	
	/**
	 * Send email using SMTP.
	 * SMTP configuation exists in global.config
	 *
	 * @param object $serviceLocator        	
	 * @param string $to        	
	 * @param string $recipientName        	
	 * @param string $subject        	
	 * @param string $body        	
	 * @return boolean
	 */
	public static function sendMail($serviceLocator, $to, $recipientName, $subject, $body, $attachment = "") {
		
		// get smtp configuration options
		$SMTPconfig = $serviceLocator->get ( 'SMTP' );
		
		// Set SMTP options
		$smtpTransport = new Smtp ();
		$options = new SmtpOptions ( $SMTPconfig );
		$smtpTransport->setOptions ( $options );
		
		// Message body
		$bodyPart = new \Zend\Mime\Message ();
		
		// Set main body
		$bodyMessage = new \Zend\Mime\Part ( $body );
		$bodyMessage->type = Mime::TYPE_HTML;
		
		// Set attachment if available
		if ($attachment != "" && count ( $attachment ) > 0) {
			
			// Add the attachment
			$fileContents = fopen ( $attachment ['filepath'], 'r' );
			$attachmentPart = new \Zend\Mime\Part ( $fileContents );
			$attachmentPart->type = Mime::MULTIPART_MIXED;
			$attachmentPart->filename = $attachment ['filename'];
			$attachmentPart->disposition = Mime::DISPOSITION_ATTACHMENT;
			$attachmentPart->encoding = Mime::ENCODING_BASE64; // Setting the encoding is recommended for binary data
			                                                   
			// Add body message and attachment to the message body
			$bodyPart->setParts ( array (
					$bodyMessage,
					$attachmentPart 
			) );
		} else {
			// Add only the body message
			$bodyPart->setParts ( array (
					$bodyMessage 
			) );
		}
		
		// Set message info
		$mail = new Mail\Message ();
		$mail->setBody ( $bodyPart );
		$mail->setFrom ( $SMTPconfig ['connection_config'] ['username'], $serviceLocator->get ( 'smtpSenderName' ) );
		$mail->addTo ( $to, $recipientName );
		$mail->setSubject ( $subject );
		$mail->setEncoding ( 'UTF-8' );
		
		if ($mail->isValid ()) {
			
			// Send mail if valid
			$smtpTransport->send ( $mail );
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * Generate random string
	 * 
	 * @param int $length        	
	 * @return string
	 */
	public static function generatePassword($length = 8) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
		$password = substr ( str_shuffle ( $chars ), 0, $length );
		return $password;
	}
	
	/**
	 * Build the returned message in session
	 *
	 * @param string $message        	
	 * @return string
	 */
	public static function buildMessage($message) {
		$_SESSION ['ALERT'] = $message;
		return $message;
	}
	
	/**
	 * Returns the message build in session
	 *
	 * @return string
	 */
	public static function printMessage() {
		$message = $_SESSION ['ALERT'];
		$_SESSION ['ALERT'] = "";
		return $message;
	}
	
	/**
	 * Check if array has empty values
	 *
	 * @param array $fieldsArray        	
	 * @return boolean
	 */
	function hasEmptyValue($fieldsArray) {
		foreach ( $fieldsArray as $value ) {
			if (trim ( $value ) == "" || $value == 0) {
				// echo "Error: $value field is empty<br />";
				return true;
			}
		}
		return false;
	}
	
	/**
	 * Transform object to array
	 *
	 * @param object $d        	
	 * @return array
	 */
	function objectToArray($d) {
		if (is_object ( $d )) {
			// Gets the properties of the given object
			// with get_object_vars function
			$d = get_object_vars ( $d );
		}
		
		if (is_array ( $d )) {
			/*
			 * Return array converted to object Using __FUNCTION__ (Magic constant) for recursive call
			 */
			return array_map ( __FUNCTION__, $d );
		} else {
			// Return array
			return $d;
		}
	}
	
	/**
	 * Transform array to object
	 * 
	 * @param array $d        	
	 * @return StdClass
	 */
	function arrayToObject($d) {
		if (is_array ( $d )) {
			/*
			 * Return array converted to object Using __FUNCTION__ (Magic constant) for recursive call
			 */
			return ( object ) array_map ( __FUNCTION__, $d );
		} else {
			// Return object
			return $d;
		}
	}
	
	/**
	 * Uploading files
	 *
	 * @param
	 *        	string | array $files
	 * @param string $filePath        	
	 * @param array $extArray        	
	 * @param boolean $multiple        	
	 *
	 * @return array of uploaded files
	 */
	public static function uploadFile($files, $filePath, $extArray, $multiple = false) {
		$uploadedFiles = array ();
		$uploadObj = new \Zend\File\Transfer\Adapter\Http ();
		$uploadObj->setDestination ( $filePath );
		
		if ($multiple == false) {
			
			// If we have one file to upload then we transform it to array so the loop won't produce any errors
			$filesArray [0] = $files;
		} else {
			$filesArray = $files;
		}
		
		for($i = 0; $i < count ( $filesArray ); $i ++) {
			
			if ($multiple == false) {
				$fileName = $filesArray [$i] ['name'];
			} else {
				$fileName = $filesArray ['name'] [$i];
			}
			
			// To get the file extension
			$ext = explode ( '.', $fileName );
			$extension = $ext [count ( $ext ) - 1];
			
			// test if the extension is allowed
			if (in_array ( $extension, $extArray )) {
				
				if ($fileName != '') {
					if ($uploadObj->receive ( $fileName )) {
						$uploadedFiles [] = $fileName;
					}
				}
			}
		}
		
		if ($multiple == false) {
			return $uploadedFiles [0];
		} else {
			return $uploadedFiles;
		}
	}
	
	/**
	 * Save Files
	 * 
	 * @param $_FILES $files        	
	 * @param string $fileNames        	
	 * @param string $filePath        	
	 * @return void
	 */
	function saveFiles($files, $fileNames, $filePath) {
		$filesuploaded = $this->uploadFile ( $files, $filePath );
		
		for($i = 0; $i < count ( $filesuploaded ); $i ++) {
			$data = $this->convertFileDataStringToBytes ( $filePath . '/' . $filesuploaded [$i] );
		}
	}
	
	/**
	 * Convert FileData String To Base64
	 * 
	 * @param
	 *        	string filename(including path)
	 * @return string encoded string base64
	 */
	function convertFileDataStringToBytes($filename) {
		$str = file_get_contents ( $filename );
		$str = base64_encode ( $str );
		
		return $str;
	}
	
	/**
	 * Convert FileData Base64 To String
	 * 
	 * @param
	 *        	string filename(including path)
	 * @return string decoded string
	 */
	function convertFileDataBytesToString($bytes) {
		$filename = PATH . '/' . upload_file_dir . '/';
		$str = base64_decode ( $bytes );
		
		return $str;
	}
	
	/**
	 * Convert given time to local time matching the user's timezone
	 *
	 * @param \DateTime $fromDatetime        	
	 * @param string $format        	
	 *
	 * @return \DateTime
	 */
	public static function convertDatetimeViaLocalTimezone($fromDatetime, $format = "F j, Y - H:i:s") {
		
		// Get user's timezone from the session
		$userTimezone = $_SESSION ['timezone'];
		
		// create datetime object from the given datetime according to GMT
		$localdateTime = new \DateTime ( $fromDatetime, new \DateTimeZone ( 'GMT' ) );
		
		// Transform the datetime accroding to user's timezone
		$localdateTime->setTimeZone ( new \DateTimeZone ( $userTimezone ) );
		
		// Format the datetime according to the given format parameter
		return $localdateTime->format ( $format );
	}
	
	/**
	 * Prepare the json array for the response
	 * 
	 * @param int|boolean $status        	
	 * @param string $message        	
	 * @return Array <Json>
	 */
	public static function createJsonResponse($status, $message) {
		$array = array (
				"status" => $status,
				"message" => $message 
		);
		return Json::encode ( $array );
	}
	
	/**
	 * Check if the folders path exists.
	 * If does not, it creates them
	 * 
	 * @param string $path        	
	 * @return void
	 */
	public static function createPathFolders($path) {
		$notEmptyValidator = new NotEmpty ();
		
		// This is used for checking if the folder existing
		// because is_dir() needs the full path to check the existing of the folder
		$concatPath = "";
		
		// Split the path to get the folders names
		$folders = explode ( '/', $path );
		
		foreach ( $folders as $folder ) {
			$concatPath .= $folder;
			
			// Check if folder name is not empty and not exist
			if ($notEmptyValidator ( $folder ) && ! is_dir ( $concatPath )) {
				// Create the folder
				mkdir ( $concatPath );
			}
			
			$concatPath .= '/';
		}
	}
	
	/**
	 * Build action name of a Controller
	 *
	 * @param
	 *        	$controllerAction
	 * @param string $actionName
	 *        	(used to override the default controller action name in some places like create/edit actions)
	 * @return string
	 */
	public static function getActionName($controllerAction, $actionName = '') {
		$routeMatch = $controllerAction->getEvent ()->getRouteMatch ();
		$controller = $routeMatch->getParam ( 'controller' );
		
		$array = explode ( '\\', $controller );
		$controllerName = $array [0] . $array [2];
		
		if ($actionName == '') {
			$actionName = $routeMatch->getParam ( 'action' );
		}
		
		$name = $controllerName . $actionName;
		
		return $name;
	}
	
	/**
	 * Check if the request is either ajax or not
	 * 
	 * @return boolean
	 */
	public static function checkIfAjaxRequest() {
		return isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) && ! empty ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) && strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest';
	}
	
	/**
	 * Return today's date
	 * 
	 * @param string $format        	
	 * @return date
	 */
	public static function getTodayDate($format = "Y-m-d H:i:s") {
		return date ( $format );
	}
	
	/**
	 * Return full upload path of a given upload dir based on an organization name
	 * 
	 * @param logger $logger        	
	 * @param string $lastUploaddir        	
	 * @return string $uploadPath
	 */
	public static function getUploadPath($logger, $lastUploaddir) {
		$uploadPath = PATH . "/" . upload_organization_dir . $_SESSION ['orgName'] . $lastUploaddir . "/";
		CommonController::createPathFolders ( $uploadPath );
		return $uploadPath;
	}
	public static function getMinutesToTime($minutesDuration) {
		$hours = floor ( $minutesDuration / 60 );
		$minutes = $minutesDuration % 60;
		$seconds = "00";
		
		if (strlen ( $hours ) < 2)
			$hours = "0" . $hours;
		if (strlen ( $minutes ) < 2)
			$minutes = "0" . $minutes;
		
		return "$hours:$minutes:$seconds";
	}
	function toMinutes($time) {
		$time = explode ( ':', $time );
		return ($time [0] * 60) + $time [1];
	}
	public static function strip($string, $length, $addPoints, $removeTags = true) {
		if ($addPoints) {
			$append = '...';
		} else {
			$append = '';
		}
		$string = trim ( $string );
		
		if ($removeTags) {
			$string = strip_tags ( $string );
		}
		
		$newStringArray = explode ( " ", $string );
		$i = 0;
		while ( $i < $length ) {
			echo $newStringArray [$i];
			echo " ";
			$i ++;
		}
		if (count ( $newStringArray ) > $length) {
			echo $append;
		}
	}
	public static function mailFormat($msgArray) {
		$msg = '
      <html>
      <body topmargin="0">
      <table align="center" width="650" border="0" style="border:#b7b7b7 1px dashed" cellspacing="0" cellpadding="0">
        <tr>
          <td ><table width="650" border="0" cellspacing="5" cellpadding="5">
            <tr>
              <td valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="81%" align="center"  class="list1" style="padding-left:5px">Form Content</td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td><hr color="#3f3f3f" style="border:1px dashed" /></td>
            </tr> <tr>
              <td><hr color="#3f3f3f" style="border:1px dashed" /></td>
            </tr>
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="2%" valign="top" align="right">&nbsp;</td>' . CommonController::getMessageContent ( $msgArray ) . '</table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          <tr>
              <td><hr color="#3f3f3f" style="border:1px solid" /></td>
            </tr>
          </table></td>
        </tr>
      </table>
      </body>
      </html>';
		return $msg;
	}
	private function getMessageContent($msgArray) {
		$msgContent = "";
		foreach ( $msgArray as $key => $value ) {
			$msgContent .= '<tr>
                  <td valign="top">&nbsp;</td>
                  <td valign="top"><span class="list">' . $key . '</span></td>
                  <td align="left" valign="top" class="pp">:</td>
                  <td valign="top" class="desc">' . $value . '</td>
                </tr>';
		}
		return $msgContent;
	}
	
	/**
	 * Filter input value from unwanted characters
	 * 
	 * @param string $input        	
	 */
	public static function filterInput($input) {
		// Check if empty, if true then return it
		$checkEmpty = new NotEmpty ();
		if ($checkEmpty->isValid ( $input ) == false)
			return $input;
			
			// Check if the value is integer then return it directly
		$checkInteger = new Digits ();
		if ($checkInteger->isValid ( $input ))
			return $input;
		
		$stripTags = new StripTags ();
		$stringTrim = new StringTrim ();
		$htmlEntities = new HtmlEntities ();
		
		$input = $stripTags->filter ( $input );
		$input = $stringTrim->filter ( $input );
		$input = $htmlEntities->filter ( $input );
		$input = str_replace ( "\\", "", $input ); // kill remained backslash
		$input = preg_replace ( "/&apos;/", "'", $input ); // replace '&apos;' with " ' "
		
		return $input;
	}
	public static function formatSizeUnits($bytes) {
		if ($bytes >= 1073741824) {
			$bytes = round ( number_format ( $bytes / 1073741824, 2 ) ) . ' GB';
		} elseif ($bytes >= 1048576) {
			$bytes = round ( number_format ( $bytes / 1048576, 2 ) ) . ' MB';
		} elseif ($bytes >= 1024) {
			$bytes = round ( number_format ( $bytes / 1024, 2 ) ) . ' KB';
		} elseif ($bytes > 1) {
			$bytes = $bytes . ' bytes';
		} elseif ($bytes == 1) {
			$bytes = $bytes . ' byte';
		} else {
			$bytes = ' 0 bytes';
		}
		
		return $bytes;
	}
	public static function validateDate($date, $format = 'Y-m-d H:i:s') {
		$d = \DateTime::createFromFormat ( $format, $date );
		return $d && $d->format ( $format ) == $date;
	}
	public static function StripText($str, $start, $length, $addpoints = false, $removeTags = true) {
		//$strlength = strlen ( $str );
		
		if ($removeTags == true){
			$str = strip_tags($str);
		}
		
		$newStr = substr ( $str, $start, $length );
		if ($addpoints == true && strlen ( $newStr ) < $length) {
			$newStr .= '...';
		}
		return $newStr;
	}
	
	
	
	// added new 
	
	Public static function checkHttp($link){
		if (substr($link, 0,7) == 'http://' || substr($link, 0,8) == 'https://'){
			return $link;
	
		}else {
			return 'http://'.$link;
		}
	}
	
	// return image path
	public static function getImage($filename, $prefix="") {
	
		$filename = str_replace('../public/uploads/images/', '', $filename);
	
		if ( $prefix == "" ) {
			return upload_image_dir . $filename;
		}else{
			return upload_image_dir . $prefix . "_" . $filename;
		}
	}
	
	// return file path
	public static function getFile($filename, $prefix="") {
	
		$filename = str_replace('../public/uploads/files/', '', $filename);
	
		if ( $prefix == "" ) {
			return upload_file_dir . $filename;
		}else{
			return upload_file_dir . $prefix . "_" . $filename;
		}
	}
	
}