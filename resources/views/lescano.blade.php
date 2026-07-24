<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Hewwo -->
    <!-- it doesn't matter if you shimmy -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shantha Motors - Supplier Portal</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .sidebar {
            width: 250px;
            min-width: 250px;
            background-color: #0b1a30;
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

        /* Active State (Purple Gradient with Soft Glow) */
        .btn-active {
            background: linear-gradient(135deg, #a879f5, #7a46d1);
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(122, 70, 209, 0.4);
        }

        /* Inactive State (Pure White Pill, Dark Text) */
        .btn-inactive {
            background-color: #ffffff;
            color: #101622;
        }

        .btn-inactive:hover {
            background-color: #f1f5f9;
            color: #000000;
        }
    </style>
</head>
<body class="bg-[#0F2A4A] text-slate-100 min-h-screen bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-[#0a1d35] via-slate-900 to-black flex m-0 h-screen overflow-hidden">

    <!-- MATCHED SIDEBAR -->
    <aside class="sidebar">
        <div class="w-full flex flex-col items-center">
            <!-- LOGO & BRANDING -->
            <div class="brand-section">
                <svg class="brand-logo" viewBox="0 0 100 100" fill="#ffffff">
                    <path d="M50,15 C55,35 75,30 90,40 C75,55 60,45 50,75 C40,45 25,55 10,40 C25,30 45,35 50,15 Z" />
                </svg>
                <h1 class="brand-title">Shantha</h1>
                <p class="brand-subtitle">Motors</p>
            </div>

            <!-- MODULE NAVIGATION -->
            <nav class="nav-group">
                <a href="/mari" class="nav-link">
                    <button class="sidebar-btn btn-inactive" title="Purchase Requisition and Approval">
                        Purchase Requisition and Approval
                    </button>
                </a>
                <a href="/waylon" class="nav-link">
                    <button class="sidebar-btn btn-active" title="Supplier Management">
                        Supplier Management
                    </button>
                </a>
                <a href="/bulugagao" class="nav-link">
                    <button class="sidebar-btn btn-inactive" title="Purchase Order Management">
                        Purchase Order Management
                    </button>
                </a>
                <a href="/malacaste" class="nav-link">
                    <button class="sidebar-btn btn-inactive" title="Goods Receipt and Invoice Matching">
                        Goods Receipt and Invoice Matching
                    </button>
                </a>
            </nav>
        </div>
    </aside>

    <!-- MAIN CONTENT AREA -->
    <div class="flex-1 flex flex-col h-full overflow-y-auto px-8 py-6">
        <div class="max-w-7xl w-full mx-auto">
            
            @if(session('success'))
                <div class="bg-emerald-500/20 border border-emerald-500/30 text-emerald-400 p-4 rounded-lg mb-6 font-semibold text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-slate-900/80 backdrop-blur-md rounded-xl border border-slate-800 p-6 shadow-2xl">
                
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b border-slate-800 pb-6 mb-6 gap-4">
                    <div>
                        <h1 class="text-3xl font-extrabold tracking-tight bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 bg-clip-text text-transparent flex items-center gap-3">
                            <i class="fa-solid fa-handshake"></i> Supplier Directory
                        </h1>
                        <p class="text-slate-400 text-sm mt-1">Manage corporate vendors inside procurementproject database.</p>
                    </div>
                    <div class="flex gap-3 w-full md:w-auto">
                        <button onclick="document.getElementById('supplierModal').classList.remove('hidden')" class="w-full md:w-auto bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-2.5 px-5 rounded-lg shadow-lg hover:shadow-indigo-500/20 transition-all flex items-center gap-2 text-sm cursor-pointer">
                            <i class="fa-solid fa-plus"></i> Register Supplier
                        </button>
                    </div>
                </div>

                <div class="overflow-hidden rounded-xl border border-slate-800 bg-slate-950/50">
                    <table class="w-full text-left border-collapse text-sm">
                        <thead>
                            <tr class="border-b border-slate-800 bg-slate-900/50 text-xs font-bold uppercase tracking-wider text-slate-400">
                                <th class="p-4">Supplier Info</th>
                                <th class="p-4">Contact Person</th>
                                <th class="p-4">Phone / Email</th>
                                <th class="p-4">Catalog & Pricing</th>
                                <th class="p-4">Rating</th>
                                <th class="p-4">Status</th>
                                <th class="p-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/50">
                            @forelse($suppliers ?? [] as $supplier)
                                <tr class="hover:bg-slate-900/30 transition-all">
                                    <td class="p-4">
                                        <div class="font-bold text-white text-base">{{ $supplier->name }}</div>
                                        <div class="text-xs text-slate-500 font-mono mt-0.5">ID: {{ $supplier->id }}</div>
                                    </td>
                                    <td class="p-4 text-slate-300">{{ $supplier->contact_person }}</td>
                                    <td class="p-4">
                                        <div class="text-slate-300 font-medium">{{ $supplier->phone }}</div>
                                        <div class="text-xs text-slate-500 mt-0.5 font-mono">{{ $supplier->email }}</div>
                                    </td>
                                    <!-- COMBINED FUNCTION (a): Catalog & Pricing -->
                                    <td class="p-4">
                                        <div class="text-xs text-slate-300 max-w-xs truncate" title="{{ $supplier->catalog_summary ?? 'N/A' }}">
                                            {{ $supplier->catalog_summary ?? 'No catalog added' }}
                                        </div>
                                    </td>
                                    <!-- COMBINED FUNCTION (b): Evaluation & Ratings -->
                                    <td class="p-4">
                                        <div class="flex items-center gap-1.5">
                                            <span class="text-amber-400 text-xs"><i class="fa-solid fa-star"></i></span>
                                            <span class="font-bold font-mono text-white">{{ number_format($supplier->rating ?? 5.0, 1) }}</span>
                                        </div>
                                        <div class="text-[10px] text-slate-500 mt-1 font-mono">
                                            D:{{ $supplier->delivery_rating ?? '5.0' }} | Q:{{ $supplier->quality_rating ?? '5.0' }} | C:{{ $supplier->cost_rating ?? '5.0' }}
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <span class="px-2.5 py-1 rounded-full text-xs font-bold inline-flex items-center gap-1.5 {{ $supplier->status === 'Active' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-rose-500/10 text-rose-400 border border-rose-500/20' }}">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $supplier->status === 'Active' ? 'bg-emerald-400 animate-pulse' : 'bg-rose-400' }}"></span>
                                            {{ $supplier->status }}
                                        </span>
                                    </td>
                                    <!-- SEPARATED FUNCTIONS (c) and (d) -->
                                    <td class="p-4">
                                        <div class="flex items-center gap-2">
                                            <!-- Separate Function (c): Track contracts and terms -->
                                            <button type="button" 
                                                    onclick="alert('Contracts & Terms for {{ $supplier->name }}:\n- Standard Payment Terms: Net 30\n- Contract Expiration: Dec 2026')"
                                                    class="bg-slate-800 hover:bg-slate-700 text-indigo-300 hover:text-indigo-200 px-2.5 py-1.5 rounded-lg text-xs font-semibold border border-slate-700 flex items-center gap-1 transition-all cursor-pointer">
                                                <i class="fa-solid fa-file-contract"></i>
                                                <span>Contracts</span>
                                            </button>

                                            <!-- Separate Function (d): View purchase history -->
                                            <button type="button" 
                                                    onclick="alert('Purchase History for {{ $supplier->name }}:\n- Total Orders: 12\n- Last Purchase: PO-2026-089 (₱45,000)')"
                                                    class="bg-slate-800 hover:bg-slate-700 text-purple-300 hover:text-purple-200 px-2.5 py-1.5 rounded-lg text-xs font-semibold border border-slate-700 flex items-center gap-1 transition-all cursor-pointer">
                                                <i class="fa-solid fa-clock-rotate-left"></i>
                                                <span>History</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="p-12 text-center text-slate-500">
                                        <div class="text-4xl mb-3"><i class="fa-regular fa-folder-open text-slate-600"></i></div>
                                        <div class="font-semibold text-slate-400">No suppliers registered yet.</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- REGISTER MODAL -->
    <div id="supplierModal" class="hidden fixed inset-0 bg-slate-950/80 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-slate-900 border border-slate-800 rounded-xl w-full max-w-lg p-6 shadow-2xl relative max-h-[90vh] overflow-y-auto">
            <button onclick="document.getElementById('supplierModal').classList.add('hidden')" class="absolute top-4 right-4 text-slate-400 hover:text-white transition-all cursor-pointer">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
            <h2 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                <i class="fa-solid fa-plus text-indigo-400"></i> Register Supplier
            </h2>
            
            <form action="{{ route('supplier.store') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-indigo-400">Supplier Name</label>
                    <input type="text" name="name" required placeholder="Acme Parts Ltd" class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2.5 mt-1 text-white focus:outline-none focus:border-indigo-500 text-sm">
                </div>
                
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-indigo-400">Contact Person</label>
                        <input type="text" name="contact_person" required placeholder="John Doe" class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2.5 mt-1 text-white focus:outline-none focus:border-indigo-500 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-indigo-400">Phone Number</label>
                        <input type="text" name="phone" placeholder="+63" class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2.5 mt-1 text-white focus:outline-none focus:border-indigo-500 text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-indigo-400">Email Address</label>
                    <input type="email" name="email" required placeholder="contact@acme.com" class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2.5 mt-1 text-white focus:outline-none focus:border-indigo-500 text-sm">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-indigo-400">Product Catalog & Pricing Details</label>
                    <textarea name="catalog_summary" rows="2" placeholder="e.g., Engine Oil (₱500/unit), Brake Pads (₱1,200/unit)" class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2.5 mt-1 text-white focus:outline-none focus:border-indigo-500 text-sm"></textarea>
                </div>

                <div class="border-t border-slate-800 pt-3">
                    <label class="block text-xs font-bold uppercase tracking-wider text-indigo-400 mb-2">Performance Evaluation Ratings</label>
                    <div class="grid grid-cols-3 gap-3">
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400">Delivery (1-5)</label>
                            <input type="number" step="0.1" min="1" max="5" name="delivery_rating" value="5.0" class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2 mt-1 text-white font-mono text-xs focus:outline-none focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400">Quality (1-5)</label>
                            <input type="number" step="0.1" min="1" max="5" name="quality_rating" value="5.0" class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2 mt-1 text-white font-mono text-xs focus:outline-none focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-400">Cost (1-5)</label>
                            <input type="number" step="0.1" min="1" max="5" name="cost_rating" value="5.0" class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2 mt-1 text-white font-mono text-xs focus:outline-none focus:border-indigo-500">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-indigo-400">Overall Rating</label>
                        <input type="number" step="0.1" min="1" max="5" name="rating" value="5.0" class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2.5 mt-1 text-white focus:outline-none focus:border-indigo-500 font-mono text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-indigo-400">Status</label>
                        <select name="status" class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2.5 mt-1 text-white focus:outline-none focus:border-indigo-500 text-sm">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                
                <div class="pt-4 border-t border-slate-800 flex justify-end gap-2 text-sm">
                    <button type="button" onclick="document.getElementById('supplierModal').classList.add('hidden')" class="bg-slate-800 hover:bg-slate-700 text-white px-4 py-2 rounded-lg font-semibold cursor-pointer">Cancel</button>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg font-bold shadow-lg shadow-indigo-500/20 transition-all cursor-pointer">Save Vendor</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>