<!DOCTYPE html>
<html>
<head>
	<title>Raindrop CMS</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Rajdhani&display=swap" rel="stylesheet">
    <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>

	<style>
		body{
			height: 94vh;
			background: rgb(2,0,36);
			background: linear-gradient(121deg, rgba(2,0,36,1) 3%, rgba(9,9,121,0.9836309523809523) 50%, rgba(0,212,255,1) 99%);
		}

		a{
			text-decoration: overline;
		}

		.center {
			width: 70%;
			margin: 0 auto;
			text-align: center;
		}

		.center h1,h3,a,p {
			font-family: 'Radjhani', sans-serif;

		}

		h1,a {
			background: linear-gradient(45deg, #692b66 33%, #0D61BC 66%, #8AA9D6);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
		}

		h1 {
			font-size: 3em;
		}

		h3 {
			color: rgba(238, 233, 237, 0.98);
		}

		a{
            font-size: 1.5em;
            border-bottom: 3px solid #212088;
            border-bottom-right-radius: 5px;
            border-bottom-left-radius: 5px;
		}

        p{
            color: #af87ff;
        }

        .submit , button {
            border: none;
            width: 300px;
            height: 50px;
            color: #1c1c20;
            margin-top: 30px;
            font-size: 1.5em;
            border-bottom: 3px solid #1b1b67;
            border-radius: 5px;
            background-image: linear-gradient(to right, #79CBCA 0%, #d34c64 100%);
        }

        input {
            border: 1px solid grey;
            border-radius: 4px;
            width: 200px;
            height: 30px;
            margin-top: 30px;
            padding-left: 20px;

        }


        #info {
            color: #ff2c33;
            font-family: 'Radjhani', sans-serif;
            margin-top: 20px;
            font-size: 1.2em;
            letter-spacing: 1px;
        }



	</style>

    <script>

        var ajax = {

            ajaxMethod: 'POST',

            createAdmin: function () {

                event.preventDefault();

                var email_pattern = /^[\w]{1}[\w-\.]*@[\w-]+\.[a-z]{2,4}$/i;

                var email = $("input[name='admin_email']").val();
                var password = $("input[name='admin_password']").val();
                var login = $("input[name='admin_login']").val();

                if(!email_pattern.test(email)) {
                    $("#info").text('Wrong email');

                }else if(password.length <= '8') {
                    $("#info").text('Password\'s length must be greater than 8 symbols');

                }else if(login.length <= '1'){
                    $("#info").text('Login\'s length must be greater than 1 symbol');
                }else {

                    $.ajax({
                        url: '/',
                        type: this.ajaxMethod,
                        data: ({'email': email, 'password': password, 'login': login}),
                        beforeSend: function () {
                            $('#button').hide();

                        },
                        success: function (result) {
                            window.location.reload();
                        }
                    });
                }
            }
        };
    </script>

</head>
<body>
<div>
<div class="center">
	<h1>Raindrop CMS</h1>
	<br>
	<h3>SQL queries have been configured successfully</h3>
	<br>
    <h3>Come up with admin's Email & password</h3>

    <form id="adminForm" method="post">
        <input name="admin_login" placeholder="Login" type="text" required><br>
        <input name="admin_email" placeholder="Email" type="email" required><br>
        <input name="admin_password" placeholder="Password" type="password" required><br>



        <button id="button" type="submit" onclick="ajax.createAdmin()">Configure database</button>

    </form>

    <div id="info"></div>
</div>
</div>
</body>
</html>