<?php
/**
 * Class that operate on table 'project'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-06-21 13:48
 */
class ProjectMySqlDAO implements ProjectDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return ProjectMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM project WHERE project_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM project';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM project ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param project primary key
 	 */
	public function delete($project_id){
		$sql = 'DELETE FROM project WHERE project_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($project_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ProjectMySql project
 	 */
	public function insert($project){
		$sql = 'INSERT INTO project (project_title, project_desc, project_img, project_order) VALUES (?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($project->projectTitle);
		$sqlQuery->set($project->projectDesc);
		$sqlQuery->set($project->projectImg);
		$sqlQuery->setNumber($project->projectOrder);

		$id = $this->executeInsert($sqlQuery);	
		$project->projectId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param ProjectMySql project
 	 */
	public function update($project){
		$sql = 'UPDATE project SET project_title = ?, project_desc = ?, project_img = ?, project_order = ? WHERE project_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($project->projectTitle);
		$sqlQuery->set($project->projectDesc);
		$sqlQuery->set($project->projectImg);
		$sqlQuery->setNumber($project->projectOrder);

		$sqlQuery->setNumber($project->projectId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM project';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByProjectTitle($value){
		$sql = 'SELECT * FROM project WHERE project_title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByProjectDesc($value){
		$sql = 'SELECT * FROM project WHERE project_desc = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByProjectImg($value){
		$sql = 'SELECT * FROM project WHERE project_img = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByProjectOrder($value){
		$sql = 'SELECT * FROM project WHERE project_order = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByProjectTitle($value){
		$sql = 'DELETE FROM project WHERE project_title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByProjectDesc($value){
		$sql = 'DELETE FROM project WHERE project_desc = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByProjectImg($value){
		$sql = 'DELETE FROM project WHERE project_img = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByProjectOrder($value){
		$sql = 'DELETE FROM project WHERE project_order = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return ProjectMySql 
	 */
	protected function readRow($row){
		$project = new Project();
		
		$project->projectId = $row['project_id'];
		$project->projectTitle = $row['project_title'];
		$project->projectDesc = $row['project_desc'];
		$project->projectImg = $row['project_img'];
		$project->projectOrder = $row['project_order'];
		$project->showHome = $row['show_home'];

		return $project;
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
	 * @return ProjectMySql 
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