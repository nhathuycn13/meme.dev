<?php

namespace App\Http\Controllers\Api;

use App\Repository\Customer\CustomerRepo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    private $customer;

    public function __construct(CustomerRepo $repo)
    {
        $this->customer = $repo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->customer->paginate(request('perpage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            '.' => '',
            '.' => '',
            '.' => '',
            '.' => '',
            '.' => '',
            '.' => '',
        ];
        $this->validate($request, [

        ], $messages);
        return $this->customer->create($request->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->customer->get($id);
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
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'data.name' => 'required',
            'data.tax_id' => 'digits:10',
            'data.email' => 'email',
            'data.phone' => 'numeric',
            'data.mobile' => 'numeric',
        ]);
        return $this->customer->update($id, $request->data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->customer->delete($id);
    }
}
