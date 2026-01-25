@extends('layouts.admin')

@section('title', 'Clients')
@section('page-title', 'Clients')
@section('page-subtitle', 'Gérez vos abonnés')

@section('content')
<!-- Header Actions -->
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
    <div class="flex items-center mb-4 sm:mb-0">
        <i class="fas fa-users text-indigo-600 text-xl mr-3"></i>
        <div>
            <h2 class="text-lg font-semibold text-gray-900">Liste des clients</h2>
            <p class="text-sm text-gray-600">{{ $clients->count() }} client(s) trouvé(s)</p>
        </div>
    </div>
    <a href="{{ route('clients.create') }}" 
       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white font-medium rounded-lg hover:from-indigo-600 hover:to-indigo-700 transition-all duration-200 shadow-md hover:shadow-lg">
        <i class="fas fa-user-plus mr-2"></i>
        Ajouter un client
    </a>
</div>

<!-- Clients Table -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plan</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Période</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($clients as $client)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                    <span class="text-indigo-600 font-medium text-sm">
                                        {{ strtoupper(substr($client->prenom, 0, 1)) }}{{ strtoupper(substr($client->nom, 0, 1)) }}
                                    </span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $client->prenom }} {{ $client->nom }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        Né le {{ $client->date_naissance->format('d/m/Y') }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 flex items-center">
                                <i class="fas fa-phone mr-2 text-gray-400"></i>
                                {{ $client->telephone }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                <div class="font-medium">{{ $client->plan->nom }}</div>
                                <div class="text-gray-500">{{ number_format($client->plan->prix, 2) }} DH</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                <div>Début : {{ $client->date_debut->format('d/m/Y') }}</div>
                                <div>Fin : {{ $client->date_fin ? $client->date_fin->format('d/m/Y') : '-' }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $client->statut === 'Actif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                <i class="fas {{ $client->statut === 'Actif' ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                                {{ $client->statut }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('clients.edit', $client) }}" 
                                   class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 px-3 py-1 rounded-lg transition-colors">
                                    <i class="fas fa-edit mr-1"></i>
                                    Modifier
                                </a>
                                <form action="{{ route('clients.destroy', $client) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1 rounded-lg transition-colors">
                                        <i class="fas fa-trash mr-1"></i>
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="bg-gray-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-users text-gray-400 text-3xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Aucun client trouvé</h3>
                            <p class="text-gray-600 mb-6">Commencez par ajouter votre premier client.</p>
                            <a href="{{ route('clients.create') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white font-medium rounded-lg hover:from-indigo-600 hover:to-indigo-700 transition-all duration-200">
                                <i class="fas fa-user-plus mr-2"></i>
                                Ajouter un client
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Statistiques -->
<div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex items-center">
            <div class="bg-green-100 rounded-lg p-3 mr-4">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-600">Abonnements Actifs</p>
                <p class="text-2xl font-bold text-gray-900">
                    {{ $clients->filter(fn($c) => $c->statut === 'Actif')->count() }}
                </p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex items-center">
            <div class="bg-red-100 rounded-lg p-3 mr-4">
                <i class="fas fa-times-circle text-red-600 text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-600">Abonnements Expirés</p>
                <p class="text-2xl font-bold text-gray-900">
                    {{ $clients->filter(fn($c) => $c->statut === 'Expiré')->count() }}
                </p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex items-center">
            <div class="bg-yellow-100 rounded-lg p-3 mr-4">
                <i class="fas fa-coins text-yellow-600 text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-600">Revenu Total</p>
                <p class="text-2xl font-bold text-gray-900">
                    {{ number_format($clients->sum(fn($c) => $c->montant_a_payer), 2) }} DH
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
