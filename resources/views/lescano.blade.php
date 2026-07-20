<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shantha Motors - Supplier Portal</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                </a>
                <a href="/waylon" class="w-full">
                    <button class="w-full py-3 px-4 rounded-full text-xs font-bold text-white bg-gradient-to-r from-indigo-600 to-purple-600 shadow-lg shadow-indigo-500/20 transition-all text-center cursor-pointer">
                        Supplier Management
                    </button>
                </a>
                <a href="/bulugagao" class="w-full">
                    <button class="w-full py-3 px-4 rounded-full text-xs font-bold text-indigo-400 bg-slate-900 hover:bg-slate-800/80 border border-slate-800 transition-all text-center cursor-pointer">
                        Purchase Order
                    </button>
                </a>
                <a href="/malacaste" class="w-full">
                    <button class="w-full py-3 px-4 rounded-full text-xs font-bold text-indigo-400 bg-slate-900 hover:bg-slate-800/80 border border-slate-800 transition-all text-center cursor-pointer">
                        Goods Receipt
                    </button>
                </a>
            </div>
        </div>
    </div>

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
                                <th class="p-4">Rating</th>
                                <th class="p-4">Status</th>
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
                                    <td class="p-4">
                                        <div class="flex items-center gap-1.5">
                                            <span class="text-amber-400 text-xs"><i class="fa-solid fa-star"></i></span>
                                            <span class="font-bold font-mono text-white">{{ number_format($supplier->rating, 1) }}</span>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <span class="px-2.5 py-1 rounded-full text-xs font-bold inline-flex items-center gap-1.5 {{ $supplier->status === 'Active' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-rose-500/10 text-rose-400 border border-rose-500/20' }}">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $supplier->status === 'Active' ? 'bg-emerald-400 animate-pulse' : 'bg-rose-400' }}"></span>
                                            {{ $supplier->status }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-12 text-center text-slate-500">
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
        <div class="bg-slate-900 border border-slate-800 rounded-xl w-full max-w-md p-6 shadow-2xl relative">
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
                    <input type="text" name="name" required placeholder="Acme Parts Ltd" class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2.5 mt-1 text-white focus:outline-none focus:border-indigo-500">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-indigo-400">Contact Person</label>
                    <input type="text" name="contact_person" required placeholder="John Doe" class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2.5 mt-1 text-white focus:outline-none focus:border-indigo-500">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-indigo-400">Email Address</label>
                    <input type="email" name="email" required placeholder="contact@acme.com" class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2.5 mt-1 text-white focus:outline-none focus:border-indigo-500">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-indigo-400">Phone Number</label>
                    <input type="text" name="phone" placeholder="+63" class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2.5 mt-1 text-white focus:outline-none focus:border-indigo-500">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-indigo-400">Rating</label>
                        <input type="number" step="0.1" min="1" max="5" name="rating" value="5.0" class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2.5 mt-1 text-white focus:outline-none focus:border-indigo-500 font-mono">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-indigo-400">Status</label>
                        <select name="status" class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2.5 mt-1 text-white focus:outline-none focus:border-indigo-500">
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