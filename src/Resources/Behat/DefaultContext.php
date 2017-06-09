<?php

namespace Resources\Behat;

use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\MinkExtension\Context\RawMinkContext;
use Behat\Symfony2Extension\Context\KernelAwareContext;

/**
 * Default context.
 */
abstract class DefaultContext extends RawMinkContext implements KernelAwareContext, SnippetAcceptingContext
{
    use Symfony2Trait;
}
