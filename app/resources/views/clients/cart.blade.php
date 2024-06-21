@extends('clients.layouts.app')

@section('slot')
<style>
    .card-box-shadow{
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.12);
}
</style>
<div class="px-4 pt-8 mx-auto space-y-3 max-w-7xl sm:px-6 lg:px-8 min-h-[85vh]">
    <div class="px-4">
    @if ($errors->any())
                <div class="p-4 mt-4 mb-4 text-sm text-red-800 bg-red-100 rounded-lg" role="alert">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <h5 class="text-base lg:mb-16 mb-4 text-center font-bold lg:text-3xl text-black">Ticket Cart</h5>
        <div class="mx-auto max-w-6xl">
                <table class="table-cart table-cart-lg table-ecomm">
                    <thead class="hidden lg:table-header-group bg-[#f5f5f5]">
                        <tr class="text-justify">
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($cartItems && count($cartItems) > 0)
                        @php $grandTotal = 0; @endphp
                        @foreach ($cartItems as $item)
                        @php $grandTotal += $item['total'] ?? 0; @endphp
                        <tr class="block border-b border-[#eee] relative mb-6 min-h-28 pb-6 pl-24 lg:p-0 lg:table-row lg:static">
                            <td class="lg:w-[6%] absolute -top-1 right-0 z-10 mb-0 pb-0 border-none pl-3 text-center lg:static">
                                <form action="{{ route('clients.removeFromCart', $item['slug'] ?? '') }}" method="POST">
                                    @csrf
                                    <button type="submit" href="#">
                                        <i class="fa-solid fa-xmark text-[#9b9b9b]">x</i>
                                    </button>
                                </form>
                            </td>
                            <td class="lg:static lg:w-[16%] absolute top-0 left-0 overflow-hidden mb-0 pb-0 max-h-28 border-none flex-wrap w-20">
                                <a href="#" class="flex items-start">
                                    <img class="w-20 rounded" src="{{SessionService::image_url().$item["productImage"]}}" alt="test">
                                </a>
                            </td>
                            <td class="mb-0 pb-0 text-left pr-0">
                                <a href="#" class="mb-3 pr-6 text-black font-bold">
                                    {{ $item['productName'] ?? 'Product Name Unavailable' }}
                                </a>
                            </td>
                            <td class="mb-0 pb-0 text-left pr-0 justify-between">
                                <span class="text-xs uppercase py-3 lg:hidden">price</span>
                                <span class="font-bold">Rp. {{ number_format($item['productPrice'] ?? 0, 2) }}</span>
                            </td>
                            <td class="mb-0 pb-0 text-left pr-0 justify-between">
                                <span class="text-xs uppercase py-3 lg:hidden">quantity</span>
                                <div class="flex ml-[-12px] items-center bg-[#f5f5f5] rounded-xl border border-[#f5f5f5]">
                                    <input type="button" value="-" id="decrement-{{ $loop->iteration }}" class="decrement-btn h-7 leading-7 px-2 min-w-5 outline-0 font-bold text-base border-none bg-transparent cursor-pointer text-[#7e7e7e] fill-[#7e7e7e]">
                                    <input type="number" size="4" id="quantity-{{ $loop->iteration }}" readonly value="{{ $item['quantity'] ?? 0 }}" autocomplete="off" class="w-[60px] bg-transparent outline-none rounded text-center">
                                    <input type="button" value="+" id="increment-{{ $loop->iteration }}" class="increment-btn h-7 leading-7 px-2 min-w-5 outline-0 font-bold text-base border-none bg-transparent cursor-pointer text-[#7e7e7e] fill-[#7e7e7e]">
                                </div>
                                @if ($errors->has("quantities.{$item['slug']}"))
                                            <div class="text-red-600 text-sm mt-1">
                                                {{ $errors->first("quantities.{$item['slug']}") }}
                                            </div>
                                        @endif
                            </td>
                            <td class="mb-0 pb-0 text-left pr-0 justify-between">
                                <span class="text-xs uppercase py-3 lg:hidden">Total</span>
                                <span class="font-bold">Rp. {{ number_format($item['total'] ?? 0, 2) }}</span>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="block border-b border-[#eee] relative mb-6 min-h-28 pb-6 pl-24 lg:p-0 lg:table-row lg:static">
                            <td></td>
                            <td></td>
                            <td class="mb-0 pb-0 text-left pr-0">
                                <p>Keranjang belanja Anda kosong.</p>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>

                <div class="flex items-center flex-wrap pt-6 justify-between">
                    <div class="flex items-center mb-6 lg:mb-0">
                        <a href="/" class="px-4 py-2 text-white text-center transition w-[7rem] duration-300 ease-in-out bg-sky-900 rounded-sm hover:drop-shadow-[3px_3px_1px_grey]">Kembali</a>
                        @if ($cartItems && count($cartItems) > 0)
                        <form action="{{ route('clients.clearSession') }}" method="POST" class="mt-4">
                            @csrf
                            <button type="submit" class="px-4 py-2 text-white ml-5 transition w-[15rem] duration-300 ease-in-out bg-sky-900 rounded-sm hover:duration-300 ease-in-out hover:drop-shadow-[3px_3px_1px_grey]">
                                {{-- <i class="fa-solid fa-xmark mr-4"></i> --}}
                                Kosongkan Keranjang
                            </button>
                        </form>
                        @endif
                    </div>
                    @if ($cartItems && count($cartItems) > 0)
                    <form action="/cart/update" method="POST">
                        @csrf
                        @foreach ($cartItems as $item)
                            <input type="hidden" id="quantity-{{ $loop->iteration }}-send" value="{{ $item['quantity'] ?? 0 }}" name="quantities[{{ $item['slug'] }}]">
                        @endforeach
                        <button type="submit" class="px-4 py-2 text-white transition w-[11rem] duration-300 ease-in-out bg-sky-900 rounded-sm hover:hover:drop-shadow-[3px_3px_1px_grey]">Update Cart</button>
                    </form>
                    @endif
                </div>
                @if ($cartItems && count($cartItems) > 0)
            <div class="border-t border-[#eee] mt-7 pt-7 lg:mt-16 lg:pt-16"></div>
            <div class="p-4 card-box-shadow rounded-xl mb-8 w-full lg:ml-auto lg:w-1/2">
                <form action="/ticket" method="POST">
                    @csrf
                    <table class="table-ecomm">
                        <tbody>
                            <tr>
                                <th class="text-left border-b py-4 px-2 border-[#eee]">Total</th>
                                <td class="text-right border-b py-4 px-2 border-[#eee]">
                                    <span class="text-green-800 font-bold">Rp. {{number_format($grandTotal,2)}}</span>
                                </td>
                            </tr>
                            <tr class="flex flex-col w-full">
                                <div class="mb-4">
                                    <label for="order_note" class="text-left border-b py-4 px-2 border-[#eee]">Order Note</label>
                                    <textarea id="order_note" name="order_note" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Write your order note here..."></textarea>
                                </div>
                            </tr>
                        </tbody>
                    </table>

                    <div>
                        <button type="submit" class="bg-green-800 block w-full text-center font-bold rounded-sm py-3 px-8 text-white transition-all duration-300 capitalize">proceed to checkout</button>
                    </div>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Handle increment and decrement
    document.querySelectorAll('.increment-btn').forEach(function (button) {
        button.addEventListener('click', function () {
            const index = this.id.split('-')[1];
            const quantityInput = document.getElementById('quantity-' + index);
            const quantityInputSend = document.getElementById('quantity-' + index+'-send');
            let quantity = parseInt(quantityInput.value, 10);
            let plus = ++quantity
            quantityInput.value = plus;
            quantityInputSend.value = plus;
        });
    });

    document.querySelectorAll('.decrement-btn').forEach(function (button) {
        button.addEventListener('click', function () {
            const index = this.id.split('-')[1];
            const quantityInput = document.getElementById('quantity-' + index);
            const quantityInputSend = document.getElementById('quantity-' + index+'-send');
            let quantity = parseInt(quantityInput.value, 10);
            if (quantity > 1) {
                let minus = --quantity
                quantityInput.value = minus;
                quantityInputSend.value = minus;
            }
        });
    });
});

</script>
