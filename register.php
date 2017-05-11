
<?php


$fn_error=$ln_error=$e_error=$g_error=$p1_error=$p2_error=$pt_error=$ps_error=$pr_error=$log_em_er=$log_pas_er="";
$firstName=$lastName=$email=$gender=$password1=$password2=$passportScan=$eml=$password="";
if (isset($_POST['submitButton']))
 {
	# code...
	if (empty($_POST['firstName']) ) {
		# code...
		$fn_error="Name is required";
	}
	
	else
	{
		$firstName=$_POST['firstName'];

		if (!preg_match("/^[a-zA-Z ]*$/",$firstName)) {
			# code...
			$fn_error="Only letters allowed";
		}
	}
	if (empty($_POST['lastName'])) {
		# code...
		$ln_error="Last name is required";
	}
	else {
		# code...
		$lastName=$_POST['lastName'];
		if ((!preg_match("/^[a-zA-Z ]*$/",$lastName))) {
			# code...
			$ln_error="Only letters allowed";
		}
		
	}
	 
	if (empty($_POST['email'])) {
		# code...
		$e_error="Email is required";
	} 
	else  {
		# code...
		$email=$_POST['email'];
		if ((!filter_var($email, FILTER_VALIDATE_EMAIL))) {
			# code...
			$e_error="Invalid email";
		}
		
	}
	
	if (empty($_POST['gender'])) {
		# code...
		$g_error="gender is requred";
	} 

	else {
		# code...
		$gender=$_POST['gender'];
	}
	if (empty($_POST['password1'])) {
		# code...
		$p1_error="password is required";
	} else {
		# code...
		$password1=$_POST['password1'];
	}
	if (empty($_POST['password2'])) {
		# code...
		$p2_error="password is required";
	} 
	elseif ($_POST['password1']!=$_POST['password2']) {
		# code...
		$p2_error="Wrong password";
	}
	else {
		# code...
		$password2=$_POST['password2'];
	}

	$name = $_FILES['passportScan']['name'];  
    $temp_name = $_FILES['passportScan']['tmp_name'];  
    $photosize = $_FILES['passportScan']['size'];
    $phototype = pathinfo($name,PATHINFO_EXTENSION);
    if(isset($name)){
        if(!empty($name))
        {     
        	if (($phototype!='png') && ($phototype!='jpg') && ($phototype!='jpeg')) {
        		# code...
        		$pt_error="wrong type";
        	} else {
        		# code...
        		if ($photosize>1000000) {//>1MB
        			# code...
        			$ps_error="size is too big";
        		} else {
        			# code...
        			$location = 'img/';      
            		if(move_uploaded_file($temp_name, $location.$name)){}

            			if($firstName==$_POST['firstName'] && $lastName==$_POST['lastName'] && $password2==$_POST['password2'] &&
							$email==$_POST['email'] && $gender==$_POST['gender'] && $password1==$_POST['password1'])
								{
									header('Location: it.html');
									$servername = "";
									$username = "root";
									$password = "";
									$dbname = "r";

									try {
									    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
									    // set the PDO error mode to exception
									    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
									    $sql="CREATE DATABASE IF NOT EXISTS $dbname";
									    $conn->exec($sql);
									    $sql="CREATE TABLE IF NOT EXISTS r_table (
									    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
									    firstname VARCHAR(20) NOT NULL,
									    lastname VARCHAR(20) NOT NULL,
									    email VARCHAR(50) NOT NULL,
									    gender VARCHAR(10) NOT NULL,
									    password VARCHAR (15) NOT NULL
									    )";
										$conn->exec($sql);
									    $sql="INSERT INTO r_table(firstname,lastname,email,gender,password)VALUES('$firstName', '$lastName', '$email', '$gender', '$password1')";
									    $conn->exec($sql);
									    
									    echo "Table MyGuests created successfully";
									    }
									catch(PDOException $e)
									    {
									    echo $sql . "<br>" . $e->getMessage();
									    }

									$conn = null;
								}
        		}
        		
        	}
        	
            
        } 
        else
        {
        	$pr_error="Photo is required";
        }      
    } 
}
	if (isset($_POST['log'])) {
								# code...
		

			
								$servername = "";
									$username = "root";
									$password = "";
									$dbname = "r";

									try {
									    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
									    // set the PDO error mode to exception
									    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
									    $sql = $conn->prepare("SELECT email FROM r_table");
									    $sql->execute();

									    // set the resulting array to associative
									    $result = $sql->setFetchMode(PDO::FETCH_ASSOC); 
									    
									     foreach(new RecursiveArrayIterator($sql->fetchAll()) as $key=>$value) {
									     	foreach ($value as $keyy => $valu) {
									     		# code...
									     		 if (empty($_POST['email'])) {
									        	# code...
									        	$log_em_er="Fill email form";
									        }
									        else{
									        	# code...
									        	if ($_POST['email']==$valu) {
									        		# code...
									        		 
									        		$eml=$valu;
									        		
									        	} else {
									        		# code...
									        		$log_em_er="Invalid email";
									        		
									        	}
									        }
									     	}
									        //email
									       
									        	
									        	

									        }

									        $sql = $conn->prepare("SELECT password FROM r_table");
										    $sql->execute();

										    // set the resulting array to associative
										    $result = $sql->setFetchMode(PDO::FETCH_ASSOC); 
										     foreach(new RecursiveArrayIterator($sql->fetchAll()) as $key=>$value) {
									        //password
										     	
										     	foreach ($value as $keyy => $valu) {
										     		# code...
										     		
										     		if (empty($_POST['password'])) {
										     			
										     		# code...
										     		$log_pas_er="Fill password form";
										     	} else {
										     		# code...
										     		 if ($_POST['password']==$valu)
										     		 	
									        	# code...
									        	 {
									        	 	
									        		# code...
									        		$password=$valu;
									        		
									        		

									        	} else {
									        		# code...
									        		$log_pas_er="Invalid password";
									        		
									        	}
										     	}
										     	}
										     	
										     	

									       
									        	
									        	
									       }
									      
									    }
									    catch(PDOException $e)
												    {
												    echo $sql . "<br>" . $e->getMessage();
												    }

												$conn = null;
												
									        if ($eml==$_POST['email'] && $password==$_POST['password']) {
													# code...
													header('Location: it.html');
												}
												

										}
									   		 
									       
															

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/register.css">
	<link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script src="jquery-3.2.1.min.js"></script>
	<title>Main page</title>
