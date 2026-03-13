<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roti Kebanggaan - Production System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:wght@400;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-dark: #00271b;
            --primary-light: #00321c;
            --accent: #c2a35d; /* Gold-ish accent for a premium heritage feel */
            --bg-page: #f9f7f2; /* Cream/Ivory paper background */
            --bg-card: #ffffff;
            --text-main: #1a1a1a;
            --text-muted: #555555;
            --border-color: #d1d1d1;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: var(--bg-page);
            font-family: 'Inter', sans-serif;
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem 1rem;
        }

        header {
            text-align: center;
            margin-bottom: 3rem;
        }

        header h1 {
            font-family: 'Crimson Pro', serif;
            font-size: 2.8rem;
            color: var(--primary-dark);
            letter-spacing: 0.02em;
            margin-bottom: 0.3rem;
        }

        header p {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: var(--text-muted);
            font-weight: 500;
        }

        .main-container {
            width: 100%;
            max-width: 1000px;
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 3rem;
            align-items: start;
        }

        /* Responsive stack for smaller screens */
        @media (max-width: 850px) {
            .main-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
        }

        .form-card {
            background: var(--bg-card);
            padding: 2.5rem;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            border-radius: 4px;
        }

        h2.section-title {
            font-family: 'Crimson Pro', serif;
            font-size: 1.5rem;
            color: var(--primary-dark);
            margin-bottom: 1.5rem;
            border-bottom: 2px solid var(--primary-dark);
            display: inline-block;
            padding-bottom: 0.3rem;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--primary-dark);
        }

        input, select {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid var(--border-color);
            border-radius: 2px;
            font-size: 1rem;
            transition: all 0.2s;
        }

        input:focus {
            outline: none;
            border-color: var(--primary-dark);
            background-color: #fff;
            box-shadow: 0 0 0 2px rgba(0, 39, 27, 0.1);
        }

        .btn-submit {
            width: 100%;
            padding: 1rem;
            background-color: var(--primary-dark);
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: 1.5rem;
            transition: background-color 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
        }

        .btn-submit:hover {
            background-color: var(--primary-light);
        }

        /* Preview Section */
        .preview-pane {
            position: sticky;
            top: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
        }

        .preview-header {
            font-weight: 600;
            color: var(--text-muted);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .preview-header::before, .preview-header::after {
            content: "";
            width: 30px;
            height: 1px;
            background-color: var(--border-color);
        }

        /* Label Mockup Wrapper */
        .physical-label-mockup {
            width: 320px; /* Scaled from 40mm */
            height: 240px; /* Scaled from 30mm */
            background: #fff;
            border: 1px solid #000;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            position: relative;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            background-image: 
                radial-gradient(#eee 1px, transparent 1px);
            background-size: 20px 20px; /* Subtle grid to show scale */
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
            padding-bottom: 5px;
        }

        .td-dates {
            height: 50%;
            vertical-align: top;
            text-align: center;
            padding-top: 5px;
        }

        .product-name-preview {
            font-family: 'Times New Roman', serif;
            font-weight: bold;
            text-transform: uppercase;
            border-bottom: 2px solid #000;
            display: inline-block;
            line-height: 1;
            padding-bottom: 2px;
        }

        .date-line {
            font-family: 'Times New Roman', serif;
            font-size: 1.3rem;
            line-height: 1.4;
        }

        .footer {
            margin-top: 5rem;
            text-align: center;
            font-size: 0.8rem;
            color: var(--text-muted);
            border-top: 1px solid var(--border-color);
            padding-top: 2rem;
            width: 100%;
            max-width: 1000px;
        }
    </style>
</head>
<body>

    <header>
        <h1>Roti Kebanggaan</h1>
        <p>Sistem Produksi Label v2.0</p>
    </header>

    <main class="main-container">
        <!-- Form Section -->
        <section class="form-card">
            <h2 class="section-title">Konfigurasi Label</h2>
            
            <form id="labelForm" action="print.php" method="POST" target="_blank">
                <div class="form-group">
                    <label for="fn">NAMA PRODUK</label>
                    <input list="products" id="fn" name="fn" placeholder="Cari atau ketik nama produk..." required autocomplete="off">
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
                        <label for="prod_date">TANGGAL PRODUKSI</label>
                        <input type="date" id="prod_date" name="prod_date" required>
                    </div>

                    <div class="form-group">
                        <label for="bb_date">BEST BEFORE (BB)</label>
                        <input type="date" id="bb_date" name="bb_date" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="qty">JUMLAH CETAK</label>
                    <input type="number" id="qty" name="qty" min="1" value="1" required>
                </div>

                <button type="submit" class="btn-submit">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    CETAK LABEL PDF
                </button>
            </form>
        </section>

        <!-- Preview Section -->
        <section class="preview-pane">
            <div class="preview-header">Live Preview</div>
            
            <div class="physical-label-mockup" id="labelPreview">
                <table class="mockup-table">
                    <tr>
                        <td class="td-product">
                            <div class="product-name-preview" id="disp-fn">NAMA PRODUK</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="td-dates">
                            <div class="date-line"><strong>P:</strong> <span id="disp-p">DD/MM/YYYY</span></div>
                            <div class="date-line"><strong>BB:</strong> <span id="disp-bb">DD/MM/YYYY</span></div>
                        </td>
                    </tr>
                </table>
            </div>

            <div style="text-align: center; color: var(--text-muted); font-size: 0.8rem; line-height: 1.5;">
                Simulasi hasil cetak pada kertas label 40mm x 30mm.<br>
                Pastikan data sudah benar sebelum mencetak.
            </div>
        </section>
    </main>

    <footer class="footer">
        &copy; 2026 Roti Kebanggaan | Sistem Manajemen Produksi | DnnTech Professional
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const productIn = document.getElementById('fn');
            const prodDateIn = document.getElementById('prod_date');
            const bbDateIn = document.getElementById('bb_date');

            const dispFn = document.getElementById('disp-fn');
            const dispP = document.getElementById('disp-p');
            const dispBB = document.getElementById('disp-bb');

            // 1. Initial State
            const today = new Date();
            const todayStr = today.toISOString().split('T')[0];
            prodDateIn.value = todayStr;

            // Auto calculate BB (+3 days)
            const updateBB = (val) => {
                const date = new Date(val);
                date.setDate(date.getDate() + 3);
                bbDateIn.value = date.toISOString().split('T')[0];
                renderPreview();
            }

            updateBB(todayStr);

            // 2. Formatting Date (DD/MM/YYYY)
            function formatDate(str) {
                if(!str) return "DD/MM/YYYY";
                const [y, m, d] = str.split('-');
                return `${d}/${m}/${y}`;
            }

            // 3. Dynamic Font Refinement
            function refineFontSize(text) {
                const len = text.length;
                let size = 24; // Default preview px
                if (len > 12) {
                    size = Math.max(10, 24 * (12 / len));
                }
                dispFn.style.fontSize = size + 'px';
            }

            // 4. Main Render
            function renderPreview() {
                const name = productIn.value || "NAMA PRODUK";
                dispFn.textContent = name;
                dispP.textContent = formatDate(prodDateIn.value);
                dispBB.textContent = formatDate(bbDateIn.value);
                refineFontSize(name);
            }

            // 5. Listeners
            productIn.addEventListener('input', renderPreview);
            prodDateIn.addEventListener('change', (e) => updateBB(e.target.value));
            bbDateIn.addEventListener('change', renderPreview);

            renderPreview();
        });
    </script>
</body>
</html>
