<!doctype html>
<html lang="fr" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
    @vite('resources/css/app.css')

</head>
<body class="font-sans antialiased bg-bg-primary-color lg:flex h-screen space-y-8 lg:space-y-0 ">
    <header class=" h-2/6 lg:h-auto lg:w-3/6 px-10 py-6 lg:py-28 flex flex-col space-y-4 lg:space-y-20 text-white justify-between items-center">
        <div class=" space-y-4 lg:space-y-24">
            <h1 class=" text-4xl lg:text-7xl font-custom font-extrabold">Bienvenue,</h1>
            <p class=" text-lg lg:text-4xl">Voici le gestionnaire de stage et d’apprentissage des MMI</p>
            <p class=" text-lg lg:text-2xl">{{$infoForm}}</p>
        </div>
        <img class="w-64 lg:w-96 h-auto" src="/img/logo_iut_hauguenau.png" alt="">
    </header>
    <main class="bg-gray-50 w-screen lg:rounded-tl-3xl lg:rounded-bl-3xl">
        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <img class="mx-auto h-16 lg:h-24 w-auto" src="/img/logo_universite_de_strasbourg.png" alt="Your Company">
                <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ $titleForm }}</h2>
            </div>

            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <form action="{{ $action }}" method="POST" novalidate>
                    @csrf
                    <div class="space-y-6">
                        {{$slot}}
                        <div>
                            <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                {{ $submitMessage }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
