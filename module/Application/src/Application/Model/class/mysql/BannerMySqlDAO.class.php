<?php
/**
 * Class that operate on table 'banner'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-06-21 13:48
 */
class BannerMySqlDAO implements BannerDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return BannerMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM banner WHERE banner_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM banner';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM banner ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param banner primary key
 	 */
	public function delete($banner_id){
		$sql = 'DELETE FROM banner WHERE banner_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($banner_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param BannerMySql banner
 	 */
	public function insert($banner){
		$sql = 'INSERT INTO banner (banner_img, banner_title, banner_details, section_id) VALUES (?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($banner->bannerImg);
		$sqlQuery->set($banner->bannerTitle);
		$sqlQuery->set($banner->bannerDetails);
		$sqlQuery->setNumber($banner->sectionId);

		$id = $this->executeInsert($sqlQuery);	
		$banner->bannerId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param BannerMySql banner
 	 */
	public function update($banner){
		$sql = 'UPDATE banner SET banner_img = ?, banner_title = ?, banner_details = ?, section_id = ? WHERE banner_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($banner->bannerImg);
		$sqlQuery->set($banner->bannerTitle);
		$sqlQuery->set($banner->bannerDetails);
		$sqlQuery->setNumber($banner->sectionId);

		$sqlQuery->setNumber($banner->bannerId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM banner';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByBannerImg($value){
		$sql = 'SELECT * FROM banner WHERE banner_img = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByBannerTitle($value){
		$sql = 'SELECT * FROM banner WHERE banner_title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByBannerDetails($value){
		$sql = 'SELECT * FROM banner WHERE banner_details = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryBySectionId($value){
		$sql = 'SELECT * FROM banner WHERE section_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByBannerImg($value){
		$sql = 'DELETE FROM banner WHERE banner_img = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByBannerTitle($value){
		$sql = 'DELETE FROM banner WHERE banner_title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByBannerDetails($value){
		$sql = 'DELETE FROM banner WHERE banner_details = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteBySectionId($value){
		$sql = 'DELETE FROM banner WHERE section_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return BannerMySql 
	 */
	protected function readRow($row){
		$banner = new Banner();
		
		$banner->bannerId = $row['banner_id'];
		$banner->bannerImg = $row['banner_img'];
		$banner->bannerTitle = $row['banner_title'];
		$banner->bannerDetails = $row['banner_details'];
		$banner->sectionId = $row['section_id'];

		return $banner;
	}
	
	protected function getList($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		$ret = array();
		for($i=0;$i<count($tab);$i++){
			$ret[$i] = $this->readRow($tab[$i]);
		}
		return $ret;
	}
	
	/**
	 * Get row
	 *
	 * @return BannerMySql 
	 */
	protected function getRow($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		if(count($tab)==0){
			return null;
		}
		return $this->readRow($tab[0]);		
	}
	
	/**
	 * Execute sql query
	 */
	protected function execute($sqlQuery){
		return QueryExecutor::execute($sqlQuery);
	}
	
		
	/**
	 * Execute sql query
	 */
	protected function executeUpdate($sqlQuery){
		return QueryExecutor::executeUpdate($sqlQuery);
	}

	/**
	 * Query for one row and one column
	 */
	protected function querySingleResult($sqlQuery){
		return QueryExecutor::queryForString($sqlQuery);
	}

	/**
	 * Insert row to table
	 */
	protected function executeInsert($sqlQuery){
		return QueryExecutor::executeInsert($sqlQuery);
	}
}
?>