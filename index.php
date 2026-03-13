<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roti Kebanggaan - Production Label System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
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
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .container {
            width: 100%;
            max-width: 1040px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2.5rem;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Form Card */
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
        }

        label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-main);
        }

        input, select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1.5px solid var(--border);
            border-radius: 12px;
            font-size: 1rem;
            color: var(--text-main);
            transition: all 0.2s;
            background: #fff;
        }

        input:focus {
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

        /* Preview Area */
        .preview-area {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 2rem;
            background: rgba(255,255,255,0.4);
            border-radius: 24px;
            padding: 2rem;
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
            border: 1px solid #000;
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1);
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .mockup-table {
            width: 100%;
            height: 100%;
            border-collapse: collapse;
        }

        .td-product {
            height: 50%;
            vertical-align: bottom;
            text-align: center;
            padding-bottom: 8px;
        }

        .display-fn {
            font-family: 'Times New Roman', serif;
            font-weight: bold;
            text-transform: uppercase;
            border-bottom: 2.5px solid #000;
            display: inline-block;
            line-height: 1;
            padding-bottom: 2px;
        }

        .td-dates {
            height: 50%;
            vertical-align: middle;
            text-align: center;
            font-family: 'Times New Roman', serif;
            font-size: 1.25rem;
        }

        .date-row {
            line-height: 1.5;
        }

        @media (max-width: 900px) {
            .container { grid-template-columns: 1fr; padding: 1rem; }
            body { padding: 0.5rem; }
        }

        .footer {
            margin-top: 3rem;
            grid-column: 1 / -1;
            text-align: center;
            font-size: 0.8rem;
            color: var(--text-muted);
        }
    </style>
</head>
<body>

    <main class="container">
        <section class="card">
            <div class="header-section">
                <img src="images/logo.png" alt="Logo" class="logo-img">
                <div class="brand-info">
                    <h1>Roti Kebanggaan</h1>
                    <p>Production System</p>
                </div>
            </div>

            <form id="labelForm" action="print.php" method="POST" target="_blank">
                <div class="form-group">
                    <label for="fn">Nama Produk</label>
                    <input list="products" id="fn" name="fn" placeholder="Ketik nama produk..." required autocomplete="off">
                    <datalist id="products">
                        <option value="BR - REF PER 2KG">
                        <option value="BR - MALINDA PER 2KG">
                        <option value="LAPIS SURABAYA">
                        <option value="LAPIS LEGIT">
                        <option value="BOLU PISANG">
                        <option value="PX - TA">
                        <option value="PX - TB">
                        <option value="PX - TG">
                        <option value="PX - PA">
                        <option value="PX - WC">
                        <option value="PX - WS">
                        <option value="PX - SL">
                        <option value="PX - PN">
                        <option value="PX - CC">
                        <option value="PX - MS">
                        <option value="S - TA">
                        <option value="S - TB">
                        <option value="S - TG">
                        <option value="S - PA">
                        <option value="S - MS">
                        <option value="FN - WC">
                        <option value="FN - WS">
                        <option value="FN - RISOL MAYO">
                        <option value="FN - MAKARONI">
                        <option value="IN - BK">
                        <option value="IN - BS">
                        <option value="IN - CB">
                        <option value="IN - CC">
                        <option value="IN - CJ">
                        <option value="IN - CJM">
                        <option value="IN - CN">
                        <option value="IN - JM">
                        <option value="IN - KA">
                        <option value="IN - KB">
                        <option value="IN - KCM">
                        <option value="IN - KCM PA">
                        <option value="IN - KM">
                        <option value="IN - KT">
                        <option value="IN - SL">
                        <option value="IN - SN">
                        <option value="IN - SS">
                        <option value="IN - WC">
                        <option value="IN - WS">
                        <option value="IN - BA">
                        <option value="IN - BG">
                        <option value="IN - CE">
                        <option value="IN - DG">
                        <option value="IN - KI">
                        <option value="IN - MA">
                        <option value="IN - MP">
                        <option value="IN - SB">
                        <option value="IN - CKK">
                        <option value="IN - TR">
                        <option value="IN - CF">
                        <option value="IN - CCB">
                        <option value="TPG - BK">
                        <option value="TPG - SL">
                        <option value="TPG - KT">
                        <option value="TPG - SAM">
                        <option value="TPG - SN">
                    </datalist>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    Generate & Print PDF
                </button>
            </form>
        </section>

        <section class="preview-area">
            <span class="privew-badge">Digital Mockup</span>
            <div class="label-mockup">
                <table class="mockup-table">
                    <tr>
                        <td class="td-product">
                            <div class="display-fn" id="live-fn">NAMA PRODUK</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="td-dates">
                            <div class="date-row"><strong>P:</strong> <span id="live-p">00/00/0000</span></div>
                            <div class="date-row"><strong>BB:</strong> <span id="live-bb">00/00/0000</span></div>
                        </td>
                    </tr>
                </table>
            </div>
            <p style="font-size: 0.8rem; color: var(--text-muted); text-align: center;">
                * Sesuai standar cetak 40x30mm<br>
                Times New Roman font rendering
            </p>
        </section>

        <footer class="footer">
            &copy; 2026 Roti Kebanggaan | DnnTech Professional Platform
        </footer>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const prodIn = document.getElementById('prod_date');
            const bbIn = document.getElementById('bb_date');
            const fnIn = document.getElementById('fn');

            const liveFn = document.getElementById('live-fn');
            const liveP = document.getElementById('live-p');
            const liveBB = document.getElementById('live-bb');

            // 1. Initial Dates
            const today = new Date();
            prodIn.value = today.toISOString().split('T')[0];

            function updateBB(baseDate) {
                const date = new Date(baseDate);
                date.setDate(date.getDate() + 3);
                bbIn.value = date.toISOString().split('T')[0];
                updatePreview();
            }

            updateBB(prodIn.value);

            // 2. Format
            function fmt(val) {
                if(!val) return "00/00/0000";
                const [y, m, d] = val.split('-');
                return `${d}/${m}/${y}`;
            }

            // 3. Font Scale
            function scaleFont(text) {
                const len = text.length;
                let size = 22; // Base px
                if (len > 12) size = Math.max(10, 22 * (12 / len));
                liveFn.style.fontSize = size + 'px';
            }

            // 4. Update
            function updatePreview() {
                const name = fnIn.value || "NAMA PRODUK";
                liveFn.textContent = name;
                liveP.textContent = fmt(prodIn.value);
                liveBB.textContent = fmt(bbIn.value);
                scaleFont(name);
            }

            fnIn.addEventListener('input', updatePreview);
            prodIn.addEventListener('change', (e) => updateBB(e.target.value));
            bbIn.addEventListener('change', updatePreview);

            updatePreview();
        });
    </script>
</body>
</html>
