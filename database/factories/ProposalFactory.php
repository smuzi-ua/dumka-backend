<?php

namespace Database\Factories;

use App\Models\Proposal;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProposalFactory extends Factory
{
    protected $model = Proposal::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->title(),
            'body'  => $this->faker->text(),
        ];
    }
}
