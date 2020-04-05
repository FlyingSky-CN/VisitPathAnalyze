<?php
/**
 * Visit Path Analyze
 * 
 * @author FlyingSky-CN
 */

if (count(isset($argv) ? $argv : []) < 1) exit('Unsupported method.'."\n");

define('DIR_app'   , __DIR__.'/app'   );
define('DIR_config', __DIR__.'/config');
define('DIR_logs'  , __DIR__.'/logs'  );
define('DIR_public', __DIR__.'/public');
define('DIR_source', __DIR__.'/source');

if (count($argv) == 1) exit('Manual WIP.'."\n"); //TODO

if (file_exists(DIR_app.'/'.$argv[1].'.php')):
    require DIR_app.'/'.$argv[1].'.php';
    exit();
endif;

exit('Unknown command.'."\n");
