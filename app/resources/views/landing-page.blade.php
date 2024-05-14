@extends('layouts.app')

@section('slot')
    <div class="px-4 mx-auto space-y-3 max-w-7xl sm:px-6 lg:px-8">

        <div class="flex items-center justify-center h-screen mt-4 bg-red-700 rounded-xl">
            <h1 class="text-white text-9xl">
                Landing Page
            </h1>
        </div>

        <div class="h-[400px] border-red-700 border-4 mt-4 flex justify-center items-center rounded-xl">
            {{-- <div class="text-4xl">
                Content
            </div> --}}

            {{-- card content --}}
            @include('components.small-card-content', [
                'name' => 'Nama Toko',
                'content' => 'Isi Konten'
            ])


        </div>
    @endsection
