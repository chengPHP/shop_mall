<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $map = [
            ['status','>=',0]
        ];
        if($request->search){
            $search = $request->search;
            $map[] = [
                'name','like','%'.$search.'%'
            ];
        }else{
            $search = null;
        }
        $list = Brand::with('files')->where($map)->paginate(5);
        return view("admin.brand.index",compact('list','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->brand_desc = $request->brand_desc;
        $brand->site_url = $request->site_url;
        $brand->sort_order = $request->sort_order?$request->sort_order:0;
        $brand->is_show = 1;
        $brand->status = $request->status;

        if($brand->save()){
            $brand->files()->sync($request->file);
            $message = [
                'code' => 1,
                'message' => '品牌添加成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => '品牌添加失败，请稍后重试'
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
        $info = Brand::with('files')->find($id);
        return view('admin.brand.edit',compact('info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, $id)
    {
        $arr = [
            'name' => $request->name,
            'brand_desc' => $request->brand_desc,
            'site_url' => $request->site_url,
            'sort_order' => $request->sort_order?$request->sort_order:0,
            'is_show' => 1,
            'status' => $request->status,
        ];

        $brand = Brand::find(1);

        if(Brand::where('id',$id)->update($arr)){
            if($request->file){
                $info = $brand->files()->sync($request->file);
                if($info){
                    $message = [
                        'code' => 1,
                        'message' => '品牌信息修改成功'
                    ];
                }else{
                    $message = [
                        'code' => 0,
                        'message' => '品牌信息修改失败，请稍后重试'
                    ];
                }
            }else{
                $message = [
                    'code' => 1,
                    'message' => '品牌信息修改成功'
                ];
            }
        }else{
            $message = [
                'code' => 0,
                'message' => '品牌信息修改失败，请稍后重试'
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
        //把ids字符串拆分成数组
        $idArr = explode(",",$id);
        foreach ($idArr as $v) {
            $info = Brand::where("id", $v)->update(['status' => -1]);
            if ($info) {
                continue;
            } else {
                $message = [
                    'code' => 0,
                    'message' => '品牌信息删除失败，请稍后重试'
                ];
                return response()->json($message);
            }
        }
        $message = [
            'code' => 1,
            'message' => '品牌信息删除成功'
        ];
        return response()->json($message);
    }
}
