<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\User;
use App\Models\Comment;
use MongoDB\BSON\ObjectID;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function showDashboard(){
        $today = Carbon::today();
        $date = new \MongoDB\BSON\UTCDateTime($today);
        $todayMedias = Media::where('created_at','>=',$date)->count();
        $todayComments = Comment::where('created_at','>=',$date)->count();
        $todayUsers = User::where('created_at','>=',$date)->where('is_verified', true)->count();

        return view('admin/dashboard', compact('todayMedias', 'todayComments', 'todayUsers'));
    }
}