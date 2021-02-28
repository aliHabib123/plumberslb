<?php

/**
 * DAOFactory
 * @author: http://phpdao.com
 * @date: ${date}
 */
class DAOFactory{
	
	/**
	 * @return BannerDAO
	 */
	public static function getBannerDAO(){
		return new BannerMySqlExtDAO();
	}

	/**
	 * @return ContactDAO
	 */
	public static function getContactDAO(){
		return new ContactMySqlExtDAO();
	}

	/**
	 * @return PageDAO
	 */
	public static function getPageDAO(){
		return new PageMySqlExtDAO();
	}

	/**
	 * @return ProductDAO
	 */
	public static function getProductDAO(){
		return new ProductMySqlExtDAO();
	}

	/**
	 * @return ProjectDAO
	 */
	public static function getProjectDAO(){
		return new ProjectMySqlExtDAO();
	}

	/**
	 * @return SectionDAO
	 */
	public static function getSectionDAO(){
		return new SectionMySqlExtDAO();
	}

	/**
	 * @return ServiceDAO
	 */
	public static function getServiceDAO(){
		return new ServiceMySqlExtDAO();
	}

	/**
	 * @return SocialDAO
	 */
	public static function getSocialDAO(){
		return new SocialMySqlExtDAO();
	}

	/**
	 * @return SubscriberDAO
	 */
	public static function getSubscriberDAO(){
		return new SubscriberMySqlExtDAO();
	}

	/**
	 * @return TbNewsDAO
	 */
	public static function getTbNewsDAO(){
		return new TbNewsMySqlExtDAO();
	}


}
?>