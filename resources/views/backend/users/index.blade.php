@extends('backend.layouts.app')

@section('content')
    @section('header')
        <x-page-header header="Users Table"/>
    @endsection

    <div class="container">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-hover border-gray-200 Datatable" style="width:100%">
                    <thead>
                    <tr>
                        <th class="text-center no-order">ID</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Phone</th>
                        <th class="text-center">Nrc</th>
                        <th class="text-center">Levels</th>
                        <th class="text-center">Balance</th>
                        <th class="text-center">Is_frozen?</th>
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
                    ajax: '{!! route('users-management.index') !!}',
                    columns: [
                        {data: 'id', name: 'id', class: 'text-center'},
                        {data: 'name', name: 'name', class: 'text-center'},
                        {data: 'email', name: 'email', class: 'text-center'},
                        {data: 'mobile_phone', name: 'mobile_phone', class: 'text-center'},
                        {data: 'nrc', name: 'nrc', class: 'text-center'},
                        {data: 'levels', name: 'levels', class: 'text-center'},
                        {data: 'balance', name: 'balance', class: 'text-center'},
                        {data: 'is_frozen', name: 'is_frozen', class: 'text-center'},
                        {data: 'action', name: 'action', class: 'text-center'},
                        {data: 'updated_at', name: 'updated_at', class: 'text-center'}
                    ],
                    order: [[9, "desc"]],
                });
                $(document).on('click', '#delete', function (event) {
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
                                    url: `/users-management/${id}`,
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
