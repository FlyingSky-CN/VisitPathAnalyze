<?php
/**
 * Visit Path Analyze
 * 
 * @author FlyingSky-CN
 */

if (count(isset($argv) ? $argv : []) < 1) exit('Unsupported method.'."\n");

define('VPA', true);

define('DIR_app'   , __DIR__.'/app'   );
define('DIR_config', __DIR__.'/config');
define('DIR_logs'  , __DIR__.'/logs'  );
define('DIR_public', __DIR__.'/public');
define('DIR_source', __DIR__.'/source');

if (count($argv) == 1) exit('Manual WIP.'."\n"); //TODO

if ($argv[1] == 'run') if (isset($argv[2])):
if (file_exists(DIR_app.'/'.$argv[2].'.php')):
    require DIR_app.'/'.$argv[2].'.php';
    exit();
endif; else:
    exit('usage: analyze run <program> [<argv>]'."\n");
endif;

if ($argv[1] == 'init'):
    function checkdir($dir, $name) {
        if (!is_dir($dir)) if (mkdir($dir)) {
            echo 'note: created dir \''.$name.'\' .'."\n";
        } else {
            echo 'warning: can not create dir \''.$name.'\' .'."\n";
        }
    }
    checkdir(DIR_app   , 'app'   );
    checkdir(DIR_config, 'config');
    checkdir(DIR_logs  , 'logs'  );
    checkdir(DIR_public, 'public');
    checkdir(DIR_source, 'source');
    exit('success: complete initialization.'."\n");
endif;

exit('Unknown command.'."\n");
