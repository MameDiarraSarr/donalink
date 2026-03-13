<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $beneficiaire->nom }} {{ $beneficiaire->prenom }} - DonaLink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { width: 100%; font-family: 'Segoe UI', sans-serif; background: #f0f4fa; min-height: 100vh; }

        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #06142f 0%, #08346b 60%, #2d5f9a 100%);
            width: 255px; position: fixed; top: 0; left: 0;
            display: flex; flex-direction: column; z-index: 100;
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
            box-shadow: 0 4px 20px rgba(6,20,47,0.07); overflow: hidden;
        }
        .card-stripe { height: 4px; background: linear-gradient(90deg, #06142f, #6196d1); }
        .card-body-p { padding: 28px; }

        /* Avatar rond */
        .ben-avatar-lg {
            width: 72px; height: 72px; border-radius: 50%;
            background: linear-gradient(135deg, #06142f, #2d5f9a);
            color: #99c8f8; display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem; font-weight: 800;
            margin: 0 auto 14px auto;
        }
        .ben-nom-lg {
            font-size: 1.15rem; font-weight: 800; color: #06142f;
            text-align: center; margin-bottom: 22px;
        }

        .section-label {
            font-size: 0.7rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: 2px; color: #6196d1; margin-bottom: 12px;
        }

        .info-row {
            display: flex; justify-content: space-between; align-items: center;
            padding: 11px 0; border-bottom: 1px solid #f0f4fa; font-size: 0.85rem;
        }
        .info-row:last-child { border-bottom: none; }
        .info-row .key { color: #6196d1; }
        .info-row .val { font-weight: 700; color: #06142f; }

        .besoins-divider {
            border: none; border-top: 1px solid #f0f4fa; margin: 20px 0;
        }

        .besoins-text {
            font-size: 0.88rem; color: #6196d1; line-height: 1.6;
            background: #f8fbff; border-radius: 10px;
            padding: 12px 14px; border: 1px solid #dce8f5;
        }

        .table-card {
            background: white; border-radius: 18px; border: 1px solid #dce8f5;
            box-shadow: 0 4px 20px rgba(6,20,47,0.07); overflow: hidden;
        }
        .table-card-header { padding: 20px 24px 16px; border-bottom: 1px solid #f0f4fa; }
        .table-card-header h5 { font-size: 0.95rem; font-weight: 800; color: #06142f; margin: 0; }

        .table { margin: 0; }
        .table thead th {
            background: #f0f4fa; color: #2d5f9a; font-size: 0.7rem;
            font-weight: 700; text-transform: uppercase; letter-spacing: 1px;
            padding: 12px 18px; border: none;
        }
        .table tbody td {
            padding: 13px 18px; vertical-align: middle;
            color: #06142f; font-size: 0.85rem; border-color: #f0f4fa;
        }
        .table tbody tr:hover { background: #f8fbff; }

        .badge-fin { background: #dce8f5; color: #08346b; padding: 4px 10px; border-radius: 20px; font-size: 0.7rem; font-weight: 700; }
        .badge-mat { background: #e8f0fa; color: #2d5f9a; padding: 4px 10px; border-radius: 20px; font-size: 0.7rem; font-weight: 700; }

        .empty-state { text-align: center; padding: 40px 20px; color: #6196d1; }
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
            <h4>{{ $beneficiaire->nom }} {{ $beneficiaire->prenom }}</h4>
            <small>Détails du bénéficiaire</small>
        </div>
        <div style="display:flex; gap:10px;">
            <a href="/beneficiaires/{{ $beneficiaire->id }}/edit" class="btn-edit">
                <i class="fas fa-edit"></i> Modifier
            </a>
            <a href="/beneficiaires" class="btn-back">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>
    </div>

    <div class="row g-4">

        <!-- INFOS + BESOINS dans le même cadre -->
        <div class="col-md-4">
            <div class="info-card">
                <div class="card-stripe"></div>
                <div class="card-body-p">

                    <div class="ben-avatar-lg">
                        {{ strtoupper(substr($beneficiaire->nom, 0, 1)) }}{{ strtoupper(substr($beneficiaire->prenom ?? '', 0, 1)) }}
                    </div>
                    <div class="ben-nom-lg">{{ $beneficiaire->nom }} {{ $beneficiaire->prenom }}</div>

                    <div class="section-label">Informations</div>
                    <div class="info-row">
                        <span class="key">Téléphone</span>
                        <span class="val">{{ $beneficiaire->telephone ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="key">Adresse</span>
                        <span class="val">{{ $beneficiaire->adresse ?? '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="key">Ajouté le</span>
                        <span class="val">{{ $beneficiaire->created_at->format('d/m/Y') }}</span>
                    </div>

                    <hr class="besoins-divider">

                    <div class="section-label">Besoins</div>
                    <div class="besoins-text">
                        {{ $beneficiaire->besoins ?? 'Aucun besoin spécifié.' }}
                    </div>

                </div>
            </div>
        </div>

        <!-- DISTRIBUTIONS -->
        <div class="col-md-8">
            <div class="table-card">
                <div class="table-card-header">
                    <h5>Historique des dons reçus</h5>
                </div>
                @if($distributions->isEmpty())
                    <div class="empty-state">
                        <i class="fas fa-box-open"></i>
                        <p style="font-size:0.88rem;">Aucun don reçu pour le moment.</p>
                    </div>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Type de don</th>
                                <th>Montant / Objet</th>
                                <th>Date de réception</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($distributions as $distribution)
                            <tr>
                                <td>
                                    @if($distribution->don->type == 'financier')
                                        <span class="badge-fin">Financier</span>
                                    @else
                                        <span class="badge-mat">Matériel</span>
                                    @endif
                                </td>
                                <td>
                                    @if($distribution->don->type == 'financier')
                                        <strong>{{ number_format($distribution->don->montant, 0, ',', ' ') }} F</strong>
                                    @else
                                        {{ $distribution->don->description_materiel }}
                                        (x{{ $distribution->don->quantite }})
                                    @endif
                                </td>
                                <td style="color:#6196d1;">{{ \Carbon\Carbon::parse($distribution->date_distribution)->format('d/m/Y') }}</td>
                                <td style="color:#6196d1;">{{ $distribution->notes ?? '—' }}</td>
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