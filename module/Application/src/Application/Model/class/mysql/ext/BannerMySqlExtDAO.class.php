<?php
use Application\Controller\SectionController;
/**
 * Class that operate on table 'banner'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-06-21 13:48
 */
class BannerMySqlExtDAO extends BannerMySqlDAO{

	public function getBanner($sectionId){
		$txt ="select * from banner where section_id = $sectionId";
		$sqlQuery = new SqlQuery($txt);
		if ($sectionId==SectionController::$HOME_PAGE){
			return $this->getList($sqlQuery);
		}else {
			return $this->getRow($sqlQuery);
		}
	}
	
}
?>