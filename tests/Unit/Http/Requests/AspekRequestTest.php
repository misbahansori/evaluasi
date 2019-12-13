<?php

namespace Tests\Unit\Http\Requests;

use Tests\TestCase;
use App\Http\Requests\AspekRequest;

class AspekRequestTest extends TestCase
{
    /** @test */
    public function rules()
    {
        $subject = new AspekRequest;

        $this->assertEquals([
            'bagian_id'   => 'required|integer|exists:bagian,id',
            'nama'     => 'required|string|max:150',
            'kategori' => 'required|max:150',
            'tipe'     => 'required|in:bulanan,tahunan'
        ], $subject->rules());
    }
}
