<?php

class Users extends Db_object
{
	protected static $db_table="users";
	protected static $db_table_fields = array('username','password','first_name','last_name','user_image');
	public $id;
	public $username;
	public $password;
	public $first_name;
	public $last_name;
	public $user_image;
	public $upload_directory="images";
	public $image_placeholder="http://placeholder.it/400x400&text=images";
	public function image_path_and_placeholder()
	{
		return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image;
	}
	
	
	public function set_files($file)
	{
		if(empty($file)|| !$file || !is_array($file))
		{
			$this->errors[]="There was no file uploaded here";
			return false;
		}
		elseif($file['error']!=0)
		{
			$this->errors[]=$this->upload_errors_array[$file['error']];
			return false;
		}
		else
		{
			$this->user_image= basename($file['name']);
			$this->tmp_path= $file['tmp_name'];
			$this->type= $file['type'];
			$this->size= $file['size'];
		}
	}
	
	
	public function save_user_and_image()
	{
		
		if(isset($this->id))  {
			
		$this->update();
		}

		else {
			$this->create();
		}
		
			if(!empty($this->errors))
			{
				return false;
			}
			
			if(empty($this->user_image)|| empty($this->tmp_path))
			{
				$this->errors[]="the file was not available";
			}
			
			$target_path=SITE_ROOT .DS. 'admin' . DS . $this->upload_directory . DS . $this->user_image;
			
			echo var_dump($target_path);
			
			if(file_exists($target_path))
			{
				$this->errors[]= "The file {$this->user_image} already exists";
				return false;
			}
			
			if(move_uploaded_file($this->tmp_path, $target_path))
			{
				
					unset($this->tmp_path);
					return true;
				
			}
			else
			{
				$this->errors[]="the file directory does not have permission";
			}
			
			
	    
	}
	
	
	public static function verify_user($username,$password)
	{
		global $database;
		
		$username=$database->escape_string($username);
		
		$password=$database->escape_string($password);
		
		$sql="SELECT * FROM ".self::$db_table ." WHERE ";
		$sql.="username = '{$username}' ";
		$sql.="AND password = '{$password}' ";
		$sql.="LIMIT 1";
  
		$the_result_array=self::find_all_queries($sql);
     
	    return !empty($the_result_array) ? array_shift($the_result_array) : false;
	}
	
	
	public function ajax_save_user_image($user_image, $user_id) {
   
   
    global $database;
   
    $user_image = $database->escape_string($user_image);
    $user_id = $database->escape_string($user_id);
   
    $this->user_image = $user_image;
    $this->id         = $user_id;
   
    $sql  = "UPDATE " . self::$db_table . " SET user_image = '{$this->user_image}' ";
    $sql .= " WHERE id = {$this->id} ";
    $update_image = $database->query($sql);
   
   
    echo $this->image_path_and_placeholder();
    
   
}

public function delete_photo()
	{
		if($this->delete())
		{
			$target_path= SITE_ROOT.DS.'admin'. DS. $this->upload_directory . DS. $this->user_image;
			
			return unlink($target_path) ? true : false;
		}
		else
		{
			return false;
		}
	}
   



}



?>