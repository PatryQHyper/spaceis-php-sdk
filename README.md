#SpaceIS PHP SDK

#### Simple PHP SDK for SpaceIs v3's API

For API v3 docs visit: https://docs.spaceis.pl/api

Every single response can throw:

LicenseExpiredException (httpCode 402),

NotFoundException (httpCode 400),

RateLimitException (httpCode 429),

ServerErrorException (httpCode 500),

UnauthorizedException (httpCode 401).

Usage:
```php
require __DIR__ .'/vendor/autoload.php';

use PatryQHyper\SpaceIs\SpaceIs;

$spaceIs = new SpaceIs('apiKey', 'apiUrl (optional)');

# Servers
$spaceIs->getServers();
$spaceIs->getServer('serverId/serverSlug');
$spaceIs->getCommands('serverId', 'serverToken');
$spaceIs->getLatestBuys('serverId/serverSlug', '(int) limit (optional, default:10)');
$spaceIs->getRichest('serverId/serverSlug', '(int) limit (optional, default:10)');

# Variants
$spaceIs->getVariants('serverId/serverSlug', 'productId');

# Payments
$spaceIs->initPayment('serverId/serverSlug', 'productId', 'variantId', 'nick', 'method', 'email (required if method != sms)', 'sms_code (required if method == sms)', 'discountCodeId (optional)', 'additionalParameter'); //throws PaymentInitException
$spaceIs->getTransactionInfo('transactionId', 'mode(info/extended)');

# Subpages
$spaceIs->getSubpage('subpageSlug');

# Discount codes
$spaceIs->getDiscountCode('discountCode');

# Vouchers
$spaceIs->voucherRedeem('nick', 'voucherCode'); //Throws: VoucherNotFoundException and VoucherUsedException

# User
$spaceIs->me();
```