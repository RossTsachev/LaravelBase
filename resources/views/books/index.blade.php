@extends('app')

@section('navigation')
    @include('partials.navigation')
@stop

@section('content')
    <h1>Books</h1>

    <table
        id = "books-table"
        class = "table table-striped table-hover dt-responsive"
        width = "100%"
    >
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Authors</th>
                <th class = "dt-right"></th>
            </tr>
        </thead>
    </table>
@stop

@push('scripts')
    <script>
        $(function() {
            $('#books-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copyFlash',
                    'csvFlash',
                    'excelFlash',
                    'pdfFlash'
                ],
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: 'http://laravelbase.app/book/getBooks',
                columns: [
                    {
                        data: 'id',
                        name: 'books.id'
                    },
                    {
                        data: 'title',
                        name: 'books.title'
                    },
                    {
                        data: 'authors',
                        name: 'authors.authors',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        class: 'dt-right'
                    }
                ]
            });
        });
    </script>
@endpush