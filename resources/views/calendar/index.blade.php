@extends('layouts.admin')

@section('title', 'Calendrier')
@section('page-title', 'Calendrier')
@section('page-subtitle', 'Gestion des plannings et cours')

@section('content')
<!-- Header Actions -->
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
    <div class="flex items-center mb-4 sm:mb-0">
        <i class="fas fa-calendar-alt text-indigo-600 text-xl mr-3"></i>
        <div>
            <h2 class="text-lg font-semibold text-gray-900">Planning de la salle</h2>
            <p class="text-sm text-gray-600">Gérez les horaires et les cours</p>
        </div>
    </div>
    <button id="addCourseBtn" 
            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white font-medium rounded-lg hover:from-indigo-600 hover:to-indigo-700 transition-all duration-200 shadow-md hover:shadow-lg">
        <i class="fas fa-plus mr-2"></i>
        Ajouter un cours
    </button>
</div>

<!-- Legend -->
<div class="bg-white rounded-xl shadow-lg p-4 mb-6">
    <div class="flex flex-wrap items-center justify-center gap-6 text-sm">
        <div class="flex items-center">
            <div class="w-4 h-4 bg-blue-500 rounded mr-2"></div>
            <span class="text-gray-700">Journée Hommes</span>
        </div>
        <div class="flex items-center">
            <div class="w-4 h-4 bg-pink-500 rounded mr-2"></div>
            <span class="text-gray-700">Journée Femmes</span>
        </div>
        <div class="flex items-center">
            <div class="w-4 h-4 bg-green-500 rounded mr-2"></div>
            <span class="text-gray-700">Cours</span>
        </div>
        <div class="flex items-center">
            <div class="w-4 h-4 bg-red-500 rounded mr-2"></div>
            <span class="text-gray-700">Fermé</span>
        </div>
    </div>
</div>

<!-- Calendar Container -->
<div class="bg-white rounded-xl shadow-lg p-6">
    <div id="calendar"></div>
</div>

<!-- Course Modal -->
<div id="courseModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-900">
                    <i class="fas fa-dumbbell mr-2 text-indigo-600"></i>
                    <span id="modalTitle">Ajouter un cours</span>
                </h3>
                <button onclick="closeCourseModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <form id="courseForm" class="space-y-4">
                <input type="hidden" id="courseId" name="course_id">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-heading mr-1 text-indigo-600"></i>
                            Titre du cours *
                        </label>
                        <input type="text" 
                               id="titre" 
                               name="titre" 
                               required
                               placeholder="Ex: Yoga, Sprint, Musculation..."
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-calendar mr-1 text-indigo-600"></i>
                            Date *
                        </label>
                        <input type="date" 
                               id="date" 
                               name="date" 
                               required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-clock mr-1 text-indigo-600"></i>
                            Heure de début *
                        </label>
                        <input type="time" 
                               id="heure_debut" 
                               name="heure_debut" 
                               required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-clock mr-1 text-indigo-600"></i>
                            Heure de fin *
                        </label>
                        <input type="time" 
                               id="heure_fin" 
                               name="heure_fin" 
                               required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user-tie mr-1 text-indigo-600"></i>
                            Coach
                        </label>
                        <select id="coach_id" 
                                name="coach_id" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Sélectionner un coach</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-palette mr-1 text-indigo-600"></i>
                            Couleur *
                        </label>
                        <div class="flex items-center space-x-2">
                            <input type="color" 
                                   id="couleur" 
                                   name="couleur" 
                                   value="#10b981"
                                   class="h-10 w-20 border border-gray-300 rounded cursor-pointer">
                            <input type="text" 
                                   id="couleur_text" 
                                   value="#10b981"
                                   readonly
                                   class="flex-1 px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg text-sm">
                        </div>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-align-left mr-1 text-indigo-600"></i>
                        Description
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="3"
                              placeholder="Description du cours..."
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 resize-none"></textarea>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-users mr-1 text-indigo-600"></i>
                        Nombre maximum de participants
                    </label>
                    <input type="number" 
                           id="max_participants" 
                           name="max_participants" 
                           min="1" 
                           max="100"
                           placeholder="Optionnel"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                
                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                    <button type="button" 
                            onclick="closeCourseModal()" 
                            class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                        <i class="fas fa-times mr-2"></i>
                        Annuler
                    </button>
                    <button type="submit" 
                            class="px-6 py-2 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white rounded-lg hover:from-indigo-600 hover:to-indigo-700 transition-all duration-200 font-medium shadow-md hover:shadow-lg">
                        <i class="fas fa-save mr-2"></i>
                        <span id="submitBtnText">Créer</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Schedule Edit Modal -->
