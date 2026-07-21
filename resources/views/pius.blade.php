<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shantha Motors - 3-Way Matching Sub-module</title>
    <style>
        :root {
            --bg-main: #0F2A4A;
            --sidebar-bg: #0d2440;
            --topbar-bg: #14355e;
            --text-color: #e9e9e9;
            --card-bg: #1a4270;
            --table-header: #14355e;
            --border-color: #2b5c91;
            
            --status-matched: #2ecc71;
            --status-mismatch: #e74c3c;
            --status-pending: #f1c40f;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: var(--bg-main); color: var(--text-color); display: flex; height: 100vh; overflow: hidden; }

        .sidebar { width: 260px; background-color: var(--sidebar-bg); padding: 25px 15px; display: flex; flex-direction: column; justify-content: space-between; border-right: 2px solid var(--border-color); }
        .brand-block { text-align: center; margin-bottom: 25px; }
        .brand-logo-svg { width: 65px; height: 65px; fill: #ffffff; }
        .brand-name { color: #ffffff; font-size: 20px; font-weight: 800; text-transform: uppercase; }
        .brand-sub { color: #d8c5ff; font-size: 11px; letter-spacing: 4px; text-transform: uppercase; font-weight: 600; }

        .nav-list { display: flex; flex-direction: column; gap: 12px; width: 100%; }
        .nav-link { text-decoration: none; width: 100%; display: block; }
        .nav-btn { width: 100%; padding: 12px 14px; border-radius: 25px; font-size: 11px; font-weight: 700; text-align: center; cursor: pointer; border: none; }
        .nav-btn.inactive { background-color: #ffffff; color: #3f1b85; }
        .nav-btn.active { background: linear-gradient(135deg, #a77df7, #703cd1); color: #ffffff; box-shadow: 0 4px 12px rgba(112, 60, 209, 0.35); }

        .main-viewport { flex: 1; display: flex; flex-direction: column; height: 100%; overflow: hidden; }
        .topbar { background-color: var(--topbar-bg); height: 65px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 18px; text-transform: uppercase; }
        .content-workspace { flex: 1; padding: 20px 25px; overflow-y: auto; display: flex; flex-direction: column; gap: 20px; }

        /* KPI Stat Cards */
        .kpi-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; }
        .kpi-card { background-color: var(--card-bg); border: 1px solid var(--border-color); border-radius: 8px; padding: 15px 20px; display: flex; flex-direction: column; gap: 5px; }
        .kpi-title { font-size: 11px; font-weight: 700; text-transform: uppercase; color: #b0c4de; }
        .kpi-value { font-size: 24px; font-weight: 800; color: #ffffff; }

        .kpi-card.pending { border-left: 5px solid var(--status-pending); }
        .kpi-card.matched { border-left: 5px solid var(--status-matched); }
        .kpi-card.mismatch { border-left: 5px solid var(--status-mismatch); }
        .kpi-card.approved { border-left: 5px solid #3498db; }

        /* Dashboard Tables */
        .data-panel { background-color: var(--card-bg); border-radius: 8px; border: 1px solid var(--border-color); padding: 20px; }
        .panel-header-strip { background-color: var(--table-header); color: white; padding: 10px 15px; border-radius: 4px; font-size: 12px; font-weight: 700; text-transform: uppercase; margin-bottom: 15px; display: flex; justify-content: space-between; }

        .custom-table-container { overflow-x: auto; border-radius: 6px; border: 1px solid var(--border-color); }
        .custom-table { width: 100%; border-collapse: collapse; font-size: 13px; }
        .custom-table th { background-color: var(--table-header); color: white; text-align: left; padding: 12px 15px; font-size: 11px; text-transform: uppercase; }
        .custom-table td { padding: 12px 15px; border-bottom: 1px solid var(--border-color); }

        .table-row-selectable { cursor: pointer; }
        .table-row-selectable:hover { background-color: rgba(255, 255, 255, 0.05); }
        .table-row-selectable.selected-row { background-color: rgba(167, 125, 247, 0.15) !important; border-left: 4px solid #a77df7; }

        .badge { padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: 700; text-transform: uppercase; display: inline-block; }
        .badge-matched { background-color: rgba(46, 204, 113, 0.2); color: var(--status-matched); border: 1px solid var(--status-matched); }
        .badge-mismatch { background-color: rgba(231, 76, 60, 0.2); color: var(--status-mismatch); border: 1px solid var(--status-mismatch); }
        .badge-approved { background-color: rgba(52, 152, 219, 0.2); color: #3498db; border: 1px solid #3498db; }

        .btn-approve { background-color: #2ecc71; color: white; border: none; padding: 6px 14px; font-size: 11px; font-weight: 700; text-transform: uppercase; border-radius: 4px; cursor: pointer; }
        .btn-locked { background-color: #e74c3c; color: white; border: none; padding: 6px 14px; font-size: 11px; font-weight: 700; text-transform: uppercase; border-radius: 4px; cursor: not-allowed; opacity: 0.8; }

        /* 3-Way Grid */
        .three-way-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; }
        .matching-card { background-color: var(--bg-main); border: 1px solid var(--border-color); border-radius: 6px; padding: 15px; display: flex; flex-direction: column; gap: 10px; }
        .matching-card-title { font-size: 12px; font-weight: 700; text-transform: uppercase; border-bottom: 1px solid var(--border-color); padding-bottom: 8px; color: #a77df7; display: flex; justify-content: space-between; }
        .detail-list { display: flex; flex-direction: column; gap: 8px; }
        .detail-item { display: flex; justify-content: space-between; font-size: 12px; padding: 4px 0; border-bottom: 1px dashed rgba(255,255,255,0.05); }
        .detail-label { color: #b0c4de; font-weight: 600; }
        .detail-val { font-weight: 700; color: #ffffff; }
        .val-mismatch { color: var(--status-mismatch) !important; background-color: rgba(231, 76, 60, 0.15); padding: 1px 6px; border-radius: 3px; }
    </style>
</head>
<body data-theme="dark">

    <div class="sidebar">
        <div>
            <div class="brand-block">
                <svg class="brand-logo-svg" viewBox="0 0 100 100">
                    <path d="M50,15 C55,35 75,30 90,40 C75,55 60,45 50,75 C40,45 25,55 10,40 C25,30 45,35 50,15 Z" />
                </svg>
                <div class="brand-name">Shantha</div>
                <div class="brand-sub">Motors</div>
            </div>

            <div class="nav-list">
                <a href="/mari" class="nav-link"><button class="nav-btn inactive">Purchase Requisition</button></a>
                <a href="/waylon" class="nav-link"><button class="nav-btn inactive">Supplier Management</button></a>
                <a href="/bulugagao" class="nav-link"><button class="nav-btn inactive">Purchase Order Management</button></a>
                <a href="/malacaste" class="nav-link"><button class="nav-btn active">Goods Receipt & Invoice Matching</button></a>
            </div>
        </div>
    </div>

    <div class="main-viewport">
        <div class="topbar">Goods Receipt & Invoice Matching</div>

        <div class="content-workspace">

            <!-- STAT WIDGETS -->
            <div class="kpi-grid">
                <div class="kpi-card pending"><span class="kpi-title">Pending</span><span class="kpi-value" id="kpi-pending">0</span></div>
                <div class="kpi-card matched"><span class="kpi-title">Matched</span><span class="kpi-value" id="kpi-matched">0</span></div>
                <div class="kpi-card mismatch"><span class="kpi-title">Mismatched</span><span class="kpi-value" id="kpi-mismatch">0</span></div>
                <div class="kpi-card approved"><span class="kpi-title">Approved</span><span class="kpi-value" id="kpi-approved">0</span></div>
            </div>

            <!-- MAIN ACTION TABLE -->
            <div class="data-panel">
                <div class="panel-header-strip">
                    <span>3-Way Verification Dashboard (MySQL Dynamic)</span>
                    <small style="text-transform: none; opacity: 0.8;">Click any row to inspect details below</small>
                </div>
                <div class="custom-table-container">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>PO Number</th>
                                <th>PO Status (Base)</th>
                                <th>Goods Receipt Status</th>
                                <th>Vendor Invoice Status</th>
                                <th>Overall Match</th>
                                <th>Approval Action</th>
                            </tr>
                        </thead>
                        <tbody id="main-overview-table-body"></tbody>
                    </table>
                </div>
            </div>

            <!-- 3-WAY DETAIL TABLES -->
            <div class="data-panel">
                <div class="panel-header-strip">
                    <span>3-Way Matching Inspection: <span id="selected-po-title" style="color: #a77df7;">Select a PO</span></span>
                </div>
                
                <div class="three-way-grid">
                    <!-- PO TABLE -->
                    <div class="matching-card">
                        <div class="matching-card-title"><span>1. Purchase Order</span><span class="badge badge-matched">Base Target</span></div>
                        <div class="detail-list">
                            <div class="detail-item"><span class="detail-label">PO Number:</span><span class="detail-val" id="po-num">-</span></div>
                            <div class="detail-item"><span class="detail-label">Item SKU / ID:</span><span class="detail-val" id="po-item-id">-</span></div>
                            <div class="detail-item"><span class="detail-label">Qty Ordered:</span><span class="detail-val" id="po-qty">-</span></div>
                            <div class="detail-item"><span class="detail-label">Unit Price:</span><span class="detail-val" id="po-price">-</span></div>
                            <div class="detail-item"><span class="detail-label">Total Amount:</span><span class="detail-val" id="po-total">-</span></div>
                        </div>
                    </div>

                    <!-- GOODS RECEIPT TABLE -->
                    <div class="matching-card">
                        <div class="matching-card-title"><span>2. Goods Receipt</span><span class="badge" id="gr-status-badge">--</span></div>
                        <div class="detail-list">
                            <div class="detail-item"><span class="detail-label">Receipt Number:</span><span class="detail-val" id="gr-num">-</span></div>
                            <div class="detail-item"><span class="detail-label">PO Ref Number:</span><span class="detail-val" id="gr-po-num">-</span></div>
                            <div class="detail-item"><span class="detail-label">Qty Received:</span><span class="detail-val" id="gr-qty">-</span></div>
                            <div class="detail-item"><span class="detail-label">Date Received:</span><span class="detail-val" id="gr-date">-</span></div>
                        </div>
                    </div>

                    <!-- VENDOR INVOICE TABLE -->
                    <div class="matching-card">
                        <div class="matching-card-title"><span>3. Vendor Invoice</span><span class="badge" id="inv-status-badge">--</span></div>
                        <div class="detail-list">
                            <div class="detail-item"><span class="detail-label">Invoice Number:</span><span class="detail-val" id="inv-num">-</span></div>
                            <div class="detail-item"><span class="detail-label">PO Ref Number:</span><span class="detail-val" id="inv-po-num">-</span></div>
                            <div class="detail-item"><span class="detail-label">Billed Amount:</span><span class="detail-val" id="inv-amount">-</span></div>
                            <div class="detail-item"><span class="detail-label">Payment Due Date:</span><span class="detail-val" id="inv-due">-</span></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Dynamic payload injected directly from MySQL database through Laravel Controller
        let records = @json($records ?? []);
        let selectedRecordId = records.length > 0 ? records[0].id : null;

        function renderWorkspace() {
            updateKPIs();
            renderMainTable();
            if (selectedRecordId) selectRecord(selectedRecordId);
        }

        function updateKPIs() {
            let pending = 0, matched = 0, mismatch = 0, approved = 0;

            records.forEach(r => {
                const grMatched = r.quantity_ordered === r.quantity_received;
                const invMatched = r.po_total === r.total_amount_billed;

                if (r.approval_status === 'Approved') {
                    approved++;
                } else if (!grMatched || !invMatched) {
                    mismatch++;
                } else if (grMatched && invMatched) {
                    matched++;
                    pending++;
                }
            });

            document.getElementById('kpi-pending').textContent = pending;
            document.getElementById('kpi-matched').textContent = matched;
            document.getElementById('kpi-mismatch').textContent = mismatch;
            document.getElementById('kpi-approved').textContent = approved;
        }

        function renderMainTable() {
            const tbody = document.getElementById('main-overview-table-body');
            tbody.innerHTML = '';

            records.forEach(r => {
                const grMatched = r.quantity_ordered === r.quantity_received;
                const invMatched = r.po_total === r.total_amount_billed;
                const isFullyMatched = grMatched && invMatched;

                const tr = document.createElement('tr');
                tr.className = `table-row-selectable ${selectedRecordId === r.id ? 'selected-row' : ''}`;
                tr.onclick = () => selectRecord(r.id);

                let actionHtml = '';
                if (r.approval_status === 'Approved') {
                    actionHtml = `<span class="badge badge-approved">Approved</span>`;
                } else if (isFullyMatched) {
                    actionHtml = `<button class="btn-approve" onclick="event.stopPropagation(); approvePO(${r.id})">Approve</button>`;
                } else {
                    actionHtml = `<button class="btn-locked" title="Mismatched records locked">🔒 Locked</button>`;
                }

                tr.innerHTML = `
                    <td><strong>${r.po_number}</strong></td>
                    <td><span class="badge badge-matched">✓ Checked</span></td>
                    <td><span class="badge ${grMatched ? 'badge-matched' : 'badge-mismatch'}">${grMatched ? 'Matched' : 'Mismatch'}</span></td>
                    <td><span class="badge ${invMatched ? 'badge-matched' : 'badge-mismatch'}">${invMatched ? 'Matched' : 'Mismatch'}</span></td>
                    <td><span class="badge ${isFullyMatched ? 'badge-matched' : 'badge-mismatch'}">${isFullyMatched ? '100% Match' : 'Discrepancy'}</span></td>
                    <td>${actionHtml}</td>
                `;
                tbody.appendChild(tr);
            });
        }

        function selectRecord(id) {
            selectedRecordId = id;
            const r = records.find(item => item.id === id);
            if (!r) return;

            renderMainTable();

            document.getElementById('selected-po-title').textContent = r.po_number;

            // 1. PO Card
            document.getElementById('po-num').textContent = r.po_number;
            document.getElementById('po-item-id').textContent = r.item_id;
            document.getElementById('po-qty').textContent = r.quantity_ordered + ' pcs';
            document.getElementById('po-price').textContent = '$' + r.unit_price.toFixed(2);
            document.getElementById('po-total').textContent = '$' + r.po_total.toFixed(2);

            // 2. Goods Receipt Card
            const grMatched = r.quantity_ordered === r.quantity_received;
            document.getElementById('gr-num').textContent = r.receipt_number;
            document.getElementById('gr-po-num').textContent = r.po_number;
            
            const grQtyEl = document.getElementById('gr-qty');
            grQtyEl.textContent = r.quantity_received + ' pcs';
            grQtyEl.className = `detail-val ${grMatched ? '' : 'val-mismatch'}`;
            document.getElementById('gr-date').textContent = r.date_received;

            const grBadge = document.getElementById('gr-status-badge');
            grBadge.textContent = grMatched ? 'Matched' : 'Mismatch';
            grBadge.className = `badge ${grMatched ? 'badge-matched' : 'badge-mismatch'}`;

            // 3. Vendor Invoice Card
            const invMatched = r.po_total === r.total_amount_billed;
            document.getElementById('inv-num').textContent = r.invoice_number;
            document.getElementById('inv-po-num').textContent = r.po_number;

            const invAmtEl = document.getElementById('inv-amount');
            invAmtEl.textContent = '$' + r.total_amount_billed.toFixed(2);
            invAmtEl.className = `detail-val ${invMatched ? '' : 'val-mismatch'}`;
            document.getElementById('inv-due').textContent = r.due_date;

            const invBadge = document.getElementById('inv-status-badge');
            invBadge.textContent = invMatched ? 'Matched' : 'Mismatch';
            invBadge.className = `badge ${invMatched ? 'badge-matched' : 'badge-mismatch'}`;
        }

        function approvePO(id) {
            const r = records.find(item => item.id === id);
            if (!r) return;

            fetch(`/api/receipts/${id}/approve`, {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken 
                }
            }).then(res => res.json())
              .then(() => {
                  r.approval_status = 'Approved';
                  renderWorkspace();
              });
        }

        window.onload = renderWorkspace;
    </script>
</body>
</html>