<?php
$json = file_get_contents('php://input');
$data = json_decode($json, true);
$zipcode = !empty($data) ? $data : '';
$zipcode = mb_convert_kana($zipcode, 'a', 'utf-8');
$zipcode = preg_replace('/[\sー-]/', '', $zipcode);
​
$callback  = (string)filter_input(INPUT_GET, 'callback');
$callback  = htmlspecialchars(strip_tags($callback));
​
$param = array('','','','');
$file = '13TOKYO.csv';
if(file_exists($file)){
    $spl = new SplFileObject($file);
​
    // while (!$spl->eof()) {
    //     $columns = $spl->fgetcsv();
    //     if(isset($columns[2]) && $columns[2] == $zipcode){
    //         $kencode = substr($columns[0], 0, 2);
    //         $ttext = str_replace('以下に掲載がない場合', '', $columns[8]);
    //         // $param = array($kencode,$columns[6], $columns[7],$ttext);
    //         $param = [$kencode, $columns[6], $columns[7], $ttext];
    //         break;
    //     }
    // }
​
    foreach ($spl as $i => $line) {
        $enc_line = mb_convert_encoding($line, 'UTF-8', 'SJIS');    //　文字コード変換
        $new_line = str_getcsv($enc_line);    //　ここで行を配列に分割
        if(isset($new_line[2]) && $new_line[2] == $zipcode){
            $kencode = substr($new_line[0], 0, 2);
            $ttext = str_replace('以下に掲載がない場合', '', $new_line[8]);
            // $param = array($kencode,$columns[6], $columns[7],$ttext);
            $param = [$kencode, $new_line[6], $new_line[7], $ttext];
            break;
        }
    }
​
    // $param = ['13', 'aaaaa', 'iiiii', 'uuuuu'];
}
​
printf("{$callback}(%s)", json_encode($param));
// echo json_encode($param);
// printf("{$callback}(%s)", json_encode(['13', 'aaaaa', 'iiiii', 'uuuuu']));
exit;