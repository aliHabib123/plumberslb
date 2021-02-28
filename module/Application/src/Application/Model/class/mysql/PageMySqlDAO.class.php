<?php
/**
 * Class that operate on table 'page'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-06-21 13:48
 */
class PageMySqlDAO implements PageDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return PageMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM page WHERE page_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM page';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM page ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param page primary key
 	 */
	public function delete($page_id){
		$sql = 'DELETE FROM page WHERE page_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($page_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param PageMySql page
 	 */
	public function insert($page){
		$sql = 'INSERT INTO page (page_name, page_title, page_details, page_img) VALUES (?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($page->pageName);
		$sqlQuery->set($page->pageTitle);
		$sqlQuery->set($page->pageDetails);
		$sqlQuery->set($page->pageImg);

		$id = $this->executeInsert($sqlQuery);	
		$page->pageId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param PageMySql page
 	 */
	public function update($page){
		$sql = 'UPDATE page SET page_name = ?, page_title = ?, page_details = ?, page_img = ? WHERE page_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($page->pageName);
		$sqlQuery->set($page->pageTitle);
		$sqlQuery->set($page->pageDetails);
		$sqlQuery->set($page->pageImg);

		$sqlQuery->setNumber($page->pageId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM page';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByPageName($value){
		$sql = 'SELECT * FROM page WHERE page_name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPageTitle($value){
		$sql = 'SELECT * FROM page WHERE page_title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPageDetails($value){
		$sql = 'SELECT * FROM page WHERE page_details = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPageImg($value){
		$sql = 'SELECT * FROM page WHERE page_img = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByPageName($value){
		$sql = 'DELETE FROM page WHERE page_name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPageTitle($value){
		$sql = 'DELETE FROM page WHERE page_title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPageDetails($value){
		$sql = 'DELETE FROM page WHERE page_details = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPageImg($value){
		$sql = 'DELETE FROM page WHERE page_img = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return PageMySql 
	 */
	protected function readRow($row){
		$page = new Page();
		
		$page->pageId = $row['page_id'];
		$page->pageName = $row['page_name'];
		$page->pageTitle = $row['page_title'];
		$page->pageDetails = $row['page_details'];
		$page->pageImg = $row['page_img'];

		return $page;
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
	 * @return PageMySql 
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