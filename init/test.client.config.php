<?php
/**
 * Host of frontend API application containing primary database
 */
\Config::write('api_protocol', 'http');
\Config::write('api_endpoint', 'tsunami.dev');

/**
 * Keys to provide a secure connection to the frontend API application
 */
\Config::write('public_key', '[REMOTE FRONTED API KEY]');
\Config::write('private_key', '[REMOTE FRONTED API PRIVATE KEY]');

/**
 * Configuration for RabbitMQ/AMQP support
 */
\Config::write('amqp_host', 'rabbitmq.tsunami.dev');
\Config::write('amqp_port', '5677');
\Config::write('amqp_user', 'guest');
\Config::write('amqp_password', 'ieL0eh2Sing1');
\Config::write('amqp_exchange', 'jobs');
\Config::write('amqp_node_queue', 'jobs_v1');

//
require_once FS_ROOT . FS_DS . 'application' . FS_DS . 'sdk' . FS_DS . 'curl.php';
require_once FS_ROOT . FS_DS . 'application' . FS_DS . 'sdk' . FS_DS . 'signet.php';
require_once FS_ROOT . FS_DS . 'application' . FS_DS . 'sdk' . FS_DS . 'apiclient.php';
require_once FS_ROOT . FS_DS . 'application' . FS_DS . 'sdk' . FS_DS . 'api_0_1.php';

/**
 * Date and time settings
 */
\Config::write('default_timezone', 'America/Los_Angeles');

\Config::write('available_operations', array(
   
    'vendors' => array(
        'add' => array(
            'hostname' => false,
            'request_method' => false,
        ),
        'enable' => array(
            'hostname' => false,
            'request_method' => false,
        ),
        'disable' => array(
            'hostname' => false,
            'request_method' => false,
        ),
        'attach_carrier' => array(
            'vendor' => false,
            'carrier' => false,
            'request_method' => false,
        ),
        'detach_carrier' => array(
            'vendor' => false,
            'carrier' => false,
            'request_method' => false,
        ),
    ),
    'query' => array(
        'add' => array(
            'esn' => false,
            'carrier' => false,
            'carrier_id' => false,
            'user_id' => false,
            'force' => false,
            'sealed' => false,
        ),
        'bulk_add' => array(
            'esns' => false,
            'carrier_id' => false,
            'user_id' => false,
            'force' => false,
            'sealed' => false,
        ),
        'cancel' => array(
            'esn' => false,
            'user_id' => false,
            'sealed' => false,
        ),
        'bulk_cancel' => array(
            'esns' => false,
            'user_id' => false,
            'sealed' => false,
        ),
        'poll' => array(
            'esn' => false,
            'user_id' => false,
            'sealed' => false,
        ),
        'bulk_poll' => array(
            'esns' => false,
            'user_id' => false,
            'sealed' => false,
        ),
        'status_callback' => array(
            'sub_query_id' => false,
            'status' => false,
            'status_details' => false,
            'user_id' => false,
        ),
    ),
    
    'carriers' => array(
        'add' => array(
            'title' => false,
            'request_method' => false,
        ),
        'disable' => array(
            'carrier' => false,
            'request_method' => false,
        ),
        'enable' => array(
            'carrier' => false,
            'request_method' => false,
        ),
    ),
    
    'maintenance' => array(
        'index' => array(
            'request_method' => null,
        ),
        'query_status' => array(
            'request_method' => null,
        ),
        'add_carrier' => array(
            'title' => false,
            'request_method' => false,
        ),
        'enable_carrier' => array(
            'carrier' => false,
            'request_method' => false,
        ),
        'disable_carrier' => array(
            'carrier' => false,
            'request_method' => false,
        ),
        
        'add_vendor' => array(
            'hostname' => false,
            'request_method' => false,
        ),
        'enable_vendor' => array(
            'vendor' => false,
            'request_method' => false,
        ),
        'disable_vendor' => array(
            'vendor' => false,
            'request_method' => false,
        ),
        'add_vendor_carrier' => array(
            'vendor' => false,
            'carrier' => false,
            'request_method' => false,
        ),
        'detach_vendor_carrier' => array(
            'vendor' => false,
            'carrier' => false,
            'request_method' => false,
        ),
        'cancel_query' => array(           
            'request_method' => false,
        ),
    ),
    
    'jobs' => array(
        'add' => array(
            'esn' => false,
            'sub_query_id' => false,
            'carrier_id' => false,
            'user_id' => false,
            'sealed' => false,
        ),
        'poll' => array(
            'sub_query_id' => false,            
            'user_id' => false,
            'sealed' => false,
        ),
       'process' => array(
            'sealed' => false,            
            'request_method' => false,
        ),
        'cancel' => array(
            'sub_query_id' => false,            
            'user_id' => false,
            'sealed' => false,
        ),
    ),
    
    'devices' => array(
        'create' => array(
            'esn' => false,           
            'user_id' => false,
            'sealed' => false,
        ),
        'read' => array(
            'esn' => '',           
            'user_id' => '',
            'sealed' => '',
        ),
    ),
    
    'cron' => array(
        'check_unassigned_sub_queries' => array(
            'request_method' => '',
        ),
        'check_old_sub_queries' => array(
            'request_method' => '',
        ),
        'query_canceled' => array(
            'request_method' => '',
        ),
    ),    
   
));