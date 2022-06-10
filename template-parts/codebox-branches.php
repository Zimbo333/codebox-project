<?php 
$f = get_fields();
// pre($f);
$is_login = is_user_logged_in();
$is_owner = null;
$uid = null;
$codeboxType = get_post_type();
$post_id = get_the_ID();
$owner_id = $post->post_author;
$owner_name = get_the_author_meta( 'display_name', $owner_id);
$is_admin = isAdmin();

if ($is_login) {
	$uid = get_current_user_id();
	$u = get_user_by( 'ID', $uid );
	$upic = get_avatar_url($uid, array("size"=>48));
	if ($uid == $owner_id) {
		$is_owner = true;
	}
}
if ($codeboxType == 'lesson' OR $codeboxType == 'exercise') {
	$is_mod = isMod($f['in_course']->ID);
}

if ($codeboxType == 'exercise') {
	$max_score = $f['score'];
}
$branches = get_all_branches(get_the_ID());
?>

<!DOCTYPE html>
<html>
<head>	
	<?php wp_head();?>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Mono:wght@400;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@200;400;600&display=swap" rel="stylesheet">
	<script src="https://cdn.tailwindcss.com"></script>

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.0/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<link rel="stylesheet" type="text/css" href="<?=get_theme_file_uri()?>/theme.css?v=<?=time()?>">
	<style type="text/css">
	.branches-header{
		/*background: #111;*/
	}
	.branches-header.-code {
		color: #ff508b;
	}
	.branches-header.-lesson {
		color: #22d3ee;
	}
	.branches-header.-exercise {
		color: #ac60ff;
	}
</style>
</head>
<body class="bg-slate-800 text-slate-100">
	<div class="branches-header py-4 -<?=$codeboxType?> bg-slate-900">
		<div class="container mx-auto noto">
			<a href="?" class=""> 
				<i class="fas fa-arrow-left"></i>
				<b>
					<span style="text-transform: capitalize;">[<?=$codeboxType?>]</span> <?=get_the_title()?>
				</b>
				- 
				<?=$owner_name?>
			</a>
		</div>
	</div>

	<!--=== The Section Boxes : all_branches ===-->
	<section id="all_branches" class="py-6">
		<div class="container mx-auto">
			<div class="box-wrap">
				<?php 
				if (sizeof($branches > 0)) {
					foreach ($branches as $key => $b) {
						$b_owner = get_the_author_meta( 'display_name', $b->post_author);
						$b_owner_pic = get_avatar_url($b->post_author, array("size"=>48));
						?>
						<div class="branches-item">
							<div class="box-item mb-2" id="box_<?=$b->ID?>">
								<div class="bg-white rounded border-yellow-400	border-2 mb-2">
									<div class="box-iframe-wrap">
										<iframe src="<?=get_permalink($b)?>/?preview" class="box-iframe" sandbox="allow-modals allow-pointer-lock allow-presentation allow-same-origin allow-scripts"></iframe>
									</div>
								</div>
								<h3>
									<a href="<?=get_permalink($b)?>" class="font-bold text-slate-200 hover:text-slate-300"><?=$b->post_title?></a>
								</h3>
								<div class="branches-owner mt-3">
									<div class="branches-owner-pic">
										<a href="<?=get_author_posts_url($b->post_author)?>" class="">
											<img src="<?=$b_owner_pic?>" class="rounded">
										</a>
									</div>
									<div class="branches-owner-bio text-sm text-slate-400">
										<h4 class="text-yellow-600"><?=$b_owner?></h4>
										<?=get_the_date( $d = 'j F Y - g:i A', $b )?>
										
									</div>
								</div>
								<?php if ($codeboxType == 'exercise' AND $is_mod): ?>
									<div class="exercise_scoring">
										<div>
											<input type="number" class="mono score_form" value="<?=get_field('score',$b->ID)?>" id="score_for_<?=$b->ID?>" onkeydown="if (event.key == 'Enter') {score_btn_<?=$b->ID?>.click()}">
										</div>
										<div class="mono exercise_scoring_max">
											/ <?=$max_score?>
										</div>
										<div class="exercise_scoring_btn noto" onclick="setScore(<?=$b->ID?>)" id="score_btn_<?=$b->ID?>">
											ให้คะแนน
										</div>
									</div>
								<?php endif ?>
							</div>
						</div>
						<?php
					}
				}else{
					echo 'ยังไม่มีการสร้าง Branch ใหม่';
				}
				?>
			</div>
		</div>
	</section>

	<?php 
	if ($is_mod) {
		?>
		<script type="text/javascript">
			const parent_id = <?=$post_id?>;
			const course_id = <?=$f['in_course']->ID?>;
			function setScore(branch_id){
				const score_el = document.querySelector('#score_for_'+branch_id);
				const score = parseInt(score_el.value);
				if (isNaN(score)) {
					alert('คุณระบุคะแนนไม่ถูกต้อง กรุณาใส่ตัวเลข')
				}else{
					let dataObject = {p_id:parent_id,c_id:course_id,b_id:branch_id,score:score}
					let formData = new FormData()

					for (let key in dataObject) {
						formData.append(key, dataObject[key])
					}
					axios.post('/add-score', formData)
					.then(data =>{console.log(data)}
						)
				}
			}
		</script>

		<?php
	}
	?>
	<?php wp_footer() ?>
</body>
</html>