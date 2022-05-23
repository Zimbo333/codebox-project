<?php 
global $codeboxType;
global $post_id;
global $owner_id;
global $owner_name;
global $is_login;
global $is_owner;
global $uid;

$codeboxType = 'code';

$post_id = get_the_ID();
$owner_id = $post->post_author;
$owner_name = get_the_author_meta( 'display_name', $owner_id);

// ===
$is_login = is_user_logged_in();
$is_owner = null;
$uid = null;


if ($is_login) {
	$uid = get_current_user_id();
	if ($uid == $owner_id) {
		$is_owner = true;
	}
}
if ($_POST['cmd'] === 'clone') {
	// สร้าง post
	$postarr = array(
		'post_type' => 'code',
		'post_title' => 'Copy of '.get_the_title(),
		'post_author' => $uid,
		'post_status' => 'publish',
	);
	$new_code = wp_insert_post($postarr);

	// แก้ slug
	$update_slug = array(
		'ID' => $new_code,
		'post_name' => $new_code,
	);
	wp_update_post($update_slug);
	//ใส่ value ใน custom filed
	update_field('html',$_POST['code_area'],$new_code);
	

	header('Location: '.get_permalink($new_code));
	die();
}

// if (isset($POST['new_branch'])) {

// }

if (isset($_GET['preview'])) {
	get_template_part('template-parts/codebox','preview');
}else{
	get_template_part('template-parts/codebox','editor');
}
?>
