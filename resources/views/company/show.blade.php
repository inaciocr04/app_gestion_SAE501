<x-layout title="Détails sur {{$company->company_name}}">
    <div class="flex items-center space-x-7">
        <x-link.back href="{{route('manager.company.index')}}"/>
        <x-link.link name="Modifier" href="{{route('manager.company.edit', ['company' => $company])}}"/>
    </div>

    <ul>
        <li>Nom de l'entreprise: {{$company->company_name}}</li>
        <li>Adresse: {{$company->company_address}}</li>
        <li>Code postal: {{$company->company_postcode}}</li>
        <li>Ville: {{$company->company_city}}</li>
        <li>Département: {{$company->company_department}}</li>
        <li>Pays: {{$company->company_country}}</li>
    </ul>

    <p>Manager de l'entreprise</p>
    <ul>
        <li>Civilité: {{$company->company_manager_civility}}</li>
        <li>Nom: {{$company->company_manager_lastname}}</li>
        <li>Prénom: {{$company->company_manager_firstname}}</li>
        <li>Numéro de téléphone: {{$company->company_manager_tel_number}}</li>
        <li>Adresse email: {{$company->company_manager_email}}</li>
    </ul>

    <h2>Tuteurs</h2>

    <div x-data="carousel()" class="relative w-full">
        <div class="overflow-hidden">
            <div x-ref="slides" class="flex transition-transform duration-500">
                @foreach($company->tutors as $index => $tutor)
                @if($index % 3 == 0)
                <div class="flex-none w-full flex justify-between">
                    @endif

                    <div class="bg-sixth-color rounded-2xl p-6 mx-2 flex-1 w-fit space-y-4">
                        <h4 class="text-center font-poppins font-semibold text-base">Tuteur n°{{ $index + 1 }}</h4>
                        <div class="space-y-7">
                            <div class="flex justify-around">
                                <p>Civilité: {{ $tutor->civility }}</p>
                                <p>Nom: {{ $tutor->lastname }}</p>
                                <p>Prénom: {{ $tutor->firstname }}</p>
                            </div>
                            <div class="flex justify-around items-center">
                                <p class="text-center">Numéro de téléphone: {{ $tutor->telephone_number }}</p>
                                <p class="text-center">Adresse email: {{ $tutor->email }}</p>
                            </div>
                        </div>
                    </div>

                    @if($index % 3 == 2 || $loop->last)
                </div>
                @endif
                @endforeach
            </div>
        </div>

        <div class="flex justify-center space-x-7 mt-4">
            <button @click="prev()" :disabled="currentIndex === 0" class="bg-secondary-color text-white rounded-full p-2" :class="{ 'opacity-70 cursor-not-allowed': currentIndex === 0 }">
                &#10094;
            </button>
            <button @click="next()" :disabled="currentIndex === totalSlides - 1" class="bg-secondary-color text-white rounded-full p-2" :class="{ 'opacity-70 cursor-not-allowed': currentIndex === totalSlides - 1 }">
                &#10095;
            </button>
        </div>
    </div>

    @if($company->tutors->isEmpty())
        <div class="text-center">
            <p>Aucun tuteur trouvé pour cette entreprise.</p>
        </div>
    @endif

    <script>
        function carousel() {
            return {
                currentIndex: 0,
                totalTutors: {{ $company->tutors->count() }},
                slidesPerView: 3,
                totalSlides: Math.ceil({{ $company->tutors->count() }} / 3),
                next() {
                    if (this.currentIndex < this.totalSlides - 1) {
                        this.currentIndex++;
                    }
                    this.updateTransform();
                },
                prev() {
                    if (this.currentIndex > 0) {
                        this.currentIndex--;
                    }
                    this.updateTransform();
                },
                updateTransform() {
                    const slideWidth = this.$refs.slides.clientWidth;
                    this.$refs.slides.style.transform = `translateX(-${this.currentIndex * (slideWidth)}px)`;
                }
            }
        }
    </script>
</x-layout>
