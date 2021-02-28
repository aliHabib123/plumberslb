<?php
/**
 * Class that operate on table 'social'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-06-21 13:48
 */
class SocialMySqlDAO implements SocialDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return SocialMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM social WHERE social_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM social';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM social ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param social primary key
 	 */
	public function delete($social_id){
		$sql = 'DELETE FROM social WHERE social_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($social_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param SocialMySql social
 	 */
	public function insert($social){
		$sql = 'INSERT INTO social (social_facebook, social_twitter, social_linkedin, social_youtube, social_instagram) VALUES (?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($social->socialFacebook);
		$sqlQuery->set($social->socialTwitter);
		$sqlQuery->set($social->socialLinkedin);
		$sqlQuery->set($social->socialYoutube);
		$sqlQuery->set($social->socialInstagram);

		$id = $this->executeInsert($sqlQuery);	
		$social->socialId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param SocialMySql social
 	 */
	public function update($social){
		$sql = 'UPDATE social SET social_facebook = ?, social_twitter = ?, social_linkedin = ?, social_youtube = ?, social_instagram = ? WHERE social_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($social->socialFacebook);
		$sqlQuery->set($social->socialTwitter);
		$sqlQuery->set($social->socialLinkedin);
		$sqlQuery->set($social->socialYoutube);
		$sqlQuery->set($social->socialInstagram);

		$sqlQuery->setNumber($social->socialId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM social';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryBySocialFacebook($value){
		$sql = 'SELECT * FROM social WHERE social_facebook = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryBySocialTwitter($value){
		$sql = 'SELECT * FROM social WHERE social_twitter = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryBySocialLinkedin($value){
		$sql = 'SELECT * FROM social WHERE social_linkedin = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryBySocialYoutube($value){
		$sql = 'SELECT * FROM social WHERE social_youtube = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryBySocialInstagram($value){
		$sql = 'SELECT * FROM social WHERE social_instagram = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteBySocialFacebook($value){
		$sql = 'DELETE FROM social WHERE social_facebook = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteBySocialTwitter($value){
		$sql = 'DELETE FROM social WHERE social_twitter = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteBySocialLinkedin($value){
		$sql = 'DELETE FROM social WHERE social_linkedin = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteBySocialYoutube($value){
		$sql = 'DELETE FROM social WHERE social_youtube = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteBySocialInstagram($value){
		$sql = 'DELETE FROM social WHERE social_instagram = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return SocialMySql 
	 */
	protected function readRow($row){
		$social = new Social();
		
		$social->socialId = $row['social_id'];
		$social->socialFacebook = $row['social_facebook'];
		$social->socialTwitter = $row['social_twitter'];
		$social->socialLinkedin = $row['social_linkedin'];
		$social->socialYoutube = $row['social_youtube'];
		$social->socialInstagram = $row['social_instagram'];

		return $social;
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
	 * @return SocialMySql 
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