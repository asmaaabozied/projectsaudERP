<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BY The Way | Dashboard</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/vendor/fontawesome-free/css/all.min.css">
    <!-- App CSS Files -->
    <link rel="stylesheet" href="/assets/vendor/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="/assets/vendor/datepicker/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/vendor/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="/assets/css/style.min.css">
    <!-- RTL CSS File -->
    <link rel="stylesheet" href="/assets/css/rtl.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.22/b-1.6.4/b-colvis-1.6.4/b-flash-1.6.4/b-html5-1.6.4/b-print-1.6.4/datatables.min.css"/>

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>


</head>
@yield('styles')
<style>
    .form-control {
        height: 35px !important;


    }

    #DataTables_Table_0_filter {
        float: left;
    }

    .buttons-excel {
        background-color: #0B90C4;
        margin: 5px;

    }

    .buttons-pdf {

        background-color: #8677A7;
        margin: 5px;
    }

    .buttons-copy {
        background-color: #9cc2cb;


        margin: 5px;


    }

    .buttons-print {

        background-color: darkred;


        margin: 5px;
    }

    .buttons-csv {

        background-color: orange;


        margin: 5px;
    }
</style>
<body class="hold-transition sidebar-mini sdasdas layout-fixed">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-xl navbar-light bg-primary">
        <!-- Navbar Links -->
        <ul class="navbar-nav" style="margin-right: 50px;">

            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                   class="nav-link dropdown-toggle"> <span class="hidden-xs" style="color: white">??????????????</span>
                </a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li><a class="dropdown-item" href="{{url('admin/catch_view')}}">?????? ?????? ?????? </a></li>
                    <li><a class="dropdown-item" href="{{url('admin/catch')}}"> ?????????? ?????? ?????? </a></li>
                    <li><a class="dropdown-item" href="{{url('admin/cashing_view')}}">?????? ?????? ?????? </a></li>
                    <li><a class="dropdown-item" href="{{url('admin/cashing')}}"> ?????????? ?????? ?????? </a></li>

                </ul>
            </li>

            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                   class="nav-link dropdown-toggle"> <span class="hidden-xs" style="color: white">????????????</span>
                </a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li><a class="dropdown-item" href="{{url('admin/daily')}}">???????? ??????????????
                        </a></li>
                    <li><a class="dropdown-item" href="{{url('admin/new')}}"> ?????????? ?????? ???????? </a></li>

                  <li ><a class="dropdown-item" href="{{url('admin/upload')}}">?????????? ???????? ?????????? </a></li>

                    <li><a class="dropdown-item" href="{{url('admin/statement')}}"> ?????? ???????? </a></li>
                    <li><a class="dropdown-item" href="{{url('admin/review')}}"> ?????????? ???????????????? </a></li>

                </ul>
            </li>
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                   class="nav-link dropdown-toggle"> <span class="hidden-xs" style="color: white">????????????????</span>
                </a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li><a class="dropdown-item" href="{{url('admin/purchase')}}">???????????? ????????????
                        </a></li>
                    <li><a class="dropdown-item" href="{{url('admin/purchase/create')}}"> ?????????? ???????????? ???????? </a></li>
                    <li><a class="dropdown-item" href="{{url('admin/view/purchaseReturn')}}">???????????? ?????????? ????????????</a>
                    </li>
                    <li><a class="dropdown-item" href="{{url('admin/purchaseReturn')}}"> ?????????? ???????????? ?????????? ???????? </a>
                    </li>
                    <li><a class="dropdown-item" href="{{url('admin/view/sell')}}">???????????? ?????? </a></li>
                    <li><a class="dropdown-item" href="{{url('admin/sell')}}"> ?????????? ???????????? ?????? </a></li>

                    <li><a class="dropdown-item" href="{{url('admin/view/sellReturn')}}">???????????? ?????????? ?????? </a></li>
                    <li><a class="dropdown-item" href="{{url('admin/sellReturn')}}"> ?????????? ???????????? ?????????? ?????? </a></li>

                </ul>
            </li>
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                   class="nav-link dropdown-toggle"> <span class="hidden-xs" style="color: white">????????????????</span>
                </a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li><a class="dropdown-item" href="{{url('admin/employees')}}">?????????? ????????????????
                        </a></li>
                    <li><a class="dropdown-item" href="{{url('admin/employees/create')}}"> ?????????? ???????? </a></li>
                    <li><a class="dropdown-item" href="{{url('admin/attendance')}}">?????????? ????????????</a></li>
                    <li><a class="dropdown-item" href="{{url('admin/createAttendance')}}"> ?????????? ???????? </a></li>
                    <li><a class="dropdown-item" href="{{url('admin/holiday')}}">?????????? ???????????????? </a></li>
                    <li><a class="dropdown-item" href="{{url('admin/createHoliday')}}"> ?????????? ?????????? </a></li>

                    <li><a class="dropdown-item" href="{{url('admin/count')}}">?????????? ?????????? </a></li>
                    <li><a class="dropdown-item" href="{{url('admin/createCount')}}"> ?????????? ???????? </a></li>

                    <li><a class="dropdown-item" href="{{url('admin/warning')}}">?????????? ?????????????????? </a></li>
                    <li><a class="dropdown-item" href="{{url('admin/createWarning')}}"> ?????????? ?????????? </a></li>

                    <li><a class="dropdown-item" href="{{url('admin/additional')}}">?????????? ?????????????? </a></li>
                    <li><a class="dropdown-item" href="{{url('admin/createadditional')}}"> ?????????? ?????????? </a></li>

                </ul>
            </li>
            <li class="nav-item dropdown">
                <a type="button" class="btn btn-primary fBtn" href="{{route('admin.page')}}"> <span
                        style="color: white">?????????? ????????????</span>
                </a>
            </li>


        </ul>


        <!-- End Navbar Links -->
        <!-- Search Form -->

        <!-- End Search Form -->
        <!-- User Account -->
        <ul class="navbar-nav ml-auto">
            <!-- User Profile -->
            <li class="nav-item dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="/assets/img/user1-128x128.jpg" class="user-image" alt="User Image">
                    <span class="hidden-xs">?????? ????????????????</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
