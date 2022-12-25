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
        N'Réf{{ $gasvehicules->id }}/ {{ now()->year }}
    </div>
    <div style="overflow: hidden;">
        <b>Alger le:</b>{{ now() }}
    </div>
    <br><br>
    <center>  <h1>Consommation</h1></center>
<h3>Date:  {{ $gasvehicules->date }}</h3>

<h3>Nom et prénom du conducteur: {{ $driver->name }} {{ $driver->last_name }}</h3>
    <h3>Fonction: {{ $driver->function }}</h3>
    <h3>Agent remplisseur: {{ $staff->name }} {{ $staff->last_name }}</h3>
   <h3>KM: {{ $gasvehicules->km }}</h3>
   <h3>Type: @if ($gasvehicules->type=='Gazole')
        Gas-oil
        @else
        {{ $gasvehicules->type }}
    @endif </h3>
   <h3>Type de véhicule: {{ $vehicule->vehicle_type }}</h3>
   <h3>Année mise en service: {{ $vehicule->year_commissioned }}</h3>

<h3>Coût: {{ $gasvehicules->price }}</h3>
 <h3>Litre de Carburant (facultatif):{{ $gasvehicules->litter }}</h3>
 <h3>Prix du litre: {{ $gasvehicules->litter_price }}</h3>

 <h3>N du ticket: {{ $gasvehicules->ticket }}</h3>

