<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-06-21 13:48
 */
interface ServiceDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Service 
	 */
	public function load($id);

	/**
	 * Get all records from table
	 */
	public function queryAll();
	
	/**
	 * Get all records from table ordered by field
	 * @Param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn);
	
	/**
 	 * Delete record from table
 	 * @param service primary key
 	 */
	public function delete($service_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Service service
 	 */
	public function insert($service);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Service service
 	 */
	public function update($service);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByServiceTitle($value);

	public function queryByServiceDetails($value);

	public function queryByServiceIcon($value);

	public function queryByServiceImage($value);

	public function queryByServiceOrder($value);

	public function queryByShowHome($value);


	public function deleteByServiceTitle($value);

	public function deleteByServiceDetails($value);

	public function deleteByServiceIcon($value);

	public function deleteByServiceImage($value);

	public function deleteByServiceOrder($value);

	public function deleteByShowHome($value);


}
?>