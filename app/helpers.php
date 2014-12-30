<?php
/**
 * 获取扩展名
 * 
 * @param string $file
 * @return string The given file's extension
 * @create 2013-10-03
 */
function getExt($file)
{
	$filter = explode(".",$file);
	return strtolower($filter[count($filter)-1]);
}
