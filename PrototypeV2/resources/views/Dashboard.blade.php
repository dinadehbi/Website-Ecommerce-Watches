<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    @vite(['resources/js/app.js'])
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Accueil</a>
                </li>
            </ul>
        </nav>

        <!-- Barre latérale (Sidebar) -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">
                <span class="brand-text font-weight-light">AdminLTE</span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Tableau de Bord</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Utilisateurs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>Paramètres</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Contenu principal -->
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <h1>Bienvenue sur le Dashboard</h1>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Carte Statistique -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>150</h3>
                                    <p>Nouveaux Utilisateurs</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <a href="#" class="small-box-footer">Plus d'infos <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>53%</h3>
                                    <p>Taux de conversion</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-chart-pie"></i>
                                </div>
                                <a href="#" class="small-box-footer">Plus d'infos <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>44</h3>
                                    <p>Messages non lus</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <a href="#" class="small-box-footer">Plus d'infos <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2025</strong>
            Tous droits réservés.
        </footer>
    </div>

    <!-- Scripts JS -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            console.log("AdminLTE chargé !");
        });
    </script>
</body>
</html>
