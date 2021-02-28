<?php
/**
 * Class that operate on table 'product'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-06-21 13:48
 */
class ProductMySqlExtDAO extends ProductMySqlDAO{

	public function getProducts(){
		$txt ="select * from product order by product_order asc";
		$sqlQuery = new SqlQuery($txt);
		return $this->getList($sqlQuery);
	}
}
?>