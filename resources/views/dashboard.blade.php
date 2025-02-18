<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SSMS-dashboard</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />


        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
         @endif
    </head>
    <body class="bg-amber-100">
        
          <x-navbar />
          <div class="mx-12">
          <h1 class="text-center text-2xl font-bold"><i class="fas fa-home"></i>Dashboard</h1>
          
          <div class="grid grid-cols-2 gap-10 mx-[200px] mt-5">

             <div class="flex flex-col gap-4">

                <div class="w-full py-5 shadow flex flex-col items-center rounded">
                   <h3 class="text-xl font-semibold">Total students</h3>
                   <p class="text-2xl">{{$totalStudents}}</p>
                   <a href="/students"><button class="btn text-green-700 mt-5"><i class="fas fa-plus-circle text-green-700"></i> Add new students</button></a>
                </div>

                <div class="w-full py-5 shadow flex flex-col items-center rounded">
                   <h3 class="text-xl font-semibold">Total Courses</h3>
                   <p class="text-2xl">{{$totalCourses}}</p>
                   <a href="/courses"><button class="btn text-green-700 mt-5"><i class="fas fa-plus-circle text-green-700"></i> Add new course</button></a>
                </div>

             </div>

           

             <div class="flex flex-col gap-4">

                <div class="w-full py-5 border-[1px] border-red-300 shadow flex flex-col items-center rounded">
                   <h3 class="text-xl font-semibold"><i class="fas fa-star"></i> Grades rate</h3>
                   <div class="flex justify-center gap-4 p-2 w-full mt-3 rounded bg-amber-200">
                        <h3 class="font-semibold">This day:</h3>
                        <p>{{$gradesRate}}%</p>
                   </div>
                </div>

                <div class="w-full py-5 border-[1px] border-red-300 shadow flex flex-col items-center rounded">
                   <h3 class="text-xl font-semibold"><i class="fas fa-check-circle"></i> Attendance rate</h3>
                   <div class="flex justify-center gap-4 p-2 w-full mt-3 rounded bg-amber-200">
                        <h3 class="font-semibold">This day:</h3>
                        <p>{{$attendanceRate}}%</p>
                   </div>
                </div>

             </div>

          </div>
        </div>
    </body>
</html>
