@extends('layouts.admin')

@section('title', 'Coachs')
@section('page-title', 'Coachs')
@section('page-subtitle', 'Gérez vos coachs sportifs')

@section('content')
<!-- Header Actions -->
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
    <div class="flex items-center mb-4 sm:mb-0">
        <i class="fas fa-user-tie text-indigo-600 text-xl mr-3"></i>
        <div>
            <h2 class="text-lg font-semibold text-gray-900">Liste des coachs</h2>
            <p class="text-sm text-gray-600">{{ $coaches->count() }} coach(s) trouvé(s)</p>
        </div>
    </div>
    <a href="{{ route('coaches.create') }}" 
       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white font-medium rounded-lg hover:from-indigo-600 hover:to-indigo-700 transition-all duration-200 shadow-md hover:shadow-lg">
        <i class="fas fa-chalkboard-teacher mr-2"></i>
        Ajouter un coach
    </a>
</div>

<!-- Coaches Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse ($coaches as $coach)
        <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group">
            <div class="bg-gradient-to-r from-purple-500 to-pink-600 p-6">
                <div class="flex items-center space-x-4">
                    <div class="bg-white bg-opacity-20 rounded-full w-16 h-16 flex items-center justify-center">
                        <span class="text-white text-xl font-bold">
                            {{ strtoupper(substr($coach->prenom, 0, 1)) }}{{ strtoupper(substr($coach->nom, 0, 1)) }}
                        </span>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">{{ $coach->prenom }} {{ $coach->nom }}</h3>
                        <p class="text-white text-sm opacity-90">{{ $coach->specialite }}</p>
                    </div>
                </div>
            </div>
            
            <div class="p-6">
                <div class="mb-4">
                    <div class="flex items-center text-gray-600 mb-2">
                        <i class="fas fa-phone mr-2 text-purple-500"></i>
                        <span class="text-sm">{{ $coach->telephone }}</span>
                    </div>
                    
                    @if($coach->biographie)
                        <p class="text-gray-600 text-sm line-clamp-3">{{ $coach->biographie }}</p>
                    @else
                        <p class="text-gray-400 text-sm italic">Aucune biographie</p>
                    @endif
                </div>
                
                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                    <div class="flex items-center text-sm text-purple-600 font-medium">
                        <i class="fas fa-award mr-1"></i>
                        Coach Sportif
                    </div>
                    
                    <div class="flex space-x-2">
                        <a href="{{ route('coaches.edit', $coach) }}" 
                           class="inline-flex items-center px-3 py-1.5 bg-purple-50 text-purple-600 text-sm font-medium rounded-lg hover:bg-purple-100 transition-colors">
                            <i class="fas fa-edit mr-1"></i>
                            Modifier
                        </a>
                        
                        <form action="{{ route('coaches.destroy', $coach) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce coach ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 text-sm font-medium rounded-lg hover:bg-red-100 transition-colors">
                                <i class="fas fa-trash mr-1"></i>
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full">
            <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                <div class="bg-gray-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user-tie text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Aucun coach trouvé</h3>
                <p class="text-gray-600 mb-6">Commencez par ajouter votre premier coach sportif.</p>
                <a href="{{ route('coaches.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white font-medium rounded-lg hover:from-indigo-600 hover:to-indigo-700 transition-all duration-200">
                    <i class="fas fa-chalkboard-teacher mr-2"></i>
                    Ajouter un coach
                </a>
            </div>
        </div>
    @endforelse
</div>

<!-- Statistiques -->
<div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex items-center">
            <div class="bg-purple-100 rounded-lg p-3 mr-4">
                <i class="fas fa-user-tie text-purple-600 text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-600">Total Coachs</p>
                <p class="text-2xl font-bold text-gray-900">{{ $coaches->count() }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex items-center">
            <div class="bg-indigo-100 rounded-lg p-3 mr-4">
                <i class="fas fa-trophy text-indigo-600 text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-600">Spécialités</p>
                <p class="text-2xl font-bold text-gray-900">{{ $coaches->pluck('specialite')->unique()->count() }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
