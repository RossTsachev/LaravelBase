@extends('app')

@section('navigation')
    @include('partials.navigation')
@stop

@section('content')
    <h1>Books</h1>

    <table id = "books-table" class = "table table-striped table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th class = "dt-right"></th>
            </tr>
        </thead>
    </table>
@stop

@push('scripts')
    <script>
        $(function() {
            $('#books-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: 'http://laravelbase.app/book/getBooks',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, class: 'dt-right'}
                ]
            });
        });
    </script>
@endpush