@extends('cpanel.layout.app')

@section('content')
    {{-- ! HELP! ini harusnya kalo pakai breeze tinggal panggil auth()->user --}}
    <div class="pb-8">
        <h2 class="text-2xl font-bold text-right text-blue-600">
            Hai, {{ $users['name'] ?? 'Developer' }}!
        </h2>
    </div>

    {{-- Judul Section --}}
    <h1 class="flex-col mt-6 text-3xl text-blue-600 font-extralight">
        Dashboard
        <h2 class="text-2xl font-bold text-slate-700">
            User
        </h2>
    </h1>

    {{-- border separator --}}
    <div class="my-4 border-b border-gray-300"></div>

    {{-- Section Controls --}}
    <div class="flex flex-row justify-start gap-5 pb-5">
        <select name="role" id="role"
            class="px-4 py-2 text-black border-blue-500 rounded-md shadow-sm appearance-none min-w-2 focus:outline-none focus:ring-1 w-[12rem]">
            <option value="" disabled selected>Sortir berdasarkan</option>
            <option value="admin">Nama</option>
            <option value="user">Email</option>
            <option value="status">Status</option>
        </select>

        <a href="{{ url('/dashboard/user/create') }}" class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
            Tambah User
        </a>
    </div>

    {{-- Table untuk informasi user --}}
    <table class="w-full text-left border-collapse rounded table-auto">
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
            @if (isset($users))
                @foreach ($users as $user)
                    <tr class="border border-slate-400">
                        <td class="px-4 py-3">
                            {{ $loop->iteration ?? 0 }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $user['name'] ?? 'Unknown Status' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $user['email'] ?? 'Unknown Status' }}
                        </td>

                        <td class="px-4 py-3">
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

                                <form action="{{ url('/dashboard/user/' . $user['slug']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 text-white bg-red-600 border rounded"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">🪣</button>
                                </form>
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
@endsection
