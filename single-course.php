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
$f = get_fields();
$is_enrolled = 1;
$fi = get_the_post_thumbnail_url();
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
	}
	#coures_header_inner{
		/*backdrop-filter: blur(10px);*/
	}
</style>	
</head>
<body <?php body_class(); ?>>

	<div id="coures_header" class="bg-slate-500  text-white" style="background-image: url('<?=$fi?>');">
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
						<a href="/wp-admin/post.php?post=<?=get_the_ID()?>&action=edit" class="">Edit Course (Admin)</a>
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
		?>
		<div id="units" class="bg-slate-50 py-16">
			<div class="container mx-auto">
				<h2 class="text-3xl font-bold mb-8 text-slate-600">
					<i class="fas fa-bug mr-2"></i>
					Course Box Units
				</h2>
				<?php 
				foreach ($f['units'] as $ui => $u) {
					if ($u['status'] == 'show' OR $is_mod) {
						?>
						<div class="unit-status-<?=$u['status']?> bg-white p-6 rounded border-slate-200	border-2 mb-6" id="unit_<?=$ui?>">
							<?php 
							if ($is_mod) {
								if ($u['status'] == 'hidden') {
									$is_hide = 'selected';
								}
								?>
								<form method="post" action="#unit_<?=$ui?>">
									<input type="hidden" name="ui" value="<?=$ui?>">
									<h3 class="text-2xl text-slate-500 mb-2">
										<input type="text" name="title" value="<?=$u['title']?>" class="font-bold w-full">
									</h3>
									<select name="status">
										<option value="show">Show</option>
										<option value="hidden" <?=$is_hide?>>Hidden</option>
									</select>
									<button class="bg-slate-100 text-slate-500 px-2 py-1 text-sm rounded" name="form" value="edit_unit">Save</button>
								</form>
								<?php
							}else{
								?>
								<h3 class="text-2xl text-slate-500 font-bold"><?=$u['title']?></h3>
								<?php 
							}

							foreach ($u['box'] as $bi => $b) {
								$box_type = get_post_type($b->ID);
								$cl = 'blue';
								if ($box_type == 'exercise'){
									$cl = 'violet';
								}
								$cl_bdt = $cl;
								$branch = get_user_branch($b->ID,$uid);
								?>
								<div class="unit-box unit-box-<?=$box_type?>   mt-4 bg-slate-100 border-t-4 border-<?=$cl_bdt?>-300">
									<div class="unit-box-icon  p-4 border-r-2 border-slate-200 text-<?=$cl?>-600">
										<i class="fas fa-code <?=$box_type?>"></i>
									</div>
									<div class="unit-box-details  p-4">
										<h4 class="text-lg font-bold text-slate-700"><?=$b->post_title?></h4>
										<?php if ($box_type == 'exercise'): 
											$fb = get_fields($b->ID);
											?>
											<div class="text-slate-500">
												หมดเขตส่ง  <b class="text-slate-600"><?=$fb['due_date']?></b><br>
												คะแนนเต็ม <b class="text-slate-600"><?=$fb['score']?> คะแนน</b>
											</div>
										<?php endif ?>
										<div class="mt-4 mb-4 font-bold">
											<a href="<?=get_the_permalink($b->ID)?>" target="_blank">
												<span class="rounded-md border-slate-200 px-3 py-2 text-sm mr-2 bg-<?=$cl?>-600 hover:bg-<?=$cl?>-700 border-2 border-<?=$cl?>-600 hover:border-<?=$cl?>-700  text-white">View Code</span>
											</a>
											<?php if ($branch != null): ?>
												<a href="<?=get_the_permalink($branch->ID)?>" target="_blank">
												<span  class="rounded-md border-2 border-<?=$cl?>-400 px-3 py-2 text-sm mr-2 hover:border-<?=$cl?>-700 text-<?=$cl?>-400 hover:text-<?=$cl?>-700">View Your Branch</span>
											</a>
											<?php endif ?>
										</div>
									</div>
								</div>
								<?php
							}
							?>
							<?php if ($is_mod): ?>
								<div class="mt-6 ">
									<form method="post" action="#unit_<?=$ui?>">
										<input type="hidden" name="ui" value="<?=$ui?>">
										<button class="rounded-md border-2 border-blue-600 px-3 py-2 text-sm mr-2 hover:border-blue-700 text-blue-600 hover:text-blue-700 text-white font-bold" name="new_box" value="lesson">
											<i class="fas fa-code  mr-2"></i>
											Add New Lesson
										</button>
										<button class="rounded-md border-2 border-violet-600 px-3 py-2 text-sm mr-2 hover:border-violet-700 text-violet-600 hover:text-violet-700 text-white font-bold" name="new_box" value="exercise">
											<i class="fas fa-code exercise mr-2"></i>
											Add New Exercise
										</button>
									</form>
								</div>
							<?php endif ?>
						</div>
						<?php
					}
				}
				?>
			</div>

			<?php if ($is_mod): ?>
				<div class="mt-4">
					<div class="container mx-auto text-center">
						<form method="post" action="#unit_<?=$ui+1?>">
							<input type="text" name="title" placeholder="Unit Title" class="font-bold rounded-md px-3 py-2 text-sm mr-2  border-2 border-slate-200">
							<button class="rounded-md border-slate-200 px-3 py-2 text-sm mr-2 bg-slate-500 hover:bg-slate-600 border-2 border-slate-500 hover:border-slate-600 font-bold  text-white" name="form" value="new_unit">
								Add New Unit
							</button>
						</form>

					</div>
				</div>
			<?php endif ?>
		</div>
		<?php
	}
	// pre($f);
	?>
	
	
	<?php wp_footer() ?>
	<?php 

	
	?>
</body>
</html>