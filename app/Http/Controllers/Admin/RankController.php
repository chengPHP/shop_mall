<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RankRequest;
use App\Models\Rank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RankController extends Controller
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
        $list = Rank::where($map)->paginate(5);
        return view('admin.rank.index',compact('list','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.rank.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RankRequest $request)
    {
        $rank = new Rank();
        $rank->name = $request->name;
        $rank->code = $request->code;
        $rank->min_points = $request->min_points;
        $rank->max_points = $request->max_points;
        $rank->discount = $request->discount;
        $rank->special_rank = $request->special_rank;
        $rank->status = $request->status;

        if($rank->save()){
            $message = [
                'code' => 1,
                'message' => '会员等级添加成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => '会员等级添加失败，请稍后重试'
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
        $info = Rank::find($id);
        return view("admin.rank.edit",compact('info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RankRequest $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'code' => Rule::unique('ranks')->ignore($id)
        ],[
            'code.unique'=>'该会员等级编号已存在',
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
            'min_points' => $request->min_points,
            'max_points' => $request->max_points,
            'discount' => $request->discount,
            'special_rank' => $request->special_rank,
            'status' => $request->status
        ];

        if(Rank::where('id',$id)->update($arr)){
            $message = [
                'code' => 1,
                'message' => '会员等级信息修改成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => '会员等级信息修改失败，请稍后重试'
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
            $info = Rank::where("id", $v)->update(['status' => -1]);
            if ($info) {
                continue;
            } else {
                $message = [
                    'code' => 0,
                    'message' => '会员等级信息删除失败，请稍后重试'
                ];
                return response()->json($message);
            }
        }
        $message = [
            'code' => 1,
            'message' => '会员等级信息删除成功'
        ];
        return response()->json($message);
    }
}
