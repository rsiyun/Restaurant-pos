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
    <table class="w-full text-left border-collapse rounded table-auto">
        <thead>
            <tr>
                <th
                    class="px-4 py-3 font-medium leading-4 tracking-wider text-black border bg-blue text-md text-2xluppercase border-slate-400 dark:bg-blue">
                    No
                </th>
                <th
                    class="px-4 py-3 font-medium leading-4 tracking-wider text-black border bg-blue text-md text-2xluppercase border-slate-400 dark:bg-blue">
                    Nama Pemilik
                </th>
                <th
                    class="px-4 py-3 font-medium leading-4 tracking-wider text-black bg-white border text-md text-2xluppercase border-slate-400 dark:bg-white">
                    Nama Toko</th>
                <th
                    class="px-4 py-3 font-medium leading-4 tracking-wider text-black bg-white border text-md text-2xluppercase border-slate-400 dark:bg-white">
                    Action
                </th>


            </tr>
        </thead>
        <tbody>
            @if (isset($shops))
                @foreach ($shops as $shop)
                    <tr class="border border-slate-400">
                        <td class="px-4 py-3">
                            {{ $loop->iteration ?? 0 }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $shop['ownerName'] ?? 'Unknown Status' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $shop['shopName'] ?? 'Unknown Status' }}
                        </td>

                        <td id="tableaction" class="w-[5rem] px-4 py-3">
                            <a href="{{ url('/dashboard/shop', [$shop['slug']]) }}"
                                class="px-4 py-2 text-white bg-green-500 rounded">Detail</a>
                        </td>

                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="px-4 py-3 text-center">No users found.</td>
                </tr>
            @endif
        </tbody>


    </table>
@endsection
