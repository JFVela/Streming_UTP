<?php
function cosineSimilarity($vec1, $vec2)
{
    $dotProduct = 0;
    $magnitude1 = 0;
    $magnitude2 = 0;

    // Calcular producto punto y magnitudes
    foreach ($vec1 as $key => $value1) {
        $value2 = isset($vec2[$key]) ? $vec2[$key] : 0;
        $dotProduct += $value1 * $value2;
        $magnitude1 += $value1 ** 2;
        $magnitude2 += $value2 ** 2;
    }

    $magnitudeFinal1 = sqrt($magnitude1);
    $magnitudeFinal2 = sqrt($magnitude2);
}
