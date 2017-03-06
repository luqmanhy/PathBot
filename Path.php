<?php

//////////////////////////////////////////////////
// 	Github : https://github.com/luqman-dev/
//  Web : https://luqman.web.id
//////////////////////////////////////////////////


class Path{

	private $meID;
	private $email;

	public function __construct($email,$password){
		$this->login($email,$password);
	}

	public function login($email,$password){
		$fetchValue = new fetchValue();

		$this->email = $email;

		$url = "https://www.path.com/a/login";
		$data = '{"emailId":"'.$email.'","password":"'.$password.'"}';
		$ref = "https://www.path.com/login";
		$new = true;
		$store_cook = dirname(__FILE__) . '/cookies/'.md5($this->email).'.txt';
		
		$login = fCurl($url, $data, $ref, $new, $store_cook);

		$this->meID = $fetchValue->set($login,'{"id":"','"')->getValue();

		if(!empty($this->meID)){
			echo "Login : OK <br>\n";
			return $login;
		}else{
			echo "Login : Failed <br>\n";
			die();
			return false;
		}
	}

	public function getMyTimeline(){

		$url = "https://www.path.com/a/feed/home?ww=1366&wh=267&meId=".$this->meID;
		$new = false;
		$store_cook = dirname(__FILE__) . '/cookies/'.md5($this->email).'.txt';

		$timeline = fCurl($url, null, null, $new, $store_cook);
		if(!empty($timeline) && substr_count($timeline, '{"error_code":401')==0){
			echo "Get My Timeline : OK <br>\n";
			return $timeline;
		}else{
			echo "Get My Timeline : Failed <br>\n";
			return false;
		}
	}

	public function getMyProfile(){

		$url = "https://www.path.com/a/feed?ww=1366&wh=395&user_id=".$this->meID."&meId=".$this->meID."";
		$new = false;
		$store_cook = dirname(__FILE__) . '/cookies/'.md5($this->email).'.txt';

		$profile = fCurl($url, null, null, $new, $store_cook);
		if(!empty($profile)  && substr_count($profile, '{"error_code":401')==0){
			echo "Get My Profile : OK <br>\n";
			return $profile;
		}else{
			echo "Get My Profile : Failed <br>\n";
			return false;
		}
	}	

	public function getMyFriendList(){

		$url = "https://www.path.com/a/friends?locale=en&meId=536d6d572d7a7970052e1d11".$this->meID."";
		$new = false;
		$store_cook = dirname(__FILE__) . '/cookies/'.md5($this->email).'.txt';

		$friend_list = fCurl($url, null, null, $new, $store_cook);
		if(!empty($friend_list) && substr_count($friend_list, '{"error_code":401')==0){
			echo "Get My Friend List : OK <br>\n";
			return $friend_list;
		}else{
			echo "Get My Friend List : Failed <br>\n";
			return false;
		}
	}		


	public function getProfile($profile_id){

		$url = "https://www.path.com/a/feed?ww=1366&wh=395&user_id=".$profile_id."&meId=".$this->meID."";
		$new = false;
		$store_cook = dirname(__FILE__) . '/cookies/'.md5($this->email).'.txt';

		$profile = fCurl($url, null, null, $new, $store_cook);

		if(!empty($profile)  && substr_count($profile, '{"error_code":401')==0){
			echo "Get Profile : OK <br>\n";
			return $profile;
		}else{
			echo "Get Profile : Failed <br>\n";
			return false;
		}
	}		

	public function getFriendMoments($idFriend){
		$fetchValue = new fetchValue();

		$timeline = $this->getProfile($idFriend);

		$momentList = $fetchValue->set($timeline,'"moments":[','],"movies":')->getValue();
		if(!empty($momentList)){
			echo "Get List Moment : OK<br>\n";
			return $momentList;
		}else{
			echo "Get List Moment : OK<br>\n";			
			return false;
		}
	}

