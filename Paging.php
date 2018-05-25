<?php

/**
 * @param $sum          总数
 * @param $Pages_num    每页显示数
 * @param $offset        偏移量
 * @param $Pagebreak     ...
 * @return array  返回一个二维数组 偏移量,字符页,字符(如果是当前页,就输出CSS样式)
 */
 

function arr_Paging($sum, $Pages_num, $offset, $Pagebreak=2)
{
     //...
    $arr=[];
    //求总页数
    $Page_count = ceil($sum / $Pages_num);
	//处理数据,排除可能性
    $$offset =empty($offset)||!isset($offset)||$offset>=0||$offset<$sum||!settype($offset,'int') ? 0:$offset;
	//通过偏移量 ，显示数 得到 页数
	$Pages=$offset/$Pages_num+1;
		settype($Pages,'int');
	 //如果要显示的页数小于总页数而且大于0,代表页数正常
    if ($Pages <= $Page_count && $Pages > 0) {
        //如果要显示的页数大于1就代表还有下一页
        if ($Pages > 1) {
            //  下一页 刚好是 -2
            $a = ($Pages - 2) * $Pages_num;
            $arr = [$a, '下一页',''];
        }
    //处理当前页 前面的
            $array=[];
        for ($i =1; $i<=$Pagebreak;$i++){
            $a=$Pages-$i;
            if($a<1||$a>$Page_count){
                break;
            }
            $b = ($a-1) * $Pages_num;
            $array[] = [$b,$a,''];
        }
            sort($array);
        if(!empty($arr)){
            array_unshift($array,$arr);
        }
        //当前页 长度为3 是当前页
            $a = ($Pages-1) * $Pages_num;
            $array[] = [$a,$Pages,'style="background-color: #6b828e"'];
        //处理当前页 后面的
        for ($i =1; $i<=$Pagebreak;$i++){
            $a=$Pages+$i;
            if($a<1||$a>$Page_count){
                break;
            }
            $b = ($a-1) * $Pages_num;
            $array[] = [$b,$a,''];
        }
        //如果要显示的页数小于总页就代表还有上一页
        if ($Pages < $Page_count) {
            $a = ($Pages ) * $Pages_num;
            $array[] = [$a, '上一页',''];
        }
    }
	
    return $array;
}

