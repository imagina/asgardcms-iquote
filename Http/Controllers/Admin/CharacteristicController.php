<?php

namespace Modules\Iquote\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Iquote\Entities\Characteristic;
use Modules\Iquote\Http\Requests\CreateCharacteristicRequest;
use Modules\Iquote\Http\Requests\UpdateCharacteristicRequest;
use Modules\Iquote\Repositories\CharacteristicRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class CharacteristicController extends AdminBaseController
{
    /**
     * @var CharacteristicRepository
     */
    private $characteristic;

    public function __construct(CharacteristicRepository $characteristic)
    {
        parent::__construct();

        $this->characteristic = $characteristic;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$characteristics = $this->characteristic->all();

        return view('iquote::admin.characteristics.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('iquote::admin.characteristics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCharacteristicRequest $request
     * @return Response
     */
    public function store(CreateCharacteristicRequest $request)
    {
        $this->characteristic->create($request->all());

        return redirect()->route('admin.iquote.characteristic.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('iquote::characteristics.title.characteristics')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Characteristic $characteristic
     * @return Response
     */
    public function edit(Characteristic $characteristic)
    {
        return view('iquote::admin.characteristics.edit', compact('characteristic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Characteristic $characteristic
     * @param  UpdateCharacteristicRequest $request
     * @return Response
     */
    public function update(Characteristic $characteristic, UpdateCharacteristicRequest $request)
    {
        $this->characteristic->update($characteristic, $request->all());

        return redirect()->route('admin.iquote.characteristic.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('iquote::characteristics.title.characteristics')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Characteristic $characteristic
     * @return Response
     */
    public function destroy(Characteristic $characteristic)
    {
        $this->characteristic->destroy($characteristic);

        return redirect()->route('admin.iquote.characteristic.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('iquote::characteristics.title.characteristics')]));
    }
}
