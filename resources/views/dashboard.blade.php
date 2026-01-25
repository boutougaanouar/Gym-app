@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Vue d\'ensemble de votre salle de sport')

@section('content')
<!-- Statistiques Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-4">
            <div class="flex items-center justify-between">
                <div class="bg-white bg-opacity-20 rounded-lg p-3">
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
                <div class="text-white">
                    <p class="text-sm opacity-90">Total Clients</p>
                    <p class="text-2xl font-bold">{{ $totalClients }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
        <div class="bg-gradient-to-r from-green-500 to-green-600 p-4">
            <div class="flex items-center justify-between">
                <div class="bg-white bg-opacity-20 rounded-lg p-3">
                    <i class="fas fa-check-circle text-white text-xl"></i>
                </div>
                <div class="text-white">
                    <p class="text-sm opacity-90">Abonnements Actifs</p>
                    <p class="text-2xl font-bold">{{ $abonnementsActifs }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
        <div class="bg-gradient-to-r from-red-500 to-red-600 p-4">
            <div class="flex items-center justify-between">
                <div class="bg-white bg-opacity-20 rounded-lg p-3">
                    <i class="fas fa-clock text-white text-xl"></i>
                </div>
                <div class="text-white">
                    <p class="text-sm opacity-90">Abonnements Expirés</p>
                    <p class="text-2xl font-bold">{{ $abonnementsExpires }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 p-4">
            <div class="flex items-center justify-between">
                <div class="bg-white bg-opacity-20 rounded-lg p-3">
                    <i class="fas fa-coins text-white text-xl"></i>
                </div>
                <div class="text-white">
                    <p class="text-sm opacity-90">Revenus Totaux</p>
                    <p class="text-2xl font-bold">{{ number_format($revenusTotaux, 2) }} DH</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Actions Rapides -->
<div class="bg-white rounded-xl shadow-lg p-6 mb-8">
    <div class="flex items-center mb-6">
        <i class="fas fa-bolt text-indigo-600 text-xl mr-3"></i>
        <h2 class="text-xl font-bold text-gray-900">Actions Rapides</h2>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="{{ route('clients.create') }}" 
           class="group flex items-center justify-center p-6 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white rounded-xl hover:from-indigo-600 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
            <i class="fas fa-user-plus mr-3 text-xl"></i>
            <span class="font-semibold">Ajouter un Client</span>
        </a>
        
        <a href="{{ route('plans.create') }}" 
           class="group flex items-center justify-center p-6 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl hover:from-green-600 hover:to-green-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
            <i class="fas fa-plus-circle mr-3 text-xl"></i>
            <span class="font-semibold">Créer un Plan</span>
        </a>
        
        <a href="{{ route('coaches.create') }}" 
           class="group flex items-center justify-center p-6 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-xl hover:from-purple-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
            <i class="fas fa-chalkboard-teacher mr-3 text-xl"></i>
            <span class="font-semibold">Ajouter un Coach</span>
        </a>
    </div>
</div>

<!-- Activité Récente -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex items-center mb-6">
            <i class="fas fa-chart-line text-indigo-600 text-xl mr-3"></i>
            <h2 class="text-xl font-bold text-gray-900">Statistiques</h2>
        </div>
        
        <div class="space-y-4">
            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                <span class="text-gray-600">Taux de rétention</span>
                <span class="font-semibold text-gray-900">
                    {{ $totalClients > 0 ? round(($abonnementsActifs / $totalClients) * 100, 1) : 0 }}%
                </span>
            </div>
            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                <span class="text-gray-600">Revenu moyen par client</span>
                <span class="font-semibold text-gray-900">
                    {{ $totalClients > 0 ? number_format($revenusTotaux / $totalClients, 2) : 0 }} DH
                </span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex items-center mb-6">
            <i class="fas fa-info-circle text-indigo-600 text-xl mr-3"></i>
            <h2 class="text-xl font-bold text-gray-900">Informations</h2>
        </div>
        
        <div class="space-y-4">
            <div class="p-4 bg-blue-50 border-l-4 border-blue-500 rounded">
                <p class="text-sm text-blue-800">
                    <i class="fas fa-lightbulb mr-2"></i>
                    Utilisez le menu à gauche pour naviguer entre les différentes sections de gestion.
                </p>
            </div>
            <div class="p-4 bg-green-50 border-l-4 border-green-500 rounded">
                <p class="text-sm text-green-800">
                    <i class="fas fa-check mr-2"></i>
                    Tous les calculs de dates et montants sont automatiques.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
