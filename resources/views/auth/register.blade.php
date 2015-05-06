<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Index</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

        <style media="screen">
            body {
                padding-top: 70px;
            }
        </style>
    </head>
    <body class="container">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">註冊</h3>
            </div>
            <div class="panel-body">
                <form method="post" action="/auth/register">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="exampleInputName1">姓名</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="exampleInputName1" placeholder="宋炫恩">
                        <span class="help-block text-danger">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">帳號</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="exampleInputEmail1" placeholder="example@gmail.com">
                        <span class="help-block text-danger">{{ $errors->first('email') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">密碼</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="**********">
                        <span class="help-block text-danger">{{ $errors->first('password') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword2">再次確認密碼</label>
                        <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword2" placeholder="**********">
                        <span class="help-block text-danger">{{ $errors->first('password_confirmation') }}</span>
                    </div>
                    <a class="btn btn-default" href="/auth/login" role="button">已經有帳號？</a>
                    <button type="submit" class="btn btn-primary">創新帳號</button>
                </form>
            </div>
        </div>

    </body>
</html>
