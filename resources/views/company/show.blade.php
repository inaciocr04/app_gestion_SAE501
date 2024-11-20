<x-layout title="Détails sur {{$company->company_name}}">
    <div class="flex items-center space-x-7">
        <x-link.back href="{{route('manager.company.index')}}"/>
        <x-link.link name="Modifier" href="{{route('manager.company.edit', ['company' => $company])}}"/>
    </div>
    <h2 class="font-bold text-lg mt-4 mb-4 text-center">Information de l'entreprise</h2>
    <div class="lg:space-y-7">
        <ul class="block lg:flex lg:justify-evenly">
            <li><span class="font-poppins font-semibold">Nom de l'entreprise:</span> {{$company->company_name}}</li>
            <li><span class="font-poppins font-semibold">Adresse:</span> {{$company->company_address}}</li>
        </ul>
        <ul class="block lg:flex lg:justify-evenly">
            <li><span class="font-poppins font-semibold">Activité:</span> {{$company->company_department}}</li>
            <li><span class="font-poppins font-semibold">Code postal:</span> {{$company->company_postcode}}</li>
            <li><span class="font-poppins font-semibold">Ville:</span> {{$company->company_city}}</li>
            <li><span class="font-poppins font-semibold">Pays:</span> {{$company->company_country}}</li>
        </ul>
    </div>

    <h2 class="font-bold text-lg mt-4 mb-4 text-center">Manager de l'entreprise</h2>
    <ul class="block lg:flex justify-evenly">
        <li><span class="font-poppins font-semibold">Civilité:</span> {{$company->company_manager_civility}}</li>
        <li><span class="font-poppins font-semibold">Nom:</span> {{$company->company_manager_lastname}}</li>
        <li><span class="font-poppins font-semibold">Prénom:</span> {{$company->company_manager_firstname}}</li>
        <li><span class="font-poppins font-semibold">Numéro de téléphone:</span> {{$company->company_manager_tel_number}}</li>
        <li><span class="font-poppins font-semibold">Adresse email:</span> {{$company->company_manager_email}}</li>
    </ul>

    <h2 class="font-bold text-lg mt-4 mb-4 text-center">Tuteurs</h2>

    <div x-data="carousel()" class="relative w-full">
        <div class="overflow-hidden">
            <div x-ref="slides" class="flex transition-transform duration-500">
                @foreach($company->tutors as $index => $tutor)
                    <div class="flex-none w-full lg:!w-1/3 px-2">
                        <div class="bg-sixth-color rounded-2xl p-6 space-y-4">
                            <h4 class="text-center font-poppins font-semibold text-base">Tuteur n°{{ $index + 1 }}</h4>
                            <div class="space-y-4">
                                <div class="flex flex-col sm:flex-row sm:justify-around">
                                    <p><span class="font-poppins font-semibold">Civilité:</span> {{ $tutor->civility }}</p>
                                    <p><span class="font-poppins font-semibold">Nom:</span> {{ $tutor->lastname }}</p>
                                    <p><span class="font-poppins font-semibold">Prénom:</span> {{ $tutor->firstname }}</p>
                                </div>
                                <div class="flex flex-col sm:flex-row sm:justify-around items-center">
                                    <p class="text-center"><span class="font-poppins font-semibold">Numéro de téléphone:</span> {{ $tutor->telephone_number }}</p>
                                    <p class="text-center"><span class="font-poppins font-semibold">Adresse email:</span> {{ $tutor->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex justify-center space-x-4 mt-4">
            <button @click="prev()"
                    :disabled="currentIndex === 0"
                    class="bg-secondary-color text-white rounded-full p-2 disabled:opacity-70 disabled:cursor-not-allowed">
                &#10094;
            </button>
            <button @click="next()"
                    :disabled="currentIndex === totalSlides - 1"
                    class="bg-secondary-color text-white rounded-full p-2 disabled:opacity-70 disabled:cursor-not-allowed">
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
                slidesPerView: 3, // Par défaut 3 slides par vue
                totalSlides: Math.ceil({{ $company->tutors->count() }} / 3),
                init() {
                    this.updateSlidesPerView();
                    window.addEventListener('resize', this.updateSlidesPerView.bind(this));
                },
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
                    const slideWidth = this.$refs.slides.clientWidth / this.slidesPerView;
                    this.$refs.slides.style.transform = `translateX(-${this.currentIndex * slideWidth}px)`;
                },
                updateSlidesPerView() {
                    if (window.innerWidth < 1024) { // Tailwind sm breakpoint (640px)
                        this.slidesPerView = 1;
                    } else {
                        this.slidesPerView = 3;
                    }
                    this.totalSlides = Math.ceil(this.totalTutors / this.slidesPerView);
                    this.currentIndex = Math.min(this.currentIndex, this.totalSlides - 1);
                    this.updateTransform();
                }
            }
        }
    </script>
</x-layout>
