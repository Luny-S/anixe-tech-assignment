<?php

namespace App\Factory;

use Cake\Database\Connection;

final class QueryFactory
{
	private Connection $databaseConnection;
	
	public function __construct(Connection $databaseConnection)
	{
		$this->$databaseConnection = $databaseConnection;
	}
}