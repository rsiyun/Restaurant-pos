<div>
    <div class="max-w-2xl mx-auto">

        <!-- Modal toggle -->
        <button class="bg-[#002D4C] border p-1 border-[#2B4F69] rounded-md" data-modal-toggle="{{$data['slug']}}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-600">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
        </button>

        <!-- Main modal -->
        <div id="{{$data['slug']}}" aria-hidden="true" class="hidden overflow-x-hidden overflow-y-auto fixed h-modal md:h-full top-4 left-0 right-0 md:inset-0 z-50 justify-center items-center">
            <div class="relative w-full max-w-2xl px-4 h-full md:h-auto text-left">
                <!-- Modal content -->
                <div class="bg-white rounded-lg shadow relative dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-gray-900 text-xl lg:text-2xl font-semibold dark:text-white">
                            Ticket Detail
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="{{$data['slug']}}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6">
                        <p class="text-gray-500 text-base leading-relaxed dark:text-gray-400">
                            idTicket: {{$data["slug"]}}
                        </p>
                        <p class="text-gray-500 text-base leading-relaxed dark:text-gray-400">
                            Catatan: {{$data["orderNote"]}}
                        </p>
                        <p class="text-gray-500 text-base dark:text-gray-400">
                            price: {{$data["priceTickets"]}}
                        </p>
                        <p class="text-gray-500 text-base dark:text-gray-400">
                            status: {{$data["idOrder"] == null ? "Belum Terbayar" : "Terbayar"}}
                        </p>
                    </div>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">

                                </th>
                                <th scope="col" class="px-6 py-3">
                                    product
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    quantity
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    price
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data["ticketDetail"] as $item)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <img class="w-20 rounded" src="{{SessionService::image_url().$item["product"]["productImage"]}}" alt="test">
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$item["product"]["productName"]}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$item["quantity"]}}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        {{$item["product"]["productPrice"]}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Modal footer -->
                    <div class="flex space-x-2 items-center p-6 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-toggle="{{$data['slug']}}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.js"></script>
</div>
