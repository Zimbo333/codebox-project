<?php 
global $post_id;
global $owner_id;
global $owner_name;
global $is_login;
global $is_owner;
global $uid;

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
?>
<!DOCTYPE html>
<html>
<?php 
$f = get_fields();
if ($codeboxType == 'code-branch' OR $codeboxType == 'lesson-branch' OR $codeboxType == 'exercise-branch') {
	$origin = $f['parent'];
	$origin_url = get_permalink($origin->ID);
}else{
	$my_branch = get_user_branch(get_the_ID(),$uid);
}
if ($codeboxType == 'lesson' OR $codeboxType == 'exercise' OR $codeboxType == 'lesson-branch' OR $codeboxType == 'exercise-branch') {
	$is_mod = isMod($f['in_course']->ID);

}
if ($codeboxType == 'exercise' OR $codeboxType == 'exercise-branch') {
	if ($codeboxType == 'exercise') {
		$duedate = get_field('due_date',get_the_ID());
	}else{
		$duedate = get_field('due_date',$origin->ID);
	}
}
// pre($is_owner,'$is_owner');
// pre($is_login,'$is_login');
?>
<head>	
	<?php wp_head();?>
	<!-- codemirror css -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.0/codemirror.min.css" integrity="sha512-CCnciBUnVXwa6IQT9q8EmGcarNit9GdKI5nJnj56B1iu0LuD13Qn/GZ+IUkrZROZaBdutN718NK6mIXdUjZGqg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- codemirror js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.0/codemirror.min.js" integrity="sha512-JpMCZgesTWh1iu/8ujURbwkJBgbgFWe3sTNCHdIuEvPwZuuN0nTUr2yawXahpgdEK7FOZUlW254Rp7AyDYJdjg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!-- dracula theme -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.0/theme/dracula.min.css" integrity="sha512-gFMl3u9d0xt3WR8ZeW05MWm3yZ+ZfgsBVXLSOiFz2xeVrZ8Neg0+V1kkRIo9LikyA/T9HuS91kDfc2XWse0K0A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- monokai theme -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.0/theme/monokai.min.css" integrity="sha512-R6PH4vSzF2Yxjdvb2p2FA06yWul+U0PDDav4b/od/oXf9Iw37zl10plvwOXelrjV2Ai7Eo3vyHeyFUjhXdBCVQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	
	<!-- mode javascript  -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.0/mode/javascript/javascript.min.js" integrity="sha512-DJ/Flq7rxJDDhgkO49H/rmidX44jmxWot/ku3c+XXEF9XFal78KIpu7w6jEaQhK4jli1U3/yOH+Rp3cIIEYFPQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!-- mode css -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.0/mode/css/css.min.js" integrity="sha512-5jz5G7Fn6Xbc3YA/5KYXYwxSkyKEh7oEFNwc7cCnMs48diTBh24gKxcbt7r8Do+xFK6pJgr+BFfcKnUne+XUvA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!-- mode htmlmixed  -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.0/mode/htmlmixed/htmlmixed.min.js" integrity="sha512-IC+qg9ITjo2CLFOTQcO6fBbvisTeJmiT5D5FnXsCptqY8t7/UxWhOorn2X+GHkoD1FNkyfnMJujt5PcB7qutyA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!-- mode xml -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.0/mode/xml/xml.min.js" integrity="sha512-UWfBe6aiZInvbBlm91IURVHHTwigTPtM3M4B73a8AykmxhDWq4EC/V2rgUNiLgmd/i0y0KWHolqmVQyJ35JsNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdn.tailwindcss.com"></script>

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<!--  -->

	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.0/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body <?php body_class(); ?>>
	<style type="text/css">
	body.single-code,
	body.single-code-branch{
		--codetype-ci1: #ff508b;
	}
	/*body.single-code-branch{
		--codetype-ci1: #ffeb3b;
	}
	*/	
	body.single-lesson,
	body.single-lesson-branch{
		--codetype-ci1: #22d3ee;
	}
	body.single-exercise,
	body.single-exercise-branch{
		--codetype-ci1: #ac60ff;
	}
	
	.codebox_editor{
		display: grid;
		height: 100vh;
		grid-template-columns: 1fr 1fr;
		grid-template-rows: 32px auto 50px;
		grid-template-areas: 
		"h h"
		"p e"
		"f f";
		position: relative;
	}
	.editor-alert{
		width: 10em;
		position: absolute;
		border-radius: 0 0 5px 5px;
		height: 32px;
		box-sizing: border-box;
		text-align: center;
		font-size: .9rem;
		color: #4d7c0f;
		left: calc(50% - 5em);
		top: -10px;
		border: 1px solid #4d7c0f;
		border-top: 0;
		z-index: 5;
		display: flex;
		transition: top .3s cubic-bezier(0, 1.52, 1, 1);
		justify-content: center;
		font-weight: bold;
		/*text-shadow: 0px 1px 0px #4d7c0f, 0px 1px 3px #4d7c0f;*/
		align-items: center;
		box-shadow: 0px 3px 8px #0006;
		background: #aaff00;
		background-image: linear-gradient(134deg, #a6e22e, transparent);
	}
}
body.admin-bar .codebox_editor{
	/*height: calc(100vh - 32px);*/
}
.codebox_editor-header {
	grid-area: h;
	background: #000;
	font-size: 12px;
	color: #ccc;
	align-items: center;
	padding-left: 8px;
	justify-content: space-between;
	position: relative;
	z-index: 10;
	display: grid;
	grid-auto-rows: 100%;
	grid-template-columns: 1fr 1fr;
	grid-gap: 8px;
}
.codebox_editor-preview{
	grid-area: p;
	background: #fff;
	position: relative;

}
.codebox_editor-editor{
	grid-area: e;
	background: #272822;
	position: relative;

}
.codebox_editor-footer{
	grid-area: f;
	background: #222;
	position: relative;

}
.codebox_editor-footer {
	grid-area: f;
	background: #222;
	position: relative;
	display: grid;
	grid-template-columns: 1fr 1fr;
	grid-template-rows: 100%;
}
.codebox_editor-footer-left,
.codebox_editor-footer-right {
	padding: 8px 6px;
	display: flex;
	justify-content: flex-start;
	align-items: center;
}
.codebox_editor-footer-right{
	justify-content: flex-end;
}
.cmd-btn {
	background: #ccc;
	padding: 0px 8px;
	box-sizing: border-box;
	font-size: .9rem;
	height: 100%;
	display: flex;
	justify-content: center;
	align-items: center;
	border-radius: 4px;
	color: #000;
	cursor: pointer;
	min-width: 34px;
}

