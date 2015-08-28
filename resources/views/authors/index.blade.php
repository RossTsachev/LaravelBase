@extends('app')

@section('navigation')
	@include('partials.navigation')
@stop

@section('content')

	<h1>Authors</h1>

	<table id = "authors-table" class = "table table-striped table-hover">
		<thead>
			<tr>
				<th>Id</th>
                <th>Name</th>
				<th>Books</th>
				<th></th>
			</tr>
		</thead>
	</table>	

@stop

@push('scripts')
    <script>
        $(function() {
            $('#authors-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: 'http://laravelbase.app/author/getAuthors',
                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'books',
                        name: 'books'
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