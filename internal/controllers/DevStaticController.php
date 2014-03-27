<?php

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DevStaticController {
	public function getDevFile (Request $request, Application $app, $lang, $fileName) {
		global $rfExampleConfig;
		if(!isset($rfExampleConfig['devStaticPaths'][$lang])) {
			$app->abort(404, "Cannot find language files");
		}
		$filePath = $rfExampleConfig['devStaticPaths'][$lang].$fileName;
		if(!file_exists($filePath)) {
			$app->abort(404, "Cannot find file");
		}
		$arr = explode(".", $fileName);
		$extension = array_pop($arr);
		$mime = "text/plain";

		if($extension === "css") {
			$mime = "text/css";
		}
		else if ($extension === "js") {
			$mime = "application/javascript";
		}
		else if ($extension === "html") {
			$mime = "text/html";
		}


		return $app->sendFile($filePath, 200, array('Content-Type' => $mime));
	}

	public function devDocs(Request $request, Application $app, $fileName) {
		return $this->getDevFile($request, $app, 'docs', $fileName);
	}
}