.cmd-btn-outline{
	background: transparent;
	border: 1px solid;
	color: var(--btn-cl);
	transition: all .2s;

}
.cmd-btn-outline.cmd-btn:hover{
	opacity: 1;
}
.cmd-btn-outline:hover{
	color: #222;
	background: var(--btn-cl);
	border: 1px solid var(--btn-cl);
}
.cmd-btn.-branch{
	--btn-cl: #facc15;
}
.cmd-btn.-clone{
	--btn-cl: #22d3ee;
}
.cmd-btn.-download{
	--btn-cl: #ccc;
}
.btn-download{
	display: flex;
	justify-content: center;
	align-items: center;
	height: 100%;
}


.cmd-btn.-readme{
	background: transparent;
	color: var(--codetype-ci1,#ccc);
}
.cmd-btn.-duedate{
	background: transparent;
	color: #ccc;
}
:is(.single-code-branch,.single-lesson-branch,.single-exercise-branch) .cmd-btn.-readme{
	color: #ffeb3b;
}
.cmd-btn.-livepreview{
	background: transparent;
	/*border: 1px solid;*/
	color: #666;
	box-sizing: border-box;
	transition: all .2s;
}
.cmd-btn.-sync{
	background: transparent;
	color: var(--codetype-ci1);
}
.codebox_editor[data-live="1"] .-livepreview{
	color: #aaff00;
}
.codebox_editor[data-live="-1"]  .fa-toggle-on:before {
	content: "\f204";
}
.codebox_editor[data-live="1"] .-ctr.-update{
	display: none;
}
.-ctr.-update:hover{
	background: #22d3ee;
	color: #000;
}
.-ctr.-update {
    color: #22d3ee;
}
.codebox_editor-footer-left .cmd-btn{
	margin-right: 6px;
}
.codebox_editor-footer-right .cmd-btn{
	margin-left: 6px;
}
.cmd-btn:hover{
	opacity: .8;
}
.codebox_editor-header-logo{
	font-size: 16px;
	color: var(--codetype-ci1);
	/*color: #f92672;*/
}

#editor_title{
	color: var(--codetype-ci1);
}
:is(.single-code-branch,.single-lesson-branch,.single-exercise-branch) #editor_title{
	color: #ffeb3b;
}
.codebox_editor-preview-frame{
	width: 100%;
	height: 100%;
	display: flex;
	border: none;
}

