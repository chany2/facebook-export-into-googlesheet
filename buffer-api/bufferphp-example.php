<?php
// You need to create an app at http://bufferapp.com/developers/apps/create before you can go any further!

// Having problems? Try uncomment the line below
//error_reporting(E_ALL);

require_once 'class.bufferapp.php';

// This was generated when you created your app
$buffer = new BufferPHP('YOUR ACCESS TOKEN');

$data = array('profile_ids' => array());

// Your profile ids which can be found on your dashboard (http://bufferapp.com/dashboard)
$data['profile_ids'][] = 'PROFILE ID';
$data['profile_ids'][] = 'PROFILE ID';

// The text for your update
$data['text'] = 'This is an example';

// Uncomment ONE of the lines below if you would like to attach a link or image to your update
//$data['media'] = array('link' => 'http://example.com/');
//$data['media'] = array('picture' => 'http://example.com/images/whiskers.png', 'thumbnail' => 'http://example.com/images/whiskers_thumb.png');

$ret = $buffer->post('updates/create', $data);

// Still having problems figuring out why its not working? Try uncommenting the line below to see what the API is returning
//var_dump($ret);