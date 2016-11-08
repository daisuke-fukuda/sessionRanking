<?php

$searchName = "棟梁";


$sql = "select * from rankings where ";
for($i = 1; $i <= 20; $i++) {
    $sql .= "column".$i ." = ". '"'. $searchName. '"';
    if ($i < 20) {
        $sql .= " or ";
    }
}
//echo $sql;


$command = "mysql -u root session_ranking -N -e "."'".$sql."'";
exec($command, $result);


$count = array();
$songCount = 0;
foreach($result as $one) {
    $values = explode("\t", $one);
//    var_dump($values);
    $songCount ++;

    // 複数パート掛け持ちの場合に重複してカウントされちゃう対応
    $valuesDuplicateCheck = array();
    for($i = 0; $i < sizeof($values); $i++) {
        $value = $values[$i];
        // 複数パートエントリー
        if (in_array($value, $valuesDuplicateCheck)) {
            continue;
        }
        $valuesDuplicateCheck[] = $value;

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

        if (array_key_exists($value, $count)) {
            $count[$value] ++;
        } else {
            $count[$value] = 1;
        }
    }
}

arsort($count);

echo $searchName.PHP_EOL;
echo "曲数：". $songCount.PHP_EOL;
foreach($count as $name => $resultCount) {
    echo $name. " => ". $resultCount. PHP_EOL;
}