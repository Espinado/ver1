<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admins\ShipDivision;
use App\Models\Admins\ShipDistrict;
use Illuminate\Support\Carbon;
use App\Models\Admins\ShipState;

class ShippingAreaController extends Controller
{

    public function divisionView()
    {
        $divisions = ShipDivision::orderBy('division_name', 'desc')->get();
        return view('admin.ship_division.index', compact('divisions'));
    }

    public function divisionStore(Request $request)
    {
        $request->validate(
            [
                'division_name'    => 'required',
            ],
            [
                'division_name.required'      => 'Incorrect division name',
            ]
        );
        //TODO: validation to request
        //TODo data to json
        $division = new ShipDivision();
        $division->division_name        = $request->division_name;
        $division->save();
        $notification = array('message' => 'Division recorded', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function divisionEdit($id)
    {
        $division = ShipDivision::findOrFail($id);
        return view('admin.ship_division.edit_division', compact('division'));
    }
    public function divisionUpdate(Request $request, $id)
    {

        ShipDivision::findOrFail($id)->update([
            'division_name' => $request->division_name,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Division Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('admin.manage.division')->with($notification);
    } // end mehtod

    public function divisionDelete($id)
    {

        ShipDivision::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Division Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }

    public function districtView()
    {
        $division = ShipDivision::orderBy('division_name', 'ASC')->get();
        $district = ShipDistrict::orderBy('id', 'DESC')->get();
        return view('admin.ship_districts.index', compact('division', 'district'));
    }
    public function districtStore(Request $request)
    {
        $request->validate(
            [
                'district_name'    => 'required',
                'division_id'    => 'required',
            ],
            [
                'district_name.required'      => 'Incorrect division name',
            ]
        );
        //TODO: validation to request
        //TODo data to json
        $district = new ShipDistrict();
        $district->district_name   = $request->district_name;
        $district->division_id   = $request->division_id;
        $district->save();
        $notification = array('message' => 'District recorded', 'alert-type' => 'success');
        return back()->with($notification);
    }
    public function districtEdit($id)
    {
        $district = ShipDistrict::findOrFail($id);
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        return view('admin.ship_districts.edit_district', compact('divisions', 'district'));
    }
    public function districtUpdate(Request $request, $id)
    {

// dd($request->all());
        ShipDistrict::findOrFail($id)->update([
            'district_name' => $request->district_name,
            'division_id' => $request->division_id,
            'updated_at' => Carbon::now(),
        ]);

        ShipState::where('division_id', $request->old_division_id)->update([
           'division_id' => $request->division_id,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'District Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('admin.manage.ship_district')->with($notification);
    } // end mehtod


    public function districtDelete($id)
    {

        ShipDistrict::findOrFail($id)->delete();
        $notification = array(
            'message' => 'District Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }

    public function stateView()
    {
        $division = ShipDivision::orderBy('division_name', 'ASC')->get();
        $district = ShipDistrict::orderBy('id', 'DESC')->get();
        $state = ShipState::orderBy('id', 'DESC')->get();
        return view('admin.ship_states.index', compact('division', 'district', 'state'));
    }

    public function stateStore(Request $request)
    {

        $request->validate(
            [
                'state_name'    => 'required',
                'division_id'    => 'required',
                'district_id'    => 'required',
            ],
            [
                'state_name.required'      => 'Incorrect state name',
            ]
        );
        //TODO: validation to request
        //TODo data to json
        $state = new ShipState();
        $state->state_name        = $request->state_name;
        $state->division_id        = $request->division_id;
        $state->district_id        = $request->district_id;
        $state->save();
        $notification = array('message' => 'State recorded', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function stateEdit($id) {
        $division = ShipDivision::orderBy('division_name', 'ASC')->get();
        $district = ShipDistrict::orderBy('district_name', 'ASC')->get();
        $state = ShipState::findOrFail($id);
        return view('admin.ship_states.edit_state', compact('division', 'district', 'state'));

    }

    public function stateUpdate(Request $request, $id)
    {
        ShipState::findOrFail($id)->update([
            'state_name' => $request->state_name,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'State Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('admin.manage.ship_state')->with($notification);
    } // end mehtod



    public function DistrictAjax($division_id)
    {
        $district = ShipDistrict::where('division_id', $division_id)->orderBy('district_name', 'ASC')->get();
        return json_encode($district);
    }
}