	public function getMomentTimeline(){
		$fetchValue = new fetchValue();

		$timeline = $this->getMyTimeline();

		$momentList = $fetchValue->set($timeline,'"moments":[','],"movies":')->getValue();
		if(!empty($momentList)){
			echo "Get List Moment : OK<br>\n";
			return $momentList;
		}else{
			echo "Get List Moment : OK<br>\n";			
			return false;
		}

	}


// Send Reaction //	

	public function sendLove($momentID){

		$url = "https://www.path.com/a/moment/emotion/add";
		$data = '{"moment_id":"'.$momentID.'","emotion_type":"love","meId":"'.$this->meID.'"}';
		$ref = "https://www.path.com/";
		$new = false;
		$store_cook = dirname(__FILE__) . '/cookies/'.md5($this->email).'.txt';

		$send = fCurl($url, $data, null, $new, $store_cook);

		if(!empty($send)  && substr_count($send, '{"error_code":401')==0){
			echo "Send Love @".$momentID." : OK <br>\n";
			return $send;
		}else{
			echo "Send Love @".$momentID." : Failed <br>\n";
			return false;
		}
	}



	public function sendLaugh($momentID){

		$url = "https://www.path.com/a/moment/emotion/add";
		$data = '{"moment_id":"'.$momentID.'","emotion_type":"laugh","meId":"'.$this->meID.'"}';
		$ref = "https://www.path.com/";
		$new = false;
		$store_cook = dirname(__FILE__) . '/cookies/'.md5($this->email).'.txt';

		$send = fCurl($url, $data, null, $new, $store_cook);

		if(!empty($send)  && substr_count($send, '{"error_code":401')==0){
			echo "Send Laugh @".$momentID." : OK <br>\n";
			return $send;
		}else{
			echo "Send Laugh @".$momentID." : Failed <br>\n";
			return false;
		}
	}

	public function sendSurprise($momentID){

		$url = "https://www.path.com/a/moment/emotion/add";
		$data = '{"moment_id":"'.$momentID.'","emotion_type":"surprise","meId":"'.$this->meID.'"}';
		$ref = "https://www.path.com/";
		$new = false;
		$store_cook = dirname(__FILE__) . '/cookies/'.md5($this->email).'.txt';

		$send = fCurl($url, $data, null, $new, $store_cook);

		if(!empty($send)  && substr_count($send, '{"error_code":401')==0){
			echo "Send Surprise @".$momentID." : OK <br>\n";
			return $send;
		}else{
			echo "Send Surprise @".$momentID." : Failed <br>\n";
			return false;
		}
	}


	public function sendSad($momentID){

		$url = "https://www.path.com/a/moment/emotion/add";
		$data = '{"moment_id":"'.$momentID.'","emotion_type":"sad","meId":"'.$this->meID.'"}';
		$ref = "https://www.path.com/";
		$new = false;
		$store_cook = dirname(__FILE__) . '/cookies/'.md5($this->email).'.txt';

		$send = fCurl($url, $data, null, $new, $store_cook);

		if(!empty($send)  && substr_count($send, '{"error_code":401')==0){
			echo "Send Sad @".$momentID.": OK <br>\n";
			return $send;
		}else{
			echo "Send Sad @".$momentID." : Failed <br>\n";
			return false;
		}
	}	


	public function sendHappy($momentID){

		$url = "https://www.path.com/a/moment/emotion/add";
		$data = '{"moment_id":"'.$momentID.'","emotion_type":"happy","meId":"'.$this->meID.'"}';
		$ref = "https://www.path.com/";
		$new = false;
		$store_cook = dirname(__FILE__) . '/cookies/'.md5($this->email).'.txt';

		$send = fCurl($url, $data, null, $new, $store_cook);

		if(!empty($send)  && substr_count($send, '{"error_code":401')==0){
			echo "Send Happy @".$momentID." : OK <br>\n";
			return $send;
		}else{
			echo "Send Happy @".$momentID." : Failed <br>\n";
			return false;
		}
	}		

//////////////////////////////////


