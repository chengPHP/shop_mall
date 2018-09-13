<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attr;
use App\Models\Good;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $map = [
            ['status', '>=', 0]
        ];
        if($request->search){
            $search = $request->search;
            $map[] = ['name','like','%'.$search.'%'];
        }else{
            $search = null;
        }
        $list = Good::where($map)->with('attr','brand','category')->paginate(5);
        return view('admin.good.index',compact('list','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.good.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $good = new Good();
        $good->name = $request->name;
        $good->category_id = $request->category_id;
        $good->sn = $request->sn;
        $good->brand_id = $request->brand_id;
        $good->keywords = $request->keywords;
        $good->brief = $request->brief;
        $good->weight = $request->weight;
        $good->give_integral = $request->give_integral;
        $good->storage_time = $request->storage_time;
        $good->is_real = $request->is_real;
        $good->is_best = $request->is_best;
        $good->is_new = $request->is_new;
        $good->is_hot = $request->is_hot;

//        $good->details = $request->editorValue;
//        $good->spec = $request->editorValue;
//        $good->pack = $request->editorValue;


        if($good->save()) {
            $attr_id_arr = [];
            if(count($request->model_number)>0){
                foreach ($request->model_number as $k => $v) {
                    $arr = [
                        'model_number' => $v,
                        'color_id' => $request->color_id[$k],
                        'price' => $request->price[$k],
                        'promote_price' => $request->promote_price[$k],
                        'stock' => $request->stock[$k],
                        'status' => $request->status[$k],
                    ];
                    $attr_id_arr[] = Attr::insertGetId($arr);
                }
                $good->attr()->sync($attr_id_arr);
                $message = [
                    'code' => 1,
                    'message' => '商品添加成功'
                ];
            }else{
                $message = [
                    'code' => 1,
                    'message' => '商品添加成功'
                ];
            }

        }else{
            $message = [
                'code' => 0,
                'message' => '商品添加失败，请稍后重试'
            ];
        }
        return response()->json($message);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $info = Good::where('id',$id)->with('attr','brand','category')->first();
        return view('admin.good.show',compact('info'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = Good::where('id',$id)->with('attr','brand','category')->first();
        return view('admin.good.edit',compact('info'));
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
        $arr = [
            'name' => $request->name,
            'category_id' => $request->category_id,
            'sn' => $request->sn,
            'brand_id' => $request->brand_id,
            'keywords' => $request->keywords,
            'brief' => $request->brief,
            'weight' => $request->weight,
            'give_integral' => $request->give_integral,
            'storage_time' => $request->storage_time,
            'is_real' => $request->is_real,
            'is_best' => $request->is_best,
            'is_new' => $request->is_new,
            'is_hot' => $request->is_hot
        ];

        if(Good::where('id',$id)->update($arr)){
            $attr_id_arr = [];
            if(count($request->model_number)>0){
                $good = Good::find($id);
                foreach ($request->model_number as $k => $v) {
                    $arr = [
                        'model_number' => $v,
                        'color_id' => $request->color_id[$k],
                        'price' => $request->price[$k],
                        'promote_price' => $request->promote_price[$k],
                        'stock' => $request->stock[$k],
                        'status' => $request->status[$k],
                    ];
                    $attr_id_arr[] = Attr::insertGetId($arr);
                }
                $good->attr()->sync($attr_id_arr);
                $message = [
                    'code' => 1,
                    'message' => '商品添加成功'
                ];
            }else{
                $message = [
                    'code' => 1,
                    'message' => '商品添加成功'
                ];
            }
        }else{
            $message = [
                'code' => 0,
                'message' => '商品信息修改失败，请稍后重试'
            ];
        }
        return response()->json($message);
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
