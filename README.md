# Magento 2 GraphQL Logger

<div align="center">

[![Packagist Downloads](https://img.shields.io/packagist/dm/graycore/magento2-graphql-logger?color=blue)](https://packagist.org/packages/graycore/magento2-graphql-logger/stats)
[![Packagist Version](https://img.shields.io/packagist/v/graycore/magento2-graphql-logger?color=blue)](https://packagist.org/packages/graycore/magento2-graphql-logger)
[![Packagist License](https://img.shields.io/packagist/l/graycore/magento2-graphql-logger)](https://github.com/graycoreio/magento2-graphql-logger/blob/main/LICENSE)
[![Integration Test](https://github.com/graycoreio/magento2-graphql-logger/actions/workflows/integration.yaml/badge.svg)](https://github.com/graycoreio/magento2-graphql-logger/actions/workflows/integration.yaml)

</div>

This module logs unique GraphQl queries for development purposes.

## Getting Started

This module is intended to be installed with [composer](https://getcomposer.org/). From the root of your Magento 2 project:

1. Download the package
```bash
composer require graycore/magento2-graphql-logger
```
2. Enable the package

```bash
./bin/magento module:enable Graycore_GraphQlLogger
```

## Usage

This module is disabled by default. It can be enabled through system configuration: Services -> Magento Web API -> GraphQl Logger -> Enable Logger.

Logs can be found in `graycore_graphql_log`.

