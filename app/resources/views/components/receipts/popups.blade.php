<div x-data="{ show: true }" x-show="show"
    class="fixed inset-0 flex items-center justify-center p-4 bg-black bg-opacity-10">

    {{-- Container of PopUp --}}
    <div class="bg-{{ $type === 'success' ? 'green' : 'red' }}-500 text-black p-6 rounded-lg shadow-lg">
        <div class="flex items-end justify-end mb-5">
            <button @click="show = false" class="h-4 ml-4 text-black">&times;</button>
        </div>

        <div class="items-center justify-between flex-column">
            <div>
                @if ($type === 'success')
                    <strong class="text-2xl font-bold">Success!</strong>
                @else
                    <strong>Failed!</strong>
                @endif
            </div>
            <span>{{ $message ?? 'No Message' }}</span>

        </div>

        <div class="flex items-center justify-center mt-5">
            <button @click="show = false"
                class="px-4 py-2 ml-4 text-white bg-teal-700 rounded hover:bg-gray-700 hover:text-white">
                Kembali
            </button>
        </div>

    </div>
</div>
