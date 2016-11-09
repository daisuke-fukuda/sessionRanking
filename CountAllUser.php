<?php

// 全部とってくるよ
$sql = "select * from rankings";
//echo $sql;


$command = "mysql -u root session_ranking -N -e "."'".$sql."'";
exec($command, $result);


$count = array();
$songCount = 0;
$users = array();

foreach($result as $one) {
    $values = explode("\t", $one);
//    var_dump($values);
    $songCount ++;


    for($i = 0; $i < sizeof($values); $i++) {
        $value = $values[$i];
        // id、曲名等はスルー
        if ($i < 5) {
            continue;
        }
        if (!$value) {
            continue;
        }
        if ($value == "成立")  {
            continue;
        }
        if ($value == "なし")  {
            continue;
        }
        if ($value == "未エントリー") {
            continue;
        }
        if ($value == $searchName) {
            continue;
        }

        $users[] = $value;
    }
}


echo "全部カウントしてみたよ";
echo "曲数：". $songCount.PHP_EOL;
echo "のべ参加人数（パート重複は重複してカウント）:".sizeof($users).PHP_EOL;
$usersUnique = array_unique($users);
echo "人数:".sizeof($usersUnique).PHP_EOL;