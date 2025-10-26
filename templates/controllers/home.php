<?php

use Formwork\Http\Client;
use Formwork\Parsers\Json;
use Formwork\Utils\Date;

$apiReleaseUri = 'https://api.github.com/repos/getformwork/formwork/releases/latest';
$client = new Client(['headers' => ['Accept' => 'application/vnd.github.v3+json']]);
$data = Json::parse($client->fetch($apiReleaseUri)->content());

$latestRelease = $data['tag_name'];
$latestReleaseTimestamp = Date::toTimestamp($data['published_at'], 'Y-m-d\TH:i:s\Z');

$latestReleaseDaysDifference = (int) round((time() - $latestReleaseTimestamp) / 86400);
$latestReleaseDaysAgo = match ($latestReleaseDaysDifference) {
    0 => 'today',
    1 => 'yesterday',
    default => $latestReleaseDaysDifference . ' days ago',
};

error_log('[Formwork] Checked latest release from GitHub');

return compact('latestRelease', 'latestReleaseTimestamp', 'latestReleaseDaysAgo');
