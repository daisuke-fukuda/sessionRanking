<?php


$dir    = './';
$files = scandir($dir);

foreach($files as $file) {
    if(strpos($file,'.csv') !== false){

        //--------------------------------------------------
// 文字コードを変換した一時ファイルの作成
//--------------------------------------------------
// ファイルの読み込み
        $data = file_get_contents($file);
// 文字コードの変換（UTF-8 → SJIS-win）
        $data = mb_convert_encoding($data, 'UTF-8', 'SJIS-win');
// 一時ファイルの作成
        $temp = tmpfile();
// メタデータからファイルパスを取得して読み込み
        $meta = stream_get_meta_data($temp);
// 一時ファイル書き込み
        fwrite($temp, $data);
// ファイルポインタの位置を先頭に
        rewind($temp);

//--------------------------------------------------
// ファイルの読み込み
//--------------------------------------------------
// CSVファイルの読み込み
        $objFile = new SplFileObject($meta['uri'], 'rb');
        $objFile->setFlags(SplFileObject::READ_CSV);
//        $objFile->setCsvControl("\t", "\"");
//        $file = new SplFileObject($file);
//        $file->setFlags(SplFileObject::READ_CSV);
        $records = array();
        foreach ($objFile as $line) {
            $sql = "";
            //終端の空行を除く処理　空行の場合に取れる値は後述
            if(!is_null($line[0])){
                $sql = "Insert into rankings (";

                $columns = array();
                $columns[] = "id";
                $columns[] = "sessionName";
                $values = array();
                $values[] = "null";
                $values[] = str_replace(".csv", "", $file);

                $count = 1;
                foreach($line as $value) {
                    $columns[] = "column".$count;
                    $values[] = str_replace("'", "", $value); // μ’ｓ対策
                    $count ++;
                }

                $valuesString = "";
                for($i = 0; $i < sizeof($values); $i++) {
                    $value = $values[$i];
                    if ($i == 0) {
                        $valuesString .= $value.",";
                    } else if ($i == sizeof($values) - 1) {
                        $valuesString .= '"' . $value. '"' ;
                    } else {
                        $valuesString .= '"' . $value. '",' ;
                    }
                }
                $sql .= implode(",", $columns).") values (".$valuesString. ");";

//                $columns = explode(",", $line);
//                var_dump($columns);
//                echo $sql.PHP_EOL;

            }

            if ($sql) {
                $command = "mysql -u root session_ranking -e "."'".$sql."'";
                echo $command.PHP_EOL;
                exec($command);
            }

        }

//        var_dump($records);
//        break;

    }
}