<span class="dropdown-item dropdown-header user-header bg-blue"><img src="/assets/img/user1-128x128.jpg"
                                                                     class="img-circle" alt="User Image">
<p>
User Name - Web Developer
<small>Member since Nov. 2021</small>
</p></span>
                    <a href="#" class="dropdown-item"><i class="fas fa-user mr-2"></i>?????????? ????????????</a>
                    <a href="#" class="dropdown-item"><i class="fas fa-cogs mr-2"></i>??????????????????</a>
                    <div class="dropdown-divider"></div>
                    <a href="/logout" class="dropdown-item"><i class="fas fa-sign-out-alt mr-2"></i>????????</a>
                </div>
            </li>
            <!-- End User Profile -->
        </ul>
        <!-- End User Account -->
    </nav>
    <!-- End Navbar -->
    <center>
        <div style="text-align: center">
            @include('flash::message')
        </div>
    </center>
    <!-- Main <Sidebar -->
    <aside class="main-sidebar sidebar-light-primary py-4 elevation-4">
        <!-- Brand Logo -->
        <a href="index.html" class="brand-link text-center"><img src="/assets/img/by-the-way-logo.png"
                                                                 alt="By The Way Logo" class="brand-image"></a>
        <!-- End Brand Logo -->
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar User Panel -->

            <!-- End Sidebar User Panel -->
            <!-- Sidebar Menu -->
            <nav class="mt-2">


                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">


                    <li class="nav-item ">
                        <a href="#" class="nav-link"><i class="nav-icon fas fa-shopping-cart"></i>
                            <p>???????????????? ????????????????<i class="fas fa-angle-left right"></i></p></a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a class="nav-link" href="{{url('admin/main')}}"><i
                                        class="far fa-circle nav-icon"></i>
                                    <p>?????????? ???????????????? ????????????????</p></a></li>
                            <li class="nav-item"><a class="nav-link" href="{{url('admin/main/create')}}"><i
                                        class="far fa-circle nav-icon"></i>
                                    <p> ?????????? ???????? </p></a></li>
                        </ul>
                    </li>
                    <li class="nav-item ">
                        <a href="#" class="nav-link"><i class="nav-icon fas fa-shopping-cart"></i>
                            <p>???????????????? <i class="fas fa-angle-left right"></i></p></a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a class="nav-link" href="{{url('admin/account')}}"><i
                                        class="far fa-circle nav-icon"></i>
                                    <p> ?????????? ????????????????</p></a></li>
                            <li class="nav-item"><a class="nav-link" href="{{url('admin/account/create')}}"><i
                                        class="far fa-circle nav-icon"></i>
                                    <p>?????????? ????????</p></a></li>
                        </ul>
                    </li>
                    <li class="nav-item ">
                        <a href="#" class="nav-link"><i class="nav-icon fas fa-shopping-cart"></i>
                            <p>?????????????? <i class="fas fa-angle-left right"></i></p></a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a class="nav-link" href="{{url('admin/store')}}"><i
                                        class="far fa-circle nav-icon"></i>
                                    <p> ?????????? ??????????????</p></a></li>
                            <li class="nav-item"><a class="nav-link" href="{{url('admin/store/create')}}"><i
                                        class="far fa-circle nav-icon"></i>
                                    <p>?????????? ????????</p></a></li>
                        </ul>
                    </li>
                    <li class="nav-item ">
                        <a href="#" class="nav-link"><i class="nav-icon fas fa-shopping-cart"></i>
                            <p>???????????????? <i class="fas fa-angle-left right"></i></p></a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a class="nav-link" href="{{url('admin/supplier')}}"><i
                                        class="far fa-circle nav-icon"></i>
                                    <p> ?????????? ????????????????</p></a></li>
                            <li class="nav-item"><a class="nav-link" href="{{url('admin/supplier/create')}}"><i
                                        class="far fa-circle nav-icon"></i>
                                    <p>?????????? ????????</p></a></li>
                        </ul>
                    </li>
                    <li class="nav-item ">
                        <a href="#" class="nav-link"><i class="nav-icon fas fa-shopping-cart"></i>
                            <p>?????????????????? <i class="fas fa-angle-left right"></i></p></a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a class="nav-link" href="{{url('admin/classification')}}"><i
                                        class="far fa-circle nav-icon"></i>
                                    <p> ?????????? ??????????????????</p></a></li>
                            <li class="nav-item"><a class="nav-link" href="{{url('admin/classification/create')}}"><i
                                        class="far fa-circle nav-icon"></i>
                                    <p>?????????? ??????????</p></a></li>
                        </ul>
                    </li>
                    <li class="nav-item ">
                        <a href="#" class="nav-link"><i class="nav-icon fas fa-shopping-cart"></i>
                            <p>???????????????? <i class="fas fa-angle-left right"></i></p></a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a class="nav-link" href="{{url('admin/products')}}"><i
                                        class="far fa-circle nav-icon"></i>
                                    <p> ?????????? ????????????????</p></a></li>
                            <li class="nav-item"><a class="nav-link" href="{{url('admin/products/create')}}"><i
                                        class="far fa-circle nav-icon"></i>
                                    <p>?????????? ????????</p></a></li>
                            <li class="nav-item"><a class="nav-link" href="{{url('admin/upload/products')}}"><i
                                        class="far fa-circle nav-icon"></i>
                                    <p>?????????? ???????????? ??????????</p></a></li>

                        </ul>
                    </li>
                    <li class="nav-item ">
                        <a href="#" class="nav-link"><i class="nav-icon fas fa-shopping-cart"></i>
                            <p>???????????????????? <i class="fas fa-angle-left right"></i></p></a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a class="nav-link" href="{{url('admin/users')}}"><i
                                        class="far fa-circle nav-icon"></i>
                                    <p> ?????????? ????????????????????</p></a></li>
                            <li class="nav-item"><a class="nav-link" href="{{url('admin/users/create')}}"><i
                                        class="far fa-circle nav-icon"></i>
                                    <p>?????????? ????????????</p></a></li>
                        </ul>
                    </li>
                    <li class="nav-item ">
                        <a href="#" class="nav-link"><i class="nav-icon fas fa-shopping-cart"></i>
                            <p>?????????????? ?????????????? <i class="fas fa-angle-left right"></i></p></a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a class="nav-link" href="{{url('admin/years')}}"><i
                                        class="far fa-circle nav-icon"></i>
                                    <p> ?????????? ?????????????? ?????????????? </p></a></li>
                            <li class="nav-item"><a class="nav-link" href="{{url('admin/years/create')}}"><i
                                        class="far fa-circle nav-icon"></i>
                                    <p>?????????? ?????? ??????????</p></a></li>
                        </ul>
                    </li>
                    <li class="nav-item ">
                        <a href="#" class="nav-link"><i class="nav-icon fas fa-shopping-cart"></i>
                            <p>???????????? <i class="fas fa-angle-left right"></i></p></a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a class="nav-link" href="{{url('admin/branches')}}"><i
                                        class="far fa-circle nav-icon"></i>
                                    <p> ?????????? ???????????? </p></a></li>
                            <li class="nav-item"><a class="nav-link" href="{{url('admin/branches/create')}}"><i
                                        class="far fa-circle nav-icon"></i>
                                    <p>?????????? ??????</p></a></li>
                        </ul>
                    </li>
                    <li class="nav-item ">
                        <a href="#" class="nav-link"><i class="nav-icon fas fa-shopping-cart"></i>
                            <p>?????????????????? <i class="fas fa-angle-left right"></i></p></a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a class="nav-link" href="{{url('admin/revenues')}}"><i
                                        class="far fa-circle nav-icon"></i>
                                    <p> ?????????? ?????????????????? </p></a></li>
                            <li class="nav-item"><a class="nav-link" href="{{url('admin/revenues/create')}}"><i
                                        class="far fa-circle nav-icon"></i>
                                    <p>?????????? ??????????</p></a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a href="{{url('admin/report')}}" class="nav-link"><i
                                class="nav-icon fas fa-file-alt"></i>
                            <p>??????????</p></a></li>

                    <li class="nav-item"><a href="{{url('admin/catcart')}}" class="nav-link"><i
                                class="nav-icon fas fa-file-alt"></i>
                            <p>???????? ??????????</p></a></li>

                    <li class="nav-item"><a href="{{url('admin/catcartattribute')}}" class="nav-link"><i
                                class="nav-icon fas fa-file-alt"></i>
                            <p> ???????????? ?????????????? ??????????????</p></a></li>

                    <li class="nav-item"><a href="{{url('admin/stores')}}" class="nav-link"><i
                                class="nav-icon fas fa-file-alt"></i>
                            <p> ?????? ?????????? ?????????? ??????????????</p></a></li>


                    <li class="nav-item"><a href="{{url('admin/marpurchases')}}" class="nav-link"><i
                                class="nav-icon fas fa-file-alt"></i>
                            <p> ???????????? ?????????? ??????????????????</p></a></li>


                    <li class="nav-item"><a href="{{url('admin/Categoriesstore')}}" class="nav-link"><i
                                class="nav-icon fas fa-file-alt"></i>
                            <p> ???????????? ?????????? ???? ????????</p></a></li>

                </ul>
            </nav>
            <!-- End Sidebar Menu -->
        </div>
        <!-- End Sidebar -->
    </aside>
    <!-- End Main Sidebar -->
    <!-- Content Wrapper -->
