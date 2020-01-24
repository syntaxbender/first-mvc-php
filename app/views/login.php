<?php require VDIR.'/header.php' ?>
<script type="text/javascript">
$(document).keypress(function(event){
if(event.keyCode == 13){
	login();
}
});
</script>
	<div id="mess">
	</div>
	<div id="login-area">
		<h3>LOGIN</h3>
		<form>
			<div class="input-class">
				<input type="text" placeholder="Username" id="username" required="" autofocus>
				<label>Username</label>
			</div>
			<div class="input-class">
				<input type="password" placeholder="Password" id="password" required="">
				<label>Password</label>
			</div>

			<input type="button" onclick="login();" value="LOGIN">
			<a href="<?php echo URL;?>/register">Create an account</a>
		</form>
	</div>
<?php require VDIR.'/footer.php' ?>