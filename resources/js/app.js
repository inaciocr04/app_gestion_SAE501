import './bootstrap';

import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import Clipboard from '@ryangjchandler/alpine-clipboard'
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';

Alpine.plugin(Clipboard)

Livewire.start()

document.addEventListener('DOMContentLoaded', function() {
    let calendarEl = document.getElementById('calendar');
    let calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, timeGridPlugin, listPlugin],
        initialView: window.innerWidth < 1024 ? 'listWeek' : 'timeGridWeek',
        locale: 'fr',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listWeek'
        },
        buttonText: {
            today: 'Aujourd\'hui',
            month: 'Mois',
            week: 'Semaine',
            list: 'Jour',
        },
        events: '/visits/data',
        eventClick: function(info) {
            const eventDetails = `
                <strong>${info.event.title}</strong><br>
                <strong>Date de début:</strong> ${info.event.start.toISOString().split('T')[0]}<br>
                <strong>Date de fin:</strong> ${info.event.end ? info.event.end.toISOString().split('T')[0] : 'N/A'}<br>
                <strong>Nom de l'entreprise:</strong> ${info.event.extendedProps.company_name || 'N/A'}<br>
                <strong>Adresse:</strong> ${info.event.extendedProps.address || 'N/A'},
                    ${info.event.extendedProps.postcode || 'N/A'},
                    ${info.event.extendedProps.city || 'N/A'}
            `;

            document.getElementById('eventDetails').innerHTML = eventDetails;

            document.getElementById('eventModal').classList.remove('hidden');
        }
    });

    calendar.render();

    document.querySelectorAll('.fc-button').forEach(button => {
        button.classList.add('bg-blue-500', 'text-white', 'px-4', 'py-2', 'rounded', 'hover:bg-blue-600');
    });
    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('eventModal').classList.add('hidden');
    });
});


