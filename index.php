<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roti Kebanggaan - Production Label System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary: #00271b;
            --primary-light: #003d2b;
            --bg-body: #f8fafc;
            --bg-card: #ffffff;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --shadow: 0 10px 15px -3px rgb(0 0 0 / 0.05), 0 4px 6px -4px rgb(0 0 0 / 0.05);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            position: relative;
        }

        .container {
            width: 100%;
            max-width: 1040px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2.5rem;
            animation: slideUp 0.6s ease-out;
            margin-bottom: 4rem;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            background: var(--bg-card);
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
        }

        .header-section {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            margin-bottom: 2.5rem;
        }

        .logo-img {
            height: 54px;
            width: auto;
            object-fit: contain;
        }

        .brand-info h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            letter-spacing: -0.01em;
        }

        .brand-info p {
            font-size: 0.825rem;
            color: var(--text-muted);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1.5px solid var(--border);
            border-radius: 12px;
            font-size: 1rem;
            color: var(--text-main);
            transition: all 0.2s;
            background: #fff;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1.25rem;
        }

        input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1.5px solid var(--border);
            border-radius: 12px;
            font-size: 1rem;
            color: var(--text-main);
            transition: all 0.2s;
            background: #fff;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(0, 39, 27, 0.08);
        }

        .btn-submit {
            width: 100%;
            padding: 1rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            margin-top: 1rem;
        }

        .btn-submit:hover {
            background: var(--primary-light);
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(0, 39, 27, 0.15);
        }

        .preview-area {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 2rem;
            background: rgba(255, 255, 255, 0.4);
            border-radius: 24px;
            padding: 2.5rem;
            border: 1px dashed var(--border);
        }

        .privew-badge {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--primary);
            background: rgba(0, 39, 27, 0.05);
            padding: 0.4rem 1rem;
            border-radius: 99px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .label-mockup {
            width: 320px;
            height: 240px;
            background: white;
            border: 2px solid #000;
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1);
            display: grid;
            grid-template-rows: 32% 37% 31%;
            padding: 10px 16px 10px 28px;
            position: relative;
        }

        .display-fn {
            font-family: 'Times New Roman', serif;
            font-weight: bold;
            text-transform: uppercase;
            border-bottom: 3px solid #000;
            line-height: 1.1;
            padding-bottom: 5px;
            font-size: 28px;
            text-align: left;
            align-self: center;
            white-space: normal;
            word-break: break-word;
            letter-spacing: 0.01em;
        }

        .mockup-dates {
            text-align: left;
            font-family: 'Times New Roman', serif;
            font-size: 1.2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .date-row {
            line-height: 1.4;
        }

        .mockup-barcode {
            display: flex;
            align-items: center;
            gap: 1.5px;
            height: 100%;
            justify-content: flex-start;
            width: 100%;
            overflow: hidden;
            align-self: center;
            padding-top: 2px;
        }

        .mockup-barcode .bar {
            background: #000;
            height: 70%;
        }

        @media (max-width: 900px) {
            .container {
                grid-template-columns: 1fr;
                padding: 1rem;
            }

            body {
                padding: 0.5rem;
            }
        }

        .footer {
            margin-top: 2rem;
            text-align: center;
            font-size: 0.75rem;
            color: var(--text-muted);
            opacity: 0.5;
        }
    </style>
</head>

<body>

    <main class="container">
        <section class="card">
            <div class="header-section">
                <img src="images/logo.webp" alt="Logo" class="logo-img">
                <div class="brand-info">
                    <h1>Roti Kebanggaan</h1>
                    <p>Production Label System</p>
                </div>
            </div>

            <form id="labelForm" action="print.php" method="POST" target="_blank">
                <div class="form-group">
                    <label for="fn">Nama Produk</label>
                    <select id="fn" name="fn" required>
                        <option value="" disabled selected>Pilih Produk...</option>
                        <optgroup label="BR Series">
                            <option value="BR - REF PER 2KG">BR - REF PER 2KG</option>
                            <option value="BR - MALINDA PER 2KG">BR - MALINDA PER 2KG</option>
                        </optgroup>
                        <optgroup label="CAKE Series">
                            <option value="LAPIS SURABAYA">LAPIS SURABAYA</option>
                            <option value="LAPIS LEGIT">LAPIS LEGIT</option>
                            <option value="BOLU PISANG">BOLU PISANG</option>
                        </optgroup>
                        <optgroup label="PX Series">
                            <option value="PX - TA">PX - TA</option>
                            <option value="PX - TB">PX - TB</option>
                            <option value="PX - TG">PX - TG</option>
                            <option value="PX - PA">PX - PA</option>
                            <option value="PX - WC">PX - WC</option>
                            <option value="PX - WS">PX - WS</option>
                            <option value="PX - SL">PX - SL</option>
                            <option value="PX - PN">PX - PN</option>
                            <option value="PX - CC">PX - CC</option>
                            <option value="PX - MS">PX - MS</option>
                        </optgroup>
                        <optgroup label="S Series">
                            <option value="S - TA">S - TA</option>
                            <option value="S - TB">S - TB</option>
                            <option value="S - TG">S - TG</option>
                            <option value="S - PA">S - PA</option>
                            <option value="S - MS">S - MS</option>
                        </optgroup>
                        <optgroup label="FN Series">
                            <option value="FN - WC">FN - WC</option>
                            <option value="FN - WS">FN - WS</option>
                            <option value="FN - RISOL MAYO">FN - RISOL MAYO</option>
                            <option value="FN - MAKARONI">FN - MAKARONI</option>
                        </optgroup>
                        <optgroup label="IN Series">
                            <option value="IN - BK">IN - BK</option>
                            <option value="IN - BS">IN - BS</option>
                            <option value="IN - CB">IN - CB</option>
                            <option value="IN - CC">IN - CC</option>
                            <option value="IN - CJ">IN - CJ</option>
                            <option value="IN - CJM">IN - CJM</option>
                            <option value="IN - CN">IN - CN</option>
                            <option value="IN - JM">IN - JM</option>
                            <option value="IN - KA">IN - KA</option>
                            <option value="IN - KB">IN - KB</option>
                            <option value="IN - KCM">IN - KCM</option>
                            <option value="IN - KCM PA">IN - KCM PA</option>
                            <option value="IN - KM">IN - KM</option>
                            <option value="IN - KT">IN - KT</option>
                            <option value="IN - SL">IN - SL</option>
                            <option value="IN - SN">IN - SN</option>
                            <option value="IN - SS">IN - SS</option>
                            <option value="IN - WC">IN - WC</option>
                            <option value="IN - WS">IN - WS</option>
                            <option value="IN - BA">IN - BA</option>
                            <option value="IN - BG">IN - BG</option>
                            <option value="IN - CE">IN - CE</option>
                            <option value="IN - DG">IN - DG</option>
                            <option value="IN - KI">IN - KI</option>
                            <option value="IN - MA">IN - MA</option>
                            <option value="IN - MP">IN - MP</option>
                            <option value="IN - SB">IN - SB</option>
                            <option value="IN - CKK">IN - CKK</option>
                            <option value="IN - TR">IN - TR</option>
                            <option value="IN - CF">IN - CF</option>
                            <option value="IN - CCB">IN - CCB</option>
                        </optgroup>
                        <optgroup label="TPG Series">
                            <option value="TPG - BK">TPG - BK</option>
                            <option value="TPG - SL">TPG - SL</option>
                            <option value="TPG - KT">TPG - KT</option>
                            <option value="TPG - SAM">TPG - SAM</option>
                            <option value="TPG - SN">TPG - SN</option>
                        </optgroup>
                    </select>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                    <div class="form-group">
                        <label for="prod_date">P (Produksi)</label>
                        <input type="date" id="prod_date" name="prod_date" required>
                    </div>

                    <div class="form-group">
                        <label for="bb_date">BB (Best Before)</label>
                        <input type="date" id="bb_date" name="bb_date" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="qty">Jumlah Cetak</label>
                    <input type="number" id="qty" name="qty" min="1" value="1" required>
                </div>

                <button type="submit" class="btn-submit">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                        </path>
                    </svg>
                    Generate & Print PDF
                </button>

                <footer class="footer">
                    &copy; 2026 Roti Kebanggaan | DnnTech
                </footer>
            </form>
        </section>

        <section class="preview-area">
            <span class="privew-badge">Digital Mockup</span>
            <div class="label-mockup">
                <div class="display-fn" id="live-fn">NAMA PRODUK</div>
                <div class="mockup-dates">
                    <div class="date-row"><strong>P:</strong> <span id="live-p">00/00/0000</span></div>
                    <div class="date-row"><strong>BB:</strong> <span id="live-bb">00/00/0000</span></div>
                </div>
                <div class="mockup-barcode" id="live-barcode"></div>
            </div>
            <p style="font-size: 0.8rem; color: var(--text-muted); text-align: center;">
                * Sesuai standar cetak 40x30mm<br>
                Barcode: Code 128 (Nama Produk + P + BB)
            </p>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const prodIn = document.getElementById('prod_date');
            const bbIn = document.getElementById('bb_date');
            const fnIn = document.getElementById('fn');

            const liveFn = document.getElementById('live-fn');
            const liveP = document.getElementById('live-p');
            const liveBB = document.getElementById('live-bb');
            const liveBarcode = document.getElementById('live-barcode');

            // seed production date with today
            const today = new Date();
            prodIn.value = today.toISOString().split('T')[0];

            function updateBB(baseDate) {
                if (!baseDate) return;
                const date = new Date(baseDate);
                date.setDate(date.getDate() + 3);
                bbIn.value = date.toISOString().split('T')[0];
                updatePreview();
            }

            updateBB(prodIn.value);

            function fmt(val) {
                if (!val) return "00/00/0000";
                const [y, m, d] = val.split('-');
                return `${d}/${m}/${y}`;
            }

            function scaleFont(text) {
                const len = text.length;
                let size = 28;
                let lineHeight = 1.1;
                if (len > 14) size = 24;
                if (len > 18) {
                    size = 20;
                    lineHeight = 1.0;
                }
                if (len > 24) {
                    size = 17;
                    lineHeight = 0.95;
                }
                liveFn.style.fontSize = size + 'px';
                liveFn.style.lineHeight = lineHeight;
            }

            function normalizeBarcodePart(value) {
                return (value || '').trim().replace(/\s+/g, ' ').toUpperCase();
            }

            function buildBarcodeValue() {
                return `FN:${normalizeBarcodePart(fnIn.value)}|P:${normalizeBarcodePart(prodIn.value)}|BB:${normalizeBarcodePart(bbIn.value)}`;
            }

            // keep the preview deterministic for the current payload
            function renderBarcode(code) {
                liveBarcode.innerHTML = '';
                const value = code || 'FN:|P:|BB:';
                const bars = [];
                // quiet zone
                bars.push({ w: 2, black: true });
                bars.push({ w: 1, black: false });
                bars.push({ w: 2, black: true });
                bars.push({ w: 1, black: false });
                for (let i = 0; i < value.length; i++) {
                    const charCode = value.charCodeAt(i);
                    bars.push({ w: (charCode % 3) + 1, black: true });
                    bars.push({ w: ((charCode >> 1) % 2) + 1, black: false });
                    bars.push({ w: ((charCode >> 2) % 3) + 1, black: true });
                    bars.push({ w: 1, black: false });
                }
                bars.push({ w: 2, black: true });
                bars.push({ w: 1, black: false });
                bars.push({ w: 2, black: true });

                bars.forEach(b => {
                    const el = document.createElement('div');
                    el.className = 'bar';
                    el.style.width = b.w + 'px';
                    if (!b.black) {
                        el.style.background = 'transparent';
                    }
                    liveBarcode.appendChild(el);
                });
            }

            function updatePreview() {
                liveFn.textContent = fnIn.value || "NAMA PRODUK";
                liveP.textContent = fmt(prodIn.value);
                liveBB.textContent = fmt(bbIn.value);
                scaleFont(liveFn.textContent);
                renderBarcode(buildBarcodeValue());
            }

            const labelForm = document.getElementById('labelForm');
            const qtyIn = document.getElementById('qty');

            labelForm.addEventListener('submit', (e) => {
                const qty = parseInt(qtyIn.value);

                if (qty > 200) {
                    alert("Maaf, maksimal cetak sekali jalan adalah 200 label.");
                    e.preventDefault();
                    return;
                }
            });

            fnIn.addEventListener('change', updatePreview);
            prodIn.addEventListener('change', (e) => updateBB(e.target.value));
            bbIn.addEventListener('change', updatePreview);

            updatePreview();
        });
    </script>
</body>

</html>
