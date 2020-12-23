<?php
defined('BASEPATH') or exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Secure card game!</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ui-lightness/jquery-ui.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/memory.css">

	<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/memory.js"></script>
</head>
<body>

<div id="container">
	<?php
	$maxNumberOfImages = 12;
	$images = array();

	$i = min($maxNumberOfImages * 2, max(12, intval(12)));
	$numberOfImages = floor($i / 2);
	$cols = ceil(sqrt($i));
	$rows = ceil($i / $cols);
	while (count($images) < $numberOfImages) {
		$rand = rand(1, $maxNumberOfImages);
		if (!in_array($rand, $images))
			array_push($images, $rand);
	}
	$images = array_merge($images, $images);
	shuffle($images);
	?>
	<h1>Secure card game!</h1>
	<?php
	if (!empty($images)) {
		echo '<div id="memory">';
		for ($r = 0; $r < $rows; $r++) {
			echo '<ul>';
			for ($c = 0; $c < $cols; $c++) {
				$i = $r * $cols + $c;
				if (isset($images[$i]))
				{
					$src = base_url('Welcome/get_image').'/'. str_replace(['+','/'],['zop','zox'],$this->encryption->encrypt($images[$i]));
					echo '<li><div><img id="'.$c.'" data-code="'.$this->encryption->encrypt($images[$i]).'" src="'.$src.'"/></div></li>'."\n";
				}
				sleep(0.2);
			}
			echo '</ul>';
		}
		echo '<br class="clear" />' . '<p>Pairs found: <span id="s">0</span> of ' . $numberOfImages . '</p>' . '<p>Attempts: <span id="a">0</span></p>' . '<p>Time elapsed: <span id="t">0</span></p>' . '</div>';
	}
	?>
</div>

</body>
</html>
