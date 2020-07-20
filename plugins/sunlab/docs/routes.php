<?php

Route::post('sunlab/docs/refresh/{hashKey}', 'SunLab\Docs\Controllers\GitWebHook@refresh')
        ->where('hashKey', '[\w\d]{8,}');
