<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $campagne->titre }} - DonaLink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0f4fa;
            min-height: 100vh;
        }

        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #06142f 0%, #08346b 60%, #2d5f9a 100%);
            width: 255px;
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            z-index: 200;
            transition: transform 0.3s ease;
        }
        .sidebar-logo {
            padding: 15px 24px;
            border-bottom: 1px solid rgba(153,200,248,0.15);
            display: flex;
            align-items: center;
        }
        .sidebar-menu { padding: 12px 0; flex: 1; }
        .sidebar-menu a {
            color: rgba(153,200,248,0.8);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 24px;
            font-size: 0.88rem;
            font-weight: 500;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }
        .sidebar-menu a:hover { background: rgba(153,200,248,0.1); color: white; border-left-color: #6196d1; }
        .sidebar-menu a.active { background: rgba(153,200,248,0.15); color: white; border-left-color: #99c8f8; }
        .sidebar-menu a i { width: 18px; text-align: center; font-size: 0.9rem; }
        .sidebar-divider { border-color: rgba(153,200,248,0.15); margin: 8px 24px; }
        .sidebar-bottom { padding: 16px 24px 24px; }
        .btn-logout-side {
            background: rgba(153,200,248,0.12);
            color: #99c8f8;
            border: 1px solid rgba(153,200,248,0.2);
            border-radius: 10px;
            padding: 10px 16px;
            font-size: 0.85rem;
            font-weight: 600;
            width: 100%;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .btn-logout-side:hover { background: rgba(153,200,248,0.22); color: white; }

        .main-content { margin-left: 255px; padding: 35px 40px; }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }
        .page-header h4 { font-size: 1.5rem; font-weight: 800; color: #06142f; margin-bottom: 3px; }
        .page-header small { color: #6196d1; font-size: 0.88rem; }

        .btn-back {
            background: white;
            color: #2d5f9a;
            border: 1.5px solid #dce8f5;
            border-radius: 10px;
            padding: 9px 18px;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            transition: all 0.2s;
        }
        .btn-back:hover { background: #dce8f5; color: #08346b; }

        .btn-edit {
            background: linear-gradient(135deg, #06142f, #08346b);
            color: #99c8f8;
            border: none;
            border-radius: 10px;
            padding: 9px 18px;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(6,20,47,0.2);
        }
        .btn-edit:hover { opacity: 0.9; color: white; }

        /* CARDS */
        .info-card {
            background: white;
            border-radius: 18px;
            border: 1px solid #dce8f5;
            box-shadow: 0 4px 20px rgba(6,20,47,0.07);
            overflow: hidden;
        }

        .card-stripe { height: 4px; }
        .stripe-fin { background: linear-gradient(90deg, #06142f, #6196d1); }
        .stripe-mat { background: linear-gradient(90deg, #2d5f9a, #99c8f8); }

        .card-body-p { padding: 28px; }

        .camp-image {
            width: 100%;
            max-height: 220px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 20px;
            border: 1px solid #dce8f5;
        }

        .camp-desc {
            color: #6196d1;
            font-size: 0.9rem;
            line-height: 1.6;
            margin-bottom: 22px;
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1px;
            background: #f0f4fa;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 22px;
        }
        .stat-cell {
            background: white;
            padding: 16px;
            text-align: center;
        }
        .stat-cell .val {
            font-size: 1.3rem;
            font-weight: 800;
            color: #08346b;
        }
        .stat-cell .lbl {
            font-size: 0.72rem;
            color: #6196d1;
            margin-top: 3px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .progress-wrap { margin-top: 4px; }
        .progress-header {
            display: flex;
            justify-content: space-between;
            font-size: 0.75rem;
            color: #6196d1;
            margin-bottom: 7px;
        }
        .progress-header span:first-child { font-weight: 700; color: #08346b; }
        .progress-track {
            background: #f0f4fa;
            border-radius: 10px;
            height: 7px;
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            border-radius: 10px;
            background: linear-gradient(90deg, #06142f, #6196d1);
        }

        /* SIDE INFO */
        .section-label {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #6196d1;
            margin-bottom: 14px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 11px 0;
            border-bottom: 1px solid #f0f4fa;
            font-size: 0.85rem;
        }
        .info-row:last-child { border-bottom: none; }
        .info-row .key { color: #6196d1; }
        .info-row .val { font-weight: 700; color: #06142f; }

        .pill {
            font-size: 0.72rem;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 20px;
        }
        .pill-fin { background: #dce8f5; color: #08346b; }
        .pill-mat { background: #e8f0fa; color: #2d5f9a; }
        .pill-active { background: #dce8f5; color: #08346b; }
        .pill-cloture { background: #f0f4fa; color: #6196d1; }

        /* TABLE */
        .table-card {
            background: white;
            border-radius: 18px;
            border: 1px solid #dce8f5;
            box-shadow: 0 4px 20px rgba(6,20,47,0.07);
            overflow: hidden;
        }
        .table-card-header {
            padding: 20px 24px 16px;
            border-bottom: 1px solid #f0f4fa;
        }
        .table-card-header h5 {
            font-size: 0.95rem;
            font-weight: 800;
            color: #06142f;
            margin: 0;
        }

        .table { margin: 0; }
        .table thead th {
            background: #f0f4fa;
            color: #2d5f9a;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 12px 18px;
            border: none;
        }
        .table tbody td {
            padding: 13px 18px;
            vertical-align: middle;
            color: #06142f;
            font-size: 0.85rem;
            border-color: #f0f4fa;
        }
        .table tbody tr:hover { background: #f8fbff; }

        .badge-fin { background: #dce8f5; color: #08346b; padding: 4px 10px; border-radius: 20px; font-size: 0.7rem; font-weight: 700; }
        .badge-mat { background: #e8f0fa; color: #2d5f9a; padding: 4px 10px; border-radius: 20px; font-size: 0.7rem; font-weight: 700; }
        .badge-attente { background: #f0f4fa; color: #6196d1; padding: 4px 10px; border-radius: 20px; font-size: 0.7rem; font-weight: 700; }
        .badge-confirme { background: #dce8f5; color: #08346b; padding: 4px 10px; border-radius: 20px; font-size: 0.7rem; font-weight: 700; }
        .badge-annule { background: #fde8e8; color: #c0392b; padding: 4px 10px; border-radius: 20px; font-size: 0.7rem; font-weight: 700; }

        .empty-state {
            text-align: center; padding: 40px 20px; color: #6196d1;
        }
        .empty-state i { font-size: 2rem; opacity: 0.3; display: block; margin-bottom: 10px; }
        .mobile-topbar {
            display: none; position: fixed; top: 0; left: 0; right: 0;
            background: linear-gradient(135deg, #06142f, #08346b);
            padding: 10px 16px; align-items: center;
            justify-content: space-between; z-index: 300; height: 58px;
        }
        .btn-menu-toggle {
            background: rgba(153,200,248,0.15); border: none; color: #99c8f8;
            border-radius: 8px; width: 38px; height: 38px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem; cursor: pointer;
        }
        .sidebar-overlay {
            display: none; position: fixed; inset: 0;
            background: rgba(6,20,47,0.5); z-index: 150;
        }
        .sidebar-overlay.active { display: block; }

        @media (max-width: 768px) {
            .mobile-topbar { display: flex; }
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-content { margin-left: 0; width: 100%; padding: 75px 16px 30px; }
            .page-header { flex-direction: column; align-items: flex-start; gap: 12px; }
            .page-header h4 { font-size: 1.2rem; }
            .btn-new { width: 100%; justify-content: center; }
            .cards-grid { grid-template-columns: 1fr; gap: 14px; }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .main-content { padding: 25px; }
            .cards-grid { grid-template-columns: repeat(2, 1fr); }
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

<div class="main-content">

    <div class="page-header">
        <div>
            <h4>{{ $campagne->titre }}</h4>
            <small>Détails de la campagne</small>
        </div>
        <div style="display:flex; gap:10px;">
            <a href="/campagnes/{{ $campagne->id }}/edit" class="btn-edit">
                <i class="fas fa-edit"></i> Modifier
            </a>
            <a href="/campagnes" class="btn-back">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>
    </div>

    <div class="row g-4">

        <!-- COLONNE GAUCHE -->
        <div class="col-md-8">
            <div class="info-card">
                <div class="card-stripe {{ $campagne->type == 'financiere' ? 'stripe-fin' : 'stripe-mat' }}"></div>
                <div class="card-body-p">

                    @if($campagne->image)
                        <img src="{{ asset('storage/' . $campagne->image) }}" class="camp-image">
                    @endif

                    @if($campagne->description)
                        <p class="camp-desc">{{ $campagne->description }}</p>
                    @endif

                    <div class="stats-row">
                        <div class="stat-cell">
                            <div class="val">{{ number_format($campagne->montant_collecte, 0, ',', ' ') }} F</div>
                            <div class="lbl">Collecté</div>
                        </div>
                        <div class="stat-cell">
                            <div class="val">
                                @if($campagne->objectif_montant)
                                    @if($campagne->type == 'financiere')
                                        {{ number_format($campagne->objectif_montant, 0, ',', ' ') }} F
                                    @else
                                        {{ $campagne->objectif_montant }}
                                    @endif
                                @else
                                    —
                                @endif
                            </div>
                            <div class="lbl">Objectif</div>
                        </div>
                        <div class="stat-cell">
                            <div class="val">{{ $dons->count() }}</div>
                            <div class="lbl">Dons reçus</div>
                        </div>
                    </div>

                    @if($campagne->type == 'financiere' && $campagne->objectif_montant > 0)
                    @php $pct = min(100, round(($campagne->montant_collecte / $campagne->objectif_montant) * 100)); @endphp
                    <div class="progress-wrap">
                        <div class="progress-header">
                            <span>{{ number_format($campagne->montant_collecte, 0, ',', ' ') }} F</span>
                            <span>{{ $pct }}%</span>
                        </div>
                        <div class="progress-track">
                            <div class="progress-fill" style="width:{{ $pct }}%"></div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>

        <!-- COLONNE DROITE -->
        <div class="col-md-4">
            <div class="info-card">
                <div class="card-body-p">
                    <div class="section-label">Informations</div>

                    <div class="info-row">
                        <span class="key">Type</span>
                        <span class="pill {{ $campagne->type == 'financiere' ? 'pill-fin' : 'pill-mat' }}">
                            {{ $campagne->type == 'financiere' ? 'Financière' : 'Matérielle' }}
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="key">Statut</span>
                        <span class="pill {{ $campagne->statut == 'active' ? 'pill-active' : 'pill-cloture' }}">
                            {{ $campagne->statut == 'active' ? '● Active' : '● Clôturée' }}
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="key">Date de fin</span>
                        <span class="val">
                            {{ $campagne->date_fin ? \Carbon\Carbon::parse($campagne->date_fin)->format('d/m/Y') : '—' }}
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="key">Créée le</span>
                        <span class="val">{{ $campagne->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- TABLE DONS -->
        <div class="col-12">
            <div class="table-card">
                <div class="table-card-header">
                    <h5>Dons reçus pour cette campagne</h5>
                </div>
                @if($dons->isEmpty())
                    <div class="empty-state">
                        <i class="fas fa-hand-holding-heart"></i>
                        <p style="font-size:0.88rem;">Aucun don pour cette campagne.</p>
                    </div>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Donateur</th>
                                <th>Type</th>
                                <th>Montant / Objet</th>
                                <th>Mode paiement</th>
                                <th>Statut</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dons as $don)
                            <tr>
                                <td>
                                    @if($don->anonyme)
                                        <span style="color:#6196d1; font-style:italic;">Anonyme</span>
                                    @else
                                        <strong>{{ $don->user->name }}</strong>
                                    @endif
                                </td>
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
                                <td style="color:#6196d1;">{{ $don->mode_paiement ?? '—' }}</td>
                                <td>
                                    @if($don->statut == 'en_attente')
                                        <span class="badge-attente">⏳ En attente</span>
                                    @elseif($don->statut == 'confirme')
                                        <span class="badge-confirme">✅ Confirmé</span>
                                    @else
                                        <span class="badge-annule">❌ Annulé</span>
                                    @endif
                                </td>
                                <td style="color:#6196d1;">{{ $don->created_at->format('d/m/Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

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