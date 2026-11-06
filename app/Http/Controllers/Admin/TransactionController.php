<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function index(Request $request): View
    {
        $query = Transaction::with(['member', 'package', 'creator']);

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        if ($request->filled('package_type')) {
            $type = $request->package_type;
            $query->whereHas('package', function ($q) use ($type) {
                $q->where('type', $type);
            });
        }

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('invoice_code', 'like', "%{$search}%")
                    ->orWhere('customer_name', 'like', "%{$search}%")
                    ->orWhere('customer_phone', 'like', "%{$search}%");
            });
        }

        // Hitung total pendapatan dari hasil filter
        $totalRevenue = (clone $query)->sum('amount');
        $totalCount = (clone $query)->count();

        $transactions = $query->latest('created_at')->paginate(20)->withQueryString();

        return view('admin.transactions.index', compact('transactions', 'totalRevenue', 'totalCount'));
    }
}
