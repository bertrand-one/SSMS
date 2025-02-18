<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SSMS-attendance</title>

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
            <div class="flex justify-center items-center gap-12">
                <a href="/courses"><button class="text-green-700 rounded"><i class="fas fa-arrow-left"></i> back</button></a>
              
            <form action="/attendance" method="POST">    
            @csrf

            @foreach($course as $cours)
              <input type="hidden" id="courseId" name="courseId" value="{{$cours->courseId}}">
              <h1 class="text-center text-2xl font-bold flex items-center gap-3">
                Attendance for 
                <p class="text-blue-900">{{$cours->courseName}}</p>
              </h1>
            @endforeach
            </div>
          
          <div class="flex justify-center gap-10 w-full mt-3">


          <div class="">
            <h2 class="text-lg font-semibold text-green-900">All attendances made</h2>
              @if($attendance->isEmpty())
                  <p>No Attendance found!</p>
              @else    
                <table class="inventory-table">
                    <tr>
                        <th>Student names</th>
                        <th>gender</th>
                        <th>status</th>
                        <th>date</th>
                    </tr>
                  @foreach($attendance as $at)
                    <tr>
                        <td>{{$at->students->firstName}} {{$at->students->lastName}}</td>
                        <td>{{$at->students->gender}}</td>
                        @if($at->attendanceStatus == 'present')
                          <td class="text-green-700">{{$at->attendanceStatus}}</td>
                        @else
                          <td class="text-red-700">{{$at->attendanceStatus}}</td>
                        @endif
                        <td>{{$at->attendanceDate}}</td>
                    </tr>
                  @endforeach  
                </table>
              @endif
            </div>


            <div class="">
            <h2 class="text-lg font-semibold text-green-900">New attendance</h2>


              @if($students->isEmpty())
                  <p>No Students found!</p>
              @else    
                <table class="inventory-table">
                    <tr>
                        <th>Student names</th>
                        <th>gender</th>
                        <th>status</th>
                    </tr>
                  @foreach($students as $student)
                    <tr>
                        <td>{{$student->firstName}} {{$student->lastName}}</td>
                        <td>{{$student->gender}}</td>
                        <td>
                          <select name="attendanceStatus[{{ $student->studentId }}]" class="border-none text-green-900 p-0 text-right focus:ring-0 focus:outline-none bg-transparent">
                            <option value="present">present</option>
                            <option value="abscent">abscent</option>
                            <option value="other">other</option>
                          </select>
                        </td>
                    </tr>
                  @endforeach  
                </table>
              @endif
            </div>


          <div>
            <div class="flex items-center gap-5 justify-center rounded px-12 py-4 mb-3 bg-amber-200">
                <h3><i class="fas fa-users"></i> Total students:</h3>
                <p>{{$totalStudents}}</p>
            </div>

            <div class="flex items-center gap-5 justify-center rounded px-12 py-4 mb-3 bg-amber-200">
                <h3><i class="fas fa-user-check"></i> Total present:</h3>
                <p>25</p>
            </div>

            <div class="flex items-center gap-5 justify-center rounded px-12 py-4 mb-3 bg-red-200">
                <h3><i class="fas fa-user-times"></i> Total abscent:</h3>
                <p>100</p>
            </div>

            <button type="submit" class="rounded p-1 bg-green-700 text-white w-full"><i class="fas fa-clipboard-list"></i> finish attendance</button>
        
</form>

          </div>



          </div>
        </div>


    


    </body>
</html>
