@extends('cpanel.layout.app')


@section('content')
    @include('components.texts.h1-dashboard', [
        'title' => 'Toko',
        'subtitle' => 'Dashboard',
    ])

    <div class="my-2 border-b border-gray-300"></div>

    {{-- TAMBAH TOKO --}}
    <div class="flex flex-row justify-start gap-5 pb-5">
        <a href="{{ url('/dashboard/shop/create') }}" class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
            Tambah Toko
        </a>
    </div>

    {{-- TABLE TOKO --}}
    <x-tables.table>
        <table id="table" class="w-full text-left">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="font-medium capitalize">
                        No
                    </th>
                    <th class="font-medium capitalize">
                        Nama Pemilik
                    </th>
                    <th class="font-medium capitalize">
                        Nama Toko
                    </th>
                    <th class="font-medium capitalize">
                        Action
                    </th>


                </tr>
            </thead>
            <tbody class="bg-white">
                    @foreach ($shops as $shop)
                        <tr>
                            <td class="px-4 py-3">
                                {{ $loop->iteration ?? 0 }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $shop['ownerName'] ?? 'Unknown Status' }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $shop['shopName'] ?? 'Unknown Status' }}
                            </td>

                            <td class="px-4 py-3">
                                <div class="p-1 flex justify-center">
                                <a href="{{ url('/dashboard/shop', [$shop['slug']]) }}"
                                    class="px-4 py-2 text-white bg-green-500 rounded">Detail</a>
                                </div>
                            </td>

                        </tr>
                    @endforeach
            </tbody>


        </table>
    </x-tables.table>

@endsection
