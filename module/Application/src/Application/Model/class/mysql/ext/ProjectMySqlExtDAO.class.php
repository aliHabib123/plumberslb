<?php
/**
 * Class that operate on table 'project'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-06-21 13:48
 */
class ProjectMySqlExtDAO extends ProjectMySqlDAO{

	public function getHomeProjects(){
		$txt ="select * from project where show_home = 1 order by project_order asc";
		$sqlQuery = new SqlQuery($txt);
		return $this->getList($sqlQuery);
	}
	public function getProjects($upcoming, $limit, $offset){
		$txt ="select * from project where upcoming = $upcoming order by project_order asc limit $limit offset $offset";
		$sqlQuery = new SqlQuery($txt);
		return $this->getList($sqlQuery);
	}
	public function getProjectsCount($upcoming){
		$txt ="select * from project where upcoming = $upcoming";
		$sqlQuery = new SqlQuery($txt);
		return $this->getList($sqlQuery);
	}
	public function getsearchProjects($keyword){
		$txt ="select * from project where project_title like '%$keyword%' or project_desc like '%$keyword%'";
		$sqlQuery = new SqlQuery($txt);
		return $this->getList($sqlQuery);
	}
}
?>