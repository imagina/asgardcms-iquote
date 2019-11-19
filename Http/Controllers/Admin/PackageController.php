<?php

namespace Modules\Iquote\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Iquote\Entities\Package;
use Modules\Iquote\Http\Requests\CreatePackageRequest;
use Modules\Iquote\Http\Requests\UpdatePackageRequest;
use Modules\Iquote\Repositories\PackageRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class PackageController extends AdminBaseController
{
    /**
     * @var PackageRepository
     */
    private $package;

    public function __construct(PackageRepository $package)
    {
        parent::__construct();

        $this->package = $package;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$packages = $this->package->all();

        return view('iquote::admin.packages.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('iquote::admin.packages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreatePackageRequest $request
     * @return Response
     */
    public function store(CreatePackageRequest $request)
    {
        $this->package->create($request->all());

        return redirect()->route('admin.iquote.package.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('iquote::packages.title.packages')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Package $package
     * @return Response
     */
    public function edit(Package $package)
    {
        return view('iquote::admin.packages.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Package $package
     * @param  UpdatePackageRequest $request
     * @return Response
     */
    public function update(Package $package, UpdatePackageRequest $request)
    {
        $this->package->update($package, $request->all());

        return redirect()->route('admin.iquote.package.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('iquote::packages.title.packages')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Package $package
     * @return Response
     */
    public function destroy(Package $package)
    {
        $this->package->destroy($package);

        return redirect()->route('admin.iquote.package.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('iquote::packages.title.packages')]));
    }
}
