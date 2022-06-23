<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('backend/logo/dream-pay-logo.png')}}"/>--}}
    <link rel="icon" type="image/png" href="{{asset('backend/logo/dream-pay-logo.png')}}"/>

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"/>
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Nucleo Icons -->
    <link href="{{asset('backend/css/nucleo-icons.css')}}" rel="stylesheet"/>
    <link href="{{asset('backend/css/nucleo-svg.css')}}" rel="stylesheet"/>
    <!-- Popper -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <!-- Main Styling -->
    <link href="{{asset('backend/css/styles.css')}}" rel="stylesheet"/>

    {{--style--}}
    {{--    <link rel="stylesheet" href="{{ asset('css/style.css') }}">--}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    {{--datatable--}}
    {{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
</head>

<body class="m-0 font-sans antialiased font-normal text-size-base leading-default bg-white text-slate-500">
<!-- sidenav  -->
<x-side-bar></x-side-bar>
<!-- end sidenav -->

<main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">
    <!-- Navbar -->
    <x-top-bar header="Admin Dashboard"/>
    @yield('header')
    <!-- end Navbar -->

    <!-- content -->
    <div class="w-full px-6 py-6 mx-auto">
        <!-- row 1 -->
        <div class="flex flex-wrap -mx-3">
            <!-- card1 -->
            @yield('content')
        </div>
    </div>
</main>


<!-- plugin for charts  -->
<script src="{{asset('backend/js/plugins/chartjs.min.js')}}" async></script>
<!-- plugin for scrollbar  -->
<script src="{{asset('backend/js/plugins/perfect-scrollbar.min.js')}}" async></script>
<!-- github button -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- main script file  -->
<script src="{{asset('backend/js/soft-ui-dashboard-tailwind.js')}}" async></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
{{--datatable--}}
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
{{--sweetalert1--}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script>
    $(function ($) {
        let token = document.head.querySelector('meta[name="csrf-token"]');
        if (token) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token.content
                }
            });
        } else {
            console.log('error');
        }

            @if(session('created')){
            swal("Successfully created!", "You clicked the button!", "success");
        }
            @endif

            @if(session('updated')){
            swal("Successfully updated!", "You clicked the button!", "success");
        }
        @endif
        //datatable defaults
        $.extend(true, $.fn.dataTable.defaults, {
            responsive: true,
            processing: true,
            serverSide: true,
            columnDefs: [
                {
                    "targets": "hidden",
                    "visible": false,
                },
                {
                    "targets": "no-order",
                    "orderable": false,
                },
                {
                    "targets": "no-search",
                    "searchable": false,
                }
            ],
            language: {
                "paginate": {
                    "next": "<i class='fa-solid fa-angle-right'></i>",
                    "previous": "<i class='fa-solid fa-angle-left'></i>"
                },
            },
        });
    });
</script>

@yield('script')
</body>


</html>
