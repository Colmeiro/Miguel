<?php
include('config.php');

$db_file = CONFIG_PATH.'/database.php';
$config_file = CONFIG_PATH.'/config.php';
//Sanity Checks
$sanity = TRUE;
$errors = '';
if(!file_exists($db_file) || !file_exists($config_file) || !file_exists($sql_file) && !is_writable($db_file)){
	$sanity = FALSE;
	$errors = '';
	$errors .= ((!file_exists($db_file)) ? 'CI Database file not found at '.$db_file.'.<br />' : ' ' );
	$errors .= ((!file_exists($config_file)) ? 'CI Config file not found at '.$config_file.'.<br />' : ' ' );
	$errors .= ((!file_exists($sql_file)) ? 'Database dump file not found at '.$sql_file.'.<br />' : ' ' );
	$errors .= ((!is_writable($db_file)) ? 'Database config file not writable '.$sql_file.'.<br />' : ' ' );
}
//Do files stuff
$error = FALSE;
if(isset($_POST['database'])){
	$info = TRUE;
	
	$dbname = $_POST['dbname'];
	$dbuser = $_POST['dbuser'];
	$dbpass = $_POST['dbpass'];
	$dbhost = $_POST['dbhost'];
	$dbpref = $_POST['dbprefix'];
	$dbdriver = $_POST['dbdriver'];

	if(isset($dbname) && isset($dbuser) && isset($dbpass) && isset($dbhost) && isset($dbdriver)){
		//Try to connect to DB
		$mysqli = new mysqli($dbhost,$dbuser,$dbpass,'');
		$creds_valid = (($mysqli->connect_error) ? FALSE : TRUE);
		//$mysqli->close();
		
		if($creds_valid)
		{
			// Crea la base de datos sino existe
			$sql = 'CREATE DATABASE IF NOT EXISTS '.$dbname;
			$dbSuccess = FALSE;
			$dbDumb = FALSE;
			if($mysqli->query($sql))
			{
				$dbSuccess = TRUE;
			}
			$mysqli->close();

			//Si se ha creado la base de datos o existe. Ejecuta los comandos sql existente en el archivo sql
			if($dbSuccess)
			{
				$mysqli = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
				$query = file_get_contents($sql_file);
				if($mysqli->multi_query($query))
				{
					$dbDumb = TRUE;
				}
				$mysqli->close();
			}
			
			//Graba los datos de conexión a la base de datos en el archivo database.php
			//Captura el contenido del archivo de base de datos y hace las sustituciones.
			$template = 'files/database.php';
			$temp = file_get_contents($template);
			$temp = str_replace("%DB_HOSTNAME%", $dbhost, $temp);
			$temp = str_replace("%DB_USERNAME%", $dbuser, $temp);
			$temp = str_replace("%DB_PASSWORD%", $dbpass, $temp);
			$temp = str_replace("%DB_NAME%", $dbname, $temp);
			$temp = str_replace("%DB_DRIVER%", $dbdriver, $temp);
			$temp = str_replace("%DB_PREFIX%", $dbpref, $temp);
			
			//Graba el archivo de base de datos
			@chmod($db_file,0777);
			$handle = fopen($db_file,'w+');
			if(is_writable($db_file)) 
			{

				// Write the file
				if(fwrite($handle,$temp)) 
				{
					$info = TRUE;
				} else {
					$info = FALSE;
					$error = 'Error al grabar la información en application/config/database.php';
				}

			} else {
				$info = FALSE;
				$error = "El archivo '$db_file' no tiene permisos de escritura. Añada permisos de escritura (0777)";
			}
		}else{
			$info = FALSE;
			$error = 'No se puede conectar a la base de datos con la información proporcionada';
		}
		$mysqli->close();
	}else{
		//Error
		$info = FALSE;
		$error = 'Algún campo no requerido no ha sido cumplimentado.';
	}
	unset($_POST);

	if($info && $dbSuccess && $dbDumb)
	{
		//Si todo ha sido correcto con la base de datos pasamos al paso 2
		header('Location: index.php?page=2');
	}else{
		$error = '';
		if(!$dbSuccess){
			$error .= 'Podría ser que no se hubiese podido crear la base de datos, será necearios crearla de forma manual.';
		}
		if(!$dbDumb){
			$error .= '<br />Could not execute queries in the file';
		}
	}
}elseif(isset($_POST['config'])){
	//Configuration
	$info = TRUE;
	$baseurl = $_POST['baseurl'];
	$indexpage = $_POST['indexpage'];
	$enckey = $_POST['enckey'];
	$sitename = $_POST['sitename'];
	$sitelogo = '';
	$sitelogosmall = '';
	$siteicon = '';

	if(!empty($baseurl) && !empty($sitename))
	{
		//Comprobamos si se subió logo. Si se subió pero devuelve error lo mostramos y no seguimos el proceso.
		//Lo mismo con el icono.
		$upLogoResult = upload_file($sitelogo, 'sitelogo', 'logo/');
		$upLogoSmallResult = upload_file($sitelogosmall, 'sitelogosmall', 'logo/');
		$upIconResult = upload_file($siteicon, 'siteicon', 'icon/');
		if(isset($upLogoResult['info']) && !$upLogoResult['info']) {
			$info = $upLogoResult['info'];
			$error = $upLogoResult['error'];
		} else if(isset($upLogoSmallResult['info']) && !$upLogoSmallResult['info']) {
			$info = $upLogoSmallResult['info'];
			$error = $upLogoSmallResult['error'];
		} else if(isset($upIconResult['info']) && !$upIconResult['info']) {
			$info = $upIconResult['info'];
			$error = $upIconResult['error'];
		} else {
			//Si no se subió logo o se subió correctamente, guardamos el resto de datos en el config.
			@chmod($db_file,0777);
			$handle = fopen($config_file,'w+');
			if(is_writable($config_file)) 
			{
				//Guarda los datos del archivo config
				$template = 'files/config.php';
				$temp = file_get_contents($template);
				$temp = str_replace("%BASE_URL%", $baseurl, $temp);
				$temp = str_replace("%INDEX_PAGE%", $indexpage, $temp);
				$temp = str_replace("%ENC_KEY%", $enckey, $temp);
				$temp = str_replace("%SITE_NAME%", $sitename, $temp);
				$temp = str_replace("%SITE_LOGO%", $sitelogo, $temp);
				$temp = str_replace("%SITE_LOGOSMALL%", $sitelogosmall, $temp);
				$temp = str_replace("%SITE_ICON%", $siteicon, $temp);
				
				// Se escribe en el archivo
				if(fwrite($handle,$temp)) 
				{
					$info = TRUE;
				} else {
					$info = FALSE;
					$error = 'Error al guardar la información';
				}

			} else {
				$info = FALSE;
				$error = "El archivo '$config_file' no tiene permisos de escritura. Añada permisos de escritura (0777)";			
			}
		}
	}else{
		$info = FALSE;
		$error = 'Base URL y Encryption Key son valores obligatorios';
	}
	if($info){
		header('Location: index.php?page=3&url='.$baseurl);
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?= 'Install | '.SITE_TITLE; ?></title>
		<style>
			body {
				background-color: #D8D8D8;
				
			}
			.container {
				width: 70%;
				margin: auto;
				background-color:#F9F9F9;
				border: 1px solid #B3B3B3;
				padding:3px;
			}
			.title {
				text-align:center;
			}
			.subtitle {
				text-align:center;
			}
			.content {
				padding-left:3px;
				padding-right:3px;
				text-align:center
			}
			a {
				text-decoration: none;
			}
			.btn {
				background-color: #BDBDBD;
				padding:4px 14px 4px 14px;
				font-size:1.5em;
				border: 1px solid gray;
				text-transform: uppercase;
				color: green;
			}
			.btn:hover{
				background-color:#8B8B8B
			}
			.group {
				margin-bottom:0.5em;
				display: table;
				width:100%;
			}
			form{
				position: relative;
				display: block;
				margin:auto;
			}
			input {
				border: 1px solid #A6FFD4;
				padding:5px;
				width:60%
			}
			select {
				border: 1px solid #A6FFD4;
				padding:5px;
				width:60%;
				background-color: white;
			}
			small {
				color: #FF6069;
			}
			label {
				text-align: left;
				position: relative;
			}
			.error {
				padding: 1em;
				background-color:#FFE8E9;
				color:#FF000E;
				text-align:center;
			}
			.success {
				padding: 1em;
				background-color:#FBFFFC;
				color:#09FF00;
				text-align:center;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<h1 class="title"><?= SITE_TITLE.' Instalación' ?></h1>
			<?php
			if($error){
				echo "<div class='error'>".$error."</div>";
			}
			?>
			<?php
			//Pages
			if(isset($_GET['page']) && is_numeric($_GET['page'])){
				if($_GET['page'] == '1'){ ?>
					<h4 class="subtitle">Información de la base de datos.</h4>
					<div class="content">
						<form action="" method="POST">
							<div>
								<div class="group">
									<label class="label">Base de datos VLX</label><br />
									<input type="text" name="dbname" required placeholder="Database Name" class="input">
								</div>
								<div class="group">
									<label class="label">Usuario VLX</label><br />
									<input type="text" name="dbuser" required placeholder="Username" class="input" value="pruebas_user">
								</div>
								<div class="group">
									<label class="label">Password VLX</label><br />
									<input type="password" name="dbpass" required placeholder="Password" class="input" value="12345">
								</div>
								<div class="group">
									<label class="label">Host de Base de datos VLX</label><br />
									<input type="text" name="dbhost" required placeholder="Database host" class="input" value="localhost">
								</div>
								<div class="group">
									<label class="label">Prefijo para las Tablas</label><br />
									<input type="text" name="dbprefix" placeholder="Table Prefix" class="input">
								</div>
								<div class="group">
									<label class="label">Driver de la base de datos</label><br />
									<label class="label">
										<select required name="dbdriver">
											<option value="mysqli">MySQLi</option>
											<option value="pdo">PDO</option>
											<option value="mysql">MySQL</option>
										</select>
									</label><br />
								</div>
							</div>
							<button class="btn" type="submit" name="database" value="1">Continuar</button>
						</form>
					</div>
				<?php }elseif($_GET['page'] == '2'){ ?>
					<h4 class="subtitle">Website Configuration</h4>
					<div class="content">
						<form action="" method="POST" enctype="multipart/form-data">
							<div>
								<div class="group">
									<label class="label">Base URL</label><br />
									<input type="text" name="baseurl" required placeholder="http://____vlx.es/" class="input" value="http://<? echo $_SERVER['SERVER_NAME']?>/"><br /><small>Con barra al final</small>
								</div>
								<div class="group">
									<label class="label">Index Page</label><br />
									<input type="text" name="indexpage" placeholder="index.php" class="input"><br /><small>Dejar en blanco si se está usando mod_rewrite</small>
								</div>
								<div class="group">
									<label class="label">Encryption Key</label><br />
									<input type="text" name="enckey" required placeholder="Encryption Key" class="input" value="<?php echo random_key_string();?>"><br /><small>Código de encriptación generado de forma automática.</small>
								</div>
								<div class="group">
									<label class="label">Nombre a mostrar en el title del backend</label><br />
									<input type="text" name="sitename" placeholder="" class="input" value="<?= isset($sitename) && is_string($sitename) ? $sitename : '' ?>">
								</div>
								<div class="group">
									<label class="label">Logo</label><br />
									<input type="file" name="sitelogo" class="input">
								</div>
								<div class="group">
									<label class="label">Logo pequeño</label><br />
									<input type="file" name="sitelogosmall" class="input"><br /><small>Se mostrará al contraer el menú lateral izquierdo.</small>
								</div>
								<div class="group">
									<label class="label">Icono (favicon)</label><br />
									<input type="file" name="siteicon" class="input"><br /><small>El que se muestra en la pestaña del navegador Web.</small>
								</div>
							</div>
							<button class="btn" type="submit" name="config" value="1">Continuar</button>
						</form>
					</div>
				<?php }elseif($_GET['page'] == '3'){ ?>
					<h4 class="subtitle">Instalación Completa</h4>
					<div class="content">
						<p>
							<div class="success">
								Parece que todo ha salido correctamente!
							</div>
							<div class="error">
								Recomendado borrar la carpeta 'install' o moverla a otra ubicación no accesible
							</div>
							<br />
							<a href="<?php echo $_GET['url']; ?>">Ir al sitio.</a>
							<br />
							<br />
						</p>
					</div>
				<?php }
			}else{ ?>
				<h4 class="subtitle">Welcome to the CodeIgniter 3 Web installer</h4>
				<div class="content">
					<p>Before we get started, you will need to know the following:
						<ol>
							<li>Database Name</li>
							<li>Database Username</li>
							<li>Database Password</li>
							<li>Database Host</li>
							<li>Table Prefix</li>
						</ol>
						We will use this information to create '<strong><i><?= $db_file; ?></i></strong>' database configuration file.
					</p>
					<p>The above information is provided by your Web Host. Contact them if you don't have this information
						<br />
						If all is set...
					</p>
					<p>
						<?php
						if(!$sanity){ ?>
							<div class="error">
								Cannot Continue. Sanity Checks failed!<br />
								<?= $errors; ?>
							</div>
						<?php }else{ ?>
							<a class="btn" href="index.php?page=1">Start</a>
						<?php }
						?>
					</p>
				</div>
			<?php }
			?>
		</div>
	</body>
</html>
<?php
function random_key_string() {
    $source = bin2hex(openssl_random_pseudo_bytes(128));
    $string = '';
    $c = 0;
    while(strlen($string) < 32) { 
        $dec = gmp_strval(gmp_init(substr($source, $c*2, 2), 16),10);
        if($dec > 33 && $dec < 127 && $dec !== 39)
            $string.=chr($dec);
        $c++;
    }
    return str_replace(array('\'', '"', '\\'), array('', '', ''),$string);
}

function upload_file(&$file, $file_key_name='', $subfolder='') {
	$uploadOk = TRUE;
	if(!isset($_FILES[$file_key_name]["name"]) || empty($_FILES[$file_key_name]["name"])) {
		return array('info' => $uploadOk, 'error' => '');
	}

	$target_dir = "../assets/img/" . $subfolder;
	$target_file = $target_dir . basename($_FILES[$file_key_name]["name"]);
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	// Check if image file is a actual image or fake image
	$check = getimagesize($_FILES[$file_key_name]["tmp_name"]);
	if($check === false) {
		$uploadOk = FALSE;
		return array('info' => $uploadOk, 'error' => 'File is not an image.');
	}

	// Check if file already exists
	if (file_exists($target_file)) {
		$uploadOk = FALSE;
		return array('info' => $uploadOk, 'error' => 'Sorry, file already exists.');
	}

	// Check file size
	if ($_FILES[$file_key_name]["size"] > 5242880) {
		$uploadOk = FALSE;
		return array('info' => $uploadOk, 'error' => 'Sorry, your file is too large. (Max. 5MB)');
	}

	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		$uploadOk = FALSE;
		return array('info' => $uploadOk, 'error' => 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.');
	}

	// If everything is ok, try to upload file
	if (move_uploaded_file($_FILES[$file_key_name]["tmp_name"], $target_file)) {
		// echo "The file ". htmlspecialchars( basename( $_FILES[$file_key_name]["name"])). " has been uploaded.";
		$file = $target_file;
		return array('info' => $uploadOk, 'error' => '');
	} else {
		return array('info' => FALSE, 'error' => 'Sorry, there was an error uploading your file.');
	}
}
?>