<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ $title ?? config('app.name', 'Laravel') }}</title>

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
