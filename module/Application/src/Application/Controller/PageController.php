<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\Plugin\Layout;

/**
 * PageController
 *
 * @author
 *
 * @version
 *
 */
class PageController extends AbstractActionController {
		
	public static $WHY_PLUMBERS = 1;
	public static $ABOUT_UPPER = 2;
	public static $CONTRACTING = 3;
	public static $MAINTENANCE = 4;
	public static $VISION = 5;
	public static $MISSION = 6;
	public static $OBJECTIVE = 7;
	public static $PRODUCTS_UPPER = 8;
	
	/**
	 * The default action - show the home page
	 */
	public function indexAction() {
		// TODO Auto-generated PageController::indexAction() default action
		return new ViewModel ();
	}
	
	public static function getPageInfo($id){
		$pageMySqlExtDAO = new \PageMySqlExtDAO();
		$pageInfo = $pageMySqlExtDAO->load($id);
		return $pageInfo;
	}
}