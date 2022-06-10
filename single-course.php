<?php
$is_admin = isAdmin();
$is_mod = isMod(get_the_ID());
if (is_user_logged_in()) {
	$uid = get_current_user_id();
	if ($is_mod) {
		if ($_POST['form'] == 'new_unit') {
			$row = array(
				'title' => $_POST['title'],
				'status'   => 'hidden',
				'box' => array()
			);
			add_row('units', $row, get_the_ID());
		}
		if ($_POST['new_box'] == 'lesson' OR $_POST['new_box'] == 'exercise') {
			$i = $_POST['ui'];
			$new_post_arr = array(
				'post_title'    => $text,
				'post_status'   => 'publish',
				'post_type' 	=> $_POST['new_box'],
				'post_parent'	=> get_the_ID(),
			);	
			$new_post = wp_insert_post( $new_post_arr );
			wp_update_post(array(
				'ID'           => $new_post,
				'post_title'    => ucfirst($_POST['new_box']).': '.$new_post,
			));
			update_field('in_course',get_the_ID(),$new_post);
			if ($_POST['new_box'] == 'exercise') {
				update_field('score',10,$new_post);
			}
			$temp_u = get_field('units');
			$temp_b = $temp_u[$i]['box'];
			array_push($temp_b,$new_post);
			$row = array(
				'box'  => $temp_b
			);
			update_row('units', $i+1, $row);	
		}
		if ($_POST['form'] == 'edit_unit') {
			$i = $_POST['ui'];
			$row = array(
				'title'  => $_POST['title'],
				'status'   => $_POST['status']
			);
			update_row('units', $i+1, $row);	
		// die();
		}
	}
}
if ($_POST['form'] == 'enroll') {
	if ($_POST['course_password'] == get_field('course_password')) {
		$row = array(
			'student' => $uid
		);
		add_row('students', $row, get_the_ID());
	}else{
		?><script type="text/javascript">alert('รหัสผ่านไม่ถูกต้อง')</script><?php
	}
}
$f = get_fields();
$is_enrolled = 0;

$fi = get_the_post_thumbnail_url();
// pre($f['students']);
foreach ($f['students'] as $key => $value) {
	if ($uid == $value['student']['ID']) {
		$is_enrolled = 1;
	}
}
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
	.unit-box{
		display: grid;
		grid-template-columns: 96px auto;
		gap: 16px;
	}
	.unit-box-icon{
		display: flex;
		justify-content: center;
		align-items: center;
		font-size: 2rem;
	}
	.fa-code.exercise:before {
		content: "\f5fc";
	}
	a,a:visited{
		color: inherit;
	}
	.unit-status-hidden{
		opacity: .5;
	}
	.unit-status-hidden::before{
		/*content: "Hidden";
		display: inline-block;
		background: #ddd;
		padding: .2em 1em;
		margin-bottom: .5em;
		font-weight: 700;*/
	}
	.course_mod{
		background: #0005;
		padding: .1em .8em;
		/*border-radius: .2em;*/
		display: inline-block;
		margin-right: .25em;
		font-size: .9rem;
	}
	#coures_header{
		background-size: cover;
		background-position: center;
		background-attachment: fixed;
	}
	#coures_header_inner{
		/*backdrop-filter: blur(10px);*/
	}
</style>	
</head>
<body <?php body_class(); ?>>

	<div id="coures_header" class="bg-slate-500  text-white" style="background-image: url('<?=$fi?>');">
		<?php  masthead()?>
		<div id="coures_header_inner">
			<div class="image_subject">
				<div class="name_subject justify-center py-16">
					<div class="container mx-auto">
						<h2 class="mb-4 opacity-70"><?=$f['term']?></h2>
						<h1 class="font-bold text-6xl mb-8"><?=get_the_title()?></h1>
						<div class="font-regular text-xl pt-4">
							<?php 
							$course_instructor = $f['course_instructor'];
							if(!empty($course_instructor)){
								echo '<h2 class="font-bold mb-2">ผู้สอน</h2>';
								$arr = [];
								foreach ($course_instructor as $key => $value) {
									$n = $value->data->display_name;
									array_push($arr,$n);
								}
								echo '<span class="course_mod">'.join($arr,'</span><span class="course_mod">').'</span>';
							}
							?>
							<br><br>
							<?php 
							$course_mod = $f['course_mod'];
							if(!empty($course_mod)){
								echo '<h2 class="font-bold mb-2">ผู้ดูแล</h2>';
								$arr = [];
								foreach ($course_mod as $key => $value) {
									$n = $value->data->display_name;
									array_push($arr,$n);
								}
								echo '<span class="course_mod">'.join($arr,'</span><span class="course_mod">').'</span>';
							}
							?>
						</div>
					</div>
				</div>
			</div>
			<?php if ($is_admin): ?>
				<div id="course_mod" class=" py-4" style="background: #0004;">
					<div class="container mx-auto">
						<a href="?" class="">&nbsp;&nbsp;
							Course
						</a>
						&nbsp;
						<a href="?view=dashboard" class="">&nbsp;&nbsp;
							Dashboard
						</a>
						&nbsp;
						<a href="/wp-admin/post.php?post=<?=get_the_ID()?>&action=edit" class="">Edit Course (Admin only)</a>
						
					</div>

				</div>
			<?php endif ?>
		</div>
	</div>

	<?php 
	if ($is_enrolled == 0) {
		?>
		<div id="enroll" class="bg-slate-50 py-16">
			<div class="container mx-auto text-center" style="max-width: 400px;">
				<div class="unit-status-<?=$u['status']?> bg-white p-6 rounded border-slate-200	border-2 mb-6">
					<h2 class="text-3xl font-bold mb-4 text-slate-600">Enrollment</h2>
					<form method="post" class="">
						<?php if ($f['course_password'] != ''): ?>
							<input type="text" name="course_password" placeholder="Enroll Password" class="font-bold rounded-md px-3 py-2 text-sm mr-2  border-2 border-slate-200">
						<?php endif ?>
						<button class="font-bold rounded-md px-3 py-2 text-sm mr-2 bg-lime-600 hover:bg-lime-700 border-2 border-lime-600 hover:border-lime-700  text-white" value="enroll" name="form">Enroll Now</button>
					</form>
				</div>

			</div>
		</div>
		<?php
	}else{
		if ($_GET['view'] == 'dashboard' ) {
			get_template_part('template-parts/course','dashboard');
		}else{
			get_template_part('template-parts/course','unit',array('is_mod'=>$is_mod,'f'=>$f));
		}
	}
	// pre($f);
	?>
	
	
	<?php wp_footer() ?>
	<?php 

	
	?>
</body>
</html>