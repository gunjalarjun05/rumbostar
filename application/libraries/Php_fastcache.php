<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	Library Name : Social_media
	Description	: This library containg social media login,sharing post using php sdk and restfull api
*/
include_once(APPPATH."third_party/phpfastcache/src/autoload.php"); 
use phpFastCache\CacheManager;
use phpFastCache\Core\phpFastCache;

class Php_fastcache{
	var $CI;
	public function __construct(){
		 $this->CI =& get_instance();
		  $this->CI->load->library('session');

		  CacheManager::setDefaultConfig([ 
		  "path" => sys_get_temp_dir(),
		]);
		 $this->InstanceCache = CacheManager::getInstance('sqlite');
	}

	public function setData($key,$data){
		$CachedString = $this->InstanceCache->getItem($key);
		$json_encode = json_encode($data);
		$CachedString->set($json_encode)->expiresAfter(3600*2);
		$this->InstanceCache->save($CachedString);
		$final_resc = $CachedString->get();		
		return $final_resc;
	}

	public function getData($key){
		$CachedString = $this->InstanceCache->getItem($key);
		return $CachedString->get();
		//return $CachedString->get();
	}
	

}
?>
