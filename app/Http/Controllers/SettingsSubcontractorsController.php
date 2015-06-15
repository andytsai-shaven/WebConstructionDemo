<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SubcontractorsRepository;

class SettingsSubcontractorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(SubcontractorsRepository $subcontractorsRepository)
    {
        $subcontractors = $subcontractorsRepository->all();

        return view('settings/subcontractors/index', compact('subcontractors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('settings/subcontractors/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(SubcontractorsRepository $subcontractorsRepository, Request $request)
    {
        $inputs = $request->all();

        $subcontractorsRepository->create($inputs);

        return redirect('/settings/subcontractors');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($subcontractorId, SubcontractorsRepository $subcontractorsRepository)
    {
        $subcontractor = $subcontractorsRepository->find($subcontractorId);

        return view('settings/subcontractors/show', compact('subcontractor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($subcontractorId, SubcontractorsRepository $subcontractorsRepository)
    {
        $subcontractor = $subcontractorsRepository->find($subcontractorId);

        return view('settings/subcontractors/edit', compact('subcontractor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($subcontractorId, SubcontractorsRepository $subcontractorsRepository, Request $request)
    {
        $inputs = $request->all();

        $subcontractorsRepository->update($subcontractorId, $inputs);

        return redirect("/settings/subcontractors/$subcontractorId");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($subcontractorId, SubcontractorsRepository $subcontractorsRepository)
    {
        $subcontractorsRepository->destroy($subcontractorId);

        return redirect('/settings/subcontractors');
    }
}
