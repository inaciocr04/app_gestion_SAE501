import './bootstrap';
import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import Clipboard from '@ryangjchandler/alpine-clipboard';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';

Alpine.plugin(Clipboard);
Livewire.start();

document.addEventListener('DOMContentLoaded', function () {
    let calendarEl = document.getElementById('calendar');
    if (calendarEl) {
        let calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin, timeGridPlugin, listPlugin],
            initialView: window.innerWidth < 1024 ? 'listWeek' : 'timeGridWeek',
            locale: 'fr',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            buttonText: {
                today: 'Aujourd\'hui',
                month: 'Mois',
                week: 'Semaine',
                day: 'Jour',
            },
            events: '/visits/data',
            eventMinHeight: 60,
            slotDuration: '00:30:00',
            allDaySlot: false,
            eventClick: function (info) {
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
    }

    // Configuration pour le calendrier `managerCalendar`
    let managerCalendarEl = document.getElementById('managerCalendar');
    if (managerCalendarEl) {
        console.log('Initializing managerCalendar');
        let managerCalendar = new Calendar(managerCalendarEl, {
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
            events: function (fetchInfo, successCallback, failureCallback) {
                const teacherId = document.getElementById('teacherSelect').value;
                fetch(`/manager/visits/data?teacher_id=${teacherId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        successCallback(data);
                    })
                    .catch(error => {
                        console.error('Error fetching manager events:', error);
                        failureCallback(error);
                    });
            },
            eventClick: function (info) {
                const eventDetails = `
                    <strong>${info.event.title}</strong><br>
                    <strong>Professeur:</strong> ${info.event.extendedProps.teacher || 'N/A'}<br>
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

        managerCalendar.render();

        window.addEventListener('updatedEvents', function(event) {
            managerCalendar.removeAllEvents();
            managerCalendar.addEventSource(event.detail.events);
        });

        document.querySelectorAll('.fc-button').forEach(button => {
            button.classList.add('bg-blue-500', 'text-white', 'px-4', 'py-2', 'rounded', 'hover:bg-blue-600');
        });
    }

    document.getElementById('closeModal').addEventListener('click', function () {
        document.getElementById('eventModal').classList.add('hidden');
    });
});
