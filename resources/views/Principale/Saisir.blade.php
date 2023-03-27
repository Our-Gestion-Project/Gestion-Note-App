<x-app-layout>
  
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Saisir les notes de session {{ $SESSION }} 
        </h2>
    </x-slot>
<<<<<<< HEAD
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
=======

    <!--  
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="success alert">
                        Bonjour {{ $user_name }}, Vous avez saisir les notes de module  {{$module_name}} de la session {{ $SESSION }}
                    </div>
                </div>
                <p> Le coeficient de {{$module_name }} est : {{$module_coef_tp[0]}} %</p>
                <br>
                <p> les etudiants qui sont inscrit dans ce module : </p>
                <br>
            </div>
           -->         
    
    
    <div class="container-fluid mt-3">
        <div class="row">

        <!--Pour les statistiques -->
            <div class="col-md-3">
                <div class="card ">
                    <div class="card-header">
                        <h4>Statistiques</h4>
                    </div>
                    <div class="card-content pb-4">
                        <div class="recent-message d-flex px-4 py-3">
                            <div class="name ms-4">
                                 <h5 class="mb-1">Validé  : 0<!--hna bghit les nb d nass li validé --></h5>
                                 <h5 class="mb-1">Rattrapage  : 1<!--hna bghit les nb d nass li validé --></h5>
                                 <h5 class="mb-1">Non validé / absent : 2<!--hna bghit les nb d nass li validé absent --></h5>
                                 <h5 class="mb-1"> Erreur de saisi : 3<!--hna bghit erreur de saisis--></h5>
                                 <!--<h6 class="text-muted mb-0">gg </h6>-->
                            </div>
                        </div>
                    </div>
                </div>
              </div >

        <!--Pour la table -->

        
              <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                              <!--  <h4 class="card-title">Session {{ $SESSION }}</h4> -->
                                <div class="table-responsive dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                                <div class="dataTable-top">
                                <div class="dataTable-dropdown">
                                  <select class="dataTable-selector form-select">
                                    <option value="5">5</option>
                                    <option value="10" selected="">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                  </select>
                                  <label> entries per page</label>
                                </div>
                                <div class="dataTable-search">
                                  <input class="dataTable-input" placeholder="Search..." type="text">
                                </div>
                              </div>
                                <form action="">
                                <div class="card-header">
                        <h4>Saisir les notes de session {{ $SESSION }} </h4>
                        <div class="text-right">
                                    <input class="btn btn-success btn-sm btn-outline-primary " type="submit" value="Save all">
                                  </div>
                            </div>
                                  
                                    <table class="table table-striped table-borderless table-hover">
                                        <thead>
                                            <tr>
                                              <th>Code</th>
                                              <th>Nom</th>
                                              <th>Prenom</th>
                                              <th>Controle finale</th>
                                              <th>travaux pratiques</th>
                                              <th>Coef CF</th>
                                              <th>Coef TP</th>
                                              <th>moyenne generale</th>
                                              <th>Etat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($etudiant as $etd)
                                            <tr>
                                            <td >{{ $etd->id }}</td>
                                            <td >{{ $etd->nom }}</td>
                                            <td>{{ $etd->prenom }}</td>
                                            <td><div class="col-xs-2"><input class="form-control" type="number" name="" id=""></div></td>
                                            <td><div class="col-xs-2"><input class="form-control" type="number" name="" id=""></div></td>
                                            <td>{{$module_coef_cf[0]}}</td>
                                            <td>{{$module_coef_tp[0]}}</td>
                                            
                                            <td>19</td>
                                            <td>Valide</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </form>
                                </div>
                            </div>

>>>>>>> 88c42b4 (GG)
    </div>
</div>
        
</x-app-layout>