<div id="scheduleModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md mx-4">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-900">
                    <i class="fas fa-cog mr-2 text-indigo-600"></i>
                    Modifier le planning
                </h3>
                <button onclick="closeScheduleModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <form id="scheduleForm" class="space-y-4">
                <input type="hidden" id="scheduleId" name="schedule_id">
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-venus-mars mr-1 text-indigo-600"></i>
                        Type de public *
                    </label>
                    <select id="type_public" 
                            name="type_public" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="homme">Hommes</option>
                        <option value="femme">Femmes</option>
                    </select>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-door-open mr-1 text-indigo-600"></i>
                            Ouverture *
                        </label>
                        <input type="time" 
                               id="heure_ouverture" 
                               name="heure_ouverture" 
                               required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-door-closed mr-1 text-indigo-600"></i>
                            Fermeture *
                        </label>
                        <input type="time" 
                               id="heure_fermeture" 
                               name="heure_fermeture" 
                               required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>
                
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" 
                               id="is_closed" 
                               name="is_closed" 
                               class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-gray-700">Jour fermé</span>
                    </label>
                </div>
                
                <div id="motif_fermeture_group" class="hidden">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-exclamation-triangle mr-1 text-indigo-600"></i>
                        Motif de fermeture *
                    </label>
                    <input type="text" 
                           id="motif_fermeture" 
                           name="motif_fermeture" 
                           placeholder="Ex: Férié, Maintenance..."
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                
                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                    <button type="button" 
                            onclick="closeScheduleModal()" 
                            class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                        <i class="fas fa-times mr-2"></i>
                        Annuler
                    </button>
                    <button type="submit" 
                            class="px-6 py-2 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white rounded-lg hover:from-indigo-600 hover:to-indigo-700 transition-all duration-200 font-medium shadow-md hover:shadow-lg">
                        <i class="fas fa-save mr-2"></i>
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js"></script>
<script>
// Fonctions globales
function closeCourseModal() {
    const modal = document.getElementById('courseModal');
    modal.classList.add('hidden');
    modal.style.display = 'none';
    
    // Réinitialiser le formulaire
    document.getElementById('courseForm').reset();
    document.getElementById('courseId').value = '';
    document.getElementById('modalTitle').textContent = 'Ajouter un cours';
    document.getElementById('submitBtnText').textContent = 'Créer';
}

function closeScheduleModal() {
    const modal = document.getElementById('scheduleModal');
    modal.classList.add('hidden');
    modal.style.display = 'none';
    
    // Réinitialiser le formulaire
    document.getElementById('scheduleForm').reset();
    document.getElementById('scheduleId').value = '';
}

