<div class="w-full text-amber-100 bg-green-700 py-3 mb-5 px-10 flex justify-between items-center rounded-b">
    <div>
      <h1 class="logo">SSMS</h1>
    </div>

       <div class="flex items-center gap-4">
           <a href="/dashboard"><p><i class="fas fa-home"></i> Dashboard</p></a>
           <a href="/students"><p><i class="fas fa-users"></i> Students</p></a>
           <a href="/courses"><p><i class="fas fa-book"></i> Courses</p></a>
           <a href="/reports"><p><i class="fas fa-file-alt"></i> Reports</p></a>
           <form action="/logout" method="post">
            @csrf
           <button type="submit"><p><i class="fas fa-sign-out-alt"></i> Logout</p></button>
           </form>
       </div>

       <div class="flex items-center gap-2">
          <div class="h-[35px] w-[35px] rounded-full flex items-center justify-center bg-amber-100 text-black">
            {{substr(session('username'),0,1)}}
          </div>
          <p>{{session('username')}}</p>
       </div>
  
</div>