<!doctype html>
<html lang="en">
    <head>
        <title>Laravel Multiple Images Upload Using Dropzone</title>
        <meta name="_token" content="{{csrf_token()}}" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
        
        
    </head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="navbar-brand" href="{{ route('dropzone.create') }}">Télécharger</a>
                </li>
                <li class="nav-item">
                    <a class="navbar-brand" href="{{ route('dropzone.create') }}">Importer les images</a>
                </li>
                <li class="nav-item">
                    <a class="navbar-brand" href="{{ route('dropzone.show') }}">Afficher les fichiers téléchargés</a>
                </li>
            </ul>
        </div>
    </nav>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="container-fluid">
        @yield('content')
    </div>
 
    
    <script src="{{asset('js/dropzoneConfig.js')}}"></script>
</body>
</html>