<x-filament::page>
    <div class="space-y-4">
        <h2 class="text-2xl font-bold">{{ $record->name }}</h2>

        <img src="{{ asset('storage/' . $record->image) }}" alt="Product Image" class="w-32 h-32 object-cover rounded" />

        <p><strong>Description:</strong> {{ $record->description }}</p>
        <p><strong>Price:</strong> ${{ $record->price }}</p>
    </div>
</x-filament::page>
