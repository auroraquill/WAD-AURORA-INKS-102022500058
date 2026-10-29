<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController
{
    public function index()
    {
        $pegawai = Staff::orderBy('id')->get();
        return view('staff.index', compact('pegawai'));
    }

    public function create()
    {
        return view('staff');
    }

    public function store(Request $request)
    {
        Staff::create($this->validated($request));
        return redirect()->route('staff.index')->with('success', 'Pegawai berhasil ditambahkan.');
    }

    public function edit(Staff $staff)
    {
        return view('staff.edit', compact('staff'));
    }

    public function update(Request $request, Staff $staff)
    {
        $staff->update($this->validated($request));
        return redirect()->route('staff.index')->with('success', 'Data pegawai berhasil diubah.');
    }

    public function destroy(Staff $staff)
    {
        $staff->delete();
        return redirect()->route('staff.index')->with('success', 'Pegawai berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'nama'    => 'required|string|max:100',
            'jabatan' => 'required|in:Chef,Waiter,Kasir',
            'kontak'  => 'required|string|max:20',
        ]);
    }
}