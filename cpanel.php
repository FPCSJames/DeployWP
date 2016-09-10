<?php
if(PHP_SAPI !== 'cli') { die('CLI only'); }

$curl = curl_init();
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST ,0);
curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPHEADER, ["Authorization: Basic " . base64_encode($argv[3].":".$argv[4]) . "\n\r"]);
$url = "{$argv[2]}/";

switch($argv[1]) {
   case 'dbuser':
      $url .= "execute/Mysql/create_user?name={$argv[3]}_{$argv[5]}&password={$argv[6]}";
      break;
   case 'dbperms':
      $url .= "execute/Mysql/set_privileges_on_database?user={$argv[3]}_{$argv[5]}&database={$argv[3]}_{$argv[6]}&privileges=ALL%20PRIVILEGES";
      break;
   case 'db':
      $url .= "execute/Mysql/create_database?name={$argv[3]}_{$argv[5]}";
      break;
   case 'sub':
      $url .= "json-api/cpanel?cpanel_jsonapi_user={$argv[3]}&cpanel_jsonapi_apiversion=2&cpanel_jsonapi_module=SubDomain&cpanel_jsonapi_func=addsubdomain&domain={$argv[6]}&rootdomain={$argv[5]}&dir=%2F{$argv[6]}.{$argv[5]}";
      break;
   default:
      die('error');
}

curl_setopt($curl, CURLOPT_URL, $url);
$result = curl_exec($curl);
curl_close($curl);
if ($result === false) {
    die('error');
}

$result_json = json_decode($result);
if(($argv[1] === 'sub' && $result_json->cpanelresult->data[0]->result === 1) || $argv[1] !== 'sub' && $result_json->status === 1) {
   exit(0);
} else {
   exit(1);
}
