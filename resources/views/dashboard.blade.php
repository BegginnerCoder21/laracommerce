<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @forelse ($orders as $order)
                        <table class="w-full border-collapse border border-gray-300">
                            <thead class="bg-gray-200">
                            <tr>
                                <th colspan="3" class="py-2 text-lg font-semibold text-center">
                                    Commande n° {{ $order->order_number }} passée le {{ $order->created_at->format('d M Y') }}
                                </th>
                            </tr>
                            <tr class="border-b">
                                <th class="p-4">Nom</th>
                                <th class="p-4">Prix</th>
                                <th class="p-4">Quantité</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->products as $product)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="p-4">{{ $product->name }}</td>
                                    <td class="p-4">{{$product->pivot->total_price }} fcfa</td>
                                    <td class="p-4">{{ $product->pivot->total_quantity }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @empty
                        <h2>Aucune commande trouvée</h2>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
