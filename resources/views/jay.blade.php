<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Order Management - Shantha Motors</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .bg-purple-header { background-color: #1f0b61; }
    </style>
</head>
<body class="bg-[#0F2A4A] text-slate-100 min-h-screen bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-[#0a1d35] via-slate-900 to-black flex m-0 h-screen overflow-hidden">

    <div class="w-[260px] min-w-[260px] bg-[#08182d]/80 backdrop-blur-md p-6 flex flex-col justify-between border-r border-slate-800 h-full">
        <div>
            <div class="text-center mb-8">
                <svg class="w-16 h-16 mx-auto mb-2 fill-indigo-400" viewBox="0 0 100 100">
                    <path d="M50,15 C55,35 75,30 90,40 C75,55 60,45 50,75 C40,45 25,55 10,40 C25,30 45,35 50,15 Z" />
                </svg>
                <div class="text-white text-xl font-extrabold tracking-widest uppercase">Shantha</div>
                <div class="text-indigo-400 text-xs tracking-[4px] uppercase font-semibold">Motors</div>
            </div>

            <div class="flex flex-col gap-3 w-full">
                <a href="/mari" class="w-full">
                    <button class="w-full py-3 px-4 rounded-full text-xs font-bold text-indigo-400 bg-slate-900 hover:bg-slate-800/80 border border-slate-800 transition-all text-center cursor-pointer">
                        Purchase Requisition
                    </button>
               
    </div>

    <div class="flex-1 flex flex-col h-full overflow-y-auto px-8 py-6">
        <div class="max-w-7xl w-full mx-auto">
            
            @if(session('success'))
                <div class="bg-emerald-500/20 border border-emerald-500/30 text-emerald-400 p-4 rounded-lg mb-6 font-semibold text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-white tracking-wider">Purchase Order Management</h1>
                    <p class="text-slate-400 text-xs">Standard operational ledger and internal verification tools.</p>
                </div>
                
                <div class="flex bg-slate-950/60 p-1.5 rounded-lg border border-slate-800 gap-1.5">
                    <button id="tab-po" onclick="switchPage('po')" class="px-4 py-2 text-xs font-bold rounded-md bg-indigo-600 border border-indigo-400 text-white cursor-pointer transition-all">
                        PO Registry
                    </button>
                    <button id="tab-create" onclick="switchPage('create')" class="px-4 py-2 text-xs font-bold rounded-md bg-purple-header border border-transparent text-slate-400 hover:text-white cursor-pointer transition-all">
                        Create Order
                    </button>
                </div>
            </div>

            <div class="w-full">
                
                <!-- PAGE 1: PO LIST -->
               
                                <tbody class="divide-y divide-slate-800/50">
                                    @forelse($purchaseOrders ?? [] as $po)
                                        <tr class="hover:bg-slate-900/30 transition-all">
                                            <td class="p-4 font-bold text-white">{{ $po->po_code }}</td>
                                            <td class="p-4 text-slate-300">{{ $po->supplier->name ?? 'N/A' }}</td>
                                            <td class="p-4 text-indigo-400 font-mono">REQ-{{ $po->requisition->id ?? 'N/A' }}</td>
                                            <td class="p-4 font-bold text-emerald-400">PHP {{ number_format($po->valuation, 2) }}</td>
                                            <td class="p-4 text-slate-400">{{ $po->delivery_milestone }}</td>
                                            <td class="p-4">
                                                <span class="px-2 py-0.5 rounded text-xs font-bold bg-indigo-500/10 text-indigo-400 border border-indigo-500/20">
                                                    {{ $po->status }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="p-8 text-center text-slate-500">No purchase orders generated inside procurementproject yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- PAGE 2: CREATE ORDER -->
                <div id="page-create" class="hidden flex-col gap-4">
                    <div class="bg-slate-900/80 backdrop-blur-md border border-slate-800 rounded-xl p-6 shadow-2xl">
                        <h2 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-file-signature text-indigo-400"></i> Generate Purchase Order
                        </h2>
                        
                        <form action="{{ route('po.store') }}" method="POST" class="space-y-4 text-sm">
                            @csrf
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-indigo-400">Associated Requisition</label>
                                    <select name="requisition_id" required class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2.5 mt-1 text-white focus:outline-none focus:border-indigo-500">
                                        <option value="">-- Choose Requisition --</option>
                                        @foreach($requisitions ?? [] as $req)
                                            <option value="{{ $req->id }}">{{ $req->first_name }} - {{ $req->item_request }} ({{ $req->cost }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-indigo-400">Associated Supplier</label>
                                    <select name="supplier_id" required class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2.5 mt-1 text-white focus:outline-none focus:border-indigo-500">
                                        <option value="">-- Choose Supplier --</option>
                                        @foreach($suppliers ?? [] as $sup)
                                            <option value="{{ $sup->id }}">{{ $sup->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-indigo-400">Execution Delivery Milestone</label>
                                    <input type="date" name="delivery_milestone" required class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2.5 mt-1 text-white focus:outline-none focus:border-indigo-500">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-indigo-400">Administrative Instructions</label>
                                <textarea name="instructions" placeholder="Enter specialized logistics details..." class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2.5 mt-1 text-white focus:outline-none focus:border-indigo-500 h-24"></textarea>
                            </div>
                            <div class="pt-4 border-t border-slate-800 flex justify-end gap-2 text-sm">
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-5 py-2.5 rounded-lg font-bold shadow-lg cursor-pointer">
                                    Issue Standard PO
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function switchPage(pageId) {
            ['page-po', 'page-create'].forEach(p => {
                document.getElementById(p).classList.add('hidden');
                document.getElementById(p).classList.remove('flex');
            });

            ['tab-po', 'tab-create'].forEach(t => {
                document.getElementById(t).classList.remove('bg-indigo-600', 'border-indigo-400', 'text-white');
                document.getElementById(t).classList.add('bg-purple-header', 'border-transparent', 'text-slate-400');
            });

            document.getElementById('page-' + pageId).classList.remove('hidden');
            if (pageId === 'po') {
                document.getElementById('page-' + pageId).classList.add('flex');
            }

            document.getElementById('tab-' + pageId).classList.remove('bg-purple-header', 'border-transparent', 'text-slate-400');
            document.getElementById('tab-' + pageId).classList.add('bg-indigo-600', 'border-indigo-400', 'text-white');
        }
    </script>
</body>
</html>