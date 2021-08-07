@component('mail::message')
    <p>
        Une demande de soumission a été formulée par:
    </p>
    <ul>
        <li>Nom : {{$request->name}}</li>
        <li>Courriel : <a href="mailto:{{$request->email}}">{{$request->email}}</a></li>
        <li>Adresse :<br>
            <a href="https://www.google.com/maps/place/{{$request->address}}+{{$request->city}}+{{$request->postal_code}}">
                {{$request->address}}<br>
                {{$request->city}} - {{$request->postal_code}}<br>
            </a>
        </li>
        <li>Telephone : <a href="tel:{{$request->telephone}}">{{$request->telephone}}</a></li>
        <li>Raison de recevoir un technicien chez le demandeur :<br>
            {{$request->request_for}}</li>
        <li>Info supplémentaire :<br>
            {{$request->additional_info}}
        </li>
    </ul>
    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
