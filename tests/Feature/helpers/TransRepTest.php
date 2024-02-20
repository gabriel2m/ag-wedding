<?php

test('trans_rep()', function () {
    mockTrans();
    expect(trans_rep('test :replace', ['replace' => 'replacement']))->toBe('mock mock');
});
