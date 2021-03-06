<?php
// include Config File
include_once './includes/config.inc.php';
include_once './includes/validate.php';
// Authenticate user login
auth();
validate_change_password();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<title><?php echo $lang['STORE_FINDER']; ?> - <?php echo $lang['ADMIN_CHANGE_PASSWORD']; ?></title>
	<?php include 'header.php'; ?>
</head>
<body id="add">
	<div id="wrapper">
		<div id="header">
			
			<?php include 'nav.php'; ?>
		</div>
		<div id="main">

			<?php echo notification(); ?>
			<?php if(isset($errors) && !empty($errors)): ?>
			<div class="alert alert-block alert-error fade in">
			<ul>
				<?php foreach($errors as $k=>$v): ?>
				<li><?php echo $v; ?></li>
				<?php endforeach; ?>
			</ul>
			</div>
			<?php endif; ?>



			<form method='post' action='./change_password.php?id=<?php echo $user['id']; ?>' id='form_new_store' enctype="multipart/form-data">
				<fieldset>
					<legend><?php echo $lang['ADMIN_CHANGE_PASSWORD']; ?></legend>
					<div class='input'>
						<label><?php echo $lang['ADMIN_NEW_PASSWORD']; ?>: <span class='required'>*</span></label>
						<input type='password' name='password' id='password'  />
					</div>
					<div class='input'>
						<label><?php echo $lang['ADMIN_CONFIRM_PASSWORD']; ?>: <span class='required'>*</span></label>
						<input type='password' name='cpassword' id='cpassword'  />
						
					</div>
					
				

					<div class='input buttons'>
						<button type='submit' class="btn" name='save' id='save'><?php echo $lang['ADMIN_SAVE']; ?></button>
					</div>
				</fieldset>
			</form>

		</div>
	</div>
<?php include '../themes/footer.inc.php'; ?>	
</body>
</html>