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
*/
use Assetic\AssetManager AS AssetManager;
use Assetic\AssetWriter AS AssetWriter;
use Assetic\Asset\AssetCollection AS AssetCollection;
use Assetic\Asset\FileAsset AS FileAsset;
use Assetic\Asset\GlobAsset AS GlobAsset;
use Assetic\Asset\HttpAsset AS HttpAsset;
use Assetic\Asset\StringAsset AS StringAsset;
use Assetic\Asset\AssetCache AS AssetCache;


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
	private $HTTP_PATH = 'assets/cache/';
	
	
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
		
		$this->FULL_CACHE_PATH = $GLOBALS["APPLICATION_ROOT"].$this->CACHE_PATH;
		if(isset($args["FULL_CACHE_PATH"]) || '' != $args["FULL_CACHE_PATH"]){
			$this->FULL_CACHE_PATH = $args["FULL_CACHE_PATH"];
		}
		/*
		$_SERVER["DOCUMENT_ROOT"]
		$_SERVER["HTTP_HOST"]
		*/
		
		$this->FULL_HTTP_PATH = $this->HTTP_PATH;
		if(isset($args["FULL_HTTP_PATH"]) || '' != $args["FULL_HTTP_PATH"]){
			$this->FULL_HTTP_PATH = $args["FULL_HTTP_PATH"];
		}
		
		
		
		/*
		echo __METHOD__.'@'.__LINE__.'$this->CACHE_PATH<pre>['.var_export($this->CACHE_PATH, true).']</pre>'.'<br>'.PHP_EOL; 
		echo __METHOD__.'@'.__LINE__.'  _SERVER<pre>['.var_export($_SERVER, true).']</pre> '.'<br>'.PHP_EOL; 
		echo __METHOD__.'@'.__LINE__.'EXISTS $this->CACHE_PATH<pre>['.var_export($this->CACHE_PATH, true).']</pre>'.'<br>'.PHP_EOL; 
		*/
		if(!is_dir($this->FULL_CACHE_PATH)){
			return '$this->CACHE_PATH ['.$this->CACHE_PATH."] doesn't exist ";
		}
		if(!is_dir($_SERVER["DOCUMENT_ROOT"].$this->HTTP_PATH)){
			return '$this->HTTP_PATH ['.$this->HTTP_PATH."] doesn't exist ";
		}
		
		$this->config = $GLOBALS['CONFIG_MANAGER']->getSetting($LOAD_ID = 'METRONIC', $SECTION_NAME = 'ROUTES');
		
		return false;
	}
	/**
	* DESCRIPTOR: an example namespace call 
	* @param param 
	* @return return  
	*/
	public function init($args=null){
		
	
		return;
	}
	/**
	*
	*/
	public function checkCompiled($args=null){
		
		$passCMD = 'ls -lah '.$this->FULL_CACHE_PATH;
		#$passResult = null;
		$passResult = shell_exec($passCMD);
		$hashResult = md5($passResult);
		
		$this->lastHash = '';
		if(is_file($this->FULL_CACHE_PATH.'compiled.hash')){
			$this->lastHash = file_get_contents($this->CACHE_PATH.'compiled.hash');
		}
		
		if($this->lastHash != $hashResult){
			file_put_contents($this->CACHE_PATH.'compiled.hash', $hashResult);
			return $hashResult;
		}
		return false;
	}
	/**
	* DESCRIPTOR: an example namespace call 
	* @param param 
	* @return return  
	*/
	public function cacheCSS($args=null){
		#, $name=null, $collection=null
		if(!is_array($args) || 0 == count($args) ){
			return '$args not array or empty is_array($args)['.is_array($args).'] count($args)['.count($args).']  ';
		}
		if(!is_array($args["collection"]) || 0 == count($args["collection"]) ){
			return '$args["collection"] not array or empty is_array($args)['.is_array($args["collection"]).'] count($args)['.count($args["collection"]).'] ';
		}
		if(!is_scalar($args["name"]) || '' == $args["name"] ){
			return '$args["name"] not scalar or empty ['.$args["name"].']';
		}
		$filename = $args["name"];
		if(!is_scalar($args["route"]) || '' != $args["route"] ){
			if(false !== stripos($this->FULL_HTTP_PATH, 'http')){
				/**************************************/
				echo 'http exists in this->FULL_HTTP_PATH ['.$this->FULL_HTTP_PATH.'] need to handle it';
			}
			$filename = $filename.'_'.$args["route"];
			
		}
		
		
		$AssetCollection = array();
		foreach($args["collection"] AS $key => $value){
			echo __METHOD__.'@'.__LINE__.'  key['.$key.']<pre>['.var_export(array_keys($value), true).']</pre> '.'<br>'.PHP_EOL; 
			foreach($value AS $key2 => $value2){
				echo __METHOD__.'@'.__LINE__.'  key2['.$key2.']<pre>['.var_export(array_keys($value2), true).']</pre> '.'<br>'.PHP_EOL; 
				/*
				if(false !== stripos($value["HREF"], 'http')){
					$AssetCollection[] = new HttpAsset($value2["HREF"], array();//new Assetic\Filter\LessFilter())
				}else{
					$AssetCollection[] = new FileAsset($value2["HREF"], array();//new LessFilter())
				}
				*/
				
			}
			
		}
		echo __METHOD__.'@'.__LINE__.'  AssetCollection<pre>['.var_export($AssetCollection, true).']</pre> '.'<br>'.PHP_EOL; 
		
		$Filter = array();
		$css = new AssetCollection($AssetCollection, $Filter);
		/*
		$css = new AssetCollection(array(
			new FileAsset('/path/to/src/styles.less', array(new LessFilter())),
			new GlobAsset('/path/to/css/*'),
		), array(
			new Yui\CssCompressorFilter('/path/to/yuicompressor.jar'),
		));
		*/
		#$this->FULL_HTTP_PATH
		
		$fileContents = $css->dump();
		#$result = file_put_contents($this->settings["writePath"].$logDate, $this->traceString, FILE_APPEND | LOCK_EX);
		$result = file_put_contents($this->HTTP_PATH.$filename, $fileContents);
		echo __METHOD__.'@'.__LINE__.'  result<pre>['.var_export($result, true).']</pre> '.'<br>'.PHP_EOL; 
		/*
		$writer = new AssetWriter('/path/to/web');
		$writer->writeManagerAssets($am);
		use Assetic\AssetWriter;

		$writer = new AssetWriter('/path/to/web');
		$writer->writeManagerAssets($am);
		*/
		return;
	}
	/**
	* DESCRIPTOR: an example namespace call 
	* @param param 
	* @return return  
	*/
	public function cacheJS($args=null){
		
	
		return;
	}

	

}



?>