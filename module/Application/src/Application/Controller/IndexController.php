<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Crypt\PublicKey\Rsa\PublicKey;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
    	//print_r(strlen('Providing the best plumbing solutions in Lebanon &amp; the region'));die();
    	$sectionId = SectionController::$HOME_PAGE;
    	$banner = IndexController::getBanner($sectionId);
    	
    	//get home services
    	$serviceMySqlExtDAO = new \ServiceMySqlExtDAO();
    	$services = $serviceMySqlExtDAO->getHomeServices();
    	
    	$projectMySqlExtDAO = new \ProjectMySqlExtDAO();
    	$projects = $projectMySqlExtDAO->getHomeProjects();
    	
    	$whyPageInfo = PageController::getPageInfo(PageController::$WHY_PLUMBERS);
    	
    	$this->layout()->home = 'home';
    	
        return new ViewModel(array(
        		'banner'=>$banner,
        		'services' =>$services,
        		'projects'=>$projects,
        		'whyInfo'=>$whyPageInfo,
        ));
    }
    
    public function aboutAction()
    {
    	$sectionId = SectionController::$ABOUT;
    	$sectionInfo = SectionController::getSectionInfo($sectionId);
    	$banner = IndexController::getBanner($sectionId);
    	
    	$page1 = PageController::getPageInfo(PageController::$ABOUT_UPPER);
    	$page2 = PageController::getPageInfo(PageController::$CONTRACTING);
    	$page3 = PageController::getPageInfo(PageController::$MAINTENANCE);
    	$page4 = PageController::getPageInfo(PageController::$VISION);
    	$page5 = PageController::getPageInfo(PageController::$MISSION);
    	$page6 = PageController::getPageInfo(PageController::$OBJECTIVE);
    	$whyPageInfo = PageController::getPageInfo(PageController::$WHY_PLUMBERS);
    	
    	return new ViewModel(array(
    			'banner'=>$banner,
    			'page1'=>$page1,
    			'page2'=>$page2,
    			'page3'=>$page3,
    			'page4'=>$page4,
    			'page5'=>$page5,
    			'page6'=>$page6,
    			'page7'=>$whyPageInfo,
    			'sectionInfo'=>$sectionInfo,
    	));
    }
    
    public function searchAction(){
    	$sectionId = SectionController::$SEARCH;
    	$sectionInfo = SectionController::getSectionInfo($sectionId);
    	$banner = IndexController::getBanner($sectionId);
    	
    	$keyword=CommonController::filterInput( $this->params()->fromQuery('keyword'));
    	$serviceMySqlExtDAO = new \ServiceMySqlExtDAO();
    	$services = $serviceMySqlExtDAO->getSearchServices($keyword);
    	$projectMySqlExtDAO = new \ProjectMySqlExtDAO();
    	$projects = $projectMySqlExtDAO->getsearchProjects($keyword);
    	
    	return new ViewModel(array(
    			'service' =>$services,
    			'projects'=>$projects,
    			'banner'=>$banner,
    			'sectionInfo'=>$sectionInfo,
    	));
    }
    public static function getBanner($sectionId){
    	$bannerMySqlExtDAO = new \BannerMySqlExtDAO();
    	$banner = $bannerMySqlExtDAO->getBanner($sectionId);
    	return $banner;
    }
}
