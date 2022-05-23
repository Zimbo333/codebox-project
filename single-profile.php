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
</head>
<body <?php body_class(); ?>>
	<div class="flex justify-center mt-12">
		<div class="course_all">
			<div class="flex justify-between items-baseline">	
				<h1 class="font-bold text-3xl">Course</h1>
				<i class="fa-solid fa-circle-plus"></i>
				<p class="text-sm">ดูเพิ่มเติม</p>
			</div>

			<!-- COURSE -->
			<div class="my_course flex">
				<div class="detail mt-8">
					<img id="img_main_course" src="https://picsum.photos/id/936/200/280">
					<p class="text-xs pt-2 pb-1">ดร. สุภวรรณ ทัศนประเสริฐ</p>
					<h4 class="font-bold">Multimedia Programming</h4>
				</div>
				<div class="detail mt-8">
					<img id="img_main_course" src="https://picsum.photos/id/668/200/280">
					<p class="text-xs pt-2 pb-1">ดร. สุภวรรณ ทัศนประเสริฐ</p>
					<h4 class="font-bold">Web Design and Development</h4>
				</div>
				<div class="detail mt-8">
					<img id="img_main_course" src="https://picsum.photos/id/3/200/280">
					<p class="text-xs pt-2 pb-1">ดร. สุภวรรณ ทัศนประเสริฐ</p>
					<h4 class="font-bold">Mobile Development</h4>
				</div>
				<div class="detail mt-8">
					<img id="img_main_course" src="https://picsum.photos/id/119/200/280">
					<p class="text-xs pt-2 pb-1">ดร. สุภวรรณ ทัศนประเสริฐ</p>
					<h4 class="font-bold">Web Technology</h4>
				</div>
				<div class="detail mt-8">
					<img id="img_main_course" src="https://picsum.photos/id/1/200/280">
					<p class="text-xs pt-2 pb-1">ดร. สุภวรรณ ทัศนประเสริฐ</p>
					<h4 class="font-bold">Basic Website Development</h4>
				</div>
			</div>
		</div>
	</div>

	<!-- CODEBRANCH -->
	<section id="CodeBranch" class="mt-20 flex items-center flex-col">
		<nav class="ProfilePageNav text-3xl">
			<ul class="flex">
				<li class="pr-4">
					<button class="MenuCode font-bold">Code Branch</button>
				</li>
				<li class="px-4">
					<button class="MenuCode font-bold text-gray-400" onclick="return ShowContent('CodeBox');">CodeBox</button>
				</li>
			</ul>
		</nav>
		<div class="lineYellow mt-1"></div>

		<!-- SORT BY -->
		<div class="ProfilePageNav my-4 flex justify-end items-baseline">
			<label class="px-4 text-gray-400">Sort By</label>
			<select class="dropDown font-bold">
				<option>Date Update</option>
				<option>Course</option>
				<option>Professor</option>
			</select>
		</div>

		<!-- PREVIEW CODE -->
		<div class="ProfilePageNav flex justify-between flex-wrap">
			<div class="FrameCode flex flex-wrap mb-8 p-3">
				<box class="PreviewCode"></box>
				<div class="DropBtn flex items-center">
					<p class="text-lg font-bold py-1 pr-3">responsive-mobile-exercise</p>
					
					<ul class="dropbtn icons showLeft flex" onclick="showDropdown()">
						<li></li>
						<li></li>
						<li></li>
						<!-- menu -->
						<div id="myDropdown" class="dropdown-content">
							<div class="drop-hover flex items-center">
								<i class="fas fa-solid fa-trash ml-4"></i>
								<a href="#" class="py-3 pl-3">Delete</a>
							</div>
							<div class="drop-hover flex items-center">
								<i class="fas fa-solid fa-download ml-4"></i>
								<a href="#" class="py-3 pl-3">Download</a>
							</div>
						</div>
					</ul>
					
				</div>
				<p>Mobile Development</p>
			</div>

			<!-- 2 -->
			<div class="FrameCode flex flex-wrap mb-8 p-3">
				<box class="PreviewCode"></box>
				<div class="DropBtn flex items-center">
					<p class="text-lg font-bold py-1 pr-3">responsive-mobile-exercise</p>
					
					<ul class="dropbtn icons showLeft flex" onclick="showDropdown()">
						<li></li>
						<li></li>
						<li></li>
						<!-- menu -->
						<div id="myDropdown" class="dropdown-content">
							<div class="drop-hover flex items-center">
								<i class="fas fa-solid fa-trash ml-4"></i>
								<a href="#" class="py-3 pl-3">Delete</a>
							</div>
							<div class="drop-hover flex items-center">
								<i class="fas fa-solid fa-download ml-4"></i>
								<a href="#" class="py-3 pl-3">Download</a>
							</div>
						</div>
					</ul>
					
				</div>
				<p>Mobile Development</p>
			</div>
		</div>
		<button class="button_start flex items-center justify-center float-right my-6">
			<span class="font-bold">NEXT</span>
			<i class="fas fa-thin fa-angle-right fa-lg ml-3"></i>
		</button>
	</section>

	<!-- CODEBOX -->
	<section id="CodeBox" class="mt-20 flex justify-center items-center flex-col" style="display: none;">
		<nav class="ProfilePageNav text-3xl">
			<ul class="flex">
				<li class="pr-4">
					<button class="MenuCode font-bold text-gray-400" onclick="return ShowContent('CodeBranch');">Code Branch</button>
				</li>
				<li class="px-4">
					<button class="MenuCode font-bold">CodeBox</button>
				</li>
			</ul>
		</nav>
		<div class="linePink mt-1"></div>

		<!-- SORT BY -->
		<div class="ProfilePageNav my-4 flex justify-end items-baseline">
			<label class="px-4 text-gray-400">Sort By</label>
			<select class="dropDown font-bold">
				<option>Date Create</option>
				<option>Date Update</option>
			</select>
		</div>

		<!-- PREVIEW CODE -->
		<div class="ProfilePageNav flex justify-between flex-wrap">
			<div class="FrameCodeBox flex flex-wrap mb-8 p-3">
				<box class="PreviewCode"></box>
				<div class="DropBtn flex items-center">
					<p class="text-lg font-bold py-1 pr-3">responsive-mobile-exercise</p>
					
					<ul class="dropbtn icons showLeft flex" onclick="showDropdown()">
						<li></li>
						<li></li>
						<li></li>
						<!-- menu -->
						<div id="myDropdown" class="dropdown-content">
							<div class="drop-hover flex items-center">
								<i class="fas fa-solid fa-trash ml-4"></i>
								<a href="#" class="py-3 pl-3">Delete</a>
							</div>
							<div class="drop-hover flex items-center">
								<i class="fas fa-solid fa-download ml-4"></i>
								<a href="#" class="py-3 pl-3">Download</a>
							</div>
						</div>
					</ul>
				</div>
				<p>Mobile Development</p>
			</div>
		</div>
		<button class="button_start flex items-center justify-center float-right my-6">
			<p class="font-bold">NEXT</p>
			<i class="fas fa-thin fa-angle-right fa-lg ml-3"></i>
		</button>
	</section>

	<script type="text/javascript">
	// 3 Dot Menu
	function changeLanguage(language) {
		var element = document.getElementById("url");
		element.value = language;
		element.innerHTML = language;
	}

	function showDropdown() {
		document.getElementById("myDropdown").classList.toggle("show");
	}

		// Close the dropdown if the user clicks outside of it
		window.onclick = function(event) {
			if (!event.target.matches(".dropbtn")) {
				var dropdowns = document.getElementsByClassName("dropdown-content");
				var i;
				for (i = 0; i < dropdowns.length; i++) {
					var openDropdown = dropdowns[i];
					if (openDropdown.classList.contains("show")) {
						openDropdown.classList.remove("show");
					}
				}
			}
		};

	// Change Page
	function ShowContent(test1) {
		document.getElementById("CodeBranch").style.display = 'none';
		document.getElementById("CodeBox").style.display = 'none';
		document.getElementById(test1).style.display = 'flex';
	}


	
