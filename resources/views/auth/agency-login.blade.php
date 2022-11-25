<!DOCTYPE html>
<html>

<head>
    <title>Vendor Login Form</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />

    <style>
        .main {
            padding: 20px;
            font-family: "Helvetica", serif;
            box-shadow: 5px 5px 5px 5px #cfcdcd;
        }

        .main h1 {
            font-size: 40px;
            text-align: center;
            font-family: "Helvetica", serif;
        }

        input {
            font-family: "Helvetica", serif;
            width: 100%;
            font-size: 20px;
            padding: 12px 20px;
            margin: 8px 0;
            border: none;
            border-bottom: 2px solid #07a74f;
        }

        input[type="submit"] {
            font-family: "Helvetica", serif;
            width: 100%;
            background-color: #07a74f;
            border: none;
            color: white;
            padding: 16px 32px;
            margin: 4px 2px;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <br />
    <br />
    <br />
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>

            <div class="col-md-6 main">
                <form method="POST" action="{{ route('agency.login.submit') }}">
                    @csrf
                    <h1>Agency Login Form</h1>

                    <input class="box" type="text" name="username" id="username" placeholder="Username "
                        required /><br />

                    <input class="box" type="password" name="password" id="password" placeholder="Password "
                        required /><br />

                    <input type="submit" value="Submit" /><br />

                    {{--  @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif  --}}
                </form>
            </div>

            <div class="col-md-3"></div>
        </div>
    </div>
</body>

</html>