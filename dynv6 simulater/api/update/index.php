<?php

// $mysql = new PDO('mysql:host=localhost;port=3306;dbname=dynv6simulator', 'root', 'root');
// $mysql->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$zone = filter_input(INPUT_GET, 'hostname', FILTER_SANITIZE_STRING);
$ipv4 = filter_input(INPUT_GET, 'ipv4', FILTER_SANITIZE_STRING);
$token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_STRING);

if (!$token){
    http_response_code(401);
    die('UNAUTHORIZED: No token provided');
}

if (!$zone){
    http_response_code(400);
    die('ZONE ERROR: No zone provided');
}

if (!$ipv4){
    http_response_code(400);
    die('IP ERROR: No IP provided');
}

// $tokens = [];
// $zones = [];

// if (file_exists('data.txt')) {
//     $data = fopen('data.txt', 'r+');
//     while (!feof($data)) {
//         if (($curToken = trim(fgets($data))) == 'tokens:')
//             continue;
//         if ($curToken == 'zones:')
//             break;
//         $tokens[] = $curToken;
//     }
//     while (!feof($data)) {
//         if (($curZone = trim(fgets($data))) == 'zones:')
//             continue;
//         if (empty($curZone))
//             break;
//         $zones[explode(':', $curZone)[0]] =  explode(':', $curZone)[1];
//     }
//     fclose($data);
// }

// $stmt = $mysql->prepare('SELECT * FROM token WHERE token = ?');
// $stmt->execute([$token]);

// $data = fopen('data.txt', 'r+');
$users = json_decode(file_get_contents('data.txt'), true);
// while (!feof($data)) {
//     $dataArr = explode('|', trim(fgets($data)));
//     foreach (explode(',', $dataArr[1]) as $z) {
//         $zones[explode(':', $z)[0]] = explode(':', $z)[1];
//         $users[$dataArr[0]] = $zones;
//     }
//     unset($zones);
// }

// if ($stmt->rowCount() < 1)
// if (array_search($token, $tokens) === false)
if (!isset($users[$token])){
    http_response_code(401);
    die('UNAUTHORIZED: Invalid token provided');
}

// $stmt = $mysql->prepare('SELECT * FROM zone WHERE name = ?');
// $stmt->execute([$zone]);

// if ($stmt->rowCount() < 1)
// if (!isset($zones[$zone]))
if (!isset($users[$token][$zone])){
    http_response_code(404);
    die('ZONE ERROR: Invalid zone provided');
}
// $thezone = $stmt->fetchAll()[0];

// if ($thezone['ip'] == $ipv4)
// if ($zones[$zone] == $ipv4)
if ($users[$token][$zone] == $ipv4){
    http_response_code(208);
    die('Zone is up to date');
}

// $stmt = $mysql->prepare('UPDATE zone SET ip = ? WHERE name = ?');
// $stmt->execute([$ipv4, $zone]);
// $zones[$zone] = $ipv4;
$users[$token][$zone] = $ipv4;

saveData();
http_response_code(202);
die('Zone updated');

function saveData()
{
    // global $tokens, $zones;
    // $data_encoded = "tokens:\n";
    // foreach ($tokens as $t)
    //     $data_encoded .= $t . "\n";
    // $data_encoded .= "zones:\n";
    // foreach ($zones as $z => $ip)
    //     $data_encoded .= $z . ':' . $ip . "\n";
    // global $users;
    // $data_encoded = '';
    // foreach ($users as $t => $zs) {
    //     $data_encoded .= $t . '|';
    //     foreach ($zs as $z => $ip) {
    //         $data_encoded .= $z . ':' . $ip . ',';
    //     }
    //     $data_encoded = substr($data_encoded, 0, strlen($data_encoded) - 1) . "\n";
    // }
    // $save = fopen('data.txt', 'w+');
    // fwrite($save, trim($data_encoded));
    // fclose($save);
    global $users;
    file_put_contents('data.txt', json_encode($users));
}
