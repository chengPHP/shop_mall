<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Good;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = Category::get();

        $where[] = ['status', '!=', -1];
        $tempData = [
            [
                'id' => 0,
                'pid' => -1,
                'text' => "商品类别集合",
                'name' => "商品类别集合",
                'href' => '',//编辑地址
                'open' => true,
                'icon' => asset('admin/js/plugins/zTree/css/zTreeStyle2/img/diy/global.gif')
            ]
        ];
        if ($list) {
            foreach ($list as $key => $val) {
                if ($val['name']) {
//                    $val['name'] .= '(' . $val['name'] . ')';
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


        return view('admin.category.index',compact("tempData","list"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.category.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->name;
        if($request->alias){
            $category->alias = $request->alias;
        }else{
            $pinyin = app('pinyin');
            $category->alias =  $pinyin->sentence($request->name);
        }
        $category->pid = $request->pid;
        $category->status = $request->status;
        if($request->pid){
            $category->path = Category::where()->find("path").$request->pid.',';
        }else{
            $category->path = '0,';
        }

        if($category->save()){
            $message = [
                'code' => config('program.status.right'),
                'message' => '商品类别添加成功'
            ];
        }else{
            $message = [
                'code' => config('program.status.errors'),
                'message' => '商品类别添加失败，请稍后重试'
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
        $info = Category::find($id);
        return view("admin.category.edit",compact("info"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => Rule::unique('categories')->ignore($id),
            'alias' => Rule::unique('categories')->ignore($id)
        ],[
            'name.unique'=>'类别名称已存在',
            'alias.unique'=>'类别别名已存在',
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

        $validator = Validator::make($request->all(), [
            'name' => Rule::unique('categories')->ignore($id)
        ],[
            'name.unique'=>'类别名称已存在',
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
            'pid' => $request->pid,
        ];

        if($request->alias){
            $arr['alias'] = $request->alias;
        }else{
            $pinyin = app('pinyin');
            $arr['alias'] =  $pinyin->sentence($request->name);
        }

        if($request->pid){
            $arr['path'] = Category::where("id",$request->pid)->value("path").$request->pid.',';
        }else{
            $arr['path'] = '0,';
        }

        $info = Category::where('id',$id)->update($arr);

        if($info){
            $message = [
                'code' => config('program.status.right'),
                'message' => '商品类别信息修改成功'
            ];
        }else{
            $message = [
                'code' => config('program.status.errors'),
                'message' => '商品类别信息修改失败，请稍后重试'
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
        $info = Category::where('pid',$id)->first();
        if($info){
            $message = [
                'code' => 0,
                'message' => '此类别下面还有子类别，不能删除'
            ];
        }else{
            if(Good::where('category_id',$id)->first()){
                $message = [
                    'code' => 0,
                    'message' => '此类别下面还有商品，不能删除'
                ];
            }else{
                $info1 = Category::where('id',$id)->update(['status'=>-1]);
                if($info1){
                    $message = [
                        'code' => 1,
                        'message' => '商品类别删除成功'
                    ];
                }
            }
        }

        return response()->json($message);
    }
}
