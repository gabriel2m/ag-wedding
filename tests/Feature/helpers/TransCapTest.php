<?php

test('trans_cap()', function () {
    mockTrans();
    expect(trans_cap('test'))->toBe('Mock');
});
