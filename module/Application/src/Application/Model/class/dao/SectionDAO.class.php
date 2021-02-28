<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-06-21 13:48
 */
interface SectionDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Section 
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
 	 * @param section primary key
 	 */
	public function delete($section_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Section section
 	 */
	public function insert($section);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Section section
 	 */
	public function update($section);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryBySectionName($value);

	public function queryBySectionTitle($value);


	public function deleteBySectionName($value);

	public function deleteBySectionTitle($value);


}
?>