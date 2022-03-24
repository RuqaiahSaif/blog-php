<?php

	class Post 
	{
		private $servername = "localhost";
		private $username   = "root";
		private $password   = "";
		private $database   = "testlogin";
		public  $con;


		// Database Connection 
		public function __construct()
		{
		    $this->con = new mysqli($this->servername, $this->username,$this->password,$this->database);
		    if(mysqli_connect_error()) {
			 trigger_error("Failed to connect to MySQL: " . mysqli_connect_error());
		    }else{
			return $this->con;
		    }
		}

		// Insert post data into customer table
		public function insertData($post)
		{
			$postname = $this->con->real_escape_string($_POST['postname']);
			$postdesc = $this->con->real_escape_string($_POST['postdesc']);
			$query="INSERT INTO post(post_id,post_title,post_desc) VALUES(null,'$postname','$postdesc')";
			$sql = $this->con->query($query);
			if ($sql==true) {
			    header("Location:home.php?msg1=insert");
			}else{
			    echo "Something Went Wrong. Please try again!";
			}
		}

        // Fetch post records for show listing
		public function displayData()
		{
		    $query = "SELECT * FROM post";
		    $result = $this->con->query($query);
		if ($result->num_rows > 0) {
		    $data = array();
		    while ($row = $result->fetch_assoc()) {
		           $data[] = $row;
		    }
			 return $data;
		    }else{
			 echo "No found records";
		    }
		}
// Fetch single data for edit from customer table
		public function displyaRecordById($id)
		{
		    $query = "SELECT * FROM post WHERE post_id = '$id'";
		    $result = $this->con->query($query);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			return $row;
		    }else{
			echo "Record not found";
		    }
		}
        	// Update post data into post table
		public function updateRecord($postData)
		{
		    $postname = $this->con->real_escape_string($_POST['postname']);
		    $postdesc = $this->con->real_escape_string($_POST['postdesc']);
		    $id = $this->con->real_escape_string($_POST['id']);
		if (!empty($id) && !empty($postData)) {
			$query = "UPDATE post SET post_title = '$postname' , post_desc = '$postdesc' WHERE post_id = '$id'";
			$sql = $this->con->query($query);
			if ($sql==true) {
			    header("Location:home.php?msg2=update");
			}else{
			    echo "Registration updated failed try again!";
			}
		    }
			
		}
        	// Delete post data from post table
		public function deleteRecord($id)
		{
		    $query = "DELETE FROM post WHERE post_id = '$id'";
		    $sql = $this->con->query($query);
		if ($sql==true) {
			header("Location:home.php?msg3=delete");
		}else{
			echo "Record does not delete try again";
		    }
		}
// no domain
public function get_share_url($id,$title,$link="news",$media)
{
    global $domain;
      $title = stripslashes(str_replace(array('\'', '"'), '', $title));
    if ($media == "facebook") {
        return "http://www.facebook.com/sharer.php?u=" . $domain . "/" .  $link . $id . ".html";
    } else if ($media == "twitter") {
        return "http://twitter.com/share?text=" . stripslashes($title) . "&url=https://" . $domain . "/" . $link . $id . ".html";
    } else if ($media == "whatsapp") {
        return "whatsapp://send?text=" . stripslashes($title) . "\n https://" . $domain . "/" . $link . $id . ".html";
    } else if ($media == "telegram") {
        return  "https://telegram.me/share/url?url=" . $domain . "/" . $link . $id . ".html&text=<TEXT>=" . stripslashes($title);
    }
    return "";
}


	}

      
  
?>