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

/**
 * 友好输出
 * 
 * @param $var
 * @param $echo
 * @param $label
 * @param $strict
 * @return 
 * @since v1.0
 * @create 2013-08-28
 */
function dump($var, $echo=true, $label=null, $strict=true)
{
	$label = ($label === null) ? '' : rtrim($label) . ' ';
	if(!$strict)
	{
		if(ini_get('html_errors'))
		{
			$output = print_r($var, true);
			$output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
		}else{
			$output = $label . print_r($var, true);
		}
	}else{
		ob_start();
		var_dump($var);
		$output = ob_get_clean();
		$output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
		$output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
	}
	if($echo)
	{
		header('Content-type: text/html; charset=utf-8');
		echo($output);
		return null;
	}else{
		return $output;
	}
}
