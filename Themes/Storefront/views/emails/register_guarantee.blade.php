@component('mail::message')
    <p>
        Une demande d'enregsitrement de garantie a été formulée :
    </p>
    <ul>
        <li>Nom : {{$request->name}}</li>
        <li>Courriel : <a href="mailto:{{$request->email}}">{{$request->email}}</a></li>
        <li>Adresse :<br>
            <a href="https://www.google.com/maps/place/{{$request->address}}+{{$request->city}}+{{$request->postal_code}}+{{$request->province}}">
                {{$request->address}}<br>
                {{$request->city}} - {{$request->province}} {{$request->postal_code}}
            </a>
        </li>
        <li>Telephone : <a href="tel:{{$request->telephone}}">{{$request->telephone}}</a></li>
        <li>
            Information sur le produit :
            <ul>
                <li>
                    Fabricant : {{$request->make}}
                </li>
                <li>
                    Modèle : {{$request->model}}
                </li>
                <li>
                    Numéro de série : {{$request->serial_number}}
                </li>
                <li>
                    Date d’achat : {{$request->date_of_purchase}}
                </li>
                <li>
                    Numéro de facture : {{$request->invoice_number}}
                </li>
                <li>
                    Prix payé : {{$request->price_paid}}
                </li>
                <li>
                    Numéro d’enregistrement attribué et/ou numéro de la garantie 25 ans (si applicable, valide seulement
                    pour les aspirateurs Sebo et/ou Cyclovac et Mvac) : {{$request->assigned_registration_number}}
                </li>
            </ul>
        </li>
    </ul>
    <h4>
        Réponses du sondage :
    </h4>
    <ul>
        <li>
            Comment évaluez-vous le service reçu en magasin? :<br>
            <b style="font-size: larger">{{$request->service_received}}/10</b>
        </li>
        <li>
            Quelle est votre niveau de satisfaction sur les réponses à vos questions :<br>
            <b style="font-size: larger">{{$request->satisfied_answers_questions}}/10</b>
        </li>
        <li>
            Quelle est votre niveau de satisfaction sur les explications du fonctionnement de votre aspirateur ainsi que
            l’entretien nécessaire?:<br>
            <b style="font-size: larger">{{$request->satisfied_explanations_vacuum}}/10</b>
        </li>
        <li>
            Quelle est votre niveau de satisfaction sur les explications du fonctionnement de votre aspirateur ainsi que
            l’entretien nécessaire?:<br>
            <b style="font-size: larger">{{$request->satisfied_explanations_vacuum}}/10</b>
        </li>
        <li>
            Quelle sont les chances que vous nous recommandiez à vos amis et votre familles?:<br>
            <b style="font-size: larger">{{$request->recommend_to_friends}}/10</b>
        </li>
    </ul>
    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
