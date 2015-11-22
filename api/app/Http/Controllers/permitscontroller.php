<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class permitscontroller extends Controller
{
    private function filterPermits($key, $value)
    {
        $json = file_get_contents(getenv('JSON_PERMITS_DATA'));
        $permits = json_decode($json, true);

        $permitsFiltered = array();
        foreach ($permits as &$item) {
            if( mb_strtolower($item[$key]) === mb_strtolower($value) )
            {
                array_push($permitsFiltered, $item);
            }
        }
        unset($item); // break the reference with the last element

        return $permitsFiltered;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        $json_output = $this->filterPermits('Номер', $id);
        return response()->json( $json_output, 200, array(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
    }

    public function filterByPlace($place)
    {
        $json_output = $this->filterPermits('Землище', $place);
        return response()->json( $json_output, 200, array(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
    }

    public function filterByMunicipality($municipality)
    {
        $json_output = $this->filterPermits('Община', $municipality);
        return response()->json( $json_output, 200, array(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
    }

    public function filterByProvince($province)
    {
        $json_output = $this->filterPermits('Област', $province);
        return response()->json( $json_output, 200, array(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
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
        //
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
