@extends('layouts.app')

@section('title', 'Facture ' . $facture->numero_facture . ' - Atelier à Deux')

@section('content')
<style>
    .facture-wrapper {
        max-width: 800px;
        margin: 0 auto;
        padding: 40px 24px;
    }
    .facture-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }
    .facture-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: var(--shadow-lg);
        padding: 48px;
    }

    /* EN-TÊTE */
    .facture-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 40px;
        padding-bottom: 32px;
        border-bottom: 2px solid var(--light-warm);
    }
    .facture-brand {
        font-family: var(--font-display);
        font-size: 28px;
        font-weight: 700;
        color: var(--dark);
    }
    .facture-brand span { color: var(--brand); font-style: italic; }
    .facture-brand-info {
        margin-top: 8px;
        font-size: 13px;
        color: var(--text-soft);
        line-height: 1.7;
    }
    .facture-numero-box {
        text-align: right;
    }
    .facture-numero-label {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: var(--text-soft);
        margin-bottom: 4px;
    }
    .facture-numero {
        font-family: var(--font-display);
        font-size: 24px;
        font-weight: 700;
        color: var(--brand);
    }
    .facture-date {
        font-size: 13px;
        color: var(--text-soft);
        margin-top: 8px;
    }

    /* CLIENT */
    .facture-parties {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 32px;
        margin-bottom: 36px;
    }
    .facture-party-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: var(--text-soft);
        margin-bottom: 8px;
    }
    .facture-party-name {
        font-family: var(--font-display);
        font-size: 18px;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 4px;
    }
    .facture-party-info {
        font-size: 14px;
        color: var(--text-soft);
        line-height: 1.7;
    }

    /* DÉTAILS */
    .facture-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 32px;
    }
    .facture-table th {
        background: var(--light);
        padding: 12px 16px;
        text-align: left;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--text-soft);
    }
    .facture-table th:last-child { text-align: right; }
    .facture-table td {
        padding: 16px;
        border-bottom: 1px solid #F0ECE6;
        font-size: 14px;
        color: var(--text);
    }
    .facture-table td:last-child { text-align: right; font-weight: 600; }

    /* TOTAUX */
    .facture-totaux {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 36px;
    }
    .facture-totaux-box {
        width: 280px;
    }
    .facture-totaux-row {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        font-size: 14px;
        color: var(--text-soft);
    }
    .facture-totaux-row.total {
        border-top: 2px solid var(--dark);
        margin-top: 8px;
        padding-top: 12px;
        font-size: 18px;
        font-weight: 700;
        color: var(--dark);
        font-family: var(--font-display);
    }
    .facture-totaux-row.total span:last-child { color: var(--brand); }

    /* PIED */
    .facture-footer {
        text-align: center;
        padding-top: 24px;
        border-top: 1px solid #F0ECE6;
        font-size: 13px;
        color: var(--text-soft);
        line-height: 1.8;
    }

    @media print {
        .navbar, .footer, .facture-actions { display: none !important; }
        .facture-card { box-shadow: none; padding: 0; }
        body { background: #fff; }
    }

    @media (max-width: 768px) {
        .facture-card { padding: 24px; }
        .facture-header { flex-direction: column; gap: 16px; }
        .facture-numero-box { text-align: left; }
        .facture-parties { grid-template-columns: 1fr; }
        .facture-totaux { justify-content: stretch; }
        .facture-totaux-box { width: 100%; }
    }
</style>

<div class="facture-wrapper">

    <!-- ACTIONS -->
    <div class="facture-actions">
        <a href="{{ route('compte.factures') }}" style="color:var(--text-soft);text-decoration:none;font-size:14px;display:flex;align-items:center;gap:6px;">
            <i class="fa-solid fa-arrow-left"></i> Retour aux factures
        </a>
        <button onclick="window.print()" class="btn-primary" style="padding:10px 24px;font-size:14px;">
            <i class="fa-solid fa-print" style="margin-right:6px;"></i> Imprimer / PDF
        </button>
    </div>

    <!-- FACTURE -->
    <div class="facture-card">

        <!-- EN-TÊTE -->
        <div class="facture-header">
            <div>
                <div class="facture-brand">Atelier <span>à Deux</span></div>
                <div class="facture-brand-info">
                    Cotonou, Bénin<br>
                    +229 97 00 00 00<br>
                    contact@atelieradeux.com
                </div>
            </div>
            <div class="facture-numero-box">
                <div class="facture-numero-label">Facture</div>
                <div class="facture-numero">{{ $facture->numero_facture }}</div>
                <div class="facture-date">Date : {{ $facture->created_at->translatedFormat('d F Y') }}</div>
            </div>
        </div>

        <!-- PARTIES -->
        <div class="facture-parties">
            <div>
                <div class="facture-party-label">Émetteur</div>
                <div class="facture-party-name">Atelier à Deux</div>
                <div class="facture-party-info">
                    Cotonou, Bénin<br>
                    contact@atelieradeux.com
                </div>
            </div>
            <div>
                <div class="facture-party-label">Client</div>
                <div class="facture-party-name">{{ $facture->reservation->user->name }}</div>
                <div class="facture-party-info">
                    {{ $facture->reservation->user->email }}<br>
                    {{ $facture->reservation->user->telephone ?? '' }}
                </div>
            </div>
        </div>

        <!-- DÉTAILS -->
        <table class="facture-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Qté</th>
                    <th>Prix unitaire</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>{{ $facture->reservation->creneau->atelier->titre }}</strong><br>
                        <span style="font-size:12px;color:var(--text-soft);">
                            {{ \Carbon\Carbon::parse($facture->reservation->creneau->date)->translatedFormat('d F Y') }}
                            — {{ \Carbon\Carbon::parse($facture->reservation->creneau->heure_debut)->format('H:i') }}
                            à {{ \Carbon\Carbon::parse($facture->reservation->creneau->heure_fin)->format('H:i') }}
                        </span>
                    </td>
                    <td>{{ $facture->reservation->nombre_personnes }}</td>
                    <td>{{ number_format($facture->reservation->creneau->atelier->prix, 0, ',', ' ') }} FCFA</td>
                    <td>{{ number_format($facture->montant_ttc, 0, ',', ' ') }} FCFA</td>
                </tr>
            </tbody>
        </table>

        <!-- TOTAUX -->
        <div class="facture-totaux">
            <div class="facture-totaux-box">
                <div class="facture-totaux-row">
                    <span>Montant HT</span>
                    <span>{{ number_format($facture->montant_ht, 0, ',', ' ') }} FCFA</span>
                </div>
                <div class="facture-totaux-row">
                    <span>TVA (18%)</span>
                    <span>{{ number_format($facture->montant_ttc - $facture->montant_ht, 0, ',', ' ') }} FCFA</span>
                </div>
                <div class="facture-totaux-row total">
                    <span>Total TTC</span>
                    <span>{{ number_format($facture->montant_ttc, 0, ',', ' ') }} FCFA</span>
                </div>
            </div>
        </div>

        <!-- PIED -->
        <div class="facture-footer">
            <p>Merci pour votre confiance !</p>
            <p>Atelier à Deux — Cotonou, Bénin — contact@atelieradeux.com</p>
        </div>

    </div>
</div>
@endsection
