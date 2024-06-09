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
        <table id="table" class="w-full text-left border-collapse rounded table-auto">
            <thead>
                <tr>
                    <th
                        class="font-medium text-black border bg-white capitalize border-slate-400">
                        No
                    </th>
                    <th
                        class="font-medium text-black border bg-white capitalize border-slate-400">
                        Nama Pemilik
                    </th>
                    <th
                        class="font-medium text-black border bg-white capitalize border-slate-400">
                        Nama Toko</th>
                    <th
                        class="font-medium text-black border bg-white capitalize border-slate-400">
                        Action
                    </th>


                </tr>
            </thead>
            <tbody class="bg-white">
                    @foreach ($shops as $shop)
                        <tr class="border border-slate-400">
                            <td class="px-4 py-3 border border-slate-400">
                                {{ $loop->iteration ?? 0 }}
                            </td>

                            <td class="px-4 py-3 border border-slate-400">
                                {{ $shop['ownerName'] ?? 'Unknown Status' }}
                            </td>

                            <td class="px-4 py-3 border border-slate-400">
                                {{ $shop['shopName'] ?? 'Unknown Status' }}
                            </td>

                            <td class="px-4 py-3 border border-slate-400">
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
