<?php
use Zend\Crypt\PublicKey\Rsa\PublicKey;
/**
 * Class that operate on table 'service'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-06-21 13:48
 */
class ServiceMySqlExtDAO extends ServiceMySqlDAO{

	public function getHomeServices(){
		$txt = "select * from service where show_home = 1 order by service_order asc limit 3 offset 0";
		$sqlQuery = new SqlQuery($txt);
		return $this->getList($sqlQuery);
	}
	public function getServices(){
		$txt = "select * from service order by service_order asc";
		$sqlQuery = new SqlQuery($txt);
		return $this->getList($sqlQuery);
	}
	
	public function getSearchServices($keyword){
		$txt ="select * from service where service_title like '%$keyword%' or service_details like '%$keyword%'";
		$sqlQuery = new SqlQuery($txt);
		return $this->getList($sqlQuery);
	}
}
?>