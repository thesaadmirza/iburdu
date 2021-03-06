<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Validator, Cache;
use App\Option;

class OptionController extends BaseController
{

    public function __construct()
    {
        $this->middleware('acl:system.manage');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options = Option::oldest('id')->get();
        return view('admin.options.index', compact('options'));
        dd($options);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.options.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'label' => 'required',
            'name' => 'required|alpha|unique:options',
            'value' => 'required',
            'type' => 'required|alpha',
        ]);
        if ($validation->fails()){
            return redirect()->back()->withErrors($validation);
        }
        Option::create($request->all());
        flash()->message('添加成功');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Cache::forget('system-options');
        $requests = $request->except(['_token', '_method']);
        $options = Option::latest()->get();
        foreach ($options as $option) {
            if($requests[$option->name] != $option->value){
                $option->value = htmlspecialchars($requests[$option->name]);
                $option->save();
            }
            $data[$option->name] = $option->value;
        }
        Cache::forever('system-options', $data);
        flash()->message('Successfully Modified');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
