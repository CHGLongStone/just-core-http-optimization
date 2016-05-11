<?php
/**
 * ASSETIC WRAPPER 
 * https://github.com/kriswallsmith/assetic
 *  
 * 
 * @author	Jason Medland<jason.medland@gmail.com>
 * @package	SERVICE\METRONIC\ASSETIC
 * @subpackage	
 */
 
 

namespace JCORE\SERVICE\HTTP_OPTIMIZATION\ASSETIC;

#use JCORE\TRANSPORT\SOA\SOA_BASE as SOA_BASE;
#use JCORE\DAO\DAO as DAO;
/*
use Assetic\AssetManager;
use Assetic\AssetWriter;
use Assetic\Asset\AssetCollection;
use Assetic\Asset\FileAsset;
use Assetic\Asset\GlobAsset;
use Assetic\Asset\HttpAsset;
use Assetic\Asset\StringAsset;
use Assetic\Asset\AssetCache;
*/


/**
 * Class ASSETIC_WRAPPER
 *
 * @package JCORE\SERVICE\HTTP_OPTIMIZATION\ASSETIC
*/
class ASSETIC_WRAPPER { 

	/** 
	* 
	*/
	public $config = array(
		'LOAD_ID' => 'ROUTES',
	);
	/** 
	* 
	*/
	public $cacheDir = 'CACHE/HTTP/';
	

	/** 
	* 
	*/
	private $CACHE_PATH = 'CACHE/HTTP/';
	
	
	/**
	* DESCRIPTOR: an empty constructor, the service MUST be called with 
	* the service name and the service method name specified in the 
	* in the method property of the JSONRPC request in this format
	* 		""method":"AJAX_STUB.aServiceMethod"
	* 
	* @param param 
	* @return return  
	*/
	public function __construct($args=null){
		$this->CACHE_PATH = $GLOBAS["APPLICATION_ROOT"].$this->CACHE_PATH;
		echo __METHOD__.'@'.__LINE__.'$this->CACHE_PATH<pre>['.var_export($this->CACHE_PATH, true).']</pre>'.'<br>'.PHP_EOL; 
		if(is_dir($this->CACHE_PATH)){
			echo __METHOD__.'@'.__LINE__.'$this->CACHE_PATH<pre>['.var_export($this->CACHE_PATH, true).']</pre>'.'<br>'.PHP_EOL; 
		}else{
			
			echo __METHOD__.'@'.__LINE__.'$this->CACHE_PATH<pre>['.var_export($this->CACHE_PATH, true).']</pre>'.'<br>'.PHP_EOL; 
			return 'dafuq!';
		}
		
		#$this->config = $GLOBALS['CONFIG_MANAGER']->getSetting($LOAD_ID = 'METRONIC', $SECTION_NAME = 'ROUTES');
		
		return;
	}
	/**
	* DESCRIPTOR: an example namespace call 
	* @param param 
	* @return return  
	*/
	public function init($args=null){
		
	
		return;
	}

	

}



?>