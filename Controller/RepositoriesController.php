<?php
App::uses('AppController', 'Controller');
/**
 * Repositories Controller
 *
 */
class RepositoriesController extends AppController {

	public $layout = '';

	public function commit_select($project_id) {

		// query1: branch=master&beginningOfTime=true&selected=
		// query2: branch=master&beginningOfTime=false&selected=a04971d1dd5924b5d0bc71de2ab9d2e31f46ff9d

		$this->set("GitLog", $this->Repository->getLog($project_id, $this->request->query['branch']));
	}

	public function latest_revision($project_id) {

		// query: branch=master
		//$lastRevision = $this->Repository->getLog($project_id, 1);

		return $this->_jsonResponse(array('ref' => $this->Repository->latest_revision($project_id, $this->request->query['branch'])));
	}

	public function commit_info($project_id) {
		return $this->_jsonResponse($this->Repository->commit_info($project_id, $this->request->query['commit']));
	}

	/**
	 * 完成特殊的要求JSON格式的请求响应
	 *
	 * @param $jsonArray
	 *
	 */
	protected function _jsonResponse($jsonArray) {
		$this->response->type('json');
		$this->set('json_array', $jsonArray);
		$this->render('json_response', ''); // do not use any layout
	}
}
