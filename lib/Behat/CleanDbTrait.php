<?php

declare(strict_types=1);

namespace Resources\Behat;

use Behat\Behat\Hook\Scope\BeforeScenarioScope;

/**
 * Class CleanDbTrait.
 */
trait CleanDbTrait
{
    /**
     * @BeforeScenario
     *
     * @param BeforeScenarioScope $scope
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function cleanDatabase(BeforeScenarioScope $scope)
    {
        $this->cleanDb();
    }

    protected function cleanDb()
    {
        $em            = $this->getEntityManager();
        $orderedTables = [];

        $em->getConnection()->executeUpdate('SET foreign_key_checks = 0;');
        $platform = $em->getConnection()->getDatabasePlatform();
        foreach ($orderedTables as $tbl) {
            $em->getConnection()->executeUpdate($platform->getTruncateTableSQL($tbl, true));
        }
        $em->getConnection()->executeUpdate('SET foreign_key_checks = 1;');
    }
}
