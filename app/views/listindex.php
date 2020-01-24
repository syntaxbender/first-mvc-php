<?php require VDIR.'/header.php' ?>
<script type="text/javascript">
	$( document ).ready(function() {
    getList();
	});
</script>
	<div id="mess">
	</div>
	<div id="newnote">
		<div>
			<i onclick="$('#newnote').fadeOut(200);" class="fa fa-times-circle" aria-hidden="true"></i>
			<h3>New Note</h3>
			<form>
				<div class="input-class">
				<input class="input-class" type="text" placeholder="Title" id="title" required="" autofocus>
				<label>TITLE</label>
				</div>
				<textarea id="content" placeholder="Note Content"></textarea>
				<input type="button" onclick="addList();" value="Save">
			</form>
		</div>
	</div>
	<div id="readnote">
		<div>
			<i onclick="$('#readnote').fadeOut(200);" class="fa fa-times-circle" aria-hidden="true"></i>
			<h3></h3>
				<textarea></textarea>
			</form>
		</div>
	</div>
	<div id="main">
		<h3 style="margin-bottom: 20px;">NOTES</h3>
		<div id="notes">

		</div>
	</div>
	<div id="information">Hoşgeldiniz <?php echo $username;?> <div style="float: right;cursor:pointer;"><a href="<?php echo URL;?>/logout">Logout</a></div></div>
<?php require VDIR.'/footer.php' ?>