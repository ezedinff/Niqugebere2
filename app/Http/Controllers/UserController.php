<?php

namespace App\Http\Controllers;

use App\Demand;
use App\Supply;
use App\TransportationBid;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function admin(){
        return view('admin.profile');
    }
    public function cfc(){
        $supplies = Supply::where('company_id','<>',auth()->user()->company_id)->get();
        $demands = Demand::where('company_id','<>',auth()->user()->company_id)->get();
        return view('cfc.profile', compact(['supplies','demands']));
    }
    public function supplier(){
        return view('supplier.profile');
    }

    public function transporter(){
        $wins = TransportationBid::join('demand_aggrements','demand_aggrements.id','=','transportation_bids.demand_agreement_id')
                                ->join('demands','demands.id','=','demand_aggrements.demand_id')
                                ->join('companies','companies.id','=','demands.company_id')
                                ->join('addresses','addresses.company_id','=','companies.id')
                                ->join('woredas','woredas.id','=','addresses.woreda_id')
                                ->select(['companies.name','addresses.phone','transportation_bids.price','woredas.name as woreda'])
                                ->where(['transportation_bids.win'=>1])->get();
        return view('transporter.profile',compact('wins'));
    }
    public function egaa(){
        return view('EGAA.profile');
    }

    public function index(){}
    public function create(){}
    public function store(Request $request){}
    public function show(User $user){}
    public function edit(User $user){}
    public function update(Request $request, User $user){}
    public function destroy(User $user){}
}