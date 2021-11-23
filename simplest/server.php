<?php	
	header("Content-type: text/xml;charset=utf-8");
	header("Cache-Control: no-store, no-cache");
	header("Expires: ".date("r"));
	
	ini_set("soap.wsdl_cache_enabled","0");
	
	class myservice {
		public function GreetUser($args) {
		return Array("answer"=>"Hello, {$args->username} !");
		}
	}
	
	$server=new SoapServer("http://$_SERVER[HTTP_HOST]/simplest/myservice.wsdl.php");
	
	$server->setClass("myservice");
	
	$server->handle();