document.addEventListener('DOMContentLoaded', function() {
    let calendar;
    let coaches = [];
    
    // Gestionnaire pour la touche ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeCourseModal();
            closeScheduleModal();
        }
    });
    
    // Initialiser FullCalendar
    const calendarEl = document.getElementById('calendar');
    calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        locale: 'fr',
        firstDay: 1, // Lundi comme premier jour de la semaine
        height: 'auto',
        events: '/calendar/events',
        eventClick: function(info) {
            handleEventClick(info);
        },
        dateClick: function(info) {
            handleDateClick(info);
        },
        eventDidMount: function(info) {
            // Ajouter des icônes pour les types d'événements
            if (info.event.extendedProps.type === 'schedule') {
                const icon = document.createElement('i');
                icon.className = `fas ${info.event.extendedProps.icon} mr-1`;
                info.el.querySelector('.fc-event-title').prepend(icon);
            }
        }
    });
    
    calendar.render();
    
    // Charger les coaches
    loadCoaches();
    
    // Gestionnaires d'événements
    document.getElementById('addCourseBtn').addEventListener('click', () => {
        openCourseModal();
    });
    
    document.getElementById('courseForm').addEventListener('submit', (e) => {
        e.preventDefault();
        saveCourse();
    });
    
    document.getElementById('scheduleForm').addEventListener('submit', (e) => {
        e.preventDefault();
        saveSchedule();
    });
    
    document.getElementById('is_closed').addEventListener('change', (e) => {
        const motifGroup = document.getElementById('motif_fermeture_group');
        if (e.target.checked) {
            motifGroup.classList.remove('hidden');
        } else {
            motifGroup.classList.add('hidden');
        }
    });
    
    document.getElementById('couleur').addEventListener('input', (e) => {
        document.getElementById('couleur_text').value = e.target.value;
    });
    
    // Fonctions
    function loadCoaches() {
        fetch('/api/coaches')
            .then(response => response.json())
            .then(data => {
                coaches = data;
                const select = document.getElementById('coach_id');
                select.innerHTML = '<option value="">Sélectionner un coach</option>';
                coaches.forEach(coach => {
                    select.innerHTML += `<option value="${coach.id}">${coach.prenom} ${coach.nom}</option>`;
                });
            })
            .catch(error => {
                console.error('Error loading coaches:', error);
            });
    }
    
    function handleEventClick(info) {
        const event = info.event;
        
        if (event.extendedProps.type === 'course') {
            // Ouvrir le modal pour modifier le cours
            const courseId = event.id.replace('course_', '');
            openCourseModal(courseId);
        } else if (event.extendedProps.type === 'schedule') {
            // Ouvrir le modal pour modifier le planning
            const scheduleId = event.id.replace('schedule_', '');
            openScheduleModal(scheduleId);
        }
    }
    
    function handleDateClick(info) {
        // Ouvrir le modal pour ajouter un cours à cette date
        openCourseModal(null, info.dateStr);
    }
    
    function openCourseModal(courseId = null, date = null) {
        const modal = document.getElementById('courseModal');
        const form = document.getElementById('courseForm');
        const title = document.getElementById('modalTitle');
        const submitBtn = document.getElementById('submitBtnText');
        
        form.reset();
        
        if (courseId) {
            // Mode édition
            title.textContent = 'Modifier le cours';
            submitBtn.textContent = 'Mettre à jour';
            
            fetch(`/courses/${courseId}`)
                .then(response => response.json())
                .then(course => {
                    document.getElementById('courseId').value = course.id;
                    document.getElementById('titre').value = course.titre;
                    document.getElementById('date').value = course.date;
                    document.getElementById('heure_debut').value = course.heure_debut.substring(0, 5);
                    document.getElementById('heure_fin').value = course.heure_fin.substring(0, 5);
                    document.getElementById('description').value = course.description || '';
                    document.getElementById('coach_id').value = course.coach_id || '';
                    document.getElementById('couleur').value = course.couleur;
                    document.getElementById('couleur_text').value = course.couleur;
                    document.getElementById('max_participants').value = course.max_participants || '';
                });
        } else {
            // Mode création
            title.textContent = 'Ajouter un cours';
            submitBtn.textContent = 'Créer';
            document.getElementById('courseId').value = '';
            
            if (date) {
                document.getElementById('date').value = date;
            }
        }
        
        modal.classList.remove('hidden');
        modal.style.display = 'flex';
    }
    
    function handleEventClick(info) {
        const event = info.event;
        
        if (event.extendedProps.type === 'course') {
            // Ouvrir le modal pour modifier le cours
            const courseId = event.id.replace('course_', '');
            openCourseModal(courseId);
        } else if (event.extendedProps.type === 'schedule') {
            // Ouvrir le modal pour modifier le planning
            const scheduleId = event.id.replace('schedule_', '');
            openScheduleModal(scheduleId);
        }
    }
    
    function handleDateClick(info) {
        // Ouvrir le modal pour ajouter un cours à cette date
        openCourseModal(null, info.dateStr);
    }
    
    function openScheduleModal(scheduleId) {
        const modal = document.getElementById('scheduleModal');
        
        fetch(`/calendar/schedule/${scheduleId.split('_')[1]}`)
            .then(response => response.json())
            .then(schedule => {
                document.getElementById('scheduleId').value = schedule.id;
                document.getElementById('type_public').value = schedule.type_public;
                document.getElementById('heure_ouverture').value = schedule.heure_ouverture.substring(0, 5);
                document.getElementById('heure_fermeture').value = schedule.heure_fermeture.substring(0, 5);
                document.getElementById('is_closed').checked = schedule.is_closed;
                document.getElementById('motif_fermeture').value = schedule.motif_fermeture || '';
                
                if (schedule.is_closed) {
                    document.getElementById('motif_fermeture_group').classList.remove('hidden');
                }
                
                modal.classList.remove('hidden');
                modal.style.display = 'flex';
            });
    }
    
    function saveCourse() {
        const form = document.getElementById('courseForm');
        const formData = new FormData(form);
        const courseId = document.getElementById('courseId').value;
        
        const data = {
            titre: formData.get('titre'),
            date: formData.get('date'),
            heure_debut: formData.get('heure_debut'),
            heure_fin: formData.get('heure_fin'),
            description: formData.get('description'),
            coach_id: formData.get('coach_id') ? parseInt(formData.get('coach_id')) : null,
            couleur: formData.get('couleur'),
            max_participants: formData.get('max_participants') ? parseInt(formData.get('max_participants')) : null,
        };
        
        const url = courseId ? `/courses/${courseId}` : '/courses';
        const method = courseId ? 'PUT' : 'POST';
        
        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => {
                    throw new Error(err.error || 'Erreur serveur');
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                alert(data.error);
            } else {
                closeCourseModal();
                calendar.refetchEvents();
                showNotification(data.message, 'success');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification(error.message || 'Une erreur est survenue', 'error');
        });
    }
    
    function saveSchedule() {
        const form = document.getElementById('scheduleForm');
        const formData = new FormData(form);
        const scheduleId = document.getElementById('scheduleId').value;
        
        const data = {
            type_public: formData.get('type_public'),
            heure_ouverture: formData.get('heure_ouverture'),
            heure_fermeture: formData.get('heure_fermeture'),
            is_closed: formData.get('is_closed') === 'on',
            motif_fermeture: formData.get('motif_fermeture') || null,
        };
        
        fetch(`/calendar/schedule/${scheduleId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
            } else {
                closeScheduleModal();
                calendar.refetchEvents();
                showNotification(data.message, 'success');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Une erreur est survenue', 'error');
        });
    }
    
    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 flex items-center space-x-2 ${
            type === 'success' ? 'bg-green-500' : 'bg-red-500'
        } text-white`;
        notification.innerHTML = `
            <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
            <span>${message}</span>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
});
</script>
@endpush
