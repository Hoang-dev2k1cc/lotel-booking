

<div class="row header">
    <div class=" logo col-3">
        <a href="{{route('home')}}"><img src="{{asset('template/img/logo.svg')}}" alt=""></a>
    </div>
    <div class="col-4">
        <form id="searchForm" action="{{route('search')}} " method="GET">
            <input placeholder="Thành phố, Vị trí, Giá tiền..." type="search" id="edit-name-city" name="key"
                maxlength="128" class="form-search form-control" />

                <input type="submit" id="submitFromSearch" value="Tìm kiếm">
        </form>
    </div>

    <div class="col-2">

    </div>
    <div class="col-2">
    </div>
    @if ( Auth::check())
    <div class=" user col-1">
        <div class="dropdown">
        <img class="dropbtn" onclick="myFunction()" src="{{asset('uploads/users/'.Auth::user()->photo)}}" >
           <div id="myDropdown" class="dropdown-content">
             <a href="{{route('history',['id'=> Auth::user()->id])}}">Lịch Sử</a>

             <a href="{{route('userInfor',['id'=> Auth::user()->id])}}">Thông Tin</a>
             <a href="{{route('logout')}}">Đăng xuất</a>
           </div>
         </div>
    </div>
    @else
    <div class=" user col-1">

        <div class="dropdown">
             <i class=" dropbtn fa-solid fa-user" aria-hidden="trues" onclick="myFunction()"></i>
           <div id="myDropdown" class="dropdown-content">
             <a href="{{route('showRegister')}}">Đăng Ký</a>
             <a href="{{route('show-form-login')}}">Đăng Nhập</a>
           </div>
         </div>
    </div>
    @endif
    @include('web.filter')
</div>
<script>
    /* When the user clicks on the button,
    toggle between hiding and showing the dropdown content */
    function myFunction() {
      document.getElementById("myDropdown").classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
      if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }
    </script>





<!-- Small modal -->



