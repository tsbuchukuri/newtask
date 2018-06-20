<?php

namespace Newtask;


class comments extends db{
	public $fname; 
	public $comment;
	protected $status;
	public $alertMessage;
	public $editID;
	
	function __construct(){
		//echo "run coments";
	}
	
	 public function getAllComments(){
		 $stmt=$this->connect()->query("SELECT * FROM comments WHERE status=1 ORDER BY id DESC");
		 while($r=$stmt->fetchAll()){
			 return $r;
		 }
	 }//end getAllComments 
	
	 public function getAllCommentsAdmin(){
		 $stmt=$this->connect()->query("SELECT * FROM comments ORDER BY id DESC");
		 while($r=$stmt->fetchAll()){
			 return $r;
		 }
	 }//end getAllCommentsAdmin
	
	public function totalComments(){
	 $status=1;
	 $stmt=$this->connect()->query("SELECT * FROM comments WHERE status=1");
	 $count=$stmt->rowCount();
		return  $count;
	}//end totalComments	
	
	public function addComments($name, $comm){
		$this->fname=$name;
		$this->comment=$comm;
		$status=0;
		$stmt=$this->connect()->prepare("INSERT INTO comments (fname, comment, status) VALUES (?, ?, ?)");
		if($stmt->execute([$this->fname, $this->comment, $status])){
			$alertMessage='<div class="alert alert-success" role="alert">Your comment has been added</div>';
		}else{
			$alertMessage='<div class="alert alert-danger" role="alert">Comment could not be added!</div>';
		}
		return $alertMessage;
	}
	
	public function GetEditComment($id){
		$this->editID=$id;
		$stmt=$this->connect()->prepare("SELECT * FROM comments WHERE id=?");
		$stmt->execute([$this->editID]);
		 while($r=$stmt->fetch()){
			 return $r;
		 }
	}
	
	public function editComments($name, $comm, $stat, $itmid){
		$stmt=$this->connect()->prepare("UPDATE comments SET fname=?, comment=?, status=? WHERE id=?");
		if($stmt->execute([$name, $comm, $stat, $itmid])){
			$alertMessage='<div class="alert alert-success" role="alert">Your comment has been edited</div>';
		}else{
			$alertMessage='<div class="alert alert-danger" role="alert">Comment could not be added!</div>';
		}
		return $alertMessage;
	}//end
	
	public function detectStatus($stat, $return1, $return2){
		if($stat==1){
			echo $return1;
		}else{
			echo  $return2;
		}
	}//end 
	
	public function selected($type1, $type2, $return){
		if($type1==$type2){
			echo $return;
		}
	}//end
}//end


?>