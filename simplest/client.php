<?php
	//Предотвращение кэширования страницы
	header("Cache-control: no-store, no-cache");
	header("Expires: ".date("r"));
	
	//Предотвращение кэширования WSDL-файла
	ini_set("soap.wsdl_cache_enabled","0");
	
	//Настройка информирования об ошибках
	ini_set("display_errors","1");
	error_reporting(E_ALL & ~E_NOTICE);
	
	
	//Создание объекта SOAP-клиента
	$client=new SoapClient(
		"http://$_SERVER[HTTP_HOST]/simplest/myservice.wsdl.php",
		array("soap_version"=>SOAP_1_2)
	);
	
	//Вызов удалённой процедуры GreetUser
	$resp=$client->GreetUser(Array("username"=>"Василий"));
	echo $resp->answer;
	