@push('styles')
    <link href="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-2.0.5/datatables.min.css" rel="stylesheet">

    <style>
        /* name:table_length */
        /* class="w-12 gap-4 pr-4 mr-6" */

        select {
            padding-right: 20px;
            width: 4rem;
            margin-right: 1.5rem;
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
