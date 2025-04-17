<?php
     error_reporting(E_ALL ^ E_NOTICE);
	 
    $allowedTypes = array('image/jpg', 'image/jpeg', 'image/png');
	
	$directory = "../pic/";
	$filecount = count(glob($directory . "*.{jpg,png}", GLOB_BRACE));
	$filecount=intval($filecount)+1;
		
	$ext = pathinfo($_FILES["fileInput"]["name"], PATHINFO_EXTENSION);
		

    if (in_array($_FILES["fileInput"]["type"], $allowedTypes))
    {
        if ($_FILES["fileInput"]["error"] > 0)
        {
            $alert="Error in uploading the picture";
        }
        else
        {
            if (file_exists($directory.$_FILES["fileInput"]["name"]))
            {
                $alert= $_FILES["fileInput"]["name"] . " already exists. ";
				$win_loc=$_SERVER['HTTP_REFERER'];
            }
            else
            {
				$filename=$filecount.'.'.$ext;
				
                move_uploaded_file($_FILES["fileInput"]["tmp_name"], $directory. $filename);
                
                $alert="Picture was successfully uploaded.";
				$win_loc="../article.php?story_id=".$filecount;
            }
        }
    }
    else
    {
        $alert="Picture must be in JPG/JPEG/PNG format.";
		$win_loc=$_SERVER['HTTP_REFERER'];
    }
?>

<script type="text/javascript" language="javascript">
	alert('<?php echo $alert;?>')
	window.location = "<?php echo $win_loc; ?>"
</script>

