<?php

$query = $_GET['q'] ?? '';

if (mb_strlen($query) < 3) {
    $results = [];
} else {
    $results = $site->descendants()
        ->filterBy('content', '!=', '')
        ->search($query, 3, weights: ['description' => 4])
        ->each(fn($page) => $page->set('excerpt', textSnippet($page->content()->toPlainText(), $query, 250)));
}

return compact('query', 'results');

function textSnippet(string $text, string $keywords, int $length = 160): string
{
    $text = trim(preg_replace('/\s+/u', ' ', $text));
    $textLen = mb_strlen($text);

    // Split keywords
    $words = array_values(array_filter(
        preg_split('/\s+/u', trim($keywords))
    ));

    $firstPos = null;
    $firstWord = null;

    foreach ($words as $word) {
        $pos = mb_stripos($text, $word);
        if ($pos !== false && ($firstPos === null || $pos < $firstPos)) {
            $firstPos = $pos;
            $firstWord = $word;
        }
    }

    if ($firstPos === null) {
        $snippet = mb_substr($text, 0, $length);
        $snippet = preg_replace('/\s+\S*$/u', '', $snippet);

        return htmlspecialchars($snippet, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')
            . ($textLen > mb_strlen($snippet) ? '…' : '');
    }

    $kwLen = mb_strlen($firstWord);

    $start = max(0, $firstPos - intdiv($length - $kwLen, 2));
    if ($start + $length > $textLen) {
        $start = max(0, $textLen - $length);
    }

    if ($start > 0) {
        $spacePos = mb_strpos($text, ' ', $start);
        if ($spacePos !== false && $spacePos < $firstPos) {
            $start = $spacePos + 1;
        }
    }

    $snippet = mb_substr($text, $start, $length);

    if ($start + $length < $textLen) {
        $snippet = preg_replace('/\s+\S*$/u', '', $snippet);
    }

    $escaped = htmlspecialchars($snippet, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

    foreach ($words as $word) {
        $escapedWord = htmlspecialchars($word, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

        $escaped = preg_replace(
            '/' . preg_quote($escapedWord, '/') . '/iu',
            '<strong>$0</strong>',
            $escaped
        );
    }

    if ($start > 0) {
        $escaped = '…' . $escaped;
    }
    if ($start + mb_strlen($snippet) < $textLen) {
        $escaped .= '…';
    }

    return $escaped;
}