.codebox_editor-editor-area{
	width: 100%;
	height: 100%;
	display: flex;
}
div#wpadminbar {
	display: none;
}
html { margin-top: 0px !important; }
.codebox_editor-header-login-1 .-uname {
	max-width: 12em;
	overflow: hidden;
	white-space: nowrap;
}
.codebox_editor-header-login {
	height: 100%;
}
.codebox_editor-header-login-1 .-upic {
	height: 24px;
	margin-right: 8px;
}
.codebox_editor-header-login-1 .-utoggle {

}
.codebox_editor-header-login-1 .-utoggle {
	margin-left: 8px;
	text-align: right;
}
.codebox_editor-header-login-1 .-utoggle i{

	transition: transform .2s;
	transform: rotate(0deg);
}
.codebox_editor-header-login-1,
.codebox_editor-header-login-0 {
	display: flex;
	justify-content: center;
	align-items: center;
	height: 100%;
	cursor: default;
	/*background: green;*/
	position: relative;
}
.codebox_editor-header-login-1{
	padding-left: 4px;
	padding-right: 8px;
}
.codebox_editor-header-login-1:hover{
	background: #222;
	color: #fff;
}
.codebox_editor-header-login-0{
	cursor: pointer;
	padding: 0 10px;
}
.codebox_editor-header-login-0:hover{
	background: #222;
	color: #fff;
}
.codebox_editor-header-login-1:hover .-utoggle i{
	transform: rotate(180deg);
}
.codebox_editor-header-login-1-menu {
	width: 180px;
	position: absolute;
	right: 0px;
	top: 32px;
	display: none;
}

