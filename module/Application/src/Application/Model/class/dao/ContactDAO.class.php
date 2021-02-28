<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-06-21 13:48
 */
interface ContactDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Contact 
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
 	 * @param contact primary key
 	 */
	public function delete($contact_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Contact contact
 	 */
	public function insert($contact);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Contact contact
 	 */
	public function update($contact);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByContactAddress($value);

	public function queryByContactTelephone($value);

	public function queryByContactFax($value);

	public function queryByContactEmail($value);


	public function deleteByContactAddress($value);

	public function deleteByContactTelephone($value);

	public function deleteByContactFax($value);

	public function deleteByContactEmail($value);


}
?>