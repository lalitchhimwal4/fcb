<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Login </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend_assets/images/favicon.png')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,800&family=Fira+Sans+Condensed:wght@100;200;300;400;500;600;700&family=Fira+Sans:wght@100;200;300;400;500;600;700&family=Mulish:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <!-- Design style -->
    <link rel="stylesheet" href="{{asset('frontend_assets/css/style.css')}}" />
    <!-- Custom style -->
    <link rel="stylesheet" href="{{asset('frontend_assets/css/custom_style.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend_assets/css/responsive.css')}}" />
</head>

<body>
    <section class="login-page">
        <div class="form">
            <figure class="login-logo">
                <img src="{{Get_Meta_Tag_Value('General_Settings','Header_Logo')?asset('/storage/'.Get_Meta_Tag_Value('General_Settings','Header_Logo')):asset('frontend_assets/images/logo.png')}}" alt="logo">
            </figure>
            <form class="login-form" method="POST" action="{{ route('admin.checklogin') }}">
                @csrf
                <div class="input-wrap">
                    <i class="fas fa-user"></i>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Username">
                    @error('email')
                    <span class="invalid-feedback error" role="alert">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-wrap">
                    <i class="fas fa-lock"></i>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="password">
                    @error('password')
                    <span class="invalid-feedback error" role="alert">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit"> {{ __('Login') }}</button>
            </form>
        </div>
    </section>
    <script src="{{asset('frontend_assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('frontend_assets/js/popper.min.js')}}"></script>
    <script src="{{asset('frontend_assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('frontend_assets/js/waypoints.min.js')}}"></script>
    <script src="{{asset('frontend_assets/js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('frontend_assets/js/custom.js')}}"></script>
</body>

</html>