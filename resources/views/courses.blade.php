<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SSMS-cources</title>

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
          <h1 class="text-center text-2xl font-bold"><i class="fas fa-book"></i> Courses</h1>
          
          <div class="flex justify-center gap-10 w-full mt-5">


            <div class="">
            @if($courses->isEmpty())
                <p>No courses found!</p>
            @else
                <table class="inventory-table">
                    <tr>
                        <th>Cource name</th>
                        <th>Cource description</th>
                        <th>Duration</th>
                    </tr>
                @foreach($courses as $course)
                    <tr onclick="rowClicked(this)" data-course-id="{{ $course->courseId }}" data-course-name="{{ $course->courseName }}">
                        <td>{{$course->courseName}}</td>
                        <td>{{$course->courseDescription}}</td>
                        <td>{{$course->duration}}</td>
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
                <h3><i class="fas fa-book-open"></i> Total courses:</h3>
                <p>{{$totalCourses}}</p>
            </div>

            <button class="btn back-beige w-full" onclick="showModal()"><i class="fas fa-plus-circle"></i> add new course</button>
            
            <div id="selectedCourseInfo" style="margin-top: 20px;">
              <input type="text" id="selectedCourseId" hidden>
              <input type="text" id="selectedCourseName" class="border-none p-0 font-bold w-auto text-blue-900">
            </div>

            <h2 class="text-lg font-semibold my-3">Select Course and -></h2>
            <a href="#" onclick="redirectToAttendance()"><button class="btn-sm bg-green-700 text-white"><i class="fas fa-clipboard-list"></i> make attendance</button></a>

            <a href="#" onclick="redirectToGrades()"><button class="btn-sm bg-green-700 text-white"><i class="fas fa-chalkboard-teacher"></i> record grades</button></a>



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
                            <h3 class="text-lg leading-6 font-2xl font-semibold text-amber-100" id="editModalLabel">add course</h3>
                        </div>
                        <div class="bg-amber-100 px-4 pb-5 sm:p-6">
                        <form action="course.add" method="post">
                            @csrf
                            <div class="grid grid-cols-2 gap-2">
<div>
<p>Cource name:</p>
<input type="text" name="courseName">
</div>

<div>
<p>Description name:</p>
<input type="text" name="courseDescription">
</div>

<div>
<p>duration</p>
<input type="text" name="duration">
</div>

                             </div>

                                <div class="flex items-center justify-between gap-4 mt-5">
                                    <button type="button" class="bg-red-700 text-white btn" onclick="closeModal()">Cancel</button>
                                    <button type="submit" class="btn back-beige">Add course</button>
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

        function rowClicked(row) {
        const courseId = row.dataset.courseId;
        const courseName = row.dataset.courseName;

        document.getElementById('selectedCourseId').value = courseId;
        document.getElementById('selectedCourseName').value = courseName;
        document.getElementById('selectedCourseInfo').style.display = 'block';
    }


    function redirectToAttendance() {
                    const courseId = document.getElementById('selectedCourseId').value;
                    if (courseId) {
                        window.location.href = `/attendance/${courseId}`;
                    } else {
                        alert('Please select a course first.');
                    }
                }

                function redirectToGrades() {
                    const courseId = document.getElementById('selectedCourseId').value;
                    if (courseId) {
                        window.location.href = `/grades/${courseId}`;
                    } else {
                        alert('Please select a course first.');
                    }
                }
    </script>
    </body>
</html>
