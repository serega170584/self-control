<?php
declare(strict_types=1);

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_CALLBACK, 'assertHandler');

function quickSort(array $a): array
{
    $elIndex = 0;
    $count = count($a);
    $rightIndex = $count - 1;

    $indexQueue = [];

    if ($elIndex < $rightIndex) {
        $indexQueue = [[$elIndex, $rightIndex]];
    }

    while ($indexQueue) {
        $index = array_shift($indexQueue);

        $elIndex = $index[0];
        $leftIndex = $elIndex + 1;
        $rightIndex = $index[1];

        while ($leftIndex <= $rightIndex) {

            $leftEl = $a[$leftIndex] ?? NULL;
            while (NULL !== $leftEl && $leftEl < $a[$elIndex]) {
                ++$leftIndex;
                $leftEl = $a[$leftIndex] ?? NULL;
            }

            $rightEl = $a[$rightIndex] ?? NULL;
            while (NULL !== $rightEl && $rightEl > $a[$elIndex]) {
                --$rightIndex;
                $rightEl = $a[$rightIndex] ?? NULL;
            }

            if ($leftIndex <= $rightIndex) {
                [$a[$rightIndex], $a[$leftIndex]] = [$a[$leftIndex], $a[$rightIndex]];
                ++$leftIndex;
                --$rightIndex;
            }
        }

        [$a[$elIndex], $a[$rightIndex]] = [$a[$rightIndex], $a[$elIndex]];

        if ($elIndex < $rightIndex - 1) {
            $indexQueue[] = [$elIndex, $rightIndex - 1];
        }

        if ($index[1] > $rightIndex + 1) {
            $indexQueue[] = [$rightIndex + 1, $index[1]];
        }

    }

    return $a;
}

function assertHandler(string $file, int $line, ?string $assertion, string $description): void
{
    printf("Error: %s %s %s", $file, $assertion, $description);
}

assert(quickSort([]) === []);

assert(quickSort([3,2]) === [], 'Error');

assert(quickSort([1,3,2]), [1, 2, 3]);

assert(quickSort([4,3,5,7,8,1,2]), [1, 2, 3, 4, 5, 7, 8]);
