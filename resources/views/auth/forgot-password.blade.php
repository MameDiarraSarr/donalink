<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié - DonaLink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { min-height: 100vh; font-family: 'Segoe UI', sans-serif; }
        body { display: flex; background: linear-gradient(160deg, #06142f 0%, #08346b 55%, #2d5f9a 100%); }

        /* PANNEAU GAUCHE */
        .left-panel {
            flex: 1; display: flex; flex-direction: column;
            justify-content: center; padding: 60px;
            position: relative; overflow: hidden;
        }
        .left-panel::before {
            content: ''; position: absolute; top: -120px; right: -120px;
            width: 400px; height: 400px; border-radius: 50%;
            background: rgba(153,200,248,0.06);
        }
        .left-panel::after {
            content: ''; position: absolute; bottom: -80px; left: -80px;
            width: 300px; height: 300px; border-radius: 50%;
            background: rgba(97,150,209,0.07);
        }
        .brand { font-size: 1.6rem; font-weight: 900; color: #99c8f8; margin-bottom: 50px; position: relative; z-index: 2; }
        .left-title { font-size: 2.4rem; font-weight: 900; color: white; line-height: 1.2; margin-bottom: 18px; position: relative; z-index: 2; }
        .left-title span { color: #99c8f8; }
        .left-desc { color: rgba(153,200,248,0.75); font-size: 0.95rem; line-height: 1.7; max-width: 380px; margin-bottom: 40px; position: relative; z-index: 2; }
        .left-features { display: flex; flex-direction: column; gap: 14px; position: relative; z-index: 2; }
        .feature-item { display: flex; align-items: center; gap: 12px; color: rgba(153,200,248,0.8); font-size: 0.88rem; }
        .feature-icon {
            width: 34px; height: 34px; border-radius: 9px;
            background: rgba(153,200,248,0.12);
            display: flex; align-items: center; justify-content: center;
            color: #99c8f8; font-size: 0.85rem; flex-shrink: 0;
        }

        /* PANNEAU DROIT */
        .right-panel {
            width: 500px; background: #f0f4fa;
            display: flex; align-items: center; justify-content: center;
            padding: 40px; min-height: 100vh;
        }
        .right-inner { width: 100%; }

        /* Logo mobile */
        .mobile-logo { display: none; text-align: center; margin-bottom: 24px; }

        .reset-card {
            background: white; border-radius: 22px; padding: 42px 38px;
            width: 100%; border: 1px solid #dce8f5;
            box-shadow: 0 8px 32px rgba(6,20,47,0.1);
        }

        .card-icon {
            width: 52px; height: 52px; border-radius: 14px;
            background: #dce8f5; display: flex; align-items: center;
            justify-content: center; color: #08346b;
            font-size: 1.3rem; margin-bottom: 20px;
        }

        .card-title { font-size: 1.5rem; font-weight: 800; color: #06142f; margin-bottom: 8px; }
        .card-sub { font-size: 0.85rem; color: #6196d1; margin-bottom: 28px; line-height: 1.6; }

        .form-label { font-weight: 600; color: #06142f; font-size: 0.85rem; margin-bottom: 6px; }

        .input-wrap { position: relative; }
        .input-wrap i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #99c8f8; font-size: 0.85rem; }
        .form-control {
            border-radius: 10px; padding: 11px 14px 11px 40px;
            border: 1.5px solid #dce8f5; font-size: 0.88rem; color: #06142f;
            background: #f8fbff; transition: all 0.2s; width: 100%;
        }
        .form-control:focus { border-color: #08346b; box-shadow: 0 0 0 3px rgba(8,52,107,0.08); background: white; outline: none; }
        .form-control::placeholder { color: #99c8f8; }

        .alert-success-custom {
            background: #dce8f5; color: #06142f; border: none;
            border-radius: 10px; padding: 12px 16px; font-size: 0.85rem;
            margin-bottom: 20px; display: flex; align-items: center; gap: 8px;
        }

        .btn-submit {
            background: linear-gradient(135deg, #06142f, #08346b); color: #99c8f8;
            border: none; border-radius: 12px; padding: 13px; font-weight: 700;
            width: 100%; font-size: 0.95rem; cursor: pointer; transition: all 0.2s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            box-shadow: 0 4px 14px rgba(6,20,47,0.2); margin-top: 24px;
        }
        .btn-submit:hover { opacity: 0.9; transform: translateY(-1px); }

        .back-link { text-align: center; margin-top: 22px; font-size: 0.85rem; }
        .back-link a {
            color: #6196d1; font-weight: 600; text-decoration: none;
            display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s;
        }
        .back-link a:hover { color: #08346b; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .left-panel { display: none; }
            .right-panel { width: 100%; padding: 24px 16px; align-items: flex-start; padding-top: 40px; }
            .mobile-logo { display: block; }
            .reset-card { padding: 30px 22px; border-radius: 18px; }
            .card-title { font-size: 1.3rem; }
        }

        @media (max-width: 400px) {
            .right-panel { padding: 20px 12px; }
            .reset-card { padding: 24px 16px; }
        }
    </style>
</head>
<body>

    <!-- PANNEAU GAUCHE -->
    <div class="left-panel">
        <div class="brand">
            <img src="{{ asset('images/lol.png') }}"
                style="height:45px; object-fit:contain; border-radius:6px; padding:1px 3px;">
        </div>
        <div class="left-title">Réinitialisez<br>votre <span>mot de passe</span></div>
        <p class="left-desc">Pas de panique ! Entrez votre email et nous vous enverrons un lien pour récupérer votre accès.</p>
        <div class="left-features">
            <div class="feature-item">
                <div class="feature-icon"><i class="fas fa-envelope"></i></div>
                Lien envoyé en quelques secondes
            </div>
            <div class="feature-item">
                <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                Lien sécurisé et temporaire
            </div>
            <div class="feature-item">
                <div class="feature-icon"><i class="fas fa-lock"></i></div>
                Votre compte reste protégé
            </div>
        </div>
    </div>

    <!-- PANNEAU DROIT -->
    <div class="right-panel">
        <div class="right-inner">

            <!-- Logo visible uniquement sur mobile -->
            <div class="mobile-logo">
                <img src="{{ asset('images/lol.png') }}"
                    style="height:52px; object-fit:contain; border-radius:8px; padding:1px 3px;">
            </div>

            <div class="reset-card">
                <div class="card-icon">
                    <i class="fas fa-key"></i>
                </div>
                <div class="card-title">Mot de passe oublié ?</div>
                <div class="card-sub">
                    Entrez votre adresse email et nous vous enverrons un lien pour réinitialiser votre mot de passe.
                </div>

                @if(session('status'))
                    <div class="alert-success-custom">
                        <i class="fas fa-check-circle" style="color:#08346b;"></i>
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-1">
                        <label class="form-label">Adresse email</label>
                        <div class="input-wrap">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                                placeholder="votre@email.com" required autofocus>
                        </div>
                        @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="btn-submit">
                        <i class="fas fa-paper-plane"></i> Envoyer le lien
                    </button>
                </form>

                <div class="back-link">
                    <a href="{{ route('login') }}">
                        <i class="fas fa-arrow-left"></i> Retour à la connexion
                    </a>
                </div>
            </div>

        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>