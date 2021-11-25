<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ckupload extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
    }
	public function index()
	{
		$tmp_name=$_FILES['upload']['name'];
		$ext = pathinfo($tmp_name, PATHINFO_EXTENSION);
		
		$newfilename=time();
		
		$url = 'uploads/ckupload/'.$newfilename.".".$ext;

		//extensive suitability check before doing anything with the file...
		if (($_FILES['upload'] == "none") OR (empty($_FILES['upload']['name'])) )
		{
			$message = "No file uploaded.";
		}
		else if ($_FILES['upload']["size"] == 0)
		{
			$message = "The file is of zero length.";
		}
		else if (($_FILES['upload']["type"] != "image/pjpeg") AND ($_FILES['upload']["type"] != "image/jpeg") AND ($_FILES['upload']["type"] != "image/png") AND ($_FILES['upload']["type"] != "image/gif"))
		{
			$message = "The image must be in either GIF , JPG or PNG format. Please upload a JPG or PNG instead.";
		}
		
		else if (!is_uploaded_file($_FILES['upload']["tmp_name"]))
		{
			$message = "You may be attempting to hack our server. We're on to you; expect a knock on the door sometime soon.";
		}
		else {
			$message = "";		
			$this->uploadimage($newfilename);
			//$url = "../" . $url;
		}

		
		if($message != "")
		{
			$url = "";
		}
		else{
			$url =base_url().$url;
		}

		$funcNum = $_GET['CKEditorFuncNum'] ;
		echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
	}
	
	public function uploadimage($newfilename){
			$this->load->library('upload'); 
			$large_config['upload_path'] ='uploads/ckupload/';
			$large_config['allowed_types'] = 'gif|jpg|png|pdf';
			$large_config['max_size']    = '2000000';
			$large_config['max_width']  = '5000';
			$large_config['max_height']  = '5000';
			$large_config['file_name']  =$newfilename;
			$this->upload->initialize($large_config);     
			if ( ! $this->upload->do_upload("upload")){
				echo $this->upload->display_errors();
				$fname='';
			}else{
				$data_upload= $this->upload->data();
				$fname=$data_upload['file_name'];
				list( $width,$height ) = getimagesize('uploads/ckupload/'.$fname);
				if($width>878){
				$this->load->library('image_lib');
				$large_config2['image_library'] = 'gd2';
				$large_config2['source_image'] ='uploads/ckupload/'.$fname;       
				$large_config2['maintain_ratio'] = TRUE;
				$large_config2['width'] = 878;
				$large_config2['height'] = 1;
				$large_config2['master_dim'] = 'width';
				$large_config2['new_image'] ='uploads/ckupload/'.$fname;        
				$this->image_lib->initialize($large_config2);
				if(!$this->image_lib->resize())
				{ 
					echo $this->image_lib->display_errors();
				}
				}
			}   
	}
}
