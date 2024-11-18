<x-layout title="Calendrier des visites">
    <livewire:manager-calendar :teachers="$teachers" />

    <!-- Modale pour afficher les détails de l'événement -->
    <div id="eventModal" class="hidden fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 text-center">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl">
                <div class="bg-white px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium text-gray-900" id="modal-title">Information détaillé</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500" id="eventDetails"></p>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button id="closeModal" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-layout>

