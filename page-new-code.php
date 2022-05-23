<?php 
$new_post_arr = array(
	'post_title'    => $text,
	'post_status'   => 'publish',
	'post_type' 	=> 'code'
);	
$new_post = wp_insert_post( $new_post_arr );
pre($new_post);
wp_update_post(array(
	'ID'           => $new_post,
	'post_title'    => 'Codebox: '.$new_post,
));
$url = get_permalink($new_post);
header('Location: '.$url);
exit;
?>
