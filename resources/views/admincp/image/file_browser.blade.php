<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.17.1/ckeditor.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			var funcNum = <?php echo $_GET['CKEditorFuncNum'].';';?>
			$('#fileExplorer').on('click', 'img', function() {
				var fileUrl = $(this).attr('title');
				window.opener.CKEDITOR.tools.callFunction(funcNum,fileUrl);
				window.close();
			}).hover(function() {
				$(this).css('cursor', 'poiter');
			});
		});
	</script>
	<style type="text/css">
		ul.file-list{
			list-style: none;
		}
		ul.file-list li{
			float: left;
			margin: 5px;
			border: 1px solid;
			padding: 10px;
		}
		ul.file-list img{
			display: block;
			margin: 0 auto;
		}
		ul.file-list li:hover{
			background-color: cornsilk;
			cursor: pointer;
		}
	</style>
</head>
<body>
	<div id="fileExplorer">
		@foreach ($fileNames as $file)
			<div class="thumbnail">
				<ul class="file-list">
					<li><img src="{{ asset('public/uploads/ckeditor/'.$file) }}" alt="a" title="{{ asset('/public/uploads/ckeditor/'.$file) }}" width="120" height="130">
						<br>
						<span style="color:blue">{{$file}}</span></li>
				</ul>
			</div>
		@endforeach
	</div>
</body>
</html>