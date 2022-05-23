<?php 
get_header();
if ($_POST['form'] == 'new-course') {
	$new_post_arr = array(
		'post_title'    => $_POST['title'],
		'post_status'   => 'draft',
		'post_type' 	=> 'course'
	);	
	$new_post = wp_insert_post( $new_post_arr );
	$url = get_permalink($new_post);
	header('Location: /wp-admin/post.php?post='.$new_post.'&action=edit');
	exit;
}
?>
<h1><?=get_the_title()?></h1>
<form method="post">
	<label>
		<h5>Course Title</h5>		
		<input type="text" name="title">
	</label>
	<button value="new-course" name="form">Create Course</button>
</form>

<?php 
get_footer();
?>