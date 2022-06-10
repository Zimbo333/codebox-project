<?php 
get_header();
$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
$author_id = $author->ID;
$author_pic = get_avatar_url($author_id, array("size"=>260));


$posts = get_posts([
	'post_type' => 'course',
	'post_status' => 'publish',
	'numberposts' => -1,
]);

pre($posts);

?>

<!DOCTYPE html>
<html>
<head>	
	<?php wp_head();?>
	
	<script src="https://cdn.tailwindcss.com"></script>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Bai+Jamjuree:wght@400;500;700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.googleapis.com"> 
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@200;400;600&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/gh/lazywasabi/thai-web-fonts@6/fonts/Anuphan/Anuphan.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="<?=get_theme_file_uri()?>/theme.css?v=<?=time()?>">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Mono:wght@400;700&display=swap" rel="stylesheet">
	<style type="text/css">
	body{
		font-family: 'Noto Sans Thai', sans-serif;
	}
	#coures_header{
		background-size: cover;
		background-position: center;
		background-attachment: fixed;
	}
</style>
</head>
<body <?php body_class();?>>
	
	<div class="container mx-auto">
		
	</div>
	
</body>
</html>