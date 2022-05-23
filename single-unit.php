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
	<div>
		<div class="menubar_unit flex justify-between items-center px-32 py-3">
			<div class="flex items-center">
				<i class="fas fa-thin fa-angle-left fa-2x codebox_arrow_back"></i>
				<p class="subject_unit">Basic Website</p>
			</div>
			<div>
				<p class="subject_name">Multimedia Programing</p>
			</div>
		</div>

		<div class="mx-32 mt-12 flex justify-between">
			<div class="topic_unit">
				<button id="introduce_button" class="topic introduce" href="#" onclick="return ShowContent('introBtn');">
					<i class="fas fa-solid fa-info mr-5 ml-1"></i>
					<p>Introduce</p>
				</button>

				<div class="topic_number">
					<button id="topic_button" class="topic" href="#" onclick="return ShowContent('topicBtn');">
						<i class="fas fa-solid fa-play mr-4"></i>
						<p>1. ความรู้เบื้องต้นของการเขียนเว็บไซต์</p>
					</button>
					<button class="topic" href="#" onclick="return ShowContent('topicBtn');">
						<i class="fas fa-solid fa-play mr-4"></i>
						<p>2. เริ่มต้นเขียนเว็บไซต์</p>
					</button>
				</div>

				<button id="document_button" class="topic document_unit" href="#" onclick="return ShowContent('docBtn');">
					<i class="fas fa-solid fa-folder mr-4"></i>
					<p>เอกสารประกอบการเรียน</p>
				</button>

				<button id="form_button" class="topic question_unit" href="#" onclick="return ShowContent('formBtn');">
					<i class="fas fa-solid fa-question mr-4"></i>
					<p>คำถามเพิ่มเติม</p>
				</button>

				<button class="exercise_unit button_exercise">
					<i class="fas fa-solid fa-clipboard-check mr-4"></i>
					<p>Exercise</p>
				</button>
			</div>

			<div class="ml-4" style="display:block">
				<div id="introBtn">
					<div class="content px-16 py-8">
						<h1 class="text-xl font-bold">Introduction</h1>
						<hr class="hr_unit"></hr>
						<h1 class="text-xl font-bold mt-4">Basic Website</h1>
						<p class="mt-4 text-sm">ลิมิต แผดเผาแหวว นินจา พาร์ตเนอร์อพาร์ทเมนต์ฮาร์ดม้านั่งเมคอัพ คอรัปชั่นเฟรมโก๊ะอินดอร์ ซิมโฟนี่พริตตี้ ริกเตอร์สเต็ป อุเทนเทควันโด เอ็นทรานซ์พุทธศตวรรษตี๋ปาสกาลคอร์รัปชัน สเปก แฟล็ตเฟรชบ๊อบตุ๋ยออโต้ จิ๊กซอว์โบกี้ เวิลด์ ไฮไลท์</p>
						<div class="teacher_course flex items-center mt-8">
							<div class="image_teacher h-11 w-11"></div>
							<!-- <img class="h-11 w-11 object-cover rounded-full" src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1361&q=80" alt="Current profile photo" /> -->
							<p class="ml-4">ดร. สุภวรรณ ทัศนประเสริฐ</p>
						</div>
					</div>
					<button class="button_start flex items-center justify-center float-right mt-6">
						<span class="font-bold">START</span>
					</button>
				</div>

				<div id="topicBtn" style="display:none">
					<div class="chapter px-16 py-8">
						<iframe class="mx-auto" width="560" height="315" src="https://www.youtube.com/embed/JQ-2sk2ELJI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>
					<button class="button_start flex items-center justify-center float-right mt-6">
						<span class="font-bold">NEXT</span>
					</button>
				</div>

				<div id="docBtn" class="chapter px-16 py-8 flex" style="display:none">
					<div class="bg-red-100 w-40 h-58">
						<p>hey</p>
					</div>
				</div>

				<div id="formBtn" style="display:none">
					<div class="chapter px-16 py-8">
						<input type="text" name="comment" class="placeholder:italic placeholder:text-slate-400 w-full h-6/12 border border-fuchsia-400 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-fuchsia-400 focus:ring-fuchsia-400 focus:ring-1 sm:text-sm" placeholder="ถามคำถามของคุณที่นี่หรือบอกข้อเสนอแนะเพิ่มเติม">
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		function ShowContent(test1) {
			document.getElementById("introBtn").style.display = 'none';
			document.getElementById("topicBtn").style.display = 'none';
			document.getElementById("docBtn").style.display = 'none';
			document.getElementById("formBtn").style.display = 'none';
			document.getElementById(test1).style.display = 'block';
		}
	</script>


	<style>
		body {
			font-family: 'Bai Jamjuree', sans-serif;
			background-color: var(--bg2);
			color: var(--color3);
		}
		:root {
			--bg1: #EF95F9;
			--bg2: #474747;
			--bg3: #7D7D7D;
			--color1: #333333;
			--color2: #B2B2B2;
			--color3: #EEEEEE;
		}
		.menubar_unit {
			background-color: var(--color1);
			width: 100vw;
			height: auto;
			cursor: pointer;
		}
		.codebox_arrow_back {
			color: var(--color3);
		}
		.subject_unit {
			color: var(--color3);
			font-size: 1.3em;
			padding-left: 15px;
		}
		.subject_name {
			color: var(--color3);
		}
		.topic {
			font-size: 1em;
			width: 25vw;
			height: auto;
			background-color: var(--bg3);
			margin-bottom: 10px;
			border-radius: 6px;
			padding: 0.5rem 2rem;
			display: flex;
			align-items: center;
		}
		.exercise_unit {
			font-size: 1em;
			width: 25vw;
			height: auto;
			background-color: var(--bg1);
			margin: 10px 0px;
			border-radius: 6px;
			padding: 0.5rem 2rem;
			display: flex;
			align-items: center;
			margin-top: 1.75em;
		}
		.content,
		.chapter {
			width: 57vw;
			height: auto;
			background-color: var(--bg3);
			border-radius: 6px;
		}
		hr.hr_unit {
			border: var(--color3) 0.5px solid;
			opacity: 0.3;
			width: 48vw;
		}
		.image_teacher {
			display: block;
			background-size: cover;
			border-radius: 50%;
			background-image: url("https://images.unsplash.com/photo-1544717305-2782549b5136?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80");
		}
		.button_start {
			background-color: var(--bg1);
			width: 10vw;
			height: auto;
			border-radius: 6px;
			padding: 0.5rem 0rem;
		}
		button {
			border: none;
		}
		button:hover,
		button:focus {
			background-color: var(--color1);
		}
		.button_exercise:hover,
		.button_start:hover,
		.button_exercise:focus,
		.button_start:focus {
			background-color: var(--bg1);
			border: white 3px solid;
		}
	</style>
	<?php wp_footer() ?>
</body>
</html>