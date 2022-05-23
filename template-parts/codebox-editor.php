<?php 
global $post_id;
global $owner_id;
global $owner_name;
global $is_login;
global $is_owner;
global $uid;
?>
<!DOCTYPE html>
<html>
<?php 
$f = get_fields();
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
	.codebox_editor{
		display: grid;
		height: 100vh;
		grid-template-columns: 1fr 1fr;
		grid-template-rows: 32px auto 50px;
		grid-template-areas: 
		"h h"
		"p e"
		"f f";
	}
	body.admin-bar .codebox_editor{
		height: calc(100vh - 32px);
	}
	.codebox_editor-header{
		grid-area: h;
		background: #000;
		display: flex;
		font-size: 12px;
		color: #ccc;
		align-items: center;
		padding-left: 8px;
		justify-content: space-between;

	}
	.codebox_editor-preview{
		grid-area: p;
		background: #fff;

	}
	.codebox_editor-editor{
		grid-area: e;
		background: #272822;

	}
	.codebox_editor-footer{
		grid-area: f;
		background: #222;

	}
	.codebox_editor-header-logo{
		font-size: 16px;
		color: #1bdbf2;
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

</style>
<form method="post">
	<script type="text/javascript">
		let boxTitle = `<?=str_replace('`','\`',get_the_title())?>`;
	</script>
	<div class="codebox_editor">
		<div class="codebox_editor-header">
			<div>
				<div class="">
					<i class="fas fa-code codebox_editor-header-logo"></i>
					<span id="editor_title" class="px-2 text-xs"><?=get_the_title()?></span>
					<span class='cursor-pointer' id="edit_title">
						<i class="fas fa-edit"></i>
						Edit
					</span>
					<script type="text/javascript">
						document.querySelector('#edit_title').onclick = function(){
							let atitle = prompt('Title',boxTitle);
							if (atitle != null) {
								renameBox(atitle);
							}
						}

					</script>
				</div>
			</div>
			<div class="pr-4 cursor-pointer" onclick="saveBox()">
				save codebox
			</div>
			<div class="pr-4 cursor-pointer" onclick="changeMode()">
				changemode
				<div id="codeboxMode" style="display: none;">1</div>
			</div>
			<div class="pr-4 cursor-pointer" onclick="renderCode()">
				render html
			</div>
			<div class="pr-4 cursor-pointer" onclick="branchBox()">
				branch
			</div>
		</div>
		<div class="codebox_editor-preview">
			<iframe id="code_preview" class="codebox_editor-preview-frame"></iframe>
		</div>
		<div class="codebox_editor-editor">
			<textarea id="code_area" class="codebox_editor-editor-area" name="code_area"><?php echo($f['html']); ?></textarea>
		</div>
		<div class="codebox_editor-footer">
			<span onclick="for_dev.dataset.show *= -1">
				Dev
			</span>
			<span onclick="cloneBox()">
				Clone
			</span>
			<span>
				<a href="/?google_redirect&redirect_to=<?=urlencode(get_the_permalink().'?t='.time())?>&reauth=1" class="">
					<div class="tbtn tbtn-login"><i class="fab fa-google"></i> &nbsp;&nbsp;&nbsp; <span class="size-s">Login with Google</span>
					</div>
				</a>
			</span>
			<span>
				<a href="/wp-login.php?action=logout&amp;redirect_to=<?=urlencode(get_the_permalink().'?t='.time())?>" class="cl-white">
					<div class="tbtn tbtn-logout">
						👋
						<div class="size-vs b7 sans">Logout</div>
					</div>
				</a>
			</span>
		</div>
	</div>	
</form>
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
			delay = setTimeout(updatePreview, 300);
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
		mode = parseInt(codeboxMode.innerText)
		mode = mode * -1
		if(mode === 1){
			console.log('mode live');
			codeboxMode.innerText = parseInt(mode);
			console.log(mode)
		}
		else{
			console.log('mode save to render ');
			codeboxMode.innerText = parseInt(mode);
			console.log(mode)
		}
	}
	function checkMode() {
		if(mode === 1){
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
</script>


<?php wp_footer() ?>
</body>
</html>