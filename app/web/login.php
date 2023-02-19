<html>
<head>
	<title>php-sqlite-sandbox</title>
	<link rel="stylesheet" href="res/tacit.min.css"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
	<section>
		<article>
			<h3>Harap Login Dahulu</h3>
			<hr>
			<fieldset>
				<form method="POST" action="/login_auth"> 
					<label>Email : </label>
					<input type="text" id="email" name="_email" />
					<label>Passkey : </label>
					<input type="password" id="passkey" name="_passkey" />
					
					<input type="hidden" id="is_login" name="is_login" value="1" />
					<label></label>
					<button type="submit" id="btn_login">Login</button>
					<button type="reset" id="btn_reset">Reset</button>
				</form>
			</fieldset>
		</article>
	</section>
</body>
</html>