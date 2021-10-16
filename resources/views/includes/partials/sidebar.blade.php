<!-- Page Sidebar Start-->
<div class="page-sidebar">
  <div class="main-header-left d-none d-lg-block">
    <div class="logo-wrapper"><a href="#"><img height="50px" width="50px" src="{{asset('assets/images/logo/logo.png')}}" alt=""></a>
        <a class="f-14 mt-3" href="#"><h5>AUCTIONHUT</h5></a>

    </div>
  </div>
  <div class="sidebar custom-scrollbar">
    <div class="sidebar-user text-center">
      <div><img class="img-60 rounded-circle" src="{{auth()->user()->getImagePath()}}" alt="#">
        <div class="profile-edit"><a href="{{route('profile')}}" target="_blank"><i data-feather="edit"></i></a></div>
      </div>
      <h6 class="mt-3 f-14">{{auth()->user()->name}}</h6>
      <p>{{auth()->user()->role}}</p>
    </div>
      <ul class="sidebar-menu">
{{--          <li><a class="sidebar-header" href="{{route('categories.index')}}"><i data-feather="home"></i><span>Dashboard</span></a>--}}
{{--          </li>--}}
          <li class="active"><a class="sidebar-header" href="#"><i
                      data-feather="menu"></i><span>Categories</span><i
                      class="fa fa-angle-right pull-right"></i></a>
              <ul class="sidebar-submenu">
                  <li class="active"><a href="{{route('categories.index')}}"><i class="fa fa-circle"></i>List</a></li>
                  <li><a class="active" href="{{route('categories.create')}}"><i class="fa fa-circle"></i>Add New</a></li>
              </ul>
          </li>
          <li class="active"><a class="sidebar-header" href="#"><i
                      data-feather="menu"></i><span>Auctions</span><i
                      class="fa fa-angle-right pull-right"></i></a>
              <ul class="sidebar-submenu">
                  <li class="active"><a href="{{route('auctions.index')}}"><i class="fa fa-circle"></i>List</a></li>
                  <li><a class="active" href="{{route('auctions.create')}}"><i class="fa fa-circle"></i>Add New</a></li>
              </ul>
          </li>
          <li class="active"><a class="sidebar-header" href="#"><i
                      data-feather="menu"></i><span>Users</span><i
                      class="fa fa-angle-right pull-right"></i></a>
              <ul class="sidebar-submenu">
                  <li class="active"><a href="{{route('users.index')}}"><i class="fa fa-circle"></i>List</a></li>
              </ul>
          </li>
      </ul>
  </div>
</div>
<!-- Page Sidebar Ends-->

