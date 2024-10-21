<?php

namespace App\Http\Controllers;

use App\Models\GroupTP;
use Illuminate\Http\Request;

class GroupTPController extends Controller
{
    public function index()
    {
        $tp_groups = GroupTP::orderBy('tp_name')->get();

        return view('tp_group.index', ['tp_groups' => $tp_groups]);
    }

    public function create(GroupTP $tp_group)
    {
        return view('tp_group.create', ['tp_group' => $tp_group]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tp_name' => 'required|string'
        ]);
        $tp_group = new GroupTP();
        $tp_group->fill($data);
        $tp_group->save();

        return redirect()->route('tp_group.index')->with('status', 'Groupe de TP créer.');

    }
    public function edit(GroupTP $tp_group)
    {
        return view('tp_group.edit', ['tp_group' => $tp_group]);
    }

    public function update(Request $request,GroupTP $tp_group)
    {
        $request->validate([
            'tp_name' => 'required|string'
        ]);

        $tp_group->tp_name = $request->tp_name;
        $tp_group->save();

        return redirect()->route('tp_group.index')->with('status', 'Groupe de TP mis à jour.');
    }

    public function destroy(GroupTP $tp_group)
    {
        $tp_group->delete();
        return redirect()->route('tp_group.index')->with('status', 'Groupe de TP supprimer.');
    }
}
