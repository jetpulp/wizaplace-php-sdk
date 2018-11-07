<?php
/**
 * @copyright Copyright (c) Wizacha
 * @license Proprietary
 */

namespace Wizaplace\SDK\Division;

use GuzzleHttp\Exception\ClientException;
use Wizaplace\SDK\AbstractService;
use Wizaplace\SDK\Exception\FeatureNotEnabled;
use Wizaplace\SDK\Exception\NotFound;

class DivisionService extends AbstractService
{
    /**
     * Get all divisions from the MP
     * If $code is specified, you will have the specific division and his children
     *
     * @param null|string $code
     *
     * @return array
     * @throws FeatureNotEnabled
     * @throws NotFound
     */
    public function get(?string $code = null)
    {
        $url = "divisions";
        if (!is_null($code)) {
            $url = $url."/${code}";
        }

        try {
            $divisionUtils = new DivisionUtils();

            return $divisionUtils->getDivisions($this->client->get($url));
        } catch (ClientException $e) {
            if ($e->getResponse()->getStatusCode() === 404) {
                throw new NotFound("The division doesn't exist", $e);
            }
            if ($e->getResponse()->getStatusCode() === 501) {
                throw new FeatureNotEnabled("The feature is not enabled", $e);
            }
            throw $e;
        }
    }
}
