<?php

error_reporting(0);
set_time_limit(0);
ini_set('max_execution_time', 0);
ini_set("memory_limit", "100M");

require_once("function/function.php");
require_once("function/fetchValue.php");
require_once("class/Path.php");


$email = "your_email@email.com";
$password = "your_password";


$path = new Path($email,$password);

//////////// To Timeline
//Send Reaction : 
//   - love
//   - happy
//   - laugh
//   - sad
//   - surprise

$path->Bot_Send_Reaction("love"); 

//Comment
//$path->Bot_Send_Comment("test");



///////// To Friend Profile

// Get Friend List :
// $path->getMyFriendList();

//Send Reaction : 
//   - love
//   - happy
//   - laugh
//   - sad
//   - surprise

// Bot_Send_Reaction_Friend(friendID,reactionType);
// $path->Bot_Send_Reaction_Friend("5194c2c4b14bd23e5d3c9509","love");


//Comment
// Bot_Send_Comment_Friend(friendID,comment);
// $path->Bot_Send_Comment_Friend("5194c2c4b14bd23e5d3c9509","test");
