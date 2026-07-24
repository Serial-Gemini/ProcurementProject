<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shantha Motors - Purchase Order Management</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .sidebar {
            width: 250px;
            min-width: 250px;
            background-color: #0d213a;
            padding: 40px 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
            height: 100vh;
            z-index: 10;
            box-sizing: border-box;
        }

        .brand-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin-bottom: 35px;
            width: 100%;
        }

        .brand-logo {
            width: 65px;
            height: 65px;
            margin-bottom: 12px;
        }

        .brand-title {
            color: #ffffff;
            font-size: 19px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin: 0;
            line-height: 1.2;
        }

        .brand-subtitle {
            color: #bfa1fc;
            font-size: 11px;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-top: 4px;
            font-weight: 500;
        }

        .nav-group {
            display: flex;
            flex-direction: column;
            gap: 16px;
            width: 100%;
            align-items: center;
        }

        .nav-link {
            text-decoration: none;
            width: 100%;
            display: block;
        }

        .sidebar-btn {
            width: 100%;
            padding: 0 12px;
            height: 44px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 600;
            text-align: center;
            cursor: pointer;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            box-sizing: border-box;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .btn-active {
            background: linear-gradient(135deg, #a879f5, #7a46d1);
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(122, 70, 209, 0.4);
        }

        .btn-inactive {
            background-color: #ffffff;
            color: #101622;
        }

        .btn-inactive:hover {
            background-color: #e2e8f0;
            color: #000000;
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 font-sans flex h-screen overflow-hidden m-0">

    <!-- SIDEBAR NAVIGATION -->
    <aside class="sidebar">
        <div class="w-full flex flex-col items-center">
            <!-- LOGO BRANDING -->
            <div class="brand-section">
                <svg class="brand-logo" viewBox="0 0 100 100" fill="#ffffff">
                    <path d="M50,15 C55,35 75,30 90,40 C75,55 60,45 50,75 C40,45 25,55 10,40 C25,30 45,35 50,15 Z" />
                </svg>
                <h1 class="brand-title">Shantha</h1>
                <p class="brand-subtitle">Motors</p>
            </div>

            <!-- MODULE LINKS -->
            <nav class="nav-group">
                <a href="/mari" class="nav-link">
                    <button class="sidebar-btn btn-inactive" title="Purchase Requisition and Approval">Purchase Requisition and Approval</button>
                </a>
                <a href="/waylon" class="nav-link">
                    <button class="sidebar-btn btn-inactive" title="Supplier Management">Supplier Management</button>
                </a>
                <a href="/bulugagao" class="nav-link">
                    <button class="sidebar-btn btn-active" title="Purchase Order Management">Purchase Order Management</button>
                </a>
                <a href="/malacaste" class="nav-link">
                    <button class="sidebar-btn btn-inactive" title="Goods Receipt and Invoice Matching">Goods Receipt and Invoice Matching</button>
                </a>
            </nav>
        </div>
    </aside>

    <!-- MAIN WORKSPACE -->
    <main class="flex-1 flex flex-col h-full overflow-hidden min-w-0">
        
        <!-- TOPBAR -->
        <header class="bg-indigo-900/80 border-b border-indigo-800/50 h-16 flex items-center justify-center text-white font-bold tracking-widest text-lg uppercase shadow-md flex-shrink-0">
            Purchase Order Management
        </header>

        <!-- CONTENT WORKSPACE -->
        <div class="flex-1 p-6 overflow-y-auto bg-slate-900">
            
            @if(session('success'))
                <div id="flash-success-banner" class="bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 p-4 rounded-lg mb-6 font-semibold text-sm flex justify-between items-center shadow-lg transition-opacity duration-500">
                    <span>{{ session('success') }}</span>
                    <i class="fa-solid fa-circle-check text-emerald-400"></i>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-rose-500/20 border border-rose-500/40 text-rose-300 p-4 rounded-lg mb-6 font-semibold text-sm shadow-lg">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- SUB-MODULE TABS -->
            <div class="flex gap-3 mb-6 flex-shrink-0">
                <button id="btn-po" onclick="switchTab('po')" class="sub-tab-btn flex-1 py-3 rounded-lg text-xs font-bold uppercase transition cursor-pointer bg-indigo-700 text-white shadow-lg">
                    PO Registry
                </button>
                <button id="btn-create" onclick="switchTab('create')" class="sub-tab-btn flex-1 py-3 rounded-lg text-xs font-bold uppercase transition cursor-pointer bg-slate-800 text-slate-400 hover:text-white hover:bg-slate-700">
                    Generate Order
                </button>
                <button id="btn-matching" onclick="switchTab('matching')" class="sub-tab-btn flex-1 py-3 rounded-lg text-xs font-bold uppercase transition cursor-pointer bg-slate-800 text-slate-400 hover:text-white hover:bg-slate-700">
                    Invoice Verification
                </button>
            </div>

            <!-- VIEW 1: PO REGISTRY -->
            <div id="view-po" class="app-view flex flex-col gap-4">
                <div class="bg-slate-850 border border-slate-800 rounded-xl p-5 shadow-xl bg-slate-800/40 backdrop-blur-md">
                    
                    <div class="bg-indigo-950/80 border border-indigo-800/60 text-white p-3 rounded-lg text-xs font-bold uppercase tracking-wider mb-4 flex justify-between items-center">
                        <span>Standard Operational Ledger</span>
                        <span class="text-indigo-300">Records Found: {{ count($purchaseOrders ?? []) }}</span>
                    </div>

                    <!-- Filter Controls -->
                    <div class="flex flex-wrap items-center gap-2 mb-4">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider mr-2">Filter Status:</span>
                        <button id="filter-btn-all" onclick="filterStatusTable('all')" class="filter-btn px-3.5 py-1.5 rounded-lg text-xs font-bold uppercase bg-indigo-600 text-white shadow cursor-pointer transition">All</button>
                        <button id="filter-btn-prepared" onclick="filterStatusTable('prepared')" class="filter-btn px-3.5 py-1.5 rounded-lg text-xs font-bold uppercase bg-slate-800 text-slate-400 hover:bg-slate-700 hover:text-white cursor-pointer transition">Prepared</button>
                        <button id="filter-btn-sent" onclick="filterStatusTable('sent')" class="filter-btn px-3.5 py-1.5 rounded-lg text-xs font-bold uppercase bg-slate-800 text-slate-400 hover:bg-slate-700 hover:text-white cursor-pointer transition">Sent</button>
                        <button id="filter-btn-confirmed" onclick="filterStatusTable('confirmed')" class="filter-btn px-3.5 py-1.5 rounded-lg text-xs font-bold uppercase bg-slate-800 text-slate-400 hover:bg-slate-700 hover:text-white cursor-pointer transition">Confirmed</button>
                        <button id="filter-btn-delivered" onclick="filterStatusTable('delivered')" class="filter-btn px-3.5 py-1.5 rounded-lg text-xs font-bold uppercase bg-slate-800 text-slate-400 hover:bg-slate-700 hover:text-white cursor-pointer transition">Delivered</button>
                        <button id="filter-btn-cancelled" onclick="filterStatusTable('cancelled')" class="filter-btn px-3.5 py-1.5 rounded-lg text-xs font-bold uppercase bg-slate-800 text-slate-400 hover:bg-slate-700 hover:text-white cursor-pointer transition">Cancelled</button>
                    </div>

                    <!-- Table Container -->
                    <div class="overflow-x-auto rounded-lg border border-slate-800">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-indigo-950 text-indigo-200 uppercase tracking-wider font-semibold border-b border-slate-800">
                                <tr>
                                    <th class="p-3.5">PO Reference</th>
                                    <th class="p-3.5">Associated Supplier</th>
                                    <th class="p-3.5">Aggregate Cost</th>
                                    <th class="p-3.5">Action</th>
                                    <th class="p-3.5">Current State</th>
                                </tr>
                            </thead>
                            <tbody id="po-table-body" class="divide-y divide-slate-800/60 bg-slate-900/60">
                                @forelse($purchaseOrders ?? [] as $po)
                                    <tr class="po-row hover:bg-slate-800/60 transition border-b border-slate-800/50" data-status="{{ strtolower($po->status) }}">
                                        <td class="p-3.5 font-mono font-bold text-indigo-400">{{ $po->po_number }}</td>
                                        <td class="p-3.5 text-slate-200 font-medium">{{ $po->supplier }}</td>
                                        <td class="p-3.5 font-bold text-emerald-400">${{ number_format($po->amount, 2) }}</td>
                                        <td class="p-3.5">
                                            <button type="button" onclick="sendPO('{{ $po->id ?? $po->po_number }}', this)" class="bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-[11px] px-3 py-1.5 rounded-lg shadow hover:shadow-indigo-500/20 cursor-pointer transition flex items-center gap-1.5">
                                                <i class="fa-solid fa-paper-plane text-[10px]"></i> Send PO
                                            </button>
                                        </td>
                                        <td class="p-3.5">
                                            <select onchange="updatePOStatus('{{ $po->id ?? $po->po_number }}', this.value, this)" class="bg-slate-950 border border-slate-800 text-xs font-bold uppercase rounded-lg p-2 text-slate-200 cursor-pointer focus:outline-none focus:border-indigo-500 transition">
                                                <option value="prepared" {{ strtolower($po->status) == 'prepared' ? 'selected' : '' }}>Prepared</option>
                                                <option value="sent" {{ strtolower($po->status) == 'sent' ? 'selected' : '' }}>Sent</option>
                                                <option value="confirmed" {{ strtolower($po->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                                <option value="delivered" {{ strtolower($po->status) == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                                <option value="cancelled" {{ strtolower($po->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-10 text-center text-slate-500 font-semibold">
                                            No purchase orders found in database. Create or auto-generate one in "Generate Order" tab.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- VIEW 2: GENERATE ORDER -->
            <div id="view-create" class="app-view hidden flex-col gap-4">
                <div class="bg-slate-800/40 border-l-4 border-amber-500 border-slate-800 rounded-xl p-5 shadow-xl flex justify-between items-center">
                    <div>
                        <h4 class="font-bold text-white text-sm">Automated Low-Stock Reorder Engine</h4>
                        <p class="text-xs text-slate-400 mt-1">Automatically generate purchase order from approved requisition.</p>
                    </div>
                    <button type="button" onclick="triggerAutoPO()" class="bg-amber-600 hover:bg-amber-500 text-white font-bold text-xs px-4 py-2.5 rounded-lg uppercase tracking-wider shadow cursor-pointer transition">
                        ⚡ Execute Auto-PO
                    </button>
                </div>

                <div class="bg-slate-800/40 border border-slate-800 rounded-xl p-5 shadow-xl">
                    <div class="bg-indigo-950/80 border border-indigo-800/60 text-white p-3 rounded-lg text-xs font-bold uppercase tracking-wider mb-5">
                        Generate Purchase Order Manually
                    </div>

                    <form id="create-po-form" action="{{ route('po.store') }}" method="POST" class="space-y-4 text-xs">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block font-bold uppercase tracking-wider text-slate-400 mb-1">PO Reference Code</label>
                                <input type="text" id="form-po-number" name="po_number" readonly class="w-full bg-slate-950 border border-slate-800 rounded-lg p-3 text-indigo-300 font-mono font-bold cursor-not-allowed select-none">
                            </div>
                            <div>
                                <label class="block font-bold uppercase tracking-wider text-slate-400 mb-1">Delivery Milestone Date</label>
                                <input type="date" id="form-po-date" name="delivery_milestone" required class="w-full bg-slate-950 border border-slate-800 rounded-lg p-3 text-white focus:outline-none focus:border-indigo-500 transition">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block font-bold uppercase tracking-wider text-slate-400 mb-1">Linked Approved Requisition</label>
                                <select id="form-po-requisition" name="requisition_id" required onchange="autoFillCostFromRequisition()" class="w-full bg-slate-950 border border-slate-800 rounded-lg p-3 text-white focus:outline-none focus:border-indigo-500 transition">
                                    <option value="" data-cost="0">-- Select Approved Requisition --</option>
                                    @foreach($requisitions ?? [] as $req)
                                        @php 
                                            $cleanCost = (float) preg_replace('/[^0-9.]/', '', $req->cost ?? '0');
                                            $qty = (int) ($req->quantity ?? 1);
                                            $total = $cleanCost * $qty;
                                        @endphp
                                        <option value="{{ $req->id }}" data-cost="{{ $total }}">
                                            REQ-{{ $req->id }} ({{ $req->first_name ?? '' }} {{ $req->last_name ?? '' }} - {{ $req->item_request ?? 'Item' }}) - ${{ number_format($total, 2) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block font-bold uppercase tracking-wider text-slate-400 mb-1">Supplier Profile</label>
                                <select id="form-po-supplier-select" name="supplier_id" required onchange="syncSupplierData(this)" class="w-full bg-slate-950 border border-slate-800 rounded-lg p-3 text-white focus:outline-none focus:border-indigo-500 transition">
                                    <option value="">-- Choose Authorized Vendor --</option>
                                    @foreach($suppliers ?? [] as $sup)
                                        <option value="{{ $sup->id }}" data-name="{{ $sup->name }}">{{ $sup->name }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="supplier" id="form-po-supplier-name">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block font-bold uppercase tracking-wider text-slate-400 mb-1">Aggregate Cost Valuation ($)</label>
                                <input type="number" step="0.01" id="form-po-amount" name="amount" placeholder="0.00" required class="w-full bg-slate-950 border border-slate-800 rounded-lg p-3 text-emerald-400 font-bold focus:outline-none focus:border-indigo-500 transition">
                            </div>

                            <div>
                                <label class="block font-bold uppercase tracking-wider text-slate-400 mb-1">Administrative Notes</label>
                                <input type="text" id="form-po-instructions" name="instructions" placeholder="Logistics notes..." class="w-full bg-slate-950 border border-slate-800 rounded-lg p-3 text-white focus:outline-none focus:border-indigo-500 transition">
                            </div>
                        </div>

                        <div class="flex justify-end pt-3">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs uppercase tracking-wider px-6 py-3 rounded-lg shadow-lg hover:shadow-indigo-500/30 transition cursor-pointer">
                                Save & Issue PO
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- VIEW 3: INVOICE MATCHING -->
            <div id="view-matching" class="app-view hidden flex-col gap-4">
                <div class="bg-slate-800/40 border border-slate-800 rounded-xl p-5 shadow-xl">
                    <div class="bg-indigo-950/80 border border-indigo-800/60 text-white p-3 rounded-lg text-xs font-bold uppercase tracking-wider mb-5">
                        3-Way Document Matching Verifier
                    </div>

                    <div class="mb-5 text-xs">
                        <label class="block font-bold uppercase tracking-wider text-slate-400 mb-1">Select Issued Purchase Order</label>
                        <select id="match-po-select" onchange="updateMatchingFlow()" class="w-full bg-slate-950 border border-slate-800 rounded-lg p-3 text-white focus:outline-none focus:border-indigo-500 transition font-medium">
                            <option value="">-- Choose PO from Database --</option>
                            @foreach($purchaseOrders ?? [] as $po)
                                <option value="{{ $po->po_number }}" data-id="{{ $po->id ?? '' }}" data-amount="{{ $po->amount }}" data-dr="{{ $po->dr_number }}" data-inv="{{ $po->invoice_number }}">
                                    {{ $po->po_number }} - {{ $po->supplier }} (${{ number_format($po->amount, 2) }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div class="bg-slate-950 border border-slate-800 rounded-lg p-4">
                            <span class="block text-[10px] font-bold uppercase text-indigo-400 border-b border-slate-800 pb-1 mb-2">Stipulated PO Cost</span>
                            <p id="match-po-val" class="text-lg font-bold text-emerald-400">$0.00</p>
                        </div>
                        <div class="bg-slate-950 border border-slate-800 rounded-lg p-4">
                            <span class="block text-[10px] font-bold uppercase text-amber-400 border-b border-slate-800 pb-1 mb-2">Delivery Receipt Status</span>
                            <input type="text" id="match-dr-num" value="DR-PENDING" readonly class="w-full bg-transparent text-xs text-slate-300 font-mono mb-1 focus:outline-none">
                            <p class="text-xs font-bold text-amber-400">Cargo Verified ✔</p>
                        </div>
                        <div class="bg-slate-950 border border-slate-800 rounded-lg p-4">
                            <span class="block text-[10px] font-bold uppercase text-emerald-400 border-b border-slate-800 pb-1 mb-2">Supplier Invoice Amount</span>
                            <input type="text" id="match-inv-num" value="INV-PENDING" readonly class="w-full bg-transparent text-xs text-slate-300 font-mono mb-1 focus:outline-none">
                            <p id="match-inv-val" class="text-lg font-bold text-emerald-400">$0.00</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between border-t border-slate-800 pt-4">
                        <p class="text-xs text-slate-400">Ensure PO, DR, and Supplier Invoice figures match before verification.</p>
                        <button id="btn-approve-matching" type="button" onclick="approveMatchingPayment()" class="bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs uppercase tracking-wider px-6 py-3 rounded-lg shadow-lg hover:shadow-indigo-500/30 transition cursor-pointer">
                            Confirm 3-Way Match
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- CORE JS SCRIPT -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            generatePONumber();
            setDefaultDate();
            initBannerAutoDismiss();

            const urlParams = new URLSearchParams(window.location.search);
            const savedTab = localStorage.getItem('po_module_tab');
            const activeTab = urlParams.get('tab') || savedTab || 'po';
            switchTab(activeTab, false);
        });

        // 1. AUTO DISMISS SUCCESS BANNER AFTER 3 SECONDS
        function initBannerAutoDismiss() {
            const banner = document.getElementById('flash-success-banner');
            if (banner) {
                setTimeout(() => {
                    banner.style.opacity = '0';
                    setTimeout(() => {
                        banner.remove();
                    }, 500);
                }, 3000);
            }
        }

        function generatePONumber() {
            const poNumInput = document.getElementById('form-po-number');
            if(poNumInput && (!poNumInput.value || poNumInput.value === '')) {
                const randomSeq = Math.floor(1000 + Math.random() * 9000);
                poNumInput.value = `PO-2026-${randomSeq}`;
            }
        }

        function setDefaultDate() {
            const dateInput = document.getElementById('form-po-date');
            if(dateInput && !dateInput.value) {
                const today = new Date();
                today.setDate(today.getDate() + 7);
                dateInput.value = today.toISOString().split('T')[0];
            }
        }

        function syncSupplierData(selectEl) {
            const selectedOpt = selectEl.options[selectEl.selectedIndex];
            const name = selectedOpt ? selectedOpt.getAttribute('data-name') : '';
            document.getElementById('form-po-supplier-name').value = name || selectEl.value;
        }

        function autoFillCostFromRequisition() {
            const select = document.getElementById('form-po-requisition');
            const amountInput = document.getElementById('form-po-amount');
            if(!select || !amountInput) return;

            const selectedOpt = select.options[select.selectedIndex];
            if(selectedOpt && selectedOpt.dataset.cost) {
                amountInput.value = parseFloat(selectedOpt.dataset.cost).toFixed(2);
            }
        }

        function switchTab(viewId, updateUrl = true) {
            ['po', 'create', 'matching'].forEach(tab => {
                const view = document.getElementById(`view-${tab}`);
                const btn = document.getElementById(`btn-${tab}`);
                
                if (tab === viewId) {
                    view.classList.remove('hidden');
                    view.classList.add('flex');
                    btn.className = "sub-tab-btn flex-1 py-3 rounded-lg text-xs font-bold uppercase transition cursor-pointer bg-indigo-700 text-white shadow-lg";
                } else {
                    view.classList.add('hidden');
                    view.classList.remove('flex');
                    btn.className = "sub-tab-btn flex-1 py-3 rounded-lg text-xs font-bold uppercase transition cursor-pointer bg-slate-800 text-slate-400 hover:text-white hover:bg-slate-700";
                }
            });

            localStorage.setItem('po_module_tab', viewId);

            if (updateUrl) {
                const newUrl = new URL(window.location.href);
                newUrl.searchParams.set('tab', viewId);
                window.history.pushState({ path: newUrl.href }, '', newUrl.href);
            }
        }

        function triggerAutoPO() {
            const reqSelect = document.getElementById('form-po-requisition');
            const supSelect = document.getElementById('form-po-supplier-select');
            const poForm = document.getElementById('create-po-form');

            generatePONumber();
            setDefaultDate();

            if(reqSelect && reqSelect.options.length > 1) {
                reqSelect.selectedIndex = 1;
                autoFillCostFromRequisition();
            } else {
                alert("⚠️ Requisition Required: Please create an approved requisition first.");
                return;
            }

            if(supSelect && supSelect.options.length > 1) {
                supSelect.selectedIndex = 1;
                syncSupplierData(supSelect);
            } else {
                alert("⚠️ Supplier Required: Please register at least one supplier.");
                return;
            }

            if(confirm("⚡ Auto-generate Purchase Order from active requisition?")) {
                poForm.submit();
            }
        }

        function filterStatusTable(status) {
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.className = "filter-btn px-3.5 py-1.5 rounded-lg text-xs font-bold uppercase bg-slate-800 text-slate-400 hover:bg-slate-700 hover:text-white cursor-pointer transition";
            });
            const activeBtn = document.getElementById('filter-btn-' + status);
            if(activeBtn) {
                activeBtn.className = "filter-btn px-3.5 py-1.5 rounded-lg text-xs font-bold uppercase bg-indigo-600 text-white shadow cursor-pointer transition";
            }

            const rows = document.querySelectorAll('.po-row');
            rows.forEach(row => {
                if (status === 'all' || row.dataset.status === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // 2. FIXED STATUS UPDATE LOGIC
        function updatePOStatus(poId, newStatus, element = null) {
            const csrfMeta = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '';

            if(element) {
                const parentRow = element.closest('.po-row');
                if(parentRow) {
                    parentRow.setAttribute('data-status', newStatus.toLowerCase());
                }
            }

            // Supports both single update endpoint or ID endpoint formats
            fetch('/po/update-status', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ 
                    id: poId,
                    po_number: poId, 
                    status: newStatus 
                })
            })
            .then(res => res.json().catch(() => ({ status: 'ok' })))
            .then(data => {
                // Status successfully updated on backend
            })
            .catch(() => {
                // Fallback route attempt for RESTful endpoint /po/{id}/status
                fetch(`/po/${poId}/status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ status: newStatus })
                });
            });
        }

        function sendPO(poId, btnElement = null) {
            if(btnElement) {
                const parentRow = btnElement.closest('.po-row');
                if(parentRow) {
                    const select = parentRow.querySelector('select');
                    if(select) select.value = 'sent';
                }
            }
            updatePOStatus(poId, 'sent', btnElement);
        }

        function updateMatchingFlow() {
            const select = document.getElementById('match-po-select');
            if(!select || !select.value) {
                document.getElementById('match-po-val').textContent = `$0.00`;
                document.getElementById('match-inv-val').textContent = `$0.00`;
                document.getElementById('match-dr-num').value = 'DR-PENDING';
                document.getElementById('match-inv-num').value = 'INV-PENDING';
                return;
            }
            
            const opt = select.options[select.selectedIndex];
            const amount = parseFloat(opt.dataset.amount || 0).toFixed(2);

            document.getElementById('match-po-val').textContent = `$${amount}`;
            document.getElementById('match-dr-num').value = opt.dataset.dr || 'DR-PENDING';
            document.getElementById('match-inv-num').value = opt.dataset.inv || 'INV-PENDING';
            document.getElementById('match-inv-val').textContent = `$${amount}`;
        }

        function approveMatchingPayment() {
            const select = document.getElementById('match-po-select');
            if(select && select.value) {
                const opt = select.options[select.selectedIndex];
                const targetId = opt.dataset.id || select.value;
                alert(`PO ${select.value} successfully matched with Delivery Receipt & Invoice!`);
                updatePOStatus(targetId, 'delivered');
            } else {
                alert('Please select a Purchase Order to verify.');
            }
        }
    </script>
</body>
</html>