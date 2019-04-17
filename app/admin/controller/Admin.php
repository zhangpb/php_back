<?php
namespace app\admin\controller;

use think\Db;
use app\admin\model\User;
class Admin extends \think\Controller
{
    public function index()
    {
        return $this->fetch();
    }

    //user列表
    public function user()
    {
        $user = new User();
        $request = array_merge(request()->post(),request()->get());
        $where = $request;
        $page = isset($request['page']) ? $request['page'] : 1;
        $where['status'] = 1;
        $user_list = $user->get_list($where,$page);
        $this->assign([
            'add_user_url' => $this->request->host.'/admin.php/admin/admin/adduser',
            'update_user_url' => $this->request->host.'/admin.php/admin/admin/updateuserhtml',
            'user_list' => $user_list,
            'users' => $user_list['data'],
            'search' => $request
        ]);
        return $this->fetch('user-list');
    }

    //添加user
    public function addUser()
    {
        if (request()->post()) {
            $insert = request()->post();
            $insert['address'] = $insert['province'].' '.$insert['city'].' '.$insert['area'];
            $insert['address'] .= !empty($insert['detail']) ? ' '.$insert['detail'] : '';
            $user = new User();
            $res = $user->addUser($insert);
            return json($res);
        } else {
            return $this->fetch('user-add');
        }
    }

    //修改user
    public function updateUser()
    {
        $request = get_request();
        if (empty($request)) {
            return json(return_value(-1,'没有传入更新数据'));
        }
        if (!isset($request['id']) || empty($request['id'])) {
           return json(return_value(-1,'id不存在'));
        }
        $user = new User();
        return json($user->update_item($request,array('id'=>input('post.id'))));
    }

    //编辑
    public function updateUserHtml($id)
    {
        if (empty($id)) {
            return json(return_value(-1,'缺少参数id'));
        }
        $mdl_user = new User();
        $user = $mdl_user->get_item(array('id'=>$id));
        $this->assign(array(
            'user' => $user
        ));
        return $this->fetch('user-edit');
    }

    //多条删除
    public function delAll()
    {
        $req = get_request();
        if (!isset($req['id']) || empty($req['id'])) {
            return json(return_value(-1,'缺少参数id'));
        }
        $user = new User();
        return json($user->update_item(array('status'=>0),array('id'=>input('post.id'))));
    }

}
