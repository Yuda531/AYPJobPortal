<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employers;
use Illuminate\Http\Request;

class NetworkController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('id', '!=', auth()->id())
            ->with(['jobSeeker', 'employer']);

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhereHas('jobSeeker', function ($q) use ($search) {
                        $q->where('title', 'like', "%{$search}%");
                    })
                    ->orWhereHas('employer', function ($q) use ($search) {
                        $q->where('company_name', 'like', "%{$search}%")
                            ->orWhere('title', 'like', "%{$search}%");
                    });
            });
        }

        // Get paginated users
        $users = $query->paginate(6);

        // Get suggested users (random 5 users)
        $suggestedUsers = User::where('id', '!=', auth()->id())
            ->with(['jobSeeker', 'employer'])
            ->inRandomOrder()
            ->limit(5)
            ->get();

        // Get companies to follow
        $companies = Employers::with('user')
            ->inRandomOrder()
            ->limit(5)
            ->get();

        return view('network.index', compact('users', 'suggestedUsers', 'companies'));
    }
}
