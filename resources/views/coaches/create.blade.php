@extends('layouts.admin')

@section('title', 'Ajouter un coach')

@section('content')
<div class="px-4 py-6 sm:px-0">
    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Ajouter un coach</h1>
            <p class="text-gray-600">Créer un nouveau coach</p>
        </div>

        <form action="{{ route('coaches.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom *</label>
                    <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('prenom')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nom" class="block text-sm font-medium text-gray-700">Nom *</label>
                    <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('nom')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone *</label>
                    <input type="text" name="telephone" id="telephone" value="{{ old('telephone') }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('telephone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="specialite" class="block text-sm font-medium text-gray-700">Spécialité *</label>
                    <input type="text" name="specialite" id="specialite" value="{{ old('specialite') }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('specialite')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="biographie" class="block text-sm font-medium text-gray-700">Biographie</label>
                    <textarea name="biographie" id="biographie" rows="4"
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('biographie') }}</textarea>
                    @error('biographie')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <a href="{{ route('coaches.index') }}" class="mr-4 px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                    Annuler
                </a>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                    Créer le coach
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
