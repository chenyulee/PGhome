<!DOCTYPE html>
<htmllang="zh-TW">

	<head>

		<title>會員登入系統</title>
	</head>

	<body>
		<form action="home.php" method="post">
			<table width="350" height="210" border="1" align="center">
				<tr>
					<td>
						<div align="center">
							<p>
								<font size=+2>會員登入</font>
							</p>
							<p>帳號:<input name="id" type="text"></p>
							<p>密碼:<input name="password" type="password"></p>
							<input type="submit" value="登入">
							<p><a href="member.php">註冊新會員</a></p>

							<p><?php
								if (isset($_GET['error'])) {
									echo $_GET['error'];
								}

								?></p>

						</div>
					</td>
				</tr>
			</table>
		</form>
	</body>

	</html>