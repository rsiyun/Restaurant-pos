@extends('clients.layouts.app')

@section('slot')
    <div class="px-4 mx-auto space-y-3 max-w-7xl sm:px-6 lg:px-8 min-h-[85vh] pt-8">
        <div class="max-w-4xl mx-auto">
            <x-tables.table>
                <div class="w-full mx-auto p-4 rounded-md">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500" id="table">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    idTicket
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Order Note
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">view</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data as $item)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                        {{ $item['slug'] }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $item['orderNote'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        Rp. {{ $item['priceTickets'] }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <x-modal.modal-ticket :data="$item" />

                                        {{-- <button class="bg-[#002D4C] border p-1 border-[#2B4F69] rounded-md" data-modal-toggle="{{ $item['slug'] }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" class="w-6 h-6 text-green-600">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </button> --}}

                                        <!-- Tombol untuk menampilkan modal atau alert -->
                                        <button class="bg-[#002D4C] border p-1 border-[#2B4F69] rounded-md show-alert"
                                            data-id="{{ $item['slug'] }}"
                                            data-note="{{ $item['orderNote'] }}"
                                            data-price="{{ $item['priceTickets'] }}"
                                            data-status="{{ $item['idOrder'] == null ? 'Belum Terbayar' : 'Terbayar' }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-600">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </button>

                                    </td>
                                </tr>
                            @endforeach

                            <!-- Script to handle button click -->
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    // Get all elements with the class 'show-alert'
                                    var buttons = document.querySelectorAll('.show-alert');

                                    // Add click event listener to each button
                                    buttons.forEach(function(button) {
                                        button.addEventListener('click', function() {
                                            // Retrieve data from button's data attributes
                                            var id = button.getAttribute('data-id');
                                            var note = button.getAttribute('data-note');
                                            var price = button.getAttribute('data-price');
                                            var status = button.getAttribute('data-status');

                                            // Display alert with the retrieved data
                                            alert('ID: ' + id + '\nNote: ' + note + '\nPrice: Rp. ' + price + '\nStatus: ' +
                                                status);
                                        });
                                    });
                                });
                            </script>

                        </tbody>
                    </table>
                </div>
            </x-tables.table>
        </div>
    </div>
@endsection
