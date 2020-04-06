<?php if (!defined('VPA')) exit('Unsupported method.'."\n");
/**
 * Visit Path Analyze | filtrat
 * 筛选日志
 * 
 * @author FlyingSky-CN
 */

if (!is_dir(DIR_source)) 
exit('fatal: source dir did not exists.'."\n");

if (!isset($argv[3]) || !isset($argv[4]) || !isset($argv[5]) || !isset($argv[6]))
exit('usage: filtrat <input> <key> <==|!=> <value>'."\n");

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
$output = [];

foreach ($logs as $mun => $log) {
    if (isset($log[$argv[4]])) {
        if ($argv[5] == '!=') {
            if ((string)$log[$argv[4]] != (string)$argv[6]) $output[] = $log;
        } else {
            if ((string)$log[$argv[4]] == (string)$argv[6]) $output[] = $log;
        }
    } else {
        echo 'warning: can not find the key in \''.$num.'\' . '."\n";
    }
}

$name = 'filtrat-'.$argv[4].$argv[5].$argv[6].'-'.time().rand(0, 9).'.json';

echo 'note: saving the result into '."'$name'".' .'."\n";

if (
    file_put_contents(
        DIR_source.'/'.$name,
        json_encode($output)
    )
) {
    exit('success: the result is saved in '."'$name'".' .'."\n");
} else {
    exit('fatal: can not save the result into '."'$name'".' .'."\n");
}