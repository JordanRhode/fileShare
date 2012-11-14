<?php // index.php
include "accesscontrol.php"; 
include "header.php";
?>

<!--
	Rhetorical Analysis

	I was able to get everything working on this site. The only trouble I had was getting the uploading of 
	the file to work correctly and making the authentication work correctly. I couldn't find whether or not 
	I can check if the file exists with javascript so I have to do it on the server side.
	
	secondary user password/username: test
	primary user password/username: test2
	-->

<!DOCTYPE html PUBLIC "-//W3C/DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="./assets/scripts/javascript.js"></script>
<!-- Bootstrap -->
<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/styles.css" rel="stylesheet">
	
			<?php
				//display details specific to primary user
				if($userType == "primary")
				{
					?>
					<form action="index.php" onsubmit="return checkUpload(this);" method="post" enctype="multipart/form-data" class="form-horizontal">
					<h1 class="leftPadded">Upload Your Files Here!</h1>
						<div class="control-group">
						    <label class="control-label" for="file">Filename: </label>
						    <div class="controls">
						      <input type="file" id="file" name="file" />
						    </div>
						    <div class="controls">
						    	<br/>
								<input type="submit" id="submit" name="submit" value="Submit" />
						    </div>
						  </div>
					</form>
					<div id="message"><p>
							<?php
								// server side validation, checks for correct file type, file size, and whether or not
								// the file exists in the folder already. If it is valid, then it places the file in 
								// the correct folder.
								if(isset($_POST['submit']))
								{
									$allowedExts = array("jpg", "jpeg", "JPG", "JPEG");
									$extension = explode(".", $_FILES["file"]["name"]);
									if($_FILES["file"]["type"] == "image/jpeg" || $_FILES["file"]["type"] == "image/jpg") 
									{
									}	
									else 
									{
										echo "Invalid file type, must be .JPG or .JPEG<br/>";
									}
									if ($_FILES["file"]["size"] > 8000000) 
									{
										echo "File size is too large, must be less than 800kb";
									}	
								    elseif ($_FILES["file"]["error"] > 0)
								    {
								    	echo "Error: " . $_FILES["file"]["error"] . "<br />";
								    }
								    elseif (file_exists("./assets/upload/" . $_FILES["file"]["name"]))
								    {
								    	echo $_FILES["file"]["name"] . " already exists. ";
								    }
								    else
								    {
								      move_uploaded_file($_FILES["file"]["tmp_name"],
								      "./assets/upload/" . $_FILES["file"]["name"]);
						    }
		    			}
					?>
					</p></div>
					<div id="primaryFiles" class="leftPadded"><br/>
					<h1>Uploaded Files</h1>

						<?php
							$dir = opendir("./assets/upload/");
							// lists all the files in the directory allowing you to click on them or delete them.
							while(($file = readdir($dir)) !== false)
							{
								if($file !== "." && $file !== ".." && $file !== "delete_file.php")
								{
								echo "<a href='./assets/upload/" . $file . "' target='_blank'>" . $file . "</a>";
								?>
								<div class="delete"><a href="./assets/upload/delete_file.php?name=<?php echo $file?>">DELETE</a><br/></div>
								<?php
								}
							}
							closedir($dir);
						?>
					</div>
			<?php
				}//end of primary user

				else {
			?>
			<div id="secondaryFiles" class="leftPadded"><br/>
			<h1>Uploaded Files</h1>

				<?php
					$dir = opendir("./assets/upload/");
					// lists all the files in the directory only allowing you to click on them
					while(($file = readdir($dir)) !== false)
					{
						if($file !== "." && $file !== ".." && $file !== "delete_file.php")
						{
						echo "<a href='./assets/upload/" . $file . "' target='_blank'>" . $file . "</a><br/>";
						?>
						
						<?php
						}
					}
					closedir($dir);
				?>
			</div>
			<?php
				}//end of secondary user
				include "footer.php"
				?>