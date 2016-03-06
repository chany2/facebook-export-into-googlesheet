<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ .'/Config.php';
use Lib\BufferAPI;

//\Lib\Common::dd(BufferAPI::getProfile('id'));

require __DIR__ .'/buffer-api/class.bufferapp.php';
//56d34da02b19ce87046a1b3a
// This was generated when you created your app
$buffer = new BufferPHP(BUFFER_ACCESS_TOKEN);

//$data = array('profile_ids' => array('56d34da02b19ce87046a1b3a'));
// Your profile ids which can be found on your dashboard (http://bufferapp.com/dashboard)
//$data['profile_ids'][] = '56d34da02b19ce87046a1b3a';

$data['profile_ids'][] = BufferAPI::getProfile('id');

// The text for your update
$data['text'] = $_POST['message'];

// Uncomment ONE of the lines below if you would like to attach a link or image to your update
$data['media'] = array('link' => $_POST['link']);
$ret = $buffer->post('updates/create', $data);
//\Lib\Common::dd($ret->success);

if ($ret->success)
{
    echo json_encode(array('status' => true));
} else {
    echo json_encode(array('status' => false));
}
