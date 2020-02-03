<!DOCTYPE html>
<html>
<head>
<title>Dashboard - Tutsmake.com</title>
 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!--Bootsrap 4 CDN-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{url('style.css')}}">
</head>
<body>
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 mx-auto">
                <h3 class="login-heading mb-4">Welcome {{ ucfirst(Auth()->user()->name) }}!</h3>
                <div class="card">
                    <div class="card-body">
                        <form action="{{url('post-registration')}}" method="POST" id="regForm">
                            {{ csrf_field() }}
                            <div class="form-label-group">
                            <input type="text" id="inputName" name="name" class="form-control" placeholder="Full name" autofocus>
                            <label for="inputName">Name</label>
            
                            @if ($errors->has('name'))
                            <span class="error">{{ $errors->first('name') }}</span>
                            @endif       
            
                            </div> 
                            <div class="form-label-group">
                            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" >
                            <label for="inputEmail">Email address</label>
            
                            @if ($errors->has('email'))
                            <span class="error">{{ $errors->first('email') }}</span>
                            @endif    
                            </div> 
            
                            <div class="form-label-group">
                            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password">
                            <label for="inputPassword">Password</label>
                            
                            @if ($errors->has('password'))
                            <span class="error">{{ $errors->first('password') }}</span>
                            @endif  
                            </div>
            
                            <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>