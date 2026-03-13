<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distributions - DonaLink</title>
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
            z-index: 200; transition: transform 0.3s ease;
        }
        .sidebar-logo {
            padding: 15px 24px; border-bottom: 1px solid rgba(153,200,248,0.15);
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

        /* MAIN */
        .main-content { margin-left: 255px; padding: 35px 40px; width: calc(100% - 255px); min-height: 100vh; }

        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .page-header h4 { font-size: 1.5rem; font-weight: 800; color: #06142f; margin-bottom: 3px; }
        .page-header small { color: #6196d1; font-size: 0.88rem; }

        .btn-new {
            background: linear-gradient(135deg, #06142f, #08346b);
            color: #99c8f8; border: none; border-radius: 10px;
            padding: 11px 22px; font-size: 0.88rem; font-weight: 700;
            text-decoration: none; display: inline-flex; align-items: center;
            gap: 8px; transition: all 0.2s; box-shadow: 0 4px 12px rgba(6,20,47,0.2);
        }
        .btn-new:hover { opacity: 0.9; transform: translateY(-1px); color: white; }

        .quick-stats {
            display: grid; grid-template-columns: repeat(3, 1fr);
            gap: 14px; margin-bottom: 28px;
        }
        .qs-box {
            background: white; border-radius: 14px; padding: 16px 20px;
            border: 1px solid #dce8f5; display: flex; align-items: center; gap: 12px;
        }
        .qs-icon {
            width: 38px; height: 38px; border-radius: 10px;
            background: #dce8f5; color: #08346b;
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem; flex-shrink: 0;
        }
        .qs-num { font-size: 1.4rem; font-weight: 800; color: #06142f; line-height: 1; }
        .qs-lbl { font-size: 0.75rem; color: #6196d1; margin-top: 2px; }

        .cards-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; }

        .dist-card {
            background: white; border-radius: 16px; border: 1px solid #dce8f5;
            box-shadow: 0 2px 8px rgba(6,20,47,0.05);
            transition: all 0.2s; display: flex; flex-direction: column; overflow: hidden;
        }
        .dist-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(6,20,47,0.1); border-color: #6196d1; }
        .dist-card-stripe { height: 4px; }
        .stripe-fin { background: linear-gradient(90deg, #06142f, #6196d1); }
        .stripe-mat { background: linear-gradient(90deg, #2d5f9a, #99c8f8); }
        .dist-card-body { padding: 20px; flex: 1; }
        .dist-type {
            font-size: 0.7rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: 1.5px; color: #6196d1; margin-bottom: 6px;
        }
        .dist-beneficiaire {
            font-size: 1rem; font-weight: 800; color: #06142f;
            margin-bottom: 14px; line-height: 1.3;
            display: flex; align-items: center; gap: 8px;
        }
        .dist-avatar {
            width: 32px; height: 32px; border-radius: 50%;
            background: linear-gradient(135deg, #06142f, #2d5f9a);
            color: #99c8f8; display: flex; align-items: center; justify-content: center;
            font-size: 0.75rem; font-weight: 800; flex-shrink: 0;
        }
        .dist-montant { font-size: 1.25rem; font-weight: 800; color: #08346b; margin-bottom: 4px; }
        .dist-materiel { font-size: 0.85rem; color: #06142f; margin-bottom: 4px; }
        .dist-quantite { font-size: 0.75rem; color: #6196d1; margin-bottom: 14px; }
        .dist-notes {
            font-size: 0.78rem; color: #6196d1; background: #f8fbff;
            border-radius: 8px; padding: 8px 10px;
            border: 1px solid #dce8f5; line-height: 1.5; margin-bottom: 14px;
        }
        .dist-meta { display: flex; align-items: center; justify-content: space-between; }
        .dist-date { font-size: 0.75rem; color: #99c8f8; display: flex; align-items: center; gap: 5px; }
        .dist-card-actions { padding: 12px 20px; border-top: 1px solid #f0f4fa; display: flex; gap: 8px; }
        .btn-voir {
            background: #f0f4fa; color: #08346b; border: none; border-radius: 8px;
            padding: 7px 0; font-size: 0.78rem; font-weight: 600; cursor: pointer;
            transition: all 0.2s; text-decoration: none;
            display: inline-flex; align-items: center; justify-content: center; gap: 5px; flex: 1;
        }
        .btn-voir:hover { background: #08346b; color: white; }
        .btn-edit {
            background: #f0f4fa; color: #2d5f9a; border: none; border-radius: 8px;
            padding: 7px 0; font-size: 0.78rem; font-weight: 600; cursor: pointer;
            transition: all 0.2s; text-decoration: none;
            display: inline-flex; align-items: center; justify-content: center; gap: 5px; flex: 1;
        }
        .btn-edit:hover { background: #2d5f9a; color: white; }
        .btn-delete {
            background: #fde8e8; color: #c0392b; border: none; border-radius: 8px;
            padding: 7px 12px; font-size: 0.78rem; cursor: pointer;
            transition: all 0.2s; display: inline-flex; align-items: center;
        }
        .btn-delete:hover { background: #c0392b; color: white; }
        .alert-success-custom {
            background: #dce8f5; color: #06142f; border: none; border-radius: 12px;
            padding: 14px 18px; margin-bottom: 24px;
            display: flex; align-items: center; gap: 10px; font-size: 0.88rem; font-weight: 500;
        }
        .empty-state {
            text-align: center; padding: 80px 20px; color: #6196d1;
            background: white; border-radius: 20px; border: 1px solid #dce8f5;
        }
        .empty-state i { font-size: 3rem; margin-bottom: 15px; opacity: 0.3; display: block; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .mobile-topbar { display: flex; }
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-content { margin-left: 0; width: 100%; padding: 75px 16px 30px; }
            .page-header { flex-direction: column; align-items: flex-start; gap: 12px; }
            .page-header h4 { font-size: 1.2rem; }
            .btn-new { width: 100%; justify-content: center; }
            .cards-grid { grid-template-columns: 1fr; gap: 14px; }
            .quick-stats { grid-template-columns: 1fr; gap: 10px; }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .main-content { padding: 25px; }
            .cards-grid { grid-template-columns: repeat(2, 1fr); }
            .quick-stats { grid-template-columns: repeat(2, 1fr); }
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
            <h4>Distributions</h4>
            <small>Historique des dons redistribués</small>
        </div>
        <a href="/distributions/create" class="btn-new">
            <i class="fas fa-plus"></i> Nouvelle distribution
        </a>
    </div>

    @if(session('success'))
        <div class="alert-success-custom">
            <i class="fas fa-check-circle" style="color:#08346b;"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(!$distributions->isEmpty())
    <div class="quick-stats">
        <div class="qs-box">
            <div class="qs-icon"><i class="fas fa-box-open"></i></div>
            <div>
                <div class="qs-num">{{ $distributions->count() }}</div>
                <div class="qs-lbl">Total distributions</div>
            </div>
        </div>
        <div class="qs-box">
            <div class="qs-icon"><i class="fas fa-coins"></i></div>
            <div>
                <div class="qs-num">{{ number_format($distributions->where('don.type','financier')->sum('don.montant'), 0, ',', ' ') }} F</div>
                <div class="qs-lbl">Total financier distribué</div>
            </div>
        </div>
        <div class="qs-box">
            <div class="qs-icon"><i class="fas fa-users"></i></div>
            <div>
                <div class="qs-num">{{ $distributions->unique('beneficiaire_id')->count() }}</div>
                <div class="qs-lbl">Bénéficiaires touchés</div>
            </div>
        </div>
    </div>
    @endif

    @if($distributions->isEmpty())
        <div class="empty-state">
            <i class="fas fa-box-open"></i>
            <p>Aucune distribution pour le moment.</p>
        </div>
    @else
        <div class="cards-grid">
            @foreach($distributions as $distribution)
            <div class="dist-card">
                <div class="dist-card-stripe {{ $distribution->don->type == 'financier' ? 'stripe-fin' : 'stripe-mat' }}"></div>
                <div class="dist-card-body">
                    <div class="dist-type">
                        {{ $distribution->don->type == 'financier' ? 'Financier' : 'Matériel' }}
                    </div>
                    <div class="dist-beneficiaire">
                        <div class="dist-avatar">
                            {{ strtoupper(substr($distribution->beneficiaire->nom, 0, 1)) }}{{ strtoupper(substr($distribution->beneficiaire->prenom ?? '', 0, 1)) }}
                        </div>
                        {{ $distribution->beneficiaire->nom }} {{ $distribution->beneficiaire->prenom }}
                    </div>
                    @if($distribution->don->type == 'financier')
                        <div class="dist-montant">{{ number_format($distribution->don->montant, 0, ',', ' ') }} F</div>
                    @else
                        <div class="dist-materiel">{{ $distribution->don->description_materiel }}</div>
                        <div class="dist-quantite">Qté : {{ $distribution->don->quantite }}</div>
                    @endif
                    @if($distribution->notes)
                        <div class="dist-notes">{{ $distribution->notes }}</div>
                    @endif
                    <div class="dist-meta">
                        <div class="dist-date">
                            <i class="fas fa-calendar-alt"></i>
                            {{ \Carbon\Carbon::parse($distribution->date_distribution)->format('d/m/Y') }}
                        </div>
                    </div>
                </div>
                <div class="dist-card-actions">
                    <a href="/distributions/{{ $distribution->id }}" class="btn-voir">
                        <i class="fas fa-eye"></i> Voir
                    </a>
                    <a href="/distributions/{{ $distribution->id }}/edit" class="btn-edit">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                    <form action="/distributions/{{ $distribution->id }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Supprimer cette distribution ?')">
                        @csrf @method('DELETE')
                        <button class="btn-delete"><i class="fas fa-trash"></i></button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    @endif

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