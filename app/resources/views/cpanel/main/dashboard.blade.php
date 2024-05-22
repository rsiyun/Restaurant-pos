@extends('cpanel.layout.app')
@section('content')
    <div>
        Main
    </div>

    @include('components.receipts.receipts', [
        'type' => 'success',
        'message' => 'This is a success message',
    ])

    {{-- @include('components.receipts.receipts', [
        'type' => 'failed',
        'message' => 'This is a failed message',
    ]) --}}
@endsection
