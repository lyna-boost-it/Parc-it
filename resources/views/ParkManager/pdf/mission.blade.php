<div style="width: 100%;
border: 1px ;
overflow: hidden;">
    <div style="width: 15%;float:left;">
        <img src="assets/vendors/images/edeval2.png">
    </div>
    <div style=" overflow: hidden;">
        <center>
            République algérienne démocratique et populaire
        </center>
        <center>
            Wilaya d'alger
        </center>
        <center>
            Etablissement de développement des Expaces Verts d'Alger
        </center>
        <center>
            Pépinière d'El Alia Route Nationale n'05 Oued-Semar El Harrach
        </center>
        <center>
            Téléphone : (023)84.32.68
        </center>
    </div>
</div>
<br>

    <div style="width: 70%; float:left;">
        Département Logistique <br>
        Service Maintenance et Exploitation<br>
        N'Réf{{ $mission->id }}/ {{ now()->year }}
    </div>
    <div style="overflow: hidden;">
        <b>Alger le:</b>{{ now() }}
    </div>
    <br><br>
    <center>  <h1>Ordre de Mission</h1></center>
<h3>Nom: {{ $driver->name }}</h3>

<h3>Prénom: {{ $driver->last_name }}</h3>
    <h3>Fonction: {{ $driver->function }}</h3>
    <h3>Motif de la mission: {{ $mission->reason }}</h3>
   <h3>Type de véhicule: {{ $vehicle->vehicle_type }}</h3>
   <h3>Matricule: {{$vehicle->marticule  }}</h3>
   <h3>Du {{ $mission->start_date }} au {{ $mission->end_date }}</h3>

   <h3>Nom et prénom du personne
    accompagnée: {{ $mission->p_name }}
    {{ $mission->p_last_name }} </h3>
<h3>Observation: {{ $mission->observation }}</h3>
    <li>Cet ordre de Mission est valable pour @if($mission->territory)
        le territoire  {{ $mission->territory }}
        @else
        De {{ $mission->from }} <b> à </b>{{ $mission->to }}</td>
    @endif</li>

