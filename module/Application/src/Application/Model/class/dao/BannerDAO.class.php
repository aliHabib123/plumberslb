<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-06-21 13:48
 */
interface BannerDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Banner 
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
 	 * @param banner primary key
 	 */
	public function delete($banner_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Banner banner
 	 */
	public function insert($banner);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Banner banner
 	 */
	public function update($banner);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByBannerImg($value);

	public function queryByBannerTitle($value);

	public function queryByBannerDetails($value);

	public function queryBySectionId($value);


	public function deleteByBannerImg($value);

	public function deleteByBannerTitle($value);

	public function deleteByBannerDetails($value);

	public function deleteBySectionId($value);


}
?>