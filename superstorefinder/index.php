<?php
// include config file
include_once './includes/config.inc.php';

// list of available distances
$distances = array(
	200=>'200 Miles',
    100=>'100 Miles',
	50=>'50 Miles',
);


if(isset($_POST['ajax'])) {
	
	if(isset($_POST['action']) && $_POST['action']=='get_nearby_stores') {
		
		if(!isset($_POST['lat']) || !isset($_POST['lng'])) {
			
			echo json_encode(array('success'=>0,'msg'=>'Coordinate not found'));
		exit;
		}
		
		// support unicode
		mysql_query("SET NAMES utf8");

		// category filter
		if(!isset($_POST['products']) || $_POST['products']==""){
			$category_filter = "";
		} else {
			$category_filter = " AND cat_id='".$_POST['products']."'";
		}
		
		$sql = "SELECT *, ( 3959 * ACOS( COS( RADIANS(".$_POST['lat'].") ) * COS( RADIANS( latitude ) ) * COS( RADIANS( longitude ) - RADIANS(".$_POST['lng'].") ) + SIN( RADIANS(".$_POST['lat'].") ) * SIN( RADIANS( latitude ) ) ) ) AS distance FROM stores WHERE status=1 AND approved=1 ".$category_filter." HAVING distance <= ".$_POST['distance']." ORDER BY distance ASC LIMIT 0,60";
	
		
		
		echo json_stores_list($sql);
	}
exit;
}


$errors = array();

if($_POST) {
	if(isset($_POST['address']) && empty($_POST['address'])) {
		$errors[] = 'Please enter your address';
	} else {

			
		$google_api_key = '';

		$region = 'us';

		
		
		$xml = convertXMLtoArray($tmp);
		
		if($xml['Response']['Status']['code']=='200') {
			
			$coords = explode(',', $xml['Response']['Placemark']['Point']['coordinates']);
			
			if(isset($coords[0]) && isset($coords[1])) {
				
				$data = array(
					'name'=>$v['name'],
					'address'=>$v['address'],
					'latitude'=>$coords[1],
					'longitude'=>$coords[0]
				);

				
				$sql = "SELECT *, ( 3959 * ACOS( COS( RADIANS(".$coords[1].") ) * COS( RADIANS( latitude ) ) * COS( RADIANS( longitude ) - RADIANS(".$coords[0].") ) + SIN( RADIANS(".$coords[1].") ) * SIN( RADIANS( latitude ) ) ) ) AS distance FROM stores WHERE status=1 HAVING distance <= ".$db->escape($_POST['distance'])." ORDER BY distance ASC  LIMIT 0,60";
				
				$stores = $db->get_rows($sql);

				
				if(empty($stores)) {
					$errors[] = 'Stores with address '.$_POST['address'].' not found.';
				}
			} else {
				$errors[] = 'Address not valid';
			}
		} else {
			$errors[] = 'Entered address'.$_POST['address'].' not found.';
		}
	}
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<title><?php echo $lang['STORE_FINDER']; ?></title>
    <?php include ROOT."themes/meta.php"; ?>
</head>
<body id="super-store-finder">

	<div id="wrapper">
		<div id="header">
			
			<?php include ROOT."themes/nav.inc.php"; ?>
		</div>
		<?php echo notification(); ?>
		<div id="clinic-finder" class="clear-block">
		<div class="links"></div>
			
			<form method="post" action="./index.php" accept-charset="UTF-8" method="post" id="clinic-finder-form" class="clear-block" class="clear-block">
	  
				<div><div class="form-item" id="edit-gmap-address-wrapper">
				 <label for="edit-gmap-address"><?php echo $lang['PLEASE_ENTER_YOUR_LOCATION']; ?>: </label>
				 <input type="text" maxlength="128" name="address" id="address" size="60" value="" class="form-text" autocomplete="off" />
				</div>
				<?php 
				// support unicode
				mysql_query("SET NAMES utf8");
				$cats = $db->get_rows("SELECT categories.* FROM categories WHERE categories.id!='' ORDER BY categories.cat_name ASC");

				?>
				<div class="form-item" id="edit-products-wrapper">
				 <label for="edit-products"><?php echo $lang['SSF_CHOOSE_A_CATEGORY']; ?>: </label>
				 <select name="products" class="form-select" id="edit-products" ><option value=""><?php echo $lang['SSF_ALL_CATEGORY']; ?></option>
				 <?php if(!empty($cats)): ?>
					<?php foreach($cats as $k=>$v): ?>
					<option value="<?php echo $v['id']; ?>"><?php echo $v['cat_name']; ?></option>
					<?php endforeach; ?>
					<?php endif; ?>
				 </select>
				</div>
				
				
				<input type="submit" name="op" id="edit-submit" value="<?php echo $lang['FIND_STORE']; ?>" class="btn btn-large btn-primary" />
				<input type="hidden" name="form_build_id" id="form-0168068fce35cf80f346d6c1dbd7344e" value="form-0168068fce35cf80f346d6c1dbd7344e"  />
				<input type="hidden" name="form_id" id="edit-clinic-finder-form" value="clinic_finder_form"  />

				</div>
				<input type="hidden" id="distance" name="distance" value="200">
				</form>
						
					  <div id="map_canvas"><?php echo $lang['JAVASCRIPT_ENABLED']; ?></div>
					  <div id="results">        
						<h2><?php echo $lang['STORES_NEAR_YOUR']; ?></h2>
						<p class="distance-units">
						  <label class="km" units="km">
							<input type="radio" name="distance-units" value="kms" /><?php echo $lang['KM']; ?>
						  </label>
						  <label class="miles unchecked" units="miles">
							<input type="radio" checked="unchecked" name="distance-units" value="miles" /><?php echo $lang['MILES']; ?>
						  </label>
						</p>
						<ol style="height: 445px; display: block; " id="list"></ol>
					  </div>
					  
					  <div id="direction">
					  <form method="post" id="direction-form">
					  <p>
					  <table><tr>
					  <td>Origin:</td><td><input id="origin-direction" name="origin-direction" class="orides-txt" type=text /></td>
					  </tr>
					  <tr>
					  <td>Destination:</td><td><input id="dest-direction" name="dest-direction" class="orides-txt" type=text readonly /></td>
					  </tr>
					  </table>
					  <div id="get-dir-button" class="get-dir-button"><input type=submit id="get-direction" class="btn" value="Get Direction"> <a href="javascript:directionBack()">Back</a></div></p>
					  </form>
					  </div>
					  
	</div>
    <div class="overlay" id="overlay-contact-clinic-form"><div class="form-wrapper"></div></div>
  </div>
   <center>

  <br>
  
  <h4><?php echo $lang['EMBED']; ?>:</h4>
  <textarea id="embed" style="width:650px;"><iframe src="<?php echo ROOT_URL; ?>embed.php" width="980px" height="630px"  scrolling=no frameborder=no></iframe></textarea>
  <br>

  <a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
  <div class="fb-like" data-href="http://superstorefinder.net/products/superstorefinder" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>

  </center>
  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
  <div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=250642888282319";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	</script>
	
	<script>
			$('#address').val(geoip_city()+", "+geoip_country_name());
	</script>
	
<?php include ROOT."themes/footer.inc.php"; ?>
</body>
</html>