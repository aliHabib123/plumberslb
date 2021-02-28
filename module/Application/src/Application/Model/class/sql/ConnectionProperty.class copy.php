<?php
/**
 * Connection properties
 *
 * @author: http://phpdao.com
 * @date: 27.11.2007
 */
class ConnectionProperty{
	private static $host = '127.0.0.1';
	private static $user = 'root';
	private static $password = '';
	private static $database = 'plumbers';
	
	//online
	/*
	private static $host = '127.0.0.1';
	private static $user = 'thirteen_plumber';
	private static $password = '%=m+5-]kQc.H';
	private static $database = 'thirteen_plumbers';
	*/

	public static function getHost(){
		return ConnectionProperty::$host;
	}

	public static function getUser(){
		return ConnectionProperty::$user;
	}

	public static function getPassword(){
		return ConnectionProperty::$password;
	}

	public static function getDatabase(){
		return ConnectionProperty::$database;
	}
}
?>