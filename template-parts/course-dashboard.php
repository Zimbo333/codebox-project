<?php 
$parent_course_id = get_the_ID();
$parent_students = get_field('students',$parent_course_id);
$parent_units = get_field('units',$parent_course_id);
$act_num = 0;
$les_num = 0;
$exer_num = 0;
$exer = [];
	// pre($parent_units);
foreach ($parent_units as $key => $value) {
	foreach ($value['box'] as $k => $v) {
		$act_num++;	
		if($v->post_type == 'lesson'){
			$les_num++;
		}else{
			$arr = [];
			$arr['id'] = $v->ID;
			$arr['url'] = get_permalink($v->ID);
			$arr['title'] = $v->post_title;
			$arr['score'] = get_field('score',$v->ID);
			array_push($exer,$arr);
			$exer_num++;
		}
	}
}

$args = array(
	'meta_key'		=> 'in_course',
	'meta_value'	=> get_the_ID(),
	'post_type' => 'exercise-branch',
	'posts_per_page' => -1

);
$p = new WP_Query($args);
$ex_branch = $p->posts;
// pre($ex_branch);
$assignment = [];
foreach ($ex_branch as $exbi => $exbv) {
	if (empty($assignment[$exbv->post_author])) {
		$assignment[$exbv->post_author] = [];
	}
	$assignment[$exbv->post_author][$exbv->post_parent] = [];
	$assignment[$exbv->post_author][$exbv->post_parent]['ID'] = $exbv->ID;
	$assignment[$exbv->post_author][$exbv->post_parent]['score'] = get_field('score',$exbv->ID);
	$assignment[$exbv->post_author][$exbv->post_parent]['url'] = get_permalink($exbv->ID);
	// array_push($assignment[$exbv->post_author],$exbv->ID);
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<div class="mt-12 mx-auto flex justify-center">
	<div class="dashboard">
		<!-- <div class="text-right">
			<button class="download-csv  font-bold p-2 text-white text-xs">Download CSV</button>
		</div> -->
<!-- 			<div class="img_dashboard mt-4 flex justify-center items-center">
				<h1 class="text-5xl font-bold text-white">Dashboard</h1>
			</div> -->
			<div class="course_board mt-12 flex justify-between">
				<div class="board_num flex flex-wrap justify-center py-16">
					<div class="participants text-center text-white mr-4">
						<p id="parti_size" class="text-5xl pb-1 font-bold"><?=sizeof($parent_students)?></p>
						<p class="text-lg">Participants</p>
					</div>
					<div class="units text-center text-white mr-4">
						<p id="unit_size" class="text-5xl pb-1 font-bold"><?=sizeof($parent_units)?></p>
						<p class="text-lg">Units</p>
					</div>
					<div class="activities text-center text-white">
						<p id="act_size" class="text-5xl pb-1 font-bold"><?=$act_num?></p>
						<p class="text-lg">Activities</p>
					</div>
					<div class="lessons text-center text-white mr-4 mt-4">
						<p id="les_size" class="text-5xl pb-1 font-bold"><?=$les_num?></p>
						<p class="text-lg">Lessons</p>
					</div>
					<div class="exercises text-center text-white mt-4">
						<p id="exer_size" class="text-5xl pb-1 font-bold"><?=$exer_num?></p>
						<p class="text-lg">Exercises</p>
					</div>
				</div>

				<div class="chart_container pt-2" style="height:10vh; width:20vw">
					<canvas id="myChart"></canvas>
				</div>
			</div>

			<div class="exercise_board mt-4 p-4">
				<p class="text-lg font-bold">Exercise</p>
				<div class="head_exercise_board flex justify-between items-center mt-4">
					<p class="w-30">Name</p>
					<p class="w-10 text-center">Units</p>
					<p class="w-12 text-center">ส่งงาน</p>
					<p class="w-20">ตรวจแล้ว</p>
					<p class="w-20">ยังไม่ตรวจ</p>
					<p class="w-12">คะแนนสูงสุด</p>
					<p class="w-12">คะแนนต่ำสุด</p>
				</div>
				<?php 
				foreach ($parent_units as $key => $value) {
					foreach ($value['box'] as $k => $v) {
						if($v->post_type == 'exercise'){
							$branches = get_all_branches($v->ID);
							$allScore = [];
							$is_send = 0;
							$max = null;
							$min = null;
							foreach ($branches as $k => $b) {
								$s = get_field('score',$b->ID);
								$allScore[$k] = $s;
								if ($min == null AND $s != null) {
									$min = $s;
								}
								if ($max == null AND $s != null) {
									$max = $s;
								}
								if ($s != '') {
									$is_send++;
									if ($s>$max) {
										$max = $s;
									}else{
										$min = $s;
									}
								}
							}
							?>
							<div class="flex justify-between mt-4 p-2">
								<p class="w-20">
									<a href="<?=get_permalink($v->ID)?>" class="">
										<?=$v->post_title?>
									</a>
								</p>
								<p class="w-10 text-center"><?=$key+1?></p>
								<p class="w-12 text-center"><?=sizeof($branches)?></p>
								<p class="w-20 text-center">
									<?=$is_send?>
								</p>
								<p class="w-20 text-center">
									<?=sizeof($branches)-$is_send?>
								</p>
								<p class="w-12"><?=$max?></p>
								<p class="w-12"><?=$min?></p>
							</div>
							<?php
						}
					}
				}
				?>
			</div>

			
			<div class="exercise_board mt-4 p-4">
				<p class="text-lg font-bold">Lesson</p>
				<div class="head_exercise_board flex justify-between items-center mt-4">
					<p class="w-30">Name</p>
					<p class="w-10 text-center">Units</p>
					<p class="w-12 text-center">Branches</p>
				</div>
				<?php 
				foreach ($parent_units as $key => $value) {
					foreach ($value['box'] as $k => $v) {
						if($v->post_type == 'lesson'){
							$branches = get_all_branches($v->ID);
							?>
							<div class="flex justify-between mt-4 p-2">
								<p class="w-20"><?=$v->post_title?></p>
								<p class="w-10 text-center"><?=$key+1?></p>
								<p class="w-12 text-center"><?=sizeof($branches)?></p>
							</div>
							<?php
						}
					}
				}
				?>
			</div>
			<div class="mt-4 bg-white rounded">
				<p class="p-4 text-xl font-bold mb-4">Participants</p>
				<div class="overflow-x-scroll studen-table">
					<div class="studen-table-row" style="--c:<?=$exer_num?>">
						<div class="student-pic font-bold">
							Name
						</div>
						<div class="student-name font-bold">
							
						</div>
						<?php 
						foreach ($exer as $ei => $ev) {
							?>
							<div class="student-score text-center">
								<a href="<?=$ev['url']?>" title="<?=$ev['title']?>">
									<b>Ex. <?=$ei+1?></b> <br><span class="text-sm">(<?=$ev['score']?>)</span>
								</a>
							</div>
							<?php
						}
						?>
					</div>

					<?php 
					foreach ($parent_students as $key => $value) {
						?>
						<div class="studen-table-row" style="--c:<?=$exer_num?>">
							<div class="student-pic">
								<a href="<?=get_author_posts_url($value['student']['ID'])?>" class="">
									<?=$value['student']['user_avatar']?>
								</a>
							</div>
							<div class="student-name">
								<?=$value['student']['display_name']?>
							</div>
							<?php 
							foreach ($exer as $ei => $ev) {
								
								if ($assignment[$value['student']['ID']][$ev['id']]['ID'] == '') {
									$thisScore = '<i class="fas fa-times text-slate-300"></i>';
								}else{
									if ($assignment[$value['student']['ID']][$ev['id']]['score'] == '') {
										$thisScore = '<i class="fas fa-edit text-lime-500"></i>';
									}else{
										$thisScore = $assignment[$value['student']['ID']][$ev['id']]['score'];	
									}
									
								}
								
								?>
								<div class="student-score  text-center ">
									<a href="<?=$assignment[$value['student']['ID']][$ev['id']]['url']?>" class="">
										<?=$thisScore?>
									</a>
								</div>
								<?php
							}
							?>
						</div>
						<?php
					}
					?>
				</div>
			</div>
			
		</div>
	</div>
</div>

<script type="text/javascript">
	let myChart = document.getElementById('myChart').getContext('2d');

	// Chart.defaults.global.defaultFontFamily = 'Anuphan';
	// Chart.defaults.global.defaultFontSize = 18;
	// Chart.defaults.global.defaultFontColor = '#333';
	let parti_size = parseInt(document.getElementById('parti_size').innerHTML)
	let unit_size = parseInt(document.getElementById('unit_size').innerHTML)
	let act_size = parseInt(document.getElementById('act_size').innerHTML)
	let les_size = parseInt(document.getElementById('les_size').innerHTML)
	let exer_size = parseInt(document.getElementById('exer_size').innerHTML)

	let massPopChart = new Chart(myChart, {
		type:'doughnut',
		data:{
			labels:['Lessons', 'Exercises'],
			datasets:[{
				label: 'Population',
				data:[
				les_size,
				exer_size
				],
				backgroundColor:[
				'#6B8AF9',
				'#A458F9'
				],
				borderWidth:1,
				borderColor:'#fff',
				hoverBorderWidth:2,
				hoverBorderColor:'#333'
			}]
		},
		options:{}
	});
</script>


<style>
body{
	/*font-family: 'Anuphan', sans-serif; */
	color: var(--color1);
	background-color: #F6F4F9;
}
:root {
	--bg1: #EF95F9;
	--color1: #333333;
	--color2: #B2B2B2;
}
.avatar{
	display: block;
	margin-left: auto;
	margin-right: auto;
	border-radius: 999px;
}
.color2 {
	color: var(--color2);
}
.dashboard {
	width: 65vw;
}
.download-csv {
	background-color: #9A5BED;
	border-radius: 6px;
}
.img_dashboard {
	border-radius: 6px;
	width: 65vw;
	height: 20vh;
	background-image: linear-gradient(to right, #FDAC30, #FA8398);
}
.participants {
	width: 12vw;
	padding: 0.5rem;
	border-radius: 6px; 
	background-image: linear-gradient(to right, #28C7AA, #82F4C7);
}
.exercises {
	width: 12vw;
	padding: 0.5rem;
	border-radius: 6px;
	background-image: linear-gradient(to right, #A458F9, #D767DE);
}
.lessons {
	width: 12vw;
	padding: 0.5rem;
	border-radius: 6px;
	background-image: linear-gradient(to right, #6B8AF9, #5AC4F3);
}
.activities {
	width: 12vw;
	padding: 0.5rem;
	border-radius: 6px;
	background-image: linear-gradient(to right, #FDAC30, #F4D482);
}
.units {
	width: 12vw;
	padding: 0.5rem;
	border-radius: 6px;
	background-image: linear-gradient(to right, #FA8496, #FFAAB8);
}
.board_num {
	width: 45vw;
}
.course_board {
	background-color: white;
	border-radius: 6px;
	box-shadow: 2px 2px 10px #DCDAE3;
	width: 65vw;
	height: auto;
}
.exercise_board {
	background-color: white;
	border-radius: 6px;
	box-shadow: 2px 2px 10px #DCDAE3;
	width: 65vw;
	height: auto;
}
.head_exercise_board {
	background-color: #F4F5F6;
	padding: 0.5rem; 
}
</style>

<div class="pt-8"></div>