<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Dons - DonaLink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
            background: linear-gradient(160deg, #06142f 0%, #08346b 55%, #2d5f9a 100%);
            padding-top: 65px;
        }

        /* NAVBAR */
        .navbar {
            padding: 12px 40px;
            display: flex; justify-content: space-between; align-items: center;
            position: fixed; top: 0; left: 0; right: 0; width: 100%;
            z-index: 1000;
            background: linear-gradient(135deg, #06142f, #08346b);
        }
        .brand { text-decoration: none; }
        .user-area { display: flex; align-items: center; gap: 12px; }
        .avatar {
            width: 40px; height: 40px;
            background: rgba(153,200,248,0.15);
            border: 2px solid rgba(153,200,248,0.35);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: #99c8f8; font-weight: 700; font-size: 1rem;
            flex-shrink: 0;
        }
        .user-name { color: rgba(153,200,248,0.9); font-size: 0.9rem; font-weight: 500; }
        .btn-logout {
            background: rgba(153,200,248,0.12); color: #99c8f8;
            border: 1px solid rgba(153,200,248,0.25); border-radius: 20px;
            padding: 7px 16px; font-size: 0.82rem;
            cursor: pointer; transition: all 0.2s;
        }
        .btn-logout:hover { background: rgba(153,200,248,0.22); color: white; }

        /* HERO */
        .hero { text-align: center; padding: 30px 20px 50px; }
        .hero h1 { font-size: 2.5rem; font-weight: 800; margin-bottom: 8px; letter-spacing: -1px; color: white; }
        .hero p { font-size: 1rem; margin-bottom: 25px; color: #99c8f8; opacity: 0.9; }
        .btn-don {
            background: #99c8f8; color: #06142f; border: none; border-radius: 30px;
            padding: 13px 30px; font-weight: 700; font-size: 0.95rem;
            text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
            box-shadow: 0 8px 25px rgba(6,20,47,0.35); transition: all 0.2s;
        }
        .btn-don:hover { transform: translateY(-3px); background: white; color: #06142f; box-shadow: 0 12px 30px rgba(6,20,47,0.4); }

        /* STATS */
        .stats-container {
            max-width: 800px; margin: 0 auto; padding: 0 20px;
            display: grid; grid-template-columns: repeat(3, 1fr);
            gap: 15px; margin-bottom: -30px; position: relative; z-index: 2;
        }
        .stat-box {
            background: rgba(153,200,248,0.12); backdrop-filter: blur(10px);
            border: 1px solid rgba(153,200,248,0.2); border-radius: 16px;
            padding: 20px; text-align: center;
        }
        .stat-box .num { font-size: 1.8rem; font-weight: 800; line-height: 1; color: white; }
        .stat-box .lbl { font-size: 0.78rem; color: #99c8f8; margin-top: 5px; }

        /* WHITE CARD */
        .white-card {
            background: #f0f4fa; border-radius: 30px 30px 0 0;
            min-height: 60vh; margin-top: 50px; padding: 50px 40px 40px;
        }
        .section-label {
            font-size: 0.75rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: 2px; color: #2d5f9a; margin-bottom: 15px;
        }

        /* DON ITEMS */
        .don-item {
            background: white; border-radius: 16px; padding: 18px 22px;
            margin-bottom: 12px; display: flex; align-items: center; gap: 16px;
            box-shadow: 0 2px 10px rgba(6,20,47,0.07); transition: all 0.2s;
            border: 1.5px solid #dce8f5;
        }
        .don-item:hover { border-color: #08346b; box-shadow: 0 6px 20px rgba(8,52,107,0.12); transform: translateY(-2px); }
        .don-circle {
            width: 50px; height: 50px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem; flex-shrink: 0;
        }
        .don-circle.fin { background: linear-gradient(135deg, #99c8f8, #6196d1); }
        .don-circle.mat { background: linear-gradient(135deg, #c5dff5, #99c8f8); }
        .don-details { flex: 1; min-width: 0; }
        .don-details .titre { font-weight: 700; color: #06142f; font-size: 0.95rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .don-details .meta { color: #6196d1; font-size: 0.78rem; margin-top: 4px; }
        .don-right { text-align: right; flex-shrink: 0; }
        .don-right .montant { font-weight: 800; font-size: 1.05rem; }
        .don-right .montant.fin { color: #08346b; }
        .don-right .montant.mat { color: #2d5f9a; }
        .don-right .mode { color: #6196d1; font-size: 0.75rem; margin-top: 2px; }

        .pill {
            display: inline-block; padding: 4px 12px; border-radius: 20px;
            font-size: 0.72rem; font-weight: 700; margin-top: 6px;
        }
        .pill.attente { background: #fdf3dc; color: #b07d20; }
        .pill.confirme { background: #dce8f5; color: #06142f; }
        .pill.annule { background: #fde8e8; color: #c0392b; }

        .empty { text-align: center; padding: 60px 20px; }
        .empty .icon { font-size: 3.5rem; margin-bottom: 15px; }
        .empty h5 { font-weight: 700; color: #06142f; margin-bottom: 8px; }
        .empty p { color: #2d5f9a; font-size: 0.9rem; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .navbar { padding: 10px 16px; }
            body { padding-top: 58px; }
            .user-name { display: none; }
            .btn-logout { padding: 6px 12px; font-size: 0.78rem; }
            .hero { padding: 20px 16px 45px; }
            .hero h1 { font-size: 1.6rem; letter-spacing: -0.5px; }
            .hero p { font-size: 0.88rem; }
            .stats-container { grid-template-columns: repeat(3, 1fr); gap: 10px; padding: 0 16px; }
            .stat-box { padding: 14px 10px; }
            .stat-box .num { font-size: 1.3rem; }
            .stat-box .lbl { font-size: 0.68rem; }
            .white-card { padding: 40px 16px 30px; border-radius: 24px 24px 0 0; }
            .don-item { padding: 14px 16px; gap: 12px; }
            .don-circle { width: 42px; height: 42px; font-size: 1.1rem; border-radius: 12px; }
            .don-details .titre { font-size: 0.88rem; }
            .don-right .montant { font-size: 0.92rem; }
        }

        @media (max-width: 400px) {
            .stats-container { grid-template-columns: 1fr; }
            .don-item { flex-wrap: wrap; }
            .don-right { width: 100%; text-align: left; border-top: 1px solid #f0f4fa; padding-top: 10px; margin-top: 4px; }
        }
    </style>
</head>
<body>

<nav class="navbar">
    <a href="/" class="brand">
        <img src="{{ asset('images/lol.png') }}"
            style="height:45px; object-fit:contain; border-radius:6px; padding:1px 3px;">
    </a>
    <div class="user-area">
        <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
        <span class="user-name">{{ auth()->user()->name }}</span>
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fas fa-sign-out-alt me-1"></i> Déconnexion
            </button>
        </form>
    </div>
</nav>

<div class="hero">
    <h1>Bonjour, {{ explode(' ', auth()->user()->name)[0] }}</h1>
    <p>Merci pour votre générosité — chaque don change une vie.</p>
    <a href="/dons/create" class="btn-don">
        <i class="fas fa-heart"></i> Faire un don
    </a>
</div>

@if(!$dons->isEmpty())
<div class="stats-container">
    <div class="stat-box">
        <div class="num">{{ $dons->count() }}</div>
        <div class="lbl">Dons total</div>
    </div>
    <div class="stat-box">
        <div class="num">{{ $dons->where('statut','confirme')->count() }}</div>
        <div class="lbl">Confirmés</div>
    </div>
    <div class="stat-box">
        <div class="num">{{ number_format($dons->where('type','financier')->sum('montant'), 0, ',', ' ') }} F</div>
        <div class="lbl">Total donné</div>
    </div>
</div>
@endif

<div class="white-card">
    @if(session('success'))
        <div class="alert alert-dismissible fade show rounded-3 mb-4"
             style="background:#dce8f5; color:#06142f; border:none;">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($dons->isEmpty())
        <div class="empty">
            <div class="mb-3">
                <img src="{{ asset('images/lol.png') }}"
                    style="height:55px; object-fit:contain; border-radius:6px; padding:1px 3px; opacity:0.5;">
            </div>
            <h5>Aucun don pour l'instant</h5>
            <p>Faites votre premier don et rejoignez notre communauté !</p>
            <a href="/dons/create" class="btn-don mt-3 d-inline-flex">
                <i class="fas fa-heart"></i> Faire mon premier don
            </a>
        </div>
    @else
        <div class="section-label">Historique de vos dons</div>

        @foreach($dons as $don)
        <div class="don-item">
            <div class="don-circle {{ $don->type == 'financier' ? 'fin' : 'mat' }}">
                {{ $don->type == 'financier' ? '💰' : '📦' }}
            </div>
            <div class="don-details">
                <div class="titre">{{ $don->campagne->titre }}</div>
                <div class="meta">
                    <i class="fas fa-calendar-alt me-1"></i>
                    {{ $don->created_at->format('d/m/Y') }}
                    @if($don->anonyme) · Anonyme @endif
                </div>
            </div>
            <div class="don-right">
                @if($don->type == 'financier')
                    <div class="montant fin">{{ number_format($don->montant, 0, ',', ' ') }} F</div>
                    <div class="mode">{{ $don->mode_paiement }}</div>
                @else
                    <div class="montant mat">{{ $don->description_materiel }}</div>
                    <div class="mode">Qté : {{ $don->quantite }}</div>
                @endif
                @if($don->statut == 'en_attente')
                    <span class="pill attente">⏳ En attente</span>
                @elseif($don->statut == 'confirme')
                    <span class="pill confirme">✅ Confirmé</span>
                @else
                    <span class="pill annule">❌ Annulé</span>
                @endif
            </div>
        </div>
        @endforeach
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>