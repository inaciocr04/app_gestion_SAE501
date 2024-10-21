<?php

namespace App\Http\Controllers;

use App\Models\GroupTD;
use Illuminate\Http\Request;

class GroupTDController extends Controller
{
    public function index()
    {
        $td_groups = GroupTD::orderBy('td_name', 'asc')->get();

        return view('td_group.index', ['td_groups' => $td_groups]);
    }
    public function create(GroupTD $td_group)
    {
        return view('td_group.create', ['td_group' => $td_group]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'td_name' => 'required|string'
        ]);
        $td_group = new GroupTD();
        $td_group->fill($data);
        $td_group->save();

        return redirect()->route('td_group.index')->with('status', 'Groupe de TD créer.');

    }
    public function edit(GroupTD $td_group)
    {
        return view('td_group.edit', ['td_group' => $td_group]);
    }

    public function update(Request $request,GroupTD $td_group)
    {
        $request->validate([
            'td_name' => 'required|string'
        ]);

        $td_group->td_name = $request->td_name;
        $td_group->save();

        return redirect()->route('td_group.index')->with('status', 'Groupe de TD mis à jour.');
    }

    public function destroy(GroupTD $td_group)
    {
        $td_group->delete();
        return redirect()->route('td_group.index')->with('status', 'Groupe de TD supprimer.');
    }
}
