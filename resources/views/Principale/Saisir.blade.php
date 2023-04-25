@extends('layouts.master')

@section('title')
FSDM
@endsection

@section('css')

<link href="{{url('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@endsection

@section('content')
<div class="container-fluid mt-3">
  <div class="row">
  <div class="col-md-9">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Saisir les notes du module {{ $module_name }}  session {{ $SESSION }}</h1>
  </div></div>
  <form method="POST" action="{{route('noteEx',['module_name'=> $module_name])}}" id="exportf" >
    @csrf
    <input type="hidden" name="idS" value="{{ $SESSION=='Normale' ? 1 : 2}}">
  </form>
  <div class="col-md-3">
  <div class="text-right">
    <button class="btn btn-primary mb-1" id="exportb" type="submit">Exporter</button>
    <button type="submit" class="btn btn-primary mb-1" id="save" name="save">Save</button>
  </div>
  </div>
  </div>
</div>
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
                                <h5 class="mb-1">Validé  : <span id="valide">0</span></h5>
                                <h5 class="mb-1">Non Validé : <span id="noValide">0</span></h5>
                                @if (($SESSION == 'Normale' || $SESSION == 'Normal'))
                                <h5 class="mb-1">Rattrapage  : <span id="ratt">0</span></h5>
                                @endif
                                <h5 class="mb-1"> Erreur : <span id="erruer">0</span></h5>
                            </div>
                        </div>
                    </div>
                </div>
              </div >




            
            <!-- DataTable with Hover -->
            <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div>
                  <h6 class="m-0 font-weight-bold text-primary">{{ $module_name }}  : coefficient TP : {{$module_coef_tp}} ----{{$user_name}}----{{$user_id}}------- coefficient CF : {{$module_coef_cf}}</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>id</th>
                        <th>nom et prenom</th>
                        <th>note cf</th>
                        @if($module_coef_cf!=1)
                        <th>note tp</th>
                        @else
                        <th></th>
                        @endif
                        <th>moyen generale</th>
                        <th>etat</th>
                        <th>Correcteur</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Zedt hadi Gher bach n tester hta t modifieha  -->
                    <form method="post" action="{{ route('save')}}" id="notes" name="notes">
                        @csrf
                        <input type="hidden" name="module_id" value="{{ $module_id }}">
                        <input type="hidden" name="Session" value="{{ $SESSION }}">   
                        <input type="hidden" name="user" value="{{ $user_id }}">   
                        @foreach($etudiant as $e)
                        <tr>
                        <td>{{ $e['id'] }} </td>
                        <td> {{$e['nom']}}  {{$e['prenom']}}</td>

                        @php
                          $cfValue = $SESSION === 'Rattrapage' ? $e['CF_R'] ?? null : $e['CF_N'] ?? null;
                        @endphp

                        <td> <input type="number" class="form-control form-control-sm  mb-3"  name="noteCf[{{ $e['id'] }}]" min="0" max="20" step="0.25" value="{{ $cfValue }}" oninput="fmoyen(this)"/> </td>


                        @if($module_coef_cf!=1)
                        <td> <input type="number" class="form-control form-control-sm  mb-3" name="noteTp[{{ $e['id'] }}]"  min="0" max="20" step="0.25" value="{{ $e['TP_N'] }}" oninput="fmoyen(this)"/> </td>
                        @else
                        <td> <input type="number" value="0" hidden name="noteTp[{{ $e['id'] }}]"/> </td>
                        @endif
                        <td id="moyen_{{ $e['id'] }}" name="moyen[{{ $e['id'] }}]"></td>
                        <td id="etat_{{ $e['id'] }}"></td>
                        <td> {{ $e['profId'] }} </td>  <!-- C'est l'id de professeur qui saisit la note pour recuperer le nom $e['name'] --> 
                        </tr>
                        @endforeach
                      </form>
                        <!-- Fin de modification Par Ahmed  -->
                    
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          

    </div>
</div>
        


    

@endsection


@section('scripts')
<!-- Page level plugins -->


<script src="{{url('vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{url('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script>
    
  $(document).ready(function () {
  //  var table = $('#dataTableHover').DataTable({
  //   @if($module_coef_cf==1)
  //     columnDefs: [{targets: [3],sortable: false,searchable: false}]
  //   @endif
  //  });

    $('#exportb').click(function() {
      $('#exportf').submit();
    });

    $('#save').click(function () {
      $('#notes').submit();
    });
});
  </script>

  <script>
  function fmoyen(input) {
    const row = input.parentNode.parentNode;
    valueNoteCf=row.querySelector('[name^="noteCf"]').value;
    if({{$module_coef_cf}}!=1){
      valueNoteTp=row.querySelector('[name^="noteTp"]').value;  
      if(valueNoteTp=='' )
        noteTp = 0 ;
      else
        noteTp = parseFloat(valueNoteTp); 
        if(valueNoteCf=='')
        noteCf = 0 ;
      else
        noteCf = parseFloat(valueNoteCf) ;
      if(valueNoteTp=='' || valueNoteCf==''|| valueNoteTp==0 || valueNoteCf==0)
        moyen = 99.99;
      else
        moyen = (noteCf * {{$module_coef_cf}} ) + (noteTp * {{$module_coef_tp}} );
    }
    else{
      if(valueNoteCf=='')
        noteCf = 0 ;
      else
        noteCf = parseFloat(valueNoteCf) ;
      if( valueNoteCf==''||  valueNoteCf==0)
        moyen = 99.99;
      else
        moyen = noteCf  ;
    }
    row.querySelector(`#moyen_${row.cells[0].textContent}`).textContent = moyen.toFixed(2);
    if (moyen >= 10 && moyen<=20){
      row.querySelector(`#etat_${row.cells[0].textContent}`).textContent = "Validé";
    } else {
      row.querySelector(`#etat_${row.cells[0].textContent}`).textContent = "Non validé";
    }
  }
  

function getValid() {
    let nb = 0;
    let moyen;
    @foreach($etudiant as $e)
      moyen = document.getElementById(`moyen_{{ $e['id'] }}`);
      if (moyen !== null && parseFloat(moyen.innerText) >= 10 && parseFloat(moyen.innerText) <= 20) {
        nb++;
      }
    @endforeach
    return nb;
  }
  function getNoValid() {
    let nb = 0;
    let moyen;
    @foreach($etudiant as $e)
      moyen = document.getElementById(`moyen_{{ $e['id'] }}`);
      if (moyen !== null && !(parseFloat(moyen.innerText) >= 10 && parseFloat(moyen.innerText) <= 20)) {
        nb++;
      }
    @endforeach
    return nb;
  }
  function getRatt() {
    let nb = 0;
    let moyen;
    @foreach($etudiant as $e)
      moyen = document.getElementById(`moyen_{{ $e['id'] }}`);
      if (moyen !== null && parseFloat(moyen.innerText) < 10 ) {
        nb++;
      }
    @endforeach
    return nb;
  }
document.addEventListener('DOMContentLoaded', function() {
    nbValide = getValid();
    document.getElementById('valide').innerText = nbValide;
    nbNoValide = getNoValid();
    document.getElementById('noValide').innerText = nbNoValide;
    nbRatt = getRatt();
    document.getElementById('ratt').innerText = nbRatt;
  });
</script>
@endsection