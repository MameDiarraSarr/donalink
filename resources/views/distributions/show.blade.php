<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distribution - DonaLink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { width: 100%; font-family: 'Segoe UI', sans-serif; background: #f0f4fa; min-height: 100vh; }

        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #06142f 0%, #08346b 60%, #2d5f9a 100%);
            width: 255px; position: fixed; top: 0; left: 0;
            display: flex; flex-direction: column; 
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

        .main-content { margin-left: 255px; padding: 35px 40px; width: calc(100% - 255px); min-height: 100vh; }

        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px; }
        .page-header h4 { font-size: 1.5rem; font-weight: 800; color: #06142f; margin-bottom: 3px; }
        .page-header small { color: #6196d1; font-size: 0.88rem; }

        .btn-back {
            background: white; color: #2d5f9a; border: 1.5px solid #dce8f5;
            border-radius: 10px; padding: 9px 18px; font-size: 0.85rem; font-weight: 600;
            text-decoration: none; display: inline-flex; align-items: center; gap: 7px; transition: all 0.2s;
        }
        .btn-back:hover { background: #dce8f5; color: #08346b; }

        .btn-edit {
            background: linear-gradient(135deg, #06142f, #08346b); color: #99c8f8;
            border: none; border-radius: 10px; padding: 9px 18px;
            font-size: 0.85rem; font-weight: 600; text-decoration: none;
            display: inline-flex; align-items: center; gap: 7px; transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(6,20,47,0.2);
        }
        .btn-edit:hover { opacity: 0.9; color: white; }

        .info-card {
            background: white; border-radius: 18px; border: 1px solid #dce8f5;
            box-shadow: 0 4px 20px rgba(6,20,47,0.07); overflow: hidden; height: 100%;
        }
        .card-stripe { height: 4px; }
        .stripe-fin { background: linear-gradient(90deg, #06142f, #6196d1); }
        .stripe-mat { background: linear-gradient(90deg, #2d5f9a, #99c8f8); }
        .card-body-p { padding: 28px; }

        .section-label {
            font-size: 0.7rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: 2px; color: #6196d1; margin-bottom: 14px;
        }

        .info-row {
            display: flex; justify-content: space-between; align-items: center;
            padding: 11px 0; border-bottom: 1px solid #f0f4fa; font-size: 0.85rem;
        }
        .info-row:last-child { border-bottom: none; }
        .info-row .key { color: #6196d1; }
        .info-row .val { font-weight: 700; color: #06142f; }

        .badge-fin { background: #dce8f5; color: #08346b; padding: 4px 10px; border-radius: 20px; font-size: 0.7rem; font-weight: 700; }
        .badge-mat { background: #e8f0fa; color: #2d5f9a; padding: 4px 10px; border-radius: 20px; font-size: 0.7rem; font-weight: 700; }

        .montant-big { font-size: 1.5rem; font-weight: 800; color: #08346b; margin: 12px 0; }

        .ben-avatar {
            width: 48px; height: 48px; border-radius: 50%;
            background: linear-gradient(135deg, #06142f, #2d5f9a);
            color: #99c8f8; display: flex; align-items: center; justify-content: center;
            font-size: 1rem; font-weight: 800; margin-bottom: 12px;
        }

        .notes-box {
            background: #f8fbff; border-radius: 10px; border: 1px solid #dce8f5;
            padding: 14px; font-size: 0.88rem; color: #06142f; line-height: 1.6;
        }
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
            <h4>Détails de la Distribution</h4>
            <small>Enregistrée le {{ $distribution->created_at->format('d/m/Y') }}</small>
        </div>
        <div style="display:flex; gap:10px;">
            <a href="/distributions/{{ $distribution->id }}/edit" class="btn-edit">
                <i class="fas fa-edit"></i> Modifier
            </a>
            <a href="/distributions" class="btn-back">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>
    </div>

    <div class="row g-4">

        <!-- DON -->
        <div class="col-md-6">
            <div class="info-card">
                <div class="card-stripe {{ $distribution->don->type == 'financier' ? 'stripe-fin' : 'stripe-mat' }}"></div>
                <div class="card-body-p">
                    <div class="section-label">Don redistribué</div>

                    <div class="info-row">
                        <span class="key">Type</span>
                        <span class="val">
                            @if($distribution->don->type == 'financier')
                                <span class="badge-fin">Financier</span>
                            @else
                                <span class="badge-mat">Matériel</span>
                            @endif
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="key">Montant / Objet</span>
                        <span class="val">
                            @if($distribution->don->type == 'financier')
                                {{ number_format($distribution->don->montant, 0, ',', ' ') }} F
                            @else
                                {{ $distribution->don->description_materiel }} (x{{ $distribution->don->quantite }})
                            @endif
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="key">Campagne</span>
                        <span class="val">{{ $distribution->don->campagne->titre }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- BENEFICIAIRE -->
        <div class="col-md-6">
            <div class="info-card">
                <div class="card-stripe stripe-fin"></div>
                <div class="card-body-p">
                    <div class="section-label">Bénéficiaire</div>

                    <div class="ben-avatar">
                        {{ strtoupper(substr($distribution->beneficiaire->nom, 0, 1)) }}{{ strtoupper(substr($distribution->beneficiaire->prenom ?? '', 0, 1)) }}
                    </div>

                    <div class="info-row">
                        <span class="key">Nom</span>
                        <span class="val">{{ $distribution->beneficiaire->nom }} {{ $distribution->beneficiaire->prenom }}</span>
                    </div>
                    <div class="info-row">
                        <span class="key">Téléphone</span>
                        <span class="val">{{ $distribution->beneficiaire->telephone ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="key">Adresse</span>
                        <span class="val">{{ $distribution->beneficiaire->adresse ?? '—' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- DETAILS -->
        <div class="col-12">
            <div class="info-card">
                <div class="card-body-p">
                    <div class="section-label">Détails</div>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="info-row">
                                <span class="key">Date de distribution</span>
                                <span class="val">{{ \Carbon\Carbon::parse($distribution->date_distribution)->format('d/m/Y') }}</span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="section-label" style="margin-bottom:8px;">Notes</div>
                            <div class="notes-box">{{ $distribution->notes ?? '—' }}</div>
                        </div>
                    </div>
                </div>
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