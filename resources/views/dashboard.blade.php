<x-app-layout>
    <div class="bg-[#f6f7f8] py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <main class="w-full space-y-10">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-800 border border-red-200">
                            {{ $error }}
                        </div>
                        
                    @endforeach
                    
                @endif
                {{-- Bagian Atas: Salam & Tombol Aksi --}}
                <section class="flex flex-col sm:flex-row justify-between items-start gap-4">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900">Hello, {{ Auth::user()->name }}</h2>
                        <p class="text-gray-600 mt-1">Here's your financial overview for today.</p>
                    </div>
                    <button type="button" onclick="showExpenseModal()" class="flex items-center justify-center gap-2 px-5 py-3 bg-blue-600 text-white font-bold rounded-lg shadow-lg hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg fill="currentColor" height="20" viewBox="0 0 256 256" width="20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M224,128a8,8,0,0,1-8,8H136v80a8,8,0,0,1-16,0V136H40a8,8,0,0,1,0-16h80V40a8,8,0,0,1,16,0v80h80A8,8,0,0,1,224,128Z"></path>
                        </svg>
                        <span>Add New Expense</span>
                    </button>
                </section>

                {{-- Summary Card --}}
                <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Expenses</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1">Rp {{ isset($totalExpenses) ? number_format($totalExpenses, 0, ',', '.') : '0' }}</p>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Top Category</p>
                            @if($topCategory)
                            <div class="flex items-center justify-between mt-1">
                                <p class="text-xl font-bold text-gray-900">{{ $topCategory['category_name'] ?? 'N/A' }}</p>
                                <span class="text-3xl">{{ $topCategory['category_icon'] ?? '' }}</span>
                            </div>
                            @else
                                <p class="text-xl font-bold text-gray-900 mt-1">N/A</p>
                            @endif
                        </div>
                    </div>
                </section>

                {{-- Last Transaction --}}
                <section>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Recent Transactions</h3>
                    <div class="space-y-2">
                        @forelse ($expenses ?? [] as $expense)
                        <div class="flex items-center p-4 rounded-lg bg-white hover:bg-blue-50 transition-colors border border-gray-100">
                            <div class="flex items-center gap-4 flex-grow">
                                <div class="flex items-center justify-center size-12 rounded-full bg-blue-100 text-blue-600">
                                    <span class="text-2xl">{{ $expense->category->icon ?? '💸' }}</span>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $expense->description }}</p>
                                    <p class="text-sm text-gray-600">{{ $expense->category->name ?? 'Uncategorized' }} • {{ \Carbon\Carbon::parse($expense->date)->format('d M Y') }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <p class="font-medium text-gray-900">-Rp {{ number_format($expense->amount, 0, ',', '.') }}</p>
                                
                                {{-- Edit Button --}}
                                <button onclick="showEditModal({{ $expense }})" class="text-gray-400 hover:text-blue-500" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                
                                {{-- Delete Button --}}
                                <button onclick="deleteExpense({{ $expense->id }})" 
                                class="p-2 text-red-600 hover:bg-red-100 rounded-lg transition-colors" 
                                title="Delete">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-10 text-gray-600 bg-white rounded-lg border border-gray-200">
                            <p>No transactions yet. Click 'Add New Expense' to get started!</p>
                        </div>
                        @endforelse
                    </div>
                </section>

                {{-- Rincian Kategori --}}
                <section>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Category Breakdown</h3>
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
                        <div class="flex justify-between items-center mb-6">
                            <p class="font-medium text-gray-900">Expenses by Category</p>
                            <div class="flex items-center gap-2 text-sm text-gray-500 cursor-pointer">
                                <span>This Month</span>
                                <svg class="size-4" fill="currentColor" viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg"><path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,48,88H208a8,8,0,0,1,5.66,13.66Z"></path></svg>
                            </div>
                        </div>

                        @if(isset($categoryBreakdown) && $categoryBreakdown->count() > 0)
                            @php
                                $totalExpenses = $categoryBreakdown->sum('total');
                                $colors = [
                                    '#3B82F6', '#10B981', '#F97316', '#8B5CF6', '#EC4899', '#F59E0B', '#6366F1'
                                ];
                            @endphp
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                                {{-- Donut Chart Canvas --}}
                                <div class="relative mx-auto" style="max-width: 250px; max-height: 250px;">
                                    <canvas id="categoryDonutChart"
                                            data-chart-data="{{ json_encode($categoryBreakdown->pluck('total')) }}"
                                            data-chart-labels="{{ json_encode($categoryBreakdown->pluck('category_name')) }}">
                                    </canvas>
                                    <div class="absolute inset-0 flex flex-col items-center justify-center text-center pointer-events-none">
                                        <span class="text-sm text-gray-500">Total Expenses</span>
                                        <span class="text-2xl font-bold text-gray-800">Rp {{ number_format($totalExpenses, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                                
                                <div class="flex flex-col gap-4">
                                    @foreach($categoryBreakdown as $index => $item)
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <span class="block size-3 rounded-full" style="background-color: {{ $colors[$index % count($colors)] }};"></span>
                                                <span class="text-gray-600">{{ $item['category_name'] }}</span>
                                            </div>
                                            <div class="text-right">
                                                <p class="font-semibold text-gray-800">Rp {{ number_format($item['total'], 0, ',', '.') }}</p>
                                                <p class="text-sm text-gray-400">{{ $totalExpenses > 0 ? number_format(($item['total'] / $totalExpenses) * 100, 1) : '0.0' }}%</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="w-full text-center text-gray-500 py-16">No expense data for this period.</div>
                        @endif
                    </div>
                </section>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    {{-- Edit Expense Modal Component --}}
    @include('components.edit-form')

    {{-- Expense Modal Component (Add New) --}}
    <x-form-expenses />
</x-app-layout>