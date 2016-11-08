<?php



$cvsURLs = array(
    "http://bandoffjp.com/gandamsan",
    "http://bandoffjp.com/hello_on_music10",
    "http://bandoffjp.com/hiroyukicyan",
    "http://bandoffjp.com/JDABCsessio2",
    "http://bandoffjp.com/yokkyun",
    "http://bandoffjp.com/2016",
    "http://bandoffjp.com/uyamuya",
    "http://bandoffjp.com/aikatsu03",
    "http://bandoffjp.com/LLKS5",
    "http://bandoffjp.com/lantis01",
);

$cvsURLsNew = array(
    "http://bandoff.info/1610Ciel",
    "http://bandoff.info/ballad_session_2016",
    "http://bandoff.info/NMsession"
    ,    "http://bandoff.info/CM_Song"
    ,    "http://bandoff.info/9505_2nd"
    ,    "http://bandoff.info/LLBS15"
    ,    "http://bandoff.info/imas5"
    ,"http://bandoff.info/beingsession"
    ,"http://bandoff.info/BUMP_session"
    ,"http://bandoff.info/denkare02"
    ,"http://bandoff.info/fff"
    ,"http://bandoff.info/lilywhite_ses"
    ,"http://bandoff.info/mamesion6"
    ,"http://bandoff.info/MLLses1"
    ,"http://bandoff.info/aikatsu04"
    ,"http://bandoff.info/keion"
    ,"http://bandoff.info/LLKS6"
    ,"http://bandoff.info/SIAMSHADEsession"
    ,"http://bandoff.info/FDsession2"
    ,"http://bandoff.info/LLBS14"
    ,"http://bandoff.info/anisongassyuku2016summer"
    ,"http://bandoff.info/imas4"
    ,"http://bandoff.info/spsl"
    ,"http://bandoff.info/nogikeyaki46"
    ,"http://bandoff.info/hello_on_music11"
    ,"http://bandoff.info/SANTOUSHINsession"
    ,"http://bandoff.info/jinriki_session"
    ,"http://bandoff.info/KSDDsession"
    ,"http://bandoff.info/hnknainmtkttses"
    ,"http://bandoff.info/bunkasai_session"
    ,"http://bandoff.info/deremasu2"
    ,"http://bandoff.info/LLBS13"
    ,"http://bandoff.info/fusion"
    ,"http://bandoff.info/imas3"
    ,"http://bandoff.info/yuikaori01"
    ,"http://bandoff.info/hanayo0117"
    ,"http://bandoff.info/LLBS12"
    ,"http://bandoff.info/deremasu"
    ,"http://bandoff.info/syoujyomangasession"
    ,"http://bandoff.info/t7s01"
    ,"http://bandoff.info/kishida_OFF"
    ,"http://bandoff.info/minorin3"
    ,"http://bandoff.info/sekkenya_session_2016"
    ,"http://bandoff.info/8595session6"
    ,"http://bandoff.info/ergband09"
    ,"http://bandoff.info/imasosaka"
    ,"http://bandoff.info/k-on_session"
    ,"http://bandoff.info/1986"
    );


function download($path) {
    echo $path;
    $base_url = $path;
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $base_url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 証明書の検証を行わない
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // curl_execの結果を文字列で返す

    $response = curl_exec($curl);

    $urlSplitArray = explode("/", $path);
    $fileName = $urlSplitArray[sizeof($urlSplitArray) -4 ].".csv";

    file_put_contents($fileName, $response);

}

foreach($cvsURLs as $cvsURL) {
    download($cvsURL."/song/download/completed");
}

foreach($cvsURLsNew as $cvsURL) {
    download($cvsURL."/song/download/complete");
}
