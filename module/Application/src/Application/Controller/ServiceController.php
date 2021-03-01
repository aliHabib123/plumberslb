<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * ServiceController
 *
 * @author
 *
 * @version
 *
 */
class ServiceController extends AbstractActionController {
	/**
	 * The default action - show the home page
	 */
	public function indexAction() {
		$sectionId = SectionController::$SERVICES;
		$sectionInfo = SectionController::getSectionInfo($sectionId);
		$banner = IndexController::getBanner($sectionId);
		
		$serviceMySqlExtDAO = new \ServiceMySqlExtDAO();
		$services = $serviceMySqlExtDAO->getServices();
		$this->layout()->metaTitle = 'Services';
		$this->layout()->metaDesc = 'We provide plumbing services in Lebanon including ';
		$count = count($services);
		$c=1;
		foreach($services as $row){
			$this->layout()->metaDesc .= $row->serviceTitle;
			if($c==$count){

			} elseif($c==$count-1){
				$this->layout()->metaDesc .= ' and ';
			} else{
				$this->layout()->metaDesc .= ', ';
			}
			$c++;
		}

		return new ViewModel (array(
				'banner'=>$banner,
				'sectionInfo'=>$sectionInfo,
				'services'=>$services
		));
	}
	public function detailsAction() {
		$sectionId = SectionController::$SERVICES;
		$sectionInfo = SectionController::getSectionInfo($sectionId);
		$banner = IndexController::getBanner($sectionId);
		// TODO Auto-generated ProductController::indexAction() default action
		$serviceId = CommonController::filterInput($this->params('serviceId'));
		$serviceMySqlExtDAO = new \ServiceMySqlExtDAO();
		$service = $serviceMySqlExtDAO->load($serviceId);
		$this->layout()->metaTitle = 'Services - '.$service->serviceTitle;
		$this->layout()->metaDesc = $service->serviceDetails;
		return new ViewModel (array(
				'banner'=>$banner,
				'sectionInfo'=>$sectionInfo,
				'service'=>$service,
	
		));
	}
}