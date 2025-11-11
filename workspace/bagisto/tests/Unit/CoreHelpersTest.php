<?php

/**
 * Pure Unit Tests - No Laravel Boot Required
 * Test các helper functions và utility methods
 */

// Test String Helpers
it('converts string to slug format', function () {
    $input = "Hello World Test";
    $expected = "hello-world-test";

    $result = strtolower(str_replace(' ', '-', $input));

    expect($result)->toBe($expected);
});

it('validates email format correctly', function ($email, $isValid) {
    $result = filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    expect($result)->toBe($isValid);
})->with([
    ['test@example.com', true],
    ['invalid.email', false],
    ['user@domain.co.uk', true],
    ['@nodomain.com', false],
    ['no-at-sign.com', false],
]);

it('sanitizes HTML input', function ($input, $expected) {
    $result = strip_tags($input);
    expect($result)->toBe($expected);
})->with([
    ['<script>alert("xss")</script>Hello', 'alert("xss")Hello'],
    ['<b>Bold</b> text', 'Bold text'],
    ['Normal text', 'Normal text'],
    ['<p>Paragraph</p>', 'Paragraph'],
]);

// Test Number/Currency Helpers
it('formats price correctly', function ($amount, $decimals, $expected) {
    $result = number_format($amount, $decimals, '.', ',');
    expect($result)->toBe($expected);
})->with([
    [1234.56, 2, '1,234.56'],
    [1000, 0, '1,000'],
    [99.999, 2, '100.00'],
    [0.5, 2, '0.50'],
]);

it('calculates percentage', function ($value, $total, $expected) {
    $result = round(($value / $total) * 100, 2);
    expect($result)->toBe($expected);
})->with([
    [25, 100, 25.0],
    [50, 200, 25.0],
    [1, 3, 33.33],
    [0, 100, 0.0],
]);

it('calculates discount amount', function ($price, $discountPercent, $expected) {
    $result = round($price - ($price * $discountPercent / 100), 2);
    expect($result)->toBe($expected);
})->with([
    [100, 10, 90.0],
    [50, 20, 40.0],
    [199.99, 15, 169.99],
    [1000, 0, 1000.0],
]);

// Test Array Helpers
it('filters empty values from array', function () {
    $input = ['apple', '', 'banana', null, 'cherry', 0, false];
    $result = array_filter($input, fn($item) => !empty($item));

    expect($result)->toHaveCount(3);
    expect(in_array('apple', $result))->toBeTrue();
    expect(in_array('banana', $result))->toBeTrue();
    expect(in_array('cherry', $result))->toBeTrue();
});

it('merges arrays correctly', function () {
    $array1 = ['name' => 'John', 'age' => 30];
    $array2 = ['age' => 31, 'city' => 'NYC'];

    $result = array_merge($array1, $array2);

    expect($result['name'])->toBe('John');
    expect($result['age'])->toBe(31); // Second array overwrites
    expect($result['city'])->toBe('NYC');
});

// Test Date Helpers
it('validates date format', function ($date, $format, $isValid) {
    $d = \DateTime::createFromFormat($format, $date);
    $result = $d && $d->format($format) === $date;

    expect($result)->toBe($isValid);
})->with([
    ['2024-01-15', 'Y-m-d', true],
    ['15/01/2024', 'd/m/Y', true],
    ['2024-13-01', 'Y-m-d', false], // Invalid month
    ['invalid', 'Y-m-d', false],
]);

it('calculates days between dates', function () {
    $date1 = new \DateTime('2024-01-01');
    $date2 = new \DateTime('2024-01-11');

    $diff = $date1->diff($date2);

    expect($diff->days)->toBe(10);
});

it('validates numeric values', function ($value, $isValid) {
    $result = is_numeric($value);
    expect($result)->toBe($isValid);
})->with([
    [123, true],
    ['456', true],
    ['12.34', true],
    ['abc', false],
    ['', false],
]);

