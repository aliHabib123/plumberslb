<?php
/**
 * Class that operate on table 'product'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2016-06-21 13:48
 */
class ProductMySqlDAO implements ProductDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return ProductMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM product WHERE product_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM product';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM product ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param product primary key
 	 */
	public function delete($product_id){
		$sql = 'DELETE FROM product WHERE product_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($product_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ProductMySql product
 	 */
	public function insert($product){
		$sql = 'INSERT INTO product (product_name, product_details, product_img, product_order) VALUES (?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($product->productName);
		$sqlQuery->set($product->productDetails);
		$sqlQuery->set($product->productImg);
		$sqlQuery->setNumber($product->productOrder);

		$id = $this->executeInsert($sqlQuery);	
		$product->productId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param ProductMySql product
 	 */
	public function update($product){
		$sql = 'UPDATE product SET product_name = ?, product_details = ?, product_img = ?, product_order = ? WHERE product_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($product->productName);
		$sqlQuery->set($product->productDetails);
		$sqlQuery->set($product->productImg);
		$sqlQuery->setNumber($product->productOrder);

		$sqlQuery->setNumber($product->productId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM product';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByProductName($value){
		$sql = 'SELECT * FROM product WHERE product_name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByProductDetails($value){
		$sql = 'SELECT * FROM product WHERE product_details = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByProductImg($value){
		$sql = 'SELECT * FROM product WHERE product_img = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByProductOrder($value){
		$sql = 'SELECT * FROM product WHERE product_order = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByProductName($value){
		$sql = 'DELETE FROM product WHERE product_name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByProductDetails($value){
		$sql = 'DELETE FROM product WHERE product_details = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByProductImg($value){
		$sql = 'DELETE FROM product WHERE product_img = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByProductOrder($value){
		$sql = 'DELETE FROM product WHERE product_order = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return ProductMySql 
	 */
	protected function readRow($row){
		$product = new Product();
		
		$product->productId = $row['product_id'];
		$product->productName = $row['product_name'];
		$product->productDetails = $row['product_details'];
		$product->productImg = $row['product_img'];
		$product->productOrder = $row['product_order'];

		return $product;
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
	 * @return ProductMySql 
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