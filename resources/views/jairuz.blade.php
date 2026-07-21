<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            min-width: 250px;
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

        .workspace {
            flex: 1;
            background: linear-gradient(rgba(30, 17, 69, 0.85), rgba(30, 17, 69, 0.95)), 
                        url('https://images.unsplash.com/photo-1617814076367-b759c7d7e738?q=80&w=1000') no-repeat center center;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100%;
            overflow-y: auto;
            padding: 40px 20px;
        }

        .workspace-card {
            width: 90%;
            max-width: 900px;
            min-height: 580px;
            background-color: rgba(15, 42, 74, 0.95);
            border: 1px solid #3d2382;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6), 
                        0 0 30px rgba(123, 78, 194, 0.15);
            display: flex;
            flex-direction: column;
            margin-bottom: 40px;
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

        .tab-content-view {
            min-height: 380px;
            display: flex;
            flex-direction: column;
        }

        .form-type-toggle {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .type-toggle-btn {
            flex: 1;
            padding: 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
            border: 1px solid #5627ab;
            text-transform: uppercase;
            transition: all 0.2s;
        }

        .toggle-active {
            background-color: #2563eb;
            color: white;
            border-color: #2563eb;
        }

        .toggle-inactive {
            background-color: #120727;
            color: #bfa1fc;
        }

        .form-section {
            display: flex;
            flex-direction: column;
        }

        .form-title {
            background-color: #0b041d;
            color: white;
            text-align: center;
            padding: 12px;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .form-row-2 {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 15px;
        }

        .form-row-split {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        @media (max-width: 768px) {
            .form-row-split {
                grid-template-columns: 1fr;
            }
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
            width: 100%;
        }

        .worker-entry-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr auto;
            gap: 8px;
            margin-bottom: 8px;
            align-items: center;
        }

        .btn-add-worker {
            background-color: #10b981;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
            cursor: pointer;
            align-self: flex-start;
            margin-top: 4px;
        }

        .btn-remove-worker {
            background-color: #ef4444;
            color: white;
            border: none;
            width: 35px;
            height: 38px;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            font-size: 16px;
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

        .status-dot {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 20px;
            height: 20px;
            min-width: 20px;
            min-height: 20px;
            border-radius: 50%;
            margin-right: 12px;
            font-size: 11px;
            font-weight: bold;
            color: #ffffff;
            flex-shrink: 0;
            vertical-align: middle;
        }

        .dot-pending { background-color: #f59e0b; }
        .dot-approved { background-color: #10b981; }
        .dot-rejected { background-color: #ef4444; }

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

        .workers-list-box {
            background: rgba(255,255,255,0.05);
            padding: 10px;
            border-radius: 6px;
            margin-top: 5px;
            font-size: 12px;
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
            padding: 100px 20px;
            font-weight: 500;
        }

        .empty-state-text {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 250px;
            color: #7b4ec2;
            font-weight: bold;
            font-size: 15px;
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
            <div class="workspace-card">
                <div class="main-header" id="moduleMainTitle">
                    Purchase Requisition and Approval
                </div>

                <!-- REQUISITION MODULE VIEW -->
                <div id="moduleView-requisition" style="display: block;">
                    
                    <!-- EMPLOYEE / REQUESTER SUB-DOMAIN PANEL -->
                    <div id="employeeDomainPanel" style="display: block;">
                        <div class="tab-bar">
                            <button class="tab-btn tab-active" id="empTab-form" onclick="switchEmployeeTab('form')">Request</button>
                            <button class="tab-btn tab-inactive" id="empTab-pending" onclick="switchEmployeeTab('pending')">Pending</button>
                            <button class="tab-btn tab-inactive" id="empTab-approved" onclick="switchEmployeeTab('approved')">Approved</button>
                            <button class="tab-btn tab-inactive" id="empTab-rejected" onclick="switchEmployeeTab('rejected')">Rejected</button>
                        </div>

                        <!-- INPUT SUB-FORM VIEW -->
                        <div id="empView-form" style="display: block;" class="form-section tab-content-view">
                            
                            <div class="form-title">Employee/Management Request Form</div>

                            <div class="form-type-toggle">
                                <button type="button" class="type-toggle-btn toggle-active" id="btnFormTypeIndividual" onclick="selectFormType('individual')">Individual Request Form</button>
                                <button type="button" class="type-toggle-btn toggle-inactive" id="btnFormTypeManagement" onclick="selectFormType('management')">Management Request Form</button>
                            </div>

                            <!-- INDIVIDUAL EMPLOYEE REQUEST FORM -->
                            <form id="individualForm" action="{{ route('requisitions.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="form_type" value="individual">
                                <input type="hidden" name="status" value="Pending">
                                <div style="display: flex; flex-direction: column; gap: 15px;">
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Employee ID</label>
                                            <input type="text" name="employee_id" class="form-control" placeholder="EMP-12345" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Employee Request/s</label>
                                        <input type="text" name="item_request" class="form-control" placeholder="e.g., 90 - 120hz Monitor" required>
                                    </div>

                                    <div class="form-row-2">
                                        <div class="form-group">
                                            <label>Quantity</label>
                                            <input type="number" name="quantity" class="form-control" placeholder="3" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Cost</label>
                                            <input type="text" name="cost" class="form-control" placeholder="$850" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Reason for Request/s / Additional Comments</label>
                                        <textarea name="comments" class="form-control" style="height: 90px; resize: none;" placeholder="e.g., Stock monitor maxes out at 60Hz."></textarea>
                                    </div>

                                    <div class="action-row">
                                        <button type="reset" class="btn-cancel">Cancel</button>
                                        <button type="submit" class="btn-submit">Request</button>
                                    </div>
                                </div>
                            </form>

                            <!-- MANAGEMENT REQUEST FORM -->
                            <form id="managementForm" action="{{ route('requisitions.store') }}" method="POST" style="display: none;">
                                @csrf
                                <input type="hidden" name="form_type" value="management">
                                <input type="hidden" name="status" value="Pending">
                                <div style="display: flex; flex-direction: column; gap: 15px;">
                                    
                                    <div class="form-row-split">
                                        <div class="form-group">
                                            <label>Department</label>
                                            <select name="department" class="form-control" required>
                                                <option value="" disabled selected>Select Department</option>
                                                <option value="Customer Service/Helpdesk">Customer Service/Helpdesk</option>
                                                <option value="Sales and Customer Support">Sales and Customer Support</option>
                                                <option value="E-Commerce Integration">E-Commerce Integration</option>
                                                <option value="Inventory & Warehouse Management System">Inventory & Warehouse Management System</option>
                                                <option value="Supply Chain Management System">Supply Chain Management System</option>
                                                <option value="Procurement(Purchasing)">Procurement(Purchasing)</option>
                                                <option value="Finance and Accounting">Finance and Accounting</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Management Worker(s) / Employee(s)</label>
                                            <div id="workersContainer">
                                                <div class="worker-entry-row">
                                                    <input type="text" name="workers[0][first_name]" class="form-control" placeholder="First Name" required>
                                                    <input type="text" name="workers[0][last_name]" class="form-control" placeholder="Last Name" required>
                                                    <input type="text" name="workers[0][employee_id]" class="form-control" placeholder="EMP-12345" required>
                                                </div>
                                            </div>
                                            <button type="button" class="btn-add-worker" onclick="addWorkerInputRow()">+ Add Worker</button>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Management Request/s</label>
                                        <input type="text" name="item_request" class="form-control" placeholder="e.g., Heavy-Duty Hydraulic Lift Equipment" required>
                                    </div>

                                    <div class="form-row-2">
                                        <div class="form-group">
                                            <label>Quantity</label>
                                            <input type="number" name="quantity" class="form-control" placeholder="10" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Cost</label>
                                            <input type="text" name="cost" class="form-control" placeholder="$12,000" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Reason for Request/s / Additional Comments</label>
                                        <textarea name="comments" class="form-control" style="height: 90px; resize: none;" placeholder="e.g., Required for system operational upgrade across department."></textarea>
                                    </div>

                                    <div class="action-row">
                                        <button type="reset" class="btn-cancel">Cancel</button>
                                        <button type="submit" class="btn-submit">Request</button>
                                    </div>
                                </div>
                            </form>

                        </div>

                        <div id="empView-pending" style="display: none;" class="tab-content-view"></div>
                        <div id="empView-approved" style="display: none;" class="tab-content-view"></div>
                        <div id="empView-rejected" style="display: none;" class="tab-content-view"></div>
                    </div>

                    <!-- MANAGER SUB-DOMAIN PANEL -->
                    <div id="managerDomainPanel" style="display: none;">
                        <div class="tab-bar">
                            <button class="tab-btn tab-active" id="mgrTab-requests" onclick="switchManagerTab('requests')">Request/s</button>
                            <button class="tab-btn tab-inactive" id="mgrTab-approved" onclick="switchManagerTab('approved')">Approved</button>
                            <button class="tab-btn tab-inactive" id="mgrTab-rejected" onclick="switchManagerTab('rejected')">Rejected</button>
                        </div>
                        
                        <div id="mgrView-requests" style="display: block;" class="tab-content-view"></div>
                        <div id="mgrView-approved" style="display: none;" class="tab-content-view"></div>
                        <div id="mgrView-rejected" style="display: none;" class="tab-content-view"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- JAVASCRIPT LOGIC -->
    <script>
        let appDataset = @json($requisitions ?? []);
        let workerIndexCounter = 1;

        // On Page Load: Check if user was previously in Manager Domain
        document.addEventListener('DOMContentLoaded', () => {
            const activeDomain = sessionStorage.getItem('activeDomain');
            if (activeDomain === 'manager') {
                showManagerDomain();
            } else {
                renderEmployeeContent();
            }
        });

        function selectFormType(type) {
            const btnInd = document.getElementById('btnFormTypeIndividual');
            const btnMgmt = document.getElementById('btnFormTypeManagement');
            const formInd = document.getElementById('individualForm');
            const formMgmt = document.getElementById('managementForm');

            if (type === 'individual') {
                btnInd.className = 'type-toggle-btn toggle-active';
                btnMgmt.className = 'type-toggle-btn toggle-inactive';
                formInd.style.display = 'block';
                formMgmt.style.display = 'none';
            } else {
                btnInd.className = 'type-toggle-btn toggle-inactive';
                btnMgmt.className = 'type-toggle-btn toggle-active';
                formInd.style.display = 'none';
                formMgmt.style.display = 'block';
            }
        }

        function addWorkerInputRow() {
            const container = document.getElementById('workersContainer');
            const newRow = document.createElement('div');
            newRow.className = 'worker-entry-row';
            newRow.id = `workerRow_${workerIndexCounter}`;
            newRow.innerHTML = `
                <input type="text" name="workers[${workerIndexCounter}][first_name]" class="form-control" placeholder="First Name" required>
                <input type="text" name="workers[${workerIndexCounter}][last_name]" class="form-control" placeholder="Last Name" required>
                <input type="text" name="workers[${workerIndexCounter}][employee_id]" class="form-control" placeholder="EMP-12345" required>
                <button type="button" class="btn-remove-worker" onclick="removeWorkerInputRow('workerRow_${workerIndexCounter}')">&times;</button>
            `;
            container.appendChild(newRow);
            workerIndexCounter++;
        }

        function removeWorkerInputRow(rowId) {
            const row = document.getElementById(rowId);
            if (row) row.remove();
        }

        function showManagerDomain() {
            document.getElementById('employeeDomainPanel').style.display = 'none';
            document.getElementById('managerDomainPanel').style.display = 'block';
            document.getElementById('domainToggleBtn').innerText = 'SWITCH TO EMPLOYEE DOMAIN';
            sessionStorage.setItem('activeDomain', 'manager');
            renderManagerContent();
        }

        function showEmployeeDomain() {
            document.getElementById('employeeDomainPanel').style.display = 'block';
            document.getElementById('managerDomainPanel').style.display = 'none';
            document.getElementById('domainToggleBtn').innerText = 'SWITCH TO MANAGER DOMAIN';
            sessionStorage.setItem('activeDomain', 'employee');
            renderEmployeeContent();
        }

        function toggleDomainView() {
            const employeePanel = document.getElementById('employeeDomainPanel');
            if (employeePanel.style.display === 'block') {
                showManagerDomain();
            } else {
                showEmployeeDomain();
            }
        }

        function switchEmployeeTab(tabName) {
            ['form', 'pending', 'approved', 'rejected'].forEach(t => {
                document.getElementById('empView-' + t).style.display = (t === tabName) ? 'flex' : 'none';
                document.getElementById('empTab-' + t).className = (t === tabName) ? "tab-btn tab-active" : "tab-btn tab-inactive";
            });
            if(tabName !== 'form') renderEmployeeContent();
        }

        function switchManagerTab(tabName) {
            ['requests', 'approved', 'rejected'].forEach(t => {
                document.getElementById('mgrView-' + t).style.display = (t === tabName) ? 'flex' : 'none';
                document.getElementById('mgrTab-' + t).className = (t === tabName) ? "tab-btn tab-active" : "tab-btn tab-inactive";
            });
            renderManagerContent();
        }

        function toggleAccordion(id) {
            const target = document.getElementById(id);
            target.style.display = (target.style.display === 'block') ? 'none' : 'block';
        }

        function getStatusBadge(status) {
            if (status === 'Pending') {
                return `<span class="status-dot dot-pending">&#8226;</span>`;
            }
            if (status === 'Approved') {
                return `<span class="status-dot dot-approved">&#10003;</span>`;
            }
            if (status === 'Rejected') {
                return `<span class="status-dot dot-rejected">&#10005;</span>`;
            }
            return `<span class="status-dot dot-pending">&#8226;</span>`;
        }

        function getAccordionTitle(item) {
            if (item.form_type === 'management') {
                return `Management Request: ${escapeHTML(item.item_request)}`;
            }
            return `Employee Request: ${escapeHTML(item.item_request)}`;
        }

        function renderEmployeeContent() {
            const groups = ['Pending', 'Approved', 'Rejected'];
            groups.forEach(statusType => {
                const targetView = document.getElementById('empView-' + statusType.toLowerCase());
                const items = appDataset.filter(d => d.status === statusType);

                if(items.length === 0) {
                    targetView.innerHTML = `<div class="empty-state-text">No items matching status: ${statusType}</div>`;
                    return;
                }

                targetView.innerHTML = items.map(item => `
                    <div class="dropdown-item">
                        <button class="dropdown-trigger" onclick="toggleAccordion('empCollapse-${item.id}')">
                            <span style="display: flex; align-items: center;">
                                ${getStatusBadge(item.status)}
                                <b>${getAccordionTitle(item)}</b>
                            </span>
                            <span>&#9660;</span>
                        </button>
                        <div class="dropdown-content" id="empCollapse-${item.id}">
                            <div class="info-grid">
                                ${item.form_type === 'management' ? `
                                    <div><div class="info-label">Department</div><div class="info-val">${escapeHTML(item.department)}</div></div>
                                    <div style="grid-column: span 2;">
                                        <div class="info-label">Management Workers Involved</div>
                                        <div class="workers-list-box">
                                            ${(item.workers || []).map(w => `• ${escapeHTML(w.first_name)} ${escapeHTML(w.last_name)} (${escapeHTML(w.employee_id)})`).join('<br>')}
                                        </div>
                                    </div>
                                ` : `
                                    <div><div class="info-label">Full Name</div><div class="info-val">${escapeHTML(item.first_name)} ${escapeHTML(item.last_name)}</div></div>
                                    <div><div class="info-label">Employee ID</div><div class="info-val">${escapeHTML(item.employee_id)}</div></div>
                                `}
                                <div><div class="info-label">Requested Item/s</div><div class="info-val">${escapeHTML(item.item_request)}</div></div>
                                <div><div class="info-label">Quantity</div><div class="info-val">${item.quantity}</div></div>
                                <div><div class="info-label">Total Cost Value</div><div class="info-val">${escapeHTML(item.cost)}</div></div>
                                <div><div class="info-label">Reason Comments</div><div class="info-val">${escapeHTML(item.comments || 'N/A')}</div></div>
                            </div>
                            ${item.manager_note ? `
                                <div style="margin-top:10px; padding:10px; background:rgba(255,255,255,0.05); border-left:3px solid #7b4ec2;">
                                    <div class="info-label">Manager Reason Note:</div>
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
            fetch(`/requisitions/${id}/decide`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    status: updatedStatus,
                    manager_note: noteContent
                })
            }).then(response => response.json())
              .then(data => {
                  if(data.success) {
                      // Save state so page reloads back into Manager Domain!
                      sessionStorage.setItem('activeDomain', 'manager');
                      window.location.reload();
                  }
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
                    targetView.innerHTML = `<div class="empty-state-text">No forms matching state: ${mapping.filterStatus}</div>`;
                    return;
                }

                targetView.innerHTML = items.map(item => `
                    <div class="dropdown-item">
                        <button class="dropdown-trigger" onclick="toggleAccordion('mgrCollapse-${item.id}')">
                            <span style="display: flex; align-items: center;">
                                ${getStatusBadge(item.status)}
                                <b>${getAccordionTitle(item)}</b>
                                ${item.form_type === 'management' ? ` &nbsp;- Dept: ${escapeHTML(item.department)}` : ` &nbsp;- Requester: ${escapeHTML(item.first_name)} ${escapeHTML(item.last_name)}`}
                            </span>
                            <span>&#9660;</span>
                        </button>
                        <div class="dropdown-content" id="mgrCollapse-${item.id}">
                            <div class="info-grid">
                                ${item.form_type === 'management' ? `
                                    <div><div class="info-label">Department</div><div class="info-val">${escapeHTML(item.department)}</div></div>
                                    <div style="grid-column: span 2;">
                                        <div class="info-label">Management Workers Involved</div>
                                        <div class="workers-list-box">
                                            ${(item.workers || []).map(w => `• ${escapeHTML(w.first_name)} ${escapeHTML(w.last_name)} (${escapeHTML(w.employee_id)})`).join('<br>')}
                                        </div>
                                    </div>
                                ` : `
                                    <div><div class="info-label">Employee Name</div><div class="info-val">${escapeHTML(item.first_name)} ${escapeHTML(item.last_name)}</div></div>
                                    <div><div class="info-label">Employee ID</div><div class="info-val">${escapeHTML(item.employee_id)}</div></div>
                                `}
                                <div><div class="info-label">Requested Object</div><div class="info-val">${escapeHTML(item.item_request)}</div></div>
                                <div><div class="info-label">Quantity</div><div class="info-val">${item.quantity}</div></div>
                                <div><div class="info-label">Estimated Cost</div><div class="info-val">${escapeHTML(item.cost)}</div></div>
                                <div><div class="info-label">Reason / Comments</div><div class="info-val">${escapeHTML(item.comments || 'N/A')}</div></div>
                            </div>
                            
                            ${mapping.tab === 'requests' ? `
                                <div class="manager-action-box">
                                    <div class="info-label">Manager Decision Note:</div>
                                    <textarea id="noteField-${item.id}" class="manager-textarea" placeholder="Add a note explaining why this request was approved or rejected..."></textarea>
                                    <div class="manager-btn-row">
                                        <button class="btn-action-reject" onclick="handleManagerDecision(${item.id}, 'Rejected')">Reject</button>
                                        <button class="btn-action-approve" onclick="handleManagerDecision(${item.id}, 'Approved')">Approve</button>
                                    </div>
                                </div>
                            ` : `
                                <div style="margin-top:10px; padding:10px; background:rgba(255,255,255,0.05); border-left:3px solid #7b4ec2;">
                                    <div class="info-label">Submitted Manager Note:</div>
                                    <div class="info-val">${escapeHTML(item.manager_note || 'No note logged.')}</div>
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
    </script>
</body>
</html>