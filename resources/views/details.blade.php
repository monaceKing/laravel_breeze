<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Détails</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('Css/monStyle.css')}}">
{{-- DataTable --}}
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.jqueryui.min.css">

</head>
<body>
<div class="container">
    <ul class="nav justify-content-center p-3 bg-light">
        <li class="nav-item">
            <button id="btnFiltrerNonVide" class="btn btn-secondary m-2">Solde Lettré</button> 
        </li>
        <li class="nav-item">
            <button id="btnFiltrerVide" class="btn btn-primary m-2">Solde non Lettré</button>
        </li>
        <li class="nav-item">
            <button id="btnEffacerFiltre" class="btn btn-warning m-2">Effacer le filtre</button>
        </li>
      </ul>

      <div class="text-center">
        <div class="py-5">
           <div>
           {{-- totalDebit --}}
            <span id="totalDebit1" class="fw-bolder text-primary" style="display: inline-block;"></span>
           {{-- totalCredit --}}
            <span id="totalCredit" class="fw-bolder text-success" style="display: inline-block;"></span>
            {{-- Solde total --}}
            <span id="soldeTotal" class="fw-bolder text-success" style="display: inline-block;"></span>
            </div>
            
            <!-- Ajoutez deux boutons pour le filtrage -->
            <table id="myTable" class="table table-striped">
                <thead class="table-light">
                    <p id="totalDebit" class="justify-content-center fw-bolder"></p>
                    <tr>
                        <th>EC_RefPiece</th>
                        <th>EC_Intitule</th>
                        <th>EC_Echeance</th>
                        <th>N°?</th>
                        <th>Débit</th>
                        <th class="hidden"></th>
                        <th>Crédit</th>
                        <th class="hidden"></th>
                    </tr>
                </thead>
        
                <tbody>
                    @foreach ($data as $donnee)
                    
                    @php
                        $amount = $donnee->Ec_Montant;
                        $format = number_format($amount,0, ' ', ' ');
                    @endphp
    
                    <tr>
                        
                        <td>{{$donnee->EC_RefPiece}}</td>
                        <td>{{$donnee->EC_Intitule}}</td>
                        <td>{{(new DateTime($donnee->EC_Echeance))->format('d/m/Y')}}</td>
                        <td style="color:chartreuse">
                            @php
                                $date1 = new DateTime($donnee->EC_Echeance); //date d'echéance
    
                                $date2 = new DateTime(); //Date d'aujourd'hui
    
                                $intervalle = $date2->diff($date1);
    
                                $nj = $intervalle->format('%a');
    
                                
                                if ($date1 > $date2) {
                                    echo (-$nj);
                                }else{
                                    echo ($nj);
                                }
                            @endphp
                        </td>
                        <td>
                            {{-- Débit --}}
                            @php
                               if ($donnee->EC_sens <= 0) {
                                    echo $format;
                               } else {
                                echo 0;
                               }
                            @endphp
                        </td>
                        <td class="hidden">
                            {{-- Calcul débit --}}
                            @php
                               if ($donnee->EC_sens <= 0) {
                                    echo $donnee->Ec_Montant;
                               } else {
                                echo 0;
                               }
                            @endphp
    
                        </td>
    
                        <td>
                            {{-- Crédit --}}
                            @php
                               if ($donnee->EC_sens > 0) {
                                    echo $format;
                               } else {
                                echo 0;
                               }
                            @endphp
                        </td>

                        <td class="hidden">
                            {{-- Calcul crédit --}}
                            @php
                               if ($donnee->EC_sens > 0) {
                                    echo $donnee->Ec_Montant;
                               } else {
                                echo 0;
                               }
                            @endphp
    
                        </td>
                    </tr>
                        @endforeach
            </tbody>
            </table> 
        </div> 
        </div>
    </div>
</div>

    {{--Bootstrap--}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    {{-- DataTable --}}
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.jqueryui.min.js"></script>

{{--Appel script personnalisé--}}
<script src="{{asset('Js/monScript.js')}}"></script>
</body>
</html>