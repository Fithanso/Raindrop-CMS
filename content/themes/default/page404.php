<!DOCTYPE html>
<html>
<head>
	<title>Raindrop CMS</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Rajdhani&display=swap" rel="stylesheet">

	<style>
		body{
			height: 100vh;
			background: rgb(2,0,36);
			background: linear-gradient(121deg, rgba(2,0,36,1) 3%, rgba(9,9,121,0.9836309523809523) 50%, rgba(0,212,255,1) 99%);
		}

        a{
            font-size: 2em;
            font-weight: 700;
            background: linear-gradient(45deg, #692b66 33%, #0D61BC 70%, #8AA9D6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

		.center {
			width: 50%;
			margin: 100px auto;
			text-align: center;
		}

		.center h1,h2,a {
			font-family: 'Radjhani', sans-serif;

		}

        .center h1 {
            margin-top: -50px;
        }

		/*h1,a {
			background: linear-gradient(45deg, #692b66 33%, #0D61BC 66%, #8AA9D6);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
		}*/

		#error {
			font-size: 3em;
			background: linear-gradient(45deg, #692b66 33%, #0D61BC 66%, #8AA9D6);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
		}

		#h1404 {
			font-size: 12em;
			background: linear-gradient(45deg, #692b66 33%, #0D61BC 66%, #8AA9D6);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			text-shadow: -8px 0px 1px rgb(53, 36, 153);
			letter-spacing: 5px;
		}

        #info {
            background: linear-gradient(to right, #dd5369 0%, #a662f4 51%, #4f2beb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 3em;
            letter-spacing: 2px;
            margin-bottom: 60px;
        }



	</style>

</head>
<body>
<div>
	<div class="center">
		<h1 id="error">ERROR</h1>
		<h1 id="h1404">404</h1>

        <h2 id="info">PAGE NOT FOUND</h2>

		<a href="/">Go to index page</a>
	</div>
</div>
</body>
</html>