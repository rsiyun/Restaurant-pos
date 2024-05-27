@extends('clients.layouts.app')

    @section('slot')
        <div class="px-4 mx-auto space-y-3 max-w-7xl sm:px-6 lg:px-8 min-h-[85vh]">
            <div class="mt-[2rem] mb-[1rem]">
                @include('components.h1-component', [
                    'slot' => 'Menu Makanan',
                    'bg' => 'amber-500',
                    ])
            </div>
            <div class="pb-8">
                <div class="flex flex-wrap items-center justify-center">
                    @foreach ($products as $product)
                    <div class="px-8">
                        @include('components.small-card-content', [
                            'foto' => SessionService::image_url().$product["productImage"],
                            'name' => $product["productName"],
                            'content' => "Rp. ".$product["productPrice"],
                            'link' => url("/product"."/". $product['slug'])
                            ])
                    </div>
                @endforeach

            </div>
        </div>
        </div>
        @endsection
