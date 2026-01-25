@extends('layouts.admin')

@section('title', 'Modifier un plan')
@section('page-title', 'Modifier un plan')
@section('page-subtitle', 'Mettre à jour le plan : {{ $plan->nom }}')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-6">
        <form action="{{ route('plans.update', $plan) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Nom du plan -->
            <div>
                <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-tag mr-1 text-indigo-600"></i>
                    Nom du plan *
                </label>
                <input type="text" 
                       name="nom" 
                       id="nom" 
                       value="{{ old('nom', $plan->nom) }}" 
                       required
                       placeholder="Ex: Mensuel, Premium, Annuel..."
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                @error('nom')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Prix et Durée -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="prix" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-coins mr-1 text-indigo-600"></i>
                        Prix (DH) *
                    </label>
                    <input type="number" 
                           name="prix" 
                           id="prix" 
                           value="{{ old('prix', $plan->prix) }}" 
                           step="0.01" 
                           min="0" 
                           required
                           placeholder="0.00"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                    @error('prix')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="duree" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-calendar mr-1 text-indigo-600"></i>
                        Durée (mois) *
                    </label>
                    <input type="number" 
                           name="duree" 
                           id="duree" 
                           value="{{ old('duree', $plan->duree) }}" 
                           min="1" 
                           required
                           placeholder="1, 3, 6, 12..."
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                    @error('duree')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-align-left mr-1 text-indigo-600"></i>
                    Description
                </label>
                <textarea name="description" 
                          id="description" 
                          rows="4"
                          placeholder="Décrivez les avantages et caractéristiques de ce plan..."
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors resize-none">{{ old('description', $plan->description) }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Informations actuelles -->
            <div class="bg-gray-50 rounded-lg p-4">
                <h4 class="text-sm font-medium text-gray-700 mb-3">
                    <i class="fas fa-info-circle mr-1 text-indigo-600"></i>
                    Informations actuelles
                </h4>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-600">Clients utilisant ce plan :</span>
                        <span class="ml-2 font-medium text-gray-900">{{ $plan->clients->count() }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Revenu potentiel :</span>
                        <span class="ml-2 font-medium text-gray-900">{{ number_format($plan->prix * $plan->clients->count(), 2) }} DH</span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('plans.index') }}" 
                   class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Annuler
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white rounded-lg hover:from-indigo-600 hover:to-indigo-700 transition-all duration-200 font-medium shadow-md hover:shadow-lg">
                    <i class="fas fa-save mr-2"></i>
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
