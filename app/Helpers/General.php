<?php
    function get_cols_where_p($model=null,$columns=array(),
    $where=array(),$orderbyfield='id',$ordernytype='ASC',
    $paginationcounter=10){
        $data=$model::select($columns)->where($where)
    ->orderby($orderbyfield,$ordernytype)->paginate($paginationcounter);
    return $data;
    }
    function insert($model=null,$dataToinsert=array()){
        $flag=$model::create($dataToinsert);
        return  $flag;
    }
    function update($model=null,$dataToinsert=array(),$where=array()){
        $flag=$model::where($where)->update($dataToinsert);
        return  $flag;
    }
    function get_cols_where_row($model=null,$columns=array(),$where=array())
    {
        $datarow=$model::select($columns)->where($where)->first();
        return $datarow;
    }
    function delete($model=null,$where=array())
    {
        $flag=$model::where($where)->delete();
        return $flag;
    }

    function upload ($folderStoringPath,$image){
        $extension=strtolower($image->extension());
        $filename=time().rand(1,10000).".".$extension;
        $image->move("upload",$filename);
        return $filename;
    }

    function get_cols_where($model=null,$columns=array(),
    $where=array(),$orderbyfield='id',$ordernytype='ASC'){
        $data=$model::select($columns)->where($where)->orderby($orderbyfield,$ordernytype)->get();
        return $data;
    }