@yield('content')


<!-- End Content Wrapper -->
    <!-- Main Footer -->
    <footer class="main-footer bg-primary">
        <strong>???????? ???????????? ???????????? &copy; 2021 <a href="index.html">By The Way</a>.</strong>
    </footer>
    <!-- End Main Footer -->
</div>
<!-- App JS Files -->
<script src="/assets/vendor/jquery/jquery.min.js"></script>
<script src="/assets/vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/vendor/datepicker/bootstrap-datepicker.min.js"></script>
<script src="/assets/vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- Main JS File -->
<script src="/assets/js/main.js"></script>
<script src="/assets/js/custom.js"></script>

<script src="/assets/js/jquery.print.min.js"></script>
<script src="/assets/js/jquery.print-custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"></script>
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css"
      integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous"/>


<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.22/b-1.6.4/b-colvis-1.6.4/b-flash-1.6.4/b-html5-1.6.4/b-print-1.6.4/datatables.min.js"></script>

<script>
    $(document).ready(function () {
        $('.datatable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'copy', 'print', 'csv'
            ]
        });
    });
    // $(document).ready(function () {
    //     $('select').selectize({
    //         sortField: 'text'
    //     });
    // });


    $(document).ready(function () {
        $('#table').dataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'copy', 'print', 'csv'
            ],
            "language": {
                'search': "Search",


                "paginate": {

                    "previous": "previous",
                    "next": "next",
                    'Show': 'dddd',


                }

            }

        });
    });
</script>


</body>
</html>
