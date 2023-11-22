<x-app-layout>
<<<<<<< HEAD
    <div class="postition-relative">
        <div class="container mt-5 position-absolute bg-white" id="consult">
            <div class="d-flex justify-content-between align-items-center mb-3">
                @foreach ($data as $row)
                <br><br><br><br>
                <h3 class="pb-3">Fiche médicale <strong> {{ $row->last_name .' '. $row->first_name }}</strong></h3>
                <form method="POST" action="{{ route('generate-pdf') }}" class="ms-auto">

                    <input type="text" name="national_number" value="{{$row->national_number}}" hidden>
=======
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails de la fiche médicale') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container mt-5 bg-white">
            <div class="d-flex justify-content-between align-items-center mb-3">
                @foreach ($data as $row)
                <h3 class="pb-3">Fiche médicale de <strong>{{ $row->last_name }} {{ $row->first_name }}</strong></h3>
                <form method="POST" action="{{ route('generate-pdf') }}" class="ml-auto">
                    <input type="text" name="national_number" value="{{ $row->national_number }}" hidden>
>>>>>>> new_staging
                    @csrf
                    <button type="submit" class="btn" style="background: none; border: none; display: flex; align-items: center;" title="Télécharger en PDF">
                        Télécharger
                        <img src="{{ asset('images/down.png') }}" alt="Générer PDF" style="height: 40px; margin-left: 5px;">
                    </button>
                </form>
                @endforeach
            </div>
            <ul class="list-group list-group-flush">
<<<<<<< HEAD
                <li class="list-group-item"><strong>Nom : </strong>{{$item->last_name }}</li>
                <li class="list-group-item"><strong>Prénom : </strong>{{$item->first_name }}</li>
            </ul>
            @endforeach

            <ul class="list-group list-group-flush">

                <li class="list-group-item"><strong>Numéro national : </strong>{{ $row->national_number }}</li>
                <li class="list-group-item"><strong>Médecin : </strong> {{ $row->doctor }}</li>
                <li class="list-group-item"><strong>Medicaments : </strong> {{ $row->medecins }}</li>
                <li class="list-group-item"><strong>Allergie :</strong> {{ $row->allergies }}</li>
                <li class="list-group-item"><strong>Date De Naissance :</strong> {{ $row->birth_date }}</li>
                <li class="list-group-item"><strong>Peut-il Participer ? :</strong> {{ $row->can_participate ? 'Oui' : 'Non' }}</li>
                <li class="list-group-item"><strong>Est-il vacciné contre le tétanos ? :</strong> {{ $row->tetanos_protected ? 'Oui' : 'Non' }}</li>
                <li class="list-group-item"><strong>Rue:</strong> {{ $row->street }}</li>
                <li class="list-group-item"><strong>numéro de maison:</strong> {{ $row->no }}</li>
                <li class="list-group-item"><strong>numéro de Boite Postale:</strong> {{ $row->mail_box }}</li>
                <li class="list-group-item"><strong>Ville:</strong> {{ $row->city }}</li>
                <li class="list-group-item"><strong>Code Postal:</strong> {{ $row->postal_code }}</li>
=======
            <li class="list-group-item"><strong>Nom : </strong>{{ $row->last_name }}</li>
                <li class="list-group-item"><strong>Prénom : </strong>{{ $row->first_name }}</li>
                <li class="list-group-item"><strong>Numéro national : </strong>{{ $row->national_number }}</li>
                <li class="list-group-item"><strong>Médecin : </strong> {{ $row->medical_record }}</li>
                <li class="list-group-item"><strong>Médicaments:</strong> {{ $row->medecins }}</li>
                <li class="list-group-item"><strong>Quantité:</strong> {{ $row->quantity_medecine }}</li>
                <li class="list-group-item"><strong>Frequence :</strong> {{ $row->time_medecine }}</li>
                <li class="list-group-item"><strong>Consequences:</strong> {{ $row->allergies_consequences }}</li>
                <li class="list-group-item"><strong>Allergie:</strong> {{ $row->allergies }}</li>
                <li class="list-group-item"><strong>Date De Naissance:</strong> {{ $row->birth_date }}</li>
                <li class="list-group-item"><strong>Rue:</strong> {{ $row->street }}</li>
                <li class="list-group-item"><strong>Numéro de maison:</strong> {{ $row->no }}</li>
                <li class="list-group-item"><strong>Ville:</strong> {{ $row->city }}</li>
                <li class="list-group-item"><strong>Code Postal:</strong> {{ $row->postal_code }}</li>
                <li class="list-group-item"><strong>Pays:</strong> {{ $row->country }}</li>
>>>>>>> new_staging
                <li class="list-group-item"><strong>Note Extra: </strong>{{ $row->additional_infos }}</li>
            </ul>
        </div>
    </div>
</x-app-layout>