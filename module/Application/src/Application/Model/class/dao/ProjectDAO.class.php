<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-06-21 13:48
 */
interface ProjectDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Project 
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
 	 * @param project primary key
 	 */
	public function delete($project_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Project project
 	 */
	public function insert($project);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Project project
 	 */
	public function update($project);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByProjectTitle($value);

	public function queryByProjectDesc($value);

	public function queryByProjectImg($value);

	public function queryByProjectOrder($value);


	public function deleteByProjectTitle($value);

	public function deleteByProjectDesc($value);

	public function deleteByProjectImg($value);

	public function deleteByProjectOrder($value);


}
?>