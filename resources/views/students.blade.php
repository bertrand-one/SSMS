<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SSMS-students</title>

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
          <h1 class="text-center text-2xl font-bold"><i class="fas fa-users"></i> Students</h1>
          
          <div class="flex justify-center gap-10 w-full mt-5">


            <div class="">

            @if ($students->isEmpty())
                 <p>No Students found!</p>
            @else

                <table class="inventory-table">
                    <tr>
                        <th>Student names</th>
                        <th>gender</th>
                        <th>date of birth</th>
                        <th>contact number</th>
                        <th>email</th>
                        <th>address</th>
                        <th>enrollment date</th>
                    </tr>
                @foreach($students as $student)
                    <tr>
                       <td>{{$student->firstName}} {{$student->lastName}}</td>
                       <td>{{$student->gender}}</td>
                       <td>{{$student->dateOfBirth}}</td>
                       <td>{{$student->contactNumber}}</td>
                       <td>{{$student->email}}</td>
                       <td>{{$student->address}}</td>
                       <td>{{$student->enrollmentDate}}</td>
                    </tr>
                @endforeach    
                </table>
            @endif    
            </div>


          <div>

          @if(session('error'))
            <div class="mt-5 text-center text-red-700 text-wrap wrap w-full">{{session('error')}}</div>
          @endif  

            <div class="flex items-center gap-5 justify-center rounded px-12 py-4 mb-3 bg-amber-200">
                <h3><i class="fas fa-users"></i> Total students:</h3>
                <p>{{$totalStudents}}</p>
            </div>

            <button class="btn back-beige w-full" onclick="showModal()"><i class="fas fa-user-plus"></i> add new student</button>
            

            <h2 class="text-lg font-semibold my-3">Student names</h2>

            <div class="flex gap-2">
               <input type="date" class="py-0 min-w-[100px] h-7">
               <button class="btn py-0 h-7 bg-green-700 text-white flex items-center"><i class="fas fa-filter"></i> filter</button>
            </div>


          </div>



          </div>
        </div>


        <div class="fixed z-10 inset-0 overflow-y-auto modal hidden">
                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-black opacity-75"></div>
                    </div>
                    <div class="inline-block w-auto align-bottom bg-white rounded text-left shadow-xl transform transition-all mt-12">
                        <div class="bg-green-700 text-amber-100 py-2 flex justify-center sm:p-6 sm:pb-4">
                            <h3 class="text-lg leading-6 font-2xl font-semibold text-amber-100" id="editModalLabel">add student</h3>
                        </div>
                        <div class="bg-amber-100 px-4 pb-5 sm:p-6">
                        <form action="students.add" method="post">
                            @csrf
                            <div class="grid grid-cols-2 gap-2">
<div>
<p>first name:</p>
<input type="text" name="firstName">
</div>

<div>
<p>second name:</p>
<input type="text" name="lastName">
</div>

<div>
<p>gender</p>
<select name="gender">
    <option value="male">Male</option>
    <option value="female">Female</option>
</select>
</div>

<div>
<p>date of birth</p>
<input type="date" name="dateOfBirth">
</div>

<div><p>contact number</p>
<input type="number" name="contactNumber">
</div>

<div>
<p>email</p>
<input type="email" name="email">
</div>

<div>
<p>address</p>
<input type="text" name="address">
</div>

<div>
<p>enrollment date</p>
<input type="date" name="enrollmentDate">
</div>
                             </div>

                                <div class="flex items-center justify-between gap-4 mt-5">
                                    <button type="button" class="bg-red-700 text-white btn" onclick="closeModal()">Cancel</button>
                                    <button type="submit" class="btn back-beige"><i class="fas fa-user-plus"></i>Add student</button>
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
