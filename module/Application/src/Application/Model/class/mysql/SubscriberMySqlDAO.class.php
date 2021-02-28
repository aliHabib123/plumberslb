<?php
/**
 * Class that operate on table 'subscriber'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-06-21 13:48
 */
class SubscriberMySqlDAO implements SubscriberDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return SubscriberMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM subscriber WHERE subscriber_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM subscriber';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM subscriber ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param subscriber primary key
 	 */
	public function delete($subscriber_id){
		$sql = 'DELETE FROM subscriber WHERE subscriber_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($subscriber_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param SubscriberMySql subscriber
 	 */
	public function insert($subscriber){
		$sql = "INSERT INTO subscriber (subscriber_name, subscriber_email, is_active) VALUES ('$subscriber->subscriberName' , '$subscriber->subscriberEmail', '$subscriber->isActive')";
		$sqlQuery = new SqlQuery($sql);
/* 		
		$sqlQuery->set($subscriber->subscriberName);
		$sqlQuery->set($subscriber->subscriberEmail);
		$sqlQuery->setNumber($subscriber->isActive);
		print_r($sqlQuery);die(); */
		$id = $this->executeInsert($sqlQuery);	
		$subscriber->subscriberId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param SubscriberMySql subscriber
 	 */
	public function update($subscriber){
		$sql = 'UPDATE subscriber SET subscriber_name = ?, subscriber_email = ?, is_active = ? WHERE subscriber_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($subscriber->subscriberName);
		$sqlQuery->set($subscriber->subscriberEmail);
		$sqlQuery->setNumber($subscriber->isActive);

		$sqlQuery->setNumber($subscriber->subscriberId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM subscriber';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryBySubscriberName($value){
		$sql = 'SELECT * FROM subscriber WHERE subscriber_name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryBySubscriberEmail($value){
		$sql = 'SELECT * FROM subscriber WHERE subscriber_email = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByIsActive($value){
		$sql = 'SELECT * FROM subscriber WHERE is_active = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteBySubscriberName($value){
		$sql = 'DELETE FROM subscriber WHERE subscriber_name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteBySubscriberEmail($value){
		$sql = 'DELETE FROM subscriber WHERE subscriber_email = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByIsActive($value){
		$sql = 'DELETE FROM subscriber WHERE is_active = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return SubscriberMySql 
	 */
	protected function readRow($row){
		$subscriber = new Subscriber();
		
		$subscriber->subscriberId = $row['subscriber_id'];
		$subscriber->subscriberName = $row['subscriber_name'];
		$subscriber->subscriberEmail = $row['subscriber_email'];
		$subscriber->isActive = $row['is_active'];

		return $subscriber;
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
	 * @return SubscriberMySql 
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