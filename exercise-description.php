<!DOCTYPE html>
<html>
<head>	
	<?php wp_head();?>
	
	<script src="https://cdn.tailwindcss.com"></script>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Bai+Jamjuree:wght@400;500;700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	
</head>
<body <?php body_class(); ?>>
	<div class="head_topic">
		<div class="image_subject">
			<div class="name_subject flex flex-col content-center justify-center">
				<h1 class="font-bold text-7xl text-center">Multimedia Programing</h1>
				<div class="font-regular text-xl flex justify-between content-center pt-4">
					<h2>1/2564</h2>
					<h2>ดร.สุภวรรณ ทัศนประเสริฐ</h2>
				</div>
			</div>
		</div>
	</div>

	<section id="ExerciseAll">
		<div class="mt-12 mx-auto">
			<div class="flex content-center justify-center">
				<div class="all_unit py-1">
					<h1 class="text-xl font-bold">Exercise</h1>
					<!-- ///////////////////////////// -->
					<div class="mt-2 cursor-pointer" onclick="return ShowContent('ExerciseDetail');">
						<hr class="hr_unit mb-4 mx-auto">
						<div class="flex justify-between items-center mb-4">
							<div class="flex items-center">
								<i class="clipboard_icon fas fa-solid fa-clipboard-check fa-lg"></i>
								<h1 class="font-bold pl-4">Introduce yourself</h1>
							</div>
							<p class="py-2 text-sm">ครบกำหนด 30 พฤศจิกายน 2564</p>
						</div>
					</div>
					<!-- /////////////////// -->
					<div class="mt-2">
						<hr class="hr_unit mb-4 mx-auto">

						<div class="flex justify-between items-center mb-4">
							<div class="flex items-center">
								<i class="clipboard_icon fas fa-solid fa-clipboard-check fa-lg"></i>
								<h1 class="font-bold pl-4">Magic Card</h1>
							</div>
							<p class="py-2 text-sm text-green-600 font-bold">ส่งแล้ว</p>						
						</div>
					</div>
					<!-- /////////////////// -->
					<div class="mt-2">
						<hr class="hr_unit mb-4 mx-auto">

						<div class="flex justify-between items-center mb-4">
							<div class="flex items-center">
								<i class="clipboard_icon fas fa-solid fa-clipboard-check fa-lg"></i>
								<h1 class="font-bold pl-4">Isometric</h1>
							</div>
							<p class="py-2 text-sm text-red-600 font-bold">ยังไม่ส่งงาน</p>				
						</div>
					</div>
					<!-- ///////////////////////////// -->
					<div class="mt-2">
						<hr class="hr_unit mb-4 mx-auto">

						<div class="flex justify-between items-center mb-4">
							<div class="flex items-center">
								<i class="clipboard_icon fas fa-solid fa-clipboard-check fa-lg"></i>
								<h1 class="font-bold pl-4">Website Portfolio</h1>
							</div>
							<p class="py-2 text-sm text-gray-400">ครบกำหนดแล้ว</p>						
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="ExerciseDetail" style="display: none;">
		<div class="mt-12 mx-auto">
			<div class="flex content-center justify-center flex-row-reverse">
				<div class="exercise_all">
					<h1 class="text-xl font-bold py-1 px-5">งานของคุณ</h1>
					<!-- //////////////// -->
					<div class="exercise_name pt-3">
						<p class="px-5">Introduce Yourself</p>
						<span class="color2 text-xs px-5">Due 30 Nov, 21</span>
						<hr class="hr_exercise mt-3 mx-auto">
					</div>
					<button></button>
				</div>

				<div class="all_unit py-1">
					<div class="flex items-center">
						<i class="exercise_icon fas fa-solid fa-clipboard-check fa-lg"></i>
						<div>
							<p class="text-xl font-bold px-5">Introduce Yourself</p>
							<span class="color2 text-xs px-5">โพสต์เมื่อ 20 พฤศจิกายน 2564</span>
						</div>
					</div>
					<p class="color2 text-xs mt-2 flex justify-end">ครบกำหนด 30 พฤศจิกายน 2564, 23.59 น.</p>
					<!-- ///////////////////////////// -->
					<div class="mt-2">
						<hr class="hr_unit mb-4 mx-auto">

						<p class="text-sm">ทัวร์นาเมนท์ดีไซน์อุด้ง ชัวร์คอนโทรลอยุติธรรมเกรดซากุระ อาร์พีจีแพนงเชิญ ซาดิสม์ไฮแจ็คพุทธภูมิมะกันเฟอร์รี่ แพทเทิร์น บ๊อกซ์วาทกรรมลีก เอสเพรสโซเทเลกราฟบาร์บีคิวอิออนเรต ยะเยือกวิลล์แฟล็ตสะกอม อาร์พีจีตรวจทานมอคค่าเฟอร์รี่โลโก้ ลิมูซีนเฟรมงี้ลิมิต สไตล์เพนตากอนแซวแม็กกาซีนฮันนีมูน ซีเรียสไฮแจ็ค รีสอร์ตพะเรออุปนายก ความหมายดราม่าโปรดิวเซอร์ทับซ้อนซิ่ง นอมินีภควัมบดีกับดักสปาย ยิวดิกชันนารีตะหงิดพ่อค้า</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script type="text/javascript">
		// Change Page
		function ShowContent(detailExercise) {
			document.getElementById("ExerciseAll").style.display = 'none';
			document.getElementById("ExerciseDetail").style.display = 'none';
			document.getElementById(detailExercise).style.display = 'flex';
		}
	</script>

	<style>
		body{
			font-family: 'Bai Jamjuree', sans-serif; 
			color: var(--color1);
		}
		hr.hr_exercise {
			border: black 0.5px solid;
			opacity: 0.3;
			width: 12.5vw;

		}
		hr.hr_unit {
			border: black 0.5px solid;
			opacity: 0.3;
			width: 45vw;
		}
		:root {
			--bg1: #EF95F9;
			--color1: #333333;
			--color2: #B2B2B2;
		}
		.color2 {
			color: var(--color2);
		}
		.image_subject {
			width: 100vw;
			height: 30vh;
			background-color: lightblue;
		}
		.name_subject {
			width: 53vw;
			height: 30vh;
			margin: auto;
		}
		.exercise_all {
			height: auto;
			width: 15.1vw;
			border: var(--color1) 2px solid;
			border-radius: 10px; 
		}
		.exercise_work {
			background-color: var(--bg1);
			height: 5vh;
			width: 15vw;
			border-radius: 10px 10px 0px 0px;
		}
		.all_unit {
			height: 5vh;
			width: 45vw;
			margin-right: 1.5%;
		}
		.chapter_unit {
			width: 1.5vw;
			height: 3vh;
			background-color: var(--bg1);
			border-radius: 6px;
		}
		.content_unit {
			width: 8vw;
			height: 5vh;
			background-color: var(--bg1);
			border-radius: 6px;
		}
		.clipboard_icon {
			font-size: 2rem;
		}
		.exercise_icon {
			font-size: 4rem;
		}
	</style>
	<?php wp_footer() ?>
</body>
</html>