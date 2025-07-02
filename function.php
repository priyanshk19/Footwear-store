<?php
function pr($arr){
	echo '<pre>';
	print_r($arr);
}

function prx($arr){
	echo '<pre>';
	print_r($arr);
	die();
}

function get_safe_value($con,$str){
	if($str!=''){
		$str=trim($str);
		return mysqli_real_escape_string($con,$str);
	}
}

function get_sub_cat($con,$cat_id='')
{
	$sql="select * from sub_cat";
	if($cat_id!='')
	{
		$sql.=" category_id=$cat_id";
	}
	$res=mysqli_query($con,"$sql");
	$data=array();
	while($row=mysqli_fetch_assoc($res))
	{
		$data[]=$row;
	}
	return $data;
}
function get_brand($con)
{

    $sql="select * from brand";
    
    $res=mysqli_query($con,$sql);
    $data=array();
    while($row=mysqli_fetch_assoc($res))
    {
        $data[]=$row;
    }

   
    return $data;
}

function get_product($con,$limit='',$sub_cat_id='')
{
	
	$sql="select * from product";
	if($sub_cat_id!='')
	{
		$sql.=" and category_id=$sub_cat_id ";
	}
	if($limit!='')
	{
		$sql.=" limit $limit";
	}

	$res=mysqli_query($con,$sql);
	$data=array();

	while($row=mysqli_fetch_assoc($res))
	{
		$data[]=$row;
	}
	return $data;
}

?>