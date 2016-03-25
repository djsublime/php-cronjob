<?php 
require __DIR__.'/../boot.php';

//  >/dev/null 2>&1   ****** no output for crontab
// >/dev/null 2>&1 &   ****** Asynchronous shell exec in PHP / non blocking way

$scripts_path = app()['root'].app()['cronjobs'];

// get cronjob tasks
$tasks = get_config('task');

// exec each task width params
foreach($tasks as $pid => $task){

	if(!$task['active']) continue;

	// check run time
	if(!cj_runtime($task['date'],$task['time'])) continue;

	// add proccess if not already started
	if(!cj_proccess($pid,'add')) continue;


	//build exec command
	$script = $scripts_path.$task['script'];
	$argv = (is_array($task['argv'])) ? implode(' ', $task['argv']) : $task['argv'];
	$cmd = "php $script $argv >/dev/null 2>&1 &";

	exec($cmd);

}
