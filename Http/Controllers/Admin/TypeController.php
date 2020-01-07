<?php

namespace Modules\Iquote\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Iquote\Entities\Type;
use Modules\Iquote\Http\Requests\CreateTypeRequest;
use Modules\Iquote\Http\Requests\UpdateTypeRequest;
use Modules\Iquote\Repositories\TypeRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class TypeController extends AdminBaseController
{
    /**
     * @var TypeRepository
     */
    private $type;

    public function __construct(TypeRepository $type)
    {
        parent::__construct();

        $this->type = $type;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$types = $this->type->all();

        return view('iquote::admin.types.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('iquote::admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateTypeRequest $request
     * @return Response
     */
    public function store(CreateTypeRequest $request)
    {
        $this->type->create($request->all());

        return redirect()->route('admin.iquote.type.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('iquote::types.title.types')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Type $type
     * @return Response
     */
    public function edit(Type $type)
    {
        return view('iquote::admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Type $type
     * @param  UpdateTypeRequest $request
     * @return Response
     */
    public function update(Type $type, UpdateTypeRequest $request)
    {
        $this->type->update($type, $request->all());

        return redirect()->route('admin.iquote.type.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('iquote::types.title.types')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Type $type
     * @return Response
     */
    public function destroy(Type $type)
    {
        $this->type->destroy($type);

        return redirect()->route('admin.iquote.type.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('iquote::types.title.types')]));
    }
}
