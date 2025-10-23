<!DOCTYPE html>
<html>
<head>
    <title>Confectionery List</title>
    <style>
        body {
    font-family: 'Segoe UI', sans-serif;
    background: #1c1c1c;
    padding: 40px;
    color: #f0f0f0;
    animation: fadeIn 0.8s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

h1 {
    color: #ffdd57;
    text-align: center;
    margin-bottom: 40px;
    font-weight: 700;
    font-size: 3.8em;
    font-family: 'Brush Script MT', cursive;
    text-shadow: 1px 1px #000;
}

.legend {
    background: #2a2a2a;
    border: 1px solid #444;
    padding: 15px;
    margin-bottom: 30px;
    border-radius: 12px;
    box-shadow: 0 2px 4px rgba(255,255,255,0.05);
    color: #ccc;
}

.legend strong {
    display: inline-block;
    width: 30px;
    font-weight: 600;
    color: #ffdd57;
}

.confection {
    background: #2a2a2a;
    border: 1px solid #444;
    border-left: 6px solid #ff6f61;
    padding: 20px;
    margin-bottom: 30px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(255,255,255,0.04);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    animation: fadeIn 0.6s ease-in;
}

.confection:hover {
    transform: scale(1.02);
    box-shadow: 0 6px 12px rgba(255,255,255,0.08);
}

.confection h2 {
    margin: 0;
    font-size: 1.8em;
    color: #cf74f6ff;
    font-weight: bold;
    font-family: 'Brush Script MT', cursive;
    text-shadow: 1px 1px #000;
}

.confection h2 small {
    font-size: 0.6em;
    color: #aaa;
    font-family: sans-serif;
}

.prize {
    font-weight: bold;
    color: #2ecc71;
}

.not-prize {
    font-weight: bold;
    color: #e74c3c;
}

.info-line {
    margin-top: 10px;
    font-size: 1em;
    color: #ddd;
    padding: 8px;
    border-radius: 8px;
    transition: transform 0.3s ease, background-color 0.3s ease;
}

.info-line strong {
    color: #ffdd57;
}

.info-line:hover {
    transform: scale(1.02);
    background-color: #333;
}

    </style>
</head>
<body>
    <h1>Confectionery List</h1>

    <div class="legend">
        <strong>G</strong> = Gluten-free<br>
        <strong>L</strong> = Lactose-free<br>
        <strong>V</strong> = Vegan<br>
        <strong>HC</strong> = High-calcium<br>
        <strong>Te</strong> = Contains eggs
    </div>

    @foreach ($confections as $conf)
        <div class="confection">
            <h2>{{ $conf->cname }} <small>({{ $conf->type }})</small></h2>
            <p class="{{ $conf->prizewinning ? 'prize' : 'not-prize' }}">
                Prizewinning: {{ $conf->prizewinning ? 'Yes' : 'No' }}
            </p>

            <p class="info-line">
                <strong>Contents:</strong>
                @if ($conf->contents->count())
                    {{ $conf->contents->pluck('free')->implode(', ') }}
                @else
                    None
                @endif
            </p>

            <p class="info-line">
                <strong>Prices:</strong>
                @if ($conf->prices->count())
                    {{ $conf->prices->map(fn($p) => $p->price . ' ' . $p->unit)->implode(', ') }}
                @else
                    None
                @endif
            </p>
        </div>
    @endforeach
</body>
</html>
