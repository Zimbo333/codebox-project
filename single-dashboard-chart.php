<!DOCTYPE html>
<html>
<head>	
	<?php wp_head();?>
	
	<script src="https://cdn.tailwindcss.com"></script>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Bai+Jamjuree:wght@400;500;700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

	<link href="https://cdn.jsdelivr.net/gh/lazywasabi/thai-web-fonts@6/fonts/Anuphan/Anuphan.css" rel="stylesheet" />

	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	
</head>
<body <?php body_class(); ?>>
	<?php 
	$f = get_fields();
	$parent_course_id = $f['parent_course'][0]->ID;
	$parent_students = get_field('students',$parent_course_id);
	$parent_units = get_field('units',$parent_course_id);
	$act_num = 0;
	$les_num = 0;
	$exer_num = 0;
	// pre($parent_units);
	foreach ($parent_units as $key => $value) {
		foreach ($value['box'] as $k => $v) {
			$act_num++;	
			if($v->post_type == 'lesson'){
				$les_num++;
			}else{
				$exer_num++;
			}
		}
	}
	?>
	<div class="mt-12 mx-auto flex justify-center">
		<div class="dashboard">
			<div class="flex justify-between items-center">
				<p class="text-2xl font-bold"><?=get_the_title()?></p>
				<button class="download-csv p-2 text-white text-xs">Download CSV</button>
			</div>
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
					<p class="w-16 text-center">ไม่ส่งงาน</p>
					<p class="w-20">เปอร์เซนต์คนส่งงาน</p>
					<p class="w-14">ตรงเวลา</p>
					<p class="w-20">ไม่ตรงเวลา</p>
					<p class="w-12">คะแนนสูงสุด</p>
					<p class="w-12">คะแนนต่ำสุด</p>
				</div>
				<?php 
				foreach ($parent_units as $key => $value) {
					foreach ($value['box'] as $k => $v) {
						if($v->post_type == 'exercise'){
							?>
							<div class="flex justify-between mt-4 p-2">
								<p class="w-20"><?=$v->post_title?></p>
								<p class="w-10 text-center"><?=$key+1?></p>
								<p class="w-12 text-center">200</p>
								<p class="w-16 text-center">0</p>
								<p class="w-20 text-center">100%</p>
								<p class="w-14">195</p>
								<p class="w-20">5</p>
								<p class="w-12">10</p>
								<p class="w-12">3</p>
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
					<p class="w-12 text-center">ส่งงาน</p>
					<p class="w-16 text-center">ไม่ส่งงาน</p>
					<p class="w-20">เปอร์เซนต์คนส่งงาน</p>
					<p class="w-14">ตรงเวลา</p>
					<p class="w-20">ไม่ตรงเวลา</p>
					<p class="w-12">คะแนนสูงสุด</p>
					<p class="w-12">คะแนนต่ำสุด</p>
				</div>
				<?php 
				foreach ($parent_units as $key => $value) {
					foreach ($value['box'] as $k => $v) {
						if($v->post_type == 'lesson'){
							?>
							<div class="flex justify-between mt-4 p-2">
								<p class="w-20"><?=$v->post_title?></p>
								<p class="w-10 text-center"><?=$key+1?></p>
								<p class="w-12 text-center">200</p>
								<p class="w-16 text-center">0</p>
								<p class="w-20 text-center">100%</p>
								<p class="w-14">195</p>
								<p class="w-20">5</p>
								<p class="w-12">10</p>
								<p class="w-12">3</p>
							</div>
							<?php
						}
					}
				}
				?>
			</div>
		</div>
	</div>
	...

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
			labels:['Participants', 'Units', 'Activities', 'Lessons', 'Exercises'],
			datasets:[{
				label: 'Population',
				data:[
				parti_size,
				unit_size,
				act_size,
				les_size,
				exer_size
				],
				backgroundColor:[
				'#28C7AA',
				'#A458F9',
				'#6B8AF9',
				'#FDAC30',
				'#FA8496'
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
	.units {
		width: 12vw;
		padding: 0.5rem;
		border-radius: 6px;
		background-image: linear-gradient(to right, #A458F9, #D767DE);
	}
	.activities {
		width: 12vw;
		padding: 0.5rem;
		border-radius: 6px;
		background-image: linear-gradient(to right, #6B8AF9, #5AC4F3);
	}
	.lessons {
		width: 12vw;
		padding: 0.5rem;
		border-radius: 6px;
		background-image: linear-gradient(to right, #FDAC30, #F4D482);
	}
	.exercises {
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
<?php wp_footer() ?>
</body>
</html>