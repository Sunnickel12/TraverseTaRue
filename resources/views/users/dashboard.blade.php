@extends('layouts.navbar')

@section('title', 'User Dashboard')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold text-center mb-8">User Dashboard</h1>

    <!-- User Details -->

    <div class="bg-white shadow-md rounded-lg p-6 mb-8 border-2 border-black">
        <h2 class="text-xl font-bold mb-4">User Details</h2>
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Role:</strong> {{ $user->roles->pluck('name')->join(', ') }}</p>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Postulations Section -->
        <div class="bg-white shadow-md rounded-lg p-6 border-2 border-black">
            <h2 class="text-xl font-bold mb-4">Postulations</h2>
            @if($postulations->isEmpty())
            <p>No postulations found.</p>
            @else
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto bg-white border-2 border-black shadow-md rounded-lg text-sm">
                    <thead class="bg-[#3a3a3a] text-white">
                        <tr>
                            <th class="py-2 px-3 border-2 border-black text-left">Offer</th>
                            <th class="py-2 px-3 border-2 border-black text-left">Status</th>
                            <th class="py-2 px-3 border-2 border-black text-left">CV</th>
                            <th class="py-2 px-3 border-2 border-black text-left">ML</th>
                            <th class="py-2 px-3 border-2 border-black text-left">Date</th>
                            @role('admin')
                            <th class="py-2 px-3 border-2 border-black text-left">Actions</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($postulations as $postulation)
                        <tr class="hover:bg-gray-100 transition duration-200">
                            <!-- Offer Column -->
                            <td class="py-2 px-3 border-2 border-black">
                                <a href="{{ route('offers.show', ['offer' => $postulation->offer->id]) }}" class="text-blue-500 hover:underline">
                                    {{ $postulation->offer->title ?? 'N/A' }}
                                </a>
                            </td>
                            <!-- Status Column -->
                            <td class="py-2 px-3 border-2 border-black">
                                {{ $postulation->status->name ?? 'N/A' }}
                            </td>
                            <!-- CV Column -->
                            <td class="py-2 px-3 border-2 border-black">
                                @if($postulation->cv)
                                <a href="{{ route('postulations.download', ['type' => 'cv', 'id' => $postulation->id]) }}" class="text-blue-500 hover:underline">
                                    CV
                                </a>
                                @else
                                N/A
                                @endif
                            </td>
                            <!-- ML Column -->
                            <td class="py-2 px-3 border-2 border-black">
                                @if($postulation->motivation_letter)
                                <a href="{{ route('postulations.download', ['type' => 'motivation_letter', 'id' => $postulation->id]) }}" class="text-blue-500 hover:underline">
                                    ML
                                </a>
                                @else
                                N/A
                                @endif
                            </td>
                            <!-- Date Column -->
                            <td class="py-2 px-3 border-2 border-black">
                                {{ $postulation->created_at->format('d/m/Y') }}
                            </td>
                            <!-- Actions Column (Admin Only) -->
                            @role('admin')
                            <td class="py-2 px-3 border-2 border-black">
                                <a href="{{ route('postulations.edit', $postulation->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-yellow-600 transition">
                                    Edit
                                </a>
                            </td>
                            @endrole
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $postulations->links() }}
            </div>
            @endif
        </div>

        <!-- Wishlist Section -->
        <div class="bg-white shadow-md rounded-lg p-6 border-2 border-black">
            <h2 class="text-xl font-bold mb-4">Wishlist</h2>
            @if($wishlistOffers->isEmpty())
            <p>No items in your wishlist.</p>
            @else
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto bg-white border-2 border-black shadow-md rounded-lg text-sm">
                    <thead class="bg-[#3a3a3a] text-white">
                        <tr>
                            <th class="py-2 px-3 border-2 border-black text-left">Offer</th>
                            <th class="py-2 px-3 border-2 border-black text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($wishlistOffers as $offer)
                        <tr class="hover:bg-gray-100 transition duration-200">
                            <!-- Offer Column -->
                            <td class="py-2 px-3 border-2 border-black">
                                <a href="{{ route('offers.show', $offer->id) }}" class="text-blue-500 hover:underline">
                                    {{ $offer->title ?? 'N/A' }}
                                </a>
                            </td>
                            <!-- Actions Column -->
                            <td class="py-2 px-3 border-2 border-black">
                                @role('admin|etudiant')
                                <form method="POST" action="{{ route('wishlist.remove') }}" onsubmit="return confirm('Are you sure you want to remove this offer from your wishlist?');">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="offer_id" value="{{ $offer->id }}">
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-red-600 transition">
                                        Remove
                                    </button>
                                </form>
                                @else
                                <p class="text-gray-500">You do not have permission to modify this wishlist.</p>
                                @endrole
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $wishlistOffers->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection