	
<?php
//session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
  <title>PHP File Upload</title>
</head>
<body>
  <?php
    if (isset($_SESSION['message']) && $_SESSION['message'])
    {
      echo '<h4><p style=' .$_SESSION['success'].';>'.$_SESSION['message'].'</p></h4>';
      unset($_SESSION['message']);
      unset($_SESSION['success']);
    }
  ?>
  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
    <div class="upload-wrapper">
      <span class="file-name">Choose a file...</span>
      <label for="file-upload">Browse<input type="file" id="file-upload" name="uploadedFile"></label>
    </div>
 
    <input type="submit" name="uploadBtn" value="Upload" />
  </form>
</body>
</html>