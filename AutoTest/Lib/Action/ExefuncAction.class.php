<?php

class ExefuncAction extends CommonAction {
    public function index(){

        $stageid=$_GET['stageid'];
        $proid=$_GET['proid'];
        $id=$_GET['id'];
        $m=D('exescene');
        $where=array("stageid"=>$stageid,"tester"=>$_SESSION['realname'],"type"=>"Manual");
        $data=$m->where($where)->order("sn")->select();
        $this->assign('data',$data);
        

    	 $m=M('exefunc');
    	 $where=array("testsceneid"=>$id);
    	 $exe=$m->where($where)->select();
    	 $this->assign('exe',$exe);
    	 $where=array("stageid"=>$stageid,"testsceneid"=>$id,"proid"=>$proid);
    	 $this->assign('w',$where);
    	 
	     $this->display();
    }
    
    
    public function test(){
        
        $stageid=$_GET['stageid'];
        $proid=$_GET['proid'];
        $id=$_GET['id'];
        $m=D('exescene');
        $where=array("stageid"=>$stageid,"tester"=>$_SESSION['realname'],"type"=>"Auto");
        $data=$m->where($where)->order("sn")->select();
        $this->assign('data',$data);
        
        
        $m=M('exefunc');
        $where=array("testsceneid"=>$id);
        $exe=$m->where($where)->select();
        $this->assign('exe',$exe);
        $where=array("stageid"=>$stageid,"testsceneid"=>$id,"proid"=>$proid);
        $this->assign('w',$where);
    
        $this->display();
    }



    public function update(){

        $db=D('exefunc');
        $_POST['moder']=$_SESSION['realname'];
        $_POST['updateTime']=date("Y-m-d H:i:s",time());
        if ($db->save($_POST)){
            $this->success("修改成功！");
        }else{
            $this->error("修改失败！");
        }

    }


}