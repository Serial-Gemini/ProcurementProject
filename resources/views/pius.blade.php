<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shantha Motors Enterprise Portal - Laragon Laravel Edition</title>
    <style>
        :root {
            --bg-main: #0F2A4A;
            --sidebar-bg: #0d2440;
            --topbar-bg: #14355e;
            --text-color: #858282;
            --card-bg: #1a4270;
            --table-header: #14355e;
            --table-row: #b0b0b0;
            --panel-bg: #1a4270;
            --border-color: #2b5c91;
        }

        [data-theme="dark"] {
            --bg-main: #0F2A4A;
            --sidebar-bg: #0d2440;
            --topbar-bg: #14355e;
            --text-color: #e9e9e9;
            --card-bg: #1a4270;
            --table-header: #14355e;
            --table-row: #b0b0b0;
            --panel-bg: #1a4270;
            --border-color: #2b5c91;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            transition: background-color 0.15s ease, border-color 0.15s ease;
        }

        body {
            background-color: var(--bg-main);
            color: var(--text-color);
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .sidebar {
            width: 260px;
            background-color: var(--sidebar-bg);
            padding: 25px 15px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border-right: 2px solid var(--border-color);
            z-index: 10;
        }

        .brand-block {
            text-align: center;
            margin-bottom: 25px;
        }

        .brand-logo-svg {
            width: 65px;
            height: 65px;
            margin-bottom: 8px;
            fill: #ffffff;
        }

        .brand-name {
            color: #ffffff;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .brand-sub {
            color: #d8c5ff;
            font-size: 11px;
            letter-spacing: 4px;
            text-transform: uppercase;
            margin-top: 2px;
            font-weight: 600;
        }

        .nav-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
            width: 100%;
        }

        .nav-link {
            text-decoration: none;
            width: 100%;
            display: block;
        }

        .nav-btn {
            width: 100%;
            padding: 12px 14px;
            border-radius: 25px;
            font-size: 11px;
            font-weight: 700;
            text-align: center;
            cursor: pointer;
            border: none;
            display: block;
            transition: all 0.2s ease-in-out;
        }

        .nav-btn.inactive {
            background-color: #ffffff;
            color: #3f1b85;
        }

        .nav-btn.inactive:hover {
            background-color: #f3edff;
            transform: translateY(-1px);
        }

        .nav-btn.active {
            background: linear-gradient(135deg, #a77df7, #703cd1);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(112, 60, 209, 0.35);
        }

        .sidebar-footer {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%;
        }

        .footer-action-btn {
            width: 100%;
            padding: 11px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            text-align: center;
        }

        .btn-theme-toggle {
            background-color: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-color);
        }

        .main-viewport {
            flex: 1;
            display: flex;
            flex-direction: column;
            height: 100%;
            overflow: hidden;
        }

        .topbar {
            background-color: var(--topbar-bg);
            height: 65px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            letter-spacing: 1.5px;
            font-size: 18px;
            text-transform: uppercase;
            box-shadow: 0 2px 10px rgba(0,0,0,0.15);
            z-index: 5;
        }

        .content-workspace {
            flex: 1;
            padding: 25px;
            overflow-y: auto;
            background-color: var(--bg-main);
        }

        .sub-tab-bar {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .sub-tab-btn {
            flex: 1;
            padding: 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            background-color: var(--panel-bg);
            color: var(--text-color);
        }

        .sub-tab-btn.active {
            background-color: var(--topbar-bg);
            color: #ffffff;
        }

        .app-view {
            display: none;
        }

        .app-view.active-view {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .data-panel {
            background-color: var(--card-bg);
            border-radius: 8px;
            border: 1px solid var(--border-color);
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .panel-header-strip {
            background-color: var(--table-header);
            color: white;
            padding: 10px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }

        .custom-table-container {
            overflow-x: auto;
            border-radius: 6px;
            border: 1px solid var(--border-color);
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .custom-table th {
            background-color: var(--table-header);
            color: white;
            text-align: left;
            padding: 12px 15px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
        }

        .custom-table td {
            padding: 12px 15px;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-color);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .form-row-full {
            grid-column: span 2;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .input-group label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--text-color);
            opacity: 0.8;
        }

        .input-field {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid var(--border-color);
            background-color: var(--bg-main);
            color: var(--text-color);
            font-size: 13px;
            outline: none;
        }

        .verification-checklist {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 10px;
        }

        .check-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px;
            border-radius: 5px;
            background-color: var(--bg-main);
            border: 1px solid var(--border-color);
        }

        .check-item input[type="checkbox"] {
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .three-way-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .matching-card {
            background-color: var(--bg-main);
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 15px;
        }

        .matching-card-title {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 5px;
            margin-bottom: 10px;
            color: var(--table-header);
        }

        .btn-action-primary {
            background-color: var(--topbar-bg);
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-action-primary:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .btn-action-danger {
            background-color: #c0392b;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<!-- SHIMMY SHIMMY YAY -->
 <!-- swalalala -->
  <!-- swalalala -->
<body data-theme="dark">

    <div class="sidebar">
        <div>
            

            

        </div>
    </div>

    <div class="main-viewport">
        <div class="topbar" id="app-topbar-title">
            Goods Receipt & Invoice Matching
        </div>

        <div class="content-workspace">

            <div class="sub-tab-bar">
                <button class="sub-tab-btn active" id="btn-receipt" onclick="switchTab('receipt')">Goods Receipt Entry</button>
                <button class="sub-tab-btn" id="btn-matching" onclick="switchTab('matching')">Three-Way Matching Verification</button>
            </div>

            <div class="app-view active-view" id="view-receipt">
                <div class="data-panel">
                    <div class="panel-header-strip">Record Received Cargo</div>
                    <form id="goods-receipt-form" onsubmit="handleReceiptSubmit(event)">
                        <div class="form-grid">
                            <div class="input-group">
                                <label>Purchase Order Association Number</label>
                                <input type="text" id="po_number" class="input-field" placeholder="e.g. PO-2026-001" required>
                            </div>
                            <div class="input-group">
                                <label>Associated Supplier Name</label>
                                <input type="text" id="supplier_name" class="input-field" placeholder="e.g. Apex Autoparts Ltd" required>
                            </div>
                            <div class="input-group">
                                <label>Delivery Cargo Ticket Number</label>
                                <input type="text" id="delivery_ticket" class="input-field" placeholder="e.g. DN-9941" required>
                            </div>
                            <div class="input-group">
                                <label>Receipt Receiving Date</label>
                                <input type="date" id="receiving_date" class="input-field" required>
                            </div>
                            <div class="input-group form-row-full">
                                <label>Delivered Material Items Description & SKU</label>
                                <input type="text" id="item_desc" class="input-field" placeholder="e.g. V8 Engine Block Assembly, SKU-1044" required>
                            </div>
                            <div class="input-group">
                                <label>Total Quantity Pack Units Dispatched</label>
                                <input type="number" id="qty_received" class="input-field" placeholder="e.g. 5" required>
                            </div>
                            <div class="input-group">
                                <label>Invoiced Cost Valuation Statement</label>
                                <input type="number" id="invoice_val" class="input-field" placeholder="e.g. 24500" required>
                            </div>
                            <div class="form-row-full" style="display: flex; gap: 10px; justify-content: flex-end; margin-top: 10px;">
                                <button type="button" class="btn-action-danger" onclick="clearDatabase()">Flush Database</button>
                                <button type="submit" class="btn-action-primary">Process Receipt Cargo</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="data-panel">
                    <div class="panel-header-strip">Active Records Directory</div>
                    <div class="custom-table-container">
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th>PO Target</th>
                                    <th>Supplier Source</th>
                                    <th>Delivery Ticket</th>
                                    <th>Description</th>
                                    <th>Qty</th>
                                    <th>Value</th>
                                    <th>System Verification Status</th>
                                </tr>
                            </thead>
                            <tbody id="receipts-table-body"></tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="app-view" id="view-matching">
                <div class="data-panel">
                    <div class="panel-header-strip">Cross-Compare Validation Pipeline</div>
                    
                    <div id="matching-selection-area">
                        <div class="input-group" style="margin-bottom: 20px;">
                            <label>Select Pending Delivery System Record for Cross-Check</label>
                            <select id="verification-selector" class="input-field" onchange="loadSelectedMatchingItem(this.value)">
                                <option value="">-- Select Active Record --</option>
                            </select>
                        </div>
                    </div>

                    <div id="matching-workspace-details" style="display: none;">
                        <div class="three-way-grid">
                            <div class="matching-card">
                                <div class="matching-card-title">1. Purchase Order Specs</div>
                                <p style="font-size: 13px; margin-bottom: 5px;"><strong>PO Target:</strong> <span id="match-po-num"></span></p>
                                <p style="font-size: 13px; margin-bottom: 5px;"><strong>Expected Qty:</strong> <span id="match-po-qty"></span> units</p>
                                <p style="font-size: 13px;"><strong>Authorized Cost:</strong> $<span id="match-po-cost"></span></p>
                            </div>
                            <div class="matching-card">
                                <div class="matching-card-title">2. Goods Receipt Specs</div>
                                <p style="font-size: 13px; margin-bottom: 5px;"><strong>Supplier:</strong> <span id="match-rec-sup"></span></p>
                                <p style="font-size: 13px; margin-bottom: 5px;"><strong>Delivered Qty:</strong> <span id="match-rec-qty"></span> units</p>
                                <p style="font-size: 13px;"><strong>Delivery Ticket:</strong> <span id="match-rec-ticket"></span></p>
                            </div>
                            <div class="matching-card">
                                <div class="matching-card-title">3. Invoiced Billing Specs</div>
                                <p style="font-size: 13px; margin-bottom: 5px;"><strong>Billed Statement:</strong> $<span id="match-inv-val"></span></p>
                                <p style="font-size: 13px; margin-bottom: 5px;"><strong>Cargo Item:</strong> <span id="match-inv-desc"></span></p>
                                <p style="font-size: 13px;"><strong>Invoiced Cost:</strong> $<span id="match-inv-cost"></span></p>
                            </div>
                        </div>

                        <div class="verification-checklist">
                            <div class="check-item">
                                <input type="checkbox" id="check_price" onchange="updateVerificationStep('check_price', this.checked)">
                                <label for="check_price">Prices on PO, Invoice, and Bill Match Exactly</label>
                            </div>
                            <div class="check-item">
                                <input type="checkbox" id="check_delivery" onchange="updateVerificationStep('check_delivery', this.checked)">
                                <label for="check_delivery">Quantities Ordered Match Physical Quantities Received</label>
                            </div>
                            <div class="check-item">
                                <input type="checkbox" id="check_payment" onchange="updateVerificationStep('check_payment', this.checked)">
                                <label for="check_payment">Supplier Payment Terms and Names are Logistically Correct</label>
                            </div>
                        </div>

                        <div style="display: flex; justify-content: flex-end; margin-top: 20px;">
                            <button id="main-confirm-btn" class="btn-action-primary" disabled onclick="finalizeVerification()">Confirm Complete Validation</button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let currentLoadedRecords = [];
        let activeSelectedItemId = null;

        function toggleTheme() {
            const body = document.body;
            body.setAttribute('data-theme', body.getAttribute('data-theme') === 'dark' ? 'light' : 'dark');
        }

        function fetchAndRender(callback = null) {
            fetch('/api/receipts')
                .then(res => res.json())
                .then(data => {
                    currentLoadedRecords = data;
                    renderTable(data);
                    renderSelectOptions(data);
                    
                    if(activeSelectedItemId) {
                        loadSelectedMatchingItem(activeSelectedItemId);
                    }
                    if(callback) callback();
                })
                .catch(err => {
                    console.error("API Fetch Error: Is the Laragon controller set up?", err);
                });
        }

        function renderTable(data) {
            const tbody = document.getElementById('receipts-table-body');
            tbody.innerHTML = '';
            
            if(data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="7" style="text-align: center; color: #888;">No recorded delivery records found inside Laragon database.</td></tr>`;
                return;
            }

            data.forEach(item => {
                const tr = document.createElement('tr');
                let statusColor = '#f39c12';
                if(item.status === 'Verified') statusColor = '#2ecc71';

                tr.innerHTML = `
                    <td><strong>${item.po_number}</strong></td>
                    <td>${item.supplier_name}</td>
                    <td><code>${item.delivery_ticket}</code></td>
                    <td>${item.item_desc}</td>
                    <td>${item.qty_received}</td>
                    <td>$${item.invoice_val}</td>
                    <td><span style="color: ${statusColor}; font-weight: bold;">${item.status}</span></td>
                `;
                tbody.appendChild(tr);
            });
        }

        function renderSelectOptions(data) {
            const selector = document.getElementById('verification-selector');
            selector.innerHTML = '<option value="">-- Select Active Record --</option>';
            
            data.forEach(item => {
                if(item.status === 'Pending Verification') {
                    const opt = document.createElement('option');
                    opt.value = item.id;
                    opt.textContent = `${item.po_number} (${item.supplier_name})`;
                    selector.appendChild(opt);
                }
            });
        }

        function handleReceiptSubmit(e) {
            e.preventDefault();
            const payload = {
                po_number: document.getElementById('po_number').value,
                supplier_name: document.getElementById('supplier_name').value,
                delivery_ticket: document.getElementById('delivery_ticket').value,
                receiving_date: document.getElementById('receiving_date').value,
                item_desc: document.getElementById('item_desc').value,
                qty_received: document.getElementById('qty_received').value,
                invoice_val: document.getElementById('invoice_val').value,
            };

            fetch('/api/receipts', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(() => {
                document.getElementById('goods-receipt-form').reset();
                fetchAndRender(() => {
                    alert("Delivery Cargo logged successfully into Database!");
                });
            });
        }

        function loadSelectedMatchingItem(id) {
            activeSelectedItemId = id;
            const workspace = document.getElementById('matching-workspace-details');
            if(!id) {
                workspace.style.display = 'none';
                return;
            }

            const item = currentLoadedRecords.find(r => r.id == id);
            if(!item) return;

            workspace.style.display = 'block';

            document.getElementById('match-po-num').textContent = item.po_number;
            document.getElementById('match-po-qty').textContent = item.qty_received;
            document.getElementById('match-po-cost').textContent = item.invoice_val;

            document.getElementById('match-rec-sup').textContent = item.supplier_name;
            document.getElementById('match-rec-qty').textContent = item.qty_received;
            document.getElementById('match-rec-ticket').textContent = item.delivery_ticket;

            document.getElementById('match-inv-val').textContent = item.invoice_val;
            document.getElementById('match-inv-desc').textContent = item.item_desc;
            document.getElementById('match-inv-cost').textContent = item.invoice_val;

            document.getElementById('check_price').checked = !!item.check_price;
            document.getElementById('check_delivery').checked = !!item.check_delivery;
            document.getElementById('check_payment').checked = !!item.check_payment;

            evaluateButtonState(item);
        }

        function updateVerificationStep(field, isChecked) {
            if(!activeSelectedItemId) return;
            
            fetch(`/api/receipts/${activeSelectedItemId}/step`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ field, value: isChecked ? 1 : 0 })
            })
            .then(res => res.json())
            .then(updatedItem => {
                const idx = currentLoadedRecords.findIndex(r => r.id == updatedItem.id);
                if(idx !== -1) currentLoadedRecords[idx] = updatedItem;
                evaluateButtonState(updatedItem);
            });
        }

        function finalizeVerification() {
            if(!activeSelectedItemId) return;

            fetch(`/api/receipts/${activeSelectedItemId}/verify`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(res => res.json())
            .then(() => {
                alert("Three-Way Matching Successful! System Verified Cargo.");
                activeSelectedItemId = null;
                fetchAndRender(() => switchTab('receipt'));
            });
        }

        function evaluateButtonState(item) {
            const confirmBtn = document.getElementById('main-confirm-btn');
            if (item.status === 'Pending Verification' && item.check_price && item.check_delivery && item.check_payment) {
                confirmBtn.disabled = false;
            } else {
                confirmBtn.disabled = true;
            }
        }

        function clearDatabase() {
            if(!confirm("Are you sure you want to drop all records from the Laragon database, bestie?")) return;
            
            fetch('/api/receipts/clear', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(res => res.json())
            .then(() => {
                alert("Database completely flushed clean!");
                fetchAndRender(() => switchTab('receipt'));
            });
        }

        function switchTab(viewId) {
            document.querySelectorAll('.app-view').forEach(view => view.classList.remove('active-view'));
            document.querySelectorAll('.sub-tab-btn').forEach(btn => btn.classList.remove('active'));

            document.getElementById(`view-${viewId}`).classList.add('active-view');
            document.getElementById(`btn-${viewId}`).classList.add('active');
        }

        window.onload = () => {
            fetchAndRender();
        };
    </script>
</body>
</html>