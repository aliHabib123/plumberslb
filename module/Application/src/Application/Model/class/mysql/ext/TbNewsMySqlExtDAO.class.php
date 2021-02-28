<?php
/**
 * Class that operate on table 'tb_news'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-06-21 13:48
 */
class TbNewsMySqlExtDAO extends TbNewsMySqlDAO{

	public function getNews(){
		$txt ="select * from tb_news order by tb_news_date desc";
		$sqlQuery = new SqlQuery($txt);
		return $this->getList($sqlQuery);
	}
}
?>