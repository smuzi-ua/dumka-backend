<?php

namespace Tests\Feature;

use Tests\TestCase;

final class SchoolTest extends TestCase
{
    public function test_it_can_return_list_of_schools(): void
    {
        $this->get('/schools')->assertJsonStructure([
            'data' => [
                '*' => ['id', 'name']
            ]
        ]);
    }
}
