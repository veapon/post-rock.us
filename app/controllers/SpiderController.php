<?php
class SpiderController extends BaseController {

	public function get($module, $id)
	{
		//$res['id'] = $id;
		//$res['module'] = $module;
		
		$api = new \veapon\NeteaseMusic;
		$data = $api->album($id);
		
		$res['status'] = 1;
		if (isset($data['status']) && $data['status'] == 0) {
			$res['status'] = 0;
		}

		$res['data'] = $data;

		return Response::json($res);
	}

}
