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
            <table class="text-left border-collapse rounded table-auto " id="table">
                <thead>
                    <tr>
                        <th
                            class="px-4 py-3 font-medium leading-4 tracking-wider text-black border bg-blue text-md text-2xluppercase border-slate-400 dark:bg-blue">
                            No
                        </th>
                        <th
                            class="px-4 py-3 font-medium leading-4 tracking-wider text-black border bg-blue text-md text-2xluppercase border-slate-400 dark:bg-blue">
                            Nama
                        </th>
                        <th
                            class="px-4 py-3 font-medium leading-4 tracking-wider text-black bg-white border text-md text-2xluppercase border-slate-400 dark:bg-white">
                            Email</th>
                        <th
                            class="px-4 py-3 font-medium leading-4 tracking-wider text-black bg-white border text-md text-2xluppercase border-slate-400 dark:bg-white">
                            Role</th>
                        <th
                            class="px-4 py-3 font-medium leading-4 tracking-wider text-black bg-white border text-md text-2xluppercase border-slate-400 dark:bg-white">
                            Status
                        </th>
                        <th
                            class="px-4 py-3 font-medium leading-4 tracking-wider text-black bg-white border text-md text-2xluppercase border-slate-400 dark:bg-white">
                            Action
                        </th>


                    </tr>
                </thead>
                <tbody>
                    @if (isset($listUser))
                        @foreach ($listUser as $user)
                            <tr class="border border-slate-400">
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
                                    class="w-[3rem] px-4 py-3 text-center {{ $user['isActive'] = 1 ? 'text-green-500' : 'bg-orange-500' }}">
                                    <span class="text-xl">
                                        {{ $user['isActive'] = 1 ? '✅' : '❌' }}
                                    </span>
                                </td>


                                <td id="tableaction" class="w-[5rem] px-4 py-3">
                                    <div class="flex gap-4">
                                        <a href="{{ url('/dashboard/user') }}{{ '/' . $user['slug'] . '/edit' }}"
                                            class="px-4 py-2 text-white border rounded">✏️</a>
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
