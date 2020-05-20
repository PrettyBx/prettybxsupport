<?php

namespace PrettyBx\Support\Tests\Traits;

use PrettyBx\Support\Tests\TestCase;
use PrettyBx\Support\Traits\Validatable;

class ValidatableTest extends TestCase
{
    /**
     * @test
     */
    public function validator_uses_external_rules_if_provided()
    {
        $tester = new class() {
            use Validatable;
        };

        $tester->validate(['id' => 1], ['id' => 'required|integer']);

        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function validator_uses_internal_rules_if_provided()
    {
        $tester = new class() {
            use Validatable;

            protected $rules = ['id' => 'required|integer'];
        };

        $tester->validate(['id' => 1]);

        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function validator_uses_external_rules_if_internal_also_provided()
    {
        $tester = new class() {
            use Validatable;

            protected $rules = ['this_rule_must_be_overwritten' => 'required|bool'];
        };

        $tester->validate(['id' => 2], ['id' => 'required|integer']);

        $this->assertTrue(true);
    }
}