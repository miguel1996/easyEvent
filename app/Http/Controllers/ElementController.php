<?php

namespace App\Http\Controllers;

use App\Element;
use App\Event;
use Illuminate\Http\Request;
use App\SubElement;

class ElementController extends Controller
{
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
    public function create(Request $request)
    {
        $boolAllElementsSaved = true;
        $elements = array();
        $numOfElements = $request->numOfElements;
        for ($i = 1;$i<=$numOfElements;$i++) {
            if ($request->has('label'.$i, 'enumSelect'.$i)) {//this is to verify if an element exists in the request
                //if an equal event already exists in the database we dont need to create another one
                if(!$element = Element::where('label','=',$request->input('label'.$i))->where('type','=',$request->input('enumSelect'.$i))->first())
                // dd("ainda nao existe ".$request->input('label'.$i)." do tipo ".$request->input('enumSelect'.$i));
                {
                    $element = new Element;
                    // switch case to check if the element is one that may have subElements (ex: radio button)
                    switch ($request->input('enumSelect'.$i)) {
                        case 'radio':
                            $splited = explode(",", $request->input('label'.$i));
                            $first = array_shift($splited);
                            $element->label = $first;
                            break;
                        default:
                            $element->label = $request->input('label'.$i);
                            break;
                    }              
                    $element->type = $request->input('enumSelect'.$i);
                    if (!$element->save()) {   //realiza o insert e caso exista algum erro ao inserir a funcção devolve false
                        $boolAllElementsSaved = false;
                    } else {
                        array_push($elements, $element->id);
                    }
                }
                else{
                    array_push($elements, $element->id);
                    // dd("ja existe ".$request->input('label'.$i)." do tipo ".$request->input('enumSelect'.$i));
                }                        
                    // after the main element is inserted we must insert the sub elements, if they exist
                    switch ($request->input('enumSelect'.$i)) {
                        case 'radio':
                            foreach($splited as $sub){
                                $sub_element = new SubElement;
                                $sub_element->name = $sub;
                                $sub_element->element_id = $element->id;
                                $sub_element->save();
                            }
                            break;
                        
                        default:
                            //default
                            break;
                    } 
                }
            }
        return array($boolAllElementsSaved,$elements);
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

    /**
     * Remove all resources from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyAll($event_id)
    {
        $event = Event::find($event_id);
        // dd(count($event->elements()->get()));
        if(count($event->elements()->get()) != 0){
            if($event->elements()->detach())return true;
            else return false;
        }
        return true;
        
    }
}
