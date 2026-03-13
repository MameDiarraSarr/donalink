<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Campagne - DonaLink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        html, body {
            width: 100%;
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

        .main-content {
            margin-left: 255px;
            padding: 35px 40px;
            width: calc(100% - 255px);
            min-height: 100vh;
        }

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

        .form-card {
            background: white;
            border-radius: 18px;
            border: 1px solid #dce8f5;
            box-shadow: 0 4px 20px rgba(6,20,47,0.07);
            padding: 35px;
        }

        .section-title {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #6196d1;
            margin-bottom: 8px;
            margin-top: 22px;
        }
        .section-title:first-child { margin-top: 0; }

        .form-label {
            font-weight: 600;
            color: #06142f;
            font-size: 0.88rem;
            margin-bottom: 6px;
        }

        .form-control, .form-select {
            border-radius: 10px;
            padding: 10px 14px;
            border: 1.5px solid #dce8f5;
            font-size: 0.88rem;
            color: #06142f;
            background: #f8fbff;
            transition: all 0.2s;
        }
        .form-control:focus, .form-select:focus {
            border-color: #08346b;
            box-shadow: 0 0 0 3px rgba(8,52,107,0.08);
            background: white;
        }
        textarea.form-control { resize: none; }

        .img-preview {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            border: 1.5px solid #dce8f5;
            margin-bottom: 8px;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 28px;
            padding-top: 22px;
            border-top: 1px solid #f0f4fa;
        }

        .btn-submit {
            background: linear-gradient(135deg, #06142f, #08346b);
            color: #99c8f8;
            border: none;
            border-radius: 10px;
            padding: 11px 24px;
            font-size: 0.9rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(6,20,47,0.2);
        }
        .btn-submit:hover { opacity: 0.9; transform: translateY(-1px); }

        .btn-cancel {
            background: #f0f4fa;
            color: #2d5f9a;
            border: none;
            border-radius: 10px;
            padding: 11px 22px;
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-cancel:hover { background: #dce8f5; color: #08346b; }
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
            <h4>Modifier la Campagne</h4>
            <small>{{ $campagne->titre }}</small>
        </div>
        <a href="/campagnes" class="btn-back">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
    </div>

    <div class="form-card">
        <form action="/campagnes/{{ $campagne->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="section-title">Informations générales</div>

            <div class="row g-3 mb-3">
                <div class="col-md-8">
                    <label class="form-label">Titre de la campagne</label>
                    <input type="text" name="titre"
                        class="form-control @error('titre') is-invalid @enderror"
                        value="{{ old('titre', $campagne->titre) }}">
                    @error('titre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Date de fin</label>
                    <input type="date" name="date_fin"
                        class="form-control @error('date_fin') is-invalid @enderror"
                        value="{{ old('date_fin', $campagne->date_fin) }}">
                    @error('date_fin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" rows="3"
                    class="form-control @error('description') is-invalid @enderror">{{ old('description', $campagne->description) }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="section-title">Type et objectif</div>

            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label">Type de campagne</label>
                    <select name="type" id="type"
                        class="form-select @error('type') is-invalid @enderror"
                        onchange="toggleObjectif()">
                        <option value="financiere" {{ old('type', $campagne->type) == 'financiere' ? 'selected' : '' }}>Financière</option>
                        <option value="materielle" {{ old('type', $campagne->type) == 'materielle' ? 'selected' : '' }}>Matérielle</option>
                    </select>
                    @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4" id="champ_objectif"></div>
                <div class="col-md-4">
                    <label class="form-label">Statut</label>
                    <select name="statut" class="form-select">
                        <option value="active" {{ old('statut', $campagne->statut) == 'active' ? 'selected' : '' }}>● Active</option>
                        <option value="cloturee" {{ old('statut', $campagne->statut) == 'cloturee' ? 'selected' : '' }}>● Clôturée</option>
                    </select>
                </div>
            </div>

            <div class="section-title">Image</div>

            <div class="row g-3">
                <div class="col-md-4">
                    @if($campagne->image)
                        <div>
                            <img src="{{ asset('storage/' . $campagne->image) }}" class="img-preview">
                        </div>
                    @endif
                    <input type="file" name="image"
                        class="form-control @error('image') is-invalid @enderror"
                        accept="image/*">
                    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Enregistrer
                </button>
                <a href="/campagnes" class="btn-cancel">Annuler</a>
            </div>

        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const oldValue = "{{ old('objectif_montant', $campagne->objectif_montant) }}";

    function toggleObjectif() {
        const type = document.getElementById('type').value;
        const champ = document.getElementById('champ_objectif');
        if (type === 'materielle') {
            champ.innerHTML = `
                <label class="form-label">Objectif matériel</label>
                <input type="text" name="objectif_montant" class="form-control"
                    value="${oldValue}"
                    placeholder="Ex: 100 sacs de riz...">
            `;
        } else {
            champ.innerHTML = `
                <label class="form-label">Objectif (montant en FCFA)</label>
                <input type="number" name="objectif_montant" class="form-control"
                    value="${oldValue}"
                    placeholder="Ex: 500000">
            `;
        }
    }
    toggleObjectif();
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('overlay').classList.toggle('active');
    }
</script>
</body>
</html>