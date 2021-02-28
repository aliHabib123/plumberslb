<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

use Zend\Log\Writer\Stream;
return array(
		'service_manager' => array(
				
		        'factories' => array(
		        	// for primary db adapter that called
		        	// by $sm->get('Zend\Db\Adapter\Adapter')
		            'Zend\Db\Adapter\Adapter' 
		            		=> 'Zend\Db\Adapter\AdapterServiceFactory',
	            
		            // Global sender name
		            'smtpSenderName' => function (){ return 'PLUMBERS'; },
		            
		            // SMTP configuration
		            'SMTP' => function (){
		            	
		            	return array(
		            			'name'              => 'mail.thirteencube.com',
		            			'host'              => '69.162.127.170',
		            			'port'				=>  25,
		            			'connection_class'  => 'smtp',
		            			'connection_config' => array(
		            					'username' => 'ali.habib@thirteencube.com',
		            					'password' => 'syncmaster123'
		            			)
		            	);
		            },
		            	
		        ), // End Factories
		        
	    ),// End Service Manager
);