.codebox_editor-header-login-1-menu-item{
	padding: 8px 12px;
	background: #111;
	border-top: 1px solid #000;
	cursor: pointer;
}
.codebox_editor-header-login-1-menu-item:hover{
	background: #222;
	color: #fff;
}
.codebox_editor-header-login-1:hover .codebox_editor-header-login-1-menu{
	display: block;
}
.codebox_editor-header-control {
	display: flex;
	justify-content: flex-end;
	align-items: center;
	height: 100%;
}
.-ctr {
	cursor: pointer;
	/*margin-right: 4px;*/
	height: 100%;
	padding: 0 10px;
	display: flex;
	align-items: center;
}
.-ctr:hover{
	color: #fff;
	background: #222;
}
.-ctr a:focus {
	outline: none;
}
.-ctr.-save:hover{
	background: #aaff00;
	color: #000;
}
.noselect {
	-webkit-touch-callout: none; /* iOS Safari */
	-webkit-user-select: none; /* Safari */
	-khtml-user-select: none; /* Konqueror HTML */
	-moz-user-select: none; /* Old versions of Firefox */
	-ms-user-select: none; /* Internet Explorer/Edge */
	user-select: none;
}
#readme_wrap{
	position: fixed;
	top: 0;
	left: 0;
	background: #f7fafcee;
	width: 100%;
	z-index: 1000;
	height: 100vh;
	padding: 1em;
	overflow-y: auto;
	box-sizing: border-box;
	/*border: 3px solid rgb(226 232 240);*/
	/*justify-content: center;
    align-items: center;
    display: flex;*/
}
#readme_wrap img{
	margin: 1em 0;
}
#readme_wrap[data-show="-1"] {
	display: none;
}
#readme_close {
    background: #dc0f00;
    width: 2em;
    height: 2em;
    top: 1em;
    color: #fff;
    justify-content: center;
    align-items: center;
    display: flex;
    border-radius: 3px;
    cursor: pointer;
    position: fixed;
    right: 1em;
    display: flex;
    justify-content: center;
    align-items: center;
}
#readme_cont{
	width: 100%;
	margin: auto;
	max-width: 900px;

}
.readme_title{ 
	color: var(--codetype-ci1);
	font-size: 2em;
	font-weight: bold;
	margin-top: 0;
	margin-bottom: .5em;
}
.readme_type {
    background: var(--codetype-ci1);
    color: #fff;
    margin-top: 2em;
    text-transform: uppercase;
    font-weight: bold;
    display: inline-block;
    padding: 0.2em 1em;
    font-size: .8rem;
    margin-bottom: 1em;
}
</style>
<form method="post">
	<script type="text/javascript">
		let boxTitle = `<?=str_replace('`','\`',get_the_title())?>`;
	</script>
	<div class="codebox_editor" data-live="1">
		<div class="editor-alert alert-saved">Saved</div>
		<div class="codebox_editor-header">
			<div class="codebox_editor-header-title">
				<div class="">
					<i class="fas fa-code codebox_editor-header-logo"></i>
					<span id="editor_title" class="px-2 text-xs"><?=get_the_title()?></span>
					<span>- &nbsp;<?=$owner_name?></span>&nbsp;&nbsp;
					<?php 
					if ($is_owner OR $is_mod) {
						?>
						<span class='cursor-pointer' id="edit_title">
							<i class="fas fa-edit"></i>
							Rename
						</span>
						<script type="text/javascript">
							document.querySelector('#edit_title').onclick = function(){
								let atitle = prompt('Title',boxTitle);
								if (atitle != null) {
									renameBox(atitle);
								}
							}
						</script>
						<?php
					}
					?>

					<?php if ($codeboxType == 'lesson' OR $codeboxType == 'lesson-branch' OR $codeboxType == 'exercise' OR $codeboxType == 'exercise-branch'): ?>
						
						<?php if ($is_mod): ?>&nbsp;
						<a href="/wp-admin/post.php?post=<?=get_the_ID()?>&action=edit" target="_blank">
							<span class='cursor-pointer' id="edit_title">
								<i class="fas fa-cog"></i>
								Settings
							</span>
						</a>
					<?php endif ?>
				<?php endif ?>
			</div>
		</div>
		<div class="codebox_editor-header-control">
			<div class="-ctr noselect -update" onclick="renderCode()" title="Ctrl + S">
				Update
			</div>
			<?php if ($is_owner OR $is_mod): ?>
				<div class="-ctr noselect -save" onclick="saveBox()" title="Ctrl + S">
					Save
				</div>
			<?php endif ?>

			<div class="-ctr noselect -preview">
				<a href="<?=get_permalink()?>?preview" target="_blank">
					<i class="fas fa-external-link-alt"></i> &nbsp;Preview
				</a>
			</div>
			<?php if ($codeboxType == 'code' OR $codeboxType == 'lesson'): ?>
				<div class="-ctr noselect -branch">
					<a href="?branches" target="_blank">
						<i class="fas fa-code-branch"></i> &nbsp;View All Branches
					</a>
				</div>
			<?php endif ?>
			<?php if ($codeboxType == 'exercise' AND $is_mod): ?>
				<div class="-ctr noselect -branch">
					<a href="?branches" target="_blank">
						<i class="fas fa-code-branch"></i> &nbsp;View All Assignments
					</a>
				</div>
			<?php endif ?>
			<?php if ($codeboxType == 'code-branch' OR $codeboxType == 'lesson-branch' OR $codeboxType == 'exercise-branch'): ?>
				<div class="-ctr noselect -branch">
					<a href="<?=$origin_url?>" target="_blank">
						<i class="fas fa-code-branch"></i> &nbsp;View Origin
					</a>
				</div>
			<?php endif ?>
			<div class="codebox_editor-header-login">
				<?php 
				if ($is_login) {
					?>
					<div class="codebox_editor-header-login-1">
						<img src="<?=$upic?>" class="-upic">
						<div class="-uname">
							<?=$u->display_name?>
						</div>
						<div class="-utoggle">
							<i class="fas fa-chevron-down"></i>
						</div>
						<div class="codebox_editor-header-login-1-menu noselect">
							<a href="<?=get_author_posts_url($uid)?>" class="">
								<div class="codebox_editor-header-login-1-menu-item">
									My Profile
								</div>
							</a>
							<a href="<?=wp_logout_url("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]".'?t='.time())?>" class="">
								<div class="codebox_editor-header-login-1-menu-item">
									Logout 👋
								</div>
							</a>
						</div>
					</div>
					<?php
				}else{
					?>
					<a href="/?google_redirect&redirect_to=<?=urlencode("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]".'?t='.time())?>&reauth=1" class="">
						<div class="codebox_editor-header-login-0">
							Login
						</div>
					</a>
					<?php
				}
				?>
			</div>

		</div>

	</div>
	<div class="codebox_editor-preview">
		<iframe id="code_preview" class="codebox_editor-preview-frame"></iframe>
	</div>
	<div class="codebox_editor-editor">
		<textarea id="code_area" class="codebox_editor-editor-area" name="code_area"><?php echo($f['html']); ?></textarea>
	</div>
	<div class="codebox_editor-footer noselect">
		<div class="codebox_editor-footer-left">
			<?php if ($codeboxType == 'lesson' OR $codeboxType == 'exercise'): ?>
				<div class="cmd-btn -readme" onclick="document.querySelector('#readme_wrap').dataset.show = 1">
					<i class="fab fa-readme"></i> &nbsp;&nbsp;
					<span style="color: #ccc" >Readme</span>
					<!-- #ccc -->
				</div>
			<?php endif ?>
			<div class="cmd-btn -livepreview" onclick="changeMode()">
				<i class="fas fa-toggle-on"></i> &nbsp;
				Live Preview
			</div>
			<?php if ($codeboxType == 'code-branch' OR $codeboxType == 'lesson-branch' OR $codeboxType == 'exercise-branch'): ?>
				<div class="cmd-btn -sync" title="Sync from original Codebox">
					<i class="fas fa-sync"></i> &nbsp;
					Sync Original
				</div>
			<?php endif ?>
			<?php if ($codeboxType == 'exercise' OR $codeboxType == 'exercise-branch'): ?>
				<div class="cmd-btn -duedate">
					<i class="fas fa-clock"></i> &nbsp;
					หมดเขตส่ง <?=$duedate?>
				</div>
			<?php endif ?>

		</div>
		<div class="codebox_editor-footer-right">
			<a href="?preview" download="" class="btn-download"><div class="cmd-btn cmd-btn-outline -download">
				<i class="fas fa-download"></i>
				&nbsp;&nbsp;Download
			</div>
		</a>
		<div class="cmd-btn cmd-btn-outline -clone" onclick="cloneBox()">
			<i class="fas fa-clone"></i>
			&nbsp;&nbsp;Clone
		</div>
		<?php if ($codeboxType == 'code' OR $codeboxType == 'lesson'): ?>
			<?php 
			if (sizeof($my_branch)<1){
				?>
				<div class="cmd-btn cmd-btn-outline -branch" onclick="branchBox()">
					<i class="fas fa-code-branch"></i>
					&nbsp;&nbsp;New Branch
				</div>	
				<?php
			}else{
				?>
				<a href="<?=get_permalink($my_branch[0]->ID)?>" target="_blank" style="height: 100%;">
					<div class="cmd-btn cmd-btn-outline -branch" >
						<i class="fas fa-code-branch"></i>
						&nbsp;&nbsp;View Your Branch
					</div>	
				</a>
				<?php
			}
			?>
		<?php endif ?>
		<?php if ($codeboxType == 'exercise'): ?>
			<?php 
			if (sizeof($my_branch)<1){
				?>
				<div class="cmd-btn cmd-btn-outline -branch" onclick="branchBox()"style="--btn-cl: #ac60ff;">
					<i class="fas fa-code exercise"></i>
					&nbsp;&nbsp;Do Assignment
				</div>	
				<?php
			}else{
				?>
				<a href="<?=get_permalink($my_branch[0]->ID)?>" target="_blank" style="height: 100%;">
					<div class="cmd-btn cmd-btn-outline -branch" style="--btn-cl: #ac60ff;">
						<i class="fas fa-code exercise"></i>
						&nbsp;&nbsp;View Your Assignment
					</div>	
				</a>
				<?php
			}
			?>
		<?php endif ?>
	</div>
