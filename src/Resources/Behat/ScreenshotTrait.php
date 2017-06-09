<?php

namespace Resources\Behat;

use Behat\Behat\Hook\Scope\AfterStepScope;
use Behat\Mink\Driver\Selenium2Driver;

/**
 * Behat trait.
 */
trait ScreenshotTrait
{
    /**
     * @AfterStep
     *
     * @param AfterStepScope $scope
     */
    public function takeScreenshotAfterFailedStep(AfterStepScope $scope)
    {
        if (99 === $scope->getTestResult()->getResultCode()) {
            $this->takeScreenshot();
        }
    }

    private function takeScreenshot()
    {
        $driver = $this->getSession()->getDriver();

        if (!$driver instanceof Selenium2Driver) {
            return;
        }

        $baseUrl  = $this->getMinkParameter('base_url');
        $fileName = 'selenium-'.date('d-m-y').'-'.uniqid().'.png';

        $filePath = '/tmp/';

        if (getenv('CIRCLE_ARTIFACTS')) {
            $filePath = getenv('CIRCLE_ARTIFACTS');
        } elseif (is_dir('/vagrant/tmp/')) {
            $filePath = '/vagrant/tmp/';
        }

        $this->saveScreenshot($fileName, $filePath);
        echo 'Screenshot at: '.$baseUrl.'tmp/'.$fileName;
    }
}
