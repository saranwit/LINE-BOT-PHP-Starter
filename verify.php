<?php
$access_token = 'kuUdonSDUPLTXqdyd8azEnk+siHNkrCJ4m/mUl26viGE2CGzlLEpTCFFrlw8ctu07cy59xkVUnDJvTM2S+rykYeJoMbYpKPCWyNvBhZltj/NCct8/eTVBvQmALe9pBOatoFDkaT0U0/mlMAgAJdM4QdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
