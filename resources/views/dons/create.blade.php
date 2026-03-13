<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faire un Don - DonaLink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
            background: linear-gradient(160deg, #06142f 0%, #08346b 55%, #2d5f9a 100%);
            display: flex; flex-direction: column;
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
        .btn-back {
            background: rgba(153,200,248,0.12); color: #99c8f8;
            border: 1px solid rgba(153,200,248,0.25); border-radius: 20px;
            padding: 8px 18px; font-size: 0.85rem; text-decoration: none; transition: all 0.2s;
        }
        .btn-back:hover { background: rgba(153,200,248,0.22); color: white; }

        /* HERO */
        .hero { text-align: center; padding: 15px 20px 50px; }
        .hero h1 { font-size: 1.6rem; font-weight: 800; margin-bottom: 5px; color: white; }
        .hero p { color: #99c8f8; opacity: 0.9; font-size: 0.88rem; }

        /* FORM CONTAINER */
        .form-container {
            background: #f0f4fa; border-radius: 30px 30px 0 0;
            flex: 1; padding: 40px;
        }
        .form-card {
            background: white; border-radius: 20px; padding: 35px;
            max-width: 650px; margin: 0 auto;
            box-shadow: 0 4px 20px rgba(6,20,47,0.1);
            border-top: 4px solid #08346b;
        }

        .section-title {
            font-size: 0.72rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: 2px; color: #2d5f9a; margin: 20px 0 10px;
        }

        .form-control, .form-select {
            border-radius: 10px; padding: 11px 15px;
            border: 1.5px solid #dce8f5; font-size: 0.9rem;
            transition: all 0.2s; background: #f8fbff;
        }
        .form-control:focus, .form-select:focus {
            border-color: #08346b; box-shadow: 0 0 0 3px rgba(8,52,107,0.1); background: white;
        }

        /* TYPE SELECTOR */
        .type-selector { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 10px; }
        .type-btn {
            border: 2px solid #dce8f5; border-radius: 14px; padding: 18px;
            text-align: center; cursor: pointer; transition: all 0.2s; background: #f8fbff;
        }
        .type-btn:hover { border-color: #2d5f9a; background: linear-gradient(135deg, #eef4fc, #dce8f5); }
        .type-btn.active {
            border-color: #08346b; background: linear-gradient(135deg, #dce8f5, #bdd6f0);
            box-shadow: 0 4px 15px rgba(8,52,107,0.12);
        }
        .type-btn .emoji { font-size: 2rem; display: block; margin-bottom: 8px; }
        .type-btn .label { font-weight: 700; color: #06142f; font-size: 0.9rem; }
        .type-btn .desc { color: #6196d1; font-size: 0.78rem; margin-top: 3px; }

        /* MONTANTS RAPIDES */
        .montants-rapides { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 12px; }
        .montant-btn {
            background: #eef4fc; border: 1.5px solid #99c8f8; border-radius: 20px;
            padding: 6px 14px; font-size: 0.82rem; font-weight: 600;
            color: #08346b; cursor: pointer; transition: all 0.2s;
        }
        .montant-btn:hover, .montant-btn.active { background: #08346b; color: white; border-color: #08346b; }

        /* ANONYME */
        .anonyme-box {
            background: #f8fbff; border: 1.5px solid #dce8f5; border-radius: 12px;
            padding: 15px 18px; display: flex; align-items: center; gap: 12px;
            cursor: pointer; transition: all 0.2s; margin-bottom: 25px;
        }
        .anonyme-box:hover { border-color: #2d5f9a; }
        .anonyme-box input { display: none; }
        .anonyme-toggle {
            width: 22px; height: 22px; border: 2px solid #99c8f8; border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; transition: all 0.2s; color: transparent;
        }
        .anonyme-box.checked .anonyme-toggle { background: #08346b; border-color: #08346b; color: white; }
        .anonyme-text .title { font-weight: 600; color: #06142f; font-size: 0.88rem; }
        .anonyme-text .sub { color: #6196d1; font-size: 0.78rem; }

        /* SUBMIT */
        .btn-submit {
            background: linear-gradient(135deg, #06142f, #08346b); color: #99c8f8;
            border: none; border-radius: 12px; padding: 14px; font-weight: 700;
            font-size: 1rem; width: 100%; cursor: pointer; transition: all 0.2s;
            box-shadow: 0 4px 15px rgba(6,20,47,0.3); letter-spacing: 0.3px;
        }
        .btn-submit:hover { opacity: 0.9; transform: translateY(-1px); box-shadow: 0 8px 20px rgba(6,20,47,0.35); }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .navbar { padding: 10px 16px; }
            body { padding-top: 58px; }
            .hero { padding: 15px 16px 35px; }
            .hero h1 { font-size: 1.3rem; }
            .form-container { padding: 20px 12px; border-radius: 24px 24px 0 0; }
            .form-card { padding: 22px 16px; border-radius: 16px; }
            .type-selector { gap: 8px; }
            .type-btn { padding: 14px 10px; }
            .type-btn .emoji { font-size: 1.5rem; }
            .type-btn .label { font-size: 0.82rem; }
            .type-btn .desc { font-size: 0.72rem; }
            .montants-rapides { gap: 6px; }
            .montant-btn { padding: 5px 11px; font-size: 0.78rem; }
        }

        @media (max-width: 380px) {
            .type-selector { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<nav class="navbar">
    <a href="/" class="brand">
        <img src="{{ asset('images/lol.png') }}"
            style="height:45px; object-fit:contain; border-radius:6px; padding:1px 3px;">
    </a>
    <div class="d-flex gap-2">
        <a href="/" class="btn-back">
            <i class="fas fa-home me-1"></i> Accueil
        </a>
        <a href="/mes-dons" class="btn-back">
            <i class="fas fa-arrow-left me-1"></i> Mes dons
        </a>
    </div>
</nav>

<div class="hero">
    <h1>Faire un don</h1>
    <p>Choisissez une campagne et contribuez à changer des vies</p>
</div>

<div class="form-container">
    <div class="form-card">

        @if(session('success'))
            <div class="alert alert-dismissible fade show rounded-3 mb-4"
                 style="background:#dce8f5; color:#06142f; border:none;">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="/dons" method="POST">
            @csrf
            <input type="hidden" name="type" id="type_hidden" value="{{ old('type') }}">

            <div class="section-title">Campagne</div>
            <div class="mb-4">
                <select name="campagne_id" class="form-select @error('campagne_id') is-invalid @enderror">
                    <option value="">Choisir une campagne</option>
                    @foreach($campagnes as $campagne)
                        <option value="{{ $campagne->id }}" {{ old('campagne_id') == $campagne->id ? 'selected' : '' }}>
                            {{ $campagne->titre }} ({{ $campagne->type == 'financiere' ? 'Financière' : 'Matérielle' }})
                        </option>
                    @endforeach
                </select>
                @error('campagne_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="section-title">Type de don</div>
            <div class="type-selector mb-4">
                <div class="type-btn {{ old('type') == 'financier' ? 'active' : '' }}"
                     onclick="selectType('financier', this)">
                    <span class="emoji">💰</span>
                    <div class="label">Don financier</div>
                    <div class="desc">Envoyer de l'argent</div>
                </div>
                <div class="type-btn {{ old('type') == 'materiel' ? 'active' : '' }}"
                     onclick="selectType('materiel', this)">
                    <span class="emoji">📦</span>
                    <div class="label">Don matériel</div>
                    <div class="desc">Donner des objets</div>
                </div>
            </div>
            @error('type') <div class="text-danger small mb-3">{{ $message }}</div> @enderror

            <div id="champs_financier" style="display:none;">
                <div class="section-title">Montant</div>
                <div class="montants-rapides">
                    <span class="montant-btn" onclick="setMontant(1000, this)">1 000 F</span>
                    <span class="montant-btn" onclick="setMontant(5000, this)">5 000 F</span>
                    <span class="montant-btn" onclick="setMontant(10000, this)">10 000 F</span>
                    <span class="montant-btn" onclick="setMontant(25000, this)">25 000 F</span>
                    <span class="montant-btn" onclick="setMontant(50000, this)">50 000 F</span>
                </div>
                <div class="mb-4">
                    <input type="number" name="montant" id="montant_input"
                        class="form-control @error('montant') is-invalid @enderror"
                        value="{{ old('montant') }}" placeholder="Ou entrez un montant personnalisé...">
                    @error('montant') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="section-title">Mode de paiement</div>
                <div class="mb-4">
                    <select name="mode_paiement" class="form-select @error('mode_paiement') is-invalid @enderror">
                        <option value="">Choisir</option>
                        <option value="wave" {{ old('mode_paiement') == 'wave' ? 'selected' : '' }}>📱 Wave</option>
                        <option value="orange_money" {{ old('mode_paiement') == 'orange_money' ? 'selected' : '' }}>🟠 Orange Money</option>
                        <option value="virement" {{ old('mode_paiement') == 'virement' ? 'selected' : '' }}>🏦 Virement bancaire</option>
                        <option value="especes" {{ old('mode_paiement') == 'especes' ? 'selected' : '' }}>💵 Espèces</option>
                    </select>
                    @error('mode_paiement') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div id="champs_materiel" style="display:none;">
                <div class="section-title">Description de l'objet</div>
                <div class="mb-3">
                    <input type="text" name="description_materiel"
                        class="form-control @error('description_materiel') is-invalid @enderror"
                        value="{{ old('description_materiel') }}"
                        placeholder="Ex: Sacs de riz, couvertures...">
                    @error('description_materiel') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="section-title">Quantité</div>
                <div class="mb-4">
                    <input type="number" name="quantite"
                        class="form-control @error('quantite') is-invalid @enderror"
                        value="{{ old('quantite') }}" placeholder="Ex: 5" min="1">
                    @error('quantite') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="section-title">Confidentialité</div>
            <div class="anonyme-box {{ old('anonyme') ? 'checked' : '' }}" onclick="toggleAnonyme()">
                <input type="checkbox" name="anonyme" id="anonyme" value="1" {{ old('anonyme') ? 'checked' : '' }}>
                <div class="anonyme-toggle">
                    <i class="fas fa-check" style="font-size:0.7rem;"></i>
                </div>
                <div class="anonyme-text">
                    <div class="title">Don anonyme</div>
                    <div class="sub">Votre nom ne sera pas affiché publiquement</div>
                </div>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-heart me-2"></i> Confirmer mon don
            </button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function selectType(type, el) {
        document.getElementById('type_hidden').value = type;
        document.querySelectorAll('.type-btn').forEach(b => b.classList.remove('active'));
        el.classList.add('active');
        document.getElementById('champs_financier').style.display = type === 'financier' ? 'block' : 'none';
        document.getElementById('champs_materiel').style.display = type === 'materiel' ? 'block' : 'none';
    }

    function setMontant(val, el) {
        document.getElementById('montant_input').value = val;
        document.querySelectorAll('.montant-btn').forEach(b => b.classList.remove('active'));
        el.classList.add('active');
    }

    function toggleAnonyme() {
        const box = document.querySelector('.anonyme-box');
        const cb = document.getElementById('anonyme');
        box.classList.toggle('checked');
        cb.checked = !cb.checked;
    }

    const oldType = document.getElementById('type_hidden').value;
    if (oldType) {
        document.getElementById('champs_' + oldType).style.display = 'block';
        document.querySelectorAll('.type-btn').forEach((b, i) => {
            if ((i === 0 && oldType === 'financier') || (i === 1 && oldType === 'materiel')) {
                b.classList.add('active');
            }
        });
    }
</script>
</body>
</html>