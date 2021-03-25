 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="/" class="brand-link">
         <img src="{{URL::asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light">Laravel Blog</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
             </div>
             <div class="info">
                 <a href="#" class="d-block">Alexander Pierce</a>
             </div>
         </div> -->

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                 <li class="nav-item">
                     <a href="

                     @role(ROLE_SUPERADMIN)
                     {{route('admin-dashboard')}}
                     @else
                     {{route('user-dashboard')}}
                     @endrole
                     " class="nav-link  {{ request()->is('user/dashboard') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>Dashboard </p>
                     </a>
                 </li>

                 @role(ROLE_SUPERADMIN)

                 <li class="nav-item">
                  <a href="{{route('users.index')}}"  class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                  <i class="fas fa-user"></i>
                    <p>Users</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{route('posts.index')}}"  class="nav-link {{ request()->is('admin/posts*') ? 'active' : '' }}">
                  <i class="fas fa-user"></i>
                    <p>Blog Posts</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{route('comments.index')}}"  class="nav-link {{ request()->is('admin/comments*') ? 'active' : '' }}">
                  <i class="fas fa-user"></i>
                    <p>Comments</p>
                  </a>
                </li>

                @endrole



             </ul>


         </nav>
         <!-- /.sidebar-menu -->
     </div>

     <!-- /.sidebar -->
 </aside>