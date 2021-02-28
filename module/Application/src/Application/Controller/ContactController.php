<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * ContactController
 *
 * @author
 *
 *
 * @version
 *
 *
 */
class ContactController extends AbstractActionController
{

    /**
     * The default action - show the home page
     */
    public function indexAction()
    {
    	
    	$sectionId = SectionController::$CONTACT;
    	$sectionInfo = SectionController::getSectionInfo($sectionId);
    	$banner = IndexController::getBanner($sectionId);
    	
    	
    	$contactMySqlExtDAO = new \ContactMySqlExtDAO();
    	$contactInfo = $contactMySqlExtDAO->load(1);
    	
        $this->layout()->contactActive = 'active';
        return new ViewModel(array(
        		"banner"=>$banner,
        		"contactInfo"=>$contactInfo,
        		'sectionInfo'=>$sectionInfo,
        ));
    }
    
    /*
     * public function quoteAction(){ $view = new ViewModel(array( )); return $view; }
     */
    public function submitContactAction()
    {
        $name = CommonController::filterInput($this->getRequest()->getPost('name'));
        $email = CommonController::filterInput($this->getRequest()->getPost('email'));
        $phone = CommonController::filterInput($this->getRequest()->getPost('phone'));
        $message = CommonController::filterInput($this->getRequest()->getPost('message'));
        
        $validator = new \Zend\Validator\EmailAddress();
        
        if (! $validator->isValid($email)) {
            $msg = "Invalid Email";
            $result = false;
        } else {
            //$to = 'ali.habib@thirteencube.com';
            $to ='info@plumbers-lb.com';
            $emailSubject = 'Contact Form';
            $msgArray = array(
                "Name" => $name,
                "Email" => $email,
                "Phone" => $phone,
                "Message" => $message
            );
            $emailBody = CommonController::mailFormat($msgArray);
            $recipient = $email;
            // send Email with the contract link URL
            $sendMail = CommonController::sendMail($this->serviceLocator, $to, $recipient, $emailSubject, $emailBody);
            
            if ($sendMail) {
                $msg = 'Your msg has been successfully sent';
                $result = true;
            } else {
                $msg = "An error occured please try again later";
                $result = false;
            }
        }
        
        // return new ViewModel();
        $response = CommonController::createJsonResponse($result, $msg);
        print_r($response);
        return $this->response;
    }
    
    public function submitNewsLetterAction(){
    	$name = CommonController::filterInput($this->getRequest()->getPost('name'));
    	$email = CommonController::filterInput($this->getRequest()->getPost('email'));
    	
    	$validator = new \Zend\Validator\EmailAddress();
    	
    	if (! $validator->isValid($email)) {
    		$msg = "Invalid Email";
    		$result = false;
    	} else {
    		$to = $email;
    		$emailSubject = 'Contact Form';
    		$randomKey = CommonController::createRandomKey();
    		$newsletterMySqlExtDAO = new \SubscriberMySqlExtDAO();
    		$subscriber = new \Subscriber();
    		$subscriber->isActive = '1';
    		$subscriber->subscriberName = $name;
    		$subscriber->subscriberEmail = $email;
    		//print_r($subscriber);die();
    		$subscribeAction = $newsletterMySqlExtDAO->insert($subscriber);
/*     		$msgArray = array(
    				"Name" => $name,
    				"Email" => $email,
    		); */
    		//$emailBody = CommonController::mailFormat($msgArray);
    		
/*     		$emailBody = "<img src='".BASE_URL.'images/logo.png'."' style='height:100px';margin-bottom:75px;/>
    				<div>
    				Dear ".$name."<br><br>
    				To activate your subscription press the link below:<br>
    				<a href='".MAIN_URL.'activate/'.$randomKey."'>".MAIN_URL.'activate/'.$randomKey."</a>
    						
    				</div>";
    		$recipient = $email; */
    		// send Email with the contract link URL
    		//$sendMail = CommonController::sendMail($this->serviceLocator, $to, $recipient, $emailSubject, $emailBody);
    	
    		if ($subscribeAction) {
    			$msg = 'You have successfully subscribed to our newsletter';
    			$result = true;
    		} else {
    			$msg = "An error occured please try again later";
    			$result = false;
    		}
    	}
    	
    	// return new ViewModel();
    	$response = CommonController::createJsonResponse($result, $msg);
    	print_r($response);
    	return $this->response;
    	
    }

    public function submitQuoteAction()
    {
        $name = CommonController::filterInput($this->getRequest()->getPost('name'));
        $email = CommonController::filterInput($this->getRequest()->getPost('email'));
        $phone = CommonController::filterInput($this->getRequest()->getPost('phone'));
        $stype = CommonController::filterInput($this->getRequest()->getPost('stype'));
        $message = CommonController::filterInput($this->getRequest()->getPost('message'));
        
        $validator = new \Zend\Validator\EmailAddress();
        
        if (! $validator->isValid($email)) {
            $msg = "Invalid Email";
            $result = false;
        } else {
            //$to = 'ali.habib@thirteencube.com';
            $to ='info@plumbers-lb.com';
            $emailSubject = 'Quotation';
            $msgArray = array(
                "Name" => $name,
                "Email" => $email,
                "Phone" => $phone,
                "Service Type" => $stype,
                "Message" => $message
            );
            $emailBody = CommonController::mailFormat($msgArray);
            $recipient = $email;
            // send Email with the contract link URL
            $sendMail = CommonController::sendMail($this->serviceLocator, $to, $recipient, $emailSubject, $emailBody);
            
            if ($sendMail) {
                $msg = 'Your msg has been successfully sent';
                $result = true;
            } else {
                $msg = "An error occured please try again later";
                $result = false;
            }
        }
        
        $response = CommonController::createJsonResponse($result, $msg);
        print_r($response);
        return $this->response;
    }
}