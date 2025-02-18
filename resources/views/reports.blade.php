<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SSMS-report</title>

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
          <h1 class="text-center text-2xl font-bold"><i class="fas fa-file-alt"></i> Attendance report</h1>
          
          <div class="flex justify-center gap-10 w-full mt-5">


            <div class="">
            @if($attendance->isEmpty())
                  <p>No Attendance found!</p>
              @else    
                <table class="inventory-table">
                    <tr>
                        <th>Student names</th>
                        <th>gender</th>
                        <th>course</th>
                        <th>status</th>
                        <th>date</th>
                    </tr>
                  @foreach($attendance as $at)
                    <tr>
                        <td>{{$at->students->firstName}} {{$at->students->lastName}}</td>
                        <td>{{$at->students->gender}}</td>
                        <td>{{$at->courses->courseName}}</td>
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


          <div>

             <form action="/reports" method="post">
                @csrf
            <input type="date" class="p-1 mb-3" name="date"/>
            <div class="flex gap-2 mb-3">
               <select class="py-0 min-w-[100px] h-7" name="courseId">
                @if($courses->isEmpty())
                    <option value="">No courses found!</option>
                @else
                    <option value="">select course</option>
                    @foreach($courses as $course)
                        <option value="{{$course->courseId}}">{{$course->courseName}}</option>
                    @endforeach
                @endif
               </select>
               <button type="submit" class="btn py-0 h-7 bg-green-700 text-white flex items-center"><i class="fas fa-filter"></i> filter</button>
            </div>

          <div class="flex items-center gap-5 justify-center rounded px-12 py-4 mb-3 bg-amber-200">
                <h3><i class="fas fa-users"></i> Total students:</h3>
                <p>125</p>
            </div>

            <div class="flex items-center gap-5 justify-center rounded px-12 py-4 mb-3 bg-amber-200">
                <h3><i class="fas fa-user-check"></i> Total present:</h3>
                <p>25</p>
            </div>

            <div class="flex items-center gap-5 justify-center rounded px-12 py-4 mb-3 bg-red-200">
                <h3><i class="fas fa-user-times"></i> Total abscent:</h3>
                <p>100</p>
            </div>
            


          </div>



          </div>
        </div>


        <div class="fixed z-10 inset-0 overflow-y-auto modal hidden">
                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-black opacity-75"></div>
                    </div>
                    <div class="inline-block w-auto align-bottom bg-white rounded text-left shadow-xl transform transition-all ">
                        <div class="bg-green-700 text-amber-100 py-2 flex justify-center sm:p-6 sm:pb-4">
                            <h3 class="text-lg leading-6 font-2xl font-semibold " id="editModalLabel">add student</h3>
                        </div>
                        <div class="bg-amber-100 px-4 pb-5 sm:p-6">
                        <form action="">
                            <div class="grid grid-cols-2 gap-2">
<div>
<p>first name:</p>
<input type="text">
</div>

<div>
<p>second name:</p>
<input type="text">
</div>

<div>
<p>gender</p>
<select>
    <option value="male">Male</option>
    <option value="female">Female</option>
</select>
</div>

<div>
<p>date of birth</p>
<input type="date">
</div>

<div><p>contact number</p>
<input type="number">
</div>

<div>
<p>email</p>
<input type="email">
</div>

<div>
<p>address</p>
<input type="text">
</div>
                             </div>

                                <div class="flex items-center justify-between gap-4 mt-5">
                                    <button type="button" class="bg-red-700 text-white btn" onclick="closeModal()">Cancel</button>
                                    <button type="submit" class="btn back-beige">Add student</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        <script>
        function showModal(){
            const modal = document.querySelector(".modal");
            modal.style.display="block";
        }

        function closeModal(){
            const modal = document.querySelector(".modal");
            modal.style.display="none";
        }
    </script>
    </body>
</html>
