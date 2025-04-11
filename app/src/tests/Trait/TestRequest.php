<?php

namespace Tests\Trait;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

trait TestRequest
{
    public function assertValidate(string $formRequestClass, array $params, bool $expect, array $messages = []): void
    {
        $formRequest = new $formRequestClass();
        $request = Request::create('/', 'POST', $params);

        // Manually validate the request
        $validator = Validator::make($request->all(), $formRequest->rules(), $formRequest->messages(), $formRequest->attributes());

        $this->assertEquals($expect, $validator->passes());

        if (!$expect) {
            foreach ($messages as $field => $expectedMessages) {
                $this->assertArrayHasKey($field, $validator->errors()->messages());
                $this->assertEquals($expectedMessages, $validator->errors()->get($field));
            }
        }
    }
}
