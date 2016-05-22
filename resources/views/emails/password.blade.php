<!doctype html>
<html lang="en-NZ">
    <head>
        <style type="text/css">
            body {
                margin: none;
            }
            h1 {
                padding: 20px;
                font-family: 'Menlo', 'Lucida Console', system, sans-serif;
                text-transform: lowercase;
                background-color: green;
                color: white;
            }
            p {
                padding: 20px;
            }
        </style>
    </head>
    <body>
        <h1>HealthClub</h1>

        <p>Click here to reset your password: {{ url('password/reset/'.$token) }}</p>
    </body>
</html>
