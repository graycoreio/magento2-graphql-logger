# Changelog

All notable changes to this project will be documented in this file. See [standard-version](https://github.com/conventional-changelog/standard-version) for commit guidelines.

## [0.2.0](https://github.com/graycoreio/magento2-graphql-logger/compare/v0.1.1...v0.2.0) (2025-04-11)


### ⚠ BREAKING CHANGES

* We no longer plugin around the query processor (which is a good thing). However, Magento's out-of-box log data doesn't give the exact query sent. This is likely due to the fact that it is possible for mutation data like user passwords to appear in the log if developers fail to use variables appropriately. However, I'm not going to compensate for naive developers. To keep existing functionality, we've added the full query (not variables) to the log data when this package is enabled. I would avoid using this in production environments if at all possible if you're concerned about the quality of your development team.

### Features

* replace plugin with LoggerInterface implementation ([0c52ca4](https://github.com/graycoreio/magento2-graphql-logger/commit/0c52ca4a827d923f693cb31022f5c2b6006568ae))

### 0.1.1 (2022-07-26)
