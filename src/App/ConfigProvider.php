<?php
/**
 * @copyright Copyright © 2014 Rollun LC (http://rollun.com/)
 * @license LICENSE.md New BSD License
 */

declare(strict_types = 1);

namespace App;

use App\Callbacks\UpdateOrderCallback;
use App\Callbacks\UpdateOrderCallbackFactory;
use rollun\callback\Callback\Factory\SerializedCallbackAbstractFactory;
use rollun\callback\Callback\Http;
use rollun\callback\Callback\Interrupter\Factory\HttpAbstractFactory;
use rollun\callback\Callback\Interrupter\Factory\InterruptAbstractFactoryAbstract;
use rollun\callback\Callback\Interrupter\Factory\ProcessAbstractFactory;
use rollun\callback\Callback\Interrupter\Factory\QueueMessageFillerAbstractFactory;
use rollun\callback\Callback\Interrupter\InterrupterAbstract;
use rollun\callback\Callback\Interrupter\InterrupterInterface;
use rollun\callback\Callback\Interrupter\Process;
use rollun\callback\Callback\Interrupter\QueueFiller;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            SerializedCallbackAbstractFactory::class => [
                'SerializedUpdateOrderCallback' => UpdateOrderCallback::class,
            ],
            InterruptAbstractFactoryAbstract::KEY => [
                'processInterrupter' => [
                    ProcessAbstractFactory::KEY_CLASS => Process::class,
                    ProcessAbstractFactory::KEY_CALLBACK_SERVICE => 'SerializedUpdateOrderCallback',
                ],
                'queueInterrupter' => [
                    QueueMessageFillerAbstractFactory::KEY_CLASS => QueueFiller::class,
                    QueueMessageFillerAbstractFactory::KEY_QUEUE_SERVICE => 'queueServiceName',
                ],
                'httpInterrupter' => [
                    HttpAbstractFactory::KEY_CLASS => Http::class,
                    HttpAbstractFactory::KEY_OPTIONS => [
                        // options for http client
                    ],
                    HttpAbstractFactory::KEY_URL => 'http://example.com/api/webhook'
                ],
            ],
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'abstract_factories' => [
                ProcessAbstractFactory::class,
                SerializedCallbackAbstractFactory::class,
            ],
            'factories'  => [
                Handler\MyHandler::class => Handler\MyHandlerFactory::class,
                UpdateOrderCallback::class => UpdateOrderCallbackFactory::class,
            ],
            'invokables' => [
                Handler\HomePageHandler::class => Handler\HomePageHandler::class,
            ],

        ];
    }
}
