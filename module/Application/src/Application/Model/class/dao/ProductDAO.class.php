<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-06-21 13:48
 */
interface ProductDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Product 
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
 	 * @param product primary key
 	 */
	public function delete($product_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Product product
 	 */
	public function insert($product);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Product product
 	 */
	public function update($product);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByProductName($value);

	public function queryByProductDetails($value);

	public function queryByProductImg($value);

	public function queryByProductOrder($value);


	public function deleteByProductName($value);

	public function deleteByProductDetails($value);

	public function deleteByProductImg($value);

	public function deleteByProductOrder($value);


}
?>