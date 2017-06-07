<?php

namespace Room\SecurityBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class RoomSecurityBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
