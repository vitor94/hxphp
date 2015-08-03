<?php

namespace HXPHP\System\Configs;

class Config
{
	public $global;
	public $defineEnvironment;
	public $currentEnviroment;

	public function __construct()
	{
		$this->global = new GlobalConfig;
		$this->defineEnvironment = new DefineEnvironment;
		$this->currentEnviroment = $this->defineEnvironment->environment;
	}

	public function addEnv($environment)
	{
		$this->defineEnvironment->setEnv($environment);
	}

	public function __get($param) {
		$current = $this->currentEnviroment;

		if (isset($this->defineEnvironment->$current->$param)) {
			return $this->defineEnvironment->$current->$param;
		}
		else if(isset($this->global->$param)) {
			return $this->global->$param;
		}
		else {
			throw new \Exception("Parametro '$param' nao encontrado.", 1);
		}
	}
}