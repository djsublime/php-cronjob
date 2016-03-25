<?php 
require __DIR__.'/../../boot.php';

/* start of every task must have this*/

$stats = array(
    'time'=>array(),
    'memory'=>array(),
    'errors'=>array()
    );

$stats['time']['start'] = microtime(true);
$stats['memory']['start'] = convert(memory_get_usage());

$pid = (isset($_GET['pid']))? $_GET['pid'] : $argv[1];
$delay = (isset($_GET['delay']))? $_GET['delay'] : $argv[2];

sleep($delay);

/* end of start of every task must have this*/


$logger = new Logger;

$logger->setPath(app()['root'].app()['cronjobs_storage'].'test/');

$logger->add('first line');
$logger->add('second line');

$logger->write('test.log');


/* end of every task must have this */

cj_proccess($pid,'kill');

/* end of end of every task must have this */

?>