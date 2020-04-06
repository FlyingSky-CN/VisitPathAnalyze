<?php if (!defined('VPA')) exit('Unsupported method.'."\n");
/**
 * Visit Path Analyze | all2one
 * 计数器
 * 
 * @author FlyingSky-CN
 */

if (!is_dir(DIR_source)) 
exit('fatal: source dir did not exists.'."\n");

if (!isset($argv[3]))
exit('usage: counter <input> [<aec|desc>]'."\n");

if (!file_exists(DIR_source.'/'.$argv[3]))
exit('fatal: input file \''.$argv[3].'\' did not exists.'."\n");

echo ('note: reading input file.'."\n");
if (!($input = file_get_contents(DIR_source.'/'.$argv[3])))
exit('fatal: can not read input file \''.$argv[3].'\' .'."\n");

if (!($groups = json_decode($input, true)))
exit('fatal: can not read input file as json.'."\n");

if (count($groups) < 1)
exit('fatal: input file is empty.'."\n");

echo ('note: start processing.'."\n");
$output = [];

foreach ($groups as $key => $group) {
    if (is_array($group)) {
        if (isset($output[$key])) {
            $output[$key] += count($group);
        } else {
            $output[$key] = count($group);
        }
    } else {
        echo 'warning: item '."'$key'".' is not an array.'."\n";
    }
}

if ((isset($argv[4]) ? $argv[4] : 'desc') == 'desc') {
    arsort($output);
} else {
    asort($output);
}

$name = 'counter-'.time().rand(0, 9).'.json';

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