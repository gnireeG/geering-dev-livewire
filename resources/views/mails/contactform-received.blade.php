<x-layouts.mail>
    
    <h1>Kontaktformular wurde ausgefüllt</h1>

    @if(!empty($contactform->created_at))
        <p><strong>Erstellt am:</strong> {{ $contactform->created_at }}</p>
    @endif

    @if(!empty($contactform->first_name))
        <p><strong>Vorname:</strong> {{ $contactform->first_name }}</p>
    @endif
    @if(!empty($contactform->last_name))
        <p><strong>Nachname:</strong> {{ $contactform->last_name }}</p>
    @endif
    @if(!empty($contactform->email))
        <p><strong>Email:</strong> {{ $contactform->email }}</p>
    @endif
    @if(!empty($contactform->phone))
        <p><strong>Telefon:</strong> {{ $contactform->phone }}</p>
    @endif
    @if(!empty($contactform->needs))
        <p><strong>Bedarf:</strong> 
            @php $needs = json_decode($contactform->needs, true); @endphp
            @if(!empty($needs['website'])) Website @endif
            @if(!empty($needs['webapp'])) Webapp @endif
            @if(!empty($needs['online_shop'])) Onlineshop @endif
            @if(!empty($needs['other'])) Sonstiges @endif
        </p>
    @endif
    @if(!empty($contactform->needs_other))
        <p><strong>Sonstiges (Bedarf):</strong><br>{{ $contactform->needs_other }}</p>
    @endif
    @if(!empty($contactform->has_website))
        <p><strong>Hat bereits Website:</strong><br>{{ $contactform->has_website ? 'Ja' : 'Nein' }}</p>
    @endif
    @if(!empty($contactform->existing_website))
        <p><strong>Bestehende Website:</strong><br>{{ $contactform->existing_website }}</p>
    @endif
    @if(!empty($contactform->website_likes))
        <p><strong>Was gefällt an Webseiten</strong><br>{{ $contactform->website_likes }}</p>
    @endif
    @if(!empty($contactform->website_dislikes))
        <p><strong>Was gefällt nicht an Webseiten</strong><br>{{ $contactform->website_dislikes }}</p>
    @endif
    @if(!empty($contactform->webshop_products))
        <p><strong>Webshop Produkte:</strong><br>{{ $contactform->webshop_products }}</p>
    @endif
    @if(!empty($contactform->webshop_location))
        <p><strong>Webshop Standort:</strong><br>{{ $contactform->webshop_location }}</p>
    @endif
    @if(!empty($contactform->description))
        <p><strong>Beschreibung:</strong><br>{{ $contactform->description }}</p>
    @endif
    <a class="c2a-link" href="{{ route('contactform.detail', $contactform->id) }}">View Contact Form</a>
    <style>
        .c2a-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
    </style>
</x-layouts.mail>