it('validates URL format', function ($url, $isValid) {
    $result = filter_var($url, FILTER_VALIDATE_URL) !== false;
    expect($result)->toBe($isValid);
})->with([
    ['https://example.com', true],
    ['http://localhost', true],
    ['ftp://ftp.example.com', true],
    ['not a url', false],
    ['', false],
]);

// Test String Manipulation
it('truncates long text', function () {
    $text = "This is a very long text that needs to be truncated";
    $maxLength = 20;

    $result = strlen($text) > $maxLength
        ? substr($text, 0, $maxLength) . '...'
        : $text;

    expect(strlen($result))->toBeLessThanOrEqual($maxLength + 3);
    expect($result)->toBe('This is a very long ...');
});

it('capitalizes first letter of each word', function () {
    $input = "hello world test";
    $result = ucwords($input);

    expect($result)->toBe("Hello World Test");
});

// Test JSON Helpers
it('encodes and decodes JSON correctly', function () {
    $data = ['name' => 'John', 'age' => 30, 'active' => true];

    $json = json_encode($data);
    $decoded = json_decode($json, true);

    expect($decoded)->toBe($data);
    expect($decoded['name'])->toBe('John');
    expect($decoded['age'])->toBe(30);
    expect($decoded['active'])->toBeTrue();
});

// Test Configuration/Settings
it('parses configuration strings', function ($config, $expected) {
    // Simulate parsing key=value configs
    $parts = explode('=', $config);
    $result = count($parts) === 2 ? ['key' => $parts[0], 'value' => $parts[1]] : null;

    expect($result)->toBe($expected);
})->with([
    ['debug=true', ['key' => 'debug', 'value' => 'true']],
    ['max_items=100', ['key' => 'max_items', 'value' => '100']],
    ['invalid', null],
]);

// Test Search/Filter Helpers
it('searches string in array', function ($needle, $haystack, $found) {
    $result = in_array($needle, $haystack, true);
    expect($result)->toBe($found);
})->with([
    ['apple', ['apple', 'banana', 'cherry'], true],
    ['grape', ['apple', 'banana', 'cherry'], false],
    [1, [1, 2, 3], true],
    ['1', [1, 2, 3], false], // Strict comparison
]);

// Test Math Helpers
it('rounds numbers correctly', function ($number, $decimals, $expected) {
    $result = round($number, $decimals);
    expect($result)->toBe($expected);
})->with([
    [1.2345, 2, 1.23],
    [1.2367, 2, 1.24],
    [100.5, 0, 101.0],
    [10.123456, 4, 10.1235],
]);

it('calculates tax amount', function ($price, $taxRate, $expected) {
    $result = round($price * $taxRate / 100, 2);
    expect($result)->toBe($expected);
})->with([
    [100, 10, 10.0],
    [50.50, 8.5, 4.29],
    [1000, 0, 0.0],
]);

// Test SKU/Product Code Generation
it('generates SKU code', function ($prefix, $number, $expected) {
    $result = $prefix . '-' . str_pad($number, 5, '0', STR_PAD_LEFT);
    expect($result)->toBe($expected);
})->with([
    ['PROD', 1, 'PROD-00001'],
    ['SKU', 999, 'SKU-00999'],
    ['ITEM', 12345, 'ITEM-12345'],
]);

// Test Password Validation
it('validates password strength', function ($password, $minLength, $isStrong) {
    $hasUpper = preg_match('/[A-Z]/', $password);
    $hasLower = preg_match('/[a-z]/', $password);
    $hasNumber = preg_match('/[0-9]/', $password);
    $isLongEnough = strlen($password) >= $minLength;

    $result = $hasUpper && $hasLower && $hasNumber && $isLongEnough;
    expect($result)->toBe($isStrong);
})->with([
    ['Password123', 8, true],
    ['weak', 8, false],
    ['NoNumbers', 8, false],
    ['nonumber', 8, false],
    ['NOLOWER123', 8, false],
]);

