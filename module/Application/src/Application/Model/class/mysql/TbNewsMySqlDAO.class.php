<?php
/**
 * Class that operate on table 'tb_news'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-06-21 13:48
 */
class TbNewsMySqlDAO implements TbNewsDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return TbNewsMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM tb_news WHERE tb_news_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM tb_news';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM tb_news ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param tbNew primary key
 	 */
	public function delete($tb_news_id){
		$sql = 'DELETE FROM tb_news WHERE tb_news_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($tb_news_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param TbNewsMySql tbNew
 	 */
	public function insert($tbNew){
		$sql = 'INSERT INTO tb_news (tb_news_title, tb_news_details, tb_news_date, tb_news_img) VALUES (?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($tbNew->tbNewsTitle);
		$sqlQuery->set($tbNew->tbNewsDetails);
		$sqlQuery->set($tbNew->tbNewsDate);
		$sqlQuery->set($tbNew->tbNewsImg);

		$id = $this->executeInsert($sqlQuery);	
		$tbNew->tbNewsId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param TbNewsMySql tbNew
 	 */
	public function update($tbNew){
		$sql = 'UPDATE tb_news SET tb_news_title = ?, tb_news_details = ?, tb_news_date = ?, tb_news_img = ? WHERE tb_news_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($tbNew->tbNewsTitle);
		$sqlQuery->set($tbNew->tbNewsDetails);
		$sqlQuery->set($tbNew->tbNewsDate);
		$sqlQuery->set($tbNew->tbNewsImg);

		$sqlQuery->setNumber($tbNew->tbNewsId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM tb_news';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByTbNewsTitle($value){
		$sql = 'SELECT * FROM tb_news WHERE tb_news_title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTbNewsDetails($value){
		$sql = 'SELECT * FROM tb_news WHERE tb_news_details = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTbNewsDate($value){
		$sql = 'SELECT * FROM tb_news WHERE tb_news_date = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTbNewsImg($value){
		$sql = 'SELECT * FROM tb_news WHERE tb_news_img = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByTbNewsTitle($value){
		$sql = 'DELETE FROM tb_news WHERE tb_news_title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTbNewsDetails($value){
		$sql = 'DELETE FROM tb_news WHERE tb_news_details = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTbNewsDate($value){
		$sql = 'DELETE FROM tb_news WHERE tb_news_date = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTbNewsImg($value){
		$sql = 'DELETE FROM tb_news WHERE tb_news_img = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return TbNewsMySql 
	 */
	protected function readRow($row){
		$tbNew = new TbNew();
		
		$tbNew->tbNewsId = $row['tb_news_id'];
		$tbNew->tbNewsTitle = $row['tb_news_title'];
		$tbNew->tbNewsDetails = $row['tb_news_details'];
		$tbNew->tbNewsDate = $row['tb_news_date'];
		$tbNew->tbNewsImg = $row['tb_news_img'];

		return $tbNew;
	}
	
	protected function getList($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		$ret = array();
		for($i=0;$i<count($tab);$i++){
			$ret[$i] = $this->readRow($tab[$i]);
		}
		return $ret;
	}
	
	/**
	 * Get row
	 *
	 * @return TbNewsMySql 
	 */
	protected function getRow($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		if(count($tab)==0){
			return null;
		}
		return $this->readRow($tab[0]);		
	}
	
	/**
	 * Execute sql query
	 */
	protected function execute($sqlQuery){
		return QueryExecutor::execute($sqlQuery);
	}
	
		
	/**
	 * Execute sql query
	 */
	protected function executeUpdate($sqlQuery){
		return QueryExecutor::executeUpdate($sqlQuery);
	}

	/**
	 * Query for one row and one column
	 */
	protected function querySingleResult($sqlQuery){
		return QueryExecutor::queryForString($sqlQuery);
	}

	/**
	 * Insert row to table
	 */
	protected function executeInsert($sqlQuery){
		return QueryExecutor::executeInsert($sqlQuery);
	}
}
?>