<?php

function app(){

	return array(

	    'environment' => 'local',

	    'debug' => true,

	    'TZD' => '+01:00',

	    'root' => realpath( dirname( __FILE__ ) ).'/',

	    'config' => 'app/config/',

	    'libs' => 'app/libs/',

	    'public' => 'public/',

	    'cronjobs' => 'cronjobs/',
	    
	    'cronjobs_storage' => 'storage/'
	       
	);
};

function get_config($file){

	$env = app()['root'].app()['config'].app()['environment'].'/';

	$fileName = $file.'.php';

	if(!file_exists($env.$fileName)){

		$env = app()['root'].app()['config'];
	}

	return include $env.$fileName;
}

function get_logs($path,$order = 0){

	$logs = scandir($path,$order);

	foreach($logs as $k => $log){

		if(substr( $log, 0, 1 ) === "."){

			unset($logs[$k]);
		}
	}

	return $logs;
}

function cj_proccess($pid,$method){

	$proccess_path = app()['root'].app()['cronjobs_storage'].'_PID/';

	if($method == 'add'){

		if(!is_dir($proccess_path)) mkdir($proccess_path, 0777, true);

		$pid = (!file_exists($proccess_path.$pid))? touch($proccess_path.$pid): false;
		

	}elseif($method == 'kill'){

		unlink($proccess_path.$pid);

	}
	
	return $pid;
}

function cj_runtime($date,$time){

	// ISO 8601 datetime standard

	$TZD = app('TZD');

	$date = ($date)? $date: date('Y-m-d');

	return (strtotime($date.'T'.$time.$TZD) == strtotime(date('Y-m-dTH:i'.$TZD)))? true : false;
}

spl_autoload_register(function ($class) {
    include app()['libs'].'/'.$class . '.php';
});

