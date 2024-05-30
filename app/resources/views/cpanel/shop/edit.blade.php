@extends('cpanel.layout.app')

@section('content')
    <form action="{{ url('dashboard/shop/'. $slug) }}" method="POST">
        @csrf
        @method("PUT")
        <div>
            <label for="ownerName">Buyer Name:</label>
            <input type="text" id="ownerName" name="ownerName" required value="{{$ownerName}}">
        </div>
        <div>
            <label for="shopName">Buyer Name:</label>
            <input type="text" id="shopName" name="shopName" required value="{{$shopName}}">
        </div>

        <div>
            <button type="submit">Submit</button>
        </div>
    </form>
@endsection
