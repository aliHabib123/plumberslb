<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * SectionController
 *
 * @author
 *
 * @version
 *
 */
class SectionController extends AbstractActionController {
	
	public static $HOME_PAGE = 1;
	public static $ABOUT = 2;
	public static $SERVICES = 3;
	public static $PROJECTS = 4;
	public static $PRODUCTS = 5;
	public static $NEWS_EVENTS = 6;
	public static $CONTACT = 7;
	public static $SEARCH = 8;

	/**
	 * The default action - show the home page
	 */
	public function indexAction() {
		// TODO Auto-generated SectionController::indexAction() default action
		return new ViewModel ();
	}
	
	public static function getSectionInfo($id){
		$sectionMySqlExtDAO = new \SectionMySqlExtDAO();
		$sectionInfo = $sectionMySqlExtDAO->load($id);
		return $sectionInfo;
	}
	
}