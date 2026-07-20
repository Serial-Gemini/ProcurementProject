<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ADDED FOR CSRF AJAX SECURITY VERIFICATION -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shantha Motors - Procurement System</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #0F2A4A;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow: hidden;
        }

        .container {
            display: flex;
            width: 100vw;
            height: 100vh;
            background-color: #1e1145;
            overflow: hidden;
        }

        .sidebar {
            width: 250px;
            background-color: #0F2A4A;
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            border-right: 2px solid #2e1762;
            height: 100%;
            z-index: 10;
        }

        .brand-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .brand-logo {
            width: 70px;
            margin-bottom: 10px;
        }

        .brand-title {
            color: #ffffff;
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .brand-subtitle {
            color: #bfa1fc;
            font-size: 11px;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-top: 5px;
        }

        .nav-group {
            display: flex;
            flex-direction: column;
            gap: 15px;
            width: 100%;
        }

        .nav-link {
            text-decoration: none;
            width: 100%;
        }

        .sidebar-btn {
            width: 100%;
            padding: 12px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            text-align: center;
            cursor: pointer;
            border: none;
            display: block;
            transition: all 0.2s ease;
        }

        .btn-active {
            background: linear-gradient(135deg, #a879f5, #7a46d1);
            color: white;
            box-shadow: 0 4px 10px rgba(122, 70, 209, 0.4);
        }

        .btn-inactive {
            background-color: #ffffff;
            color: #160a33;
        }

        .btn-inactive:hover {
            background-color: #f0f0f0;
        }

        .sidebar-bottom {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .btn-domain {
            width: 100%;
            background-color: #fca34d;
            color: #160a33;
            padding: 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            text-align: center;
            border: none;
            cursor: pointer;
        }

        .btn-theme {
            width: 100%;
            background-color: transparent;
            border: 1px solid #5627ab;
            color: #bfa1fc;
            padding: 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            text-align: center;
            cursor: pointer;
        }

        .workspace {
            flex: 1;
            background: linear-gradient(rgba(30, 17, 69, 0.85), rgba(30, 17, 69, 0.95)), 
                        url('https://images.unsplash.com/photo-1617814076367-b759c7d7e738?q=80&w=1000') no-repeat center center;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            overflow-y: auto;
            padding: 40px 20px;
        }

        /* PROPORTIONALLY OPTIMIZED FLOATING CONTAINER CARD */
        .workspace-card {
            width: 65%;
            max-width: 1000px;
            min-height: 780px;
            background-color: rgba(15, 42, 74, 0.95);
            border: 1px solid #3d2382;
            border-radius: 16px;
            padding: 35px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6), 
                        0 0 30px rgba(123, 78, 194, 0.15);
            display: flex;
            flex-direction: column;
        }

        .main-header {
            background-color: #0F2A4A;
            color: white;
            text-align: center;
            padding: 15px;
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 25px;
            border-radius: 8px;
        }

        .tab-bar {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
        }

        .tab-btn {
            flex: 1;
            padding: 12px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            border: none;
            cursor: pointer;
            text-transform: uppercase;
        }

        .tab-active {
            background-color: #7b4ec2;
            color: white;
            box-shadow: inset 0 0 5px rgba(255,255,255,0.3);
        }

        .tab-inactive {
            background-color: #120727;
            color: #5c448f;
        }

        .form-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-title {
            background-color: #0b041d;
            color: white;
            text-align: center;
            padding: 8px;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 4px;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .form-row-2 {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
            color: white;
            font-size: 13px;
            font-weight: bold;
        }

        .form-control {
            background-color: white;
            border: none;
            padding: 12px;
            border-radius: 6px;
            font-size: 14px;
            color: #333;
            outline: none;
        }

        .action-row {
            display: flex;
            gap: 20px;
            margin-top: 15px;
        }

        .btn-cancel {
            flex: 1;
            background-color: rgba(127, 29, 29, 0.4);
            border: 2px solid #5f1111;
            color: #ef4444;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 15px;
            border-radius: 8px;
            cursor: pointer;
        }

        .btn-submit {
            flex: 2;
            background-color: #2563eb;
            color: white;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            border: none;
            padding: 15px;
            border-radius: 8px;
            cursor: pointer;
        }

        /* ACCORDION DROPDOWN STYLES WITH INVERTED CARET */
        .dropdown-item {
            background-color: rgba(11, 4, 29, 0.9);
            border: 1px solid #2e1762;
            border-radius: 8px;
            margin-bottom: 15px;
            overflow: hidden;
            color: white;
        }

        .dropdown-trigger {
            width: 100%;
            background-color: #120727;
            padding: 15px 20px;
            text-align: left;
            border: none;
            color: white;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .dropdown-trigger:hover {
            background-color: #1a0b3a;
        }

        .dropdown-content {
            padding: 20px;
            border-top: 1px solid #2e1762;
            background-color: rgba(0, 0, 0, 0.2);
            display: none;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 15px;
            font-size: 13px;
        }

        .info-label {
            color: #bfa1fc;
            font-weight: bold;
            font-size: 11px;
            text-transform: uppercase;
        }

        .info-val {
            color: white;
            margin-top: 3px;
        }

        .status-text-display {
            font-size: 14px;
            font-weight: bold;
            margin-top: 15px;
            text-transform: uppercase;
        }

        .status-pending { color: #f59e0b; }
        .status-approved { color: #10b981; }
        .status-rejected { color: #ef4444; }

        .manager-action-box {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px dashed #5627ab;
        }

        .manager-textarea {
            width: 100%;
            height: 75px;
            background-color: #120727;
            border: 1px solid #5627ab;
            border-radius: 6px;
            padding: 10px;
            color: white;
            font-size: 13px;
            resize: none;
            outline: none;
            margin-top: 5px;
            margin-bottom: 12px;
        }

        .manager-btn-row {
            display: flex;
            gap: 15px;
        }

        .btn-action-approve {
            flex: 1;
            background-color: #10b981;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            font-size: 13px;
            text-transform: uppercase;
        }

        .btn-action-reject {
            flex: 1;
            background-color: #ef4444;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            font-size: 13px;
            text-transform: uppercase;
        }

        .placeholder-text {
            text-align: center;
            color: #bfa1fc;
            font-size: 16px;
            padding: 40px 20px;
            font-weight: 500;
        }
    </style>
</head>
<body>

    <div class="container">
        
        <!-- SIDEBAR -->
        <div class="sidebar">
            <div style="width: 100%;">
                <div class="brand-section">
                    <svg class="brand-logo" viewBox="0 0 100 100" fill="#ffffff">
                        <path d="M50,15 C55,35 75,30 90,40 C75,55 60,45 50,75 C40,45 25,55 10,40 C25,30 45,35 50,15 Z" />
                    </svg>
                    <h1 class="brand-title">Shantha</h1>
                    <p class="brand-subtitle">Motors</p>
                </div>

                <div class="nav-group">
                    <a href="/mari" class="nav-link">
                        <button class="sidebar-btn btn-active" id="nav-requisition">Purchase Requisition and Approval</button>
                    </a>
                    <a href="/waylon" class="nav-link">
                        <button class="sidebar-btn btn-inactive" id="nav-supplier">Supplier Management</button>
                    </a>
                    <a href="/bulugagao" class="nav-link">
                        <button class="sidebar-btn btn-inactive" id="nav-po">Purchase Order Management</button>
                    </a>
                    <a href="/malacaste" class="nav-link">
                        <button class="sidebar-btn btn-inactive" id="nav-matching">Goods Receipt and Invoice Matching</button>
                    </a>
                </div>
            </div>

            <div class="sidebar-bottom">
                <button class="btn-domain" id="domainToggleBtn" onclick="toggleDomainView()">SWITCH TO MANAGER DOMAIN</button>
            </div>
        </div>

        <!-- MAIN WORKSPACE -->
        <div class="workspace">
            
            <!-- FLOATING WORKSPACE CONTAINER -->
            <div class="workspace-card">
                
                <div class="main-header" id="moduleMainTitle">
                    Purchase Requisition and Approval
                </div>

                <!-- 1. ACTIVE WORKING INTERFACE: REQUISITION MODULE -->
                <div id="moduleView-requisition" style="display: block;">
                    <!-- EMPLOYEE SUB-DOMAIN PANEL -->
                    <div id="employeeDomainPanel" style="display: block;">
                        <div class="tab-bar">
                            <button class="tab-btn tab-active" id="empTab-form" onclick="switchEmployeeTab('form')">Request</button>
                            <button class="tab-btn tab-inactive" id="empTab-pending" onclick="switchEmployeeTab('pending')">Pending</button>
                            <button class="tab-btn tab-inactive" id="empTab-approved" onclick="switchEmployeeTab('approved')">Approved</button>
                            <button class="tab-btn tab-inactive" id="empTab-rejected" onclick="switchEmployeeTab('rejected')">Rejected</button>
                        </div>

                        <!-- Input Sub-form View -->
                        <div id="empView-form" style="display: block;" class="form-section">
                            <div class="form-title">Employee Request Form</div>
                            
                            <form action="{{ route('requisition.store') }}" method="POST">
                                @csrf
                                <div style="display: flex; flex-direction: column; gap: 15px;">
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" id="field_first_name" name="first_name" class="form-control" placeholder="First Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" id="field_last_name" name="last_name" class="form-control" placeholder="Last Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Employee ID</label>
                                            <input type="text" id="field_employee_id" name="employee_id" class="form-control" placeholder="Employee ID" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Employee Request/s</label>
                                        <input type="text" id="field_item_request" name="item_request" class="form-control" placeholder="e.g., 90 - 120hz Monitor" required>
                                    </div>

                                    <div class="form-row-2">
                                        <div class="form-group">
                                            <label>Quantity</label>
                                            <input type="number" id="field_quantity" name="quantity" class="form-control" placeholder="3" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Cost</label>
                                            <input type="text" id="field_cost" name="cost" class="form-control" placeholder="$850" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Reason for Request/s / Additional Comments</label>
                                        <textarea id="field_comments" name="comments" class="form-control" style="height: 90px; resize: none;" placeholder="e.g., Stock monitor maxes out at 60Hz."></textarea>
                                    </div>

                                    <div class="action-row">
                                        <button type="reset" class="btn-cancel">Cancel</button>
                                        <button type="submit" class="btn-submit">Request</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div id="empView-pending" style="display: none;"></div>
                        <div id="empView-approved" style="display: none;"></div>
                        <div id="empView-rejected" style="display: none;"></div>
                    </div>

                    <!-- MANAGER SUB-DOMAIN PANEL -->
                    <div id="managerDomainPanel" style="display: none;">
                        <div class="tab-bar">
                            <button class="tab-btn tab-active" id="mgrTab-requests" onclick="switchManagerTab('requests')">Request/s</button>
                            <button class="tab-btn tab-inactive" id="mgrTab-approved" onclick="switchManagerTab('approved')">Approved</button>
                            <button class="tab-btn tab-inactive" id="mgrTab-rejected" onclick="switchManagerTab('rejected')">Rejected</button>
                        </div>
                        
                        <div id="mgrView-requests" style="display: block;"></div>
                        <div id="mgrView-approved" style="display: none;"></div>
                        <div id="mgrView-rejected" style="display: none;"></div>
                    </div>
                </div>

                <!-- ALTERNATE MODULE ROUTING TARGET PLACES -->
                <div id="moduleView-supplier" style="display: none;" class="placeholder-text">
                    Supplier Database records interface configuration viewport layout.
                </div>
                
                <div id="moduleView-po" style="display: none;" class="placeholder-text">
                    Generated Purchase Order Ledger listings tracking index interface.
                </div>
                
                <div id="moduleView-matching" style="display: none;" class="placeholder-text">
                    Goods Receipt documents and Voucher Invoices matching checklist layout matrix.
                </div>

            </div>
        </div>
    </div>

    <script>
        let appDataset = @json($requisitions ?? []);
        let activeModule = 'employee';

        function switchModule(targetModule) {
            const moduleTitles = {
                'requisition': 'Purchase Requisition and Approval',
                'supplier': 'Supplier Management',
                'po': 'Purchase Order Management',
                'matching': 'Goods Receipt and Invoice Matching'
            };

            ['requisition', 'supplier', 'po', 'matching'].forEach(mod => {
                const btn = document.getElementById('nav-' + mod);
                const view = document.getElementById('moduleView-' + mod);
                
                if(mod === targetModule) {
                    btn.className = "sidebar-btn btn-active";
                    view.style.display = "block";
                } else {
                    btn.className = "sidebar-btn btn-inactive";
                    view.style.display = "none";
                }
            });

            document.getElementById('moduleMainTitle').innerText = moduleTitles[targetModule];
            document.getElementById('domainToggleBtn').style.display = (targetModule === 'requisition') ? 'block' : 'none';
        }

        function toggleDomainView() {
            const employeePanel = document.getElementById('employeeDomainPanel');
            const managerPanel = document.getElementById('managerDomainPanel');
            const toggleBtn = document.getElementById('domainToggleBtn');

            if (employeePanel.style.display === 'block') {
                employeePanel.style.display = 'none';
                managerPanel.style.display = 'block';
                toggleBtn.innerText = 'SWITCH TO EMPLOYEE DOMAIN';
                renderManagerContent();
            } else {
                employeePanel.style.display = 'block';
                managerPanel.style.display = 'none';
                toggleBtn.innerText = 'SWITCH TO MANAGER DOMAIN';
                renderEmployeeContent();
            }
        }

        function switchEmployeeTab(tabName) {
            ['form', 'pending', 'approved', 'rejected'].forEach(t => {
                document.getElementById('empView-' + t).style.display = (t === tabName) ? 'block' : 'none';
                document.getElementById('empTab-' + t).className = (t === tabName) ? "tab-btn tab-active" : "tab-btn tab-inactive";
            });
            if(tabName !== 'form') renderEmployeeContent();
        }

        function switchManagerTab(tabName) {
            ['requests', 'approved', 'rejected'].forEach(t => {
                document.getElementById('mgrView-' + t).style.display = (t === tabName) ? 'block' : 'none';
                document.getElementById('mgrTab-' + t).className = (t === tabName) ? "tab-btn tab-active" : "tab-btn tab-inactive";
            });
            renderManagerContent();
        }

        function toggleAccordion(id) {
            const target = document.getElementById(id);
            target.style.display = (target.style.display === 'block') ? 'none' : 'block';
        }

        function renderEmployeeContent() {
            const groups = ['Pending', 'Approved', 'Rejected'];
            groups.forEach(statusType => {
                const targetView = document.getElementById('empView-' + statusType.toLowerCase());
                const items = appDataset.filter(d => d.status === statusType);

                if(items.length === 0) {
                    targetView.innerHTML = `<div style="text-align:center; color:#5c448f; padding:20px; font-weight:bold;">No items matching status: ${statusType}</div>`;
                    return;
                }

                targetView.innerHTML = items.map(item => `
                    <div class="dropdown-item">
                        <button class="dropdown-trigger" onclick="toggleAccordion('empCollapse-${item.id}')">
                            <span>Request Entry #${item.id} - ${escapeHTML(item.item_request)}</span>
                            <span>&#9660;</span>
                        </button>
                        <div class="dropdown-content" id="empCollapse-${item.id}">
                            <div class="info-grid">
                                <div><div class="info-label">Full Name</div><div class="info-val">${escapeHTML(item.first_name)} ${escapeHTML(item.last_name)}</div></div>
                                <div><div class="info-label">Employee ID</div><div class="info-val">${escapeHTML(item.employee_id)}</div></div>
                                <div><div class="info-label">Requested Item/s</div><div class="info-val">${escapeHTML(item.item_request)}</div></div>
                                <div><div class="info-label">Quantity</div><div class="info-val">${item.quantity}</div></div>
                                <div><div class="info-label">Total Cost Value</div><div class="info-val">${escapeHTML(item.cost)}</div></div>
                                <div><div class="info-label">Reason Comments</div><div class="info-val">${escapeHTML(item.comments || 'N/A')}</div></div>
                            </div>
                            ${item.manager_note ? `
                                <div style="margin-top:10px; padding:10px; background:rgba(255,255,255,0.05); border-left:3px solid #7b4ec2;">
                                    <div class="info-label">Manager Note Response Context:</div>
                                    <div class="info-val" style="font-style:italic;">"${escapeHTML(item.manager_note)}"</div>
                                </div>
                            ` : ''}
                            <div class="status-text-display status-${statusType.toLowerCase()}">
                                Status: ${statusType}
                            </div>
                        </div>
                    </div>
                `).join('');
            });
        }

        function handleManagerDecision(id, updatedStatus) {
            const noteContent = document.getElementById(`noteField-${id}`).value;
            
            // FETCHING TOKEN DYNAMICALLY FROM META TO PREVENT SECURITY TIMEOUT EXPIRED PAYLOADS
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(`/requisitions/${id}/decide`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    status: updatedStatus,
                    manager_note: noteContent
                })
            })
            .then(response => {
                if(!response.ok) throw new Error('Server error response code.');
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    const targetElement = appDataset.find(d => d.id === id);
                    if(targetElement) {
                        targetElement.status = updatedStatus;
                        targetElement.manager_note = noteContent;
                        renderManagerContent();
                    }
                } else {
                    alert('Could not sync data changes with the SQL database server.');
                }
            })
            .catch(error => {
                console.error('Error Details:', error);
                alert('Database connectivity timeout occurred.');
            });
        }

        function renderManagerContent() {
            const layoutMapping = [
                { tab: 'requests', filterStatus: 'Pending' },
                { tab: 'approved', filterStatus: 'Approved' },
                { tab: 'rejected', filterStatus: 'Rejected' }
            ];

            layoutMapping.forEach(mapping => {
                const targetView = document.getElementById('mgrView-' + mapping.tab);
                const items = appDataset.filter(d => d.status === mapping.filterStatus);

                if(items.length === 0) {
                    targetView.innerHTML = `<div style="text-align:center; color:#5c448f; padding:20px; font-weight:bold;">No forms verified in state register: ${mapping.filterStatus}</div>`;
                    return;
                }

                targetView.innerHTML = items.map(item => `
                    <div class="dropdown-item">
                        <button class="dropdown-trigger" onclick="toggleAccordion('mgrCollapse-${item.id}')">
                            <span>Form Request Log #${item.id} - Requester: ${escapeHTML(item.first_name)} ${escapeHTML(item.last_name)}</span>
                            <span>&#9660;</span>
                        </button>
                        <div class="dropdown-content" id="mgrCollapse-${item.id}">
                            <div class="info-grid">
                                <div><div class="info-label">Employee Name</div><div class="info-val">${escapeHTML(item.first_name)} ${escapeHTML(item.last_name)}</div></div>
                                <div><div class="info-label">Employee ID Target</div><div class="info-val">${escapeHTML(item.employee_id)}</div></div>
                                <div><div class="info-label">Requested Object</div><div class="info-val">${escapeHTML(item.item_request)}</div></div>
                                <div><div class="info-label">Quantity Variant</div><div class="info-val">${item.quantity}</div></div>
                                <div><div class="info-label">Estimated Extended Cost</div><div class="info-val">${escapeHTML(item.cost)}</div></div>
                                <div><div class="info-label">Form Narrative / Description Comments</div><div class="info-val">${escapeHTML(item.comments || 'N/A')}</div></div>
                            </div>
                            
                            ${mapping.tab === 'requests' ? `
                                <div class="manager-action-box">
                                    <div class="info-label">Manager Reason Note:</div>
                                    <textarea id="noteField-${item.id}" class="manager-textarea" placeholder="Add a note to show why this form item was approved or rejected..."></textarea>
                                    <div class="manager-btn-row">
                                        <button class="btn-action-reject" onclick="handleManagerDecision(${item.id}, 'Rejected')">Reject</button>
                                        <button class="btn-action-approve" onclick="handleManagerDecision(${item.id}, 'Approved')">Approve</button>
                                    </div>
                                </div>
                            ` : `
                                <div style="margin-top:10px; padding:10px; background:rgba(255,255,255,0.05); border-left:3px solid #7b4ec2;">
                                    <div class="info-label">Submitted Evaluation Note Data:</div>
                                    <div class="info-val">${escapeHTML(item.manager_note || 'No rationale logged.')}</div>
                                </div>
                            `}
                        </div>
                    </div>
                `).join('');
            });
        }

        function escapeHTML(str) {
            if (!str) return '';
            return String(str).replace(/[&<>'"]/g, 
                tag => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#39;', '"': '&quot;' }[tag] || tag)
            );
        }

        renderEmployeeContent();
    </script>
</body>
</html>