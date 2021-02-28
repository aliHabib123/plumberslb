<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-06-21 13:48
 */
interface TbNewsDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return TbNews 
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
 	 * @param tbNew primary key
 	 */
	public function delete($tb_news_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param TbNews tbNew
 	 */
	public function insert($tbNew);
	
	/**
 	 * Update record in table
 	 *
 	 * @param TbNews tbNew
 	 */
	public function update($tbNew);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByTbNewsTitle($value);

	public function queryByTbNewsDetails($value);

	public function queryByTbNewsDate($value);

	public function queryByTbNewsImg($value);


	public function deleteByTbNewsTitle($value);

	public function deleteByTbNewsDetails($value);

	public function deleteByTbNewsDate($value);

	public function deleteByTbNewsImg($value);


}
?>