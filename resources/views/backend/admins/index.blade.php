@extends('backend.layouts.app')

@section('content')
    @section('header')
        <x-page-header header="Admins Table"/>
    @endsection

{{--    <style>--}}
{{--        .card{--}}
{{--            background-color: aliceblue;--}}
{{--        }--}}
{{--    </style>--}}
    <div class="container">
        <div class="mb-2 flex justify-end">
            <a href="{{ route('admins-management.create') }}" class="btn bg-gradient-gray">
                <i class="fas fa-plus-circle"></i> Create Admins
            </a>
        </div>
        <div class="card bg-gradient-gray">
            <div class="card-body">
                <table class="table table-bordered table-hover border-gray-200 Datatable" style="width:100%">
                    <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center no-order no-search">Profile</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center no-order no-search">Action</th>
                        <th class="text-center hidden no-order no-search">Updated at</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @section('script')
        <script>
            $(document).ready(function () {
                var table = $('.Datatable').DataTable({
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
                    ajax: '{!! route('admins-management.index') !!}',
                    columns: [
                        {data: 'id', name: 'id', class: 'text-center'},
                        {data: 'profile_img', name: 'profile_img'},
                        {data: 'name', name: 'name', class: 'text-center'},
                        {data: 'email', name: 'email', class: 'text-center'},
                        {data: 'action', name: 'action', class: 'text-center'},
                        {data: 'updated_at', name: 'updated_at', class: 'text-center'}
                    ],
                    order: [[5, "desc"]],
                });

                $(document).on('click', '.delete-btn', function (event) {
                    event.preventDefault();

                    var id = $(this).data('id');
                    swal({
                        title: "Are you sure?",
                        text: "You'll not be able to recover this file!",
                        icon: "warning",
                        buttons: {
                            cancel: true,
                            confirm: true,
                        },
                        dangerMode: true,
                    })
                        .then((willDelete) => {
                            if (willDelete) {
                                $.ajax({
                                    method: "DELETE",
                                    url: `/admins-management/${id}`,
                                }).done(function (response) {
                                    table.ajax.reload();
                                });
                            } else {
                                swal("Your file is safe!");
                            }
                        });
                });
            });


        </script>
    @endsection

@endsection
