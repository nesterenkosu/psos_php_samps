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
		"http://$_SERVER[HTTP_HOST]/fault_demo/myservice.wsdl.php",
		array(
			"soap_version"=>SOAP_1_2,
			"trace"=>1 //включен режим отладки
		)
	);
	
	try {
		//Вызов удалённой процедуры GreetUser
		$resp=$client->GreetUser(Array("age"=>3,"username"=>"Василий"));
		echo $resp->answer;
	}catch(SoapFault $ex) {
		echo "Произошла ошибка SoapFault:<br/>";
		echo "Код: {$ex->faultcode}<br/>";
		echo "Описание: {$ex->faultstring}<br/>";	
		
		//Вывод сообщений SOAP-запроса и SOAP-ответа
		echo "<xmp>";
		echo "Запрос:\n";
		echo $client->__getLastRequestHeaders()."\n";
		echo $client->__getLastRequest()."\n";
		
		echo "Ответ:\n";
		echo $client->__getLastResponseHeaders()."\n";
		echo $client->__getLastResponse();
		echo "</xmp>";
	}
	