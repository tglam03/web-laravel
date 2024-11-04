@extends('admin.master')

@push('css')
    <link
        href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.1.8/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/date-1.5.4/fc-5.0.4/fh-4.0.1/r-3.0.3/rg-1.5.0/sc-2.4.3/sb-1.8.1/sl-2.1.0/datatables.min.css"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endpush

@section('content')
    <div class="card">


        @if ($errors->any())
            <div class="card-header">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->get('name') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <div class="card-body">

            <a class="btn btn-info mb-2" href="{{ route('courses.create') }}">Them moi</a>

            <div class="form-group">
                <select class="js-data-example-ajax" id="select-name"></select>
            </div>

            <table class="table table-striped" id="table-index">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
                </thead>

            </table>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.1.8/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/date-1.5.4/fc-5.0.4/fh-4.0.1/r-3.0.3/rg-1.5.0/sc-2.4.3/sb-1.8.1/sl-2.1.0/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function () {
            $('#table-index').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('courses.api') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'}
                ]
            });
        });

        $(".select-name").select2({
            ajax: {
                url: "{{ Route('courses.api.name') }}",
                dataType: 'json',
                data: function (params) {
                    return {
                        q: params.term, // search term
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: data.items,
                    };
                },
            },
            placeholder: 'Search for a repository',

        });
        var buttonComon = {
            exportOptions: {
                columns: ':visible :not(.not-export)'
            }
        }






    </script>

@endpush
