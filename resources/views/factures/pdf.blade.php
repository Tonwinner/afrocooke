<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        /* Reset et base */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #333; line-height: 1.6; }

        /* En-tête facture */
        .header { display: flex; justify-content: space-between; margin-bottom: 40px; }
        .company-name { font-size: 22px; font-weight: bold; color: #1a9e7a; }
        .company-info { font-size: 10px; color: #888; margin-top: 4px; }
        .invoice-title { text-align: right; }
        .invoice-title h1 { font-size: 28px; color: #1a9e7a; font-weight: bold; letter-spacing: 2px; }
        .invoice-number { font-size: 12px; color: #888; margin-top: 4px; }

        /* Infos client + réservation */
        .info-grid { width: 100%; margin-bottom: 30px; }
        .info-grid td { vertical-align: top; padding: 0; }
        .info-box { background: #f8f7f4; border-radius: 6px; padding: 16px; }
        .info-box h3 { font-size: 10px; text-transform: uppercase; letter-spacing: 1.5px; color: #888; margin-bottom: 8px; }
        .info-box p { font-size: 12px; color: #333; margin-bottom: 3px; }

        /* Tableau des prestations */
        .table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .table th { background: #1a9e7a; color: #fff; padding: 10px 14px; text-align: left; font-size: 10px; text-transform: uppercase; letter-spacing: 1px; }
        .table td { padding: 12px 14px; border-bottom: 1px solid #eee; font-size: 12px; }
        .table tr:last-child td { border-bottom: none; }
        .table .text-right { text-align: right; }

        /* Totaux */
        .totals { width: 280px; margin-left: auto; }
        .totals td { padding: 6px 14px; font-size: 12px; }
        .totals .total-row td { border-top: 2px solid #1a9e7a; font-weight: bold; font-size: 14px; color: #1a9e7a; padding-top: 10px; }
        .totals .label { color: #888; }

        /* Footer */
        .footer { margin-top: 50px; padding-top: 16px; border-top: 1px solid #eee; text-align: center; font-size: 9px; color: #aaa; }
        .footer p { margin-bottom: 2px; }

        /* Badge payé */
        .paid-badge { display: inline-block; background: #e6f7f0; color: #1a9e7a; padding: 4px 14px; border-radius: 4px; font-size: 11px; font-weight: bold; letter-spacing: 1px; text-transform: uppercase; }
    </style>
</head>
<body style="padding: 40px;">

    {{-- En-tête --}}
    <table width="100%" style="margin-bottom: 40px;">
        <tr>
            <td>
                <div class="company-name">Atelier à Deux</div>
                <div class="company-info">
                    Cotonou, Bénin<br>
                    +229 97 00 00 00<br>
                    contact@atelieradeux.com
                </div>
            </td>
            <td style="text-align: right;">
                <h1 style="font-size: 28px; color: #1a9e7a; font-weight: bold; letter-spacing: 2px;">FACTURE</h1>
                <div style="font-size: 12px; color: #888; margin-top: 4px;">
                    N° {{ $facture->numero_facture }}<br>
                    Date : {{ $facture->created_at->format('d/m/Y') }}
                </div>
                <div style="margin-top: 8px;">
                    <span class="paid-badge">PAYÉE</span>
                </div>
            </td>
        </tr>
    </table>

    {{-- Infos client + réservation --}}
    <table class="info-grid" width="100%" cellspacing="10">
        <tr>
            <td width="50%">
                <div class="info-box">
                    <h3>Client</h3>
                    <p><strong>{{ $facture->reservation->user->name }}</strong></p>
                    <p>{{ $facture->reservation->user->email }}</p>
                    @if($facture->reservation->user->telephone)
                        <p>{{ $facture->reservation->user->telephone }}</p>
                    @endif
                    @if($facture->reservation->user->adresse)
                        <p>{{ $facture->reservation->user->adresse }}</p>
                    @endif
                </div>
            </td>
            <td width="50%">
                <div class="info-box">
                    <h3>Réservation</h3>
                    <p><strong>{{ $facture->reservation->creneau->atelier->titre }}</strong></p>
                    <p>Date : {{ \Carbon\Carbon::parse($facture->reservation->creneau->date)->format('d/m/Y') }}</p>
                    <p>Horaire : {{ \Carbon\Carbon::parse($facture->reservation->creneau->heure_debut)->format('H:i') }} — {{ \Carbon\Carbon::parse($facture->reservation->creneau->heure_fin)->format('H:i') }}</p>
                    @if($facture->reservation->creneau->chef)
                        <p>Chef : {{ $facture->reservation->creneau->chef->name }}</p>
                    @endif
                </div>
            </td>
        </tr>
    </table>

    {{-- Tableau prestation --}}
    <table class="table">
        <thead>
            <tr>
                <th>Description</th>
                <th class="text-right">Participants</th>
                <th class="text-right">Prix unitaire</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <strong>{{ $facture->reservation->creneau->atelier->titre }}</strong><br>
                    <span style="font-size: 10px; color: #888;">
                        Atelier de cuisine — {{ $facture->reservation->creneau->atelier->origine_pays }}
                        — {{ $facture->reservation->creneau->atelier->duree_minutes }} min
                    </span>
                </td>
                <td class="text-right">{{ $facture->reservation->nombre_personnes }}</td>
                <td class="text-right">{{ number_format($facture->reservation->creneau->atelier->prix, 0, ',', ' ') }} FCFA</td>
                <td class="text-right"><strong>{{ number_format($facture->montant_ttc, 0, ',', ' ') }} FCFA</strong></td>
            </tr>
        </tbody>
    </table>

    {{-- Totaux --}}
    <table class="totals">
        <tr>
            <td class="label">Montant HT</td>
            <td class="text-right">{{ number_format($facture->montant_ht, 0, ',', ' ') }} FCFA</td>
        </tr>
        <tr>
            <td class="label">TVA (18%)</td>
            <td class="text-right">{{ number_format($facture->montant_ttc - $facture->montant_ht, 0, ',', ' ') }} FCFA</td>
        </tr>
        <tr class="total-row">
            <td>Total TTC</td>
            <td class="text-right">{{ number_format($facture->montant_ttc, 0, ',', ' ') }} FCFA</td>
        </tr>
    </table>

    {{-- Footer --}}
    <div class="footer">
        <p><strong>Atelier à Deux</strong> — Ateliers de cuisine africaine en duo</p>
        <p>Cotonou, Bénin — contact@atelieradeux.com — +229 97 00 00 00</p>
        <p style="margin-top: 8px;">Merci pour votre confiance !</p>
    </div>

</body>
</html>