// Test Shipping/Weight Calculations
it('calculates shipping weight', function ($items, $expected) {
    $total = (float) array_sum(array_column($items, 'weight'));
    expect($total)->toBe($expected);
})->with([
    [[['weight' => 1.5], ['weight' => 2.0], ['weight' => 0.5]], 4.0],
    [[['weight' => 0.25], ['weight' => 0.75]], 1.0],
    [[['weight' => 10]], 10.0],
]);

// Test Inventory Calculations
it('calculates stock status', function ($quantity, $threshold, $status) {
    if ($quantity <= 0) {
        $result = 'out_of_stock';
    } elseif ($quantity <= $threshold) {
        $result = 'low_stock';
    } else {
        $result = 'in_stock';
    }
    expect($result)->toBe($status);
})->with([
    [0, 5, 'out_of_stock'],
    [3, 5, 'low_stock'],
    [10, 5, 'in_stock'],
    [5, 5, 'low_stock'],
]);

// Test Order Number Generation
it('generates order numbers', function ($prefix, $timestamp, $random) {
    $result = strtoupper($prefix) . '-' . date('Ymd', $timestamp) . '-' . $random;
    expect($result)->toStartWith(strtoupper($prefix) . '-');
    expect(strlen($result))->toBeGreaterThan(10);
})->with([
    ['ORD', 1704067200, '001'],
    ['INV', 1704067200, '999'],
]);

// Test Address Formatting
it('formats full address', function ($parts, $expected) {
    $filtered = array_filter($parts);
    $result = implode(', ', $filtered);
    expect($result)->toBe($expected);
})->with([
    [['123 Main St', 'Apt 4', 'New York', 'NY', '10001'], '123 Main St, Apt 4, New York, NY, 10001'],
    [['456 Oak Ave', '', 'Los Angeles', 'CA'], '456 Oak Ave, Los Angeles, CA'],
]);

// Test Phone Number Validation
it('validates phone number format', function ($phone, $isValid) {
    $cleaned = preg_replace('/[^0-9]/', '', $phone);
    $result = strlen($cleaned) >= 10 && strlen($cleaned) <= 15;
    expect($result)->toBe($isValid);
})->with([
    ['(555) 123-4567', true],
    ['+1-555-123-4567', true],
    ['123', false],
    ['', false],
]);

// Test Rating Calculations
it('calculates average rating', function ($ratings, $expected) {
    $avg = count($ratings) > 0 ? array_sum($ratings) / count($ratings) : 0;
    $result = round($avg, 1);
    expect($result)->toBe($expected);
})->with([
    [[5, 4, 5, 3, 4], 4.2],
    [[5, 5, 5], 5.0],
    [[1, 2, 3, 4, 5], 3.0],
    [[], 0.0],
]);

