<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           Saisir les note de session {{ $SESSION }} 
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form method="POST" action="{{route('noteEx',['module_name'=> $module_name])}}">
                            @csrf
                            <button type="submit">Exporter</button>
                </form>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div onclick="this.style.display='none'" class="success alert">
                            Bonjours {{ $user_name }}, Vous avez saisir les note de module  {{$module_name}} de la session {{ $SESSION }}
                        </div>
                </div>
                        <p> Le coeficient de {{$module_name }} est : {{$module_coef_tp[0]}} %</p>
                        <br>
                        <p> les etudiants qui sont inscrit dans ce module : </p>
                        <br>
                    @foreach ($etudiant as $etd)
                        ID : {{ $etd->id }}  Nom :  {{ $etd->nom }}  Prénom : {{ $etd->prenom }} <br>
                    @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
