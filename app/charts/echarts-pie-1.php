<?php if (!defined('VPA')) exit('Unsupported method.'."\n");
/**
 * Visit Path Analyze | charts
 * echarts-pie-1
 * 
 * @author FlyingSky-CN
 */

if (!is_dir(DIR_source)) 
exit('fatal: source dir did not exists.'."\n");

if (!is_dir(DIR_config)) 
exit('fatal: config dir did not exists.'."\n");

if (!file_exists(DIR_config.'/theme/echarts-pie-1.html')) 
exit('fatal: theme file \'echarts-pie-1.html\' did not exists.'."\n");

if (!($theme = file_get_contents(DIR_config.'/theme/echarts-pie-1.html')))
exit('fatal: can not read the theme file.'."\n");

if (!isset($argv[3]))
exit('usage: echarts-pie-1 <input> [<title>]'."\n");

if (!file_exists(DIR_source.'/'.$argv[3]))
exit('fatal: input file \''.$argv[3].'\' did not exists.'."\n");

echo ('note: reading input file.'."\n");
if (!($input = file_get_contents(DIR_source.'/'.$argv[3])))
exit('fatal: can not read input file \''.$argv[3].'\' .'."\n");

if (!($logs = json_decode($input, true)))
exit('fatal: can not read input file as json.'."\n");

if (count($logs) < 1)
exit('fatal: input file is empty.'."\n");

echo ('note: start processing.'."\n");
$data = [];

foreach ($logs as $key => $log) {
    if (is_numeric($log)) {
        $data[] = ['value' => $log, 'name' => $key];
    } else {
        echo 'warning: data \''.$num.'\' is not a numeric. '."\n";
    }
}

$title = isset($argv[4]) ? $argv[4] : 'Title';

$output = str_replace(
    ['[[data]]', '{{title}}'],
    [
        json_encode($data),
        $title
    ],
    $theme
);

$name = 'pie-1-'.time().rand(0, 9).'.html';

echo 'note: saving the result into '."'$name'".' .'."\n";

if (
    file_put_contents(
        DIR_public.'/'.$name,
        $output
    )
) {
    exit('success: the result is saved in '."'$name'".' .'."\n");
} else {
    exit('fatal: can not save the result into '."'$name'".' .'."\n");
}