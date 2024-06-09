@push('styles')
    <link href="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-2.0.5/datatables.min.css" rel="stylesheet">

    <style>
        select {
            padding-right: 20px;
            width: 4rem;
            margin-right: 1.5rem;
        }
        div.dt-container .dt-input{
            background-color: white;
        }
        div.dt-container .dt-search input{
            background: white
        }
        table.dataTable th.dt-type-numeric, table.dataTable th.dt-type-date, table.dataTable td.dt-type-numeric, table.dataTable td.dt-type-date{
            text-align: left;
        }
        div.dt-container.dt-empty-footer tbody>tr:last-child>*{
            border-bottom: none;
        }
        table.dataTable {
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #dee2e6;
        }
        table.dataTable tbody td {
            border-bottom: 1px solid #dee2e6;
            border-right: 1px solid #dee2e6;
        }
        table.dataTable tbody tr:last-child td {
            border-bottom: none;
        }
    </style>
@endpush

{{ $slot }}

@push('scripts')
    <script src="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-2.0.5/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable(

            );
        });
    </script>
@endpush
