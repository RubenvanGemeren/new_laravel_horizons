<?php

namespace Database\Factories;

use App\Models\FinanceCategory;
use App\Models\FinanceRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FinanceRecord>
 */
class FinanceRecordFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FinanceRecord::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->date('Y-m-d H:i:s'),
            'name' => $this->faker->unique->name(),
            'type' => $this->faker->randomElement(['Income', 'Expense', 'Saving']),
            'category_id' => FinanceCategory::all()->random()->id,
            'description' => $this->faker->text(191),
            'amount' => $this->faker->numberBetween(1, 1000000),
            'effective_date' => $this->faker->date('Y-m-d H:i:s'),
        ];
    }
}
