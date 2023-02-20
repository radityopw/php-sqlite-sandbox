<?php 
class Config{
	
	function keyAuth(){
		return "randomK3y";
	}
	
	function filePath(){
		return "gs://".getenv("GOOGLE_STORAGE_BUCKET");
	}
	
	function dbPath(){
		return dirname(__FILE__).'/../res/db.php';
	}
	
	function projectId(){
		return getenv("GOOGLE_PROJECT_ID");
	}
}