</script> 

<style>
	body{
		font-family: 'Anuphan', sans-serif; 
		color: var(--color1);
	}
	:root {
		--bg1: #EF95F9;
		--color1: #333333;
		--color2: #B2B2B2;
		--color3: #EEEEEE;
	}

	#img_main_course {
		border-radius: 6px;
	}
	.course_all {
		width: 65vw;
		height: auto;
	}
	hr.hr_unit {
		border: black 0.3px solid;
		width: 65vw;
		opacity: 0.3;
	}
	.detail {
		width: 13vw;
		margin-right: 1.5%;
	}
	.project_name {
		width: 25vw;
	}
	.owner_name,
	.course_name {
		width: 15vw;
	}
	.last_update {
		width: 10vw;
	}
	.ProfilePageNav {
		width: 65vw;
	}
	.MenuCode,
	.dropDown {
		border: 0;
	}
	.FrameCode {
		background-color: #FFF2C6;
		width: 20vw;
		height: auto;
		border-radius: 6px;
	}
	.PreviewCode {
		background-color: white;
		width: 20vw;
		height: 10vw;
		border-radius: 6px;
	}

	/*3 dot Menu*/
	.showLeft {
		color: black !important;
	}
	.icons li {
		background: none repeat scroll 0 0 #C4C4C4;
		height: 0.5rem;
		width: 0.5rem;
		line-height: 0;
		list-style: none outside none;
		margin-left: 0.3rem;
		vertical-align: top;
		border-radius: 50%;
		pointer-events: none;
	}
	.dropbtn {
		color: white;
		border: none;
		cursor: pointer;
	}
	.dropdown {
		position: absolute;
		display: inline-block;
		right: 0.4em;
	}
	.dropdown-content {
		display: none;
		position: absolute;
		z-index: 1;
		background-color: white;
		box-shadow: 0px 1px 10px 0px rgb(0 0 0 / 20%);
		margin-top: -7rem;
		margin-left: -7rem;
	}
	.dropdown-content a {
		color: black;
		text-decoration: none;
		display: block;
		width: 10vw;
	}
	.dropbtn:focus {
		background-color: #3e8e41;
	}
	.dropdown-content .drop-hover:hover {
		background-color: #f1f1f1;
	}
	.show {
		display: block;
	}
	.FrameCodeBox {
		background-color: #FCEBFF;
		width: 20vw;
		height: auto;
		border-radius: 6px;
	}
	/*3 dot Menu End*/

	.lineYellow {
		width: 65vw;
		height: 0.3vh;
		background-color: #FFF2C6;
	}
	.linePink {
		width: 65vw;
		height: 0.3vh;
		background-color: #FCEBFF;
	}
	.button_start {
		background-color: var(--bg1);
		width: 7vw;
		height: auto;
		border-radius: 6px;
		color: white;
		padding: 0.5rem 3rem 0.5rem 3rem;

	}
</style>
<?php wp_footer() ?>
</body>
</html>