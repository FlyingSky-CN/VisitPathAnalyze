<?php if (!defined('VPA')) exit('Unsupported method.'."\n");
/**
 * Visit Path Analyze | all2one
 * 将所有日志文件合并为一个
 * 
 * @author FlyingSky-CN
 */

if (!is_dir(DIR_logs)) 
exit('fatal: logs dir did not exists.'."\n");

$files = array_diff(
    scandir(DIR_logs), 
    ['.', '..', '.gitkeep']
);

if (count($files) < 1) 
exit('warning: did not match any log files.'."\n");

$all = [];

foreach ($files as $file) {
    if (file_exists(DIR_logs.'/'.$file))
    if ($logs = json_decode(
        file_get_contents(DIR_logs.'/'.$file)
    )):
        foreach ($logs as $log) $all[] = $log;
        echo 'note: process file '."'$file'".' completed!'."\n";
    else:
        echo 'warning: can not read '."'$file'".' as json.'."\n";
    endif;
}

$name = 'all2one-'.time().rand(0, 9).'.json';

echo 'note: saving the result into '."'$name'".' .'."\n";

if (
    file_put_contents(
        DIR_source.'/'.$name,
        json_encode($all)
    )
) {
    exit('success: the result is saved in '."'$name'".' .'."\n");
} else {
    exit('fatal: can not save the result into '."'$name'".' .'."\n");
}