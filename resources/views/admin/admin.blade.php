<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>@yield('title')</title>
</head>

<body>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Active</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.professeur.index')}}">Professeurs</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.classe.index')}}">Classes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.matiere.index')}}">Matieres</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.eleve.index')}}">Eleves</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.note.index')}}">Notes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.bulletin.index')}}">Bulletins</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon"></i>
                <p class="black-text">
                    {{Auth::user()->nom_user}} {{Auth::user()->prenom}}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('profile.edit')}}" class="nav-link">
                        <i class="fas fa-user nav-icon" style="color: blue(0, 160,5);"></i>
                        <p>Mon Compte</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.professeur.index')}}" class="nav-link">
                        <i class="fas fa-user" style="color: blue(0, 160,5);"></i>
                        <p>Gérer les professeurs</p>
                    </a>
                    <li class="nav-item">
                        <a href="{{ route('admin.eleve.index')}}" class="nav-link">
                            <i class="fas fa-user" style="color: blue(0, 160,5);"></i>
                            <p>Gérer les élèves</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <!-- auth -->
                        <form class="nav-item" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <i class="fas fa-sign-out-alt nav-icon" style="color: blue(0, 160,5);"></i>
                            <button class="btn btn-reset"> logout</a>
                        </form>
                    </li>
                </li>

    </ul>
    <div class="container mt-5">
        @yield('content')
    </div>
</body>

</html>
