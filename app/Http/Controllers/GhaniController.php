<?php

namespace Bulkly\Http\Controllers;

use Bulkly\BufferPosting;
use Bulkly\SocialPostGroups;
use Illuminate\Http\Request;

class GhaniController extends Controller
{
    public function index(Request $request)
    {
        $postings = BufferPosting::query()
            ->with('groupInfo', 'accountInfo')
            ->orderBy('id', 'desc');
        if($request->get('search')){
            $postings->where('post_text', 'LIKE', '%'.$request->get('search').'%');
        }
        if($request->get('date')){
            $date = str_replace('/', '-', $request->get('date'));
//            dd($date);
            $y = substr($date, -4, 4);
            $d = substr($date, -7, 2);
            $m = substr($date, 0, 2);
            $date = $y.'-'.$m.'-'.$d;
//            dd($date);
            $postings->whereDate('created_at', $date);
        }
        if($request->get('group_type') && $request->get('group_type')!='*'){
            $postings->whereHas('groupInfo', function($q) use ($request){
                $q->where('id', $request->get('group_type'));
            });
        }
        $groups = SocialPostGroups::orderBy('name');
        return view('history', ['postings' => $postings->paginate(), 'groups' => $groups->get()]);
    }
}
