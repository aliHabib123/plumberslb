<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2016-06-21 13:48
 */
interface SocialDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Social 
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
 	 * @param social primary key
 	 */
	public function delete($social_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Social social
 	 */
	public function insert($social);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Social social
 	 */
	public function update($social);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryBySocialFacebook($value);

	public function queryBySocialTwitter($value);

	public function queryBySocialLinkedin($value);

	public function queryBySocialYoutube($value);

	public function queryBySocialInstagram($value);


	public function deleteBySocialFacebook($value);

	public function deleteBySocialTwitter($value);

	public function deleteBySocialLinkedin($value);

	public function deleteBySocialYoutube($value);

	public function deleteBySocialInstagram($value);


}
?>