// Test File Size Formatting
it('formats file size', function ($bytes, $expected) {
    if ($bytes >= 1073741824) {
        $result = round($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        $result = round($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        $result = round($bytes / 1024, 2) . ' KB';
    } else {
        $result = $bytes . ' B';
    }
    expect($result)->toBe($expected);
})->with([
    [1024, '1 KB'],
    [1048576, '1 MB'],
    [2097152, '2 MB'],
    [500, '500 B'],
]);

// Test Color Code Validation
it('validates hex color codes', function ($color, $isValid) {
    $result = preg_match('/^#[a-fA-F0-9]{6}$/', $color) === 1;
    expect($result)->toBe($isValid);
})->with([
    ['#FF5733', true],
    ['#000000', true],
    ['#fff', false],
    ['FF5733', false],
    ['#GGGGGG', false],
]);

// Test Pagination Calculations
it('calculates pagination data', function ($total, $perPage, $page, $expected) {
    $totalPages = (int) ceil($total / $perPage);
    $offset = ($page - 1) * $perPage;
    $hasNext = $page < $totalPages;
    $hasPrev = $page > 1;

    $result = [
        'total_pages' => $totalPages,
        'offset' => $offset,
        'has_next' => $hasNext,
        'has_prev' => $hasPrev,
    ];
    expect($result)->toBe($expected);
})->with([
    [100, 10, 1, ['total_pages' => 10, 'offset' => 0, 'has_next' => true, 'has_prev' => false]],
    [100, 10, 5, ['total_pages' => 10, 'offset' => 40, 'has_next' => true, 'has_prev' => true]],
    [100, 10, 10, ['total_pages' => 10, 'offset' => 90, 'has_next' => false, 'has_prev' => true]],
]);

// Test Coupon Code Validation
it('validates coupon code format', function ($code, $isValid) {
    $result = preg_match('/^[A-Z0-9]{6,12}$/', $code) === 1;
    expect($result)->toBe($isValid);
})->with([
    ['SAVE20', true],
    ['DISCOUNT2024', true],
    ['save20', false],
    ['ABC', false],
    ['TOOLONGCOUPONCODE', false],
]);

// Test Image Dimensions
it('validates image dimensions', function ($width, $height, $minWidth, $minHeight, $isValid) {
    $result = $width >= $minWidth && $height >= $minHeight;
    expect($result)->toBe($isValid);
})->with([
    [800, 600, 640, 480, true],
    [1920, 1080, 1280, 720, true],
    [320, 240, 640, 480, false],
]);

// Test Username Validation
it('validates username format', function ($username, $isValid) {
    $result = preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username) === 1;
    expect($result)->toBe($isValid);
})->with([
    ['john_doe', true],
    ['user123', true],
    ['ab', false],
    ['user@name', false],
    ['verylongusernamethatexceedslimit', false],
]);

// Test Credit Card Masking
it('masks credit card number', function ($cardNumber, $expected) {
    $last4 = substr($cardNumber, -4);
    $result = str_repeat('*', strlen($cardNumber) - 4) . $last4;
    expect($result)->toBe($expected);
})->with([
    ['1234567890123456', '************3456'],
    ['4111111111111111', '************1111'],
]);

// Test Query String Building
it('builds query string', function ($params, $expected) {
    $result = http_build_query($params);
    expect($result)->toBe($expected);
})->with([
    [['page' => 1, 'limit' => 10], 'page=1&limit=10'],
    [['q' => 'search term', 'sort' => 'price'], 'q=search+term&sort=price'],
]);

// Test Time Formatting
it('formats time ago', function ($seconds, $expected) {
    if ($seconds < 60) {
        $result = $seconds . ' seconds ago';
    } elseif ($seconds < 3600) {
        $result = floor($seconds / 60) . ' minutes ago';
    } elseif ($seconds < 86400) {
        $result = floor($seconds / 3600) . ' hours ago';
    } else {
        $result = floor($seconds / 86400) . ' days ago';
    }
    expect($result)->toBe($expected);
})->with([
    [30, '30 seconds ago'],
    [120, '2 minutes ago'],
    [3600, '1 hours ago'],
    [172800, '2 days ago'],
]);

// Test CSV Parsing
it('parses CSV line', function ($line, $expected) {
    $result = str_getcsv($line, ',', '"', '\\');
    expect($result)->toBe($expected);
})->with([
    ['John,Doe,30', ['John', 'Doe', '30']],
    ['"Smith, John","Manager",45', ['Smith, John', 'Manager', '45']],
]);

// Test Range Validation
it('validates number in range', function ($value, $min, $max, $isValid) {
    $result = $value >= $min && $value <= $max;
    expect($result)->toBe($isValid);
})->with([
    [50, 1, 100, true],
    [0, 1, 100, false],
    [101, 1, 100, false],
    [1, 1, 100, true],
    [100, 1, 100, true],
]);
