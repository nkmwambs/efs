<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

		session_start();

		$message = '';
		$success='color:green;';
		if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Upload') {

		// 	$ds          = DIRECTORY_SEPARATOR; 
	 
		// $storeFolder = 'uploads';  
		 
		// if (!empty($_FILES)) {
		 
		//     $tempFile = $_FILES['uploadedFile']['tmp_name'];         
		 
		//     $targetPath = $storeFolder . $ds; 
		 
		//     $targetFile =  $targetPath. $_FILES['uploadedFile']['name']; 
		 
		//     move_uploaded_file($tempFile,$targetFile);
		 
		// }
			if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
				// get details of the uploaded file
				$tempFile = $_FILES['uploadedFile']['tmp_name'];
				$fileName = $_FILES['uploadedFile']['name'];
				$fileSize = $_FILES['uploadedFile']['size'];
				$fileType = $_FILES['uploadedFile']['type'];
				$fileNameCmps = explode(".", $fileName);
				$fileExtension = strtolower(end($fileNameCmps));


				// check if file has one of the following extensions
				$allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'docx');

				if (in_array($fileExtension, $allowedfileExtensions)) {
					// directory in which the uploaded file will be moved
					// $uploadFileDir = 'uploads';
					// $dest_path = $uploadFileDir . $newFileName;

					$ds          = DIRECTORY_SEPARATOR; 
	 
					$storeFolder = 'uploads'; 

					$targetPath = $storeFolder . $ds; 

					$targetFile =  $targetPath. $_FILES['uploadedFile']['name'];

					if (move_uploaded_file($tempFile,$targetFile)) {
						$message = 'File is successfully uploaded.';
					} else {
						$success="color:red";
						$message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
					}
				} else {
					$success="color:red";
					$message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
				}
			} else {
				$success="color:red";
				$message = 'There is some error in the file upload. Please check the following error.<br>';
				$message .= 'Error:' . $_FILES['uploadedFile']['error'];
			}
		}
		$_SESSION['success']=$success;
		$_SESSION['message'] = $message;
		//header("Location: index.php");
		$this->load->view('welcome_message');
	}
}
