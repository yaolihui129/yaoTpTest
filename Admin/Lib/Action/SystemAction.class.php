<?php

class SystemAction extends CommonAction {

    public function index(){
        /* 接收参数*/
        $prodid=$_GET['prodid'];
        /* 实例化模型*/
        $p=M('product');
        /*查询数据 */
        $arr=$p->select();
        /*输出数据 */
        $this->assign('data',$arr);


        /* 实例化模型*/
    	 $m=M('system');
    	 /*查询数据 */
    	 $where=array(prodid=>$prodid);
    	 $syses=$m->where($where)->select();
    	 /*输出数据 */
	     $this->assign('syses',$syses);
	     $this->assign('w',$where);

	     $this->display();
    }



    public function add(){
        /* 接收参数*/
        $prodid=$_GET['prodid'];

        /* 实例化模型*/
        $m=M('system');
        /*查询数据 */
        $where=array(prodid=>$prodid);
        $syses=$m->where($where)->select();
        /*输出数据 */
        $this->assign('data',$syses);
        $this->assign('w',$where);



        $this->display();
    }

    public function insert(){
        /* 实例化模型*/
        $m=D('system');
        $_POST['adder']=$_SESSION['realname'];
        $_POST['moder']=$_SESSION['realname'];
        $_POST['updateTime']=date("Y-m-d H:i:s",time());
        if(!$m->create()){
            $this->error($m->getError());
        }
        $lastId=$m->add();
        if($lastId){
           $this->success("添加成功");
        }else{
            $this->error("添加失败");
        }

    }

    public function mod(){
        /* 接收参数*/
        $prodid=$_GET['prodid'];
        $id = !empty($_POST['id']) ? $_POST['id'] : $_GET['id'];

        /* 实例化模型*/
        $m=M('system');
        /*查询数据 */
        $where=array(prodid=>$prodid);
        $syses=$m->where($where)->select();
        /*输出数据 */
        $this->assign('data',$syses);
        $this->assign('w',$where);
        //dump($syses);



        /*查询数据 */
        $sys=$m->find($id);
        /*输出数据 */
        $this->assign('sys',$sys);

        $this->display();
    }

    public function update(){
        /* 实例化模型*/
        $db=D('system');

        $_POST['moder']=$_SESSION['realname'];
        $_POST['updateTime']=date("Y-m-d H:i:s",time());
        if ($db->save($_POST)){
            $this->success("修改成功！");
        }else{
            $this->error("修改失败！");
        }

    }

    public function test(){
        /* 接收参数*/
        $prodid=$_GET['prodid'];

        /* 实例化模型*/
        $m=M('system');
        /*查询数据 */
        $where=array(prodid=>$prodid);
        $syses=$m->where($where)->select();
        /*输出数据 */
        $this->assign('data',$syses);
        $this->assign('w',$where);



        $id = !empty($_POST['id']) ? $_POST['id'] : $_GET['id'];
        $sys=$m->find($id);
        /*输出数据 */
        $this->assign('sys',$sys);


        $this->display();
    }

    public function del(){
        /* 接收参数*/
        $id = !empty($_POST['id']) ? $_POST['id'] : $_GET['id'];
        /* 实例化模型*/
        $m=M('system');
        $count =$m->delete($id);
        if ($count>0) {
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }

}