<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roti Kebanggaan - Premium Label System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --glass-bg: rgba(255, 255, 255, 0.7);
            --glass-border: rgba(255, 255, 255, 0.3);
            --primary: #7c2d12;
            --primary-light: #9a3412;
            --accent: #f97316;
            --text-main: #431407;
            --text-muted: #78716c;
            --bg-gradient: linear-gradient(135deg, #fdf4ff 0%, #fff7ed 50%, #fff1f2 100%);
            --shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background: var(--bg-gradient);
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            color: var(--text-main);
        }

        /* Decorative Background elements */
        .blob {
            position: fixed;
            z-index: -1;
            filter: blur(80px);
            opacity: 0.4;
            border-radius: 50%;
        }
        .blob-1 { width: 400px; height: 400px; background: #fb923c; top: -100px; right: -100px; }
        .blob-2 { width: 300px; height: 300px; background: #f472b6; bottom: -50px; left: -50px; }

        .main-wrapper {
            width: 100%;
            max-width: 1000px;
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 2rem;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Glass Container */
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            box-shadow: var(--shadow);
            padding: 2.5rem;
        }

        h1 {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.5rem;
            letter-spacing: -0.02em;
        }

        .subtitle {
            color: var(--text-muted);
            font-size: 1rem;
            margin-bottom: 2.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 0.6rem;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        input, select {
            width: 100%;
            padding: 0.85rem 1.2rem;
            background: rgba(255, 255, 255, 0.5);
            border: 1px solid rgba(124, 45, 18, 0.1);
            border-radius: 12px;
            font-size: 1rem;
            color: var(--text-main);
            transition: all 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: var(--accent);
            background: white;
            box-shadow: 0 0 0 4px rgba(249, 115, 22, 0.1);
        }

        .btn-print {
            width: 100%;
            padding: 1.1rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 14px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-top: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
        }

        .btn-print:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -10px var(--primary);
        }

        /* Preview Sidebar */
        .preview-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
        }

        .preview-label-tag {
            font-size: 0.8rem;
            font-weight: 700;
            background: var(--accent);
            color: white;
            padding: 0.4rem 1rem;
            border-radius: 100px;
            text-transform: uppercase;
        }

        /* The Visual Mockup */
        .label-mockup {
            width: 320px; /* Scaled from 40mm */
            height: 240px; /* Scaled from 30mm */
            background: white;
            border: 2px dashed #d6d3d1;
            box-shadow: 0 20px 40px -15px rgba(0,0,0,0.1);
            border-radius: 4px;
            position: relative;
            display: flex;
            flex-direction: column;
            padding: 0;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .label-mockup::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            pointer-events: none;
            box-shadow: inset 0 0 40px rgba(0,0,0,0.02);
        }

        .mockup-table {
            width: 100%;
            height: 100%;
            border-collapse: collapse;
        }

        .mockup-product-cell {
            height: 50%;
            vertical-align: bottom;
            text-align: center;
            padding-bottom: 2mm;
        }

        .mockup-product-name {
            font-family: 'Times New Roman', serif;
            font-weight: bold;
            text-transform: uppercase;
            border-bottom: 2px solid #000;
            display: inline-block;
            padding-bottom: 2px;
            line-height: 1.1;
        }

        .mockup-date-cell {
            height: 50%;
            vertical-align: middle;
            text-align: center;
            font-family: 'Times New Roman', serif;
            font-size: 1.2rem;
        }

        .mockup-date-line {
            line-height: 1.4;
        }

        @media (max-width: 900px) {
            .main-wrapper {
                grid-template-columns: 1fr;
            }
            body { padding: 1rem; }
        }

        .footer {
            margin-top: 3rem;
            text-align: center;
            font-size: 0.8rem;
            color: var(--text-muted);
            grid-column: 1 / -1;
        }
    </style>
</head>
<body>

    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <main class="main-wrapper">
        <div class="glass-card">
            <h1>Roti Kebanggaan</h1>
            <p class="subtitle">Premium Manufacturing Label System</p>

            <form id="labelForm" action="print.php" method="POST" target="_blank">
                <div class="form-group">
                    <label for="fn">Nama Produk</label>
                    <input list="products" id="fn" name="fn" placeholder="Ketik atau pilih produk..." required autocomplete="off">
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
                        <label for="prod_date">Tgl Produksi (P)</label>
                        <input type="date" id="prod_date" name="prod_date" required>
                    </div>

                    <div class="form-group">
                        <label for="bb_date">Tgl Best Before (BB)</label>
                        <input type="date" id="bb_date" name="bb_date" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="qty">Jumlah Cetak (Qty)</label>
                    <input type="number" id="qty" name="qty" min="1" value="1" required>
                </div>

                <button type="submit" class="btn-print">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    Generate & Print PDF
                </button>
            </form>
        </div>

        <div class="preview-section">
            <span class="preview-label-tag">Live Preview</span>
            <div class="label-mockup" id="previewContainer">
                <table class="mockup-table">
                    <tr>
                        <td class="mockup-product-cell">
                            <div class="mockup-product-name" id="preview-fn">NAMA PRODUK</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="mockup-date-cell">
                            <div class="mockup-date-line"><strong>P:</strong> <span id="preview-p">DD/MM/YYYY</span></div>
                            <div class="mockup-date-line"><strong>BB:</strong> <span id="preview-bb">DD/MM/YYYY</span></div>
                        </td>
                    </tr>
                </table>
            </div>
            <p style="color: var(--text-muted); font-size: 0.85rem; text-align: center;">
                * Tampilan di atas adalah simulasi hasil cetak mPDF.<br/>
                Ukuran asli label: 40mm x 30mm.
            </p>
        </div>

        <div class="footer">
            © 2026 Roti Kebanggaan | Premium Edition by DnnTech
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('labelForm');
            const productInput = document.getElementById('fn');
            const prodDateInput = document.getElementById('prod_date');
            const bbDateInput = document.getElementById('bb_date');

            // Preview Elements
            const previewFn = document.getElementById('preview-fn');
            const previewP = document.getElementById('preview-p');
            const previewBB = document.getElementById('preview-bb');

            // 1. Initial Dates
            const today = new Date();
            const todayStr = today.toISOString().split('T')[0];
            prodDateInput.value = todayStr;

            // Smart BB Date Logic (+3 Days by default)
            const setSmartBB = (baseDateStr) => {
                const date = new Date(baseDateStr);
                date.setDate(date.getDate() + 3);
                bbDateInput.value = date.toISOString().split('T')[0];
                updatePreview();
            };

            setSmartBB(todayStr);

            // 2. Format Date for Preview (DD/MM/YYYY)
            const formatDate = (dateStr) => {
                if (!dateStr) return 'DD/MM/YYYY';
                const [y, m, d] = dateStr.split('-');
                return `${d}/${m}/${y}`;
            };

            // 3. Dynamic Font Size Calculation for Preview
            const updateFontSize = (text) => {
                const len = text.length;
                let size = 22; // Base preview size in px
                if (len > 12) {
                    size = Math.max(10, 22 * (12 / len));
                }
                previewFn.style.fontSize = size + 'px';
            };

            // 4. Update Preview Function
            const updatePreview = () => {
                const val = productInput.value || 'NAMA PRODUK';
                previewFn.textContent = val;
                previewP.textContent = formatDate(prodDateInput.value);
                previewBB.textContent = formatDate(bbDateInput.value);
                updateFontSize(val);
            };

            // 5. Event Listeners
            productInput.addEventListener('input', updatePreview);
            prodDateInput.addEventListener('change', (e) => {
                setSmartBB(e.target.value);
            });
            bbDateInput.addEventListener('change', updatePreview);

            // Initial Update
            updatePreview();
        });
    </script>
</body>
</html>
