<?php
/**
 * Class that operate on table 'contact'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-06-21 13:48
 */
class ContactMySqlDAO implements ContactDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return ContactMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM contact WHERE contact_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM contact';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM contact ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param contact primary key
 	 */
	public function delete($contact_id){
		$sql = 'DELETE FROM contact WHERE contact_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($contact_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ContactMySql contact
 	 */
	public function insert($contact){
		$sql = 'INSERT INTO contact (contact_address, contact_telephone, contact_fax, contact_email) VALUES (?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($contact->contactAddress);
		$sqlQuery->set($contact->contactTelephone);
		$sqlQuery->set($contact->contactFax);
		$sqlQuery->set($contact->contactEmail);

		$id = $this->executeInsert($sqlQuery);	
		$contact->contactId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param ContactMySql contact
 	 */
	public function update($contact){
		$sql = 'UPDATE contact SET contact_address = ?, contact_telephone = ?, contact_fax = ?, contact_email = ? WHERE contact_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($contact->contactAddress);
		$sqlQuery->set($contact->contactTelephone);
		$sqlQuery->set($contact->contactFax);
		$sqlQuery->set($contact->contactEmail);

		$sqlQuery->setNumber($contact->contactId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM contact';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByContactAddress($value){
		$sql = 'SELECT * FROM contact WHERE contact_address = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByContactTelephone($value){
		$sql = 'SELECT * FROM contact WHERE contact_telephone = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByContactFax($value){
		$sql = 'SELECT * FROM contact WHERE contact_fax = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByContactEmail($value){
		$sql = 'SELECT * FROM contact WHERE contact_email = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByContactAddress($value){
		$sql = 'DELETE FROM contact WHERE contact_address = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByContactTelephone($value){
		$sql = 'DELETE FROM contact WHERE contact_telephone = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByContactFax($value){
		$sql = 'DELETE FROM contact WHERE contact_fax = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByContactEmail($value){
		$sql = 'DELETE FROM contact WHERE contact_email = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return ContactMySql 
	 */
	protected function readRow($row){
		$contact = new Contact();
		
		$contact->contactId = $row['contact_id'];
		$contact->contactAddress = $row['contact_address'];
		$contact->contactTelephone = $row['contact_telephone'];
		$contact->contactFax = $row['contact_fax'];
		$contact->contactEmail = $row['contact_email'];

		return $contact;
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
	 * @return ContactMySql 
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