<?php

<?php
//ovo nista ne valja
class User{

	protected $ime;
	protected $tweets=array();

	public function __construct($ime){

		$this->ime=$ime;
		$tvit=new Tweet(count($this->tweets)+1, "Hello this is my first tweet. ", ["retweets"=>0, "favorites"=>0]);
		$this->tweets[]=$tvit;

	}
	
	public function dodajTweet($text){

		$tvit = new Tweet(count($this->tweets)+1, $text);
		$this->tweets[]=$tvit;

	}

	public function ispisiTweet(){

		$allTweets="";
		foreach($this->tweets as $tweet){

			$allTweets=$allTweets.$tweet->text." Retweets:".$tweet->meta["retweets"]." Favorites:"
				   .$tweet->meta["favorites"]."\n";

		}
		return $allTweets;
		

	}
	
	public function __toString(){

		return $this->ime." ima ".count($this->tweets)." tweet-a! ";

	}

	public function retweet($id){


		//var_dump($this->tweets); exit;
		$this->tweets[$id-1]->retweet();
		/*foreach($this->tweets as $tweet){
			
			if($tweet->id==$id){

				$tweet->retweet();

			}


		}*/

		

	}


}

class Tweet{

	protected $id, $text;
	protected $meta = array();


	public function __construct($id, $text, $meta = null){

		$this->id=$id;
		$this->text=$text;
		if(isset($meta)){
		$this->meta=$meta;
		}
		else{
		$this->meta=["retweets"=>0, "favorites"=>0];
		}

	}

	public function __toString(){

		return " Tekst tvita: ".$this->text .", broj retweets-a:". $this->meta["retweets"]. ", broj favorites-a. "
			. $this->meta["favorites"];

	}

	public function retweet(){
	
		$this->meta["retweets"]++;
	
	}

	public function favorite(){
	
		$this->meta["favorites"]++;	
	
	}

	public function __get($id){

		return $this->$id;


	}

	public function __set($text, $value){

		if($text!="id")
		$this->$text = $value;

	}

	public function __invoke($vrednost){


		$this->text=$vrednost;

	}



}
$newUser = new User("Vladimir");
$newUser->dodajTweet("Danas je petak 13.");
$newUser->dodajTweet("Najeo sam se rostilja.");
$newUser->retweet(2);
echo $newUser->ispisiTweet();
echo $newUser;
//$tvit->retweet();
//$tvit->retweet();
//$tvit->favorite();
//$tvit("sadad");
//$tvit->text=" nja nja";
//$tvit->id = 43;
//echo $tvit;




?>


?>
