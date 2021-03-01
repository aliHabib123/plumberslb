<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * ProjectController
 *
 * @author
 *
 * @version
 *
 */
class ProjectController extends AbstractActionController {
	/**
	 * The default action - show the home page
	 */
	public function indexAction() {
		
		$isupcoming = CommonController::filterInput($this->params('id'));
		
		$pageId = CommonController::filterInput( $this->params()->fromQuery('pageId'));
		
		if (!isset($pageId)){
			$pageId=1;
		}
		$limit = 12;
		$offset= ($pageId -1) * 12;
		
		$sectionId = SectionController::$PROJECTS;
		$sectionInfo = SectionController::getSectionInfo($sectionId);
		$banner = IndexController::getBanner($sectionId);

		$projectMySqlExtDAO = new \ProjectMySqlExtDAO();
		$projects = $projectMySqlExtDAO->getProjects($isupcoming, $limit, $offset);
		$count = ceil(count($projectMySqlExtDAO->getProjectsCount($isupcoming)) / $limit);
		if($isupcoming){
			$this->layout()->metaTitle = 'Upcoming Projects';
		} else{
			$this->layout()->metaTitle = 'Old Projects';
		}
		return new ViewModel (array(
				'banner'=>$banner,
				'sectionInfo'=>$sectionInfo,
				'projects'=>$projects,
				'count'=>$count,
				'upcomingId'=>$isupcoming,
	
		));
	}
	public function detailsAction() {
	
		$sectionId = SectionController::$PROJECTS;
		$sectionInfo = SectionController::getSectionInfo($sectionId);
		$banner = IndexController::getBanner($sectionId);
		// TODO Auto-generated ProductController::indexAction() default action
		$projectId = CommonController::filterInput($this->params('projectId'));
		$projectMySqlExtDAO = new \ProjectMySqlExtDAO();
		$project = $projectMySqlExtDAO->load($projectId);
		return new ViewModel (array(
				'banner'=>$banner,
				'sectionInfo'=>$sectionInfo,
				'project'=>$project,
	
		));
	}
}