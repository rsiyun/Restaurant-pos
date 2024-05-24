@extends('cpanel.layout.app')

@section('content')
    {{-- @include('components.receipts.receipts', [
        'type' => 'success',
        'message' => 'This is a success message',
    ]) --}}

    {{-- @include('components.receipts.receipts', [
        'type' => 'failed',
        'message' => 'This is a failed message',
    ]) --}}

    <div class="pb-8">
        <h2 class="text-2xl font-bold text-right text-blue-600 border">
            Hai, {{ $name ?? 'Developer' }}!
        </h2>
    </div>

    {{-- Judul Section --}}
    <h1 class="mt-6 text-3xl font-bold text-blue-600">
        Dashboard - User
    </h1>

    {{-- border separator --}}
    <div class="my-4 border-b border-gray-300"></div>

    <div class="flex flex-row justify-end">
        <a href="{{ url('/dashboard/user/create') }}" class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
            Tambah User
        </a>
    </div>
    {{-- Table untuk informasi user --}}
    <table class="w-full text-left border-collapse rounded table-auto">
        <thead>
            <t>
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
                    Status</th>
            </t>
        </thead>
        <tbody>
            @if (isset($users))
                @foreach ($users as $user)
                    <tr class="border border-slate-400">
                        <td class="px-4 py-3">
                            {{ $user['name'] ?? 'Unknown Status' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $user['email'] ?? 'Unknown Status' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $user['role'] ?? 'Unknown Status' }}
                        </td>

                        <td id="status" class="px-4 py-3">
                            {{ $user['role'] ?? 'Unknown Status' }}
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