</div>
</div>	
</form>
<?php if ($codeboxType == 'lesson' OR $codeboxType == 'exercise'): ?>
	<div id="readme_wrap" data-show="-1">
		<div id="readme_close" onclick="document.querySelector('#readme_wrap').dataset.show = -1">
			<i class="fas fa-times"></i>
		</div>
		<div id="readme_cont">
			<h3 class="readme_type"><?=$codeboxType?></h3>
			<h1 class="readme_title"><?=get_the_title()?></h1>
			<?php echo($f['description']) ?>
		</div>
	</div>
<?php endif ?>
<!-- <span onclick="for_dev.dataset.show *= -1">
	Dev
</span> -->
<div id="for_dev" data-show="-1">
	<div id="for_dev_close" onclick="for_dev.dataset.show *= -1">x</div>
	<?php
	pre($post_id,'$post_id');
	pre($owner_id,'$owner_id');
	pre($owner_name,'$owner_name');
	pre($is_login,'$is_login');
	pre($is_owner,'$is_owner');
	pre($uid,'$uid');
	pre($post,'$post');
	?>
</div>
<script type="text/javascript">
	const boxID = `<?=get_the_ID()?>`;
	let livepreview = 1;
	// init code page
	let delay,mode
	codeArea = document.getElementById('code_area')
	let codeMirrorHtml = CodeMirror.fromTextArea(codeArea,
	{
		mode:"text/html",
		lineNumbers: true,
		theme:"monokai",
		lineWrapping:true,
		value:"test"
	});
	codeMirrorHtml.on('change',function() {
		if(checkMode() == 'live'){
			clearTimeout(delay);
			delay = setTimeout(updatePreview, 100);
		}
		else{
			console.log('pass')
		}
		
	})
	function renderCode(){
		let previewFrame = document.getElementById('code_preview');
		let preview =  previewFrame.contentDocument ||  previewFrame.contentWindow.document;
		preview.open();
		preview.write(codeMirrorHtml.getValue());
		preview.close();

	}
	function updatePreview() {
		console.log('update live code')
		let previewFrame = document.getElementById('code_preview');
		let preview =  previewFrame.contentDocument ||  previewFrame.contentWindow.document;
		preview.open();
		preview.write(codeMirrorHtml.getValue());
		preview.close();
	}
	setTimeout(updatePreview, 150)

	function change_post_title(){
		let new_title = prompt('เปลี่ยนชื่อ Codebox เป็นอะไร?')
		document.getElementById('change_name_form').submit()
	}
	function changeMode(){
		livepreview *= -1;
		if(livepreview === 1){
			console.log('mode live');
		}
		else{
			console.log('mode save to render ');
		}
		console.log(livepreview)
		document.querySelector('.codebox_editor').dataset.live = livepreview
	}
	function checkMode() {
		if(livepreview === 1){
			return 'live'
		}
		else{
			return 'saveToRender'
		}
		
	}

	function saveBox() {
		// body...
		let codeboxValue = codeMirrorHtml.getValue();
		let dataObject = {value:codeboxValue,id:boxID}
		let formData = new FormData()

		for (let key in dataObject) {
			formData.append(key, dataObject[key])
		}
		axios.post('/save-box', formData)
		.then(data =>{
			if (data.data == '404') {
				alert('ไม่พบ Box ที่ต้องการ');
			}else{
				console.log(data.data.success)
				if (data.data.success == 1) {
					document.querySelector('.editor-alert.alert-saved').style.top = "32px";
					setTimeout(()=>{
						document.querySelector('.editor-alert.alert-saved').style.top = "-10px";
					},2000)
				}else{
					alert('พบปัญหาในการเซฟ กรุณาลองใหม่อีกครั้ง');	
				}
			}
		})
		.catch(err => {
			console.log(err)
			return null
		})
	}
	function cloneBox() {
		let codeboxValue = codeMirrorHtml.getValue()
		let dataObject = {title:boxTitle,value:codeboxValue}
		let formData = new FormData()

		for (let key in dataObject) {
			formData.append(key, dataObject[key])
		}

		axios.post('/clone', formData)
		.then(data =>{
			console.log(data)
			if (data.data == '404') {
				alert('ไม่พบ Box ที่ต้องการ');
			}else{
				console.log(data.data.success)
				if (data.data.success == 1) {
					alert('คุณโคลนโค้ดสำเร็จ!')
					location.href = data.data.url;
				}else{
					alert('พบปัญหาในการโคลน กรุณาลองใหม่อีกครั้ง');	
				}
			}
		})
		.catch(err => {
			console.log(err)
			return null
		})
	}
	<?php if ($codeboxType == 'code' OR $codeboxType == 'lesson' OR $codeboxType == 'exercise'): ?>

		function branchBox() {
			let codeboxValue = codeMirrorHtml.getValue()
			let dataObject = {id:boxID,value:codeboxValue}
			let formData = new FormData()

			for (let key in dataObject) {
				formData.append(key, dataObject[key])
			}

			axios.post('/new-branch', formData)
			.then(data =>{
				console.log(data)
				if (data.data == '404') {
					alert('ไม่พบ Box ที่ต้องการ');
				}else{
					console.log(data.data.success)
					if (data.data.success == 1) {
						alert('คุณสร้างบรานซ์ใหม่สำเร็จ!')
						location.href = data.data.url;
					}else{
						alert('พบปัญหาในการแตกบรานซ์ กรุณาลองใหม่อีกครั้ง');	
					}
				}
			})
			.catch(err => {
				console.log(err)
				return null
			})

		}
	<?php endif ?>

	<?php 
	if ($is_owner OR $is_mod) {
		?>
		function renameBox(atitle){
			let dataObject = {id:boxID,title:atitle}
			let formData = new FormData()

			for (let key in dataObject) {
				formData.append(key, dataObject[key])
			}

			axios.post('/rename', formData)
			.then(data =>{
				console.log(data)
				if (data.data == '404') {
					alert('ไม่พบ Box ที่ต้องการ');
				}else{
					console.log(data.data)
					if (data.data.success == 1) {
						document.querySelector('#editor_title').innerText = atitle
						boxTitle = atitle
					}else{
						alert('พบปัญหาในการแตกบรานซ์ กรุณาลองใหม่อีกครั้ง');	
					}
				}
			})
			.catch(err => {
				console.log(err)
				return null
			})
		}
		<?php
	}
	?>


</script>
<script type="text/javascript">
	document.body.onkeydown = (event)=>{
		// console.log(event.code)
		if (event.code == 'KeyS' &&  event.ctrlKey == true ) {
			saveBox();
		}
	}
</script>

<?php wp_footer() ?>
</body>
</html>