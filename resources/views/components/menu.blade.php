<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
            <a href="{{ route("home") }}" class="nav-link {{ setMenuActive("home") }}">
                <i class="nav-icon fas fa-home"></i>
                <p>
                    Accueil
                </p>
            </a>
        </li>

        @can("Manager")
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Tableau de bord
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>Vue globale</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-swatchbook"></i>
                        <p>Locations</p>
                    </a>
                </li>
            </ul>
        </li>
        @endcan

        @can("Admin")
        <li class="nav-item {{setMenuClass("Admin.habilitations.", "menu-open")}}">
            <a href="#" class="nav-link {{setMenuClass("Admin.habilitations", "active")}}">
                <i class=" nav-icon fas fa-user-shield"></i>
                <p>
                    Habilitations
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item ">
                    <a
                        href="{{ route("Admin.habilitations.users.index") }}"
                        class="nav-link {{ setMenuClass('Admin.habilitations.users.index', 'active') }}">
                        <i class=" nav-icon fas fa-users-cog"></i>
                        <p>Utilisateurs</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-fingerprint"></i>
                        <p>Roles et permissions</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item {{setMenuClass("Admin.gestion-article.", "menu-open")}}">
            <a href="#" class="nav-link {{setMenuClass("Admin.gestion-article", "active")}}">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                    Gestion articles
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route("Admin.gestion-article.typesarticles") }}"
                       class="nav-link {{ setMenuClass('Admin.gestion-article.typesarticles', 'active') }}">
                        <i class="nav-icon far fa-circle"></i>
                        <p>Type d'articles</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("Admin.gestion-article.articles") }}"
                       class="nav-link {{ setMenuClass('Admin.gestion-article.articles', 'active') }}">
                        <i class="nav-icon fas fa-list-ul"></i>
                        <p>Articles</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-sliders-h"></i>
                        <p>Tarifications</p>
                    </a>
                </li>

            </ul>
        </li>
        @endcan

        @can("Employer")
        <li class="nav-header">LOCATION</li>
        <li class="nav-item">
            <a href="#" class="nav-link ">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Gestion des clients
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-exchange-alt"></i>
                <p>
                    Gestion des locations
                </p>
            </a>
        </li>

        <li class="nav-header">CAISSE</li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-coins"></i>
                <p>
                    Gestion des paiements
                </p>
            </a>
        </li>
        @endcan
    </ul>
</nav>
