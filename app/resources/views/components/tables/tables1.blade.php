{{-- resources/views/components/user-table.blade.php --}}
<table class="w-full text-left border-collapse rounded table-auto">
    <thead>
        <tr>
            @php
                $headers = ["No", "Nama", "Email", "Role", "Status", "Action"];
            @endphp
            @foreach ($headers as $header)
                <th class="px-4 py-3 font-medium leading-4 tracking-wider text-black border bg-blue text-md text-2xl uppercase border-slate-400 dark:bg-blue">
                    {{ $header }}
                </th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @forelse ($users as $user)
            <tr class="border border-slate-400">
                <td class="px-4 py-3">
                    {{ $loop->iteration }}
                </td>

                <td class="px-4 py-3">
                    {{ $user['name'] ?? 'Unknown' }}
                </td>

                <td class="px-4 py-3">
                    {{ $user['email'] ?? 'Unknown' }}
                </td>

                <td class="px-4 py-3">
                    {{ $user['role'] ?? 'Unknown' }}
                </td>

                <td class="w-[3rem] px-4 py-3 text-center {{ $user['isActive'] == 1 ? 'text-green-500' : 'bg-orange-500' }}">
                    <span class="text-xl">
                        {{ $user['isActive'] == 1 ? '✅' : '❌' }}
                    </span>
                </td>

                <td class="w-[5rem] px-4 py-3">
                    <div class="flex gap-4">
                        <a href="{{ url('/dashboard/user/' . $user['slug'] . '/edit') }}" class="px-4 py-2 text-white border rounded">✏️</a>

                        <form action="{{ url('/dashboard/user/' . $user['slug']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 text-white bg-red-600 border rounded" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">🪣</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="px-4 py-3 text-center">No users found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
