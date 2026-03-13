<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DonaLink - Plateforme de dons</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { width: 100%; font-family: 'Segoe UI', sans-serif; background: #f0f4fa; }
        body { padding-top: 58px; }

        /* NAVBAR */
        .navbar {
            background: linear-gradient(135deg, #06142f, #08346b) !important;
            padding: 4px 0;
            position: fixed; top: 0; left: 0; right: 0;
            z-index: 1000; width: 100%;
        }
        .navbar-brand { font-size: 1.4rem; font-weight: 800; color: #99c8f8 !important; }
        .btn-nav-outline {
            border: 1.5px solid rgba(153,200,248,0.4);
            color: #99c8f8; border-radius: 10px;
            padding: 7px 14px; font-size: 0.82rem; font-weight: 600;
            text-decoration: none; display: inline-flex; align-items: center;
            gap: 6px; transition: all 0.2s; background: transparent; cursor: pointer;
        }
        .btn-nav-outline:hover { background: rgba(153,200,248,0.15); color: white; }
        .btn-nav-solid {
            background: #99c8f8; color: #06142f; border: none; border-radius: 10px;
            padding: 7px 14px; font-size: 0.82rem; font-weight: 700;
            text-decoration: none; display: inline-flex; align-items: center;
            gap: 6px; transition: all 0.2s;
        }
        .btn-nav-solid:hover { background: white; color: #06142f; }

        /* HERO */
        .hero {
            background: linear-gradient(rgba(6,20,47,0.35), rgba(8,52,107,0.35)),
                url('/images/hero.jpg') center center/cover no-repeat;
            color: white; padding: 100px 0;
            min-height: 100vh; display: flex; align-items: center; width: 100%;
        }
        .hero h1 { font-size: 3rem; font-weight: 800; line-height: 1.2; margin-bottom: 20px; }
        .hero p { font-size: 1.1rem; opacity: 0.85; margin-bottom: 36px; }

        .btn-hero-main {
            background: #99c8f8; color: #06142f; border: none; border-radius: 12px;
            padding: 14px 28px; font-size: 1rem; font-weight: 700;
            text-decoration: none; display: inline-flex; align-items: center;
            gap: 9px; transition: all 0.2s; box-shadow: 0 6px 20px rgba(153,200,248,0.3);
        }
        .btn-hero-main:hover { background: white; color: #06142f; transform: translateY(-2px); }
        .btn-hero-outline {
            background: transparent; color: white;
            border: 2px solid rgba(255,255,255,0.4); border-radius: 12px;
            padding: 14px 28px; font-size: 1rem; font-weight: 600;
            text-decoration: none; display: inline-flex; align-items: center;
            gap: 9px; transition: all 0.2s;
        }
        .btn-hero-outline:hover { background: rgba(255,255,255,0.12); color: white; }

        /* STATS */
        .stats-section { padding: 60px 0; }
        .stat-card {
            background: white; border-radius: 18px; padding: 30px 20px;
            text-align: center; border: 1px solid #dce8f5;
            box-shadow: 0 4px 20px rgba(6,20,47,0.07);
        }
        .stat-icon {
            width: 52px; height: 52px; border-radius: 14px;
            background: #dce8f5; color: #08346b;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem; margin: 0 auto 16px auto;
        }
        .stat-number { font-size: 2.2rem; font-weight: 800; color: #06142f; line-height: 1; }
        .stat-label { font-size: 0.82rem; color: #6196d1; margin-top: 6px; }

        /* CAMPAGNES */
        .campagnes-section { padding: 20px 0 60px; }
        .section-title-wrap { text-align: center; margin-bottom: 40px; }
        .section-title-wrap h2 { font-size: 1.8rem; font-weight: 800; color: #06142f; }
        .section-title-wrap p { color: #6196d1; font-size: 0.9rem; margin-top: 6px; }

        .camp-card {
            background: white; border-radius: 16px; border: 1px solid #dce8f5;
            box-shadow: 0 2px 8px rgba(6,20,47,0.05);
            transition: all 0.2s; overflow: hidden; display: flex; flex-direction: column;
        }
        .camp-card:hover { transform: translateY(-5px); box-shadow: 0 12px 30px rgba(6,20,47,0.12); border-color: #6196d1; }
        .camp-card img { height: 200px; object-fit: cover; width: 100%; }
        .camp-placeholder {
            height: 200px; background: linear-gradient(135deg, #dce8f5, #f0f4fa);
            display: flex; align-items: center; justify-content: center;
        }
        .camp-placeholder i { font-size: 3rem; color: #99c8f8; opacity: 0.6; }
        .camp-card-body { padding: 22px; flex: 1; display: flex; flex-direction: column; }
        .camp-badges { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; }
        .badge-fin { background: #dce8f5; color: #08346b; padding: 4px 10px; border-radius: 20px; font-size: 0.72rem; font-weight: 700; }
        .badge-mat { background: #e8f0fa; color: #2d5f9a; padding: 4px 10px; border-radius: 20px; font-size: 0.72rem; font-weight: 700; }
        .camp-date { font-size: 0.75rem; color: #99c8f8; display: flex; align-items: center; gap: 5px; }
        .camp-titre { font-size: 1rem; font-weight: 800; color: #06142f; margin-bottom: 8px; }
        .camp-desc { font-size: 0.82rem; color: #6196d1; line-height: 1.5; margin-bottom: 16px; flex: 1; }
        .progress-track { background: #f0f4fa; border-radius: 10px; height: 6px; overflow: hidden; margin-bottom: 6px; }
        .progress-fill { height: 100%; border-radius: 10px; background: linear-gradient(90deg, #08346b, #6196d1); }
        .progress-nums { display: flex; justify-content: space-between; font-size: 0.75rem; color: #6196d1; margin-bottom: 16px; }
        .progress-nums span:first-child { font-weight: 700; color: #08346b; }
        .btn-don {
            background: linear-gradient(135deg, #06142f, #08346b);
            color: #99c8f8; border: none; border-radius: 10px;
            padding: 11px; font-size: 0.88rem; font-weight: 700;
            text-decoration: none; display: flex; align-items: center;
            justify-content: center; gap: 8px; transition: all 0.2s;
            cursor: pointer; width: 100%; box-shadow: 0 4px 12px rgba(6,20,47,0.2);
        }
        .btn-don:hover { opacity: 0.9; color: white; transform: translateY(-1px); }

        /* FOOTER */
        footer {
            background: linear-gradient(135deg, #06142f, #08346b);
            color: #99c8f8; padding: 40px 0; text-align: center;
        }
        footer p { opacity: 0.7; font-size: 0.88rem; margin-bottom: 6px; margin-top: 10px; }
        footer small { opacity: 0.45; font-size: 0.78rem; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            body { padding-top: 52px; }

            /* Navbar */
            .navbar { padding: 3px 0; }
            .btn-nav-outline { padding: 6px 10px; font-size: 0.75rem; gap: 4px; }
            .btn-nav-solid { padding: 6px 10px; font-size: 0.75rem; }
            .navbar-brand img { height: 38px !important; }

            /* Hero */
            .hero { padding: 60px 0; min-height: 80vh; }
            .hero h1 { font-size: 1.8rem; }
            .hero p { font-size: 0.92rem; }
            .btn-hero-main, .btn-hero-outline { padding: 12px 20px; font-size: 0.88rem; }

            /* Stats */
            .stats-section { padding: 40px 0; }
            .stat-number { font-size: 1.7rem; }

            /* Campagnes */
            .section-title-wrap h2 { font-size: 1.4rem; }
            .camp-card { margin-bottom: 4px; }

            /* Footer */
            footer { padding: 30px 15px; }
            footer img { height: 40px !important; }
        }

        @media (max-width: 480px) {
            .hero h1 { font-size: 1.5rem; }
            .hero p { font-size: 0.85rem; }
            .d-flex.gap-3 { flex-direction: column; align-items: center; }
            .btn-hero-main, .btn-hero-outline { width: 100%; justify-content: center; }
            .stat-card { padding: 20px 15px; }
            .stat-number { font-size: 1.5rem; }
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('images/lol.png') }}"
            style="height:50px; object-fit:contain; border-radius:6px; padding:1px 3px;">
        </a>
        <div class="ms-auto d-flex gap-2">
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="/dashboard" class="btn-nav-outline">
                        <i class="fas fa-chart-pie"></i> <span class="d-none d-sm-inline">Dashboard</span>
                    </a>
                @else
                    <a href="/mes-dons" class="btn-nav-outline">
                        <i class="fas fa-heart"></i> <span class="d-none d-sm-inline">Mes dons</span>
                    </a>
                @endif
                <form method="POST" action="/logout" class="d-inline">
                    @csrf
                    <button class="btn-nav-outline">
                        <i class="fas fa-sign-out-alt"></i> <span class="d-none d-sm-inline">Déconnexion</span>
                    </button>
                </form>
            @else
                <a href="/login" class="btn-nav-outline"><span class="d-none d-sm-inline">Connexion</span><i class="fas fa-sign-in-alt d-sm-none"></i></a>
                <a href="/register" class="btn-nav-solid"><span class="d-none d-sm-inline">S'inscrire</span><i class="fas fa-user-plus d-sm-none"></i></a>
            @endauth
        </div>
    </div>
</nav>

<!-- HERO -->
<div class="hero">
    <div class="container text-center">
        <h1>Donnez, Partagez,<br>Changez des vies</h1>
        <p>DonaLink connecte les donateurs aux associations caritatives.<br>
        Faites un don financier ou matériel et suivez son impact en temps réel.</p>
        @guest
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="/register" class="btn-hero-main">
                    <i class="fas fa-heart"></i> Faire un don
                </a>
                <a href="/login" class="btn-hero-outline">
                    <i class="fas fa-sign-in-alt"></i> Se connecter
                </a>
            </div>
        @else
            <a href="/dons/create" class="btn-hero-main">
                <i class="fas fa-heart"></i> Faire un don maintenant
            </a>
        @endguest
    </div>
</div>

<!-- STATISTIQUES -->
<div class="stats-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-4">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-bullhorn"></i></div>
                    <div class="stat-number">{{ $totalCampagnes }}</div>
                    <div class="stat-label">Campagnes actives</div>
                </div>
            </div>
            <div class="col-4">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                    <div class="stat-number">{{ $totalDonateurs }}</div>
                    <div class="stat-label">Donateurs inscrits</div>
                </div>
            </div>
            <div class="col-4">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-coins"></i></div>
                    <div class="stat-number">{{ number_format($totalCollecte, 0, ',', ' ') }} F</div>
                    <div class="stat-label">Total collecté</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CAMPAGNES -->
<div class="campagnes-section">
    <div class="container">
        <div class="section-title-wrap">
            <h2>Campagnes en cours</h2>
            <p>Soutenez les causes qui vous tiennent à cœur</p>
        </div>

        @if($campagnes->isEmpty())
            <p style="text-align:center; color:#6196d1;">Aucune campagne active pour le moment.</p>
        @else
            <div class="row g-4">
                @foreach($campagnes as $campagne)
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="camp-card">
                        @if($campagne->image)
                            <img src="{{ asset('storage/' . $campagne->image) }}" alt="{{ $campagne->titre }}">
                        @else
                            <div class="camp-placeholder">
                                <i class="fas fa-hand-holding-heart"></i>
                            </div>
                        @endif
                        <div class="camp-card-body">
                            <div class="camp-badges">
                                @if($campagne->type == 'financiere')
                                    <span class="badge-fin">Financière</span>
                                @else
                                    <span class="badge-mat">Matérielle</span>
                                @endif
                                @if($campagne->date_fin)
                                    <span class="camp-date">
                                        <i class="fas fa-clock"></i>
                                        {{ \Carbon\Carbon::parse($campagne->date_fin)->format('d/m/Y') }}
                                    </span>
                                @endif
                            </div>
                            <div class="camp-titre">{{ $campagne->titre }}</div>
                            <div class="camp-desc">
                                {{ \Illuminate\Support\Str::limit($campagne->description, 80) }}
                            </div>
                            @if($campagne->type == 'financiere' && is_numeric($campagne->objectif_montant) && $campagne->objectif_montant > 0)
                                @php $progression = min(100, ($campagne->montant_collecte / $campagne->objectif_montant) * 100); @endphp
                                <div class="progress-track">
                                    <div class="progress-fill" style="width:{{ $progression }}%"></div>
                                </div>
                                <div class="progress-nums">
                                    <span>{{ number_format($campagne->montant_collecte, 0, ',', ' ') }} F</span>
                                    <span>{{ number_format($progression, 0) }}%</span>
                                </div>
                            @endif
                            @auth
                                <a href="/dons/create" class="btn-don">
                                    <i class="fas fa-heart"></i> Faire un don
                                </a>
                            @else
                                <a href="/register" class="btn-don">
                                    <i class="fas fa-heart"></i> Faire un don
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<!-- FOOTER -->
<footer>
    <div class="container">
        <img src="{{ asset('images/lol.png') }}"
            style="height:50px; object-fit:contain; border-radius:6px; padding:1px 3px;">
        <p>Plateforme de gestion de dons pour associations caritatives</p>
        <small>© {{ date('Y') }} DonaLink. Tous droits réservés.</small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>