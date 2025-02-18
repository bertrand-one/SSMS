<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SSMS</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
         @endif
    </head>
    <body class="bg-amber-100 grid grid-cols-2 items-center">
       <div class="flex flex-col justify-center items-center">
            <h1 class="logo text-green-700">SSMS</h1>
            <p>Login to Account</p>
          <form action="login.post" method="POST">
          @csrf
            <p>username:</p>
            <input type="text" name="UserName">
            <p>password:</p>
            <input type="password" name="password"><br>
            <button type="submit" class="btn bg-green-700 text-amber-100 mt-5 w-full">Login</button>
          </form>

          @if($errors->any())
             @foreach($errors->all() as $error)
              <div class="mt-5 text-center text-red-700 text-wrap wrap w-full">{{$error}}</div>
             @endforeach
          @endif

       </div>
       <div class="h-[100vh] bg-green-700 flex flex-col items-center justify-center px-12 text-amber-100">
            <h1 class="text-4xl font-semibold text-center">WELCOME TO SCHOOL STUDENTS MANAGEMENT SYSTEM</h1>
            <p class="py-12">If you do not have account</p>
            <a href="/"><button class="btn bg-amber-100 text-black rounded-full">Register</button></a>
       </div>
    </body>
</html>
