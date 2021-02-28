<?php
/**
 * Class that operate on table 'section'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-06-21 13:48
 */
class SectionMySqlDAO implements SectionDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return SectionMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM section WHERE section_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM section';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM section ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param section primary key
 	 */
	public function delete($section_id){
		$sql = 'DELETE FROM section WHERE section_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($section_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param SectionMySql section
 	 */
	public function insert($section){
		$sql = 'INSERT INTO section (section_name, section_title) VALUES (?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($section->sectionName);
		$sqlQuery->set($section->sectionTitle);

		$id = $this->executeInsert($sqlQuery);	
		$section->sectionId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param SectionMySql section
 	 */
	public function update($section){
		$sql = 'UPDATE section SET section_name = ?, section_title = ? WHERE section_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($section->sectionName);
		$sqlQuery->set($section->sectionTitle);

		$sqlQuery->setNumber($section->sectionId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM section';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryBySectionName($value){
		$sql = 'SELECT * FROM section WHERE section_name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryBySectionTitle($value){
		$sql = 'SELECT * FROM section WHERE section_title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteBySectionName($value){
		$sql = 'DELETE FROM section WHERE section_name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteBySectionTitle($value){
		$sql = 'DELETE FROM section WHERE section_title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return SectionMySql 
	 */
	protected function readRow($row){
		$section = new Section();
		
		$section->sectionId = $row['section_id'];
		$section->sectionName = $row['section_name'];
		$section->sectionTitle = $row['section_title'];

		return $section;
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
	 * @return SectionMySql 
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