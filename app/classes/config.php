<?php 
class Config{
	
	function filePath(){
		return "gs://".getenv("GOOGLE_STORAGE_BUCKET");
	}
	
	function dbPath(){
		return dirname(__FILE__).'/../res/db.php';
	}
}