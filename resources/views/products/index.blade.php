<x-app-layout>
    <x-slot name="header">
        Liste des produits
    </x-slot>

    <body class="bg-white">

    <!-- Product List -->
    <section class="py-10 bg-gray-100">
        <div class="mx-auto grid max-w-6xl  grid-cols-1 gap-4 p-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach($products as $product)
                <article class="rounded-xl bg-white p-3 shadow-lg hover:shadow-xl hover:transform hover:scale-105 duration-300 ">
                    <a href="#">
                        <div class="relative flex items-end overflow-hidden rounded-xl">
                            <img src="{{$product->images}}" alt="Hotel Photo" />

                        </div>

                        <div class="mt-1 p-2">
                            <h2 class="text-slate-700">{{$product->name}}</h2>
                            <p class="mt-1 text-sm text-slate-400">{{Str::limit($product->description,50) }}</p>

                            <div class="mt-3 flex items-end justify-between">
                                <p class="text-[14px] font-bold text-blue-500 flex items-center">{{$product->formatted_price}}</p>

                                <add-to-cart :product-id="{{$product->id}}" />
                            </div>
                        </div>
                    </a>
                </article>
            @endforeach
    </section>

    <!-- Footer -->
    @include('footer.footer')
    </body>
</x-app-layout>
