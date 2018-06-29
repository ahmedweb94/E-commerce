<header class="main-header">
  <!-- Logo -->
  <a href="index2.html" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>A</b>LT</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Admin</b>LTE</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    @include('admin.layouts.menu')
  </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ url('desgin/adminlte') }}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ admin()->user()->name }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class=" treeview {{ active_menu('')[0] }}">
        <a href="{{ aurl('') }}">
          <i class="fa fa-dashboard"></i> <span>{{ trans('admin.dashboard') }}</span>
          <span class="pull-right-container">
          </span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('setting') [1]}}">
          <li class=""><a href="{{ aurl('') }}"><i class="fa fa-home"></i>{{trans('admin.dashboard')}}</a></li>
          <li class=""><a href="{{ aurl('setting') }}"><i class="fa fa-cog"></i>{{trans('admin.setting')}}</a></li>
        </ul>
        <li class=" treeview {{ active_menu('admin')[0] }}">
          <a href="#">
            <i class="fa fa-users"></i> <span>{{  trans('admin.admin_admins') }} </span>
            <span class="pull-right-container">
            </span>
          </a>
          <ul class="treeview-menu" style="{{ active_menu('admin') [1]}}">
            <li class=""><a href="{{ aurl('admin') }}"><i class="fa fa-users-o"></i>{{trans('admin.admin_accont')}}</a></li>
          </ul>
          <li class=" treeview {{ active_menu('users')[0] }}">
            <a href="#">
              <i class="fa fa-users"></i> <span>{{  trans('admin.admin_users') }} </span>
              <span class="pull-right-container">
              </span>
            </a>
            <ul class="treeview-menu" style="{{ active_menu('users') [1]}}">
              <li class=""><a href="{{ aurl('users') }}"><i class="fa fa-users-o"></i><span>{{trans('admin.users_accont')}}</span></a>
                <li class=""><a href="{{ aurl('users') }}?level=user"><i class="fa fa-users-o"></i>{{trans('admin.user')}}</a></li>
                <li class=""><a href="{{ aurl('users') }}?level=vendor"><i class="fa fa-users-o"></i>{{trans('admin.vendor')}}</a></li>
                <li class=""><a href="{{ aurl('users') }}?level=company"><i class="fa fa-users-o"></i>{{trans('admin.company')}}</a></li>
              </ul>
              <li class=" treeview {{ active_menu('countries')[0] }}">
                <a href="#">
                  <i class="fa fa-flag"></i> <span>{{  trans('admin.country') }} </span>
                  <span class="pull-right-container">
                  </span>
                </a>
                <ul class="treeview-menu" style="{{ active_menu('countries') [1]}}">
                  <li class=""><a href="{{ aurl('countries') }}"><i class="fa fa-flag"></i><span>{{trans('admin.country')}}</span></a>
                    <li class=""><a href="{{ aurl('countries/create') }}"><i class="fa fa-plus"></i>{{trans('admin.add')}}</a></li>
                  </ul>
                  <li class=" treeview {{ active_menu('cities')[0] }}">
                <a href="#">
                  <i class="fa fa-flag"></i> <span>{{  trans('admin.city') }} </span>
                  <span class="pull-right-container">
                  </span>
                </a>
                <ul class="treeview-menu" style="{{ active_menu('cities') [1]}}">
                  <li class=""><a href="{{ aurl('cities') }}"><i class="fa fa-flag"></i><span>{{trans('admin.city')}}</span></a>
                    <li class=""><a href="{{ aurl('cities/create') }}"><i class="fa fa-plus"></i>{{trans('admin.add')}}</a></li>
                  </ul>
                  <li class=" treeview {{ active_menu('states')[0] }}">
                <a href="#">
                  <i class="fa fa-flag"></i> <span>{{  trans('admin.state') }} </span>
                  <span class="pull-right-container">
                  </span>
                </a>
                <ul class="treeview-menu" style="{{ active_menu('states') [1]}}">
                  <li class=""><a href="{{ aurl('states') }}"><i class="fa fa-flag"></i><span>{{trans('admin.state')}}</span></a>
                    <li class=""><a href="{{ aurl('states/create') }}"><i class="fa fa-plus"></i>{{trans('admin.add')}}</a></li>
                  </ul>
                  <li class=" treeview {{ active_menu('departments')[0] }}">
                <a href="#">
                  <i class="fa fa-list"></i> <span>{{  trans('admin.departments') }} </span>
                  <span class="pull-right-container">
                  </span>
                </a>
                <ul class="treeview-menu" style="{{ active_menu('departments') [1]}}">
                  <li class=""><a href="{{ aurl('departments') }}"><i class="fa fa-list"></i><span>{{trans('admin.departments')}}</span></a>
                    <li class=""><a href="{{ aurl('departments/create') }}"><i class="fa fa-plus"></i>{{trans('admin.add')}}</a></li>
                  </ul>
                  <li class=" treeview {{ active_menu('trademarks')[0] }}">
                <a href="#">
                  <i class="fa fa-cube"></i> <span>{{  trans('admin.trademarks') }} </span>
                  <span class="pull-right-container">
                  </span>
                </a>
                <ul class="treeview-menu" style="{{ active_menu('trademarks') [1]}}">
                  <li class=""><a href="{{ aurl('trademarks') }}"><i class="fa fa-cube"></i><span>{{trans('admin.trademarks')}}</span></a>
                    <li class=""><a href="{{ aurl('trademarks/create') }}"><i class="fa fa-plus"></i>{{trans('admin.add')}}</a></li>
                  </ul>
                </ul>
              </section>
              <!-- /.sidebar -->
            </aside>
