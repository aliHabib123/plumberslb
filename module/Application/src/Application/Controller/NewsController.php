<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * NewsController
 *
 * @author
 *
 * @version
 *
 */
class NewsController extends AbstractActionController {
	/**
	 * The default action - show the home page
	 */
	public function indexAction() {
    	$sectionId = SectionController::$NEWS_EVENTS;
    	$sectionInfo = SectionController::getSectionInfo($sectionId);
    	$banner = IndexController::getBanner($sectionId);
    	
    	$newsMySqlExtDAO = new \TbNewsMySqlExtDAO();
    	$news = $newsMySqlExtDAO->getNews();
		return new ViewModel (array(
				'banner'=>$banner,
				'sectionInfo'=>$sectionInfo,
				'news'=>$news
		));
	}
	/**
	 * 
	 * news details action
	 */
	public function detailsAction() {
    	$sectionId = SectionController::$NEWS_EVENTS;
    	$sectionInfo = SectionController::getSectionInfo($sectionId);
    	$banner = IndexController::getBanner($sectionId);
    	$newsId = CommonController::filterInput($this->params('newsId'));
    	
    	$newsMySqlExtDAO = new \TbNewsMySqlExtDAO();
    	$news = $newsMySqlExtDAO->load($newsId);
		return new ViewModel (array(
				'banner'=>$banner,
				'sectionInfo'=>$sectionInfo,
				'news'=>$news
		));
	}
}