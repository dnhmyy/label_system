<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roti Kebangggaan Label</title>
    <style>
        :root {
            --bg-color: #f8fafc;
            --card-bg: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;
            --primary-color: #0f172a;
            --primary-hover: #334155;
            --input-focus: #94a3b8;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-primary);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background-color: var(--card-bg);
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            width: 100%;
            max-width: 400px;
        }

        h1 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            text-align: center;
            color: var(--primary-color);
        }

        p.subtitle {
            text-align: center;
            color: var(--text-secondary);
            font-size: 0.875rem;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            font-size: 0.875rem;
            color: var(--text-primary);
        }

        input[type="text"],
        input[type="date"],
        input[type="number"],
        select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 1rem;
            color: var(--text-primary);
            box-sizing: border-box; /* Ensure padding doesn't affect width */
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input:focus {
            outline: none;
            border-color: var(--input-focus);
            box-shadow: 0 0 0 3px rgba(148, 163, 184, 0.2);
        }

        button {
            width: 100%;
            padding: 0.875rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-top: 1rem;
        }

        button:hover {
            background-color: var(--primary-hover);
        }

        .footer {
            margin-top: 2rem;
            text-align: center;
            font-size: 0.75rem;
            color: var(--text-secondary);
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Roti Kebanggaan</h1>
    <p class="subtitle">Production Label System</p>

    <form action="print.php" method="POST" target="_blank">
        <div class="form-group">
            <label for="fn">Nama Produk</label>
            <select id="fn" name="fn" required>
                <option value="" disabled selected>Pilih Produk...</option>
                
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
                    <option value="FN - RISOL MAKARONI">FN - RISOL MAKARONI</option>
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

        <div class="form-group">
            <label for="prod_date">Tanggal Produksi (P)</label>
            <input type="date" id="prod_date" name="prod_date" required>
        </div>

        <div class="form-group">
            <label for="bb_date">Tanggal Best Before (BB)</label>
            <input type="date" id="bb_date" name="bb_date" required>
        </div>

        <div class="form-group">
            <label for="qty">Jumlah Cetak (Qty)</label>
            <input type="number" id="qty" name="qty" min="1" value="1" required>
        </div>

        <button type="submit">Generate & Print PDF</button>
    </form>

    <div class="footer">
        © 2026 Roti Kebanggaan | DnnTech
    </div>
</div>

<script>
    // Set default date to today
    document.addEventListener('DOMContentLoaded', (event) => {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('prod_date').value = today;
        
        // Default BB to +3 days logic (optional convenience, can be changed manually)
        /*
        const futureDate = new Date();
        futureDate.setDate(futureDate.getDate() + 3);
        document.getElementById('bb_date').value = futureDate.toISOString().split('T')[0];
        */
    });
</script>

</body>
</html>
