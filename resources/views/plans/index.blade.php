@extends('layouts.admin')

@section('title', 'Plans d\'abonnement')
@section('page-title', 'Plans d\'abonnement')
@section('page-subtitle', 'Gérez vos plans d\'abonnement')

@section('content')
<!-- Header Actions -->
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
    <div class="flex items-center mb-4 sm:mb-0">
        <i class="fas fa-clipboard-list text-indigo-600 text-xl mr-3"></i>
        <div>
            <h2 class="text-lg font-semibold text-gray-900">Liste des plans</h2>
            <p class="text-sm text-gray-600">{{ $plans->count() }} plan(s) trouvé(s)</p>
        </div>
    </div>
    <a href="{{ route('plans.create') }}" 
       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white font-medium rounded-lg hover:from-indigo-600 hover:to-indigo-700 transition-all duration-200 shadow-md hover:shadow-lg">
        <i class="fas fa-plus mr-2"></i>
        Ajouter un plan
    </a>
</div>

<!-- Plans Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse ($plans as $plan)
        <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-white">{{ $plan->nom }}</h3>
                    <div class="bg-white bg-opacity-20 rounded-full px-3 py-1">
                        <span class="text-white text-sm font-medium">{{ $plan->duree }} mois</span>
                    </div>
                </div>
            </div>
            
            <div class="p-6">
                <div class="mb-4">
                    <p class="text-3xl font-bold text-gray-900">
                        {{ number_format($plan->prix, 2) }} 
                        <span class="text-lg font-normal text-gray-500">DH</span>
                    </p>
                </div>
                
                @if($plan->description)
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $plan->description }}</p>
                @else
                    <p class="text-gray-400 text-sm mb-4 italic">Aucune description</p>
                @endif
                
                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-users mr-1"></i>
                        {{ $plan->clients->count() }} client(s)
                    </div>
                    
                    <div class="flex space-x-2">
                        <a href="{{ route('plans.edit', $plan) }}" 
                           class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-600 text-sm font-medium rounded-lg hover:bg-blue-100 transition-colors">
                            <i class="fas fa-edit mr-1"></i>
                            Modifier
                        </a>
                        
                        @if($plan->clients->count() == 0)
                            <form action="{{ route('plans.destroy', $plan) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce plan ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 text-sm font-medium rounded-lg hover:bg-red-100 transition-colors">
                                    <i class="fas fa-trash mr-1"></i>
                                    Supprimer
                                </button>
                            </form>
                        @else
                            <button disabled 
                                    class="inline-flex items-center px-3 py-1.5 bg-gray-100 text-gray-400 text-sm font-medium rounded-lg cursor-not-allowed"
                                    title="Impossible de supprimer un plan utilisé par des clients">
                                <i class="fas fa-trash mr-1"></i>
                                Supprimer
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full">
            <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                <div class="bg-gray-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-clipboard-list text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Aucun plan trouvé</h3>
                <p class="text-gray-600 mb-6">Commencez par créer votre premier plan d'abonnement.</p>
                <a href="{{ route('plans.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white font-medium rounded-lg hover:from-indigo-600 hover:to-indigo-700 transition-all duration-200">
                    <i class="fas fa-plus mr-2"></i>
                    Créer un plan
                </a>
            </div>
        </div>
    @endforelse
</div>
@endsection