</head>
<body>
	<div id="container">
		<div id="header">
			<div class="row">
			<div class="col-md-5"><a href="main.html"><img src="images/prototype.png"></a></div>
			<div class="col-md-7">
				<div class="row" >
					<nav >
						<div id="fmenu">
							<div class="container-fluid"> 
							<div >
								<ul class="nav navbar-nav">
								<?php 
								
								if ($eml=="uzoqov.95@mail.ru" && $password=="123456") {
									# code...

									?><li><a href="#"><span class="glyphicon glyphicon-briefcase"></span>Users </a></li><?php
								} else {
									# code...
									?><li><a href="#" onclick="jsAlert()"><span class="glyphicon glyphicon-briefcase"></span>Jobs </a></li><?php
								}
								?>
								
								<li><a href="#" onclick="jsAlert()"><span class="glyphicon glyphicon-send"></span> Send files</a></li>
								<li><a href="#" onclick="jsAlert()"><span class="glyphicon glyphicon-facetime-video"></span> Whiteboard</a></li>
								<li><a href="#" onclick="jsAlert()"><span class="glyphicon glyphicon-facetime-video"></span> Net Meeting</a></li>
								<li><a href="#" onclick="jsAlert()"><span class="glyphicon glyphicon-cog"></span>Tools</a></li>
								<li><a href="#" onclick="jsAlert()"><span class="glyphicon glyphicon-facetime-video"></span>Articles</a></li>
							</ul>	
							</div>
							
						</div>
						</div>
					</nav>
				</div>
				<div class="row">
					<nav >
						<div id="smenu"> 
							<div class="collapse navbar-collapse">
								<ul class="nav navbar-nav">
								<li><a href="#" onclick="jsAlert()"><span class="glyphicon glyphicon-home"></span>Preuniversity </a></li>
								<li><a href="#"><span class="glyphicon glyphicon-download"></span>Undergraduate</a></li>
								<li><a href="#" onclick="jsAlert()"><span class="glyphicon glyphicon-user"></span>Master</a></li>
								<li><a href="#" onclick="jsAlert()"><span class="glyphicon glyphicon-play-circle"></span>Life</a></li>
								<li><a href="#"><span class="glyphicon glyphicon-facetime-video"></span>FAQ</a></li>
								<li><a href="aboutus.html"><span class="glyphicon glyphicon-earphone"></span>About us</a></li>
								
							</ul>	
							</div>
							
						</div>
					</nav>
				</div>
			</div>
			</div>
		</div>
		<div id="menu">
			<div class="row" >
				<div class="col-md-12">
					
					<div class="row">.</div>
					<div class="row">.</div>
					<div id="mainm">
						<div class="row" >
							<div class="col-md-5"></div>
							<div class="col-md-4">Online Education</div>
							<div class="col-md-3"></div>
						</div>
						<div class="row">.</div>
						<div class="row">
							<div class="col-md-5"></div>
							<div class="col-md-2">
							<div class="form-group">
								<input type="text" class="form-control" name="search" placeholder="search...">
								
							</div>
							</div>
							<div class="col-md-1">
								<div class="input-group-btn"><button type="button" class="btn btn-default btn-block"><a href="#" class="glyphicon glyphicon-search">Search</a></div>
							</div>
							<div class="col-md-4"></div>
						</div>
						<div class="row">.</div>
						
						
						<div>
							<div class="row" >
							<div class="col-md-5"></div>
							<div class="col-md-1"><button type="button" class="btn btn-default btn-block" id="Registration" ><a href="#"><span class="glyphicon glyphicon-cd">Registration</a></button></div>
							<div class="col-md-1"><button type="button" class="btn btn-default btn-block" id="log"><a href="#"><span class="glyphicon glyphicon-user">Login</a></button></div>
							<div class="col-md-1"></div>
							<div class="col-md-4"></div>
						</div>
						</div>
						<div class="row">.</div>
						<div class="row">
						<div class="col-sm-5"></div>
						<div class="col-sm-4">
							<div id="register">
								<form method="post" action="register.php" enctype="multipart/form-data">
									<table>

									<tr>
										<td><p>First Name: </p></td>
										<td><input type="text" name="firstName"><span id="error">*<?php echo $fn_error;?></span></td>
									</tr>
									<tr>
										<td><p>Last Name: </p></td>
										<td><input type="text" name="lastName"><span id="error">*<?php echo $ln_error;?></span></td>
									</tr>
									<tr>
									<tr>
										<td><p>Email: </p></td>
										<td><input type="text" name="email" placeholder="example@mail.ru"><span id="error">*<?php echo $e_error;?></span></td>
									</tr>
										<td><p>Gender: </p></td>
										<td><input type="radio" name="gender" value="male"><p>Male</p><input type="radio" name="gender" value="female"><p>Female</p>
										<span id="error">*<?php echo $g_error;?></span></td>
									</tr>
									<tr>
										<td><p>Password: </p></td>
										<td><input type="password" name="password1"><span id="error">*<?php echo $p1_error;?></span></td>
									</tr>
									<tr>
										<td><p>Confirm password: </p></td>
										<td><input type="password" name="password2"><span id="error">*<?php echo $p2_error;?></span></td>
									</tr>
									<tr>
										<td><p>Photo: </p></td>
										<td><input type="file" name="passportScan"  id="passportScan"><span id="error">*<?php echo $pt_error;echo $ps_error;echo $pr_error;?></span></td>
									</tr>
									<tr>
										<td><input type="submit" name="submitButton" id="submitButton" value="Register"></td>
									</tr>
								</table>
								</form>
							</div>
							<div id="login">
									<form method="post" action="register.php" enctype="multipart/form-data">
										<table>
											<tr>
												<td><p>Email: </p></td>
												<td><input type="text" name="email" placeholder="example@mail.ru"><span id="error">*<?php echo $log_em_er;?></td>
											</tr>
											<tr>
												<td><p>Password: </p></td>
												<td><input type="password" name="password"><span id="error">*<?php echo $log_pas_er;?></td>
											</tr>
											<tr>
												<td><input type="submit" name="log" value="Log in"></td>
											</tr>

										</table>
									</form>
								</div>



							<script>
 								 	$("#Registration").click(function()
 								 	{
  								  		$("#register").toggle(1000);
  								  		$("#login").hide(1000);
									});
								 $("#log").click(function()
 								 	{
 								 		$("#register").hide(1000);
  								  		$("#login").toggle(1000);

									});
							</script>
						
								
							</div>
							<div class="col-sm-3"></div>
							
						</div>
						
					</div>
				
				</div>
			</div>
		</div>
		<div id="content">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<h2>Videos</h2>
					<table>
						<tr>
							<td><a href="#" onclick="jsAlert()"><img src="images/it_icon.png"></a></td>
							<td><a href="#" onclick="jsAlert()"><img src="images/math_icon.png"></a></td>
							<td><a href="#" onclick="jsAlert()"><img src="images/physics_icon.png"></a></td>
							<td><a href="#" onclick="jsAlert()"><img src="images/chem_icon.png"></a></td>
						</tr>
						<tr>
							<td><a href="#" onclick="jsAlert()"><img src="images/biology_icon.jpg"></a></td>
							<td><a href="#" onclick="jsAlert()"><img src="images/history_icon.jpg"></a></td>
							<td><a href="#" onclick="jsAlert()"><img src="images/english_icon.jpg"></a></td>
							<td><a href="#" onclick="jsAlert()"><img src="images/russian_icon.png"></a></td>
						</tr>

					</table>
				</div>
				<div class="col-md-3"></div>
			</div>
		</div>
		<div class="row">
			<div id="footer">
			<footer>
				<p>Copyright</p>
			</footer>
		</div>
		</div>
		
	</div>
	<script type="text/javascript">
							function jsAlert()
							{
								alert("You have to register first...");
							}
							</script>
	
</body>
</html>