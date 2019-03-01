<?php
/**
 * AJAX handler for getting user permissions from REMS
 *
 * PHP version 7
 *
 * Copyright (C) The National Library of Finland 2019.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License version 2,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category VuFind
 * @package  AJAX
 * @author   Samuli Sillanpää <samuli.sillanpaa@helsinki.fi>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     https://vufind.org/wiki/development Wiki
 */
namespace Finna\AjaxHandler;

use Finna\RemsService\RemsService;
use VuFind\Session\Settings as SessionSettings;
use Zend\Mvc\Controller\Plugin\Params;

/**
 * AJAX handler for getting user permissions from REMS
 *
 * @category VuFind
 * @package  AJAX
 * @author   Samuli Sillanpää <samuli.sillanpaa@helsinki.fi>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     https://vufind.org/wiki/development Wiki
 */
class RegisterRemsUser extends \VuFind\AjaxHandler\AbstractBase
{
    /**
     * REMS service
     *
     * @var RemsService
     */
    protected $rems;

    /**
     * Constructor
     *
     * @param SessionSettings   $ss       Session settings
     * @param Loader            $loader   Record loader
     * @param RendererInterface $renderer View renderer
     */
    public function __construct(SessionSettings $ss, RemsService $remsService
    ) {
        $this->sessionSettings = $ss;
        $this->rems = $remsService;
    }

    /**
     * Handle a request.
     *
     * @param Params $params Parameter helper from controller
     *
     * @return array [response data, HTTP status code]
     */
    public function handleRequest(Params $params)
    {
        //$this->disableSessionWrites();  // avoid session write timing bug

        $response = $this->rems->registerUser(
            'finna-test-user-1', 'email@email.com', 'name name2'
        );
        return $this->formatResponse(['status' => $response]);
    }
}