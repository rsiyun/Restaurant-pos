@extends('cpanel.layout.app')

@section('content')
    {{-- Judul Section --}}
    @include('components.texts.h1-dashboard', ['title' => 'User', 'subtitle' => 'Dashboard'])

    {{-- border separator --}}
    <div class="my-2 border-b border-gray-300"></div>

    {{-- Section Controls --}}
    <div class="flex flex-row justify-start gap-5 pb-5">
        <a href="{{ url('/dashboard/user/create') }}" class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
            Tambah User
        </a>
    </div>

    {{-- Table untuk informasi user --}}
    <div class="w-full gap-3">
        <x-tables.table>
            <table class="w-full text-left" id="table">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th class="font-medium capitalize ">
                            No
                        </th>
                        <th class="font-medium capitalize">
                            Nama
                        </th>
                        <th class="font-medium capitalize">
                            Email
                        </th>
                        <th class="font-medium capitalize">
                            Role
                        </th>
                        <th class="font-medium capitalize">
                            Status
                        </th>
                        <th class="font-medium capitalize">
                            Action
                        </th>


                    </tr>
                </thead>
                <tbody class="bg-white">
                    @if (isset($listUser))
                        @foreach ($listUser as $user)
                            <tr>
                                <td class="px-4 py-3">
                                    {{ $loop->iteration ?? 0 }}
                                </td>

                                <td class="px-4 py-3" id="name">
                                    {{ $user['name'] ?? 'Unknown Status' }}
                                </td>

                                <td class="px-4 py-3" id="email">
                                    {{ $user['email'] ?? 'Unknown Status' }}
                                </td>

                                <td class="px-4 py-3" id="role">
                                    {{ $user['role'] ?? 'Unknown Status' }}
                                </td>

                                <td id="status"
                                    class="px-4 py-3 {{ $user['isActive'] = 1 ? 'text-green-500' : 'bg-orange-500' }}">
                                    <span class="text-xl">
                                        {{ $user['isActive'] = 1 ? '✅' : '❌' }}
                                    </span>
                                </td>

                                <td class="px-4 py-3">
                                    <div class="p-1 flex justify-center">
                                        <a href="{{ url('/dashboard/user', [$user['slug']]) }}"
                                            class="px-4 py-2 text-white bg-green-500 rounded">Detail</a>
                                    </div>
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
        </x-tables.table>
    </div>
@endsection
