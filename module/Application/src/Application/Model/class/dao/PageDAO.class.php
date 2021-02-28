<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-06-21 13:48
 */
interface PageDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Page 
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
 	 * @param page primary key
 	 */
	public function delete($page_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Page page
 	 */
	public function insert($page);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Page page
 	 */
	public function update($page);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByPageName($value);

	public function queryByPageTitle($value);

	public function queryByPageDetails($value);

	public function queryByPageImg($value);


	public function deleteByPageName($value);

	public function deleteByPageTitle($value);

	public function deleteByPageDetails($value);

	public function deleteByPageImg($value);


}
?>