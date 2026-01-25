@extends('layouts.admin')

@section('title', 'Modifier un client')

@section('content')
<div class="px-4 py-6 sm:px-0">
    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Modifier un client</h1>
            <p class="text-gray-600">Mettre à jour le client : {{ $client->prenom }} {{ $client->nom }}</p>
        </div>

        <form action="{{ route('clients.update', $client) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom *</label>
                    <input type="text" name="prenom" id="prenom" value="{{ old('prenom', $client->prenom) }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('prenom')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nom" class="block text-sm font-medium text-gray-700">Nom *</label>
                    <input type="text" name="nom" id="nom" value="{{ old('nom', $client->nom) }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('nom')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone *</label>
                    <input type="text" name="telephone" id="telephone" value="{{ old('telephone', $client->telephone) }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('telephone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="date_naissance" class="block text-sm font-medium text-gray-700">Date de naissance *</label>
                    <input type="date" name="date_naissance" id="date_naissance" value="{{ old('date_naissance', $client->date_naissance->format('Y-m-d')) }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('date_naissance')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="plan_id" class="block text-sm font-medium text-gray-700">Plan d'abonnement *</label>
                    <select name="plan_id" id="plan_id" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Sélectionner un plan</option>
                        @foreach ($plans as $plan)
                            <option value="{{ $plan->id }}" {{ old('plan_id', $client->plan_id) == $plan->id ? 'selected' : '' }}>
                                {{ $plan->nom }} - {{ number_format($plan->prix, 2) }} DH ({{ $plan->duree }} mois)
                            </option>
                        @endforeach
                    </select>
                    @error('plan_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="date_debut" class="block text-sm font-medium text-gray-700">Date de début *</label>
                    <input type="date" name="date_debut" id="date_debut" value="{{ old('date_debut', $client->date_debut->format('Y-m-d')) }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('date_debut')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6 bg-gray-50 p-4 rounded-md">
                <h3 class="text-sm font-medium text-gray-900 mb-2">Informations calculées</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-600">Montant à payer :</span>
                        <span class="ml-2 font-medium">{{ number_format($client->montant_a_payer, 2) }} DH</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Date de fin :</span>
                        <span class="ml-2 font-medium">{{ $client->date_fin ? $client->date_fin->format('d/m/Y') : '-' }}</span>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <a href="{{ route('clients.index') }}" class="mr-4 px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                    Annuler
                </a>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
