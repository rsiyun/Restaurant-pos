@extends("cpanel.layout.app")
@section("content")

    @foreach ($data as $order)
        <div class="flex gap-4">
            <p>{{$order["slug"]}}</p>
            <p>{{$order["totalOrder"]}}</p>
        </div>
    @endforeach

@endsection