	public function sendComment($momentID,$comment){

		$url = "https://www.path.com/a/moment/comment/add";
		$data = '{"moment_id":"'.$momentID.'","comment_body":"'.$comment.'","meId":"'.$this->meID.'"}';
		$ref = "https://www.path.com/";
		$new = false;
		$store_cook = dirname(__FILE__) . '/cookies/'.md5($this->email).'.txt';

		$send = fCurl($url, $data, null, $new, $store_cook);

		if(!empty($send)  && substr_count($send, '{"error_code":401')==0){
			echo "Send Comment @".$momentID." : OK <br>\n";
			return $send;
		}else{
			echo "Send Comment @".$momentID." : Failed <br>\n";
			return false;
		}
	}	

////////////////////////
// BOT
////////////////////////

	public function Bot_Send_Reaction($reaction_type){			
			$momentList = $this->getMomentTimeline();

			preg_match_all("/{\"id\":\"(.*?)\"/s", $momentList, $id_moment);
			echo "Total Moment : ".count($id_moment[0]);
			echo "<br>\n";

			for($i=0;$i<count($id_moment[1]);$i++){
				"Moment ".$i." : ";
				switch($reaction_type){
					case "love":
						$this->sendLove($id_moment[1][$i]);
						break;
					case "laugh":
						$this->sendLaugh($id_moment[1][$i]);
						break;						
					case "surprise":
						$this->sendSurprise($id_moment[1][$i]);
						break;
					case "sad":
						$this->sendSad($id_moment[1][$i]);
						break;
					case "happy":
						$this->sendHappy($id_moment[1][$i]);
						break;
					default:
						$this->sendLove($id_moment[1][$i]);
					}
				echo "----------------------<br>\n";																	
			}

			echo "<b>Done</b>";
	}

	public function Bot_Send_Comment($comment){			
			$momentList = $this->getMomentTimeline();
			
			preg_match_all("/{\"id\":\"(.*?)\"/s", $momentList, $id_moment);
			echo "Total Moment : ".count($id_moment[0]);
			echo "<br>\n";

			for($i=0;$i<count($id_moment[1]);$i++){
				"Moment ".$i." : ";
				$this->sendComment($id_moment[1][$i],$comment);
				echo "----------------------<br>\n";																	
			}

			echo "<b>Done</b>";
	}


	public function Bot_Send_Reaction_Friend($friendID, $reaction_type){			
			$momentList = $this->getFriendMoments($friendID);

			preg_match_all("/{\"id\":\"(.*?)\"/s", $momentList, $id_moment);
			echo "ID Friend : ".$friendID;
			echo "<br>\n";			
			echo "Total Moment : ".count($id_moment[0]);
			echo "<br>\n";

			for($i=0;$i<count($id_moment[1]);$i++){
				"Moment ".$i." : ";
				switch($reaction_type){
					case "love":
						$this->sendLove($id_moment[1][$i]);
						break;
					case "laugh":
						$this->sendLaugh($id_moment[1][$i]);
						break;						
					case "surprise":
						$this->sendSurprise($id_moment[1][$i]);
						break;
					case "sad":
						$this->sendSad($id_moment[1][$i]);
						break;
					case "happy":
						$this->sendHappy($id_moment[1][$i]);
						break;
					default:
						$this->sendLove($id_moment[1][$i]);
					}
				echo "----------------------<br>\n";																	
			}

			echo "<b>Done</b>";
	}

	public function Bot_Send_Comment_Friend($friendID, $comment){			
			$momentList = $this->getFriendMoments($friendID);
			
			preg_match_all("/{\"id\":\"(.*?)\"/s", $momentList, $id_moment);

			echo "ID Friend : ".$friendID;
			echo "Total Moment : ".count($id_moment[0]);
			echo "<br>\n";

			for($i=0;$i<count($id_moment[1]);$i++){
				"Moment ".$i." : ";
				$this->sendComment($id_moment[1][$i],$comment);
				echo "----------------------<br>\n";																	
			}

			echo "<b>Done</b>";
	}


}
