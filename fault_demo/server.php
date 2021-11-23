<?php	
	header("Content-type: text/xml;charset=utf-8");
	header("Cache-Control: no-store, no-cache");
	header("Expires: ".date("r"));
	
	ini_set("soap.wsdl_cache_enabled","0");
	
	class myservice {
		public function GreetUser($args) {
			
			if($args->age<18)
				throw new SoapFault("server","You are too young to be greeted [{$args->age}]");
			
			return Array("answer"=>"Hello, {$args->username} !");
		}
	}
	
	$server=new SoapServer("http://$_SERVER[HTTP_HOST]/fault_demo/myservice.wsdl.php");
	
	$server->setClass("myservice");
	
	$server->handle();
