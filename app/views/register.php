<?php require VDIR.'/header.php' ?>
	<div id="mess">
	</div>
	<div id="login-area">
		<h3>REGISTER</h3>
		<form>
 			<div class="input-class">
			<input type="text" placeholder="Username" id="username" required="" autofocus>
			<label>Username</label>
			</div>
			<div class="input-class">
			<input type="password" placeholder="Password" id="password" required="">
			<label>Password</label>
			</div>
			<div class="input-class">
			<input type="password" placeholder="Repeat Password" id="repassword" required="">
			<label>Repeat Password</label>
			</div>
			<input type="button" onclick="register();" value="REGISTER">
			<a href="./login">Already have an account?</a>
		</form>
	</div>
 <?php require VDIR.'/footer.php' ?>