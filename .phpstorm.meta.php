<?php
// IDE metadata template for Switon application skeletons.
// Keep this file limited to stable, skeleton-default application surfaces.

namespace PHPSTORM_META {
    exitPoint(\abort());

    override(\Switon\Core\App::get(), map(['' => '@']));
    override(\Psr\Container\ContainerInterface::get(), map(['' => '@']));
    override(\make(), map(['' => '@']));

    expectedArguments(\Switon\Http\RequestInterface::server(), 0, array_keys($_SERVER)[$i]);

    expectedArguments(
        \Switon\Http\ResponseInterface::json(), 0, ['code' => 0, 'msg' => '', 'data' => []]
    );

    registerArgumentsSet(
        'validator_constraint_type', ['bool', 'bit', 'int', 'float', 'array', 'mixed', 'iterable', 'mixed']
    );
    expectedArguments(
        \Switon\Validating\Attribute\Type::__construct(), 0, argumentsSet('validator_constraint_type')
    );

    expectedArguments(
        \Switon\Core\Json::stringify(), 1,
        JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT
        | JSON_FORCE_OBJECT | JSON_PRESERVE_ZERO_FRACTION | JSON_PARTIAL_OUTPUT_ON_ERROR
        | JSON_UNESCAPED_LINE_TERMINATORS
    );

    registerArgumentsSet('request_header', [
        'accept-charset',
        'accept-encoding',
        'accept-language',
        'authorization',
        'cache-control',
        'connection',
        'content-length',
        'cookie',
        'host',
        'origin',
        'referer',
        'set-cookie',
        'transfer-encoding',
        'user-agent',
        'if-none-match',
        'x-real-ip',
        'x-forwarded-for',
        'x-requested-with',
    ]);
    expectedArguments(\Switon\Http\RequestInterface::header(), 0, argumentsSet('request_header'));
}
