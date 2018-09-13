<?php

namespace App\Http\Controllers\Admin;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ColorController extends Controller
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
        $list = Color::where($map)->get();

        $where[] = ['status', '!=', -1];
        $tempData = [
            [
                'id' => 0,
                'pid' => -1,
                'text' => "颜色管理集合",
                'name' => "颜色管理集合",
                'href' => '',//编辑地址
                'open' => true,
                'icon' => asset('admin/js/plugins/zTree/css/zTreeStyle2/img/diy/global.gif')
            ]
        ];
        if ($list) {
            foreach ($list as $key => $val) {
                if ($val['code']) {
                    $val['name'] .= '(' . $val['code'] . ')';
                }
                if ($val['status']==0) {
                    $val['name'] .= '(已禁用)';
                }
//                $val['url'] = url('admin/category/'.$val['id'].'/edit');
                $val['icon'] = asset('admin/js/plugins/zTree/css/zTreeStyle2/img/diy/sub.gif');
                $val['target'] = "_self";
                $tempData[] = $val;
            }
        }


        return view('admin.color.index',compact("tempData","list"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.color.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $color = new Color();
        $color->name = $request->name;
        $color->pid = $request->pid;
        $color->status = $request->status;
        if($request->pid){
            $color->path = Color::where('id',$request->pid)->find("path").$request->pid.',';
        }else{
            $color->path = '0,';
        }

        if($color->save()){
            $message = [
                'code' => config('program.status.right'),
                'message' => '颜色信息添加成功'
            ];
        }else{
            $message = [
                'code' => config('program.status.errors'),
                'message' => '颜色信息添加失败，请稍后重试'
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
        $info = Color::find($id);
        return view("admin.color.edit",compact("info"));
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
        $validator = Validator::make($request->all(), [
            'name' => Rule::unique('regions')->ignore($id)
        ],[
            'name.unique'=>'颜色名称已存在'
        ]);

        if ($validator->fails()) {
            $errors = '';
            foreach ($validator->getMessageBag()->getMessages() as $v){
                foreach ($v as $value){
                    $errors .= $value.',';
                }
            }
            $errors = trim($errors,",");
            $message = [
                'code' => 0,
                'message' => $errors
            ];
            return response()->json($message);
        }

        $arr = [
            'name' => $request->name,
            'code' => $request->code,
            'pid' => $request->pid
        ];

        if($request->pid){
            $arr['path'] = Color::where("id",$request->pid)->value("path").$request->pid.',';
        }else{
            $arr['path'] = '0,';
        }

        $info = Color::where('id',$id)->update($arr);

        if($info){
            $message = [
                'code' => config('program.status.right'),
                'message' => '颜色信息修改成功'
            ];
        }else{
            $message = [
                'code' => config('program.status.errors'),
                'message' => '颜色信息修改失败，请稍后重试'
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
        $message = [];
        $info = Color::where('pid',$id)->first();
        if($info){
            $message = [
                'code' => 0,
                'message' => '此类别下面还有子类，不能删除'
            ];
        }else{
            $info1 = Color::where('id',$id)->update(['status'=>-1]);
            if($info1){
                $message = [
                    'code' => 1,
                    'message' => '颜色信息删除成功'
                ];
            }
        }

        return response()->json($message);
    }
}
