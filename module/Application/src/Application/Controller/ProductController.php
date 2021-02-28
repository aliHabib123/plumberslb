<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * ProductController
 *
 * @author
 *
 * @version
 *
 */
class ProductController extends AbstractActionController {
	/**
	 * The default action - show the home page
	 */
	public function indexAction() {
		
		$sectionId = SectionController::$PRODUCTS;
		$sectionInfo = SectionController::getSectionInfo($sectionId);
		$banner = IndexController::getBanner($sectionId);
		$pageInfo = PageController::getPageInfo(PageController::$PRODUCTS_UPPER);
		// TODO Auto-generated ProductController::indexAction() default action
		
		$productMySqlExtDAO = new \ProductMySqlExtDAO();
		$products = $productMySqlExtDAO->getProducts();
		return new ViewModel (array(
				'banner'=>$banner,
				'sectionInfo'=>$sectionInfo,
				'pageInfo'=>$pageInfo,
				'products'=>$products,
				
		));
	}
	
	public function detailsAction() {
	
		$sectionId = SectionController::$PRODUCTS;
		$sectionInfo = SectionController::getSectionInfo($sectionId);
		$banner = IndexController::getBanner($sectionId);
		$pageInfo = PageController::getPageInfo(PageController::$PRODUCTS_UPPER);
		// TODO Auto-generated ProductController::indexAction() default action
		$productId = CommonController::filterInput($this->params('productId'));
		$productMySqlExtDAO = new \ProductMySqlExtDAO();
		$product = $productMySqlExtDAO->load($productId);
		return new ViewModel (array(
				'banner'=>$banner,
				'sectionInfo'=>$sectionInfo,
				'pageInfo'=>$pageInfo,
				'product'=>$product,
	
		));
	}
}