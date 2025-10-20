@props(['categories'])
{{-- Edit Expense Modal --}}
    <div id="editExpenseModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative m-4">
            <button onclick="hideEditModal()" type="button" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
            <h2 class="text-xl font-bold mb-4 text-gray-800">Edit Expense</h2>
            
            <form id="editExpenseForm" method="POST" action="" class="space-y-4">   
                @csrf
                @method('PUT')

                <div>
                    <label for="edit_description" class="block text-sm font-medium text-gray-700">  Title</label>
                    <input type="text" name="title" id="edit_title" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label for="edit_description" class="block text-sm font-medium text-gray-700">Description</label>
                    <input type="text" name="description" id="edit_description" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                
                <div>
                    <label for="edit_amount" class="block text-sm font-medium text-gray-700">Amount</label>
                    <input type="number" name="amount" id="edit_amount" required min="0" step="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                
                <div>
                    <label for="edit_date" class="block text-sm font-medium text-gray-700">Date</label>
                    <input type="date" name="date" id="edit_date" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                
                <div>
                    <label for="edit_category_id" class="block text-sm font-medium text-gray-700">Category</label>
                    <select name="category_id" id="edit_category_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->icon }} {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="flex justify-end gap-2 pt-4">
                    <button type="button" onclick="hideEditModal()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Update Expense</button>
                </div>
            </form>
        </div>
    </div>