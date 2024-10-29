import './bootstrap';

import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import Clipboard from '@ryangjchandler/alpine-clipboard'
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';

Alpine.plugin(Clipboard)

Livewire.start()

let calendarEl = document.getElementById('calendar');
let calendar = new Calendar(calendarEl, {
    plugins: [dayGridPlugin, timeGridPlugin, listPlugin],
    initialView: 'dayGridMonth',
    headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,listWeek'
    },
    events: '/visits/data', // Endpoint pour récupérer les événements
    eventClick: function(info) {
        // Construction des détails à afficher
        const eventDetails = `
                <strong>${info.event.title}</strong><br>
                <strong>Date de début:</strong> ${info.event.start.toISOString().split('T')[0]}<br>
                <strong>Date de fin:</strong> ${info.event.end.toISOString().split('T')[0]}<br>
                <strong>Nom de l'entreprise:</strong> ${info.event.extendedProps.company_name || 'N/A'}<br>
                <strong>Adresse:</strong> ${info.event.extendedProps.address || 'N/A'},
                    ${info.event.extendedProps.postcode || 'N/A'},
                    ${info.event.extendedProps.city || 'N/A'}
            `;

        // Afficher les détails dans la modale
        document.getElementById('eventDetails').innerHTML = eventDetails;

        // Ouvrir la modale
        document.getElementById('eventModal').classList.remove('hidden');
    }

});

calendar.render();

// Gérer la fermeture de la modale
document.getElementById('closeModal').addEventListener('click', function() {
    document.getElementById('eventModal').classList.add('hidden');
});
