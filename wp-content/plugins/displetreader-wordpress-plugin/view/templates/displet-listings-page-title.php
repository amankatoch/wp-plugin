<?php
	if (!empty($model['zip'])) {
		echo $model['zip'];
	}
	else if (!empty($model['city'])) {
		echo $model['city'];
	}
	else if (!empty($model['keyword'])) {
		echo $model['keyword'];
	}
?>