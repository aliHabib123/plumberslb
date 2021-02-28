<?php
/**
 * Class that operate on table 'service'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-06-21 13:48
 */
class ServiceMySqlDAO implements ServiceDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return ServiceMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM service WHERE service_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM service';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM service ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param service primary key
 	 */
	public function delete($service_id){
		$sql = 'DELETE FROM service WHERE service_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($service_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ServiceMySql service
 	 */
	public function insert($service){
		$sql = 'INSERT INTO service (service_title, service_details, service_icon, service_image, service_order, show_home) VALUES (?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($service->serviceTitle);
		$sqlQuery->set($service->serviceDetails);
		$sqlQuery->set($service->serviceIcon);
		$sqlQuery->set($service->serviceImage);
		$sqlQuery->setNumber($service->serviceOrder);
		$sqlQuery->setNumber($service->showHome);

		$id = $this->executeInsert($sqlQuery);	
		$service->serviceId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param ServiceMySql service
 	 */
	public function update($service){
		$sql = 'UPDATE service SET service_title = ?, service_details = ?, service_icon = ?, service_image = ?, service_order = ?, show_home = ? WHERE service_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($service->serviceTitle);
		$sqlQuery->set($service->serviceDetails);
		$sqlQuery->set($service->serviceIcon);
		$sqlQuery->set($service->serviceImage);
		$sqlQuery->setNumber($service->serviceOrder);
		$sqlQuery->setNumber($service->showHome);

		$sqlQuery->setNumber($service->serviceId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM service';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByServiceTitle($value){
		$sql = 'SELECT * FROM service WHERE service_title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByServiceDetails($value){
		$sql = 'SELECT * FROM service WHERE service_details = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByServiceIcon($value){
		$sql = 'SELECT * FROM service WHERE service_icon = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByServiceImage($value){
		$sql = 'SELECT * FROM service WHERE service_image = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByServiceOrder($value){
		$sql = 'SELECT * FROM service WHERE service_order = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByShowHome($value){
		$sql = 'SELECT * FROM service WHERE show_home = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByServiceTitle($value){
		$sql = 'DELETE FROM service WHERE service_title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByServiceDetails($value){
		$sql = 'DELETE FROM service WHERE service_details = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByServiceIcon($value){
		$sql = 'DELETE FROM service WHERE service_icon = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByServiceImage($value){
		$sql = 'DELETE FROM service WHERE service_image = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByServiceOrder($value){
		$sql = 'DELETE FROM service WHERE service_order = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByShowHome($value){
		$sql = 'DELETE FROM service WHERE show_home = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return ServiceMySql 
	 */
	protected function readRow($row){
		$service = new Service();
		
		$service->serviceId = $row['service_id'];
		$service->serviceTitle = $row['service_title'];
		$service->serviceDetails = $row['service_details'];
		$service->serviceIcon = $row['service_icon'];
		$service->serviceImage = $row['service_image'];
		$service->serviceOrder = $row['service_order'];
		$service->showHome = $row['show_home'];

		return $service;
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
	 * @return ServiceMySql 
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