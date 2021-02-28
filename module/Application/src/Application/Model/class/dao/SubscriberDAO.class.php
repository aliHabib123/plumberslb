<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-06-21 13:48
 */
interface SubscriberDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Subscriber 
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
 	 * @param subscriber primary key
 	 */
	public function delete($subscriber_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Subscriber subscriber
 	 */
	public function insert($subscriber);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Subscriber subscriber
 	 */
	public function update($subscriber);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryBySubscriberName($value);

	public function queryBySubscriberEmail($value);

	public function queryByIsActive($value);


	public function deleteBySubscriberName($value);

	public function deleteBySubscriberEmail($value);

	public function deleteByIsActive($value);


}
?>