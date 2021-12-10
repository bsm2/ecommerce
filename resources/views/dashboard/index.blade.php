@include('dashboard.layouts.header')

<!-- Content Wrapper. Contains page content -->
<body class="hold-transition sidebar-mini layout-fixed ">
  <div class="wrapper">

    <!-- Preloader -->
    {{-- <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="{{ asset('dashboard_files/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
    </div>
    --}}

    @include('dashboard.layouts.nav')
    @include('dashboard.layouts.aside')
    
    <div class="content-wrapper ">
        <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">@lang('site.dashboard')</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">@lang('site.dashboard')</a></li>
                @yield('breadcumb')
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

        <!-- Main content -->
        <div class="container-fluid">
            <section class="content">
                @include('partials.session')
                @yield('content')
            <section >
        </div><!-- /.container-fluid -->
        <!-- /.content -->
    </div>
  </div>

  

  @include('dashboard.layouts.footer')
</body>
</html>


