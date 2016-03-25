<?php

return array(
    
    'test_1' => array(

        'active' => true,
        
        'date' => '2016-03-25', // if false task is run on daily schedule

        'time' => '17:59',

        'script' => 'test/testCron.php',

        'argv' => array(

            'pid' => 'test_1',

            'delay' => 5
        ),
        
        'callback' => false // call some script after current task 
    ),

    'test_2' => array(

        'active' => true,

        'date' => false,

        'time' => '19:55',

        'script' => 'test/testCron.php',

        'argv' => array(

            'pid' => 'test_2',

            'delay' => 3
        ),

        'callback' => false
    )
);