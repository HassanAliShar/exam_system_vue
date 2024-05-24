<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="{{ asset('images/logo-global.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Global DHA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        @if(isset(auth()->user()->id))
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ auth()->user()->image ?? asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ auth()->user()->name ?? 'Visitor' }}</a>
                </div>
            </div>
        @endif
      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item {{ Request::routeIs('subject.manage') || Request::routeIs('subject.add')  ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::routeIs('subject.manage') || Request::routeIs('subject.add')  ? 'active' : '' }}">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Subjects
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('subject.manage') }}" class="nav-link {{ Request::routeIs('subject.manage')  ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('subject.add') }}" class="nav-link {{ Request::routeIs('subject.add')  ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{ Request::routeIs('course.manage') || Request::routeIs('course.add')  ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::routeIs('course.manage') || Request::routeIs('course.add')  ? 'active' : '' }}">
              <i class="nav-icon fas fa-graduation-cap"></i>
              <p>
                Courses
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('course.manage') }}" class="nav-link {{ Request::routeIs('course.manage')  ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('course.add') }}" class="nav-link {{  Request::routeIs('course.add')  ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{ Request::routeIs('batches.manage') || Request::routeIs('batches.add')  ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::routeIs('batches.manage') || Request::routeIs('batches.add')  ? 'active' : '' }}">
              <i class="nav-icon fas fa-graduation-cap"></i>
              <p>
                Batches
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('batches.manage') }}" class="nav-link {{ Request::routeIs('batches.manage')  ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('batches.add') }}" class="nav-link {{  Request::routeIs('batches.add')  ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{ Request::routeIs('employee.manage') || Request::routeIs('employee.add')  ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::routeIs('employee.manage') || Request::routeIs('employee.add')  ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Employees
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('employee.manage') }}" class="nav-link {{ Request::routeIs('employee.manage') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('employee.add') }}" class="nav-link {{ Request::routeIs('employee.add')  ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('student.manage') }}" class="nav-link {{ Request::routeIs('student.manage')  ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>
                Students
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('exam.manage') }}" class="nav-link {{ Request::routeIs('exam.manage')  ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>
                Exams
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('attendance.students.manage') }}" class="nav-link {{ Request::routeIs('attendance.students.manage')  ? 'active' : '' }}">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Student Attendance
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('inquiries.manage') }}" class="nav-link {{ Request::routeIs('inquiries.manage') ? 'active' : '' }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Inquiries
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('student.exam.manage') }}" class="nav-link {{ Request::routeIs('student.exam.manage')  ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>
                Student Exams
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('site.settings') }}" class="nav-link {{ Request::routeIs('site.settings')  ? 'active' : '' }}">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Settings
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
