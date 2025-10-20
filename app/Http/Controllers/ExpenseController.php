<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $expenses = Expense::where('user_id', $user->id)->with('category')->latest()->get();
        $categories = Category::all();

        // Total expenses
        $totalExpenses = $expenses->sum('amount');

        // Category breakdown (group by category, sum amount)
        $categoryBreakdown = $expenses
            ->groupBy('category_id')
            ->map(function ($group) {
                return [
                    'category_id' => $group->first()->category_id,
                    'category_name' => $group->first()->category->name ?? 'Other',
                    'category_icon' => $group->first()->category->icon ?? '📦',
                    'total' => $group->sum('amount'),
                ];
            })->values();

        // Top category
        $topCategory = $categoryBreakdown->sortByDesc('total')->first() ?? null;

        return view('dashboard', [
            'expenses' => $expenses,
            'categories' => $categories,
            'totalExpenses' => $totalExpenses,
            'topCategory' => $topCategory,
            'categoryBreakdown' => $categoryBreakdown,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255', 
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
        ]);

        $validated['user_id'] = Auth::id();

        Expense::create($validated);

        return redirect()->route('dashboard')->with('success', 'Expense added successfully!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        

        if (Auth::id() !== $expense->user_id) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
        ]);

        $expense->update($validated);

        return redirect()->route('dashboard')->with('success', 'Expense updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        if (Auth::id() !== $expense->user_id) {
            abort(403);
        }

        $expense->delete();

        return redirect()->route('dashboard')->with('success', 'Expense deleted successfully!');
    }
}

