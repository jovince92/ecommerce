<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('adm/imgs/favicon.ico') }}">

    <title>Admin - Dashboard</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
	<!-- Vendors Style-->
	<link rel="stylesheet" href="{{ asset('adm/css/vendors_css.css') }}">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="{{ asset('adm/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('adm/css/skin_color.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    
  </head>

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">
	
<div class="wrapper">

    @include('admin.layouts.header')
  

    @include('admin.layouts.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    @include('admin.layouts.footer')

	<script src="{{ asset('adm/js/template.js') }}"></script>
	<script src="{{ asset('adm/js/pages/dashboard.js') }}"></script>
	<script src="{{ asset('adm/js/vendors.min.js') }}"></script>
    
    
    
    <script src="{{ asset('assets/icons/feather-icons/feather.min.js') }}"></script>	
	<script src="{{ asset('assets/vendor_components/easypiechart/dist/jquery.easypiechart.js') }}"></script>
	<script src="{{ asset('assets/vendor_components/apexcharts-bundle/irregular-data-series.js') }}"></script>
	<script src="{{ asset('assets/vendor_components/apexcharts-bundle/dist/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js') }}"></script>

    <script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('adm/js/pages/data-table.js') }}"></script>

    <script src="{{ asset('assets/vendor_components/ckeditor/ckeditor.js') }}"></script>
	<script src="{{ asset('assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js') }}"></script>
	<script src="{{ asset('adm/js/pages/editor.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="https:///cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	
    <script type="text/javascript">

        $(document).on('click','#delete',function(e){
                     
            //console.log('TEST');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = $(this).attr("href");
                    Swal.fire(
                    'Deleted!',
                    'DONE!.',
                    'success'
                    )
                }
                })            
        });
    </script>


    <script type="text/javascript">

        $(document).on('click','#orderUpdate',function(e){
            e.preventDefault();
                    
            //console.log('TEST');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = $(this).attr("href");
                    Swal.fire(
                    'Status Changed!',
                    'DONE!.',
                    'success'
                    )
                }
                })            
        });
    </script>
	
    <script>
        @if (Session::has('message'))
            var mgs= "{{ Session::get('alert-type','info') }}"    
            switch(mgs){
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    console.log(" {{ Session::get('message') }} ");
                    break;
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>
	
</body>
</html>
