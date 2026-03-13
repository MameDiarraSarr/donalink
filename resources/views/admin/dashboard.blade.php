<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - DonaLink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f0f4fa; min-height: 100vh; }

        /* SIDEBAR */
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #06142f 0%, #08346b 60%, #2d5f9a 100%);
            width: 255px; position: fixed; top: 0; left: 0;
            display: flex; flex-direction: column; z-index: 200;
            transition: transform 0.3s ease;
        }
        .sidebar-logo {
            padding: 15px 24px;
            border-bottom: 1px solid rgba(153,200,248,0.15);
            display: flex; align-items: center;
        }
        .sidebar-menu { padding: 12px 0; flex: 1; }
        .sidebar-menu a {
            color: rgba(153,200,248,0.8); text-decoration: none;
            display: flex; align-items: center; gap: 12px;
            padding: 12px 24px; font-size: 0.88rem; font-weight: 500;
            transition: all 0.2s; border-left: 3px solid transparent;
        }
        .sidebar-menu a:hover { background: rgba(153,200,248,0.1); color: white; border-left-color: #6196d1; }
        .sidebar-menu a.active { background: rgba(153,200,248,0.15); color: white; border-left-color: #99c8f8; }
        .sidebar-menu a i { width: 18px; text-align: center; font-size: 0.9rem; }
        .sidebar-divider { border-color: rgba(153,200,248,0.15); margin: 8px 24px; }
        .sidebar-bottom { padding: 16px 24px 24px; }
        .btn-logout-side {
            background: rgba(153,200,248,0.12); color: #99c8f8;
            border: 1px solid rgba(153,200,248,0.2); border-radius: 10px;
            padding: 10px 16px; font-size: 0.85rem; font-weight: 600;
            width: 100%; cursor: pointer; transition: all 0.2s;
            display: flex; align-items: center; gap: 8px;
        }
        .btn-logout-side:hover { background: rgba(153,200,248,0.22); color: white; }

        /* TOPBAR MOBILE */
        .mobile-topbar {
            display: none;
            position: fixed; top: 0; left: 0; right: 0;
            background: linear-gradient(135deg, #06142f, #08346b);
            padding: 10px 16px;
            align-items: center; justify-content: space-between;
            z-index: 300; height: 58px;
        }
        .btn-menu-toggle {
            background: rgba(153,200,248,0.15); border: none;
            color: #99c8f8; border-radius: 8px;
            width: 38px; height: 38px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem; cursor: pointer;
        }

        /* OVERLAY */
        .sidebar-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(6,20,47,0.5);
            z-index: 150;
        }
        .sidebar-overlay.active { display: block; }

        /* MAIN */
        .main-content {
            margin-left: 255px;
            padding: 35px 40px;
            min-height: 100vh;
        }

        .page-header {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 30px;
        }
        .page-header h4 { font-size: 1.5rem; font-weight: 800; color: #06142f; margin-bottom: 3px; }
        .page-header small { color: #6196d1; font-size: 0.88rem; }
        .badge-admin {
            background: linear-gradient(135deg, #06142f, #08346b);
            color: #99c8f8; padding: 7px 16px; border-radius: 20px;
            font-size: 0.78rem; font-weight: 700; letter-spacing: 0.5px;
        }

        /* STAT CARDS */
        .stat-card {
            border-radius: 16px; padding: 24px; color: white; border: none;
            display: flex; justify-content: space-between; align-items: center;
            box-shadow: 0 4px 15px rgba(6,20,47,0.15); transition: all 0.2s;
        }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(6,20,47,0.2); }
        .stat-card .number { font-size: 1.9rem; font-weight: 800; line-height: 1; }
        .stat-card .label { font-size: 0.8rem; opacity: 0.85; margin-top: 6px; }
        .stat-card .icon { font-size: 2.2rem; opacity: 0.25; }
        .stat-1 { background: linear-gradient(135deg, #06142f, #08346b); }
        .stat-2 { background: linear-gradient(135deg, #08346b, #2d5f9a); }
        .stat-3 { background: linear-gradient(135deg, #2d5f9a, #6196d1); }
        .stat-4 { background: linear-gradient(135deg, #6196d1, #99c8f8); color: #06142f; }
        .stat-4 .label { opacity: 0.7; color: #06142f; }
        .stat-4 .icon { opacity: 0.2; }

        /* TABLE */
        .table-card {
            background: white; border-radius: 20px;
            box-shadow: 0 4px 20px rgba(6,20,47,0.07);
            overflow: hidden; border: 1px solid #dce8f5;
        }
        .table-card-header {
            padding: 22px 28px 18px; border-bottom: 1px solid #dce8f5;
            display: flex; align-items: center; gap: 10px;
        }
        .table-card-header h5 { font-size: 1rem; font-weight: 800; color: #06142f; margin: 0; }
        .count-badge {
            background: #dce8f5; color: #08346b; border-radius: 20px;
            padding: 3px 10px; font-size: 0.75rem; font-weight: 700;
        }
        .table { margin: 0; }
        .table thead th {
            background: #f0f4fa; color: #2d5f9a; font-size: 0.72rem;
            font-weight: 700; text-transform: uppercase; letter-spacing: 1px;
            padding: 12px 16px; border: none;
        }
        .table tbody td {
            padding: 14px 16px; vertical-align: middle;
            color: #06142f; font-size: 0.88rem; border-color: #f0f4fa;
        }
        .table tbody tr:hover { background: #f8fbff; }
        .badge-fin { background: #dce8f5; color: #08346b; padding: 4px 10px; border-radius: 20px; font-size: 0.72rem; font-weight: 700; }
        .badge-mat { background: #e8f0fa; color: #2d5f9a; padding: 4px 10px; border-radius: 20px; font-size: 0.72rem; font-weight: 700; }
        .btn-confirmer {
            background: linear-gradient(135deg, #06142f, #08346b); color: #99c8f8;
            border: none; border-radius: 8px; padding: 6px 12px;
            font-size: 0.78rem; font-weight: 600; cursor: pointer; transition: all 0.2s;
        }
        .btn-confirmer:hover { opacity: 0.85; }
        .btn-annuler {
            background: #fde8e8; color: #c0392b; border: none; border-radius: 8px;
            padding: 6px 12px; font-size: 0.78rem; font-weight: 600; cursor: pointer; transition: all 0.2s;
        }
        .btn-annuler:hover { background: #fbc9c9; }
        .empty-state { text-align: center; padding: 50px 20px; color: #6196d1; }
        .empty-state i { font-size: 2.5rem; margin-bottom: 12px; opacity: 0.4; }

        /* Carte don mobile */
        .don-mobile-card {
            background: white; border-radius: 14px; border: 1px solid #dce8f5;
            padding: 16px; margin-bottom: 12px;
            box-shadow: 0 2px 8px rgba(6,20,47,0.05);
        }
        .don-mobile-card .don-name { font-weight: 700; color: #06142f; font-size: 0.9rem; }
        .don-mobile-card .don-meta { color: #6196d1; font-size: 0.78rem; margin-top: 4px; }
        .don-mobile-card .don-actions { display: flex; gap: 8px; margin-top: 12px; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .mobile-topbar { display: flex; }
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-content { margin-left: 0; padding: 75px 16px 30px; }
            .page-header { flex-direction: column; align-items: flex-start; gap: 10px; }
            .page-header h4 { font-size: 1.2rem; }
            .stat-card .number { font-size: 1.3rem; }
            .stat-card .icon { font-size: 1.5rem; }
            .stat-card { padding: 16px; }
            .table-responsive { border-radius: 0; }
            .table thead { display: none; }
            .table, .table tbody, .table tr, .table td { display: block; width: 100%; }
            .table tbody tr { border-bottom: 1px solid #f0f4fa; padding: 8px 0; }
            .table-card { display: none; }
            .don-mobile-cards { display: block !important; }
        }

        @media (min-width: 769px) {
            .don-mobile-cards { display: none; }
        }

        @media (max-width: 480px) {
            .row.g-4 > div { flex: 0 0 50%; max-width: 50%; }
            .stat-card .number { font-size: 1.1rem; }
            .stat-card .label { font-size: 0.7rem; }
        }
    </style>
</head>
<body>

<!-- TOPBAR MOBILE -->
<div class="mobile-topbar">
    <button class="btn-menu-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>
    <img src="{{ asset('images/lol.png') }}" style="height:36px; object-fit:contain; border-radius:5px; padding:1px 3px;">
    <div style="width:38px;"></div>
</div>

<!-- OVERLAY -->
<div class="sidebar-overlay" id="overlay" onclick="toggleSidebar()"></div>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <img src="{{ asset('images/lol.png') }}"
            style="height:50px; object-fit:contain; border-radius:6px; padding:1px 3px;">
    </div>
    <div class="sidebar-menu">
        <a href="/dashboard" class="active"><i class="fas fa-chart-pie"></i> Dashboard</a>
        <a href="/campagnes"><i class="fas fa-bullhorn"></i> Campagnes</a>
        <a href="/dons"><i class="fas fa-hand-holding-heart"></i> Dons</a>
        <a href="/beneficiaires"><i class="fas fa-users"></i> Bénéficiaires</a>
        <a href="/distributions"><i class="fas fa-box-open"></i> Distributions</a>
        <hr class="sidebar-divider">
        <a href="/"><i class="fas fa-home"></i> Accueil</a>
    </div>
    <hr class="sidebar-divider">
    <div class="sidebar-bottom">
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="btn-logout-side">
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </button>
        </form>
    </div>
</div>

<!-- CONTENU -->
<div class="main-content">

    <div class="page-header">
        <div>
            <h4>Tableau de bord</h4>
        </div>
        <span class="badge-admin">Administrateur</span>
    </div>

    <!-- STATS -->
    <div class="row g-3 g-md-4 mb-4">
        <div class="col-6 col-md-3">
            <div class="stat-card stat-1">
                <div>
                    <div class="number">{{ number_format($totalDonsFinanciers, 0, ',', ' ') }} F</div>
                    <div class="label">Dons financiers</div>
                </div>
                <div class="icon"><i class="fas fa-money-bill-wave"></i></div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card stat-2">
                <div>
                    <div class="number">{{ $totalDonsMateriel }}</div>
                    <div class="label">Dons matériels</div>
                </div>
                <div class="icon"><i class="fas fa-box"></i></div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card stat-3">
                <div>
                    <div class="number">{{ $totalDonateurs }}</div>
                    <div class="label">Donateurs</div>
                </div>
                <div class="icon"><i class="fas fa-users"></i></div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card stat-4">
                <div>
                    <div class="number">{{ $totalCampagnes }}</div>
                    <div class="label">Campagnes</div>
                </div>
                <div class="icon"><i class="fas fa-bullhorn"></i></div>
            </div>
        </div>
    </div>

    <!-- TABLE DESKTOP -->
    <div class="table-card">
        <div class="table-card-header">
            <h5>Dons en attente de validation</h5>
            @if(!$donsEnAttente->isEmpty())
                <span class="count-badge">{{ $donsEnAttente->count() }}</span>
            @endif
        </div>
        @if($donsEnAttente->isEmpty())
            <div class="empty-state">
                <div><i class="fas fa-check-circle"></i></div>
                <p>Aucun don en attente — tout est à jour</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Donateur</th>
                            <th>Campagne</th>
                            <th>Type</th>
                            <th>Montant / Objet</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($donsEnAttente as $don)
                        <tr>
                            <td>
                                @if($don->anonyme)
                                    <span style="color:#6196d1; font-style:italic;">Anonyme</span>
                                @else
                                    <strong>{{ $don->user->name }}</strong>
                                @endif
                            </td>
                            <td>{{ $don->campagne->titre }}</td>
                            <td>
                                @if($don->type == 'financier')
                                    <span class="badge-fin">Financier</span>
                                @else
                                    <span class="badge-mat">Matériel</span>
                                @endif
                            </td>
                            <td>
                                @if($don->type == 'financier')
                                    <strong>{{ number_format($don->montant, 0, ',', ' ') }} F</strong>
                                @else
                                    {{ $don->description_materiel }}
                                @endif
                            </td>
                            <td style="color:#6196d1;">{{ $don->created_at->format('d/m/Y') }}</td>
                            <td>
                                <form action="/dons/{{ $don->id }}" method="POST" class="d-inline">
                                    @csrf @method('PATCH')
                                    <button class="btn-confirmer">✅ Confirmer</button>
                                </form>
                                <form action="/dons/{{ $don->id }}" method="POST" class="d-inline ms-1">
                                    @csrf @method('DELETE')
                                    <button class="btn-annuler">❌ Annuler</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- CARDS MOBILE -->
    <div class="don-mobile-cards" style="display:none;">
        <div style="font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:2px; color:#6196d1; margin-bottom:12px;">
            Dons en attente
            @if(!$donsEnAttente->isEmpty())
                <span class="count-badge ms-2">{{ $donsEnAttente->count() }}</span>
            @endif
        </div>
        @if($donsEnAttente->isEmpty())
            <div class="empty-state">
                <i class="fas fa-check-circle"></i>
                <p>Aucun don en attente</p>
            </div>
        @else
            @foreach($donsEnAttente as $don)
            <div class="don-mobile-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="don-name">
                            @if($don->anonyme) <span style="color:#6196d1; font-style:italic;">Anonyme</span>
                            @else {{ $don->user->name }} @endif
                        </div>
                        <div class="don-meta">{{ $don->campagne->titre }}</div>
                        <div class="don-meta">{{ $don->created_at->format('d/m/Y') }}</div>
                    </div>
                    <div style="text-align:right;">
                        @if($don->type == 'financier')
                            <span class="badge-fin">Financier</span>
                            <div style="font-weight:800; color:#08346b; margin-top:4px;">{{ number_format($don->montant, 0, ',', ' ') }} F</div>
                        @else
                            <span class="badge-mat">Matériel</span>
                            <div style="font-size:0.8rem; color:#06142f; margin-top:4px;">{{ $don->description_materiel }}</div>
                        @endif
                    </div>
                </div>
                <div class="don-actions">
                    <form action="/dons/{{ $don->id }}" method="POST" style="flex:1;">
                        @csrf @method('PATCH')
                        <button class="btn-confirmer w-100">✅ Confirmer</button>
                    </form>
                    <form action="/dons/{{ $don->id }}" method="POST" style="flex:1;">
                        @csrf @method('DELETE')
                        <button class="btn-annuler w-100">❌ Annuler</button>
                    </form>
                </div>
            </div>
            @endforeach
        @endif
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('overlay').classList.toggle('active');
    }
</script>
</body>
</html>